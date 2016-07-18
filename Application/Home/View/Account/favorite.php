<?php W('Home/head',array('seo_data'=>$seo_data));?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Home/css/page.css">
<script type="text/javascript"src="__PUBLIC__/Home/js/account/favorite.js" ></script> 

<!--wrap-->
    <div class="thewidth100 bg_gray clearfix"> 
        <div class="user-line clearfix">
            <div class="thewidth">
                <div class="width font-12 c666">
                    <a href="<?php echo U('Index/index') ?>">首页 </a>><a href="<?php echo U('Account/index') ?>">个人中心 </a>>我的收藏
                </div>
                </div>
                </div> 
                <div  class="thewidth">
                <div class="mainbox mt15">
                    <!-- left -->
                    <?php W('Home/menu');?>
                    <!-- /left -->
                    <!-- right -->
                    <div class="mainright">
                        <div class="width pdl20">
                            <div class="width order-top"><span class="f_l font-20">我的收藏</span></div>
                            <div class="width mt20 c666">
                                            <a href="javascript:;" class="allmess f_l">全选</a>
                                            <a href="javascript:;" class="f_l remove" onclick="choose_deletes()" >移出收藏夹</a>
                                        </div>
                            <table class="jftable center mt20 f_l c6" cellpadding="0">
                                    <thead>
                                        <tr>
                                            <th class="wb10 f_l">&nbsp;</th>
                                            <th class="wb40 f_l">酒品明细</th>
                                            <th class="wb15 f_l">酒品价格</th>
                                            <th class="wb20 f_l">收藏时间</th>
                                            <th class="wb15 f_l">操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($data as $key => $vo) { ?>
                                        <tr name="data_<?php echo $vo['account_favorite_id']; ?>" >
                                            <td class="wb10 f_l">
                                            <!-- <a href="javascript:;" class="choose active mt20"></a> -->
                                            <a href="javascript:;" class="choose mt20" id="<?php echo $vo['account_favorite_id'] ?>" ></a>
                                            </td>
                                            <td class="wb40 f_l">
                                                <div class="order-pic img100">
                                            <?php if (!empty($vo['img_uri'])) { ?>
                                                <img src="<?php echo $vo['img_uri'] ?>">
                                            <?php }else{ ?>
                                                <img src="/Public/upload/watermark.jpg">
                                            <?php } ?>
                                                </div>
                                                <div class="order-text ml10"><?php echo $vo['name'] ?></div>
                                            </td>
                                            <td class="wb15 f_l">¥<?php echo $vo['online_price'] ?></td>
                                            <td class="wb20 f_l"><?php echo date('Y-m-d',$vo['pubdate']) ?></td>
                                            <td class="wb15 f_l">
                                              <a href="<?php echo U('Product/productDetail',array('item_id'=>$vo['item_id']));?>" class="red">查看详情</a>
                                              <br>
                                              <a href="javascript:;" class="c999" 
                                              onclick="choose_delete(<?php echo $vo['account_favorite_id'] ?>)" >取消收藏</a>
                                            </td>
                                        </tr>
                                   <?php } ?>
                                        
                                        
                                        
                                    </tbody>
                                </table>
                                <?php if (empty($data)) { ?>
                                <div class="width center font-18 mt30 c666">你还没有收藏商品~~~~</div>
                                <?php } ?>

                    </div>
                    <div class="list_box_bottom">
                        <div class="page">
                            <?php echo $pages->show();?>
                        </div>
                    </div> 
                     
                    </div>
                    <!-- /right -->
                </div>
            </div>
          
             
    </div>
<!--/wrap-->


<script type="text/javascript">
$(function(){
        clear();

    // 全选
    $(".allmess").click(function(){
        $(this).toggleClass("active");
        if($(this).hasClass("active")){
            $(".choose").addClass("active");
        } else{
            $(".choose").removeClass("active");
        }
        
    })
})
    function clear() {
    $(".choose").each(function() {
        $(this).click(function(){
            $(this).toggleClass("active");
        })  
        
    });
}


</script>
<?php W('Home/foot');?>