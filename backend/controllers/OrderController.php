<?php

namespace backend\controllers;

use Yii;
use backend\models\Order;
use backend\models\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
{
    public function actions()
    {
        if (\Yii::$app->user->isGuest) {
            $this->redirect(['site/login']);
        }

        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {

        //查询订单信息
        header ( "content-type:text/html;charset=utf-8" );
        @ini_set("soap.wsdl_cache_enabled", "0"); // disabling WSDL cache
        set_time_limit(600);

        $model = $this->findModel($id);
        include './4px/OrderOnline.php';
        $arrs = ['orderNo'=>$model->order_sn];
        $soap = new \OrderOnline();
        $result = $soap->findOrderService($arrs);
        //查询订单轨迹，同时更改数据库中的订单状态
        $res = (new Order())->queryGuiji($model->tracking_number);
        $model->track_code = $res['trackCode'];

        $model->track_content = $res['trackContent'];

        $model->save();
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        //每次修改之前都查询一次订单的状态
        $res = (new Order())->queryGuiji($model->tracking_number);

        $model->track_code = $res['trackCode'];

        $model->track_content = $res['trackContent'];

        $model->save();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            //发送消息给4PX接口

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionCreateOrder($id){
        header ( "content-type:text/html;charset=utf-8" );
        @ini_set("soap.wsdl_cache_enabled", "0"); // disabling WSDL cache
        set_time_limit(600);


        include './4px/OrderOnline.php';

        $soap = new \OrderOnline();

        $model = $this->findModel($id);

        $arrs = array(
            'authToken' => '',
            "buyerId" => $model->buyer_id,//买家ID
            "consigneeName" =>$model->consignee ,
            "consigneePostCode" => $model->post,
            "city" => $model->city,//城市 【***】
            "consigneeEmail" => $model->email,//收件人Email
            "consigneeTelephone" => $model->tel,//收件人电话号码
            "destinationCountryCode" => $model->des_country,//目的国家二字代码，参照国家代码表【***】
            "orderNo" => $model->order_sn,//客户订单号码，由客户自己定义【***】
            "productCode" => $model->product_code,//产品代码，指DHL、新加坡小包挂号、联邮通挂号等，参照产品代码表【***】
            "stateOrProvince" => $model->province,//州  /  省 【***】
            "street" => $model->street,//街道【***】
            "declareInvoice" => array(
                array(
                    "eName" =>$model->ename,
                    "unitPrice" =>'10',//单价 0 < Amount <= [10,2]【***】
                ),
            )
        );


        //创建并预报订单，成功会返回tracking_number
        $result = $soap->createAndPreAlertOrderService($arrs);

        if($result['ack']=='Failure'){
            Yii::$app->getSession()->setFlash('error', $result['cnAction']);
            return $this->redirect('index');
        }else{
            //创建订单成功，将tracking_number保存在订单表中，并插入生成订单的时间
            $model->created_time = time();
            $model->tracking_number = $result['trackingNumber'];

            if($model->save()){
                Yii::$app->getSession()->setFlash('success', '创建订单成功！');
                return $this->redirect('index');
            }
        }


    }


    //查询订单轨迹
    public function actionLookOrder($id){

        $model = $this->findModel($id);

        $res =  (new Order())->queryGuiji($model->tracking_number);

        return $res;
    }

    public function actionTest(){
        //echo 11;
        print_r($_POST['data']);
       //print_r(file_get_contents());
    }
}
