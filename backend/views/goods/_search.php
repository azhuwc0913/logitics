<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GoodsSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .checkbox{
           display: inline;
           margin:0 5px;
       }
    .field-goodssearch-created_from,.field-goodssearch-created_to{

    }
</style>
<div class="goods-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


    <?= $form->field($model, 'goods_name')->textInput(['style'=>'width:150px'])->label('商品名称') ?>

    <div class="form-group field-goodssearch-created_time">
        <label class="control-label" for="goodssearch-created_time">创建时间：</label>
        <input type="text" id="goodssearch-created_time_from"  value="<?= $model->created_from?>" name="GoodsSearch[created_from]">-
        <input type="text" id="goodssearch-created_time_to"  value="<?= $model->created_to?>" name="GoodsSearch[created_to]">

    </div>

    <?php  echo $form->field($model, 'cat_id')->dropDownList(\yii\helpers\ArrayHelper::map((new \backend\models\Category())->find()->all(),'id','cat_name'),['prompt'=>'所有分类',  'style'=>'width:150px'])->label('商品分类') ?>

    <?php  echo $form->field($model, 'brand_id')->dropDownList(\yii\helpers\ArrayHelper::map((new \backend\models\Brand())->find()->where(['type'=>1])->all(), 'id', 'brand_name'), ['prompt'=>'所有品牌','style'=>'width:150px;'])->label('品牌名称') ?>

    <?php  echo $form->field($model, 'model_id')->dropDownList(\yii\helpers\ArrayHelper::map((new \backend\models\Brand())->find()->where(['type'=>2])->all(), 'id', 'model_name'), ['prompt'=>'所有型号','style'=>'width:150px;'])->label('型号名称') ?>

    <?php  echo $form->field($model, 'group')->dropDownList(['1'=>'male','0'=>'female'],['prompt'=>'所有人群', 'style'=>'width:150px;'])->label('适用人群') ?>



    <?php // echo $form->field($model, 'goods_sn') ?>

    <?php // echo $form->field($model, 'logo') ?>

    <?php // echo $form->field($model, 'created_time') ?>

    <?php // echo $form->field($model, 'updated_time') ?>

    <?php // echo $form->field($model, 'cat_id') ?>

    <?php // echo $form->field($model, 'goods_number') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?= Html::jsFile('@web/js/jquery.js');?>
<?= Html::cssFile('@web/extension/datetimepicker/jquery-ui-1.9.2.custom.min.css');?>
<?= Html::jsFile('@web/extension/datetimepicker/jquery-ui-1.9.2.custom.min.js');?>
<?= Html::jsFile('@web/extension/datetimepicker/datepicker-zh_cn.js');?>
<?=Html::cssFile('@web/extension/datetimepicker/time/jquery-ui-timepicker-addon.min.css');?>
<?= Html::jsFile('@web/extension/datetimepicker/time/jquery-ui-timepicker-addon.min.js');?>
<?= Html::jsFile('@web/extension/datetimepicker/time/i18n/jquery-ui-timepicker-addon-i18n.min.js');?>

<script>

    $('#goodssearch-cat_id').change(function(){

        var va = $(this).val();

          //发送ajax请求，得到相关数据
            $.ajax({
                type:'get',
                dataType:'json',
                url:"<?= \yii\helpers\Url::to('/brand/get-cat-data')?>?cat_id="+va,
                success:function(msg){

                        var brand_html='<option value="">所有品牌</option>';
                        var model_html = '<option value="">所有型号</option>';



                    $(msg.brand_data).each(function(k, v){

                        brand_html+="<label><option value='"+ v.id+"'>"+ v.brand_name+"</label>";

                    });
                    $(msg.model_data).each(function(k, v){
                        model_html+='<label><option value="'+ v.id+'">'+ v.model_name+'</label>';
                    });

                    $('#goodssearch-model_id').html(model_html);
                    $('#goodssearch-brand_id').html(brand_html);

                }
            });

    });
    //添加时间插件
    $.timepicker.setDefaults($.timepicker.regional['zh-CN']);
    $("#goodssearch-created_time_from").datetimepicker();
    $("#goodssearch-created_time_to").datetimepicker();
</script>
