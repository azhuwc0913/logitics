<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Goods */

$this->title = 'Update Goods: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Goods', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="goods-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <style>
        #fenlei{

            /*height: 300px;*/
            display: -webkit-flex;
            display: flex;
            flex-direction: column;
            /*justify-content: space-between;*/
        }
        .pp, .child{
            width:150px;
            /*height: 300px;*/

            margin-left: 10px;
            border: solid 1px darkcyan;
            border-radius:5px;
            display: -webkit-flex;
            display: flex;
            flex-direction: column;

        }

        div[class="fi-2"]{
            display: none;
        }

        div[class^="xh"]{
            display: none;
        }
    </style>
    <div class="goods-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'goods_name')->textInput(['style'=>'width:250px;'])->label('商品名称') ?>

        <?= $form->field($model, 'title')->textInput(['style'=>'width:250px;'])->label('商品标题') ?>

        <?= $form->field($model, 'description')->textInput(['style'=>'width:550px;'])->label('商品描述') ?>

        <?= $form->field($model, 'content')->textarea(['rows' => 6])->label('详细内容') ?>


        <div class="form-group field-goods-cat_id has-success fenlei" id="fenlei">

            <label class="control-label" for="goods-cat_id">所属分类</label>
            <select id="goods-cat_id" class="form-control" name="Goods[cat_id]" style="width:150px">
                <option value="">请选择</option>
                <?php foreach($catData as $v):
                    if($v['id']==$model->cat_id){
                     $selected = "selected='selected'";
                    }else{
                        $selected = '';
                    }
                    ?>
                <option <?= Html::encode($selected)?> value="<?= Html::encode($v['id'])?>"><?= Html::encode($v['cat_name'])?></option>
               <?php endforeach;?>
            </select>

            <div class="form-group field-goods-cat_id has-success" style="margin-top:2%;margin-left: -9%">
            <table width="30%" height="30%"  id="pinpai">
                <?php $modelIds = explode(',', $model->model_id);
                $brandIds = explode(',', $model->brand_id);
                $ids= [];
                foreach($model_data as $v3):?>

                    <?php

                    if(in_array($v3['p_id'], $ids)){
                       $opt = '[-]';
                    }else{
                        $ids[] = $v3['p_id'];
                        $opt = '[+]';
                    }
                    ?>

                    <tr><td align="right" width="30%"><a href="javasript:void(0)" onclick="addNew(this)"><?php echo $opt;?></a></td><td align="left" width="30%">
                            品牌：<select onchange="getData(this)" name="brand[]">
                                <option value="">请选择</option>
                                <?php foreach($brandData as $v1):
                                    if($v1['id']==$v3['p_id']){
                                       $selected="selected='selected'";
                                    }else{
                                        $selected='';
                                    }
                                    ?>
                                    <option <?php echo $selected;?> value="<?php echo $v1['id']?>"><?php echo $v1['brand_name']?></option>
                                <?php endforeach;?>
                            </select></td><td align="left" width="30%" height="20%">
                            型号：<select  class="xinhao<?php echo $v3['id']?>" name="model[]">
                                <option value="">请选择</option>

                                <?php foreach($modelData as $v2):
                                    if($v2['id']==$v3['id']){
                                       $select = "selected='selected'";
                                    }else{
                                       $select = '';
                                    }
                                ?>
                                    <option <?php echo $select;?> value="<?php echo $v2['id']?>"><?php echo $v2['model_name']?></option>
                                <?php endforeach;?>
                            </select>
                        </td></tr>
                <?php endforeach;?>
            </table>
            </div>
        </div>



        <div class="form-group field-goods-group">
            <label class="control-label" for="goods-group">适用人群</label>
            <input type="hidden" name="Goods[group]" value="">
            <div id="goods-group">
                <div class="checkbox"><label><input type="checkbox" <?php if(strpos(','.$model->group.',', ','.'1'.',')!==false){echo $checked="checked='checked'";}else{echo $checked='';}?> name="Goods[group][]" value="1"> male</label></div>
                <div class="checkbox"><label><input type="checkbox" <?php if(strpos(','.$model->group.',', ','.'0'.',')!==false){echo $checked="checked='checked'";}else{echo $checked='';}?> name="Goods[group][]" value="0"> female</label></div></div>

            <p class="help-block help-block-error"></p>
        </div>

        <?= $form->field($model, 'logo')->fileInput() ?>
        <?= showImage($model->logo,120,120)?>





        <?= $form->field($model, 'goods_number')->textInput(['style'=>'width:150px;'])->label('库存总量') ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

    <?= Html::jsFile('@web/js/jquery.js');?>
    <script>

        function getData(o) {

            var cat_id = "<?php echo $model->cat_id?>";

            var brand_id = $(o).val();

            var child_model_id = $(o).parent().parent().find('td:last select').val();


            if (!brand_id) {

                $("select[class=xinhao" + child_model_id + "]").html(' <option value="">请选择</option>');

            }
            if (brand_id) {
                var _this = $(o);
                $.ajax({
                    type: 'get',
                    dataType: 'json',
                    data: {brand_id: brand_id, cat_id: cat_id},
                    url: "<?php echo \yii\helpers\Url::to('/brand/get-model')?>",
                    success: function (msg) {

                        var html = '<option value="">请选择</option>';

                        $(msg).each(function (k, v) {
                            html += "<option value='" + v.id + "'>" + v.model_name + "</option>"
                        });

                        _this.parent().parent().find('td:last select').html(html);
                    }
                });
            }
        }

        function addNew(o){
            var str = $(o).html();
            var old_cont = $(o).parent().parent();
            if(str == '[+]'){

                var new_str = old_cont.clone(true);
                new_str.find('a').html('[-]');
                old_cont.after(new_str);
            }else{
                old_cont.remove();
            }
        }
    </script>

</div>
