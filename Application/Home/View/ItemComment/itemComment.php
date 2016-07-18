<?php W('Home/head',array('seo_data'=>$seo_data));?>

<script type="text/javascript" src="__PUBLIC__/Home/js/public/jquery.raty.js"></script>
<script type="text/javascript" src="__PUBLIC__/Home/js/itemcomment.js"></script>
<script type="text/javascript" src="__PUBLIC__/Common/uploadify/jquery.uploadify.min.js" ></script>
<!--wrap-->
    <div class="thewidth100 bg_gray clearfix"> 
        <div class="user-line clearfix">
            <div class="thewidth">
                <div class="width font-12 c666">
                    <a href="<?php echo U('Index/index') ?>">首页 </a>><a href="<?php echo U('Order/myOrders') ?>">订单中心 </a>>评价订单
                </div>
                </div>
        </div> 
        <div  class="thewidth">
            <div class="width bg_fff mt15 pj-order">
                <div class="width">商品信息</div>
                <table class="jftable jftable2 center mt15 f_l order-form js shoptable mb25" cellpadding="0">
                    <thead>
                        <tr>
                            <th class="wb50">商品信息</th>
                            <th class="wb25">数量</th>
                            <th class="wb25">总额</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="wb50">
                                <div class="order-pic img100 ml32">
                                <img src="<?php $val = empty($data['items']['img_uri'])?'__PUBLIC__/upload/watermark.jpg':'__ROOT__'.$data['items']['img_uri'];echo $val; ?>">
                                </div>
                                <div class="order-text2 ml10 mp">
                                    <p><?php echo $data['items']['item_name'] ?></p>
                                    <p><?php echo $data['items']['price'] ?>x1</p>
                                </div>
                            </td>
                            <td class="wb25">x<?php echo $data['items']['quantity'] ?></td>
                            <td class="wb25">¥<?php echo $data['items']['price']*$data['items']['quantity'] ?></td>
                        </tr>
                    </tbody>
                </table>
                    
                        <div class="width">
                            <!-- 订单明细 -->
                                <div class="width">商品评价</div>
                                    <form method="post" class="demoform wb70 mt20 f_l" id="itemcomment" >
                                        <div class="demoformbox mb25">
                                            <div class="wb10 f_l tx-r"><span class="red">*</span>评分：</div>
                                            <div class="wb85 f_l"><div id="star"></div></div>
                                            <span class="Validform_checktip"></span>
                                        </div>
                                        <div class="demoformbox mb25">
                                            <div class="wb10 f_l tx-r"><span class="red">*</span>感受：</div>
                                            <div class="wb85 f_l ml15">
                                                <textarea class="feel font-12" name="content" datatype="*1-200" placeholder="商品满意吗?来分享您的感受吧~" errormsg="请输入正确的1-200位字符串" nullmsg="请输入1-200位字符串"></textarea>
                                                <div class="f_r c999 font-12">评价字数限 200 字</div>
                                            </div>
                                            <span class="Validform_checktip"></span>
                                        </div>
                                        <div class="demoformbox mb25">
                                            <div class="wb10 f_l tx-r">晒单：</div>
                                                        <div class="wb85 f_l ml15">
                                                            <div class="photo img100">
                                                                <ul>
                                                                    <li>
                                                                        <a href="####" id="inputFileContainer" class="input_file_container2">
            <input type="file" id='file_upload' name="file1" class="input_file2" onchange='this.form.submit()' hidefocus="true">
                                                                        </a>
                                                                    </li>
                                                                    <span class="f_l ml5 mt30" id="num" >0/5</span>
                                                                </ul>
                                                            </div>

                                                        </div>
                                        </div>
                                        <div class="demoformbox mb25">
                                            <div class="wb10 f_l tx-r">&nbsp;</div>
                                            <div class="wb85 f_l ml15">
                                                <div class="photo img100" id="avtivity_imgs" >
                                                  
                                                </div>
                                            </div>
                                        </div>
                                        <div class="demoformbox">
                                            <label class="wb10 f_l c666 mr17">&nbsp;</label>
                                            <input type="hidden" name='orders_id' value='<?php echo $data['items']['orders_id'] ?>' />
                                            <input type="hidden" name='item_id' value='<?php echo $data['items']['item_id'] ?>' />
                                            <input type="hidden" name='score' value='' />
                                            <button type="button" id="LFSubmit2" id="btn_sub" class="btn btn-blue mt10 padtb15">提交评价</button>
                                        </div>
                                    </form>
                                
                            <!-- /订单明细 -->
                            
                        </div>
                </div>
            </div>
          
             
    </div>
<!--/wrap-->
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
<?php W('Home/foot');?>



<!--星评-->
<script type="text/javascript">
 $('#star').raty();
</script>

