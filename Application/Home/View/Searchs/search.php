<?php W('Home/head',array('seo_data'=>$seo_data));?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Home/css/page.css">
<!--wrap-->
    <div class="thewidth100 bg_gray clearfix"> 
            <div class="thewidth">
                <div class="width font-12 c666">
                    <a href="{:U('Home/index')}">首页 </a>>搜索
                </div>
                <!-- list -->
                <div class="protop mt10">
                    
                    <ul>
                    
                        <li>
                            <div class="pro-bg c999">价格：</div>
                             <div class="wb90 f_l pro-lb">
                              <?php 
                                        $url = '';
                                        $url = U('Searchs/search/price/0/order_param/'.$order_param.'?keyword='.$keyword.'#p');
                                ?>
                               <a href="<?php echo $url;?>" <?php if($price == 0){echo 'class="current8"';} ?>>不限</a>
                               <?php for ($j=1;$j<count($price_search);$j++ ): ?>
                                <?php 
                                        $url = '';
                                        $url = U('Searchs/search/price/'.$j.'/order_param/'.$order_param.'?keyword='.$keyword.'#p');
                                ?>
                                    <a href="<?php echo $url;?>" <?php if($price == $j){echo 'class="current8"';} ?> ><?php echo $price_search[$j];?></a>
                               <?php endfor; ?>
                                
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- /list -->
                <!-- 筛选 -->
                <div class="screen mt10">
                    <ul>
                        <li><a href="<?php echo U('Searchs/search/price/'.$price.'/order_param/0/keyword/'.$keyword);?>">默认排序</a></li>

                        <li><a  <?php $tmp_order_num=1; if($order_param==1){echo 'class="current12"'; $tmp_order_num=2;}else if($order_param==2){echo 'class="current13"'; $tmp_order_num=1;} ?>  href="<?php echo U('Searchs/search/price/'.$price.'/order_param/'.$tmp_order_num.'/keyword/'.$keyword); ?>"  
                         >最新</a></li>

                         <li><a  <?php $tmp_order_num=3; if($order_param==3){echo 'class="current12"'; $tmp_order_num=4;}else if($order_param==4){echo 'class="current13"'; $tmp_order_num=3;} ?>  href="<?php echo U('Searchs/search/price/'.$price.'/order_param/'.$tmp_order_num.'/keyword/'.$keyword);?>"  
                         >销量</a></li>

                         <li><a  <?php $tmp_order_num=5; if($order_param==5){echo 'class="current12"'; $tmp_order_num=6;}else if($order_param==6){echo 'class="current13"'; $tmp_order_num=5;} ?>  href="<?php echo U('Searchs/search/price/'.$price.'/order_param/'.$tmp_order_num.'/keyword/'.$keyword);?>"  
                         >价格</a></li>

                        
                        <li>
                        <?php
                            $url = '';
                            $tmp_price = explode('_',$price);
                            if(is_array($tmp_price) && count($tmp_price)==2){
                                $min_price = $tmp_price[0];
                                $max_price = $tmp_price[1];
                            }
                        ?>
                            <script type="text/javascript">
                            $(document).ready(function(){
                                $("#price_form").click(function(e){
                                    var str = "<?php echo $str; ?>";
                                    var min_price = $("input[name=min_price]").val();
                                    var max_price = $("input[name=max_price]").val();
                                    min_price = min_price?min_price:0;
                                    max_price = max_price?max_price:0;
                                    window.location.href="__URL__/search/price/"+min_price+'_'+max_price+"/order_param/"+"<?php echo $order_param; ?>"+"?keyword="+"<?php echo $keyword; ?>"+"#p";
                                });
                                $("#clean_form").click(function(e){

                                    window.location.href="__URL__/search/price/0/order_param/"+"<?php echo $order_param; ?>"+"?keyword="+"<?php echo $keyword; ?>"+"#p";

                                });
                            });
                            
                        </script>
                        <form method="get" class="demoform">
                            <input type="text" name="min_price" value="<?php echo $min_price; ?>"  onkeyup="this.value=this.value.replace(/\D/g,'')"  onafterpaste="this.value=this.value.replace(/\D/g,'')" class="prokk1 f_l"><span class="f_l red ml5">—</span>
                            <input type="text" name="max_price" value="<?php echo $max_price; ?>"  onkeyup="this.value=this.value.replace(/\D/g,'')"  onafterpaste="this.value=this.value.replace(/\D/g,'')" class="prokk1 f_l ml5">
                            <button type="button" class="btn-blue btn-blue2 f_l ml10 font-12" id="price_form">确定</button>
                            <button type="button" id="clean_form" class="btn-blue btn-blue3 f_l ml5 font-12">清除</button>
                        </form>
                            
                        </li>
                    </ul>
                </div>
                <!-- /筛选 -->
                <!-- 产品 -->
                <div class="width mt15 product">
                    <ul>
                    <volist name="items" id="vo">
                        <li>
                            <div class="width buy">
                                <a href="#" class=""></a>
                                <a href="#" class=""></a>
                            </div>
                            <div class="propic img100"><a href="<?php echo U('Product/productDetail',array('item_id'=>$vo['item_id']));?>">
                            <?php if(!empty($vo['img_uri'])){ ?>
                               <img src="__ROOT__{$vo.img_uri}">
                            <?php }else{ ?>
                                <img src="__ROOT__/Public/upload/watermark.jpg">
                            <?php } ?>
                               
                            </a></div>
                            <div class="protext"><a href="<?php echo U('Product/productDetail',array('item_id'=>$vo['item_id']));?>">{$vo.name} ...</a></div>
                            <div class="red">￥<span class="font-20">{$vo.online_price}</span></div>
                        </li>
                    </volist>
                        
             
                    
                    </ul>
                </div>
                <!-- /产品 -->
                <!--分页-->
                <div class="list_box_bottom">
                    <div class="page">
                        <?php echo $seo_data['page']->show();?>
                    </div>
                 </div> 
                <!--/分页-->
            </div>
 
                
    </div>
<!--/wrap-->



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
    });
</script>

<?php W('Home/foot');?>

