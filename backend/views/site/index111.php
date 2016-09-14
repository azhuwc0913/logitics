<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<?=\yii\helpers\Html::cssFile('@web/style/css/ch-ui.admin.css')?>
	<?=\yii\helpers\Html::cssFile('@web/style/font/css/font-awesome.min.css')?>
	<?=\yii\helpers\Html::jsFile('@web/style/js/jquery.js')?>
	<?=\yii\helpers\Html::jsFile('@web/style/js/ch-ui.admin.js')?>
</head>
<body>
	<!--头部 开始-->
	<div class="top_box">
		<div class="top_left">
			<div class="logo">物流平台系统</div>
			<ul>
				<li><a href="#" class="active">首页</a></li>
				<li><a href="#">管理页</a></li>
			</ul>
		</div>
		<div class="top_right">
			<ul>
				<li>管理员：<?= Yii::$app->user->getId()?></li>
				<li><a href="pass.html" target="main">修改密码</a></li>
				<li><a href="<?= \yii\helpers\Url::to('site/logout')?>">退出</a></li>
			</ul>
		</div>
	</div>
	<!--头部 结束-->

	<!--左侧导航 开始-->
	<div class="menu_box">
		<ul>
            <li>
            	<h3><i class="fa fa-fw fa-clipboard"></i>商品管理</h3>
                <ul class="sub_menu">
                    <li><a href="<?= \yii\helpers\Url::to('goods/index')?>" target="main"><i class="fa fa-fw fa-plus-square"></i>商品列表</a></li>
                    <li><a href="list.html" target="main"><i class="fa fa-fw fa-list-ul"></i>商品类型列表</a></li>
                    <li><a href="tab.html" target="main"><i class="fa fa-fw fa-list-alt"></i>商品品牌列表</a></li>
                    <li><a href="img.html" target="main"><i class="fa fa-fw fa-image"></i>商品型号列表</a></li>
                </ul>
            </li>
            <li>
            	<h3><i class="fa fa-fw fa-cog"></i>系统设置</h3>
                <ul class="sub_menu">
                    <li><a href="#" target="main"><i class="fa fa-fw fa-cubes"></i>网站配置</a></li>
                    <li><a href="#" target="main"><i class="fa fa-fw fa-database"></i>备份还原</a></li>
                </ul>
            </li>
            <li>
            	<h3><i class="fa fa-fw fa-thumb-tack"></i>工具导航</h3>
                <ul class="sub_menu">
                    <li><a href="http://www.yeahzan.com/fa/facss.html" target="main"><i class="fa fa-fw fa-font"></i>图标调用</a></li>
                    <li><a href="http://hemin.cn/jq/cheatsheet.html" target="main"><i class="fa fa-fw fa-chain"></i>Jquery手册</a></li>
                    <li><a href="http://tool.c7sky.com/webcolor/" target="main"><i class="fa fa-fw fa-tachometer"></i>配色板</a></li>
                    <li><a href="element.html" target="main"><i class="fa fa-fw fa-tags"></i>其他组件</a></li>
                </ul>
            </li>
        </ul>
	</div>
	<!--左侧导航 结束-->

	<!--主体部分 开始-->
	<div class="main_box">
		<iframe src="info.html" frameborder="0" width="100%" height="100%" name="main"></iframe> 
	</div>
	<!--主体部分 结束-->

<!--	<!--底部 开始-->-->
<!--	<div class="bottom_box">-->
<!--		CopyRight © 2015. Powered By <a href="http://www.houdunwang.com">http://www.houdunwang.com</a>.-->
<!--	</div>-->
<!--	<!--底部 结束-->-->
</body>
</html>