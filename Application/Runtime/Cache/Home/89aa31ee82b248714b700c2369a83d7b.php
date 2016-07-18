<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $data['title']; ?></title>
<meta name="keywords" content="<?php echo $data['keywords']; ?>" />
<meta name="description" content="<?php echo $data['description']; ?>" />

<link rel="stylesheet" href="/cyl/Public/Home/css/public/reset.css" type="text/css" media="screen" />
<link rel="Stylesheet" href="/cyl/Public/Common/css/bootstrap.min.css" type="text/css" />
<link rel="Stylesheet" href="/cyl/Public/Home/css/public/font-awesome.min.css" type="text/css" />
<link rel="Stylesheet" href="/cyl/Public/Home/css/jform.css" type="text/css" />
<link rel="Stylesheet" href="/cyl/Public/Home/css/style.css" type="text/css" /> 
<link rel="Stylesheet" href="/cyl/Public/Home/css/user.css" type="text/css" />
<!-- jQuery -->
<script type="text/javascript" src="/cyl/Public/Common/js/jquery-1.8.2.min.js"></script>
<script src="/cyl/Public/Common/js/layer/layer.js"></script>

<script src="/cyl/Public/Common/js/laydate/laydate.js"></script>

<script type="text/javascript" src="/cyl/Public/Common/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/cyl/Public/Common/js/jform.js"></script>

<script>
var _APP = "<?php echo "/cyl"; ?>";
var _URL = "<?php echo "/cyl/Home/Index"; ?>";
</script>
</head>

<body>

<div id="container" class="thewidth100">

<!--header-->
    <div class="bg-black thewidth100" id="xl_5">
        <div class="thewidth clearfix cfff font-12 status">
            <div class="f_l">
				<?php if(!$data['account']){ ?>
					<span class="mr17">Hi , 欢迎来衡水老白干</span>
					<span class="cfff"><a href="<?php echo U('Login/index'); ?>">请登录</a></span>
					<span class="ml10 mr10">|</span>
					<span class="yellow2"><a href="<?php echo U('Register/index'); ?>">免费注册</a></span>
				<?php }else{ ?>
					<span class="mr17">Hi , <?php echo $data['account']['name']; ?>&nbsp;&nbsp;欢迎来衡水老白干</span>
					<span><a href="<?php echo U('Login/loginOut'); ?>">退出</a></span>
				<?php } ?>
            </div>
            <div class="f_r">
                <span><a href="#">关注老白干</a></span>
                <span class="ml10 mr10">|</span>
                <span><a href="<?php echo U('Account/index'); ?>">我的老白干</a></span>
                <span class="ml10 mr10">|</span>
                <span><a href="#">掌上老白干</a></span>
                <span class="ml10 mr10">|</span>
                <span><a href="#">订购热线</a></span>
                <span class="yellow2 ml10">400-525-8888</span>
            </div>
        </div>
    </div>
    <div class="top_bg clearfix thewidth100"> 
        <div class="top thewidth clearfix">
            <div class="f_l"><a href="<?php echo U('Index/index'); ?>"><img src="/cyl/Public/Home/images/logo.jpg"></a></div>
            <!--top_right-->
            <div class="pr ssbox">
                <form  id="item_search" action="<?php echo U('Searchs/search');?>" method="get" >
                    <input type="text" name="keyword" value="<?php echo $keyword; ?>" placeholder="大青花" class="search mt10">
                    <button type="button" id="submit_btn" class="ss"></button>
                </form>
            </div>
            <div class="bz mt10">
                <ul>
                    <li>
                        <em><img src="/cyl/Public/Home/images/index_10.jpg"></em>
                        <span class="font-12 c666 ml5">顺丰包邮</span>
                    </li>
                    <li>
                        <em><img src="/cyl/Public/Home/images/index_08.jpg"></em>
                        <span class="font-12 c666 ml5">品质保障</span>
                    </li>
                    <li>
                        <em><img src="/cyl/Public/Home/images/index_06.jpg"></em>
                        <span class="font-12 c666 ml5">7天无理由退换货</span>
                    </li>
                    
                    
       
                </ul>
            </div>
            <!--/top_right--> 
       </div> 
       <div class="thewidth100 bor-bottom">
        <div class="thewidth clearfix">
            <div class="allSortOuterbox">
                <a href="javascript:;" class="menuleft">所有商品分类</a>
                <div class="xiala" id="left_child_menu" style="display:none;" >
                    <ul>
						<?php foreach($data['item_category'] as $v): ?>
						<li>
							<a href="<?php echo U('Product/productsList',array('cid'=>$v['item_category_id']));?>">
								<em class="drop1 mr10"><img src="<?php echo $v['icon']; ?>" width="27" height="27"></em><?php echo $v['category_name'];?>
							</a>
						</li>
						<?php endforeach;?>
                        <li><p></p></li>
                    </ul>
                </div>
            </div>
            <div class="nav">
                <ul>
                    <li><a href="<?php echo U('Index/index');?>">商城首页</a></li>
                    <li><a href="<?php echo U('Product/purposeList',array('param'=>1));?>">商务宴请</a></li>
                    <li><a href="<?php echo U('Product/purposeList',array('param'=>2));?>">婚嫁专用</a></li>
                    <li><a href="<?php echo U('Article/index');?>">老白干资讯</a></li>
                </ul>
            </div>
            <div class="shopcar f_r">
                <a href="<?php echo U('Cart/myCart'); ?>"><em><?php echo $data['cart_num']; ?></em></a>
            </div>


        </div>
        </div>
    </div>
<!--------------------------------------[ header ]-------------------------------------->