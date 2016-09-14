<?php

namespace backend\controllers;

use backend\models\Brand;
use backend\models\Category;
use common\models\AES;
use Yii;
use backend\models\Goods;
use backend\models\GoodsSearch;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * GoodsController implements the CRUD actions for Goods model.
 */
class GoodsController extends Controller
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
     * Lists all Goods models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GoodsSearch();
        $params = Yii::$app->request->queryParams;

        $dataProvider = $searchModel->search($params);

        $dataProvider->pagination->pageSize = 4;
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Goods model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Goods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Goods();

        //取出所有的分类数据
        $catData = Category::find()->asArray()->all();

        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'logo');
            if(!is_null($file)){
                $res = uploadFile($model,[], $file);
                $model->logo = $res[0];
            }

            //在添加的时候有可能出现重复
            $model->model_id = array_unique($_POST['model']);

            $model->model_id = implode(',', $_POST['model']);

            $model->brand_id = implode(',', $_POST['brand']);

            $model->group = implode(',', $_POST['Goods']['group']);

            $model->created_time = time();

            $time = date('i').date('s');
            //选出goods表中最新的id
            $res = (new Query())->select('id')->from('goods')->orderBy(['id'=> SORT_DESC])->one();

            if(!$res){
                //数据库为空
                $model->goods_sn = '1'.$time;
            }else {
                $id = $res['id']+1;
                $model->goods_sn = $id.$time;
            }
            if($model->save()) {
                $res = (new Goods())->getData($model,'http://ad.law_sur.com/product/get-new-goods');

                if($res){
                    return $this->redirect(['view', 'id' => $model->id]);
                }else{
                    Yii::$app->getSession()->setFlash('error','同步商品失败！');
                    return $this->redirect(['goods/create']);
                }
            }else{
                dd($model->errors);
                Yii::$app->getSession()->setflash('error','添加商品失败');
                return $this->redirect(['goods/create']);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'catData'=>$catData
            ]);
        }
    }

    /**
     * Updates an existing Goods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        //取出所有的分类数据
        $catData = Category::find()->asArray()->all();
        //根据该商品的分类取出所有的品牌信息
        $brandData = Brand::find()->where(['cat_id'=>$model->cat_id])->andWhere(['type'=>1])->asArray()->all();

        //该分类下的所有型号数据
        $modelData = Brand::find()->where(['cat_id'=>$model->cat_id])->andWhere(['type'=>2])->asArray()->all();

        //取出该商品的所属模型数据
        $ids = explode(',', $model->model_id);

        $model_data = Brand::find()->where(['id'=>$ids])->asArray()->all();
//        dd($model_data);
        $logo = $model->logo;

        if ($model->load(Yii::$app->request->post())) {

            $file = UploadedFile::getInstance($model, 'logo');


            if(!is_null($file)){

                //删除掉原来的图片
               // deleteImage([$logo]);
                $res = uploadFile($model,[], $file);
                $model->logo = $res[0];
            }else{
                $model->logo = $logo;
            }

            $model->model_id = implode(',', $_POST['model']);

            $brandIds = array_unique($_POST['brand']);

            $model->brand_id = implode(',', $brandIds);

            $model->group = implode(',', $_POST['Goods']['group']);

            $model->updated_time = time();

            if($model->save()) {

                $res = (new Goods())->getData($model,'http://ad.law_sur.com/product/update-goods');


               // dd($res->goods_id);
                if($res){
                    return $this->redirect(['view', 'id' => $model->id]);
                }else{
                    Yii::$app->getSession()->setFlash('error','同步商品失败！');
                }

            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'catData' => $catData,
                'brandData' => $brandData,
                'modelData' => $modelData,
                'model_data' => $model_data

            ]);
        }
    }

    /**
     * Deletes an existing Goods model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {

        $model = $this->findModel($id);

        //删掉原来的图片
        //deleteImage([$model->logo]);
        $res= (new Goods)->deleteData($model, 'http://ad.law_sur.com/product/delete-goods');

        if($res){
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        }else{
            Yii::$app->getSession()->setFlash('error','同步删除商品失败！');

            return $this->redirect(['index']);
        }

    }

    /**
     * Finds the Goods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Goods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }




}
