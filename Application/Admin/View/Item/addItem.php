<?php W('Admin/head',array(array('admin_user_id'=>$admin_user_id)));?>

<style>
.tab-content{background:#FFF;}
</style>

<script type="text/javascript" charset="utf-8" src="__PUBLIC__/Common/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/Common/ueditor/ueditor.all.min.js"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/Common/ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
	var ue = UE.getEditor('description');
	$(document).ready(function(){
		$("select[name=item_category_id]").change(function(){
			var item_category_id = $(this).val();
			$.ajax({  
				type: "post",  
				url: "<?php echo U('Item/getItemCategoryAttributeHtml'); ?>",  
				data: {item_category_id:item_category_id},  
				dataType: 'json',  
				success:function(data, textStatus){
					if(data.status == -1){
						window.location.href="<?php echo U('Index/index'); ?>";
					}else{
						$('#attribute').html(data.html);
					}
				}
			});  
		});
	});
</script>

<!-- 文件上传  -->
<script src="__PUBLIC__/Common/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Common/uploadify/uploadify.css">
<script>
	$(function() {
		$("#uploadify").uploadify({
			'fileSizeLimit'	: '2048KB',     //最大上传大小为2048KB
			'height'        : 30,
			'swf'           : '__PUBLIC__/Common/uploadify/uploadify.swf',
			'uploader'      : '<?php echo U('Common/uploadify'); ?>',
			'width'         : 120,
			'queueID'		  : 'fileQueue',
			'auto'		  : true,
			'fileTypeExts'  : '*.jpg;*.jpeg;*.png;*.gif;',     //可上传文件类型
			'fileTypeDesc'  : '请选择jpg、jpeg、png、gif类型的文件',
			'multi'		  : true,
			'onUploadSuccess':  function(file, data,response) {
				var data = eval('('+data+')');
				if(data.status){
					$("#img_list").append(data.html);
				}else{
					layer.alert(data.msg);
				}
			}
		});
	});
	
	
	function remove_item_img(obj){
		var obj = $(obj);
		obj.parent().parent().parent().remove();
	}
	function set_first_img(obj){
		var obj = $(obj);
		$("span[name=icon-picture]").remove();
		obj.after('<span name="icon-picture" style="margin-left:2px;"><button type="button" class="btn btn-info btn-xs"><i class="icon-picture"></i></button></span>');
		$("input[name^=first_img]").attr('value',0);
		obj.parent().find("input[name^=first_img]").attr('value',1);
	}
</script>

    <!--main-->
    <div id="main" class="clearfix">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="main_table_left" align="left" valign="top">

    	<?php W('Admin/menu',array(array('admin_user_id'=>$admin_user_id)));?>
        
        </td>
		
        <td class="main_table_right" align="left" valign="top">
            <div id="Right">
                <div class="page_right_header">
                    <div class="f_l">
                        <h4><i class="icon-bar-chart"></i> &nbsp; <span id="page_title">新增商品</span></h4>
                    </div>
                    <div class="f_r">
                    	<a class="btn btn-success" href="<?php echo U('Item/ItemList') ?>"><i class="icon-reorder"></i> &nbsp; 管理列表</a>
                    </div>
                </div>
                <div class="page_right_bodyer">
                    <div class="list_box">
                        <div class="ja_add_tab">
                            <ul class="nav nav-tabs" id="myTab">
                              <li class="active"><a href="#basic" data-toggle="tab"><i class="icon-reorder"></i> 基本信息</a></li>
                              <li><a href="#details" data-toggle="tab"><i class="icon-pencil"></i> 详细信息</a></li>
                              <li><a href="#attribute" data-toggle="tab"><i class="icon-plus-sign"></i> 商品属性</a></li>
                              <li><a href="#thumbnail" data-toggle="tab"><i class="icon-picture"></i> 商品图片</a></li>
                              <!-- <li><a href="#category_spec" data-toggle="tab"><i class="icon-picture"></i> 商品规格</a></li>-->
                            </ul>
                            <form action="<?php echo U('Item/addItem'); ?>" method="post" id="adminForm">
                                <div class="tab-content">
                                  <!--basic-->
                                  <div class="tab-pane active" id="basic">
                                  
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="add_from_table add_from_table2">
									   
									   <tr>
                                        <td align="left" valign="top" class="aft_l">商品分类</td>
                                        <td align="left" valign="middle" class="aft_r">
                                        <select class="form-control the_text2 f_l" name="item_category_id" nullmsg="请选择商品分类" errormsg="请选择商品分类" datatype="/^[1-9][0-9]{0,}$/">
                                          <option value="0">请选择商品分类</option>
										  <?php foreach($data['category_list'] as $v): ?>
											<option value="<?php echo $v['item_category_id'] ?>"><?php echo $v['category_name']; ?></option>
										  <?php endforeach; ?>
                                        </select>
                                        
                                        </td>
                                      </tr>
                                       
									   
                                      <tr>
                                        <td align="left" valign="top" class="aft_l">商品品牌</td>
                                        <td align="left" valign="middle" class="aft_r">
                                        <select class="form-control the_text2 f_l" name="brand_id" nullmsg="请选择商品品牌" errormsg="请选择商品品牌" datatype="/^[1-9][0-9]{0,}$/">
                                          <option value="0">请选择商品品牌</option>
										  <?php foreach($data['brand_list'] as $v): ?>
											<option value="<?php echo $v['brand_id'] ?>"><?php echo $v['brand_name']; ?></option>
										  <?php endforeach; ?>
                                        </select>
                                        </td>
                                      </tr>
									 
									  
									<tr>
                                        <td align="left" valign="top" class="aft_l">商品用途</td>
                                        <td align="left" valign="middle" class="aft_r">
                                        <select class="form-control the_text2 f_l" name="item_purpose_id" nullmsg="请选择商品用途" errormsg="请选择商品用途" datatype="/^[1-9][0-9]{0,}$/">
											<option value="0">请选择商品用途</option>
										  <?php foreach($data['purpose_list'] as $v): ?>
											<option value="<?php echo $v['item_purpose_id'] ?>"><?php echo $v['purpose_name']; ?></option>
										  <?php endforeach; ?>
                                        </select>
                                        
                                        </td>
                                    </tr>
									  
                                      <tr>
                                        <td align="left" valign="top" class="aft_l">商品货号</td>
                                        <td align="left" valign="middle" class="aft_r"><input type="text" name="artno" class="form-control the_text2 verify_text" placeholder="请输入商品货号" datatype="*1-30" nullmsg="请输入商品货号" errormsg="商品货号为1-30个字"></td>
                                      </tr>

									  
                                       <tr>
                                        <td align="left" valign="top" class="aft_l">商品名称</td>
                                        <td align="left" valign="middle" class="aft_r"><input type="text" name="name" class="form-control the_text6 verify_text"  placeholder="请输入商品名称" datatype="*1-80" nullmsg="请输入商品名称" errormsg="商品名称为1-30个字"></td>
                                      </tr>
									  
									  <tr>
                                        <td align="left" valign="top" class="aft_l">换算数量</td>
                                        <td align="left" valign="middle" class="aft_r"><input type="text" name="conversion_num" value="1" class="form-control the_text2 verify_text" placeholder="请输入换算数量" datatype="n" nullmsg="请输入换算数量" errormsg="请填写数字"></td>
                                      </tr>
                                       
                                      <tr>
                                        <td align="left" valign="top" class="aft_l">门店价</td>
                                        <td align="left" valign="middle" class="aft_r">                        
                                          <input type="text" name="shop_price"  class="form-control the_text2 verify_text" placeholder="请输入商品门店价" datatype="f2" nullmsg="请输入商品门店价" errormsg="请输入正确的价格">元               
                                        </td>
                                      </tr>
									  
									  <tr>
                                        <td align="left" valign="top" class="aft_l">商城价</td>
                                        <td align="left" valign="middle" class="aft_r">                        
                                          <input type="text" name="online_price" class="form-control the_text2 verify_text" placeholder="请输入商品商城价" datatype="f2" nullmsg="请输入商品商城价" errormsg="请输入正确格式的价格">元                   
                                        </td>
                                      </tr>
									  
									  <tr>
                                        <td align="left" valign="top" class="aft_l">APP专享价</td>
                                        <td align="left" valign="middle" class="aft_r">                        
                                       
                                          <input type="text" name="app_price" class="form-control the_text2 verify_text" placeholder="请输入商品APP专享价"  datatype="f2" nullmsg="请输入APP专享价" errormsg="请输入正确格式的价格">元
                                                               
                                        </td>
                                      </tr>
									  
                                      <tr>
                                        <td align="left" valign="top" class="aft_l">库存</td>
                                        <td align="left" valign="middle" class="aft_r"><input type="text" name="stock" class="form-control the_text2 verify_text" placeholder="请输入库存数量" datatype="n" nullmsg="请输入库存数量" errormsg="请输入正确格式的数量"></td>
                                      </tr>
                                      <tr>
                                        <td align="left" valign="top" class="aft_l">商品简称</td>
                                        <td align="left" valign="middle" class="aft_r"><input type="text" name="short_name" class="form-control the_text6 verify_text"  placeholder="请输入商品简称" ignore="ignore" datatype="*1-40" nullmsg="请输入商品简称" errormsg="商品简称为1-40个字"></td>
                                      </tr>
                                      <tr>
                                        <td align="left" valign="top" class="aft_l">商品副标题</td>
                                        <td align="left" valign="middle" class="aft_r"><input type="text" name="subheading" class="form-control the_text6 verify_text"  placeholder="请输入商品副标题" ignore="ignore" datatype="*1-50" nullmsg="请输入商品副标题" errormsg="商品副标题为1-50个字"></td>
                                      </tr>
									  
									  <tr>
										<td align="left" valign="top" class="aft_l">seo标题</td>
										<td align="left" valign="middle" class="aft_r"><input type="text" name="seo_title" class="form-control the_text3 verify_text"  placeholder="请输入seo标题" errormsg="seo标题为1-50个字" nullmsg="请输入seo标题" datatype="*1-50" ignore="ignore"></td>
									  </tr>
									  
									  <tr>
										<td align="left" valign="top" class="aft_l">seo关键字</td>
										<td align="left" valign="middle" class="aft_r"><input type="text" name="seo_keywords" class="form-control the_text3 verify_text"  placeholder="请输入seo关键字" errormsg="seo关键字为1-50个字" nullmsg="请输入seo关键字" datatype="*1-50" ignore="ignore"></td>
									  </tr>
									  
									  <tr>
										<td align="left" valign="top" class="aft_l">seo描述</td>
										<td align="left" valign="middle" class="aft_r">
											<textarea class="form-control the_text3 verify_text" rows="5" name="seo_description" placeholder="请输入seo描述" errormsg="seo描述为1-200个字" nullmsg="请输入seo描述" datatype="*1-200" ignore="ignore"></textarea>
										</td>
									  </tr>

									  <tr>
                                        <td align="left" valign="top" class="aft_l">商品关联标签</td>
                                        <td align="left" valign="middle" class="aft_r"><input type="text" name="tags" class="form-control the_text6 verify_text"  placeholder="多个标签以;(英文分号)相隔开" datatype="*" ignore="ignore" nullmsg="请输入商品标签" errormsg="请输入商品标签"></td>
                                      </tr>
									  
                                     
                                      <tr>
                                        <td align="left" valign="top" class="aft_l">在售</td>
                                        <td align="left" valign="middle" class="aft_r">
                                        
                                        <label class="radio-inline">
                                        <input type="radio" name="is_on_sale" value="1" checked="checked">
                                        是
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="is_on_sale" value="0" >
                                        否
                                        </label>
                                        
                                        </td>
                                      </tr>
                                      
                                    </table>
                                  
                                  </div>
        
                                  <!--details-->
                                   <div class="tab-pane" id="details">
                                      <h2 style="font-size:20px; font-weight:500; margin-bottom:20px; color:#090;">商品详情</h2>
                                      <script id="description" name="description" type="text/plain" style="width:1024px;height:500px;"></script>   
                                  </div>
                                         
                                  <!--attribute-->
                                  <div class="tab-pane" id="attribute">
                                      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="add_from_table add_from_table2">                      
                                          
                                          <tr><td>选择分类</td></tr>
                                        </table>
                                      
                                  </div>
                          
                                  <!--thumbnail-->
                                  <div class="tab-pane" id="thumbnail">
                                    
                                    <div id="fileQueue"></div>
                                    
                                    <input type="file" name="file_upload" id="uploadify" />
                                       <!--List-->
                                    <div class="list_box">
                                        <!--list_box_pro-->
                                    	<div class="list_box_pro clearfix" id="img_list">
                                        </div>
                                    </div>
                                    <div class="none" id="item_img"></div>
                                </div>
                              <!--category_spec-->
							<!--
                              <div class="tab-pane" id="category_spec">
                                    <table id='spec_html' width="100%" border="0" cellspacing="0" cellpadding="0" class="add_from_table add_from_table2">
                                       <tr>
                                        <td align="left" valign="top" class="aft_l">112233</td>
                                        <td align="left" valign="middle" class="aft_r">
                                        
                                        <label class="radio-inline">
                                        <input type="radio" name="is_open_spec" id="optionsRadios1" value="1" >
                                        是
                                        </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="is_open_spec" value="0" checked>
                                        否
                                        </label>
                                        
                                        </td>
                                      </tr>
                                      </table>
                                </div>
							-->
							
								<div class="add_from_table_bottom">
									<button type="submit" class="btn btn-success btn-lg form_submit" ><i class="icon-ok-sign"></i> &nbsp; 提交表单</button>
									<button type="reset" class="btn btn-warning btn-lg" ><i class="icon-undo"></i><span> &nbsp; 重置表单</button>
								</div>
        
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </td>
        </tr>
     </table>
    </div>
	
	<?php W('Admin/foot');?>