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
                  <a class="btn btn-default dropdown-toggle" href="<?php echo U('System/addLink'); ?>">
                    <i class="icon-coffee"></i>
                    新增友情链接
                  </a>
                </div>
			
			</div>
		
            <!--page_right_bodyer-->
            <div class="page_right_bodyer">
            
            
            <!--list_heads-->
			<!-- 
            <div class="list_heads mb20 clearfix">
            
                <div class="f_r list_heads_right">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="请输入您要搜索的关键词">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button">搜索</button>
                  </span>
                </div>
                </div>
            
            
            </div>
			-->
            <!--/list_heads-->
            
            
            <!--List-->
            <div class="list_box">
            
            	<table width="100%" border="0" cellpadding="0" cellspacing="0" id="Usertb" class="jadmin_table">
                <thead>
                  <tr>
                    <th scope="col" class="">链接名称</th>
                    <th scope="col" class="">链接地址</th>
                    <th scope="col" class="th_w5">排序</th>
                    <th scope="col" class="th_w7">操作</th>
                  </tr>
                </thead>

                <tbody>
                
                  <?php foreach($data['list'] as $v): ?>
                  <tr name="data_<?php echo $v['link_id']; ?>">
                    <td valign="middle" align="center"><?php echo $v['link_name']; ?></td>
                    <td valign="middle" align="center"><?php echo $v['link_url']; ?></td>
                    <td valign="middle" align="center"><?php echo $v['orderno']; ?></td>
                    <td valign="middle" align="center" class="td_w_link">
                        <a href="<?php echo U('System/editLink',array('id'=>$v['link_id'])); ?>" class="btn btn-primary btn-xs"><i class="icon-edit"></i>&nbsp;编辑</a>
                        <a href="javascript:void(0);" onclick="delete_data('<?php echo $v['link_id']; ?>','<?php echo U('System/delLink'); ?>')" class="btn btn-danger btn-xs del_button"><i class="icon-remove"></i>&nbsp;&nbsp;删除</a>
                    </td>
                  </tr>
				  <?php endforeach; ?>
                
                </tbody>
                
                </table>

				
                <div class="list_box_bottom">
                    <!--pagination-->
					<!--
                    <div class="list_pagination f_r">
                        <ul class="pagination pagination-custom">
                          <li><a href="#">&laquo; 上一页</a></li>
                          <li><a href="#">1</a></li>
                          <li class="active"><a href="#">2</a></li>
                          <li><a href="#">3</a></li>
                          <li><a href="#">4</a></li>
                          <li><a href="#">5</a></li>
                          <li><a href="#">下一页 &raquo;</a></li>
                        </ul>
                    </div>
					->
					
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