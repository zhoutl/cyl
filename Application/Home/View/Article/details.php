<?php W('Home/head',array('seo_data'=>$seo_data));?>

<!--wrap-->
    <div class="thewidth100 bg_gray clearfix"> 
        <div  class="thewidth">
            <div class="width font-12 c666">
                    <a href="<?php echo U('Index/index') ?>">首页 </a>><a href="<?php echo U('Article/index') ?>">老白干资讯 </a>>
                    <a href="">
                    <?php  $val = empty($data['nav']['article_category_name'])?$data['article']['title']:$data['nav']['article_category_name'];echo $val; ?>
                    </a>
                </div>
            <!-- newsleft -->
            <div class="newsleft mt15">
                <div class="gg width font-18">
                    <ul>
                        <?php foreach ($data['left'] as $key => $vo) { ?>
                        <li>
                        <a href="<?php echo U('Article/index',array('article_category_id'=>$vo['article_category_id'])) ?>" 
                        class="<?php $var = $data['article_category_id']==$vo['article_category_id']? 'current14':'';echo $var ?>" >
                    <?php echo $vo['article_category_name'] ?>
                        </a>
                        </li>
                    <?php } ?>
                    </ul>
                </div>
                <div class="width mt20 newspic img100">
                    <div class="newspro width font-16">
                        <span class="f_l c666">新品热卖</span>
                        <a href="#" class="f_r red font-12">更多</a>
                    </div>
                    <ul>
                        <li>
                            <a href="#"><img src="__PUBLIC__/Home/images/user/pro1.jpg"></a>
                            <div class="protext"><a href="#">衡水老白干 67度750ml*2瓶 </a></div>
                            <div class="red">￥<span class="font-20">199</span><span class="red">.00</span></div>
                        </li>
                        <li>
                            <a href="#"><img src="__PUBLIC__/Home/images/user/pro2.jpg"></a>
                            <div class="protext"><a href="#">衡水老白干 67度750ml*2瓶 </a></div>
                            <div class="red">￥<span class="font-20">199</span><span class="red">.00</span></div>
                        </li>
                    </ul>

                </div>
            </div>
            <!-- newsleft -->
            <!-- newsright -->
            <div class="newsright newsdetails mt15">
                <div class="width center font-20"><?php echo $data['article']['title'] ?></div>
                <div class="width mt30 newsxq c666 font-16">
                    <?php echo htmlspecialchars_decode($data['article']['content']) ?>
                    <div class="width tx-r font-12 c999">
                    发布日期：<?php echo date('Y-m-d H:i:s',$data['article']['pubdate']) ?>
                    </div>
                </div>
                
               
            </div>
            <!-- /newsright -->

        </div>  
    </div>
<!--/wrap-->



<script src="js/wan-spinner.js"></script> 

<script type="text/javascript">
    $(function(){
         $(".approve").click(function() {
        clear();
        $(this).addClass("active");
    });

    function clear() {
    $(".approve").each(function() {
         if ($(this).hasClass("active")) {
            $(this).removeClass("active");
        } 
        
    });
}
})
    //重新加载页面
    function setReload(){
    window.location.reload();
}

</script>

<?php W('Home/foot');?>