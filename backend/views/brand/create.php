<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Brand */

$this->title = 'Create Brand';
$this->params['breadcrumbs'][] = ['label' => 'Brands', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="brand-form">

        <?php $form = ActiveForm::begin(); ?>
        <?php foreach($brand as $lis){
            $data[$lis['id']]=$lis['brand_name'];
        }?>
        <?php if(Yii::$app->request->get('id') == 1):?>
            <?=$form->field($model, 'cat_id')->dropDownList(\yii\helpers\ArrayHelper::map((new \backend\models\Category())->find()->all(), 'id', 'cat_name'), ['prompt'=>'请选择','style'=>'width:150px'])->label('所属分类') ?>

            <?=$form->field($model, 'type')->dropDownList(['1'=>'品牌'], ['style'=>'width:120px'])->label('') ?>
            <?= $form->field($model, 'brand_name')->textInput(['maxlength' => true])->label('Name') ?>
        <?php else:?>

            <?=$form->field($model, 'type')->dropDownList(['2'=>'型号'], ['style'=>'width:120px'])->label('') ?>

            <?=$form->field($model, 'cat_id')->dropDownList(\yii\helpers\ArrayHelper::map((new \backend\models\Category())->find()->all(), 'id', 'cat_name'), ['prompt'=>'请选择','style'=>'width:150px'])->label('所属分类') ?>

            <?=$form->field($model, 'p_id')->dropDownList($data, ['prompt'=>'请选择','style'=>'width:150px'])->label('所属品牌') ?>
            <?= $form->field($model, 'model_name')->textInput(['maxlength' => true])->label('Name') ?>
        <?php endif?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
