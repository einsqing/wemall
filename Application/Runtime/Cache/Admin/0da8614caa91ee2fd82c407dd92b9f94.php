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
<div class="col-sm-12 widget-container-span">
	<div class="widget-box transparent">
		<div class="widget-header">
			<div class="widget-toolbar no-border">
				<ul class="nav nav-tabs" id="myTab">
					<li class="active"><a data-toggle="tab" href="#home1">菜单管理</a></li>
					<li><a data-toggle="tab" href="#home2">添加/修改菜单</a></li>
				</ul>
			</div>
		</div>

		<div class="widget-body">
			<div class="widget-main padding-12 no-padding-left no-padding-right">
				<div class="tab-content padding-4">
					<div id="home1" class="tab-pane in active">
						<div class="row">
							<div class="col-xs-12 no-padding-right">
								<div class="table-responsive">
									<table id="sample-table-1"
										class="table table-striped table-bordered table-hover">
										<thead>
											<tr>
												<!-- <th class="center"><label> <input
														type="checkbox" class="ace"> <span class="lbl"></span>
												</label></th> -->
												<th>ID</th>
												<th>分类名称</th>
												<th class="hidden-480">操作</th>
											</tr>
										</thead>

										<tbody>
										<?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><tr>
												<!-- <td class="center"><label> <input
														type="checkbox" class="ace"> <span class="lbl"></span>
												</label></td> -->

												<td parent="<?php echo ($menu["pid"]); ?>"><?php echo ($menu["id"]); ?></td>
												<td class="hidden-480"><?php echo ($menu["name"]); ?></td>

												<td>
												<!-- <a href="javascript:void(0);" onclick="addSubmenu(this)" class="addsub btn btn-white btn-sm">添加子类</a> -->
												<a href="javascript:void(0);" onclick="reSubmenu(this)" class="btn btn-white btn-sm">修改</a><a class="J_ajax_del btn btn-white btn-sm" href="<?php echo U('Admin/Menu/del',array('id'=>$menu['id']));?>">删除</a></td>
											</tr><?php endforeach; endif; else: echo "" ;endif; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					
					<div id="home2" class="tab-pane in">
						<form class="form-horizontal J_ajaxForm" id="myform" action="<?php echo U('Admin/Menu/addmenu');?>" method="post">
							<div class="tabbable">
								<div class="tab-content">
									<div class="tab-pane active">
										<table cellpadding="2" cellspacing="2" width="100%">
											<tbody>
												<tr>
													<td width="140">上级:</td>
													<td>
														<select name="parent" class="normal_select" disabled="disabled">
															<option value="0">作为一级分类</option>
															<?php if(is_array($menulist)): $i = 0; $__LIST__ = $menulist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menulist): $mod = ($i % 2 );++$i;?><option value="<?php echo ($menulist["id"]); ?>"><?php echo ($menulist["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
														</select>
													</td>
												</tr>
												<tr>
													<td>名称:</td>
													<td><input type="text" class="input" name="name"
														value=""><input type="hidden" name="addmenu" value="0"></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="form-actions">
								<button class="btn btn-primary btn_submit J_ajax_submit_btn"
									type="submit">提交</button>
								<a class="btn" href="">返回</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		
		<script type="text/javascript">
			function addSubmenu(o) {
				var subid = $(o).parent().prev().prev().html();
				$('select[name="parent"]').val(subid);
				$('input[name="addmenu"]').val('0');
				$('input[name="name"]').val('');
				
				$('#myTab li').eq(1).find('a').click();
			}
			function reSubmenu(o){
				var name = $(o).parent().prev().html().replace(/&nbsp;/g,'').replace('├─','');
				var pid = $(o).parent().prev().prev().attr('parent');
				var subid = $(o).parent().prev().prev().html();
				$('select[name="parent"]').val(pid);
				$('input[name="name"]').val(name);
				$('input[name="addmenu"]').val(subid);
				$('#myTab li').eq(1).find('a').click();
			}
		</script>
	</div>
</div>