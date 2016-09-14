<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Order */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'order_sn',
            'product_code',
            'des_country',
            'buyer_id',
            'tracking_id',
            'consignee',
            'street',
            'city',
            'province',
            'tel',
            'email:email',
            'ename',
            [
                'attribute' => 'track_content',
                'label' => '订单状态',
//                'value' => function($model){
//                    return $model->track_content;
//                }
            ],
            'tracking_number',
            'created_time:datetime',
            'updated_time:datetime',
            'delete_time:datetime',
        ],
    ]) ?>

</div>
