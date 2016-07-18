<?php W('Home/head',array('seo_data'=>$seo_data));?>
<!--独有JS-->
<!--独有JS-->
<!--wrap-->
    <div class="thewidth100 bg_gray clearfix"> 
        <div class="user-line clearfix">
            <div class="thewidth">
                <div class="width font-12 c666">
                    <a href="index.html">首页 </a>><a href="user.html">个人中心 </a>>消息提醒
                </div>
                </div>
                </div> 
                <div  class="thewidth">
                <div class="mainbox mt15">
                    <!-- left -->
                    <?php W('Home/menu');?>
                    <!-- /left -->
                    <!-- right -->
                    <div class="mainright">
                        <div class="width pdl20">
                            <div class="width order-top"><span class="f_l font-20">消息提醒</span></div>
                            <div class="message-top mt10">
                                <ul>
                                    <li><a href="#" class="current4"><em>6</em>活动消息</a></li>
                                    <li><a href="#">交易消息</a></li>
                                </ul>
                            </div>
                        
                            <!-- 消息 -->
                            <div class="message1 mt20 font-12">
                                <ul>
                                    <li>
                                        <div class="message2 pr">
                                            <em></em>
                                            <p class="c666">2016-5-2</p>
                                            <p class="c999">10:20</p>
                                        </div>
                                        <div class="message3 ml25">
                                            <div class="message4">
                                                <a href="javascript:;" class="approve active">&nbsp;&nbsp;&nbsp;&nbsp;[未读]</a>
                                            </div>
                                            <div class="message5">
                                                <p class="message6">【真男人去战斗】，答谢石家庄永昌球迷专场，领券立减20元，只限永昌区使用。时间：5月18日24:00--5月28日24:00    <a href="#" class="blue">点击查看详情 >></a></p>
                                                <p class="message-pic img100"><img src="__PUBLIC__/Home/images/user/user-message_03.jpg"></p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message2 pr">
                                            <em></em>
                                            <p class="c666">2016-5-2</p>
                                            <p class="c999">10:20</p>
                                        </div>
                                        <div class="message3 ml25">
                                            <div class="message4">
                                                <a href="javascript:;" class="approve red">&nbsp;&nbsp;&nbsp;&nbsp;[未读]</a>
                                            </div>
                                            <div class="message5">
                                                <p class="message6">【真男人去战斗】，答谢石家庄永昌球迷专场，领券立减20元，只限永昌区使用。时间：5月18日24:00--5月28日24:00    <a href="#" class="blue">点击查看详情 >></a></p>
                                                <p class="message-pic img100"><img src="__PUBLIC__/Home/images/user/user-message_03.jpg"></p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message2 pr">
                                            <em></em>
                                            <p class="c666">2016-5-2</p>
                                            <p class="c999">10:20</p>
                                        </div>
                                        <div class="message3 ml25">
                                            <div class="message4">
                                                <a href="javascript:;" class="approve">&nbsp;&nbsp;&nbsp;&nbsp;[未读]</a>
                                            </div>
                                            <div class="message5">
                                                <p class="message6">【真男人去战斗】，答谢石家庄永昌球迷专场，领券立减20元，只限永昌区使用。时间：5月18日24:00--5月28日24:00    <a href="#" class="blue">点击查看详情 >></a></p>
                                                <p class="message-pic img100"><img src="__PUBLIC__/Home/images/user/user-message_03.jpg"></p>
                                            </div>
                                        </div>
                                    </li>
                                    
                                </ul>
                                <div class="message7 ml25 mt20">
                                            <a href="javascript:;" class="allmess f_l">全选本页</a>
                                            <a href="javascript:;" class="ydmess f_l ml25 current5">标为已读</a>
                                            <a href="javascript:;" class="ydmess f_l ml25">删除</a>
                                        </div>
                            </div>
                            <!-- /消息 -->

                    </div>
                        
                    </div>
                    <!-- /right -->
                </div>
            </div>
          
             
    </div>
<!--/wrap-->


<?php W('Home/foot');?>
<script type="text/javascript">
$(function(){
        clear();

    // 全选
    $(".allmess").click(function(){
        $(this).toggleClass("active");
        if($(this).hasClass("active")){
            $(".approve").addClass("active");
        } else{
            $(".approve").removeClass("active");
        }
        
    })

})
    function clear() {
    $(".approve").each(function() {
        $(this).click(function(){
            $(this).toggleClass("active");
        })  
        
    });
}


</script>
