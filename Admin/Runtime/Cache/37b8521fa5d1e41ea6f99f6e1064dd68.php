<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
<title>wemall用户中心</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Bootstrap -->
<link rel="stylesheet"
	href="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/css/bootstrap.min.css">

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
		<li  id="dingdan">
			<a href="__APP__/Index/admin">订单</a>
		</li>
		<li class="dropdown active" id="shangpin">
			<a href="javascript:void(0)" class="dropdown-toggle " data-toggle="dropdown">
				商品
				<b class="caret"></b>
			</a>
			<ul class="dropdown-menu active">
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
<form class="form-horizontal" role="form" method="post" action="__APP__/Admin/addnav">
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-6">
			<div style="padding-top:20px;"></div>
			<label>请输入要新增的分类</label>
			<input type="text" class="form-control" name="addnav" name="addnav">
			<div style="padding-top:20px;"></div>
			<input type="submit" name="addnavsubmit" value="提交"
				class="btn btn-primary">
		</div>
	</div>
</form>
﻿	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>

</body>
</html>