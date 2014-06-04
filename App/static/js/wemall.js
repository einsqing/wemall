$(document).ready(function(){
	document.addEventListener('WeixinJSBridgeReady', function onBridgeReady() {
		WeixinJSBridge.call('hideOptionMenu');
	});
	
	uid = $_GET['uid'];
//	$('#page_tag_load').show();
	
	$('#menuItemList li').on('click',function () {
        $.each($('#menuItemList li') , function(){
        	if($(this).attr('class') == 'menuItem active'){
        		$(this).attr('class','menuItem')
        	}
        	 $.each( $('#itemsList').find('.item') , function(){
             		$(this).show();
             });
        });
        
        $(this).addClass('active');
        
        var index = $(this).attr('index');
        
        $.each( $('#itemsList').find('.item') , function(){
        	if($(this).attr('id').charAt(7) !== index)	{
        		$(this).hide();
        	}
        });
	});
	
	$('#menuItemList li[index=1]').click(); 
	cookie_match();
	
	$.ajax({
    	type : 'POST',
    	url : 'fetch_index.php',
    	
    	success : function (response, stutas, xhr) {
    		var json = $.parseJSON(response);
    		
    		$.each(json, function (index, value) {
    			$( '#wecart_'+value.cate_id + value.id +'_'+ value.price ).find('.item-image img').attr('style' , 'width: 100%; height: 110px; margin-top: 0px;' );
    			$( '#wecart_'+value.cate_id + value.id +'_'+ value.price ).find('.item-image img').attr('src' , '../Public/Uploads/'+value.img );
			});
    	}
	});
	
	$.each($('.item-detail') , function(){
		$(this).off().on('click',function(){
			$('#menu-container').hide();
			$('#delivery-container').hide();
			$('#myOrders-container').hide();
			$('#order-container').hide();
			$('#itemsdetail-container').show();
			$('.done').hide();
			
			var title = $(this).parent().parent().find('.item-title').html();
			var price = $(this).prev().find('.hotspot').html().match(/[0-9]+.?[0-9]?/ig);
			var img = $(this).parent().prev().find('img').attr('src');
			var detail = $(this).find('img').attr('alt');
			var cookieid = $(this).parent().parent().attr('id');
			
			$('.single-name').html(title);
			$('.single-name').attr('alt' , cookieid);
			$('.detail-image img').attr('src',img);
			$('.detail-content ul li:first').html('价格： '+ price +'元');
			$('.detail-content ul li:last').html(detail);
			
			$('#shopping-cart-mybtn-detail').hide();
			if(getCookie( $(this).parent().parent().attr('id'))){
				$('#shopping-cart-mybtn-detail').show();
				$('#shopping-cart-mybtn-detail span').off().on('click',function(){
        			$('#delivery-container').hide();
        			$('#myOrders-container').hide();
        			$('#order-container').hide();
        			$('#itemsdetail-container').hide();
        			$('#menu-container').show();
        			
        			cookie_match();
				});
			}
		});
		$('#detailback').off().on('click', function(){
			$(this).parent().prev().find('.done').hide();
			$('#delivery-container').hide();
			$('#myOrders-container').hide();
			$('#order-container').hide();
			$('#itemsdetail-container').hide();
			$('#menu-container').show();
			
			cookie_match();
		});
		
		$('.addItem.btn.btn-success').off().on('click',function(){
			$(this).parent().nextAll('.done').show(100).delay(600);
			addCookie($(this).parent().parent().prev().find('.single-name').attr('alt') , $(this).parent().parent().prev().find('.single-name').html());
			$(this).parent().nextAll('.done').hide(100);
			
			$('#shopping-cart-mybtn-detail').show();
			$('#shopping-cart-mybtn-detail span').off().on('click',function(){
				
				$(this).parent().parent().prevAll('.detail').find('.done').hide();
				
    			$('#delivery-container').hide();
    			$('#myOrders-container').hide();
    			$('#order-container').hide();
    			$('#itemsdetail-container').hide();
    			$('#menu-container').show();
    			
    			cookie_match();
			});
		});
	});
	
	//没有点击li下也能选择商品
	$.each($('.item-image img'),function(){
		$(this).parent().parent().find('.select-shadow').off().on('click',function(){
			$(this).parent().find('.select-shadow').hide();
			delCookie($(this).prevAll('.item-title').parent().attr('id'));
			if(!document.cookie.match(/wecart_[0-9]+/ig)){
				$('#click_cart').hide();
			}
		});
		
		$(this).off().on('click',function(){
			$(this).parent().parent().find('.select-shadow').show();
			addCookie($(this).parent().prev().parent().attr('id'),$(this).parent().prev().attr('title'));
			$('#click_cart').show();
		});
	});
	//没有点击li也能点击click_cart
	$('#click_cart').off().on('click',function(){
    	$('#menu-container').hide(); 		        		
		$('#delivery-container').hide();
		$('#myOrders-container').hide();
		$('#itemsdetail-container').hide();
		$('#order-container').show();
		
		var html = '';
		var totalprice = 0;
		var cookieArray = document.cookie.split("; "); // 得到分割的cookie名值对
		for ( var i = 0; i < cookieArray.length; i++) {
			var arr = cookieArray[i].split("="); // 将名和值分开
			if(arr[0].indexOf('wecart') >= 0){
				var att = arr[0].split('_');
				totalprice += parseFloat( att[2] );
				html += '<li><div class="confirmation-item"><div class="item-info"><span class="item-name" title="'+ arr[0] +'">'+ getCookie(arr[0]) +'<br></span><span class="item-price-info"><span><span class="item-total-price">￥'+ att[2] +'</span></span></span></div><div class="select-box"><span class="minus">—</span><input class="amount" type="text" name="amount" value="1" autocomplete="off" readonly=""><span class="add">+</span></div><div class="delete"><a class="delete-btn" href="javascript:void(0);"><img src="./static/images/delete.png"></a></div></div><div class="divider"></div></li>';
			}
		}
		$('#item-list').find('ul').empty();
		$('#item-list').find('ul').append(html);
		$('.items-total-price').html(totalprice);
		
		$('.back').off().on('click',function(){
			$.each($('#itemsList .item .item-title'),function(){
				$(this).nextAll('.select-shadow').hide();
			});
			
			$('#delivery-container').hide();
			$('#myOrders-container').hide();
			$('#itemsdetail-container').hide();
			$('#order-container').hide();
			$('#menu-container').show();
			
			cookie_match();
			return false;
		});
		
		
		$('.add').off().on('click',function(){
			var addnum = parseInt($(this).prev().attr('value')) + 1;
			$(this).prev().attr('value',addnum);
			
			var singprice = ($(this).parent().prev().find('.item-price-info').find('.item-total-price').html()).match(/[0-9]+.?[0-9]?/ig);
			var totalprice_add = parseFloat($('.items-total-price').html()) + parseFloat(singprice);

			$('.items-total-price').html(totalprice_add);
			
			return false;
		});
		
		$('.minus').on('click',function(){
			var minusnum = parseInt($(this).next().attr('value')) - 1;
			$(this).next().attr('value',minusnum);
			
			if(minusnum <= 0){
				$(this).parent().parent().parent().remove();
				delCookie($(this).parent().prev().find('.item-name').attr('title'));
			}
			if($('#item-list ul').find('li').length == 0){
				$('#order-container').hide();
				$('#menu-container').show();
				
				cookie_match();
			}
			var singprice = ($(this).parent().prev().find('.item-price-info').find('.item-total-price').html()).match(/[0-9]+.?[0-9]?/ig);
			var totalprice_add = parseFloat($('.items-total-price').html()) - parseFloat(singprice);

			$('.items-total-price').html(totalprice_add);
			
			return false;   		        			
		});
		
		$('.delete .delete-btn img').on('click',function(){
			$(this).parent().parent().parent().parent().remove();
			delCookie($(this).parent().parent().prevAll('.item-info').find('.item-name').attr('title'));
			
			var singprice = ($(this).parent().parent().prevAll('.item-info').find('.item-price-info').find('.item-total-price').html()).match(/[0-9]+.?[0-9]?/ig);
			var singnum = $(this).parent().parent().prev().find('.amount').attr('value');
			var totalprice_del_img = parseFloat($('.items-total-price').html()) - parseFloat(singprice * singnum);
			$('.items-total-price').html(totalprice_del_img);
			
			if($('#item-list ul').find('li').length == 0){
				$('#order-container').hide();
				$('#menu-container').show();
				
				cookie_match();
			}
			return false;    		        			
		});
		
		$('.next.mybtn').off().on('click',function(){
			$('#order-container').hide();
			$('#menu-container').hide();
			$('#myOrders-container').hide();
			$('#itemsdetail-container').hide();
			$('#delivery-container').show();
			
			return false;    		        			
		});
		$('#backsubmit').off().on('click',function(){
			$('#menu-container').hide(); 		        		
			$('#delivery-container').hide();
			$('#myOrders-container').hide();
			$('#itemsdetail-container').hide();
			$('#order-container').show();
			    		        			
			return false; 
		});
		$('#submitOrderBtn').off().on('click',function(){
			var cartdata = '';
			for ($i = 0; $i < $('#item-list ul li').length; $i++) {
				var nameready = $('#item-list ul li:eq('+ $i +')').find('.item-info').find('.item-name').html().replace(/\<\/?br\>/ig,'');
				var numready = $('#item-list ul li:eq('+ $i +')').find('.select-box').find('input').attr('value');
				var priceready = $('#item-list ul li:eq('+ $i +')').find('.item-info').find('.item-price-info').find('.item-total-price').html().match(/[0-9]+.?[0-9]?/ig);
				var cartdataready = '{'+'"name":'+'"'+nameready+'"'+',"num":'+'"'+numready +'"'+',"price":'+'"'+priceready+'"'+'}';
				cartdata = cartdataready +','+cartdata;
			}
			cartdata = cartdata.substring(0,cartdata.length-1);
			
			if(document.cookie.match(/wecart/ig)){
    			$.ajax({
    				type : 'POST',
		        	url : 'submit_post.php',
		        	data : {
		        		uid : uid,
		        		userdata : $('form').serializeArray(),
		        		cartdata : '['+cartdata+']',
		        		totalprice : $('.items-total-price').html()
		        	},
		        	
		        	success : function (response, stutas, xhr) {
		        		if( response == '0'){
		        			alert('下单成功！');
		        			clearCookie();	
		        			$('.user').click();	
		        		}else{
		        			alert('请认真核对信息！');
		        		}
		        	},
		        	beforeSend : function(){
		        		$('#page_tag_load').show();
		        	},
		        	complete : function(){
		        		$('#page_tag_load').hide();
		        	}
    			});
			}//判断是否有cookie，如果执行一次之后，cookie就被清空了，所以不会执行第二次。

			return false;
		});
    });
	$('.user').on('click',function(){
		$('#delivery-container').hide();
		$('#order-container').hide();
		$('#menu-container').hide();
		$('#itemsdetail-container').hide();
		$('#myOrders-container').show();
		
		$('#reindex').off().on('click',function(){
			$('#myOrders-container').hide();
			$('#delivery-container').hide();
			$('#order-container').hide();
			$('#itemsdetail-container').hide();
			cookie_match();	
			$('#menu-container').show();
			
			return false;
		});
		
		$.ajax({
			type : 'POST',
			url : 'fetch_user.php', 		    		        				
			data : {
				uid : uid
			},
			
			success : function (response , stutas , xhr){
				var json = $.parseJSON(response);
				
				var htmltitle = '';
				var htmlcenter = '';
				var htmlbottom = '';
				$('.orderResult-form').empty();
					
				$.each(json , function(i , valuei){
					$.each(valuei.menu , function(j , valuej){
						htmltitle='<div><div class="order-header"><span class="order-status">订单编号：<span class="status">'+ valuei.orderid +'</span></span></div><div class="orderResult-list" id="items-order-result"><div class="order-info"><span>订单状态：<span id="order-no">'+ valuei.status +'-'+valuei.pay_status+'</span></span><span class="date" style="float: right"></span></div><div class="order-list" id="item-order-list"><ul>';
						htmlcenter+='<li><span class="order-item-name">'+ valuej.title +'</span><span class="order-item-price">￥'+ valuej.price +'</span><span class="order-item-amount">'+ valuej.quantity +'份</span></li>';
						htmlbottom='</ul></div><div class="divider"></div><div class="total-info"><span>运费：<span>0.00</span>元，共<span>'+ valuei.totalprice +'</span>元</span><a class="btn dail-small">拨打电话催一催</a></div></div></div>';
					});
					$('.orderResult-form').append(htmltitle + htmlcenter +htmlbottom);
					htmltitle = '';
					htmlcenter = '';
					htmlbottom = '';
				});
			},
			beforeSend : function(){
        		$('#page_tag_load').show();
        	},
        	complete : function(){
        		$('#page_tag_load').hide();
        	}
		});
		return false;		
	});

});

function cookie_match(){
	$.each($('#itemsList .item .item-title'),function(){
		$(this).nextAll('.select-shadow').hide();
	});
	$('#click_cart').hide();
	
	if(document.cookie.match(/wecart_[1-9]+/ig)){
		$('#click_cart').show();
		var cookieArray = document.cookie.split("; "); // 得到分割的cookie名值对
		for ( var i = 0; i < cookieArray.length; i++) {
			var arr = cookieArray[i].split("="); // 将名和值分开
			if(arr[0].indexOf('wecart') >= 0){
				$('#'+ arr[0]).find('.select-shadow').show();
			}
		}
	}
}
var $_GET = (function(){
	var url = window.document.location.href.toString();
	var u = url.split("?");
	if(typeof(u[1]) == "string"){
		u = u[1].split("&");
		var get = {};
		for(var i in u){
			var j = u[i].split("=");
			get[j[0]] = j[1];
		}
		return get;
	} else {
		return {};
	}
})();