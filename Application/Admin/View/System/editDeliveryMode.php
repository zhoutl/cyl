<?php W('Admin/head',array(array('admin_user_id'=>$admin_user_id)));?>

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
                    <h4><i class="icon-bar-chart"></i> &nbsp; <span id="page_title">修改配送</span></h4>
                </div>
                <div class="f_r">
                	<a class="btn btn-success" href="<?php echo U('System/deliveryModeList') ?>"><i class="icon-reorder"></i> &nbsp; 管理列表</a>
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
                	<div class="add_from_head">修改配送</div>
                	<div class="add_from_body">
                    <form action="<?php echo U('System/editDeliveryMode',array('id'=>$data['list']['delivery_mode_id'])); ?>" method="post" id="adminForm">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="add_from_table">
                      <tr>
                        <td align="left" valign="top" class="aft_l">配送名称</td>
                        <td align="left" valign="middle" class="aft_r"><input type="text" name="name" value="<?php echo $data['list']['name']; ?>" class="form-control the_text3 verify_text"  placeholder="请输入配送名称" errormsg="配送名称为1-20个字" nullmsg="请输入配送名称" datatype="*1-20"></td>
                      </tr>
					  <tr>
                        <td align="left" valign="top" class="aft_l">配送描述</td>
                        <td align="left" valign="middle" class="aft_r">
							<textarea class="form-control the_text3 verify_text" rows="5" name="description" placeholder="请输入配送描述" errormsg="配送描述为1-200个字" nullmsg="请输入配送描述" datatype="*1-200" ignore="ignore"><?php echo $data['list']['description']; ?></textarea>
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