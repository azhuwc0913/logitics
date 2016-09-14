<?php

namespace backend\controllers;

use Yii;
use backend\models\Brand;
use backend\models\BrandSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BrandController implements the CRUD actions for Brand model.
 */
class BrandController extends Controller
{
    /**
     * @inheritdoc
     */

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
     * Lists all Brand models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BrandSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Brand model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Brand model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {


        $model = new Brand();


        $brand = $model->find()->where(['type'=>'1'])->asArray()->all();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'brand' => $brand
            ]);
        }
    }

    /**
     * Updates an existing Brand model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Brand model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Brand model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Brand the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Brand::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionType($cat_id){
       //取出当前cat下的所有品牌
        $brandData = Brand::find()->where(['cat_id'=>$cat_id])->andWhere(['type'=>1])->asArray()->all();

        $str = json_encode($brandData);

        echo $str;
    }

    public function actionSize(){
        $cat_id = $_GET['cate_id'];

        $brand_id = $_GET['brand_id'];

        $model_data = Brand::find()->where(['cat_id'=>$cat_id, 'p_id'=>$brand_id])->andWhere(['type'=>2])->asArray()->all();

        echo json_encode($model_data);
    }

    public function actionGetModel(){
        $cat_id = $_GET['cat_id'];
        $brand_id = $_GET['brand_id'];

        $model_data = Brand::find()->where(['cat_id'=>$cat_id, 'p_id'=>$brand_id])->andWhere(['type'=>2])->asArray()->all();

        echo json_encode($model_data);
    }


    public function actionGetCatData($cat_id){
        if(!$cat_id){
            //表示取出所有的品牌和分类数据
            $brandData = Brand::find()->where(['type'=>1])->asArray()->all();

            $modelData = Brand::find()->where(['type'=>2])->asArray()->all();

            return json_encode(['brand_data'=>$brandData, 'model_data'=>$modelData, 'status'=>0]);

        }else {
            $brandData = Brand::find()->where(['cat_id' => $cat_id])->andWhere(['type' => 1])->asArray()->all();

            $modelData = Brand::find()->where(['cat_id' => $cat_id])->andWhere(['type' => 2])->asArray()->all();

            return json_encode(['brand_data' => $brandData, 'model_data' => $modelData,'status'=>1]);
        }
    }
}
