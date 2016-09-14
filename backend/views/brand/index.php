<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\BrandSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Brands';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    <div class="portlet-body" style="">
        <div class="clearfix">
            <div class="btn-group">
                <a href="<?= Url::to([ 'create']) .'?id=1'?>"><button id="sample_editable_1_new" class="btn green">
                        添加品牌<i class="icon-plus"></i>
                    </button>
                </a>
            </div>
            <div class="btn-group">
                <a href="<?= Url::to([ 'create']).'?id=2' ?>"><button id="sample_editable_1_new" class="btn green">
                        添加型号<i class="icon-plus"></i>
                    </button>
                </a>
            </div>

        </div>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'brand_name',
            'type',
            'cat_id',
            'model_name',
            'p_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
