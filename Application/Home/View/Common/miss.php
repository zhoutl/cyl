<?php W('Home/head',array('seo_data'=>$seo_data));?>


<!--wrap-->
    <div class="thewidth100 bg_404 clearfix"> 
        <div  class="thewidth">
            <div class="width center mt40">
                <img src="__PUBLIC__/Home/images/404_07.png" class="mt25 mb40">
                <p class="c666 font-34 mb40"><?php echo $msg; ?></p>
                <a href="<?php echo U('Index/index');?>" class="error mr10">返回首页</a>
                <a href="javascript:;" onclick="setReload()" class="error2">重新加载</a>
            </div>
            

        </div>  
    </div>
<!--/wrap-->
<script type="text/javascript">
   function  setReload(){
     window.location.reload();
   }

</script>

<?php W('Home/foot');?>
