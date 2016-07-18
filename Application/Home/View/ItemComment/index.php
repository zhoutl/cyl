<?php W('Home/head',array('seo_data'=>$seo_data));?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Common/fancybox/fancybox.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Home/css/page.css">
<script type="text/javascript" src="__PUBLIC__/Common/fancybox/jquery.fancybox-1.3.1.pack.js" ></script>


<!--wrap-->
    <div class="thewidth100 bg_gray clearfix"> 
        <div class="user-line clearfix">
            <div class="thewidth">
                <div class="width font-12 c666">
                    <a href="<?php echo U('Index/index') ?>">首页 </a>><a href="<?php echo U('Account/index') ?>">个人中心 </a>>我的评价
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
                            <!-- 订单明细 -->
                            <div class="width">
                                <div class="width order-top"><span class="f_l font-20">我的评价</span></div>
                                <table class="jftable mt10 f_l font-12 pj c6" cellpadding="0">
                                    <tbody>
                                    <?php if (empty($data['list'])) { ?>
                                        <div class="width center font-18 mt30 c666">暂无评论~~~~</div>
                                    <?php } ?>
                                    <?php foreach ($data['list'] as $key => $vo) { ?>
                                        <tr>
                                            <td class="width mb15">
                                                <div class="width pj-top2">
                                                  订单编号：<?php echo $vo['orderno'] ?>
                                                </div>
                                                <div class="wb50 f_l">
                                                    <div class="order-pic img100 ml32">
                                                         <a href="<?php echo U('Product/productDetail',array('item_id' => $vo['item_id'])) ?>">
                                                           <img src="<?php echo $vo['img_item']['img_uri'] ?>">
                                                         </a>
                                                    </div>
                                                    <div class="order-text2 ml10 mp">
                                                        <p>
                                                           <a href="<?php echo U('Product/productDetail',array('item_id' => $vo['item_id'])) ?>">
                                                               <?php echo $vo['items']['item_name'] ?>
                                                           </a>
                                                          
                                                        </p>
                                                        
                                                    </div>
                                                </div>                                               
                                                <div class="width pjbox pr ">
                                                    <em></em>
                                                    <div class="width">
                                                        <div class="wb10 f_l ml25">评分：</div>
                                                        <div class="wb85 f_l">
                                                            <div class="pjstar ml15">
                                                            <?php for ($i=1;$i<=$vo['score'];$i++) {?>
                                                                <img src="__PUBLIC__/Home/images/user/star-on.png" class="f_l mr5">
                                                            <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="width mt10 ml25">
                                                        <div class="wb10 f_l">感受：</div>
                                                        <div class="wb85 f_l ml15 tx-l">
                                                            <?php echo $vo['content'] ?>
                                                        </div>
                                                    </div>
                                                    <div class="width mt10 ml25">
                                                    <?php if (!empty($vo['reply_list'])) { ?>
                                                    <?php foreach ($vo['reply_list'] as $k => $v) { ?>
                                                        <div class="wb10 f_l c999">掌柜回复：</div>
                                                        <div class="wb85 f_l ml15 tx-l yellow2">
                                                           <?php echo $v['content'] ?>
                                                        </div>
                                                    <?php }} ?>
                                                        
                                                    </div>
                                                    <div class="width mt10 ml25">
                                                        <div class="wb10 f_l">
                                                        <?php $var = empty($vo['img_list']) ?'':'晒单:';echo $var; ?>
                                                        </div>
                                                        <div class="wb85 f_l ml15">
                                                            <div class="photo img100">
                                                                <ul>
                                                                <?php foreach ($vo['img_list'] as $k => $v) { ?>
                                                                    <li>
                                                                      <a rel="group" href="<?php echo $v['img_uri'] ?>" title='晒图' >
                                                                         <img src="<?php echo $v['img_uri'] ?>" height="78" >
                                                                      </a>
                                                                    </li>
                                                                <?php } ?>
                                                                    
                                                                </ul>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?> 
                            
                                    </tbody>
                                </table>
                            </div>
                            <!-- 订单明细 -->
                            <!-- 分页样式 -->
                            <div class="list_box_bottom">
                                <div class="page">
                                    <?php echo $data['pages']->show();?>
                                </div>
                             </div>
                            <!-- 分页样式 -->
                        </div>
                        
                    </div>
                    <!-- /right -->
                </div>
            </div>
          
             
    </div>
<!--/wrap-->
<script type="text/javascript">
$(function(){
    $("a[rel=group]").fancybox({
     'titlePosition' : 'over',
     'cyclic'        : true,
     'titleFormat'   : function(title, currentArray, currentIndex, currentOpts) {
       return '<span id="fancybox-title-over">' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
       }
    });
});
   
</script>
<?php W('Home/foot');?>
