<?php W('Home/head',array('seo_data'=>$seo_data));?>
 <script src="__PUBLIC__/Common\uploadify/jquery.uploadify.min.js" type="text/javascript"></script>

<!--wrap-->
    <div class="thewidth100 bg_gray clearfix"> 
        <div  class="thewidth">
            <div class="width font-12 c666">
               <a href="<?php echo U('Index/index');?>">首页 </a>><a href="<?php echo U('Account/index');?>">个人中心 </a>><a href="<?php echo U('Refund/index');?>">我的退货 </a>>退货申请
            </div>

            <!-- shopcar -->
            <div class="shopbox mt10">
                <div class="shoptop2 font-18">
                    <ul>
                        <li>
                            <div class="password1-line password1-line3"></div>
                            <div class="center pasxz2"><p class="password1-se current7">1</p><p class="green">申请退货</p></div>
                        </li>
                        <li>
                            <div class="password1-line"></div>
                            <div class="center pasxz2"><p class="password1-se">2</p><p class="c999">退货审核</p></div>
                        </li>
                        <li>
                            <div class="password1-line"></div>
                            <div class="center pasxz2"><p class="password1-se">3</p><p class="c999">填写物流信息</p></div>
                        </li>
                        <li>
                            <div class="password1-line"></div>
                            <div class="center pasxz2"><p class="password1-se">4</p><p class="c999">退货完成</p></div>
                        </li>
                    </ul>
                </div>
                <!-- 申请退货 -->
                <div class="width mt30">
                    <div class="account1">
                        <span class="f_l font-18 c000">申请退货</span>
                    </div>
                    <div class="account2 account22 c999">
                        <form  method="post"  action="" enctype="multipart/form-data" class="demoform refundfrom mt20">
                            <div class="demoformbox">
                                <label class="wb15 f_l c666 mr17 tx-r font500"><em class="red">*</em>退货商品：</label>
                                <div class="wb60 f_l">
                                <?php  foreach ($data['orders_item'] as $key => $val) : ?>
                                	<div class="width">
                                        <div class="order-pic img100 ml25">
                                        	<?php if(!empty($val['img_uri'])){ ?>
				                               <img src="__ROOT__{$val.img_uri}">
				                            <?php }else{ ?>
				                                <img src="__ROOT__/Public/upload/watermark.jpg">
				                            <?php } ?>
                                        </div>
                                        <div class="order-text2 ml10 blue mr15"><?php echo $val['item_name'];?><br><span class="c666 line26">购买总数量：<?php echo $val['quantity'];?>瓶</span></div>
                                        <div class="f_l ml32 c666"><em class="red">*</em>退货数量：</div>
                                        <div class="wan-spinner wan-spinner-2"> <a onclick="change_num(this,2,<?php echo $val['quantity'];?>)" class="minus">-</a>
                                        	<input type="hidden"  name="item[]" value="<?php echo $val['item_id'];?>" >
                                           <input type="text"  class="num_text" name="quantity_{$val['item_id']}" value="0" class="w40">
                                           <a onclick="change_num(this,1,<?php echo $val['quantity'];?>)" class="plus">+</a> 
                                        </div>
                                    </div>
                                <?php endforeach;?>
                                    
                                </div>
                            </div>
                            <div class="demoformbox">
                                <label class="wb15 f_l c666 mr17 tx-r font500"><em class="red">*</em>退货原因：</label>
                                <select name="refund_reason" class="form-control data-kk1 f_l" datatype="/^[1-9][0-9]{0,}$/" errormsg="请选择原因" nullmsg="请选择原因">
                                    <option value="0">请选择原因</option>
                                    <option value="1">质量有问题</option>
                                    <option value="2">不喜欢</option>
                                    <option value="3">其它</option>
                                </select>
                                <span class="Validform_checktip"></span>
                            </div>
                           
                            <div class="demoformbox">
                                <label class="wb15 f_l c666 mr17 tx-r font500"><em class="red">*</em>退货金额：</label>
                                <div class="" style="width:80%; float: left;">
                                	<div class="width">
                                		<input type="text" name="refund_amount" id="money" class="form-control data-kk1 data-kk6 f_l mr10" placeholder="" datatype="n1-16" errormsg="请输入1-16位数字" nullmsg="请输入1-16位数字">请咨询客服协商退货金额后填写
                                	</div>
                                	
                                <span class="Validform_checktip"></span>
                                
                                
                            </div>
                            <div class="demoformbox">
                                <label class="wb15 f_l c666 mr17 tx-r font500"><em class="red">*</em>详细原因：</label>
                                <textarea name="refund_reason_message" class="data-kk3 mr10" datatype="*0-200" errormsg="请输入2-200位任意字符" nullmsg="请输入2-200位任意字符"></textarea>可输入200字
                                <span class="Validform_checktip"></span>
                            </div>
                             <div class="demoformbox">
                                <label class="wb15 f_l c666 mr17 tx-r font500">上传凭证：</label>
                                <div class="wb65 f_l">
                                    <a  class="angray f_l mr10"><input type="file" class="input_file"  id="file_upload" name="refund_image" value=""></a>
                                    <span class="f_l mt5">图片大小不超过1M，支持bmp,gif,jpg,png,jpeg格式文件</span>
                                    <input type="hidden" name="comment_imgs" value="" />
                                    <div  id="avtivity_imgs" class="width returnlist img100 mt20">
                                        <ul>
                                            
                                        </ul>
                                    </div>
                                </div>
                                
                            </div>
                            
                         
                            
                            <div class="demoformbox">
                                <label class="wb15 f_l mr17 c666">&nbsp;</label>
                                <button type="button" id="submit" id="btn_sub" class="btn btn-blue mt10 save">提交</button>
                            </div>
                            <div class="width border-t mt20 mb25"></div>
                            <div class="demoformbox">
                                <label class="wb15 f_l c666 mr17 tx-r font500">退款说明：</label>
                                <div class="wb65 f_l c333">
                                    <p>1、退货概不退还优惠券，现金券以及其他优惠产品</p>
                                    <p>2、请与退款客服人员协商之后，再填写退款金额</p>
                                </div>
                            </div>
                            <input type="hidden" name="orders_id" value="<?php echo $data['orders_id'];?>" />
                        </form>
                        
                    </div>
                </div>
                <!-- /申请退货 -->

            </div>
            

        </div>  
    </div>
<!--/wrap-->

<script type="text/javascript">
	$(document).ready(function(){
	    $(".refundfrom").Validform({
	        btnSubmit:"#submit", 
	        tiptype:3,
	        showAllError:true,
	        beforeSubmit:function(curform){
	            $.ajax({
	                cache: true,
	                type: "POST",
	                url:_URL+"/doApply",
	                data:$(".refundfrom").serialize(),
	                async: false,
	                error: function(request) {
	                    layer.alert('连接超时，请检查您的网络');
	                },
	                success: function(data) {
	                    if(data.status){
	                        window.location.href ="__ROOT__/Refund/refundDetail/orders_refund_id/"+data.orders_refund_id;
	                    }else{
	                        layer.alert(data.msg);
	                    }
	                }
	            }); 
	            return false;
	        },
	        callback:function(data){
	        }
	    });
	    
	});




        var img_limit=5;
        var success_upload = key = 0;
        var imgs = new Array();
        $(function() {
            $('#file_upload').uploadify({
                'formData'     : {
                    'timestamp' : '<?php echo $timestamp;?>',
                    'token'     : '<?php echo md5('hslbg_unique_salt' . $timestamp);?>',
                    'session_id': '<?php echo session_id(); ?>',
                },
                'swf'      		: '__PUBLIC__/Common/uploadify/uploadify.swf?s=2',
                'uploader' 		: '<?php echo U('Common/refundUploadify');?>',
                'multi'    		: true,    //设置可上传多个文件
               // 'uploadLimit'	: img_limit,   //最大上传文件个数
                'queueSizeLimit':img_limit,
                'fileSizeLimit'	: '1024KB',     //最大上传大小为2048KB
                'auto'     		: true,   //设置自动上传
                // 'buttonClass'   : 'uploadify-button',  //按钮背景图
                'buttonText'    : '上传图片',  //按钮文字
                'fileTypeExts'  : '*.jpg;*.jpeg;*.png;*.gif;',     //可上传文件类型
                'fileTypeDesc'  : '请选择jpg、jpeg、png、gif类型的文件',
                'width'    		: 118,
                'height'   		: 41,
                'removeTimeout' : 0,
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
                            layer.alert("文件 [" + file.name + "] 大小超出系统限制的" + $('#file_upload').uploadify('settings', 'fileSizeLimit') + "大小2！");
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
                'onUploadSuccess' : function(file, data, response){
                    var data = eval('('+data+')');
                    if(!data.status){
                            layer.alert(data.msg);
                    }else{
                        key++;
                        imgs[key] = data.url;
                        var img_html='<ul><li>';
                        img_html+='<img src="__ROOT__'+data.url+'" width="100" height="100" />';
                        img_html+='<a class="pro_close" href="javascript:void(0);" onclick="del_activity_img(this,\''+key+'\');"><em class="close-xx"></em><input type="hidden" name="filename[]" value="'+data.url+'" /></a>';
                        img_html+='</li></ul>';
                        $("#avtivity_imgs").append(img_html);
                        success_upload++;
                        img();
                    }
                },

            });

 
        });
        function del_activity_img(obj,key){
            var obj = $(obj);
            if(typeof(imgs[key]) != 'undefined'){
                delete imgs[key];
                success_upload--;
                obj.parent().parent().remove();

                var	url='<?php echo U('Common/delImg');?>';
                var filename=obj.find('input').val() ;
                $.post(url,{filename:filename},function(data){

				},"JSON");



            }
            img()
        }
        function img(){
            var str ='';
            for(var m = 0 in imgs){
                if(imgs[m])
                    str+=imgs[m]+'|';
            }
            if(str == ''){
                validate_msg = '请上传至少1张活动图片';
                layer.alert(validate_msg);
            }
            str = str.substr(0,str.length-1);
            $("input[name=comment_imgs]").attr("value",str);
        }

  function change_num(obj,type,max){
		var obj = $(obj);
		var n=parseInt(obj.parent().find('.num_text').attr('value'));
		n = type==1?n+1:n-1;
		if(n>=0 && n<=max){
			obj.parent().find('.num_text').attr('value',n); 
		}
  }


    </script>
<?php W('Home/foot');?>