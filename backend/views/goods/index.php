<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
//use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GoodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Goods';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Goods', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<!--    --><?php
//    $gridColumns = [
//        'id',
//        'goods_name',
//        'brand_id',
//        'group',
//        'created_time',
//        'goods_number',
//    ];
//
//    echo ExportMenu::widget([
//        'dataProvider' => $dataProvider,
//        'columns' => $gridColumns,
//
//    ]);
//    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'goods_name',
//            'title',
//            'description',
//            'content:ntext',
            [
                'attribute' => 'brand_id',
                'label' => '商品品牌',
                'value' => function($model){
                $ids = explode(',', $model->brand_id);
                    $res = '';
                foreach($ids as $v){
                   $res.= (new \backend\models\Brand())->getBrandName($v).'||';
                }

                    return rtrim($res,'||');
                }
            ],
            // 'model_id',
            [
                'attribute' => 'group',
                'value' => function($model){
                   $ids = explode(',', $model->group);
                    $str = '';
                    foreach($ids as $v){
                        if($v==0){
                          $str.='female'.'||';
                        }elseif($v==1){
                            $str.='male'.'||';
                        }
                    }
                    return rtrim($str,'||');
                }
            ],
            // 'goods_sn',


            [
                'attribute' => 'created_time',
                'label' => '创建时间',
                'value' => function($model){
                    return  date('Y-m-d H:i:s',$model->created_time);   //主要通过此种方式实现
                }
            ],
            // 'updated_time:datetime',
            // 'cat_id',
             'goods_number',

            ['class' => 'yii\grid\ActionColumn'],

        ],
    ]); ?>
</div>
