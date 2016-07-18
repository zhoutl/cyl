<?php W('Home/head',array('seo_data'=>$seo_data));?>

<link rel="stylesheet" type="text/css" href="__PUBLIC__/Home/css/page.css">
<!--wrap-->
    <div class="thewidth100 bg_gray clearfix"> 
            <div class="thewidth" id="p">
                <div class="width font-12 c666">
                    <a href="{:U('Home/index')}">首页 </a>><?php echo $purpose_info['purpose_name']; ?>
                </div>
                <!-- list -->
                <div class="protop mt10">
                    <div class="width yxz">
                        <div class="pro-bg c999">您已选择：</div>
                        <div class="wb70 f_l">
                            <?php echo  $quick_tag_html;?>
                            <!-- <a href="javascript:;" class="yxzbtn mr17">度数：67度<em></em></a> -->
                        </div>
                        <div class="wb10 f_r"><a href="<?php echo U('Product/purposeList/order_param/0#p');?>" class="qcall f_r">清除全部<span></span></a></div>
                    </div>
                    <ul>
                    

                      <li>
                            <div class="pro-bg c999">品牌：</div>
                            <div class="wb90 f_l pro-lb">
                              <?php 
                                        $str = '';
                                        $url = '';
                                        for($i=0;$i<$total;$i++){
                                            if($i==2){
                                                $str.='0-';
                                            }else{
                                                $str.=$param[$i].'-';
                                            }
                                        }
                                        $str = substr($str,0,-1);
                                        $url = U('Product/purposeList/param/'.$str.'/order_param/'.$order_param.'#p');
                                ?>
                               <a href="<?php echo $url;?>" <?php if($param[2] == 0){echo 'class="current8"';} ?>>不限</a>
                               <?php foreach ($data['brand_info'] as $key => $value): ?>
                                <?php 
                                        $str = '';
                                        $url = '';
                                        for($i=0;$i<$total;$i++){
                                            if($i==2){
                                                $str.=$value['brand_id'].'-';
                                            }else{
                                                $str.=$param[$i].'-';
                                            }
                                        }
                                        $str = substr($str,0,-1);
                                        $url = U('Product/purposeList/param/'.$str.'/order_param/'.$order_param.'#p');
                                ?>
                                    <a href="<?php echo $url;?>" <?php if($param[2] == $value['brand_id']){echo 'class="current8"';} ?> ><?php echo $value['brand_name'];?></a>
                               <?php endforeach; ?>
                                
                            </div>
                        </li>

                        <li>
                            <div class="pro-bg c999">适用场合：</div>
                            <div class="wb90 f_l pro-lb">
                              <?php 
                                        $str = '';
                                        $url = '';
                                        for($i=0;$i<$total;$i++){
                                            if($i==0){
                                                $str.='0-';
                                            }else{
                                                $str.=$param[$i].'-';
                                            }
                                        }
                                        $str = substr($str,0,-1);
                                        $url = U('Product/purposeList/param/'.$str.'/order_param/'.$order_param.'#p');
                                ?>
                               <a href="<?php echo $url;?>" <?php if($param[0] == 0){echo 'class="current8"';} ?>>不限</a>
                               <?php foreach ($data['purpose_list'] as $key => $value): ?>
                                <?php 
                                        $str = '';
                                        $url = '';
                                        for($i=0;$i<$total;$i++){
                                            if($i==0){
                                                $str.=$value['item_purpose_id'].'-';
                                            }else{
                                                $str.=$param[$i].'-';
                                            }
                                        }
                                        $str = substr($str,0,-1);
                                        $url = U('Product/purposeList/param/'.$str.'/order_param/'.$order_param.'#p');
                                ?>
                                    <a href="<?php echo $url;?>" <?php if($param[0] == $value['item_purpose_id']){echo 'class="current8"';} ?> ><?php echo $value['purpose_name'];?></a>
                               <?php endforeach; ?>
                                
                            </div>
                        </li>
                        
                        <li>
                            <div class="pro-bg c999">价格：</div>
                             <div class="wb90 f_l pro-lb">
                              <?php 
                                        $str = '';
                                        $url = '';
                                        for($i=0;$i<$total;$i++){
                                            if($i==1){
                                                $str.='0-';
                                            }else{
                                                $str.=$param[$i].'-';
                                            }
                                        }
                                        $str = substr($str,0,-1);
                                        $url = U('Product/purposeList/param/'.$str.'/order_param/'.$order_param.'#p');
                                ?>
                               <a href="<?php echo $url;?>" <?php if($param[1] == 0){echo 'class="current8"';} ?>>不限</a>
                               <?php for ($j=1;$j<count($price_search);$j++ ): ?>
                                <?php 
                                        $str = '';
                                        $url = '';
                                        for($i=0;$i<$total;$i++){
                                            if($i==1){
                                                $str.=$j.'-';
                                            }else{
                                                $str.=$param[$i].'-';
                                            }
                                        }
                                        $str = substr($str,0,-1);
                                        $url = U('Product/purposeList/param/'.$str.'/order_param/'.$order_param.'#p');
                                ?>
                                    <a href="<?php echo $url;?>" <?php if($param[1] == $j){echo 'class="current8"';} ?> ><?php echo $price_search[$j];?></a>
                               <?php endfor; ?>
                                
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- /list -->
                <!-- 筛选 -->
                <div class="screen mt10">
                    <ul>
                        <li><a href="<?php echo U('Product/purposeList/param/'.implode('-', $param).'/order_param/0#p');?>">默认排序</a></li>

                        <li><a  <?php $tmp_order_num=1; if($order_param==1){echo 'class="current12"'; $tmp_order_num=2;}else if($order_param==2){echo 'class="current13"'; $tmp_order_num=1;} ?>  href="<?php echo U('Product/purposeList/param/'.implode('-', $param).'/order_param/'.$tmp_order_num.'#p');?>"  
                         >最新</a></li>

                         <li><a  <?php $tmp_order_num=3; if($order_param==3){echo 'class="current12"'; $tmp_order_num=4;}else if($order_param==4){echo 'class="current13"'; $tmp_order_num=3;} ?>  href="<?php echo U('Product/purposeList/param/'.implode('-', $param).'/order_param/'.$tmp_order_num.'#p');?>"  
                         >销量</a></li>

                         <li><a  <?php $tmp_order_num=5; if($order_param==5){echo 'class="current12"'; $tmp_order_num=6;}else if($order_param==6){echo 'class="current13"'; $tmp_order_num=5;} ?>  href="<?php echo U('Product/purposeList/param/'.implode('-', $param).'/order_param/'.$tmp_order_num.'#p');?>"  
                         >价格</a></li>

                        
                        <li>
                        <?php
                            $str = '';
                            $url = '';
                            for($i=0;$i<$total;$i++){
                                if($i==1){
                                    $str.='price-';
                                }else{
                                    $str.=$param[$i].'-';
                                }
                            }
                            $str = substr($str,0,-1);
                            $tmp_price = explode('_',$param[1]);
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
                                    str = str.replace("price",min_price+'_'+max_price);
                                    window.location.href="__URL__/purposeList/param/"+str+"/order_param/"+"<?php echo $order_param; ?>"+"#p";
                                });
                                $("#clean_form").click(function(e){
                                    var str = "<?php echo $str; ?>";
                                    str = str.replace("price",0);
                                    window.location.href="__URL__/purposeList/param/"+str+"/order_param/"+"<?php echo $order_param; ?>"+"#p";
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
                     <?php if(empty($items)){?>
                       <div class="width center mt40">
                         <p class="c666 font-38 mb40">您搜索的商品不存在，建议减少搜索条件</p>
                        </div>
                     <?php }else{ ?>
                    <ul>
                    <volist name="items" id="vo">
                        <li>
                           <div class="width buy">
                                <a href="#" class=""></a>
                                <a href="#" class=""></a>
                            </div>
                            <div class="propic img100"><a href="<?php echo U('Product/productDetail',array('item_id'=>$vo['item_id']));?>">
                            <?php if(!empty($vo['img_uri'])){ ?>
                               <img src="{$vo.img_uri}" width="220px" height="220px">
                            <?php }else{ ?>
                                <img src="/Public/upload/watermark.jpg">
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
                <?php   }?>
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