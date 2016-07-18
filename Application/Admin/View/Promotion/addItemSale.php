<?php W('Admin/head',array(array('admin_user_id'=>$admin_user_id)));?>

<script src="__PUBLIC__/Admin/js/commondata.js"></script>


<script>
$(function(){
    $("#item_button").click(function(){
        var item_name=$("input[name=item_name]").val();
        $.ajax({
			url:"<?php echo U('Common/getItemInfo'); ?>",
			type:"POST",
			data:{item_name:item_name},
			success:function(data, textStatus){
				if(data.status==1){
					$("#item_select").html(data.html);
				}
			}
		})
    });
})
</script>

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
                    <h4><i class="icon-bar-chart"></i> &nbsp; <span id="page_title">新增促销商品</span></h4>
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
                    <form action="<?php echo U('Promotion/addItemSale'); ?>" method="post" id="adminForm">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="add_from_table">
						<tr>
							<td align="left" valign="top" class="aft_l">搜索商品</td>
							<td align="left" valign="middle" class="aft_r">
								 <input type="text" class="form-control the_text3 verify_text" name="item_name" placeholder="请输入要搜索的商品名称"/><button type="button" class="btn btn-success" id="item_button"><i class="icon-reorder"></i> &nbsp;搜索商品</button>
							</td>
						</tr>
						<tr>
							<td align="left" valign="top" class="aft_l">商品选择</td>
							<td align="left" valign="middle" class="aft_r" id="item_select">
								
							</td>
						</tr>
						
						<tr>
							<td align="left" valign="top" class="aft_l">促销价格</td>
							<td align="left" valign="middle" class="aft_r">
								<input style="float:left;" datatype="f2" nullmsg="请输入促销价格" errormsg="请输入正确格式的促销价格"  name="sale_price" type="text" class="form-control the_text2" placeholder="请输入促销价格" />元
							</td>
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