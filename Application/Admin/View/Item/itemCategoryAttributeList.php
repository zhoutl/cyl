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

			            <!--page_right_menu-->
            <div class="page_right_menu the_highlighted2 clearfix">
				<div class="dropdown">
                  <a class="btn btn-default dropdown-toggle" href="<?php echo U('Item/addItemCategoryAttribute'); ?>">
                    <i class="icon-coffee"></i>
                    新增分类属性
                  </a>
                </div>
			
			</div>
		
            <!--page_right_bodyer-->
            <div class="page_right_bodyer">
			
				<!--list_heads-->

				<div class="list_heads mb20 clearfix">
					<form method="get" action="<?php echo U('Item/itemCategoryAttributeList'); ?>">
						<div class="f_r list_heads_right">
						<div class="input-group">
							<select class="form-control the_text1" name="item_category_id">
								<option value="0">请选择所属分类</option>
								<?php foreach($data['item_category_list'] as $v){ ?>
									<option value="<?php echo $v['item_category_id']; ?>" <?php if($data['item_category_id'] == $v['item_category_id']){echo 'selected';} ?>><?php echo $v['category_name']; ?></option>
								<?php } ?>
							</select>
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit">搜索</button>
							</span>
						</div>
						</div>
					
					</form>
				</div>

				<!--/list_heads-->
   
            <!--List-->
            <div class="list_box">
            
            	<table width="100%" border="0" cellpadding="0" cellspacing="0" id="Usertb" class="jadmin_table">
                <thead>
                  <tr>
                    <th scope="col" class="">属性名称</th>
					<th scope="col" class="">所属分类</th>
					<th scope="col" class="th_w7">数据类型</th>
					<th scope="col" class="th_w7">是否作为检索条件</th>
                    <th scope="col" class="th_w5">排序</th>
                    <th scope="col" class="th_wb15">操作</th>
                  </tr>
                </thead>

                <tbody>
                
                  <?php foreach($data['list'] as $v): ?>
                  <tr name="data_<?php echo $v['item_category_attribute_id']; ?>">
                    <td valign="middle" align="center"><?php echo $v['attribute_name']; ?></td>
					<td valign="middle" align="center"><?php echo M('Item_category')->where('item_category_id='.$v['item_category_id'])->getField('category_name'); ?></td>
					<td valign="middle" align="center">
						<?php 
							if($v['input_type'] == '1'){
								echo '固定值单选';
							}else if($v['input_type'] == '2'){
								echo '固定值复选';
							}else if($v['input_type'] == '3'){
								echo '文本输入';
							}else if($v['input_type'] == '4'){
								echo '富文本输入';
							}
						?>
					</td>
					<td valign="middle" align="center">
						<?php if($v['is_filter']){echo '是';}else{echo '否';} ?>
					</td>
                    <td valign="middle" align="center"><?php echo $v['orderno']; ?></td>
                    <td valign="middle" align="center" class="td_w_link">
						<a href="<?php echo U('Item/editItemCategoryAttributeValue',array('id'=>$v['item_category_attribute_id'])); ?>" class="btn btn-info btn-xs"><i class="icon-filter"></i>&nbsp;属性值编辑</a>
                        <a href="<?php echo U('Item/editItemCategoryAttribute',array('id'=>$v['item_category_attribute_id'])); ?>" class="btn btn-primary btn-xs"><i class="icon-edit"></i>&nbsp;编辑</a>
                        <a href="javascript:void(0);" onclick="delete_data('<?php echo $v['item_category_attribute_id']; ?>','<?php echo U('Item/delItemCategoryAttribute'); ?>')" class="btn btn-danger btn-xs del_button"><i class="icon-remove"></i>&nbsp;&nbsp;删除</a>
                    </td>
                  </tr>
				  <?php endforeach; ?>
                
                </tbody>
                
                </table>

				
                <div class="list_box_bottom">			
                    <!--/pagination-->
					<div class="page">
						<?php echo $data['pagetion']->show(); ?>
					</div>
                </div>            
                
                
                
                
                
                
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