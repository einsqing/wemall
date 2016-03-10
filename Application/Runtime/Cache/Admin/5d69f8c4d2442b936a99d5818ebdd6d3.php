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
												<th>用户名</th>
												<th>联系方式</th>
												<th>送货地址</th>
												<th>加入时间</th>
											</tr>
										</thead>

										<tbody>
										<?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$result): $mod = ($i % 2 );++$i;?><tr>
												<!-- <td class="center"><label> <input
														type="checkbox" class="ace"> <span class="lbl"></span>
												</label></td> -->
												
												<td><?php echo ($result["id"]); ?></td>
												<td><?php echo ($result["username"]); ?></td>
												<td><?php echo ($result["phone"]); ?></td>
												<td><?php echo ($result["address"]); ?></td>
												<td><?php echo ($result["time"]); ?></td>
											</tr><?php endforeach; endif; else: echo "" ;endif; ?>
										</tbody>
									</table>
									<div class="pagination" style="margin:0px;">
									    <?php echo ($page); ?>
									</div>
								</div>
							</div>
						</div>
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