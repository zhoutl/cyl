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

			            <!--page_right_menu-->
            <div class="page_right_menu the_highlighted2 clearfix">
				<div class="dropdown">
                  <a class="btn btn-default dropdown-toggle" href="<?php echo U('Home/addBanner'); ?>">
                    <i class="icon-coffee"></i>
                    新增BANNER
                  </a>
                </div>
			
			</div>
		
            <!--page_right_bodyer-->
            <div class="page_right_bodyer">
   
            <!--List-->
            <div class="list_box">
            
            	<table width="100%" border="0" cellpadding="0" cellspacing="0" id="Usertb" class="jadmin_table">
                <thead>
                  <tr>
                    <th scope="col" class="">BANNER名称</th>
                    <th scope="col" class="">BANNER图片</th>
					<th scope="col" class="">链接地址</th>
					<th scope="col" class="th_w5">所属版本</th>
					<th scope="col" class="th_w5">前台显示</th>
                    <th scope="col" class="th_w5">排序</th>
                    <th scope="col" class="th_wb15">操作</th>
                  </tr>
                </thead>

                <tbody>
                
                  <?php foreach($data['list'] as $v): ?>
                  <tr name="data_<?php echo $v['banner_id']; ?>">
                    <td valign="middle" align="center"><?php echo $v['name']; ?></td>
                    <td valign="middle" align="center">
                        <img src="<?php echo $v['img_uri']; ?>" width="300px">
                    </td>
					<td valign="middle" align="center"><?php echo $v['link_url']; ?></td>
					<td valign="middle" align="center">
						<?php  if($v['type'] == '1'){ echo 'PC版'; }else if($v['type'] == '2'){ echo 'WAP版'; } ?>
					</td>
					<td valign="middle" align="center">
						<?php if($v['is_show'] == '1'){ ?>
							<i class="icon-ok the_icon this_check" onclick="change_state('<?php echo $v['banner_id']; ?>','2','<?php echo U('Home/changeBannerState'); ?>',this);"></i>
						<?php }else{ ?>
							<i class="icon-remove the_icon this_check" onclick="change_state('<?php echo $v['banner_id']; ?>','1','<?php echo U('Home/changeBannerState'); ?>',this);"></i>
						<?php } ?>
					</td>
                    <td valign="middle" align="center"><?php echo $v['orderno']; ?></td>
                    <td valign="middle" align="center" class="td_w_link">
                        <a href="<?php echo U('Home/editBanner',array('id'=>$v['banner_id'])); ?>" class="btn btn-primary btn-xs"><i class="icon-edit"></i>&nbsp;编辑</a>
                        <a href="javascript:void(0);" onclick="delete_data('<?php echo $v['banner_id']; ?>','<?php echo U('Home/delBanner'); ?>')" class="btn btn-danger btn-xs del_button"><i class="icon-remove"></i>&nbsp;&nbsp;删除</a>
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