<?php W('Home/head',array('seo_data'=>$seo_data));?>
<script src="__PUBLIC__/Home/js/account/address.js"></script>
<!--wrap-->
    <div class="thewidth100 bg_gray clearfix"> 
        <div  class="thewidth">
            <div class="width payheight">
                <div class="f_l font-20 mt15"><b>订单详情</b></div>
                <div class="shoptop">
                    <ul>
                        <li>
                            <div class="password1-line password1-line2"></div>
                            <div class="center pasxz1"><p class="password1-first current1">1</p><p class="blue">购物车</p></div>
                        </li>
                        <li>
                            <div class="password1-line"></div>
                            <div class="center pasxz"><p class="password1-first current1">2</p><p class="blue">订单信息</p></div>
                        </li>
                        <li>
                            <div class="password1-line"></div>
                            <div class="center pasxz"><p class="password1-first">3</p><p class="c999">确认支付</p></div>
                        </li>
                    </ul>
                </div>
            </div>

			<form id="add_order_form">
            <!-- shopcar -->
            <div class="shopbox mt40">
                <!-- 收货地址 -->
                <div class="width">
                    <div class="account1">
                        <span class="f_l font-18">收货地址</span>
                    </div>
                    <div class="account2">
                        <ul>
							<?php $account_address_id = 0; ?>
							<?php foreach($data['address'] as $v): ?>
								<?php 
									if($v['is_default']){
										$account_address_id = $v['account_address_id'];
										$class = 'active';
									}else{
										$class = '';
									} 
								?>
                            <li class="<?php echo $class; ?>" style="cursor:pointer" onclick="chooseAddress(this,'<?php echo $v['account_address_id']; ?>')">
                                <div class="width account2-top"><?php echo $v['name']; ?>&nbsp;&nbsp;<?php echo $v['phone']; ?></div>
                                <div class="width c999 mt10 dz-height"><?php echo $v['address']; ?></div>
                                <div class="width mt15 font-12">
                                    <a href="javascript:;" onclick="editAddress('<?php echo $v['account_address_id']; ?>');" class="f_l red mr10">修改</a>
                                    <span></span>
                                </div>
                            </li>
                            <?php endforeach; ?>
							<?php if(count($data['address'])<10): ?>
								<li id="addnew">
									<div class="center addnew"><a href="javascript:;"><img src="__PUBLIC__/Home/images/user/shopcar-account_03.jpg"></a></div>
								</li>
							<?php endif; ?>
							
							
							<input type="hidden" name="account_address_id" value="<?php echo $account_address_id; ?>" />
                        </ul>
                    </div>
                    <div class="width none addnewbox border mt15 pad10">

                    </div>
                </div>
                <!-- /收货地址 -->
                <!-- 配送方式 -->
                <div class="width mt15">
                    <div class="account1">
                        <span class="f_l font-18">配送方式</span>
                    </div>
                    <div class="account2 c666">
					<?php foreach($data['delivery'] as $k=>$v): ?>
                        <div class="width mt15 mb10">
                            <span class="f_l mr10"><input type="radio" name="delivery_mode_id" <?php if($k=='0'){echo 'checked';} ?>  value="<?php echo $v['delivery_mode_id']; ?>"></span>
                            <div class="f_l mr17"><?php echo $v['name']; ?></div>
                            <div class="f_l ml60">¥ 0.00</div>
                        </div>
                      <?php endforeach; ?>  
                    </div>
                </div>
                <!-- /配送方式 -->
                <!-- 发票信息 -->
                <div class="width mt15">
                    <div class="account1">
                        <span class="f_l font-18">发票信息</span>
                    </div>
                    <div class="account2 c666">
                        <div class="width mt15 mb10">
                            <span class="f_l mr10"><input type="radio" name="invoice_type_id" checked value="1"></span>
                            <div class="f_l mr17">不开发票</div>
                        </div>
                        <div class="width mt15 mb10">
                            <span class="f_l mr10"><input type="radio" name="invoice_type_id" value="2"></span>
                            <div class="f_l mr17">个人：酒品</div>
                        </div>
                        <div class="width mt15 mb10">
                            <span class="f_l mr10"><input type="radio" name="invoice_type_id" value="3"></span>
                            <div class="f_l mr17">公司：酒品</div>
                            <input type="text" name="invo_cust_name" placeholder="请输入发票抬头" disabled value="" class="kk6">
                        </div>
                        
                    </div>
                </div>
                <!-- /发票信息 -->
				
				<!-- 订单备注 -->
                <div class="width mt15">
                    <div class="account1">
                        <span class="f_l font-18">订单备注</span>
                    </div>
                    <div class="account2 c666">
                        <textarea class="data-kk3 ddbz" placeholder="请输入订单备注" name="desc"></textarea>   
                    </div>
                </div>
                <!-- /订单备注 -->


                <table class="jftable center mt10 f_l font-12 order-form js shoptable" cellpadding="0">
                    <thead>
                        <tr>
                            <th class="wb55">商品信息</th>
                            <th class="wb15">单价</th>
                            <th class="wb15">数量</th>
                            <th class="wb15">小计</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php foreach($data['cart_list'] as $k=>$v): ?>
							<?php if(is_numeric($k)): ?>
								<tr>
									<td class="wb55">
										<div class="order-pic img100 ml25">
											<?php if(!empty($v['img_uri'])){ ?>
											   <img src="<?php echo $v['img_uri'] ?>" width="73" height="73" />
											<?php }else{ ?>
												<img src="/Public/upload/watermark.jpg" width="73" height="73" />
											<?php } ?>
										</div>
										<div class="wb70 f_l ml10 tx-l" style="text-align:left;">
											<div class="width"><?php echo $v['name']; ?></div>
											<?php if($v['has_sale']): ?>
												<br><span class="f_l preferential font-12 mt10">特惠</span>
											<?php endif; ?>
										</div>
									</td>
									<td class="wb15">¥<?php echo $v['online_price']; ?></td>
									<td class="wb15">
										<?php echo $v['num']; ?>
									</td>
									<td class="wb15">¥<?php echo number_format($v['online_price']*$v['num'],2,'.',''); ?></td>
									<input name="cart_id[]" type="hidden" value="<?php echo $v['shopping_cart_id']; ?>" />
								</tr>
							<?php endif; ?>
						<?php endforeach; ?>
                    </tbody>
                </table>
                <!-- 结算信息 -->
                <div class="width mt15">
                    <div class="account1">
                        <span class="f_l font-18">结算信息</span>
                    </div>
                    <div class="account2 c666 font-16">
                        <div class="wb65 f_l">
                            <div class="width">
								<a href="javascript:;" name="ticket">
									<span class="account3 f_l mr10"><img src="__PUBLIC__/Home/images/user/shopcar-account_07.jpg"></span>
									<span class="f_l">使用优惠券</span>
								</a><br>
								<div style="display:none;" name="c_civ"> 
									<select class="jfbox f_l ml25 mt10" name="coupon_id">
										<option value="0">请选择要使用的优惠券</option>
										<?php foreach($data['my_coupon_list'] as $v): ?>
											<option value="<?php echo $v['coupon_id']; ?>" coupon_amount="<?php echo $v['coupon_amount']; ?>"><?php echo $v['coupon_name']; ?>(-¥<?php echo $v['coupon_amount']; ?>)</option>
										<?php endforeach; ?>
									</select>
								</div>
                            </div>
                            <div class="width mt15">
                                <a href="javascript:;" name="ticket">
									<span class="account3 f_l mr10"><img src="__PUBLIC__/Home/images/user/shopcar-account_07.jpg"></span>
									<span class="f_l">使用现金券抵扣部分金额</span>
								</a><br>
							
								<div class="f_l ml25 mt10" style="display:none;" name="c_civ">
									<input type="text" name="voucher_code"  class="jfbox">
									<button type="button" onclick="useVoucher();" class="jfbtn">使用</button>
								</div>
                                
                            </div>
                            <div class="width mt15 mb15">
                                <div class="account3 f_l mr10"><img src="__PUBLIC__/Home/images/user/shopcar-account_077.jpg"></div>
                                <div class="wb85 f_l">
                                    <p>使用积分抵扣部分金额 &nbsp;&nbsp;<span class="c999">( 本次最多可用积分：<?php echo $data['pay_points']; ?> )</span></p>
                                    <div class="width">
                                        <input type="text" name="points" class="jfbox">
                                        <button type="button" onclick="usePoints();" class="jfbtn">使用</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="account4">
                            <ol>
                                <li>
                                    <span class="f_l tx-r wb65">商品总金额：</span>
                                    <span class="f_l tx-r wb35">¥<?php echo $data['cart_list']['count_info']['all_online_price']; ?></span>
                                </li>
                                <li>
                                    <span class="f_l tx-r wb65">运费：</span>
                                    <span class="f_l tx-r wb35">¥0.00</span>
                                </li>
								<?php if($data['order_reduction']){ ?>
									<li>
									  <span class="f_l tx-r wb65">订单满减优惠：</span>
									  <span class="f_l tx-r wb35">-￥<?php echo $data['order_reduction']['reduction_amount']; ?></span>
									</li>
								<?php } ?>
                                <li>
                                    <span class="f_l tx-r wb65">优惠券/现金券抵扣：</span>
                                    <span class="f_l tx-r wb35">-¥<span id="ticket_amount">0.00</span></span>
                                </li>
                                <li>
                                    <span class="f_l tx-r wb65">积分抵扣：</span>
                                    <span class="f_l tx-r wb35">-¥<span id="points_amount">0.00</span></span>
                                </li>
                            </ol>
                        </div>
                        
                        
                    </div>
                    <div class="account f_l mt15 account5">
                        <span class="f_l">收货后10日内未发生退货情况，即可获得：会员成长值<span id="add_points"><?php echo $data['add_points']; ?></span> / 积分值<span id="add_growth"><?php echo $data['add_growth']; ?></span></span>
                        <button type="button" id="add_order" class="btn qjs f_r" style="color:#fff;">去结算</button>
                        <span class="f_r mr10">应付总金额：<em class="font-20 red">¥<span id="pay_amount"><?php echo number_format($data['pay_amount'],2,'.',''); ?></span></em></span>
                    </div>
                </div>
                <!-- /结算信息 -->

            </div>
            </form>

        </div>  
    </div>
<!--/wrap-->

<script type="text/javascript" src="__PUBLIC__/Home/js/count.js"></script>
<script type="text/javascript">
var pay_amount = "<?php echo $data['pay_amount']; ?>";
var points_amount = ticket_amount = 0;
var one_growth = "<?php echo $data['one_growth']; ?>";
var one_points = "<?php echo $data['one_points']; ?>";
var allow_points = "<?php echo $data['pay_points'] ?>";
var exchange_ratio = "<?php echo $data['exchange_ratio']; ?>";

// 默认地址
function chooseAddress(obj,account_address_id){
	var obj = $(obj);
	$(".account2 ul li").removeClass('active');
	obj.addClass('active');
	$("input[name=account_address_id]").val(account_address_id);
}

//修改地址
function editAddress(account_address_id){
	$.post("<?php echo U('Order/ajaxEditAddress') ?>",{account_address_id:account_address_id},function(data){
		if(data.status == -1){
			window.location.href="<?php echo U('Login/index'); ?>";
		}else{
			if(data.status){
				$(".addnewbox").css('display','block');
				$(".addnewbox").html(data.html);
			}else{
				layer.alert(data.msg);
			}
		}
	},"JSON");
}

//使用现金券
function useVoucher(){
	var voucher_code = $("input[name=voucher_code]").val();
	if(voucher_code == ''){
		layer.alert('请输入现金券码');
		return false;
	}
	$.post("<?php echo U('Order/checkVoucher') ?>",{voucher_code:voucher_code,limit_amount:<?php echo $data['pay_amount']; ?>},function(data){
		if(data.status == -1){
			window.location.href="<?php echo U('Login/index'); ?>";
		}else{
			if(data.status){
				ticket_amount = parseFloat(data.cash_voucher_info.voucher_amount);
				var tmp = sub(sub(pay_amount,ticket_amount),points_amount);
				$("#ticket_amount").text(ticket_amount.toFixed(2));
				$("#pay_amount").text(tmp.toFixed(2));
				$("#add_growth").text(add(parseInt(tmp),one_growth));
				$("#add_points").text(add(parseInt(tmp),one_points));	
				layer.alert('现金券使用成功');
			}else{
				layer.alert(data.msg);
			}
		}
	},'JSON');
}

//使用积分
function usePoints(){
	var points = parseInt($("input[name=points]").val());
	if(points>=0){
		if(points>allow_points){
			layer.alert('您最多可使用'+allow_points+'积分');
			$("input[name=points]").val('');
			return false;
		}else{
			points_amount = div(points,exchange_ratio);
			var tmp = sub(sub(pay_amount,ticket_amount),points_amount);
			
			$("#points_amount").text(points_amount.toFixed(2));
			$("#pay_amount").text(tmp.toFixed(2));
			$("#add_growth").text(add(parseInt(tmp),one_growth));
			$("#add_points").text(add(parseInt(tmp),one_points));
			layer.alert('积分使用成功');
		}
	}else{
		layer.alert('请输入正确的积分数');
	}
}

$(document).ready(function(){
	$("#addnew").click(function(){
		$.post("<?php echo U('Order/ajaxAddAddress') ?>",{},function(data){
			if(data.status == -1){
				window.location.href="<?php echo U('Login/index'); ?>";
			}else{
				if(data.status){
					$(".addnewbox").css('display','block');
					$(".addnewbox").html(data.html);
				}else{
					layer.alert(data.msg);
				}
			}

		},"JSON");
	});
	
	$("input[name=invoice_type_id]").click(function(){
		if($(this).val() == '3'){
			$("input[name=invo_cust_name]").attr('disabled',false);
		}else{
			$("input[name=invo_cust_name]").attr('disabled',true);
		}
	});
	
	$("a[name=ticket]").click(function(){
		$("a[name=ticket]").find('img').attr('src','/Public/Home/images/user/shopcar-account_07.jpg');
		$("div[name=c_civ]").css('display','none');
		
		$(this).find('img').attr('src','/Public/Home/images/user/shopcar-account_077.jpg');
		$(this).parent().find("div[name=c_civ]").css('display','block');

		$("select[name=coupon_id]").find("option[value=0]").attr("selected",true);
		$("input[name=voucher_code]").val('');
		
		//js计算价格等
		ticket_amount = 0;
		$("#ticket_amount").text('0.00');
		var tmp = sub(sub(pay_amount,ticket_amount),points_amount);
		$("#pay_amount").text(tmp.toFixed(2));
		$("#add_growth").text(add(parseInt(tmp),one_growth));
		$("#add_points").text(add(parseInt(tmp),one_points));			
	});
	
	//选择使用优惠券
	$("select[name=coupon_id]").change(function(){
		if($(this).val() == '0'){
			ticket_amount = 0;
		}else{
			ticket_amount = parseFloat($("select[name=coupon_id] option:selected").attr("coupon_amount"));
		}
		var tmp = sub(sub(pay_amount,ticket_amount),points_amount);
		$("#ticket_amount").text(ticket_amount.toFixed(2));
		$("#pay_amount").text(tmp.toFixed(2));
		$("#add_growth").text(add(parseInt(tmp),one_growth));
		$("#add_points").text(add(parseInt(tmp),one_points));	
	});
	
	

	$("#add_order").click(function(){
		$(this).attr('disabled',true);
		$("#tck").css('display','block');
		$.ajax({
			cache: true,
			type: "POST",
			url:"<?php echo U('Order/addOrder'); ?>",
			data:$("#add_order_form").serialize(),// 你的formid
			async: false,
			error: function(request) {
				$("#tck").css('display','none');	
				$("#add_order").attr('disabled',false);
				layer.alert('连接超时，请检查您的网络');
			},
			success: function(data) {			
				if(data.status == -1){
					window.location.href="<?php echo U('Login/index'); ?>";
				}else{
					if(data.status){
						window.location.href=_APP+"/Pay/index/orders_id/"+data.order_info.orders_id;
					}else{
						$("#tck").css('display','none');	
						$("#add_order").attr('disabled',false);
						layer.alert(data.msg);
					}
				}
			}
		});	
	});
	
});


</script>


<!-- 弹窗 -->
<div class="tck none" id="tck">
    <div class="tck1"></div>
    <div class="tck22">
        <div class="width orderwait border-b pad10">温馨提示</div>
        <div class="orderwait2 mt40 mb40">
            <div class="f_l wb25 tx-r"><img src="__PUBLIC__/Home/images/loading_animation.gif" class="mt5"></div>
            <div class="f_r wb70">
                <span class="blue font-18"><b>订单已提交！</b></span><br>
                <span class="c666">系统正在处理，请稍等……</span>
            </div>
        </div>
    </div>
</div>
<!-- /弹窗 -->


<?php W('Home/foot');?>