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
<!--[ TITLE ]-->

                <div class="f_l">
                    <h4><i class="icon-bar-chart"></i> &nbsp; <span id="page_title">新增回复</span></h4>
                </div>

<!--[ /TITLE ]-->
            </div>
            <!--/page_right_header-->
            
            <!--page_right_bodyer-->
            <div class="page_right_bodyer">
            
            <!--List-->
            <div class="list_box">
<!--[ BODY ]-->
				
                
                <div class="ja_add_from mb20">
                	<div class="add_from_head">新增回复</div>
                	<div class="add_from_body">
                    <form action="<?php echo U('Comment/doReply') ?>" method="post" id="adminForm">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="add_from_table">
                      <tr>
                        <td align="left" valign="top" class="aft_l">订单号</td>
                        <td align="left" valign="middle" class="aft_r">
                            <?php echo $data['order_no'] ?>
                        </td>
                      </tr>
                      <tr>
                        <td align="left" valign="top" class="aft_l">用户名</td>
                        <td align="left" valign="middle" class="aft_r">
                            <?php echo $data['name'] ?>
                        </td>
                      </tr>
                      <tr>
                        <td align="left" valign="top" class="aft_l">评分</td>
                        <td align="left" valign="middle" class="aft_r">
                            <?php echo $data['score'] ?>
                        </td>
                      </tr>
                      <tr>
                        <td align="left" valign="top" class="aft_l">评论内容</td>
                        <td align="left" valign="middle" class="aft_r">
                            <?php echo $data['content'] ?>
                        </td>
                      </tr>
                      <tr>
                        <td align="left" valign="top" class="aft_l">晒图展示</td>
                        <td align="left" valign="middle" class="aft_r">
                        <?php foreach ($data['images'] as $key => $vo) { ?>
                            <img src="<?php echo $vo['img_uri'] ?>" style='width: 78px;height: 78px;' >
                        <?php } ?>
                           
                        </td>
                      </tr>
					  <tr>
                        <td align="left" valign="top" class="aft_l">是否显示</td>
						<td align="left" valign="middle" class="aft_r">
							<label class="radio-inline"><input type="radio" name="is_show" value="1" checked />是</label>
							<label class="radio-inline"><input type="radio" name="is_show" value="0" />否</label>
						</td>
                      </tr>
                      <tr>
                        <td align="left" valign="top" class="aft_l">掌柜回复</td>
                        <td align="left" valign="middle" class="aft_r">
                          <?php foreach ($data['comments'] as $key => $vo) { ?>
                              <p><?php echo $vo['content'] ?></p>
                          <?php } ?>
                             
                        </td>
                      </tr>
					 <tr>
                        <td align="left" valign="top" class="aft_l">回复内容</td>
                        <td align="left" valign="middle" class="aft_r">
							 <textarea class="feel font-12" name="content" datatype="*1-200"  errormsg="请输入正确的1-200位字符串" nullmsg="请输入1-200位字符串" style="width: 600px;height: 300px;" ></textarea>
						</td>
                      </tr>
					  
					  
                    </table>

                    
                    <div class="add_from_table_bottom">
                    <input type="hidden" value="<?php echo $data['item_comment_id'] ?>" name='parent_id' >
                    <button type="submit" class="btn btn-success btn-lg form_submit" ><i class="icon-ok-sign"></i> &nbsp; 提交表单</button>
                    <button type="reset" class="btn btn-warning btn-lg" ><i class="icon-undo"></i><span> &nbsp; 重置表单</button>
                    </div>
                    
                    
                    
                    </form>
                   	</div>
                </div>
                

                
                
                
<!--[ /BODY ]-->
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