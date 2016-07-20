<?php if (!defined('THINK_PATH')) exit(); W('Admin/head',array(array('admin_user_id'=>$admin_user_id)));?>


	<!-- 文件上传  -->
<script src="/cyl/Public/Common/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="/cyl/Public/Common/uploadify/uploadify.css">
<script>
	$(function() {
		$("#uploadify").uploadify({
			'fileSizeLimit'	: '2048KB',     //最大上传大小为2048KB
			'height'        : 30,
			'swf'           : '/cyl/Public/Common/uploadify/uploadify.swf',
			'uploader'      : '<?php echo U('Common/uploadifyHomeImage'); ?>',
			'width'         : 120,
			'queueID'		  : 'fileQueue',
			'auto'		  : true,
			'fileTypeExts'  : '*.jpg;*.jpeg;*.png;*.gif;',     //可上传文件类型
			'fileTypeDesc'  : '请选择jpg、jpeg、png、gif类型的文件',
			'multi'		  : true,
			'onUploadSuccess':  function(file, data,response) {
				var data = eval('('+data+')');
				$("#file_img").html("<img src='"+data.file+"' width='576' height='324' />");
				$("input[name=img_uri]").val(data.file);
			}
		});
	});
	
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
                    <h4><i class="icon-bar-chart"></i> &nbsp; <span id="page_title">新增BANNER</span></h4>
                </div>
                <div class="f_r">
                	<a class="btn btn-success" href="<?php echo U('Home/bannerList') ?>"><i class="icon-reorder"></i> &nbsp; 管理列表</a>
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
                	<div class="add_from_head">新增BANNER</div>
                	<div class="add_from_body">
                    <form action="<?php echo U('Home/addBanner'); ?>" method="post" id="adminForm">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="add_from_table">
                      <tr>
                        <td align="left" valign="top" class="aft_l">BANNER名称</td>
                        <td align="left" valign="middle" class="aft_r"><input type="text" name="name" class="form-control the_text3 verify_text"  placeholder="请输入BANNER名称" errormsg="BANNER名称为1-20个字" nullmsg="请输入BANNER名称" datatype="*1-20"></td>
                      </tr>
					  
						<tr>
						<td align="left" valign="top" class="aft_l">所属版本</td>
						<td align="left" valign="middle" class="aft_r">
						<select class="form-control the_text2 f_l" name="type" nullmsg="请选择所属版本" errormsg="请选择所属版本" datatype="/^[1-9][0-9]{0,}$/">
							<option value="0">请选择所属版本</option>
							<option value="1">PC版本</option>
							<option value="2">WAP版本</option>
							<option value="3">APP版本</option>
						</select>

						</td>
                        </tr>
					  
					  <tr>
                        <td align="left" valign="top" class="aft_l">链接地址</td>
                        <td align="left" valign="middle" class="aft_r"><input type="text" name="link_url" class="form-control the_text3 verify_text"  placeholder="请输入链接地址" errormsg="请输入正确格式的链接地址" nullmsg="请输入链接地址" datatype="url" ignore="ignore"></td>
                      </tr>
					  
					  <tr>
                        <td align="left" valign="top" class="aft_l">类别图片(1920*1082px)</td>
                        <td align="left" valign="middle" class="aft_r">
							<input type="file" name="file_upload" id="uploadify" />
						</td>
                      </tr>
					  <tr>
                        <td align="left" valign="top" class="aft_l">&nbsp;</td>
                        <td align="left" valign="middle" class="aft_r" id="file_img">
							
						</td>
                      </tr>
					  
					  <tr>
                        <td align="left" valign="top" class="aft_l">是否显示</td>
						<td align="left" valign="middle" class="aft_r">
							<label class="radio-inline"><input type="radio" name="is_show" value="1" checked />是</label>
							<label class="radio-inline"><input type="radio" name="is_show" value="0" />否</label>
						</td>
                      </tr>
        
                      <tr>
                        <td align="left" valign="top" class="aft_l">排序</td>
                        <td align="left" valign="middle" class="aft_r"><input type="text" name="orderno" class="form-control the_text3 verify_text"  placeholder="请输入排序数字" errormsg="请输入数字" nullmsg="请输入排序数字" datatype="n"></td>
                      </tr>
                    </table>

                    
                    <div class="add_from_table_bottom">
					<input type="hidden" name="img_uri" />
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