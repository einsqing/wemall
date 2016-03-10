<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="cn">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
		<title>WeMall后台管理</title>

		<meta name="description" content="wemall 微商城 微信商城 www.inuoer.com inuoer.com" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- basic styles -->

		<link href="/wemall2.3.1/Public/Plugin/style/css/bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="/wemall2.3.1/Public/Plugin/style/css/font-awesome.min.css" />

		<!--[if IE 7]>
		  <link rel="stylesheet" href="/wemall2.3.1/Public/Plugin/style/css/font-awesome-ie7.min.css" />
		<![endif]-->

		<!-- ace styles -->

		<link rel="stylesheet" href="/wemall2.3.1/Public/Plugin/style/css/ace.min.css" />
		<link rel="stylesheet" href="/wemall2.3.1/Public/Plugin/style/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="/wemall2.3.1/Public/Plugin/style/css/ace-skins.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="/wemall2.3.1/Public/Plugin/style/css/ace-ie.min.css" />
		<![endif]-->

		<!-- ace settings handler -->

		<script src="/wemall2.3.1/Public/Plugin/style/js/ace-extra.min.js"></script>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]>
		<script src="/wemall2.3.1/Public/Plugin/style/js/html5shiv.js"></script>
		<script src="/wemall2.3.1/Public/Plugin/style/js/respond.min.js"></script>
		<![endif]-->
		
		<!-- javascript footer -->
				<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='/wemall2.3.1/Public/Plugin/style/js/jquery-2.0.3.min.js'>"+"<"+"/script>");
		</script>
		<!-- <![endif]-->

		<!--[if IE]>
		<script type="text/javascript">
		 	window.jQuery || document.write("<script src='/wemall2.3.1/Public/Plugin/style/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
		</script>
		<![endif]-->

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='/wemall2.3.1/Public/Plugin/style/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="/wemall2.3.1/Public/Plugin/style/js/bootstrap.min.js"></script>
		<script src="/wemall2.3.1/Public/Plugin/style/js/typeahead-bs2.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="/wemall2.3.1/Public/Plugin/style/js/excanvas.min.js"></script>
		<![endif]-->

		<script src="/wemall2.3.1/Public/Plugin/style/js/jquery-ui-1.10.3.custom.min.js"></script>
		<script src="/wemall2.3.1/Public/Plugin/style/js/jquery.ui.touch-punch.min.js"></script>
		<script src="/wemall2.3.1/Public/Plugin/style/js/jquery.slimscroll.min.js"></script>
		<script src="/wemall2.3.1/Public/Plugin/style/js/jquery.easy-pie-chart.min.js"></script>
		<script src="/wemall2.3.1/Public/Plugin/style/js/jquery.sparkline.min.js"></script>
		<script src="/wemall2.3.1/Public/Plugin/style/js/flot/jquery.flot.min.js"></script>
		<script src="/wemall2.3.1/Public/Plugin/style/js/flot/jquery.flot.pie.min.js"></script>
		<script src="/wemall2.3.1/Public/Plugin/style/js/flot/jquery.flot.resize.min.js"></script>

		<!-- ace scripts -->

		<script src="/wemall2.3.1/Public/Plugin/style/js/ace-elements.min.js"></script>
		<script src="/wemall2.3.1/Public/Plugin/style/js/ace.min.js"></script>
	</head>
	<body>
<div class="navbar navbar-default" id="navbar">
	<div class="navbar-container" id="navbar-container">
		<div class="navbar-header pull-left">
			<a href="#" class="navbar-brand">
				<small>
					WeMall V3.4
				</small>
			</a><!-- /.brand -->
		</div><!-- /.navbar-header -->

		<div class="navbar-header pull-right" role="navigation">
			<ul class="nav ace-nav">
				<li class="light-blue">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">
						<i class="icon-desktop  icon-desktop"></i>
						微信端预览
					</a>
					<div class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
						<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<title>preview</title>
<link rel="stylesheet" href="/wemall2.3.1/Public/Plugin/preview/app.css">
</head>
<body>
	<div class="phone-content">
		<div class="phone">
			<iframe src="<?php echo U('App/Index/index',array('uid'=>1));?>" frameborder="0"
				scrolling="yes"></iframe>
		</div>
	</div>
</body>
</html>
					</div>
				</li>
				<li class="light-blue">
					<a data-toggle="dropdown" href="#" class="dropdown-toggle">
						<span class="user-info">
							Admin
						</span>

						<i class="icon-caret-down"></i>
					</a>

					<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
						<li>
							<a href="<?php echo U('Admin/Login/logout');?>">
								<i class="icon-off"></i>
								注销
							</a>
						</li>
					</ul>
				</li>
			</ul><!-- /.ace-nav -->
		</div><!-- /.navbar-header -->
	</div><!-- /.container -->
</div>
<div class="main-container" id="main-container">
	<div class="main-container-inner">
		<div class="sidebar" id="sidebar">
	<script type="text/javascript">
		try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
	</script>

	<ul class="nav nav-list">
		<li class="active">
			<a href="">
				<i class="icon-home"></i>
				<span class="menu-text"> 商城设置 </span>
			</a>
		</li>

		<li>
			<a href="javascript:void(0)">
				<i class="icon-list"></i>
				<span class="menu-text"> 菜单管理 </span>
			</a>
		</li>

		<li>
			<a href="javascript:void(0)">
				<i class="icon-gift"></i>
				<span class="menu-text"> 商品管理 </span>
			</a>
		</li>
		
		<li>
			<a href="javascript:void(0)">
				<i class="icon-calendar"></i>
				<span class="menu-text"> 订单管理 </span>
			</a>
		</li>
		
		<li>
			<a href="javascript:void(0)">
				<i class="icon-group"></i>
				<span class="menu-text"> 用户管理 </span>
			</a>
		</li>
		
		<li>
			<a href="javascript:void(0)">
				<i class="icon-edit"></i>
				<span class="menu-text"> 微信管理 </span>
			</a>
		</li>

		<li>
			<a href="javascript:void(0)">
				<i class="icon-cloud"></i>
				<span class="menu-text"> 技术支持 </span>
			</a>
		</li>
	</ul><!-- /.nav-list -->

	<script type="text/javascript">
		try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
	</script>
</div>
        <script type="text/javascript" language="javascript"> 
   		function iframeResize(iframe) {
	        iframe.height = $(window).height()-90;
	    }
		</script>
		<div class="main-content">
			<div class="breadcrumbs" id="breadcrumbs">
				<ul class="breadcrumb">
					<li><i class="icon-home home-icon"></i> <a href="javascript:void(0);">商城设置</a></li>
					<li class="active">商城设置</li>
				</ul>
			</div>
			<div id="content_main">
				<iframe src="<?php echo U('Admin/Index/set');?>" id="main_iframe" name="main_iframe"
					style="width: 100%;" frameborder="0" onload="iframeResize(this);"  scrolling="yes"></iframe>

			</div>
		</div>

	</div>
</div>
		<script type="text/javascript">
		/* 菜单管理 */
		$('.nav.nav-list li').eq(1).click(function() {
			$('.nav.nav-list li').removeClass('active');
			$(this).addClass('active');
			$('#breadcrumbs ul li').eq(1).html('菜单管理');
			$('#main_iframe').attr("src","<?php echo U('Admin/Menu/index');?>");
		});
		/* 商品管理 */
		$('.nav.nav-list li').eq(2).click(function() {
			$('.nav.nav-list li').removeClass('active');
			$(this).addClass('active');
			$('#breadcrumbs ul li').eq(1).html('商品管理');
			$('#main_iframe').attr("src","<?php echo U('Admin/Good/index');?>");
		});
		/* 订单管理 */
		$('.nav.nav-list li').eq(3).click(function() {
			$('.nav.nav-list li').removeClass('active');
			$(this).addClass('active');
			$('#breadcrumbs ul li').eq(1).html('订单管理');
			$('#main_iframe').attr("src","<?php echo U('Admin/Order/index');?>");
		});
		/* 用户管理 */
		$('.nav.nav-list li').eq(4).click(function() {
			$('.nav.nav-list li').removeClass('active');
			$(this).addClass('active');
			$('#breadcrumbs ul li').eq(1).html('用户管理');
			$('#main_iframe').attr("src","<?php echo U('Admin/User/index');?>");
		});
		/* 微信管理 */
		$('.nav.nav-list li').eq(5).click(function() {
			$('.nav.nav-list li').removeClass('active');
			$(this).addClass('active');
			$('#breadcrumbs ul li').eq(1).html('微信管理');
			$('#main_iframe').attr("src","<?php echo U('Admin/Weixin/index');?>");
		});
		/* 扩展工具 */
		$('.nav.nav-list li').eq(6).click(function() {
			$('.nav.nav-list li').removeClass('active');
			$(this).addClass('active');
			$('#breadcrumbs ul li').eq(1).html('技术支持');
			$('#main_iframe').attr("src","<?php echo U('Admin/Util/index');?>");
		});
		</script>
		</body>
</html>