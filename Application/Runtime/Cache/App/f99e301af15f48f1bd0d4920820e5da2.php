<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($info["name"]); ?></title>
<meta name="viewport"
	content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="../Public/Static/css/foods.css" rel="stylesheet"
	type="text/css">
<script type="text/javascript" src="../Public/Static/js/jquery.min.js"></script>
<script type="text/javascript" src="../Public/Static/js/wemall.js"></script>
<script type="text/javascript" src="../Public/Static/js/alert.js"></script>
<script type="text/javascript">
var appurl = '/kaiyuanshengji/index.php';
var rooturl = '/kaiyuanshengji';
</script>
</head>
<body class="sanckbg mode_webapp">
	<div id="menu-container" style="display: block;">
		<div class="menu_header">
			<div class="menu_topbar">
				<div id="menu" class="sort sort_on">
					<a href=""><?php echo ($info["name"]); ?></a>
					<ul>
						<?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menuid): $mod = ($i % 2 );++$i;?><li><a href="javascript:showProducts('<?php echo ($menuid["id"]); ?>')"><?php echo ($menuid["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
						<li><a href="javascript:showAll()">所有商品</a></li>
					</ul>
				</div>
				<a class="head_btn_right" href="javascript:showMenu();"><i
					class="menu_header_home"></i> </a>
			</div>
		</div>

		<div class="gonggao">
			<div class="hot">
				<strong>公告</strong>
			</div>
			<div class="content"><?php echo ($info["notification"]); ?></div>
		</div>

		<section class="menu">
			<section class="list listimg">
				<dl>
					<dt>菜单</dt>
					<div class="ccbg">
						<?php if(is_array($goods)): $i = 0; $__LIST__ = $goods;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$goodsvo): $mod = ($i % 2 );++$i;?><dd menu="<?php echo ($goodsvo["menu_id"]); ?>">
							<div class="tupian">
								<img src="/kaiyuanshengji/Public/Uploads/<?php echo ($goodsvo["image"]); ?>"
									onclick="showDetail('<?php echo ($goodsvo["id"]); ?>');"> <a
									href="javascript:doProduct('<?php echo ($goodsvo["id"]); ?>','<?php echo ($goodsvo["name"]); ?>','<?php echo ($goodsvo["price"]); ?>');" class="add"><p
										class="dish2"><?php echo ($goodsvo["name"]); ?></p>
									<p class="price2"><?php echo ($goodsvo["price"]); ?>元/份</p>
									<p>
										<del><?php echo ($goodsvo["old_price"]); ?>元/份</del>
									</p></a>
							</div>
							<a href="javascript:doProduct('<?php echo ($goodsvo["id"]); ?>','<?php echo ($goodsvo["name"]); ?>','<?php echo ($goodsvo["price"]); ?>');" id="<?php echo ($goodsvo["id"]); ?>" class="reduce" style="display: block;"><b class="ico_reduce">减一份</b></a>
						</dd><?php endforeach; endif; else: echo "" ;endif; ?>
					</div>
				</dl>
			</section>

			<div id="mcover" onclick="document.getElementById('mcover').style.display='';">
				<div id="Popup" style="display: block;">
					<div class="imgPopup">
						<img id="detailpic" src="">
						<h3 id="detailtitle"></h3>
						<p class="jianjie" id="detailinfo"></p>
					</div>
				</div>
				<a class="close" onclick="document.getElementById('mcover').style.display='';">X</a>
			</div>

		</section>
	</div>

	<div id="cart-container" style="display: none;">
		<div class="menu_header">
			<div class="menu_topbar">
				<div id="menu" class="sort">
					<a href="">购物车</a>
				</div>
			</div>
		</div>

		<section class="order">
			<div class="orderlist">

				<ul id="ullist">
					<dt>已选购的</dt>
				</ul>
				
				<ul id="cartinfo">
					<dt>购物车总计</dt>
					<li class="ccbg2" id="emptyLii">已选：<span id="totalNum">0</span>份　共计：￥<span id="totalPrice">0</span>元</li>
				</ul>
				<div class="twobtn">
					<div class="footerbtn">
						<a class="del right3" href="javascript:home();">选购</a>
					</div>
					<div class="footerbtn">
						<a class="submit left3" onclick="clearCache()">清空</a>
					</div>
					<div class="clr"></div>
				</div>
			</div>

			<form name="infoForm" id="infoForm" method="post" action="">
				<div class="contact-info">
					<ul>
						<li class="title">联系信息</li>
						<li>
							<table style="padding: 0; margin: 0; width: 100%;">
								<tbody>
									<tr>
										<td width="80px"><label for="name" class="ui-input-text">联系人：</label></td>
										<td>
											<div class="ui-input-text">
												<input id="name" name="name" placeholder="" value="<?php echo ($users["username"]); ?>" type="text"
													class="ui-input-text">
											</div></td>
									</tr>

									<tr>
										<td width="80px"><label for="phone" class="ui-input-text">联系电话：</label></td>
										<td>
											<div class="ui-input-text">
												<input id="phone" name="phone" placeholder="" value="<?php echo ($users["phone"]); ?>" type="tel"
													class="ui-input-text">
											</div>
										</td>
									</tr>
									<tr>
										<td width="80px"><label for="pay" class="ui-input-text">支付方式：</label></td>
										<td colspan="2"><select name="pay" class="selectstyle"
											id="select1">
												<option value="0">货到付款</option>
												<?php if($alipay == 1): ?><option value="1">支付宝在线支付</option><?php endif; ?>
												<option value="2">微信支付</option>
										</select></td>
									</tr>
									<tr>
										<td width="80px"><label for="address"
											class="ui-input-text">地址：</label></td>
										<td><textarea id="address" name="address" placeholder=""
												value="" class="ui-input-text"><?php echo ($users["address"]); ?></textarea>
										</td>
									</tr>
									<tr>
										<td width="80px"><label for="note" class="ui-input-text">备注：</label></td>
										<td><textarea name="note" placeholder=""
												class="ui-input-text"></textarea></td>
									</tr>
								</tbody>
							</table>

							<div class="footReturn">
								<a id="showcard" class="submit" href="javascript:submitOrder();">确定提交</a>
							</div>

						</li>
					</ul>
				</div>
			</form>
		</section>

		<!-- 正在提交数据 -->
		<div id="menu-shadow" hidefocus="true"
			style="display: none; z-index: 10;">
			<div class="btn-group"
				style="position: fixed; font-size: 12px; width: 220px; bottom: 80px; left: 50%; margin-left: -110px; z-index: 999;">
				<div class="del" style="font-size: 14px;">
					<img src="../Public/Static/images/ajax-loader.gif" alt="loader">正在提交订单...
				</div>
			</div>
		</div>

	</div>

	<div id="user-container" style="display: none;">

		<div class="menu_header">
			<div class="menu_topbar">
				<div id="menu" class="sort ">
					<a href="">查看我的订单</a>
				</div>
			</div>
		</div>

		<div class="cardexplain">
			<div id="page_tag_load" hidefocus="true"
				style="display: none; z-index: 10;">
				<div class="btn-group"
					style="position: fixed; font-size: 12px; width: 220px; bottom: 80px; left: 50%; margin-left: -110px; z-index: 999;">
					<div class="del" style="font-size: 14px;">
						<img src="../Public/Static/images/ajax-loader.gif" alt="loader">正在获取订单...
					</div>
				</div>
			</div>

			<ul class="round">
				<table width="100%" border="0" cellpadding="0" cellspacing="0" class="cpbiaoge">
					<tr>
						<th>订单编号</th>
						<th class="cc">订单金额</th>
						<th class="cc">支付状态</th>
						<th class="cc">发货状态</th>
					</tr>
					<tbody id="orderlistinsert">
						<!--插入订单ul-->
					</tbody>
				</table>
			</ul>
		</div>
	</div>

	<div class="footermenu">
		<ul>
			<li id="home"><a class="active" href="javascript:void(0);"> <img
					src="../Public/Static/images/home.png">
					<p>首页</p>
			</a></li>

			<li id="cart"><a href="javascript:void(0);"> <span class="num" id="cartN2">0</span> <img
					src="../Public/Static/images/cart.png">
					<p>购物车</p>
			</a></li>
			<li id="user"><a href="javascript:void(0);"> <img src="../Public/Static/images/user.png">
					<p>我的</p>
			</a></li>
		</ul>
	</div>
</body>
</html>