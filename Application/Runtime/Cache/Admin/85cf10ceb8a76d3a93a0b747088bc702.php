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
<script type="text/javascript">
var UEURL = '/wemall2.3.1/Public/Plugin/umeditor/';
</script>
<link href="/wemall2.3.1/Public/Plugin/umeditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="/wemall2.3.1/Public/Plugin/umeditor/third-party/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/wemall2.3.1/Public/Plugin/umeditor/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/wemall2.3.1/Public/Plugin/umeditor/umeditor.min.js"></script>
<script type="text/javascript" src="/wemall2.3.1/Public/Plugin/umeditor/lang/zh-cn/zh-cn.js"></script>

<div class="col-sm-12 widget-container-span">
	<div class="widget-box transparent">
		<div class="widget-header">
			<div class="widget-toolbar no-border">
				<ul class="nav nav-tabs" id="myTab">
					<li class="active"><a data-toggle="tab" href="#home1">商品管理</a></li>
					<li><a data-toggle="tab" href="#home2">添加/修改商品</a></li>
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
												<th>商品名称</th>
												<th>商品分类</th>
												<th>商品价格</th>
												<th>时间</th>
												<th>操作</th>
											</tr>
										</thead>

										<tbody>
										<?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$result): $mod = ($i % 2 );++$i;?><tr>
												<!-- <td class="center"><label> <input
														type="checkbox" class="ace"> <span class="lbl"></span>
												</label></td> -->

												<td><?php echo ($result["id"]); ?></td>
												<td><?php echo ($result["name"]); ?></td>
												<td><?php echo ($result["menu"]); ?></td>
												<td><?php echo ($result["price"]); ?></td>
												<td><?php echo ($result["time"]); ?></td>
												<td><a href="javascript:void(0);" onclick="reGood(this);" class="btn btn-white btn-sm">修改</a><a class="J_ajax_del btn btn-white btn-sm" href="<?php echo U('Admin/Good/delgood',array('id'=>$result['id']));?>">删除</a></td>
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
					
					<div id="home2" class="tab-pane in">
						<form class="form-horizontal J_ajaxForm" enctype="multipart/form-data" id="myform" action="<?php echo U('Admin/Good/addgood');?>" method="post">
							<div class="tabbable">
								<div class="tab-content">
									<div class="tab-pane active">
										<table cellpadding="2" cellspacing="2" width="100%">
											<tbody>
												<tr>
													<td>商品分类:</td>
													<td><select class="select_2" name="addmenuid">
															<?php if(is_array($addmenu)): $i = 0; $__LIST__ = $addmenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$addmenu): $mod = ($i % 2 );++$i;?><option value="<?php echo ($addmenu["id"]); ?>"><?php echo ($addmenu["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
													</select></td>
												</tr>
												<tr>
													<td>商品名称:</td>
													<td><input type="text" class="input col-sm-6" name="addname" value=""></td>
												</tr>
												<tr>
													<td>商品价格:</td>
													<td><input type="text" class="input col-sm-2" name="addprice" value=""></td>
												</tr>
												<tr>
													<td>商品原价:</td>
													<td><input type="text" class="input col-sm-2" name="add_old_price" value=""></td>
												</tr>
												<tr>
													<td>商品排序:</td>
													<td><input type="text" class="input col-sm-2" name="addsort" value=""></td>
												</tr>
												<tr>
													<td>商品图片:</td>
													<td><input multiple="multiple" type="file" name="addimage">
													<p class="help-block">允许的附件文件类型: jpg,gif,png,jpeg并且图片大小小于200k.</p></td>
												</tr>
												<tr>
													<td>商品状态:</td>
													<td><select name="addstatus"><option value="1">出售</option>
														<option value="0">下架</option></select></td>
												</tr>
												<tr>
													<td>商品详情:</td>
													<td><!--style给定宽度可以影响编辑器的最终宽度-->
														<div type="text/plain" id="myEditor" style="width:660px;height:240px;">
														</div>
													</td>
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
			var flag = true;
			function reGood(o) {
				var goodid = $(o).parent().prev().prev().prev().prev().prev().html();
				$.post("<?php echo U('Admin/Good/getgoodid');?>",{"id":goodid},function(data){
					var json = eval(data);
					
					$('select[name="addmenuid"]').val(json.menu_id);
					$('input[name="addname"]').val(json.name);
					$('input[name="addprice"]').val(json.price);
					$('input[name="add_old_price"]').val(json.old_price);
					$('input[name="addsort"]').val(json.sort);
					$('select[name="addstatus"]').val(json.status);
					$('#myEditor').html(json.detail);
					// alert(json.detail);
					
					if (flag) {
						$('input[name="addname"]').parent().append('<input type="hidden" name="goodid" value="'+json.id+'">');
						$('input[name="addimage"]').parent().append('<img src="/wemall2.3.1/Public'+json.savepath+json.image+'" id="goodimage" style="max-width:650px" class="img-thumbnail">');
						flag = false;
					}else{
						$('input[name="goodid"]').val(json.id);
						$('#goodimage').attr("src","/wemall2.3.1/Public"+json.savepath+json.image);
					}
				});
				$('#myTab li').removeClass("active");
				$('#myTab li').eq(1).addClass("active");
				$('#home1').removeClass("active");
				$('#home2').addClass("active");
			}
		</script>
		<script type="text/javascript">
	    //实例化编辑器
	    var um = UM.getEditor('myEditor');
	    um.addListener('blur',function(){
	        $('#focush2').html('编辑器失去焦点了')
	    });
	    um.addListener('focus',function(){
	        $('#focush2').html('')
	    });
	</script>
	</div>
</div>