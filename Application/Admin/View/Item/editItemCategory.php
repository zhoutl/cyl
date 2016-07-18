<?php W('Admin/head',array(array('admin_user_id'=>$admin_user_id)));?>

	<!-- 文件上传  -->
<script src="__PUBLIC__/Common/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Common/uploadify/uploadify.css">
<script>
	$(function() {
		$("#uploadify").uploadify({
			'fileSizeLimit'	: '2048KB',     //最大上传大小为2048KB
			'height'        : 30,
			'swf'           : '__PUBLIC__/Common/uploadify/uploadify.swf',
			'uploader'      : '<?php echo U('Common/uploadifyIcon'); ?>',
			'width'         : 120,
			'queueID'		  : 'fileQueue',
			'auto'		  : true,
			'fileTypeExts'  : '*.jpg;*.jpeg;*.png;*.gif;',     //可上传文件类型
			'fileTypeDesc'  : '请选择jpg、jpeg、png、gif类型的文件',
			'multi'		  : true,
			'onUploadSuccess':  function(file, data,response) {
				var data = eval('('+data+')');
				$("#file_img").html("<img src='"+data.file+"' width='27' height='27' />");
				$("input[name=icon]").val(data.file);
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
                    <h4><i class="icon-bar-chart"></i> &nbsp; <span id="page_title">修改分类</span></h4>
                </div>
                <div class="f_r">
                	<a class="btn btn-success" href="<?php echo U('Item/itemCategoryList') ?>"><i class="icon-reorder"></i> &nbsp; 管理列表</a>
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
                	<div class="add_from_head">修改分类</div>
                	<div class="add_from_body">
                    <form action="<?php echo U('Item/editItemCategory',array('id'=>$data['list']['item_category_id'])); ?>" method="post" id="adminForm">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="add_from_table">
                      <tr>
                        <td align="left" valign="top" class="aft_l">类别名称</td>
                        <td align="left" valign="middle" class="aft_r"><input type="text" name="category_name" value="<?php echo $data['list']['category_name']; ?>" class="form-control the_text3 verify_text"  placeholder="请输入类别名称" errormsg="类别名称为1-20个字" nullmsg="请输入类别名称" datatype="*1-20"></td>
                      </tr>
					  
					  <tr>
                        <td align="left" valign="top" class="aft_l">类别图片(27*27px)</td>
                        <td align="left" valign="middle" class="aft_r">
							<input type="file" name="file_upload" id="uploadify" />
						</td>
                      </tr>
					  <tr>
                        <td align="left" valign="top" class="aft_l">&nbsp;</td>
                        <td align="left" valign="middle" class="aft_r" id="file_img">
							<img src="<?php echo $data['list']['icon']; ?>" width="27" height="27"/>
						</td>
                      </tr>
					  
					  <tr>
                        <td align="left" valign="top" class="aft_l">seo标题</td>
                        <td align="left" valign="middle" class="aft_r"><input type="text" name="seo_title" value="<?php echo $data['list']['seo_title']; ?>"  class="form-control the_text3 verify_text"  placeholder="请输入seo标题" errormsg="seo标题为1-50个字" nullmsg="请输入seo标题" datatype="*1-50" ignore="ignore"></td>
                      </tr>
					  
					  <tr>
                        <td align="left" valign="top" class="aft_l">seo关键字</td>
                        <td align="left" valign="middle" class="aft_r"><input type="text" name="seo_keywords" value="<?php echo $data['list']['seo_keywords']; ?>"  class="form-control the_text3 verify_text"  placeholder="请输入seo关键字" errormsg="seo关键字为1-50个字" nullmsg="请输入seo关键字" datatype="*1-50" ignore="ignore"></td>
                      </tr>
					  
					  <tr>
                        <td align="left" valign="top" class="aft_l">seo描述</td>
                        <td align="left" valign="middle" class="aft_r">
							<textarea class="form-control the_text3 verify_text" rows="5" name="seo_description" placeholder="请输入seo描述" errormsg="seo描述为1-200个字" nullmsg="请输入seo描述" datatype="*1-200" ignore="ignore"><?php echo $data['list']['seo_description']; ?></textarea>
						</td>
                      </tr>
					  
					  <tr>
                        <td align="left" valign="top" class="aft_l">是否显示</td>
						<td align="left" valign="middle" class="aft_r">
							<label class="radio-inline"><input type="radio" name="is_show" value="1" <?php if($data['list']['is_show'] == '1'){echo 'checked';} ?>>是</label>
							<label class="radio-inline"><input type="radio" name="is_show" value="0" <?php if($data['list']['is_show'] == '0'){echo 'checked';} ?>>否</label>
						</td>
                      </tr>
        
                      <tr>
                        <td align="left" valign="top" class="aft_l">排序</td>
                        <td align="left" valign="middle" class="aft_r"><input type="text" name="orderno" value="<?php echo $data['list']['orderno']; ?>" class="form-control the_text3 verify_text"  placeholder="请输入排序数字" errormsg="请输入数字" nullmsg="请输入排序数字" datatype="n"></td>
                      </tr>
                    </table>

                    
                    <div class="add_from_table_bottom">
					<input type="hidden" name="icon" value="<?php echo $data['list']['icon']; ?>" />
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