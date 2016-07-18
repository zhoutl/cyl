<?php W('Home/head',array('seo_data'=>$seo_data));?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Home/css/page.css">
<script type="text/javascript" src="__PUBLIC__/Home/js/jquery.pin.js"></script>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Common/fancybox/fancybox.css" />
<script type="text/javascript" src="__PUBLIC__/Common/fancybox/jquery.fancybox-1.3.1.pack.js" ></script>
<!--wrap-->
    <div class="thewidth100 bg_fff2 clearfix"> 
            <div class="thewidth">
                <div class="width font-12 c666">
                    <a href="{:U('Home/index')}">首页 </a>><a href="<?php echo U('Product/productsList/order_param/0?cid='.$item['item_info']['item_category_id'].'#p');?>"><?php echo $item['cate_info']['category_name']; ?> </a>><?php echo $item['item_info']['name']; ?>
                </div>
                <!--Single-->
        <div class="Single width mt20">
         <div class="SingleTop clearfix mb20">
         <!--st_left-->
          <div class="st_left">
            <div class="thumb">

                <div class="rpic">
                    <div id="thumb_top">                    
                    <a href="<?php echo $item['default_image']; ?>" id="good_img" class = 'cloud-zoom' rel="adjustX:10, adjustY:-4,smallImage:'__PUBLIC__/Home/images/product/012313583138.jpg'"><img src="<?php echo str_replace('album', 'big', $item['default_image']); ?>"  alt="<?php echo $item['item_info']['name']; ?>"/ style="width: 400px;height:400px; overflow: hidden; "></a>
                    </div>
                    <!--share-->
                    <div class="share_link clearfix mt10 width"> 
                            <div data-bd-bind="1442367459156" class="bdsharebuttonbox bdshare-button-style1-24">
                            <a href="javascript:;" class="bds_more" data-cmd="more"></a>
                            <a href="javascript:;" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
                            <a href="javascript:;" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
                            <a href="javascript:;" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
                            <a href="javascript:;" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
                            <a href="javascript:;" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>&nbsp;&nbsp;
                          </div>
        <script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"24"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>                  
                  </div>
                  <!--/share-->


                </div>

              <div id="thumb_list" class="clearfix">
                <a class="prev22 abtn aleft agrayleft" href="#left" title="">左移</a>
                <div id="thumbList">
                  <ul style="left: 0px;">
                    <!--loop-->
                   <?php foreach($item['item_image'] as $key=>$val): ?>
                    <li><a href="javascript:void(0)" big="<?php echo $val['img_uri'] ?>" small="<?php echo str_replace('album', 'big', $val['img_uri']); ?>"><img  alt="#"  src="<?php echo str_replace('album', 'icon', $val['img_uri']); ?>"></a></li>
                   <?php endforeach; ?>

                    
                              
                        <!--end-->
                  </ul>
                </div>
                <a class="next22 abtn aright agrayright" href="#right" title="">右移</a>
              </div>
            </div>




<script type="text/javascript" src="__PUBLIC__/Home/js/cloud-zoom.js"></script>
<script type="text/javascript">
$(function(){
  
  //默认状态下左右滚动
  $("#thumb_list").xslider({
    unitdisplayed:5,
    movelength:5,
    unitlen:81,
    dir:"V",
    autoscroll:0
  });
  
  $('#thumbList').find('img').click(function(){
    $('#good_img').attr('href',$(this).parent().attr('big'));
    $('#thumbList').find('li').removeClass('checked');
    $(this).parent().parent().addClass('checked');
    $('#good_img').find('img').attr('src',$(this).parent().attr('small'));
    return false;
  })
  
});
</script>
          </div>
          
         <!--/st_left-->
         <!--Options-->
        <div class="Options">
            <div class="widht font-20 c000"><?php echo $item['item_info']['name'];?></div>
			<?php if($item['has_sale']){ ?>
				<div class="pro-price mt20">
					<span class="f_l red">优惠价¥<em class="font-32"><?php echo $item['item_info']['online_price'];?></em></span>
					<span class="f_l preferential font-12 mt10 ml5">特惠</span>
					<span class="f_l c999 font-12 mt20 ml15">市场价<del>¥ <?php echo $item['item_info']['shop_price'];?></del></span>
					<span class="f_r font-12 mt10 phonebuy pr">
						<a href="javascript:;" class=""><img src="__PUBLIC__/Home/images/user/pro-details_12.jpg">&nbsp;&nbsp;手机购买</a>
						<em class="phoneewm none"><img src="<?php echo U('Product/get_code',array('item_id'=>$item['item_info']['item_id'])); ?>"></em>
					</span>
				</div>
				<div class="seckill-time c666 font-12">活动时间：<?php echo date("Y.m.d H:i:s",$data['item_sale_info']['start_time']); ?>-<?php echo date("Y.m.d H:i:s",$data['item_sale_info']['end_time']); ?></div>
			<?php }else{ ?>
				<div class="pro-price mt20">
					<span class="f_l red">¥<em class="font-32"><?php echo $item['item_info']['online_price'];?></em></span>
					<span class="f_l c999 font-12 mt20 ml15">市场价<del>¥ <?php echo $item['item_info']['shop_price'];?></del></span>
					<span class="f_r font-12 mt10 phonebuy pr">
						<a href="javascript:;" class=""><img src="__PUBLIC__/Home/images/user/pro-details_12.jpg">&nbsp;&nbsp;手机购买</a>
						<em class="phoneewm none"><img src="<?php echo U('Product/get_code',array('item_id'=>$item['item_info']['item_id'])); ?>"></em>
					</span>
				</div>
			<?php } ?>

			

			
            <div class="width mt20">
            <?php if(!empty($data['coupon'])){  ?>
                <div class="f_l c999 wb10 font-12">优惠</div>
                <div class="f_r wb90 cfff">
                    <?php foreach($data['coupon'] as $ckey=>$cval):?>
                        <a href="<?php echo U('Coupon/index',array('coupon_id'=>base64_encode($cval['coupon_id'])));?>" class="yhqbox f_l mr15 mb10"><em class="lefticon"></em><span><?php echo $cval['coupon_name'];?></span>领取<em class="righticon"></em></a>
                    <?php endforeach;?>
                </div>
             <?php }  ?> 
            </div>
            <div class="courier mt20">
                <div class="width">
                    <span class="f_l c999 mr17 font-12">销量</span>
                    <span class="f_l"><?php echo $item['item_info']['sales_volume'];?></span>
                </div>
                <div class="width mt10">
                    <span class="f_l c999 mr17 font-12">物流</span>
                    <span class="f_l">顺丰快递 全国包邮（港、澳、台除外）</span>
                </div>
            </div>
            <div class="width mt20 line26">
                <span class="f_l c999 mr17 font-12">数量</span>
                <div class="wan-spinner wan-spinner-2 f_l"> 
                   <a href="javascript:void(0)" onclick="change_num(this,1);" class="minus">-</a>
                   <input type="text" value="1" id="num_text" class="num_text w40">
                   <a href="javascript:void(0)" onclick="change_num(this,2);" class="plus">+</a> 
                </div>
                <span class="c999 f_l ml15">库存 <?php echo $item['item_info']['stock'];?></span>
            </div>
            <div class="width mt15">
                <button type="button" onclick="buy_now();" class="pro-buy f_l">立即购买</button>
                <a href="javascript:;" onclick="addCart();" class="pro-shop f_l ml15">加入购物车</a>
                <?php if(!empty($item['favorite'])){  ?>
                    <a href="javascript:;" class="pro-sc f_l ml15 color " onclick="javascript:;" ><em class="active" ></em><span>已收藏</span></a>
                <?php  }else{  ?>
                        <a href="javascript:;" class="pro-sc f_l ml15 " onclick="addCollect(this)" ><em></em><span>收藏</span></a>
                 <?php   } ?>
                
                
            </div>


            <div class="width mt20">
                <em class="f_l"><img src="__PUBLIC__/Home/images/user/pro-details_10.jpg"></em>
                <span class="f_l ml5 mr25">衡水老白干唯一官方商城</span>
                <em class="f_l"><img src="__PUBLIC__/Home/images/user/pro-details_10.jpg"></em>
                <span class="f_l ml5 mr25">全场包邮</span>
                <em class="f_l"><img src="__PUBLIC__/Home/images/user/pro-details_10.jpg"></em>
                <span class="f_l ml5">快速安全</span>
            </div>
        </div>
          <!--/Options-->
         </div>
        </div>
        <!--/Single-->
                
        </div>    
        
    </div>
<!--/wrap-->
<!-- 产品详情 -->
<div class="thewidth100 clearfix bg_fff2 container ddddd">
     <div class="pin_wrapper">
         <div class="pro-title pinned2 bg_fff">
            <div class="thewidth clearfix">
                <div class="width">
                    <div class="pro-good img100 mt10">
                        <div class="f_l"><img src="<?php echo $item['default_image']; ?>"></div>
                        <div class="f_r mp font-12 pro-nr wb65 mt15">
                            <p><?php echo $item['item_info']['name']; ?></p>
                            <p class="red">￥<?php echo $item['item_info']['online_price']; ?></p>

                        </div>
                    </div>
                    <div class="pro2">
                        <ul>
                            <li><a href="javascript:;" class="current10" id="div_1">产品介绍</a></li>
                            <li><a href="javascript:;" id="div_2">评价(<?php echo $data['totle_num'];?>)</a></li>
                            <li><a href="javascript:;" id="div_3">服务支持</a></li>
                        </ul>
                    </div>
                    <button type="button" onclick="buy_now();" class="pro3 f_r">立即购买</button>
                </div>
            </div>
        </div>
    </div>
            <div class="thewidth clearfix">


                <div class="width img100 mt30"  name="div_1">
                    <?php echo htmlspecialchars_decode($item['item_info']['description']);?>
                    <img src="__PUBLIC__/Home/images/user/pro-details3_03.jpg">
                    <img src="__PUBLIC__/Home/images/user/pro-details3_03-02.jpg">
                    <img src="__PUBLIC__/Home/images/user/pro-details3_03-03.jpg">
                    <img src="__PUBLIC__/Home/images/user/pro-details3_03-04.jpg">
                    <img src="__PUBLIC__/Home/images/user/pro-details3_03-05.jpg">

                </div>

            <!-- 评论加载 
            <div class="width border mt15 pad34">
                <div class="width center font-18"><img src="__PUBLIC__/Home/images/loading_animation.gif">&nbsp;&nbsp;评论加载中……</div> 
                <div class="width center font-18">暂无评论</div> 
            </div>-->
            <!--好评率-->
           <div style="display: none;" name="div_2">
            <div class="pro_det3 mt15 mb20"  >
                <div class="wb20 f_l center c666 mp">
                    <p class="red"><span class="font-41"><?php echo round($data['good_num']/$data['totle_num']*100);?></span>%</p>
                    <p>好评率</p>
                </div>
                <div class="f_l"><img src="__PUBLIC__/Home/images/user/pro-detailsyx.jpg"></div>
                <div class="yhpj3">
                    <ul>
                        <li>
                            <div class="f_l">好评</div>
                            <div class="yhpj-1 ml15"><span style="width:<?php echo round($data['good_num']/$data['totle_num']*100);?>%;"></span></div>
                            <div class="f_l ml15"><?php echo round($data['good_num']/$data['totle_num']*100);?>%</div>
                        </li>
                        <li>
                            <div class="f_l">中评</div>
                            <div class="yhpj-1 ml15"><span style="width:<?php echo round($data['mid_num']/$data['totle_num']*100);?>%;"></span></div>
                            <div class="f_l ml15"><?php echo round($data['mid_num']/$data['totle_num']*100);?>%</div>
                        </li>
                        <li>
                            <div class="f_l">差评</div>
                            <div class="yhpj-1 ml15"><span style="width:<?php echo round($data['bad_num']/$data['totle_num']*100);?>%;"></span></div>
                            <div class="f_l ml15"><?php echo round($data['bad_num']/$data['totle_num']*100);?>%</div>
                        </li>
                    </ul>
                </div>
                <div class="wb25 f_r center c999">
                    <p><a href="<?php echo U('Order/myOrders'); ?>" class="button7">立即评价</a></p>
                    <p>只有购买过的用户可以评价</p>
                </div>               
            </div>
            <!--/好评率-->
            <!-- 评论 -->
            <div class="width border">
                <div class="width border-b pj-top">
                    <ul>
                        <li><a href="javascript:;" id="com_5" class="current11" onclick="ajax_page(5,1)" >全部评论（<?php echo $data['totle_num'];?>）</a></li>
                        <li><a href="javascript:;" id="com_1" onclick="ajax_page(1,1)">晒图评价（<?php echo $data['img_num'];?>）</a></li>
                        <li><a href="javascript:;" id="com_2" onclick="ajax_page(2,1)">好评（<?php echo $data['good_num'];?>）</a></li>
                        <li><a href="javascript:;" id="com_3" onclick="ajax_page(3,1)">中评（<?php echo $data['mid_num'];?>）</a></li>
                        <li><a href="javascript:;" id="com_4" onclick="ajax_page(4,1)">差评（<?php echo $data['bad_num'];?>）</a></li>
                    </ul>
                </div>
                <div class="pl-box width" id="comment_info">
                    
                </div>
            </div>

            <!-- /评论 -->
            <!--分页-->
                <div class="fy-box" id="page_info">
                    <div class="page" >
                    
                    </div>
                </div> 
             <!--/分页-->
           </div>


          <!-- 服务支持 -->
            <div class="width border mt15 mb20" style="display: none;" name="div_3">
                <div class="width mt30 font-20 center">衡水老白干官方商城服务与支持</div>
                <div class="width pdl20 font-18 mb15"><span class="f_l ml25">物流仓储</span></div>
                <div class="width img100">
                    <img src="__PUBLIC__/Home/images/user/pro-details3_03.jpg">
                    <img src="__PUBLIC__/Home/images/user/pro-details3_03-02.jpg">
                    <img src="__PUBLIC__/Home/images/user/pro-details3_03-03.jpg">
                    <img src="__PUBLIC__/Home/images/user/pro-details3_03-04.jpg">
                    <img src="__PUBLIC__/Home/images/user/pro-details3_03-05.jpg">
                </div>
            </div>
            <!-- /服务支持 -->



           <!-- 你可能会喜欢 -->
            <div class="like mt15">
                <div class="like-top">
                    <span class="f_l font-20">你可能会喜欢</span>
                </div>
                <div class="pic_con">
                    <div class="btn_change left_btn">上一页</div>
                    <div class="btn_change right_btn">下一页</div>
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
                                
                            </ul>
                        </div>
                    </div>

                </div>
                
            </div>
            <!-- /你可能会喜欢 -->
                
        </div>
        
    </div>
        
        <!-- 产品详情 -->
<script type="text/javascript" src="__PUBLIC__/Home/js/slider.js"></script>
<script type="text/javascript">
    $(function(){
        $(".product li").mouseover(function() {
            clear();
            $(this).addClass("active");
        });
        function clear() {
            $(".product li").each(function() {
                if ($(this).hasClass("active")) {
                    $(this).removeClass("active");
                }
            });
        }
    })
    $(document).ready(function() {
  // 图片滚动
  var page=1;
    var i=3;
    var $p_Div=$(".pic_content");
    var $picDiv=$(".pic_lists");
    var picNum=$picDiv.children("ul").children("li").length;
    var page_count=Math.ceil(picNum/4);
    var $pDiv_w=$p_Div.width()+12;

    $(".right_btn").click(function(){
        if(page_count>page){
            $picDiv.animate({left:'-'+page*$pDiv_w+"px"},"normal");
            page++;
            $(".left_btn").css({'background':'url(__PUBLIC__/Home/__PUBLIC__/Home/images/user/leftstart.jpg) no-repeat'});
            if(page>=page_count){
                $(this).css({'background':'url(__PUBLIC__/Home/__PUBLIC__/Home/images/user/rightstop.jpg) no-repeat'});
            }else{
                $(this).css({'background':'url(__PUBLIC__/Home/__PUBLIC__/Home/images/user/rightstart.jpg) no-repeat'});
            }
        } 
     });
    
    $(".left_btn").click(function(){
        if(page>1){
            $picDiv.animate({left:"+="+$pDiv_w+'px'},"normal");
            page--;
            $(".right_btn").css({'background':'url(__PUBLIC__/Home/__PUBLIC__/Home/images/user/rightstart.jpg) no-repeat'});
            if(page<=1){
                $(this).css({'background':'url(__PUBLIC__/Home/__PUBLIC__/Home/images/user/leftstop.jpg) no-repeat'});    
            }else{
                $(this).css({'background':'url(__PUBLIC__/Home/__PUBLIC__/Home/images/user/leftstart.jpg) no-repeat'});
            }
        }
     });
  });
</script>






<script type="text/javascript">
   var item_id="<?php echo $item['item_info']['item_id'];?>";
   
   $(document).ready(function(){
       $("a[id^=div_]").click(function(){
           var id = $(this).attr('id');
           $("div[name^=div_]").css('display','none');
           $("div[name="+id+"]").css('display','block');
           $("a[id^=div_]").removeClass('current10');
           $(this).addClass('current10');
       });

       $("a[id^=com_]").click(function(){
           var id = $(this).attr('id');

           $("a[id^=com_]").removeClass('current11');
           $(this).addClass('current11');
       });
       //手机二维码
       $(".phonebuy").mouseover(function(){
            $(".phoneewm").toggle();
        })

        ajax_page(5,1);
   });
   
   
   function addCollect(obj){
        var obj=$(obj);
        $.ajax({
            url:"<?php echo U('Account/favoriteAdd');?>",
            data:{item_id:item_id},
            type:'post',

            success:function(data) {
                if(data.status==-1){
                   window.location.href="<?php echo U('Login/index');?>";
                }else{
                    if(data.status==1){
                        obj.attr('onclick','javascript:;');
                        obj.find("em").addClass("active");
                        obj.find("span").html("已收藏");
                        obj.addClass("color");
                    }else{
                        layer.alert(data.msg);
                    }

                } 
            },


        });
   }

   function addCart(){
       var num = parseInt($("#num_text").val());
        $.ajax({
            url:"<?php echo U('Cart/addCart');?>",
            data:{item_id:item_id,num:num},
            type:'post',
            success:function(data) {
                if(data.status==-1){
                   window.location.href="<?php echo U('Login/index');?>";
                }else{
                    if(data.status==1){
                        window.location.href="<?php echo U('Cart/addToCart'); ?>";
                    }else{
                        layer.alert(data.msg);
                    }

                } 
            },
            error: function() {

            }

        });
   }
   
     //立即购买
  function buy_now(){
	var num = $("#num_text").val();
	$.post("<?php echo U('Cart/buyNow'); ?>",{item_id:item_id,num:num},function(data){
		if(data.status==-1){
		   window.location.href="<?php echo U('Login/index');?>";
		}else{
			if(data.status==1){
				window.location.href=_APP+"/Order/confirmOrder/shopping_cart_id/"+data.shopping_cart_id;
			}else{
				layer.alert(data.msg);
			}

		} 
	},'JSON'); 
  }


    //数量加减
    function change_num(obj,type){
        var obj = $(obj);
        var n=parseInt(obj.parent().find('.num_text').attr('value'));
        n = type==1?n-1:n+1;
        if(n>0){
            obj.parent().find('.num_text').attr('value',n); 
        }
    }
     
    var tab=p=0 ;
    function ajax_page(tab,p){
        var html='<div class="width border mt15 pad34"><div class="width center font-18"><img src="__PUBLIC__/Home/images/loading_animation.gif">&nbsp;&nbsp;评论加载中……</div></div>';
         $('#comment_info').html(html);
       $.ajax({
          url:"<?php echo U('Product/commentPage')?>",
          data:{item_id:item_id,tab:tab,p:p},
          type:'get',
          cache: true,
          success : function(data){
            //data.info.html = $.parseJSON(data.info.html);
            //alert(data.info.html);
            $('#comment_info').html(data.info.html);
            $('#page_info').html(data.info.page_info);
            $("a[rel=group]").fancybox({
             'titlePosition' : 'over',
             'cyclic'        : true,
             'titleFormat'   : function(title, currentArray, currentIndex, currentOpts) {
               return '<span id="fancybox-title-over">' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
               }
            });
          }, 




       });
    }

  //定住“立即购买”
   $(".pin_wrapper").pin({
      containerSelector: ".container"
   })
</script>
<?php W('Home/foot');?>