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
                    <h4><i class="icon-bar-chart"></i> &nbsp; <span id="page_title">修改促销商品</span></h4>
                </div>
                <div class="f_r">
                	<a class="btn btn-success" href="<?php echo U('Promotion/itemSaleList') ?>"><i class="icon-reorder"></i> &nbsp; 管理列表</a>
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
                	<div class="add_from_head">新增促销商品</div>
                	<div class="add_from_body">
                    <form action="<?php echo U('Promotion/editItemSale',array('id'=>$data['list']['item_sale_id'])); ?>" method="post" id="adminForm">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="add_from_table">
						<tr>
							<td align="left" valign="top" class="aft_l">商品名称</td>
							<td align="left" valign="middle" class="aft_r">
								<?php echo M('Item')->where('item_id='.$data['list']['item_id'])->getField('name'); ?>
							</td>
						</tr>
						
						<tr>
							<td align="left" valign="top" class="aft_l">促销价格</td>
							<td align="left" valign="middle" class="aft_r">
								<input style="float:left;" datatype="f2" nullmsg="请输入促销价格" errormsg="请输入正确格式的促销价格"  name="sale_price" value="<?php echo $data['list']['sale_price']; ?>" type="text" class="form-control the_text2" placeholder="请输入促销价格" />元
							</td>
						</tr>
					 
					  
					  <tr>
                        <td align="left" valign="top" class="aft_l">开始时间</td>
                        <td align="left" valign="middle" class="aft_r">
							 <input id="start_time" name="start_time" value="<?php echo date('Y-m-d H:i:s',$data['list']['start_time']); ?>" class="form-control the_text3 verify_text laydate-icon" errormsg="请选择开始时间" nullmsg="请选择开始时间">
						</td>
                      </tr>
					  
					  <tr>
                        <td align="left" valign="top" class="aft_l">结束时间</td>
                        <td align="left" valign="middle" class="aft_r">
							 <input id="end_time" name="end_time"  value="<?php echo date('Y-m-d H:i:s',$data['list']['end_time']); ?>" class="form-control the_text3 verify_text laydate-icon" errormsg="请选择结束时间" nullmsg="请选择结束时间">
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