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
           
		
            <!--page_right_bodyer-->
            <div class="page_right_bodyer">
			
			
            
            <!--List-->
            <div class="list_box">
            
            	<table width="100%" border="0" cellpadding="0" cellspacing="0" id="Usertb" class="jadmin_table">
                <thead>
                  <tr>
                    <th scope="col" class="">ID</th>
                    <th scope="col" class="">商品名称</th>
                    <th scope="col" class="">评论内容</th>
					<th scope="col" class="">用户账号</th>
                    <th scope="col" class="">是否显示</th>
                    <th scope="col" class="">评论时间</th>
                    <th scope="col" class="">操作</th>
                  </tr>
                </thead>

                <tbody>
                
            <?php foreach ($data['list'] as $key => $vo) { ?>
                <tr>
                    <td valign="middle" align="center"><?php echo $vo['item_comment_id'] ?></td>
                    <td valign="middle" align="center"><?php echo $vo['items']['name'] ?></td>
                    <td valign="middle" align="center"><?php echo $vo['content'] ?></td>
                    <td valign="middle" align="center"><?php echo $vo['name'] ?></td>
                    <td valign="middle" align="center">
                        <?php if($vo['is_show'] == '1'){ ?>
                            <i class="icon-ok the_icon this_check" 
                            onclick="change_state('<?php echo $vo['item_comment_id'] ?>','2','<?php echo U('Comment/changeStatus') ?>',this)"></i>
                        <?php }else{ ?>
                            <i class="icon-remove the_icon this_check" 
                            onclick="change_state('<?php echo $vo['item_comment_id'] ?>','1','<?php echo U('Comment/changeStatus') ?>',this)"></i>
                        <?php } ?>
                    </td>
                    <td valign="middle" align="center"><?php echo date('Y-m-d',$vo['reply_time']) ?></td>
                    <td valign="middle" align="center" class="td_w_link">
                        <a href="<?php echo U('Comment/reply',array('item_comment_id'=>$vo['item_comment_id'])) ?>" class="btn btn-primary btn-xs"><i class="icon-edit"></i>&nbsp;回复</a>
                    </td>
                  </tr>
            <?php } ?>
                  
				 
                
                </tbody>
                
                </table>

				
                <div class="list_box_bottom">
					<div class="page">
						
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