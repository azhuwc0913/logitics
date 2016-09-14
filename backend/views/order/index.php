<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'order_sn',
            'product_code',
            'des_country',
            'buyer_id',
            // 'tracking_id',
            // 'consignee',
            // 'street',
            // 'city',
            // 'province',
            // 'tel',
            // 'email:email',
            // 'ename',
            // 'status',
            // 'tracking_number',
            // 'created_time:datetime',
            // 'updated_time:datetime',
            // 'delete_time:datetime',

            ['class' => 'yii\grid\ActionColumn','header'=>'操作'],

                [
                    'label' => '更多操作',
                    'format' => 'raw',
                    'value' => function ($data) {
                        if(!$data->created_time) {
                            $url = "http://admin.yii_shop.com/order/create-order?id=" . $data->id;
                            return Html::a('创建订单', $url);
                        }
//                        else{
//                            $url = "http://admin.yii_shop.com/order/look-order?id=" . $data->id;
//                            return Html::a('查询订单轨迹', $url);
//                        }
                    }
                ],

        ],
    ]); ?>
</div>
