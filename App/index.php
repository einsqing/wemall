<?php include 'config.php';?>
<?php 
	$sql = "select * from ".DB_PREFIX."nav";
	$query = mysql_query($sql);
	while (!!$row = mysql_fetch_array($query, MYSQL_ASSOC)) {
		switch ($row[id]) {
			case 1:
				$menuone = $row[value];;
				break;
			case 2:
				$menutwo = $row[value];;
				break;
			case 3:
				$menuthree = $row[value];;
				break;
			case 4:
				$menufour = $row[value];;
				break;
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta name="viewport"
	content="width=100%; initial-scale=1; maximum-scale=1; minimum-scale=1; user-scalable=no;">
<meta name="apple-mobile-web-app-capable" content="yes">
<title>WeMall微信商城</title>
<script type="text/javascript" src="static/js/jquery-1.7.2.min.js"></script>
<!-- <script src="//code.jquery.com/jquery-1.11.0.min.js"></script> -->
<script type="text/javascript" src="static/js/cookie.js"></script>
<script type="text/javascript" src="static/js/alert.js"></script>
<script type="text/javascript" src="static/js/wemall.js"></script>
<link rel="stylesheet" href="static/css/style.css">
</head>

<body>
	<div class="main-container">
		<div id="menu-container" class="container" style="display: block;">
			<div class="header" id="home-header">
				<div class="types">
					<ul id="menuItemList">
						<li index="1" class="menuItem"><?php echo $menuone;?></li>
						<li index="2" class="menuItem active"><?php echo $menutwo;?></li>
						<li index="3" class="menuItem"><?php echo $menuthree;?></li>
						<li index="4" class="menuItem"><?php echo $menufour;?></li>
					</ul>
				</div>
			</div>
 			<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  ...
</nav>
			<div class="marquee" style="height: 0">
				<marquee class="none" id="marquee-content">8月20日-9月20日期间凡单次消费满30元可获赠体验虫草鸡蛋2个（一人限一次）</marquee>
			</div>
			<div id="mainList" class="main">
				<div id="itemsList" class="items">
					<!-- 插入商品列表 -->
				<?php 
					$sql = "select * from ".DB_PREFIX."menu";
					$query = mysql_query($sql) or die('SQL 错误！');
					while ($row = mysql_fetch_array ( $query , MYSQL_ASSOC )) {
					?>
					<div class="item" id="wecart_<?php echo $row['cate_id'].$row['id'].'_'.$row['price'];?>"><div class="item-title" title="<?php echo $row['title'];?>"><?php echo $row['title'];?></div><div class="item-image"><img src="./static/images/ajax-loader.gif"></div><div class="single-item-info"><div class="item-cost"><span><s>￥<?php echo $row['old_price'];?></s></span></div><div class="item-price"><span class="hotspot">今日特价：￥<?php echo $row['price'];?></span></div><div class="item-detail"><a href="javascript:void(0);">点击进入详情</a><img src="./static/images/greentri@2x.png" alt="<?php echo $row['detail'];?>"></div></div><div class="select-shadow"><div><img src="./static/images/check.png" alt="selected"><span>已选</span></div></div></div>
				<?php } ?>
				
				</div>
			</div>
			<div class="backToTop">
				<a href="javascript:scroll(0,0)"><font color="#833030">回到顶部</font></a>
			</div>
			<div id="page_tag_load">
				<img src="./static/images/ajax-loader.gif" alt="loader">
			</div>
			<div class="toolbar" style="left: 0;">
				<a class="mybtn" id="before-submit" href="javascript:void(0);"
					hidefocus="true">请先选单</a>
				<a class="user" href="javascript:void(0);" hidefocus="true">
					<img src="./static/images/user.png" alt="user">
				</a>
			</div>
			<div>
				<div class="shopping-cart mybtn" id="click_cart">
					<span
						style="display: block; font-size: 18px; line-height: 37px; height: 16px;">点击下单</span>
				</div>
			</div>
		</div>
		
		<div id="itemsdetail-container" class="container" style="display:none;">
		        <div class="header" id="detail-header" style="display: block;">
		            <span class="single-name"></span>
		        </div>
		        <div class="detail">
		            <div class="detail-image">
		                <img src="">
		            </div>
		            <div class="button-group">
		                <button class="addItem btn btn-success">加入购物车</button>
		            </div>
		            <div class="detail-content">
		                <ul>		              
		                    <li></li>
		                    <li></li>
		                </ul>
		            </div>
		            <div class="done">
		                <img src="./static/images/car2@2x.png">
		                <span>成功放入购物车</span>
		            </div>
		            <div class="divider"></div>
		            <div class="backToTop"><a href="javascript:scroll(0,0)"><font color="#833030">回到顶部</font></a></div>
		        </div>
		        <div class="toolbar">
		            <a class="back" id="detailback" href="javascript:void(0);">
		                <img src="./static/images/back.png">
		            </a>
		            <a class="user" href="javascript:void(0);"><img src="./static/images/user.png"></a>
		        </div>
		    <div>
		        <div class="shopping-cart mybtn" id="shopping-cart-mybtn-detail">
		            <span style="display: block; font-size: 18px; line-height: 37px; height: 16px;">继续选购</span>
		        </div>
		    </div>
		</div>

		<div id="order-container" class="container" style="display: none;">
			<div class="confirmation-form">
				<div class="confirmation-header">
					<span>订单确认</span>
				</div>
				<div class="confirmation-list" id="item-list">
					<div class="dotted-divider"
						style="width: 105.263157894737%; margin-left: -2.9%"></div>
					<ul>
						<!-- 插入订单条目视图 -->
					</ul>
					<div class="total-info">
						<span>
							运费：
							<span class="items-total-amount">0.00</span>
							元，共
							<span class="items-total-price">0.00</span>
							元
						</span>
					</div>
				</div>
			</div>

			<div class="toolbar">
				<a class="back" href="javascript:void(0);">
					<img src="./static/images/back.png">
				</a>
				<a class="next mybtn" href="javascript:void(0);">
					<span style="display: block; height: 39px; font-size: 1.2em;">下一步</span>
				</a>
				<a class="user" href="javascript:void(0);">
					<img src="./static/images/user.png">
				</a>
			</div>
		</div>

		<div id="delivery-container" class="container" style="display: none;">
			<div class="confirmation-form">
				<div class="confirmation-header">
					<span>信息</span>
					<div class="dotted-divider"></div>
				</div>
				<?php
					$sqluser = "SELECT * FROM ".DB_PREFIX."orders where uid='$_GET[uid]' ORDER BY id DESC";
					@$resultuser = mysql_query ( $sqluser );
					$rowuser = mysql_fetch_array ( $resultuser );
					?>
				<form class="delivery-info">
					<table class="form_table">
						<tbody>
							<tr>
								<td class="td_left">姓名：</td>
								<td class="td_right">
									<input type="text" name="username" id="username"
										placeholder="务必使用真实姓名" value="<?php echo $rowuser['username'];?>" required="">
								</td>
							</tr>
							<tr>
								<td class="td_left">手机：</td>
								<td class="td_right">
									<input type="text" name="tel" id="tel" placeholder="请输入手机号"
										value="<?php echo $rowuser['mobile'];?>" required="">
								</td>
							</tr>

							<tr>
								<td class="td_left">地址：</td>
								<td class="td_right">
									<input type="text" name="address" id="address"
										placeholder="请输入详细地址" value="<?php echo $rowuser['address'];?>" required="">
								</td>
							</tr>

							<tr>
								<td class="td_left">备注：</td>
								<td class="td_right">
									<input type="text" name="note" id="note" placeholder="选填">
								</td>
							</tr>

							<tr>
								<td class="td_left">温馨提示：</td>
								<td class="td_right">QQ:786699892</td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
			<div class="payment">
				<span>支付方式：</span>
				<div>
					<span class="line" id="balance-payment">
						<span class="radio"></span>
						<span class="label">余额支付</span>
					</span>
					<span class="line" id="wechat-payment">
						<span class="radio"></span>
						<span class="label">微信支付</span>
					</span>
					<span class="line" id="alipay-payment">
						<span class="radio"></span>
						<span class="label">支付宝支付</span>
					</span>
					<span class="line" id="cool-payment">
						<span class="radio selected"
							style="background-image: url(./static/images/select.png); background-position: -1px -1px;"></span>
						<span class="label">货到付款</span>
					</span>
				</div>
			</div>

			<div class="toolbar">
				<a class="back" id="backsubmit" href="javascript:void(0);">
					<img src="./static/images/back.png">
				</a>
				<a id="submitOrderBtn" class="next mybtn" href="javascript:void(0);">
					<span style="display: block; height: 39px; font-size: 1.2em;">提交订单</span>
				</a>
				<a class="user" href="javascript:void(0);">
					<img src="./static/images/user.png">
				</a>
			</div>
		</div>

		<div id="myOrders-container" class="container" style="display:none">
			<div class="my-order-header">
				<span>我的订单</span>
				<div class="dotted-divider"></div>
			</div>

			<div class="myOrderList">
				<div>
					<div class="orderResult-form">
						<!-- 插入历史订单 -->
					</div>
				</div>
			</div>

			<div class="history-loader">
				<img src="./static/images/timer.png">
				<span>点击查看历史订单</span>
			</div>

			<div class="toolbar">
				<a class="next mybtn" id="reindex" href="javascript:void(0);">
					<span style="display: block; height: 39px; font-size: 1.2em;">我要订购</span>
				</a>
				<a class="user" style="display: none" href="javascript:void(0);">
					<img src="./static/images/user.png">
				</a>
			</div>
		</div>
	</div>
</body>
</html>
