<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
<title>wemall用户中心</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link rel="stylesheet"
	href="__PUBLIC__/style/bootstrap.min.css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
        <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
<style>
body {
  /* min-height: 2000px; */
  padding-top: 50px;
}
</style>
</head>
<body>
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		            <span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		          </button>
				<a class="navbar-brand" href="javascript:void(0);">WeMall用户中心</a>
			</div>
			

<div class="navbar-collapse collapse">
	<ul class="nav navbar-nav">
		<li id="dingdan">
			<a href="__APP__/Index/admin">订单</a>
		</li>
		<li class="dropdown active" id="shangpin">
			<a href="javascript:void(0)" class="dropdown-toggle"
				data-toggle="dropdown">
				商品
				<b class="caret"></b>
			</a>
			<ul class="dropdown-menu">
				<li>
					<a href="__APP__/Admin/nav">商品分类</a>
				</li>
				<li>
					<a href="__APP__/Admin/product">商品管理</a>
				</li>
			</ul>
		</li>
		<li class="dropdown" id="weixinset">
			<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
				微信设置
				<b class="caret"></b>
			</a>
			<ul class="dropdown-menu">
				<li>
					<a href="__APP__/Weixin/index" id="weixinset">微信初始化</a>
				</li>
			</ul>
		</li>
	</ul>
	<ul class="nav navbar-nav navbar-right">
		<li>
			<a href="javascript:void(0)"><?php echo ($username); ?></a>
		</li>
		<li>
			<a href="__APP__/Index/quit">退出</a>
		</li>
	</ul>
</div>
<!--/.nav-collapse -->
</div>
</div>
<div class="container" style="padding-top:20px">
	<div style="margin-left:105px;margin-bottom:20px;">提示分类序号信息:<?php if(is_array($tip)): foreach($tip as $key=>$vo): ?>ID:<?php echo ($vo["id"]); ?>-<?php echo ($vo["value"]); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php endforeach; endif; ?>
	</div>

	<form class="form-horizontal" enctype="multipart/form-data" role="form" method="post"
		action="__APP__/Admin/addproduct">
		<div class="form-group" style="display:none;">
			<label for="title" class="col-sm-2 control-label">商品序号</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" name="id"  value="<?php echo ($prosel[0][id]); ?>" placeholder="添加商品时此处留空">
			</div>
		</div>
		<div class="form-group">
			<label for="title" class="col-sm-2 control-label">分类序号</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" name="cate_id"  value="<?php echo ($prosel[0][cate_id]); ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="title" class="col-sm-2 control-label">商品名称</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" name="title"  value="<?php echo ($prosel[0][title]); ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="title" class="col-sm-2 control-label">商品价格</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" name="price"  value="<?php echo ($prosel[0][price]); ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="title" class="col-sm-2 control-label">商品原价</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" name="old_price"  value="<?php echo ($prosel[0][old_price]); ?>">
			</div>
		</div>
		<div class="form-group">
			<label for="title" class="col-sm-2 control-label">商品图片</label>
			<div class="col-sm-5">
				<input type="hidden" name="noupimg" value="<?php echo ($prosel[0][img]); ?>">
				<input multiple="multiple" class="btn btn-default" type="file" name="img">
				允许的附件文件类型: jpg,gif,png,jpeg 并且图片大小小于200k
				<?php if(!empty($prosel)): ?><img src="__PUBLIC__/Uploads/<?php echo ($prosel[0][img]); ?>" class="img-thumbnail"></img><?php endif; ?>
				
			</div>
		</div>
		<div class="form-group">
			<label for="title" class="col-sm-2 control-label">商品详情</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" name="detail"  value="<?php echo ($prosel[0][detail]); ?>">
			</div>
		</div>
		<div style="margin-left:200px;margin-bottom:20px;">商品下架请把商品状态改成0</div>
		<div class="form-group">
			<label for="title" class="col-sm-2 control-label">商品状态</label>
			<div class="col-sm-5">
				<input type="text" class="form-control" name="status" placeholder="" value="<?php echo ($prosel[0][status]); ?>">
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" name="reproduct" value="reproduct"
					class="btn btn-primary">提交</button>
			</div>
		</div>
	</form>
</div>

﻿	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="__PUBLIC__/style/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="__PUBLIC__/style/bootstrap.min.js"></script>

</body>
</html>