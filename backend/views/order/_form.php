<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_sn')->textInput(['style'=>'width:250px;'])->label('订单编号') ?>

    <?= $form->field($model, 'product_code')->textInput(['style'=>'width:250px;'])->label('产品代码') ?>

    <?= $form->field($model, 'des_country')->textInput(['style'=>'width:250px;'])->label('目的地国家') ?>

    <?= $form->field($model, 'buyer_id')->textInput(['style'=>'width:250px;'])->label('买家 ID') ?>

<!--    --><?//= $form->field($model, 'tracking_id')->textInput(['style'=>'width:250px;'])->label('目的地国家') ?>

    <?= $form->field($model, 'consignee')->textInput(['style'=>'width:250px;'])->label('收件人姓名') ?>

    <?= $form->field($model, 'street')->textInput(['style'=>'width:250px;'])->label('收件人所在街道') ?>

    <?= $form->field($model, 'city')->textInput(['style'=>'width:250px;'])->label('收件人所在城市') ?>

    <?= $form->field($model, 'province')->textInput(['style'=>'width:250px;'])->label('收件人所在州') ?>

    <?= $form->field($model, 'tel')->textInput(['style'=>'width:250px;'])->label('收件人电话') ?>

    <?= $form->field($model, 'email')->textInput(['style'=>'width:250px;'])->label('收件人邮箱') ?>

    <?= $form->field($model, 'ename')->textInput(['style'=>'width:250px;'])->label('海关英文名') ?>

    <?= $form->field($model, 'track_content')->textInput(['style'=>'width:450px;', 'disabled'=>'disabled'])->label('订单状态') ?>

    <?= $form->field($model, 'tracking_number')->textInput(['style'=>'width:250px;', 'disabled'=>'disabled'])->label('订单追踪码') ?>

<!--    --><?//= $form->field($model, 'created_time')->textInput(['style'=>'width:250px;']) ?>
<!---->
<!--    --><?//= $form->field($model, 'updated_time')->textInput(['style'=>'width:250px;']) ?>
<!---->
<!--    --><?//= $form->field($model, 'delete_time')->textInput(['style'=>'width:250px;']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
