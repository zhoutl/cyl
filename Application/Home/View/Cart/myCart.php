<?php W('Home/head',array('seo_data'=>$seo_data));?>
<!--wrap-->
    <div class="thewidth100 bg_gray clearfix"> 
        <div  class="thewidth">
            <div class="width payheight">
                <div class="f_l font-20 mt15"><b>购物车</b></div>
                <div class="shoptop">
                    <ul>
                        <li>
                        <div class="password1-line password1-line2"></div>
                        <div class="center pasxz"><p class="password1-first current1">1</p><p class="blue">购物车</p></div>
                    </li>
                    <li>
                        <div class="password1-line"></div>
                        <div class="center pasxz"><p class="password1-first">2</p><p class="c999">订单信息</p></div>
                    </li>
                    <li>
                        <div class="password1-line"></div>
                        <div class="center pasxz"><p class="password1-first">3</p><p class="c999">确认支付</p></div>
                    </li>
                    </ul>
                </div>
            </div>
			
			<?php if(!empty($data['cart_list'])){ ?>
				<form action="<?php echo U('Order/confirmOrder'); ?>" method="post">
				<!-- shopcar -->
				<div class="shopbox mt40">
					<table class="jftable center f_l font-12 order-form pj shoptable" cellpadding="0">
						<thead>
							<tr>
								<th class="wb10">&nbsp;</th>
								<th class="wb35">商品信息</th>
								<th class="wb15">单价</th>
								<th class="wb15">数量</th>
								<th class="wb10">小计</th>
								<th class="wb15">操作</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data['cart_list'] as $k=>$v){ ?>
								<?php if(is_numeric($k)): ?>
								<tr id="shopping_cart_<?php echo $v['shopping_cart_id']; ?>">
									<td class="wb10"><input type="checkbox" checked name="shopping_cart_id[]" value="<?php echo $v['shopping_cart_id']; ?>" id="checkbox_<?php echo $v['shopping_cart_id']; ?>" onclick="chooseCart(this,'<?php echo $v['shopping_cart_id']; ?>');" /></td>
									<td class="wb35">
										<div class="order-pic img100 mt10">
											<?php if(!empty($v['img_uri'])){ ?>
											   <img src="<?php echo $v['img_uri'] ?>" width="73" height="73" />
											<?php }else{ ?>
												<img src="/Public/upload/watermark.jpg" width="73" height="73" />
											<?php } ?>
										</div>
										<div class="order-text2 ml10 mt10">
											<div class="width"><?php echo $v['name']; ?></div>
											<?php if($v['has_sale']): ?>
												<br><span class="f_l preferential font-12 mt10">特惠</span>
											<?php endif; ?>
										</div>
									</td>
									<td class="wb15">¥<span id="one_price_<?php echo $v['shopping_cart_id']; ?>"><?php echo $v['online_price']; ?></span></td>
									<td class="wb15">
										<div class="wan-spinner wan-spinner-2"> 
										   <a href="javascript:void(0)" class="minus" onclick="change_num(this,'<?php echo $v['shopping_cart_id']; ?>',1);">-</a>
										   <input type="text" id="num_text_<?php echo $v['shopping_cart_id']; ?>" readonly value="<?php echo $v['num']; ?>" class="num_text w40">
										   <a href="javascript:void(0)" class="plus" onclick="change_num(this,'<?php echo $v['shopping_cart_id']; ?>',2);">+</a> 
										</div>
									</td>
									<td class="wb10">¥<span id="all_price_<?php echo $v['shopping_cart_id']; ?>"><?php echo number_format($v['online_price']*$v['num'],2,'.',''); ?><span></td>
									<td class="wb15">
										<a href="javascript:;" onclick="addCollect('<?php echo $v['item_id']; ?>')">收藏</a><br>
										<a href="javascript:;" onclick="delCart('<?php echo $v['shopping_cart_id']; ?>');">删除</a>
									</td>
								</tr>
								<?php endif; ?>
							<?php } ?>
						</tbody>
					</table>
					<div class="account f_l mt15">
						<a href="javascript:;" onclick="delMyCart();" class="goonshop mt15 f_l" style="color:blue;">清空购物车</a>
						<a href="<?php echo U('Index/index'); ?>" class="f_l ml10 mt15 goonshop" style="color:red;">继续购物</a>
						<input class="qjs f_r" type="submit" value="去结算" />
						<span class="f_r mr10">已选商品 <em class="font-20 red" id="all_num"><?php echo $data['cart_list']['count_info']['all_num']; ?></em> 件&nbsp;&nbsp;合计(不含运费)：<em class="font-20 red">¥<span id="all_online_price"><?php echo $data['cart_list']['count_info']['all_online_price']; ?></span></em></span>
					</div>

				</div>
				</form>
			<?php }else{ ?>
				<div class="shopbox mt40 center">
					<table class="jftable center f_l font-12 order-form pj shoptable" cellpadding="0">
						<thead>
							<tr>
								<th class="wb10">&nbsp;</th>
								<th class="wb35">商品信息</th>
								<th class="wb15">单价</th>
								<th class="wb15">数量</th>
								<th class="wb10">小计</th>
								<th class="wb15">操作</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td colspan="6" class="font-18 mt15" style="padding:15px 0px !important;">购物车内暂无商品</td>
							</tr>
						</tbody>
					</table>
					<div class="account f_l mt15">
						<a href="<?php echo U('Index/index'); ?>" class="f_l mt15 goonshop">继续购物</a>
						<input class="qjs f_r" type="button" value="去结算" />
						<span class="f_r mr10">已选商品 <em class="font-20 red">0</em> 件&nbsp;&nbsp;商品总价¥0.00&nbsp;&nbsp;合计(不含运费)：<em class="font-20 red">¥0.00</em></span>
					</div>
				</div>
			<?php } ?>
			
            <!-- 你可能会喜欢 -->
            <div class="like mt15">
                <div class="like-top">
                    <span class="f_l font-20">你可能会喜欢</span>
                </div>
                <div class="pic_con">
                    <div class="pic_content">
                        <div class="pic_lists mp">
                            <ul>
                                <li>
                                    <a href="#"><img src="__PUBLIC__/Home/images/user/shopcar_03.jpg"/></a>
                                    <p>衡水老白干 67度750ml*2瓶 ......</p>
                                    <p class="center red">￥<b class="font-20">199</b><b>.00</b></p>
                                </li>
                                <li>
                                    <a href="#"><img src="__PUBLIC__/Home/images/user/shopcar_03.jpg"/></a>
                                    <p>衡水老白干 67度750ml*2瓶 ......</p>
                                    <p class="center red">￥<b class="font-20">199</b><b>.00</b></p>
                                </li>
                                <li>
                                    <a href="#"><img src="__PUBLIC__/Home/images/user/shopcar_03.jpg"/></a>
                                    <p>衡水老白干 67度750ml*2瓶 ......</p>
                                    <p class="center red">￥<b class="font-20">199</b><b>.00</b></p>
                                </li>
                                <li>
                                    <a href="#"><img src="__PUBLIC__/Home/images/user/shopcar_03.jpg"/></a>
                                    <p>衡水老白干 67度750ml*2瓶 ......</p>
                                    <p class="center red">￥<b class="font-20">199</b><b>.00</b></p>
                                </li>
                              

                            </ul>
                        </div>
                    </div>

                </div>
                
            </div>
            <!-- /你可能会喜欢 -->

        </div>  
    </div>
<!--/wrap-->
<script type="text/javascript" src="__PUBLIC__/Home/js/count.js"></script>
<script type="text/javascript">
$(function(){
    clear();

    // 全选
    $(".allmess").click(function(){
        $(this).toggleClass("active");
        if($(this).hasClass("active")){
            $(".approve").addClass("active");
        } else{
            $(".approve").removeClass("active");
        }
        
    })

})

//单选
function clear() {
	$(".approve").each(function() {
		$(this).click(function(){
			$(this).toggleClass("active");
		})  
		
	});
}

function change_num(obj,shopping_cart_id,type){
	var obj = $(obj);
	var shopping_cart_id = shopping_cart_id;
	var n=parseInt(obj.parent().find('.num_text').attr('value'));
	n = type==1?n-1:n+1;
	if(n>0){
		$.post("<?php echo U('Cart/updateCart'); ?>",{shopping_cart_id:shopping_cart_id,num:n},function(data){
			if(data.status == -1){
				window.location.href="<?php echo U('Login/index'); ?>";
			}else{
				if(data.status){
					obj.parent().find('.num_text').attr('value',n); 
					var one_price = parseFloat($("#one_price_"+shopping_cart_id).text());
					$("#all_price_"+shopping_cart_id).text(mul(one_price,n).toFixed(2));
					if($("#checkbox_"+shopping_cart_id).is(':checked') == true){
						$("#all_num").text(data.data.all_num);
						$("#all_online_price").text(data.data.all_online_price);
					}
				}else{
					if(typeof(data.error_do) != 'undefined' && data.error_do == 'reload'){
						layer.alert(data.msg,function(){
							window.location.reload();
						});
					}else{
						layer.alert(data.msg);
					}	
				}
			}

		},"JSON");
	}
}

function addCollect(item_id){
	$.post("<?php echo U('Account/favoriteAdd'); ?>",{item_id:item_id},function(data){
		if(data.status == -1){
			window.location.href="<?php echo U('Login/index'); ?>";
		}else{
			layer.alert(data.msg);
		}
	},"JSON");
}

function delCart(shopping_cart_id){
	var shopping_cart_id = shopping_cart_id;
	$.post("<?php echo U('Cart/delCart'); ?>",{shopping_cart_id:shopping_cart_id},function(data){
		if(data.status == -1){
			window.location.href="<?php echo U('Login/index'); ?>";
		}else{
			if(data.status){
				$("#shopping_cart_"+shopping_cart_id).remove();
				if($("#checkbox_"+shopping_cart_id).is(':checked') == true){
					$("#all_num").text(data.data.all_num);
					$("#all_online_price").text(data.data.all_online_price);
				}
			}else{
				layer.alert(data.msg);
			}
		}

	},"JSON");
}

function delMyCart(){
	layer.confirm('确定要清空购物车？', {
		btn: ['确定','取消'] //按钮
		}, function(){
			$.post("<?php echo U('Cart/delMyCart'); ?>",{},function(data){
				if(data.status == -1){
					window.location.href="<?php echo U('Login/index'); ?>";
				}else{
					if(data.status){
						layer.alert(data.msg,function(){
							window.location.reload();
						});
					}else{
						layer.alert(data.msg);
					}
				}

			},"JSON");
		}, function(){
		  
		}
	);
}

function chooseCart(obj,shopping_cart_id){
	var obj = $(obj);
	var this_num = parseInt($('#num_text_'+shopping_cart_id).attr('value'));
	var this_all_price = parseFloat($('#all_price_'+shopping_cart_id).text());
	
	var all_num = parseInt($("#all_num").text());
	var all_online_price = parseFloat($("#all_online_price").text());

	if(obj.is(':checked') == true){
		$("#all_num").text(add(all_num,this_num));
		$("#all_online_price").text(add(all_online_price,this_all_price).toFixed(2));
	}else{
		$("#all_num").text(sub(all_num,this_num));
		$("#all_online_price").text(sub(all_online_price,this_all_price).toFixed(2));
	}
}

</script>


<?php W('Home/foot');?>