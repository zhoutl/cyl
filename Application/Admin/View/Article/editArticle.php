<?php W('Admin/head',array(array('admin_user_id'=>$admin_user_id)));?>

	<script type="text/javascript" charset="utf-8" src="__PUBLIC__/Common/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" charset="utf-8" src="__PUBLIC__/Common/ueditor/ueditor.all.min.js"> </script>
	<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
	<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
	<script type="text/javascript" charset="utf-8" src="__PUBLIC__/Common/ueditor/lang/zh-cn/zh-cn.js"></script>
	<script type="text/javascript">
		var ue = UE.getEditor('editor');
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
                    <h4><i class="icon-bar-chart"></i> &nbsp; <span id="page_title">修改文章</span></h4>
                </div>
                <div class="f_r">
                	<a class="btn btn-success" href="<?php echo U('Article/articleList') ?>"><i class="icon-reorder"></i> &nbsp; 管理列表</a>
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
                	<div class="add_from_head">修改文章</div>
                	<div class="add_from_body">
                    <form action="<?php echo U('Article/editArticle',array('id'=>$data['list']['article_id'])); ?>" method="post" id="adminForm">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="add_from_table">
                      <tr>
                        <td align="left" valign="top" class="aft_l">文章标题</td>
                        <td align="left" valign="middle" class="aft_r"><input type="text" name="title" value="<?php echo $data['list']['title']; ?>" class="form-control the_text3 verify_text"  placeholder="请输入文章标题" errormsg="文章标题为1-50个字" nullmsg="请输入文章标题" datatype="*1-50"></td>
                      </tr>
                      <tr>
                        <td align="left" valign="top" class="aft_l">所属分类</td>
                        <td align="left" valign="middle" class="aft_r">
							<select class="form-control the_text3 verify_text" name="article_category_id" errormsg="请选择所属分类" nullmsg="请选择所属分类" datatype="/^[1-9][0-9]{0,}$/">
								<option value="0">请选择所属分类</option>
								<?php foreach($data['category_list'] as $k=>$v){ ?>
									<option value="<?php echo $v['article_category_id']; ?>" <?php if($data['list']['article_category_id'] == $v['article_category_id']){echo 'selected';} ?>><?php echo $v['article_category_name']; ?></option>
								<?php } ?>
                            </select>
						</td>
                      </tr>
					  
					  <tr>
                        <td align="left" valign="top" class="aft_l">seo标题</td>
                        <td align="left" valign="middle" class="aft_r"><input type="text" name="seo_title" value="<?php echo $data['list']['seo_title']; ?>" class="form-control the_text3 verify_text"  placeholder="请输入seo标题" errormsg="seo标题为1-50个字" nullmsg="请输入seo标题" datatype="*1-50" ignore="ignore"></td>
                      </tr>
					  
					  <tr>
                        <td align="left" valign="top" class="aft_l">seo关键字</td>
                        <td align="left" valign="middle" class="aft_r"><input type="text" name="seo_keywords" value="<?php echo $data['list']['seo_keywords']; ?>" class="form-control the_text3 verify_text"  placeholder="请输入seo关键字" errormsg="seo关键字为1-50个字" nullmsg="请输入seo关键字" datatype="*1-50" ignore="ignore"></td>
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
					  
					  
					 <tr>
                        <td align="left" valign="top" class="aft_l">文章内容</td>
                        <td align="left" valign="middle" class="aft_r">
							<script id="editor" type="text/plain" name="content" style="width:1024px;height:500px;"><?php echo htmlspecialchars_decode($data['list']['content']); ?></script>
						</td>
                      </tr>
					  
					  
                    </table>

                    
                    <div class="add_from_table_bottom">
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