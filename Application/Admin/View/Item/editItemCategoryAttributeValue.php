<?php W('Admin/head',array(array('admin_user_id'=>$admin_user_id)));?>

<script type="text/javascript">
						$(document).ready(function() {
							$('.the_add_td_button').on('click',function(){
								the_add_td='<tr>'+
												'<td align="left" valign="middle" class="aft_r" style="line-height: 30px;">'+
												'<span style="float:left;">值：</span><input style="float:left;" datatype="*1-10" nullmsg="1-10任意字符" errormsg="1-10任意字符" name="attr_value[]" class="form-control the_text1"  value="">'+
												'</td>'+
												'<td align="left" valign="middle" class="aft_r" style="line-height: 30px;">'+
												'<span style="float:left;">排序：</span><input style="float:left;" datatype="n1-3" nullmsg="1-999数字" errormsg="1-999数字" name="orderno[]" class="form-control the_text1"  value="">'+
												'</td>'+
												'<td align="left" valign="middle" class="aft_r" style="line-height: 30px;">'+
												'<button type="button" class="btn btn-danger the_del_td_button"><i class="icon-minus"></i></button>'+
												'</td>'+
											'</tr>';
								$('.the_add_td').append(the_add_td);
							})
							
							
							$('.the_add_td').on('click','.the_del_td_button',function(){
								$(this).parent().remove();
							})
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
							<h4>
								<i class="icon-bar-chart"></i> &nbsp; <span id="page_title">属性值编辑</span>
							</h4>
						</div>
						<div class="f_r">
							<a class="btn btn-success" href="<?php echo U('Item/itemCategoryAttributeList') ?>"><i class="icon-reorder"></i> &nbsp; 管理列表</a>
						</div>

						<!---------------[ /TITLE ]--------------->
					</div>
					<!--/page_right_header-->

					<!--page_right_bodyer-->
					<div class="page_right_bodyer">

						<!--List-->
						<div class="list_box">
							<!---------------[ BODY ]--------------->

							<div class="ja_add_tab">
								<ul class="nav nav-tabs" id="myTab">
									<li class="active"><a href="#basic" data-toggle="tab"><i class="icon-reorder"></i>属性值编辑</a></li>
								</ul>

								<form action="" method="post" id="adminForm">
									<div class="tab-content">
										<!--basic-->
										<div class="tab-pane active" id="basic">
											<table width="100%" border="0" cellspacing="0"
												cellpadding="0" class="add_from_table add_from_table2">
												<tbody>
													<tr>
														<td align="left" valign="top" class="aft_l">分类属性名称</td>
														<td align="left" valign="middle" class="aft_r" colspan="3">
															<?php echo $data['attribute_name']; ?>
															<button readonly type="button" class="btn btn-success the_add_td_button" id="the_add_td_button">
																<i class="icon-plus"></i>添加属性值
															</button>
														</td>
													</tr>
													<tr >
														<td align="left" valign="top" class="aft_l">分类属性值</td>
														<td>
														<table width="100%" class="the_add_td">
														<?php if(!empty($data['list'])): ?>
															<?php foreach($data['list'] as $v){ ?>
																<tr class="alt">
																	<td align="left" valign="middle" class="aft_r" style="line-height: 30px;">
																		<span style="float:left;">值：</span><input style="float:left;" datatype="*1-10" nullmsg="1-10任意字符" errormsg="1-10任意字符"  name="attr_value_<?php echo $v['item_category_attribute_value_id']; ?>" class="form-control the_text1"  value="<?php echo $v['attribute_value'];?>">
																	</td>
																	<td align="left" valign="middle" class="aft_r" style="line-height: 30px;">
																		<span style="float:left;">排序：</span><input style="float:left;" datatype="n1-3" nullmsg="1-999数字" errormsg="1-999数字" name="orderno_<?php echo $v['item_category_attribute_value_id']; ?>" class="form-control the_text1"  value="<?php echo $v['orderno'];?>">
																	</td>
																	<td align="left" valign="middle" class="aft_r" style="line-height: 30px;">
																		<button type="button" class="btn btn-danger the_del_td_button"><i class="icon-minus"></i></button>
																	</td>
																</tr>
															<?php } ?>
														<?php endif; ?>
														</table>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
										<div class="add_from_table_bottom">
											<button type="submit" class="btn btn-success btn-lg form_submit" ><i class="icon-ok-sign"></i> &nbsp; 提交表单</button>
											<button type="reset" class="btn btn-warning btn-lg" ><i class="icon-undo"></i><span> &nbsp; 重置表单</button>
										</div>
									</div>
								</form>
								<!--details-->
								<!--attribute-->
								<!--thumbnail-->
							</div>
						</div>
						<!---------------[ /BODY ]--------------->
					</div>
					<!--/List-->
				</div> <!--/page_right_bodyer-->
			</td>
		</tr>
	</table>
</div>
<!--/main-->


<?php W('Admin/foot');?>