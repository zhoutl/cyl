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
                    <h4><i class="icon-bar-chart"></i> &nbsp; <span id="page_title">新增现金券</span></h4>
                </div>
                <div class="f_r">
                	<a class="btn btn-success" href="<?php echo U('Vouchers/cashVoucherList') ?>"><i class="icon-reorder"></i> &nbsp; 管理列表</a>
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
                	<div class="add_from_head">新增现金券</div>
                	<div class="add_from_body">
                    <form action="<?php echo U('Vouchers/addCashVoucher'); ?>" method="post" id="adminForm">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="add_from_table">
                      <tr>
                        <td align="left" valign="top" class="aft_l">现金券名称</td>
                        <td align="left" valign="middle" class="aft_r"><input type="text" name="voucher_name" class="form-control the_text3 verify_text"  placeholder="请输入现金券名称" errormsg="现金券名称为1-20个字" nullmsg="请输入现金券名称" datatype="*1-20"></td>
                      </tr>
                      <tr>
                        <td align="left" valign="top" class="aft_l">使用平台</td>
                        <td align="left" valign="middle" class="aft_r">
							<label class="checkbox-inline"> 
								<input type="checkbox" name="is_pc" checked="checked" value="1">pc
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="is_wap" checked="checked" value="1">wap
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="is_app" checked="checked" value="1">app
							</label>
						</td>
                      </tr>
					  <tr>
                        <td align="left" valign="top" class="aft_l">现金券面额</td>
                        <td align="left" valign="middle" class="aft_r"><input type="text" name="voucher_amount" class="form-control the_text3 verify_text"  placeholder="请输入现金券面额" errormsg="请输入正确的金额" nullmsg="请输入现金券面额" datatype="f2">元</td>
                      </tr>
					  
					  <tr>
                        <td align="left" valign="top" class="aft_l">最低使用条件</td>
                        <td align="left" valign="middle" class="aft_r"><input type="text" name="limit_amount" class="form-control the_text3 verify_text"  placeholder="请输入最低使用条件" errormsg="请输入正确的金额" nullmsg="请输入最低使用条件" datatype="f2">元</td>
                      </tr>
					  
					  <tr>
                        <td align="left" valign="top" class="aft_l">现金券总数</td>
                        <td align="left" valign="middle" class="aft_r"><input type="text" name="voucher_quantity" class="form-control the_text3 verify_text"  placeholder="请输入现金券总数" errormsg="请输入正确的数字" nullmsg="请输入现金券总数" datatype="n"></td>
                      </tr>
					  
					  <tr>
                        <td align="left" valign="top" class="aft_l">现金券安全码</td>
                        <td align="left" valign="middle" class="aft_r"><input type="text" name="security_code" class="form-control the_text3 verify_text"  placeholder="请输入3位现金券安全码" errormsg="现金券安全码由3位数字字母组成" nullmsg="请输入3位现金券安全码" datatype="/^[0-9A-Za-z]{3}$/"></td>
                      </tr>
					  
					  <tr>
                        <td align="left" valign="top" class="aft_l">开始时间</td>
                        <td align="left" valign="middle" class="aft_r">
							 <input id="start_time" name="start_time" class="form-control the_text3 verify_text laydate-icon" errormsg="请选择开始时间" nullmsg="请选择开始时间">
						</td>
                      </tr>
					  
					  <tr>
                        <td align="left" valign="top" class="aft_l">结束时间</td>
                        <td align="left" valign="middle" class="aft_r">
							 <input id="end_time" name="end_time" class="form-control the_text3 verify_text laydate-icon" errormsg="请选择结束时间" nullmsg="请选择结束时间">
						</td>
                      </tr>
					  
					  <tr>
                        <td align="left" valign="top" class="aft_l">是否启用</td>
						<td align="left" valign="middle" class="aft_r">
							<label class="radio-inline"><input type="radio" name="status" value="1" checked="checked">启用</label>
							<label class="radio-inline"><input type="radio" name="status" value="0">禁用</label>
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