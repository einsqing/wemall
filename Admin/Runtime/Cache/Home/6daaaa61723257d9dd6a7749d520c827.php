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
		<li id="dingdan">
			<a href="/WeMall/admin.php/Home/Admin/index">订单</a>
		</li>
		<li class="dropdown" id="shangpin">
			<a href="javascript:void(0)" class="dropdown-toggle"
				data-toggle="dropdown">
				商品
				<b class="caret"></b>
			</a>
			<ul class="dropdown-menu">
				<li>
					<a href="/WeMall/admin.php/Home/Admin/productcate">商品分类</a>
				</li>
				<li>
					<a href="/WeMall/admin.php/Home/Admin/product">商品管理</a>
				</li>
			</ul>
		</li>
		<li class="dropdown active" id="weixinset">
			<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
				微信设置
				<b class="caret"></b>
			</a>
			<ul class="dropdown-menu">
				<li>
					<a href="/WeMall/admin.php/Home/Weixin/index" id="weixinset">微信初始化</a>
				</li>
				<li>
					<a href="/WeMall/admin.php/Home/Weixin/autoreplay" id="weixinset">自动回复</a>
				</li>
				<li>
					<a href="/WeMall/admin.php/Home/Weixin/diynav" id="weixinset">自定义菜单</a>
				</li>
			</ul>
		</li>
	</ul>
	<ul class="nav navbar-nav navbar-right">
		<li>
			<a href="javascript:void(0)"><?php echo ($username); ?></a>
		</li>
		<li>
			<a href="/WeMall/admin.php/Home/Admin/quit">退出</a>
		</li>
	</ul>
</div>
<!--/.nav-collapse -->
</div>
</div>
<div class="container">
	<form class="form-horizontal" role="form" method="post"
		action="/WeMall/admin.php/Home/Weixin/weixinset">
		<div class="form-group">
			<label for="title" class="col-sm-2 control-label">微信AppId</label>
			<div class="col-sm-5">
				<input type="text" class="form-control"
					value="" id="title" name="title"
					placeholder="AppId">
			</div>
		</div>
		<div class="form-group">
			<label for="img" class="col-sm-2 control-label">微信AppSecret</label>
			<div class="col-sm-5">
				<input type="text" class="form-control"
					value="" id="img" name="img"
					placeholder="AppId">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" name="weixinset" value="weixinset"
					class="btn btn-primary">设置</button>
			</div>
		</div>
	</form>
</div>

﻿	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script
		src="http://cdn.bootcss.com/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script>

</body>
</html>