<?php W('Admin/head',array(array('admin_user_id'=>$admin_user_id)));?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Home/css/style.css">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Home/css/user.css">
	<script type="text/javascript" charset="utf-8" src="__PUBLIC__/Common/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" charset="utf-8" src="__PUBLIC__/Common/ueditor/ueditor.all.min.js"> </script>
	<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
	<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
	<script type="text/javascript" charset="utf-8" src="__PUBLIC__/Common/ueditor/lang/zh-cn/zh-cn.js"></script>
	<script type="text/javascript">
		var ue = UE.getEditor('editor');
	</script>
    <script type="text/javascript" src="__PUBLIC__/Common/uploadify/jquery.uploadify.min.js" ></script>
<script>
var _APP = "<?php echo "__APP__"; ?>";
var _URL = "<?php echo "__URL__"; ?>";
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
                    <h4><i class="icon-bar-chart"></i> &nbsp; <span id="page_title">新增商品评论</span></h4>
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
                	<div class="add_from_head">新增商品评论</div>
                	<div class="add_from_body">
                    <form action="<?php echo U('Comment/doAddComent') ?>" method="post" id="adminForm">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="add_from_table">
                      <tr>
                        <td align="left" valign="top" class="aft_l">商品ID</td>
                        <td align="left" valign="middle" class="aft_r">
                            <input type="text" name="item_id" class="form-control the_text2 verify_text" placeholder="请输入商品ID" datatype="n1-30" nullmsg="请输入商品ID" errormsg="商品ID为1-30位数字" style="width: 200px;" >
                        </td>
                      </tr>
                      <tr>
                        <td align="left" valign="top" class="aft_l">用户名</td>
                        <td align="left" valign="middle" class="aft_r">
                            <input type="text" name="name" class="form-control the_text2 verify_text" placeholder="请输入1-30位任意字符" datatype="*1-30" nullmsg="请输入1-30位任意字符" errormsg="请输入1-30位任意字符" style="width: 200px;" >
                        </td>
                      </tr>
                      <tr>
                        <td align="left" valign="top" class="aft_l">评分</td>
                        <td align="left" valign="middle" class="aft_r">
                            <select name="score"  class="form-control data-kk1 data-kk2 f_l" >
                                <option value="5" >五星</option>
                                <option value="4" >四星</option>
                                <option value="3" >三星</option>
                                <option value="2" >二星</option>
                                <option value="1" >一星</option>
                            </select>
                        </td>
                      </tr>
                      <tr>
                        <td align="left" valign="top" class="aft_l">选择图片</td>
                        <td align="left" valign="middle" class="aft_r">
                           <a href="javascript:;" id="inputFileContainer" class="input_file_container2 pr">
            <input type="file" id='file_upload' name="file1" class="input_file2" onchange='this.form.submit()' hidefocus="true" style="width: 78px;height: 78px;" >
                            </a>
                        </td>
                      </tr>
                      <tr>
                        <td align="left" valign="top" class="aft_l">晒图</td>
                        <td align="left" valign="middle" class="aft_r">
                           <div class="photo img100" id="avtivity_imgs" >
                                                  
                            </div>
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
                        <td align="left" valign="top" class="aft_l">评论内容</td>
                        <td align="left" valign="middle" class="aft_r">
							 <textarea class="feel font-12" name="content" datatype="*1-200"  errormsg="请输入正确的1-200位字符串" nullmsg="请输入1-200位字符串" style="width: 600px;height: 300px;" ></textarea>
						</td>
                      </tr>
					  
					  
                    </table>

                    
                    <div class="add_from_table_bottom">
                    <input type="hidden" value="" name='' >
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
<script type="text/javascript">
        <?php $timestamp = time();?>
        var img_limit=5;
        var success_upload = key = 0;
        var imgs = new Array();
        $(function() {
            $('#file_upload').uploadify({
                'formData'       : {
                    'timestamp'  : '<?php echo $timestamp;?>',
                    'token'      : '<?php echo md5('hslbg_unique_salt' . $timestamp);?>',

                },
                'queueSizeLimit' :img_limit,
                'fileSizeLimit'  : '2048KB',
                'width'          : 78,
                'height'         : 78,
                'removeTimeout'  : 0,
                'swf'            : _APP+'/Public/Common/uploadify/uploadify.swf',
                'uploader'       : _APP+'/Common/itemCommentUploadify',
                'multi'          : true,    //设置可上传多个文件
                'buttonText'     : '',  
                'fileTypeExts'   : '*.jpg;*.jpeg;*.png;*.gif;',
                'auto'           : true,
                'multi'          : true,
                'overrideEvents': ['onSelectError','onDialogClose','onUploadSuccess'],
                'onDialogClose' : function(queueData){
                    var n = parseInt(img_limit-success_upload);
                    if(queueData.filesSelected > n){
                        $('#file_upload').uploadify('cancel', '*');
                        layer.alert('您最多还可上传'+n+'张图片');
                    }

                },
                'onSelectError' : function(file, errorCode, errorMsg){
                    switch (errorCode) {
                        case -100:
                            layer.alert("上传的图片数量已经超出系统限制的" + $('#file_upload').uploadify('settings', 'uploadLimit') + "张图片！");
                            break;
                        case -110:
                            layer.alert("文件 [" + file.name + "] 大小超出系统限制的" + $('#file_upload').uploadify('settings', 'fileSizeLimit') + "大小！");
                            break;
                        case -120:
                            layer.alert("文件 [" + file.name + "] 大小异常！");
                            break;
                        case -130:
                            layer.alert("文件 [" + file.name + "] 类型不正确！");
                            break;
                    }
                    return false;
                },
                'onUploadSuccess': function(file, data,response){
                    var data = eval('('+data+')');
                    if (!data.status) {
                        layer.alert(data.msg);
                    } else {
                        key++;
                        imgs[key] = data.url;
                        var img_html='<ul><li>';
                        img_html+='<img src="__ROOT__'+data.url+'" width="78" height="78" />';
                        img_html+='<em class="close-xx pro_close" onclick="del_activity_img(this,\''+key+'\');" ></em><input type="hidden" name="filename[]" value="'+data.url+'" />';
                        img_html+='</li></ul>';
                        $("#avtivity_imgs").append(img_html);
                        success_upload++;
                        $('#num').text(success_upload+'/5');
                        
                    }
                }
                    
            });
        });

        function del_activity_img(obj,key){
            var obj = $(obj);
            if(typeof(imgs[key]) != 'undefined'){
                delete imgs[key];
                success_upload--;
                obj.parent().parent().remove();

                var url='<?php echo U('Common/delImg');?>';
                var filename=obj.parent().find('input').val() ;
                $.post(url,{filename:filename},function(data){

                },"JSON");
                $('#num').text(success_upload+'/5');

            }
            
        }

       
</script>

<?php W('Admin/foot');?>