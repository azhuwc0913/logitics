<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Goods */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    #fenlei{

        height: 300px;
        display: -webkit-flex;
        display: flex;
        flex-direction: row;
        /*justify-content: space-between;*/
    }
    .pp, .child{
        width:150px;
        height: 300px;

        margin-left: 10px;
        border: solid 1px darkcyan;
        border-radius:5px;
        display: -webkit-flex;
        display: flex;
        flex-direction: column;

    }

   div[class^="fi"]{
        display: none;
    }
</style>
<div class="goods-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'goods_name')->textInput(['style'=>'width:250px;'])->label('商品名称') ?>

    <?= $form->field($model, 'title')->textInput(['style'=>'width:250px;'])->label('商品标题') ?>

    <?= $form->field($model, 'price')->textInput(['style'=>'width:250px;'])->label('商品价格') ?>

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
        <div class="fi-1">
        <div class="pp">品牌：<span class="content1"></span></div>
        </div>
    <div class="fi-2">
        <div class="child">型号：<span class="content2"></span></div>
    </div>
    </div>

    <?= $form->field($model, 'group')->checkboxList(['1'=>'male','0'=>'female'])->label('适用人群') ?>

    <?= $form->field($model, 'logo')->fileInput() ?>





    <?= $form->field($model, 'goods_number')->textInput(['style'=>'width:150px;'])->label('库存总量') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?= Html::jsFile('@web/js/jquery.js');?>
<script>
    $(document).ready(function(){
  $('#goods-cat_id').change(function(){

      var val = $(this).val();
      if(val){
          $('.fi-1').css('display','block');
      }else{
          $('.fi-1').css('display','none');
          $('.fi-2').css('display','none');

          //除掉之前出现过的型号
          $(".pinpai2").parent().remove();

          //除掉所有的隐藏域
          $("input[name^=model]").remove();
      }
      $.ajax({
          type:'get',
          dataType:'json',
          url:"<?php echo \yii\helpers\Url::to('/brand/type')?>?cat_id="+val,
          success:function(msg){

                var html = '';

                $(msg).each(function (k, v) {
                    html+="<div ><input class='pinpai1' onclick='getChildren(this)' type='checkbox' name='brand[]' value='"+ v.id+"'>"+ v.brand_name+"&nbsp;&nbsp;&nbsp;<a  href='javascript:void(0)' onclick='findChild(this)'>显示型号</a></div><br />";
                });

              $('.content1').html(html);
          }
      });



  });

});

    function findChild(o){
        var pp = $(o).parent().find('input').val();

        var cat_id = $('#goods-cat_id').val();

        var isChecked = $(o).parent().find('input').prop('checked');

        if(!isChecked){
           alert('请先选择一个品牌');
            return false;
        }

        if($('.fi-2').css('display')=='block'){
            $('.fi-2').css('display','none');
        }else {
            $('.fi-2').css('display', 'block');
        }


            $.ajax({
                type: 'get',
                data: {cate_id: cat_id, brand_id: pp},
                dataType: 'json',
                url: "<?php echo \yii\helpers\Url::to('/brand/size')?>",
                success: function (msg) {

                    var html = '';

                    $(msg).each(function (k, v) {
                        html += "<div ><input class='pinpai2'  onclick='addHidden(this)' pid='" + v.p_id + "' type='checkbox'  value='" + v.id + "'>" + v.model_name + "</div>";
                    });

                    $('.content2').html(html);
                }
            });

    }

    function getChildren(o){
        var str = $(o).prop('chekced');
        var val = $(o).val();

        if(!str){
            $("input[pid="+val+"]").parent().remove();

            //除掉所有的隐藏域
            $("input[brand_id="+val+"]").remove();
        }
    }

    function addHidden(o){
        var cat_id = $('#goods-cat_id').val();

        var p_id = $(o).attr('pid');

        var model_id = $(o).val();

        var checked = $(o).prop('checked');

        var str = '';
        if(checked){
           str+="<input type='hidden' id='"+model_id+"' name='model["+model_id+"]' value='"+model_id+"' brand_id='"+p_id+"'>";

            $('#fenlei').append(str);
        }else{
            //除掉对应的隐藏域
            $("#"+model_id+"").remove();
        }
    }

</script>
