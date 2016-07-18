<?php W('Admin/head',array(array('admin_user_id'=>$admin_user_id)));?>

<script src="__PUBLIC__/Admin/js/commondata.js"></script>

    <!--main-->
    <div id="main" class="clearfix">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="main_table_left" align="left" valign="top">

    	<?php W('Admin/menu',array(array('admin_user_id'=>$admin_user_id)));?>
        
        </td>
        <td class="main_table_right" align="left" valign="top">


        <!--right-->
        <div id="Right">
        
        
        
        
            <!--page_right_header-->
            <div class="page_right_header">
<!---------------[ TITLE ]--------------->

                <div class="f_l">
                    <h4><i class="icon-bar-chart"></i> &nbsp; <span id="page_title">修改订单满减</span></h4>
                </div>
                <div class="f_r">
                	<a class="btn btn-success" href="<?php echo U('Vouchers/ordersReductionList') ?>"><i class="icon-reorder"></i> &nbsp; 管理列表</a>
                </div>

<!---------------[ /TITLE ]--------------->
            </div>
            <!--/page_right_header-->
            
            <!--page_right_bodyer-->
            <div class="page_right_bodyer">
            
            <!--List-->
            <div class="list_box">
<!---------------[ BODY ]--------------->
				
                
                <div class="ja_add_from mb20">
                	<div class="add_from_head">修改订单满减</div>
                	<div class="add_from_body">
                    <form action="<?php echo U('Promotion/editOrdersReduction',array('id'=>$data['list']['orders_reduction_id'])); ?>" method="post" id="adminForm">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="add_from_table">
                      <tr>
                        <td align="left" valign="top" class="aft_l">活动名称</td>
                        <td align="left" valign="middle" class="aft_r"><input type="text" name="name" value="<?php echo $data['list']['name']; ?>" class="form-control the_text3 verify_text"  placeholder="请输入活动名称" errormsg="活动名称为1-20个字" nullmsg="请输入活动名称" datatype="*1-20"></td>
                      </tr>
                      <tr>
                        <td align="left" valign="top" class="aft_l">使用平台</td>
                        <td align="left" valign="middle" class="aft_r">
							<label class="checkbox-inline"> 
								<input type="checkbox" name="is_pc" <?php if($data['list']['is_pc']){echo 'checked="checked"';} ?> value="1">pc
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="is_wap" <?php if($data['list']['is_wap']){echo 'checked="checked"';} ?> value="1">wap
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="is_app" <?php if($data['list']['is_app']){echo 'checked="checked"';} ?> value="1">app
							</label>
						</td>
                      </tr>
					  <tr>
                        <td align="left" valign="top" class="aft_l">满额条件</td>
                        <td align="left" valign="middle" class="aft_r"><input type="text" name="limit_orders_amount" value="<?php echo $data['list']['limit_orders_amount']; ?>" class="form-control the_text3 verify_text"  placeholder="请输入满额条件" errormsg="请输入正确的金额" nullmsg="请输入满额条件" datatype="f2">元</td>
                      </tr>
					  
					  <tr>
                        <td align="left" valign="top" class="aft_l">优惠金额</td>
                        <td align="left" valign="middle" class="aft_r"><input type="text" name="reduction_amount" value="<?php echo $data['list']['reduction_amount']; ?>" class="form-control the_text3 verify_text"  placeholder="请输入优惠金额" errormsg="请输入正确的金额" nullmsg="请输入优惠金额" datatype="f2">元</td>
                      </tr>
					  
					  <tr>
                        <td align="left" valign="top" class="aft_l">开始时间</td>
                        <td align="left" valign="middle" class="aft_r">
							 <input id="start_time" name="start_time" value="<?php echo date("Y-m-d H:i:s",$data['list']['start_time']); ?>"  class="form-control the_text3 verify_text laydate-icon" errormsg="请选择开始时间" nullmsg="请选择开始时间">
						</td>
                      </tr>
					  
					  <tr>
                        <td align="left" valign="top" class="aft_l">结束时间</td>
                        <td align="left" valign="middle" class="aft_r">
							 <input id="end_time" name="end_time" value="<?php echo date("Y-m-d H:i:s",$data['list']['end_time']); ?>" class="form-control the_text3 verify_text laydate-icon" errormsg="请选择结束时间" nullmsg="请选择结束时间">
						</td>
                      </tr>
					  
                    </table>

                    
                    <div class="add_from_table_bottom">
                    <button type="submit" class="btn btn-success btn-lg form_submit" ><i class="icon-ok-sign"></i> &nbsp; 提交表单</button>
                    <button type="reset" class="btn btn-warning btn-lg" ><i class="icon-undo"></i><span> &nbsp; 重置表单</button>
                    </div>
                    
                    
                    
                    </form>
                   	</div>
                </div>
                

                
                
                
<!---------------[ /BODY ]--------------->
            </div>
            <!--/List-->
            
            
            
            </div>
            <!--/page_right_bodyer-->
        
        
        
        
        </div>
        <!--/right-->


        </td>
        </tr>
        </table>
            
        
    
    </div>
    <!--/main-->

<?php W('Admin/foot');?>