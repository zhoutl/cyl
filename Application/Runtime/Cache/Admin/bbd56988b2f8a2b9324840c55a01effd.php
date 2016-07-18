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
                  <a class="btn btn-default dropdown-toggle" href="<?php echo U('Article/addArticle',array('type'=>1)); ?>">
                    <i class="icon-coffee"></i>
                    新增企业资讯文章
                  </a>
                </div>
				
				<div class="dropdown">
                  <a class="btn btn-default dropdown-toggle" href="<?php echo U('Article/addArticle',array('type'=>2)); ?>">
                    <i class="icon-coffee"></i>
                    新增帮助中心文章
                  </a>
                </div>
			
			</div>
		
            <!--page_right_bodyer-->
            <div class="page_right_bodyer">
			
				<!--list_heads-->
				<div class="list_heads mb20 clearfix">
					<form method="get" action="<?php echo U('Article/articleList'); ?>">
						<div class="f_r list_heads_right clearfix" style="width:auto;display:inline-block;">
						
						<div class="input-group f_l the_text3">
						  <select class="form-control the_text1" name="article_type">
								<option value="0">请选择所属类别</option>
								<?php foreach($article_type as $k=>$v){ ?>
									<option value="<?php echo $k; ?>" <?php if($data['article_type'] == $k){echo 'selected';} ?>><?php echo $v; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="input-group f_l ml20 the_text3">
						  <input type="text" name="keywords" value="<?php echo $data['keywords']; ?>" class="form-control" placeholder="请输入文章标题">
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
                    <th scope="col" class="">文章标题</th>
                    <th scope="col" class="th_w7">所属分类</th>
                    <th scope="col" class="th_w5">排序</th>
					<th scope="col" class="th_w5">是否显示</th>
                    <th scope="col" class="th_w7">操作</th>
                  </tr>
                </thead>

                <tbody>
                
                  <?php foreach($data['list'] as $v): ?>
                  <tr name="data_<?php echo $v['article_id']; ?>">
                    <td valign="middle" align="center"><?php echo $v['title']; ?></td>
                    <td valign="middle" align="center"><?php echo M('Article_category')->where('article_category_id='.$v['article_category_id'])->getField('article_category_name'); ?></td>
                    <td valign="middle" align="center"><?php echo $v['orderno']; ?></td>
					<td valign="middle" align="center">
						<?php if($v['is_show'] == '1'){ ?>
							<i class="icon-ok the_icon this_check" onclick="change_state('<?php echo $v['article_id']; ?>','2','<?php echo U('Article/changeArticleState'); ?>',this);"></i>
						<?php }else{ ?>
							<i class="icon-remove the_icon this_check" onclick="change_state('<?php echo $v['article_id']; ?>','1','<?php echo U('Article/changeArticleState'); ?>',this);"></i>
						<?php } ?>
					</td>
                    <td valign="middle" align="center" class="td_w_link">
                        <a href="<?php echo U('Article/editArticle',array('id'=>$v['article_id'])); ?>" class="btn btn-primary btn-xs"><i class="icon-edit"></i>&nbsp;编辑</a>
                        <a href="javascript:void(0);" onclick="delete_data('<?php echo $v['article_id']; ?>','<?php echo U('Article/delArticle'); ?>')" class="btn btn-danger btn-xs del_button"><i class="icon-remove"></i>&nbsp;&nbsp;删除</a>
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