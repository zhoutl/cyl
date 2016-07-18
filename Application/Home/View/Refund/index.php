<?php W('Home/head',array('seo_data'=>$seo_data));?>

<link rel="stylesheet" type="text/css" href="__PUBLIC__/Home/css/page.css">

<!--wrap-->
    <div class="thewidth100 bg_gray clearfix"> 
        <div class="user-line clearfix">
            <div class="thewidth">
                <div class="width font-12 c666">
                    <a href="<?php echo U('Index/index');?>">首页 </a>><a href="<?php echo U('Account/index');?>">个人中心 </a>>我的退货
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
                                <div class="width order-top">
                                    <span class="f_l font-20">我的退货</span>
                                    <button type="button" class="btn btn-sm ml5 order-btn f_r mt10">查询</button>
                                    <input type="text" name="" value="" placeholder="请输入订单号" class="order-kk f_r mr5 mt10">
                                    
                                </div>
                                <table class="jftable center mt10 f_l font-12 c6" cellpadding="0">
                                    <thead>
                                        <tr>
                                            <th class="wb20 f_l">订单编号</th>
                                            <th class="wb30 f_l">酒品明细</th>
                                            <th class="wb15 f_l">退款总额</th>
                                            <th class="wb10 f_l">申请时间</th>
                                            <th class="wb10 f_l">退货原因</th>
                                            <th class="wb15 f_l">退货状态</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php foreach ($data['refund'] as $key => $value) :?>
                                      <tr>
                                            <td class="wb20 f_l"><?php echo $value['order_no'];?></td>
                                            <td class="wb30 f_l">
                                        <?php foreach ($value['refund_item'] as $k => $v): ?>
                                                  <div class="width mb10">
                                                    <div class="order-pic img100">
                                            <?php if(!empty($v['img_uri'])){ ?>
                                               <img src="__ROOT__{$v.img_uri}">
                                            <?php }else{ ?>
                                                <img src="__ROOT__/Public/upload/watermark.jpg">
                                            <?php } ?>
                                                    </div>
                                                    <div class="order-text ml10"><?php echo $v['item_name'];?></div>
                                                </div>
                                        <?php endforeach; ?>  
                                            </td>
                                            <td class="wb15 f_l">¥<?php echo $value['refund_amount'];?></td>
                                            <td class="wb10 f_l"><?php echo date('Y-m-d',$value['apply_time']);?></td>
                                            <td class="yellow3 wb10 f_l"><?php echo $value['reason'];?></td>
                                            <td class="wb15 f_l">
                                                <a  class="green"><?php echo $value['status_title'];?></a><br>
                                                <a href="<?php echo U('Refund/refundDetail',array('orders_refund_id'=>$value['orders_refund_id']));?>" class="c666">查看详情</a>
                                            </td>
                                        </tr>
                                <?php endforeach; ?>



                                        
                                    </tbody>

                                <!--分页-->
                                <div class="list_box_bottom">
                                    <div class="page">
                                        <?php echo $page->show();?>
                                    </div>
                                 </div>  
                                
                                <!--/分页-->
                                </table>
                            </div>
                            <!-- /订单明细 -->
                            
                        </div>
                        
                    </div>
                    <!-- /right -->
                </div>
            </div>
          
             
    </div>
<!--/wrap-->


<?php W('Home/foot');?>