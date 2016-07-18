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
                  <a class="btn btn-default dropdown-toggle" href="<?php echo U('Item/addItem'); ?>">
                    <i class="icon-coffee"></i>
                    新增商品
                  </a>
                </div>
			</div>
		
            <!--page_right_bodyer-->
            <div class="page_right_bodyer">
			
				<!--list_heads-->
				<div class="list_heads mb20 clearfix">
					<form method="get" action="<?php echo U('Item/itemList'); ?>">
						<div class="f_r list_heads_right clearfix" style="width:auto;display:inline-block;">
						
						<div class="input-group f_l ml20 the_text2">
						  <select class="form-control the_text1" name="item_category_id">
								<option value="0">请选择所属类别</option>
								<?php foreach($data['category_list'] as $v){ ?>
									<option value="<?php echo $v['item_category_id']; ?>" <?php if($v['item_category_id']==$data['item_category_id']){echo 'selected';} ?>><?php echo $v['category_name']; ?></option>
								<?php } ?>
							</select>
						</div>
						
						<div class="input-group f_l ml20 the_text2">
						  <select class="form-control the_text1" name="item_purpose_id">
								<option value="0">请选择用途</option>
								<?php foreach($data['purpose_list'] as $v){ ?>
									<option value="<?php echo $v['item_purpose_id']; ?>" <?php if($v['item_purpose_id']==$data['item_purpose_id']){echo 'selected';} ?>><?php echo $v['purpose_name']; ?></option>
								<?php } ?>
							</select>
						</div>
						
						<div class="input-group f_l ml20 the_text2">
						  <select class="form-control the_text1" name="brand_id">
								<option value="0">请选择品牌</option>
								<?php foreach($data['brand_list'] as $v){ ?>
									<option value="<?php echo $v['brand_id']; ?>" <?php if($v['brand_id']==$data['brand_id']){echo 'selected';} ?>><?php echo $v['brand_name']; ?></option>
								<?php } ?>
							</select>
						</div>
						
						<div class="input-group f_l ml20 the_text2">
						  <select class="form-control the_text1" name="is_on_sale">
								<option value="0">请选择在售情况</option>
								<option value="99" <?php if($data['is_on_sale'] == '99'){echo 'selected';} ?>>在售</option>
								<option value="100" <?php if($data['is_on_sale'] == '100'){echo 'selected';} ?>>下架</option>
							</select>
						</div>
						
						<div class="input-group f_l ml20 the_text3">
						  <input type="text" name="artno" value="<?php echo $data['artno']; ?>" class="form-control" placeholder="请输入商品货号">
						</div>
						
						<div class="input-group f_l ml20 the_text3">
						  <input type="text" name="name" value="<?php echo $data['name']; ?>" class="form-control" placeholder="请输入商品名称">
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
					<th scope="col" class="th_w5">商品ID</th>
                    <th scope="col" class="">商品名称</th>
                    <th scope="col" class="th_w7">所属分类</th>
					<th scope="col" class="th_w7">货号</th>
					<th scope="col" class="th_w5">在售</th>
                    <th scope="col" class="th_w7">操作</th>
                  </tr>
                </thead>

                <tbody>
                
                  <?php foreach($data['list'] as $v): ?>
                  <tr name="data_<?php echo $v['item_id']; ?>">
					<td valign="middle" align="center"><?php echo $v['item_id']; ?></td>
                    <td valign="middle" align="center"><?php echo $v['name']; ?></td>
                    <td valign="middle" align="center"><?php echo M('Item_category')->where('item_category_id='.$v['item_category_id'])->getField('category_name'); ?></td>
                    <td valign="middle" align="center"><?php echo $v['artno']; ?></td>
					<td valign="middle" align="center">
						<?php if($v['is_on_sale'] == '1'){ ?>
							<i class="icon-ok the_icon this_check" onclick="change_state('<?php echo $v['item_id']; ?>','2','<?php echo U('Item/changeItemState'); ?>',this);"></i>
						<?php }else{ ?>
							<i class="icon-remove the_icon this_check" onclick="change_state('<?php echo $v['item_id']; ?>','1','<?php echo U('Item/changeItemState'); ?>',this);"></i>
						<?php } ?>
					</td>
                    <td valign="middle" align="center" class="td_w_link">
                        <a href="<?php echo U('Item/editItem',array('id'=>$v['item_id'])); ?>" class="btn btn-primary btn-xs"><i class="icon-edit"></i>&nbsp;编辑</a>
						<a href="javascript:void(0);" onclick="delete_data('<?php echo $v['item_id']; ?>','<?php echo U('Item/recycleItem'); ?>')" class="btn btn-danger btn-xs del_button"><i class="icon-remove"></i>商品回收站</a>
                    </td>
                  </tr>
				  <?php endforeach; ?>
                
                </tbody>
                
                </table>

				
                <div class="list_box_bottom">
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