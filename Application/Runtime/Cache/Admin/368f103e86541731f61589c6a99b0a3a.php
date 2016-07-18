<?php if (!defined('THINK_PATH')) exit(); W('Admin/head',array(array('admin_user_id'=>$admin_user_id)));?>

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
                    <h4><i class="icon-bar-chart"></i> &nbsp; <span id="page_title">系统配置</span></h4>
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
                	<div class="add_from_head">系统配置</div>
                	<div class="add_from_body">
                    <form action="<?php echo U('System/systemConfig'); ?>" method="post" id="adminForm">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="add_from_table">
                      <tr>
                        <td align="left" valign="top" class="aft_l">网站标题</td>
                        <td align="left" valign="middle" class="aft_r"><input type="text" name="title" class="form-control the_text3 verify_text" value="<?php echo $data['list']['title']; ?>"  placeholder="请输入网站标题" errormsg="网站标题为1-50个字" nullmsg="请输入网站标题" datatype="*1-50" ignore="ignore"></td>
                      </tr>
                      <tr>
                        <td align="left" valign="top" class="aft_l">网站关键字</td>
                        <td align="left" valign="middle" class="aft_r"><input type="text" name="keywords" class="form-control the_text3 verify_text" value="<?php echo $data['list']['keywords']; ?>"  placeholder="请输入网站关键字" errormsg="网站关键字为1-50个字" nullmsg="请输入网站关键字" datatype="*1-50" ignore="ignore"></td>
                      </tr>
					  
					  <tr>
                        <td align="left" valign="top" class="aft_l">版权信息</td>
                        <td align="left" valign="middle" class="aft_r"><input type="text" name="copyright" class="form-control the_text3 verify_text" value="<?php echo $data['list']['copyright']; ?>"  placeholder="请输入网站版权信息" errormsg="网站版权信息为1-50个字" nullmsg="请输入网站版权信息" datatype="*1-50" ignore="ignore"></td>
                      </tr>
        
                      <tr>
                        <td align="left" valign="top" class="aft_l">网站描述</td>
                        <td align="left" valign="middle" class="aft_r">
							<textarea class="form-control the_text3 verify_text" rows="5" name="description" placeholder="请输入网站描述" errormsg="网站描述为1-200个字" nullmsg="请输入网站描述" datatype="*1-200" ignore="ignore"><?php echo $data['list']['description']; ?></textarea>
						</td>
                      </tr>
					  
					  <tr>
                        <td align="left" valign="top" class="aft_l">头部附加代码</td>
                        <td align="left" valign="middle" class="aft_r">
							<textarea class="form-control the_text3 verify_text" rows="5" name="header_code" placeholder="请输入头部附加代码" errormsg="请输入头部附加代码" nullmsg="请输入头部附加代码" datatype="*" ignore="ignore"><?php echo $data['list']['header_code']; ?></textarea>
						</td>
                      </tr>
					  
					  <tr>
                        <td align="left" valign="top" class="aft_l">底部附加代码</td>
                        <td align="left" valign="middle" class="aft_r">
							<textarea class="form-control the_text3 verify_text" rows="5" name="footer_code" placeholder="请输入底部附加代码" errormsg="请输入底部附加代码" nullmsg="请输入底部附加代码" datatype="*" ignore="ignore"><?php echo $data['list']['footer_code']; ?></textarea>
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