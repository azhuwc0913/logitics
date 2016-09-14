<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Goods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="goods-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'goods_name')->textInput(['style'=>'width:250px;'])->label('商品名称') ?>

    <?= $form->field($model, 'title')->textInput(['style'=>'width:250px;']) ?>

    <?= $form->field($model, 'description')->textInput(['style'=>'width:550px;']) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>


    <div class="form-group field-goods-cat_id has-success">
        <label class="control-label" for="goods-cat_id">所属分类</label>
        <select id="goods-cat_id" class="form-control" name="Goods[cat_id]" style="width:150px">
            <option value="">请选择</option>
            <option value="1">手机壳</option>
            <option value="2">T恤衫</option>
            <option value="3">化妆品</option>
        </select>

        <div class="help-block"></div>
    </div>
    <div class="form-group field-goods-brand_id has-success">
        <label class="control-label" for="goods-brand_id">品牌名</label>
        <select id="goods-brand_id" class="form-control" name="Goods[brand_id]" style="width:150px">
            <option value="">请选择</option>

        </select>

        <div class="help-block"></div>
    </div>
    <?= $form->field($model, 'brand_id')->dropDownList(\yii\helpers\ArrayHelper::map((new \backend\models\Brand())->find()->where(['type'=>1])->all(),'id', 'brand_name'), ['prompt'=>'请选择','style'=>'width:150px'])->label('品牌名') ?>

    <?= $form->field($model, 'model_id')->checkboxList(\yii\helpers\ArrayHelper::map((new \backend\models\Brand())->find()->where(['type'=>2])->all(),'id', 'model_name'))->label('适用型号') ?>

    <?= $form->field($model, 'group')->radioList(['male'=>'male','female'=>'female'])->label('适用人群') ?>

    <?= $form->field($model, 'logo')->fileInput() ?>

<!--    --><?//= $form->field($model, 'created_time')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'updated_time')->textInput() ?>



    <?= $form->field($model, 'goods_number')->textInput(['style'=>'width:150px;'])->label('库存总量') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?= Html::jsFile('@web/js/jquery.js');?>
<script>
  $('#goods-cat_id').change(function(){

      var val = $(this).val();

      $.ajax({
          type:'get',
          dateType:'json',
          url:"<?php echo \yii\helpers\Url::to('/brand/type')?>?cat_id="+val,
          success:function(){

          }
      });
  });
</script>
