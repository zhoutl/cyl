<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>注册</title>
<link rel="stylesheet" href="__PUBLIC__/Home/css/public/reset.css" type="text/css" media="screen" />
<link rel="Stylesheet" href="__PUBLIC__/Common/css/bootstrap.min.css" type="text/css" />
<link rel="Stylesheet" href="__PUBLIC__/Home/css/public/font-awesome.min.css" type="text/css" />
<link rel="Stylesheet" href="__PUBLIC__/Home/css/style.css" type="text/css" />
<link rel="Stylesheet" href="__PUBLIC__/Home/css/login.css" type="text/css" />
<link rel="Stylesheet" href="__PUBLIC__/Home/css/jform.css" type="text/css" />
<!-- jQuery -->
<!-- jQuery -->
<script type="text/javascript" src="__PUBLIC__/Common/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Common/js/bootstrap.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Common/js/jform.js"></script>

<script type="text/javascript" src="__PUBLIC__/Home/js/register.js"></script>
<script src="__PUBLIC__/Common/js/layer/layer.js"></script>
<script>
var _APP = "<?php echo "__APP__"; ?>";
var _URL = "<?php echo "__URL__"; ?>";
</script>
</head>

<body>

<div id="container" class="thewidth100">

<!--header-->
    <div class="top_bg clearfix thewidth100"> 
        <div class="top thewidth clearfix">
         <div class="f_l"><a href="<?php echo U('Index/index') ?>"><img src="__PUBLIC__/Home/images/logo.jpg"></a></div>
        
        <!--top_right-->
        <div class="f_r">还没有账号？ <a href="<?php echo U('Login/index') ?>" class="red">现在登录</a></div>
         <!--/top_right--> 
        
       </div> 
    </div>
<!--[ header ]-->


<!--wrap-->
    <div class="thewidth100 bg_gray">    
        <div class="bg_fff thewidth clearfix">
            <div class="regtop font-18 red">欢迎注册！</div>     
            <div class="width">
                <div class="registerForm">
                    <form method="post" class="demoform" id="registerform">
                        <div class="demoformbox">
                            <div class="form-control lo_text">
                                <label class="wb30 f_l">用 户 名</label>
                                <input type="text" id="uname" class="regkk1" name="uname" placeholder="请输入手机号/邮箱" datatype="m|e" errormsg="请输入手机号/邮箱" nullmsg="请输入手机号/邮箱" ajaxurl="<?php echo U('Register/checkUserName')?>">
                            </div>
                            <div class="Validform_checktip" id="erorrmsg" style="margin-left: 13px;margin-top: 3.2px;"></div>
                        </div>

                        <div class="demoformbox pr">
                            <div class="form-control lo_text">
                                <label class="wb30 f_l">验 证 码</label>
                                <input type="text" id="phoneCode" class="regkk1 regkk2" name="code"  placeholder="请输入手机或邮箱验证码"  datatype="*4-6" errormsg="请输入手机或邮箱验证码" nullmsg="请输入手机或邮箱验证码">
                                <button type="button"  class="regphone">获取验证码</button>
                                
                            </div>
                            <div class="Validform_checktip"></div>
                        </div>

                        <div class="demoformbox">
                            <div class="form-control lo_text">
                                <label class="wb30 f_l">设 置 密 码</label>
                                <input type="password" id="password" class="regkk1" name="password" placeholder="由6-16位英文字母、数字、下划线组成" datatype="/^[0-9a-zA-Z_]{6,16}$/" errormsg="由6-16位英文字母、数字、下划线组成" nullmsg="由6-16位英文字母、数字、下划线组成">
                            </div>
                            <div class="Validform_checktip"></div>
                        </div>
                        <div class="demoformbox">
                            <div class="form-control lo_text">
                                <label class="wb30 f_l">确 认 密 码</label>
                                <input type="password" id="password2" class="regkk1" name="detepassword" recheck="password" placeholder="请再次输入密码"  datatype="/^[0-9a-zA-Z_]{6,16}$/" errormsg="您两次输入的账号密码不一致" nullmsg="请重新输入密码" >
                            </div>
                            <div class="Validform_checktip"></div>
                        </div>

                        <div class="demoformbox pr">
                            <div class="form-control lo_text">
                                <label class="wb30 f_l">图片验证码</label>
                                <input type="text" class="regkk1 regkk2" name="imgcode" placeholder="请输入验证码" datatype="s4-4" errormsg="验证码错误" nullmsg="请输入验证码" />
                                <img class="regyzm" id="code_img" src="<?php echo U('Common/Verify') ?>" width="100" height="35" onclick="change_verify();" style="margin-top: -2px;height:41px;position:relative;left:10px;" />
                            </div>
                            <div class="Validform_checktip"></div>
                        </div>

                        

                        <div class="demoformbox pr">
                            <input name="agreement" id="terms" type="checkbox" value="1" class="f_l" datatype="*" nullmsg="请同意《衡水老白干户注册协议》" checked="checked">
                            <div style="line-height: 21px;">&nbsp;&nbsp;我已阅读并同意 <a href="#" id="registr_protocol_btn" class="blue">《衡水老白干户注册协议》</a></div>
                            <div class="Validform_checktip"></div>
                        </div>
                      

                    
                     <div class="demoformbox">
                      <button type="button" id="LFSubmit2" id="btn_sub" class="btn btn-blue btn-lg font-16">立即注册</button>
                     </div>
                    
                    </form>
               
                </div>
                <div class="f_r regpic"><img src="__PUBLIC__/Home/images/login/register_03.jpg"></div>
            </div>
            
      
       
        
        </div>      
    </div>
<!--/wrap-->
<!--古井协议-->
 <div class="registr_protocol none">
    <!-- protocol_Con -->
    <div class="protocol_Con">
      <!-- prC_title -->
      <h1 class="prC_title">衡水老白干官方商城注册协议</h1>
      <!-- /prC_title -->
      <!-- prC_body -->
      <div class="prC_body">

        <div class="prC_post">
          <p>本协议由您与安徽金阙电子商务有限公司（衡水老白干销售有限公司唯一授权的网上商城运营商）共同缔结，本协议具有合同效力。</p>
          <p>本协议中协议双方合称协议方，安徽金阙电子商务有限公司在协议中亦称为"衡水老白干官方商城"。本协议中"网店平台"指由安徽金阙电子商务有限公司运营的B2C网店（衡水老白干官方商城，域名为www.lbg.com）。</p>
        </div>

        <div class="prC_post">
          <h3>一、 协议内容及签署</h3>
          <p>1.本协议内容包括协议正文及所有衡水老白干官方商城已经发布的或将来可能发布的各类规则。所有规则为本协议不可分割的组成部分，与协议正文具有同等法律效力。除另行明确声明外，任何衡水老白干官方商城提供的服务（以下称为网店平台）均受本协议约束。</p>
          <p>2.您应当在使用网店平台之前认真阅读全部协议内容，对于协议中以加粗字体显示的内容，您应重点阅读。如您对协议有任何疑问的，应向衡水老白干官方商城咨询。但无论您事实上是否在使用网店平台之前认真阅读了本协议内容，只要您使用网店平台，则本协议即对您产生约束，届时您不应以未阅读本协议的内容或者未获得衡水老白干官方商城对您问询的解答等理由，主张本协议无效，或要求撤销本协议。</p>
          <p>3.您承诺接受并遵守本协议的约定。如果您不同意本协议的约定，您应立即停止注册程序或停止使用网店平台。</p>
          <p>4. 衡水老白干官方商城有权根据需要不时地制订、修改本协议及/或各类规则，并以网站公示的方式进行公告，不再单独通知您。变更后的协议和规则一经在网站公布后，立即自动生效。如您不同意相关变更，应当立即停止使用网店平台。您继续使用网店平台的，即表示您接受经修订的协议和规则。</p>
        </div>

        <div class="prC_post">
          <h3>二、 注册</h3>
          <p><b>1.注册者资格</b></p>
          <p>您确认，在您完成注册程序或以其他衡水老白干官方商城允许的方式实际使用网店服务时，<b>您应当是具备完全民事权利能力和完全民事行为能力的自然人、法人或其他组织</b>。若您不具备前述主体资格，则您及您的监护人应承担因此而导致的一切后果，且衡水老白干官方商城有权注销（永久冻结）您的账户，并向您及您的监护人索偿。</p>
          <p><b>2.账户</b></p>
          <p>
在您签署本协议，完成会员注册程序或以其他衡水老白干官方商城允许的方式实际使用网店服务时，衡水老白干官方商城会向您提供唯一编号的账户。 您可以对账户设置会员名和密码，通过该会员名密码或与该会员名密码关联的其它用户名密码登陆网店平台。您设置的会员名不得侵犯或涉嫌侵犯他人合法权益。如您连续一年未使用您的会员名和密码登录网店，衡水老白干官方商城有权终止向您提供网店服务，注销您的账户。账户注销后，相应的会员名将开放给任意用户注册登记使用。</p>
          <p>您应对您的账户（会员名）和密码的安全，以及对通过您的账户（会员名）和密码实施的行为负责。除非有法律规定或司法裁定，且征得衡水老白干官方商城的同意，否则，账户（会员名）和密码不得以任何方式转让、赠与或继承（与账户相关的财产权益除外）。如果发现任何人不当使用您的账户或有任何其他可能危及您的账户安全的情形时，您应当立即以有效方式通知衡水老白干官方商城，要求衡水老白干官方商城暂停相关服务。您理解衡水老白干官方商城对您的请求采取行动需要合理时间，衡水老白干官方商城对在采取行动前已经产生的后果（包括但不限于您的任何损失）不承担任何责任。</p>
          <p>为方便您使用网店服务，您同意并授权衡水老白干官方商城将您在注册、使用网店平台过程中提供、形成的信息传递给向您提供其他服务的网店提供平台或其他组织，或从提供其他服务的网店服务平台或其他组织获取您在注册、使用其他服务期间提供、形成的信息。</p>
          <p><b>3.会员</b></p>
          <p>在您按照注册页面提示填写信息、阅读并同意本协议并完成全部注册程序后或以其他衡水老白干官方商城允许的方式实际使用网店平台时，您即成为衡水老白干官方商城会员（亦称会员）。</p>
          <p>在注册时，您应当按照法律法规要求，或注册页面的提示准确提供，并及时更新您的资料，以使之真实、及时，完整和准确。如有合理理由怀疑您提供的资料错误、不实、过时或不完整的，衡水老白干官方商城有权向您发出询问及/或要求改正的通知，并有权直接做出删除相应资料的处理，直至中止、终止对您提供部分或全部网店平台。衡水老白干官方商城对此不承担任何责任。
您应当准确填写并及时更新您提供的电子邮件地址、联系电话、联系地址、邮政编码等联系方式，以便衡水老白干官方商城或其他会员与您进行有效联系，因通过这些联系方式无法与您取得联系，导致您在使用网店平台过程中产生任何损失或增加费用的，衡水老白干官方商城不承担任何责任。 您在使用网店平台过程中，所产生的应纳税赋，以及一切硬件、软件、服务及其它方面的费用，均由您独自承担。</p>
          
        </div>

        <div class="prC_post">
          <h3>三、 网店平台</h3>
          <p>1.通过衡水老白干官方商城提供的网店服务和其它服务，会员可在衡水老白干官方商城平台上查询商品和服务信息、达成交易意向并进行交易、对其他会员进行评价、参加衡水老白干官方商城组织的活动以及使用其它信息服务及技术服务。</p>
          <p>2.您了解并同意，衡水老白干官方商城有权应政府部门（包括司法及行政部门）的要求，向其提供您在网店平台填写的注册信息和交易记录等必要信息。如您涉嫌侵犯他人隐私，则衡水老白干官方商城亦有权在初步判断涉嫌侵权行为存在的情况下，向权利人提供您必要的身份信息。</p>
        </div>

        <div class="prC_post">
          <h3>四、 网店平台服务使用规范</h3>
          <p><b>1.在网店平台上使用服务过程中，您承诺遵守以下约定：</b></p>
          <p>（1)在使用网店平台服务及其他相关服务过程中实施的所有行为均遵守国家法律、法规等规范性文件及网店平台各项规则的规定和要求，不违背社会公共利益或公共道德，不损害他人的合法权益，不违反本协议及相关规则。您如果违反前述承诺，产生任何法律后果的，您应以自己的名义独立承担所有的法律责任，并确保衡水老白干官方商城免于因此产生任何损失。</p>
          <p>（2)不对网店平台上的任何数据作商业性利用，包括但不限于在未经衡水老白干官方商城事先书面同意的情况下，以复制、传播等任何方式使用网店平台上展示的资料。</p>
          <p>（3)不使用任何装置、软件或例行程序干预或试图干预网店平台的正常运作或正在网店平台上进行的任何交易、活动。您不得采取任何将导致不合理的庞大数据负载加诸网店平台网络设备的行动。</p>
          <p><b>2.您了解并同意：</b></p>
          <p>（1) 衡水老白干官方商城有权对您是否违反上述承诺做出单方认定，并根据单方认定结果适用规则予以处理或终止向您提供服务，且无须征得您的同意或提前通知予您。</p>
          <p>（2)经国家行政或司法机关的生效法律文书确认您存在违法或侵权行为，或者衡水老白干官方商城根据自身的判断，认为您的行为涉嫌违反本协议和/或规则的条款或涉嫌违反法律法规的规定的，则衡水老白干官方商城有权在网店平台上公示您的该等涉嫌违法或违约行为及衡水老白干官方商城已对您采取的措施。</p>
          <p>（3)对于您在网店平台上实施的行为，包括您未在网店平台上实施但已经对网店平台及其用户产生影响的行为，衡水老白干官方商城有权单方认定您行为的性质及是否构成对本协议和/或规则的违反，并据此作出相应处罚。您应自行保存与您行为有关的全部证据，并应对无法提供充要证据而承担的不利后果。</p>
          <p>（4)对于您涉嫌违反承诺的行为对任意第三方造成损害的，您均应当以自己的名义独立承担所有的法律责任，并应确保衡水老白干官方商城免于因此产生损失或增加费用。</p>
          <p>（5) 如您涉嫌违反有关法律或者本协议之规定，使衡水老白干官方商城遭受任何损失，或受到任何第三方的索赔， 或受到任何行政管理部门的处罚，您应当赔偿衡水老白干官方商城因此造成的损失及（或）发生的费用，包括合理的律师费用。</p>
          <p></p>
        </div>

        <div class="prC_post">
          <h3>五、 特别授权</h3>
          <p>您完全理解并不可撤销地授予衡水老白干官方商城及其关联公司下列权利：</p>
          <p>对于您提供的资料及数据信息，您授予衡水老白干官方商城及其关联公司全球通用的、永久的、免费的许可使用权利 (并有权在多个层面对该权利进行再授权)。此外，衡水老白干官方商城及其关联公司有权(全部或部份地) 使用、复制、修订、改写、发布、翻译、分发、执行和展示您的全部资料数据或制作其派生作品，并以现在已知或日后开发的任何形式、媒体或技术，将上述信息纳入其它作品内。</p>
        </div>

        <div class="prC_post">
          <h3>六、责任范围和责任限制</h3>
          <p>1. 衡水老白干官方商城负责按"现状"和"可得到"的状态向您提供网店平台服务。但衡水老白干官方商城对网店平台服务不作任何明示或暗示的保证，包括但不限于网店平台服务的适用性、没有错误或疏漏、持续性、准确性、可靠性、适用于某一特定用途。同时，衡水老白干官方商城也不对网店平台服务所涉及的技术及信息的有效性、准确性、正确性、可靠性、质量、稳定、完整和及时性作出任何承诺和保证。</p>
          <p>2.除非法律法规明确要求，或出现以下情况，否则，衡水老白干官方商城没有义务对所有用户的注册数据及有关的其它事项进行事先审查：<br>（1) 衡水老白干官方商城有合理的理由认为特定会员及具体交易事项可能存在重大违法或违约情形。<br>（2) 衡水老白干官方商城有合理的理由认为用户在网店平台的行为涉嫌违法或不当。</p>
          <p>3.您了解并同意，衡水老白干官方商城不对因下述任一情况而导致您的任何损害赔偿承担责任，包括但不限于利润、商誉、使用、数据等方面的损失或其它无形损失的损害赔偿 (无论衡水老白干官方商城是否已被告知该等损害赔偿的可能性) ：<br>（1) 使用或未能使用网店平台服务。<br>（2) 第三方未经批准的使用您的账户或更改您的数据。<br>（3) 通过网店平台服务购买或获取任何商品、样品、数据、信息或进行交易等行为或替代行为产生的费用及损失。<br>（4) 您对网店平台服务的误解。<br>（5) 任何非因衡水老白干官方商城的原因而引起的与网店平台服务有关的其它损失。</p>
          <p>4. 衡水老白干官方商城有权对商品价格进行随时调整时。因价格调整导致您的订单价格与调整之后的价格不符的，按如下情况处理：<br>（1）库房已发货，则按调整之前的的价格收取商品费用<br>（2）库房未发货，衡水老白干官方商城会通知您此订单失效，需要重新按照新的价格下单。</p>
          <p>5.不论在何种情况下，衡水老白干官方商城均不对由于信息网络正常的设备维护，信息网络连接故障，电脑、通讯或其他系统的故障，电力故障，罢工，劳动争议，暴乱，起义，骚乱，生产力或生产资料不足，火灾，洪水，风暴，爆炸，战争，政府行为，司法行政机关的命令或第三方的不作为而造成的不能服务或延迟服务承担责任。</p>
        </div>

        <div class="prC_post">
          <h3>七、协议终止</h3>
          <p>1.您同意，衡水老白干官方商城有权自行全权决定以任何理由不经事先通知的中止、终止向您提供部分或全部网店平台服务，暂时冻结或永久冻结（注销）您的账户，且无须为此向您或任何第三方承担任何责任。</p>
          <p>2.出现以下情况时，衡水老白干官方商城有权直接以注销账户的方式终止本协议:<br>（1) 衡水老白干官方商城终止向您提供服务后，您涉嫌再一次直接或间接或以他人名义注册为衡水老白干官方商城用户的；<br>（2)您提供的电子邮箱不存在或无法接收电子邮件，且没有其他方式可以与您进行联系，或衡水老白干官方商城以其它联系方式通知您更改电子邮件信息，而您在衡水老白干官方商城通知后三个工作日内仍未更改为有效的电子邮箱的。<br>（3) 您注册信息中的主要内容不真实或不准确或不及时或不完整。<br>（4）本协议（含规则）变更时，您明示并通知衡水老白干官方商城不愿接受新的服务协议的；<br>（5) 其它衡水老白干官方商城认为应当终止服务的情况。</p>
          <p>3.您有权向衡水老白干官方商城要求注销您的账户，经衡水老白干官方商城审核同意的，将注销（永久冻结）您的账户，届时，您与衡水老白干官方商城基于本协议的合同关系即终止。您的账户被注销（永久冻结）后，衡水老白干官方商城没有义务为您保留或向您披露您账户中的任何信息，也没有义务向您或第三方转发任何您未曾阅读或发送过的信息。</p>
          <p>4.您同意，您与衡水老白干官方商城的合同关系终止后，衡水老白干官方商城仍享有下列权利<br>（1) 继续保存您的注册信息及您使用网店平台服务期间的所有交易信息。<br>（2) 您在使用网店平台服务期间存在违法行为或违反本协议和/或规则的行为的，衡水老白干官方商城仍可依据本协议向您主张权利。</p>
          <p>5. 衡水老白干官方商城中止或终止向您提供网店平台服务后，对于您在服务中止或终止之前的交易行为依下列原则处理，您应独力处理并完全承担进行以下处理所产生的任何争议、损失或增加的任何费用，并应确保衡水老白干官方商城免于因此产生任何损失或承担任何费用：<br>（1) 您在服务中止或终止之前已经与衡水老白干官方商城达成买卖合同，但合同尚未实际履行的，衡水老白干官方商城有权删除该买卖合同及其交易的相关信息；<br>
（2）您在服务中止或终止之前已经与衡水老白干官方商城达成买卖合同且已履行的，衡水老白干官方商城可以不删除该项交易，但衡水老白干官方商城有权在中止或终止服务的同时将相关情形通知您。</p>
        </div>

        <div class="prC_post">
          <h3>八、隐私权政策</h3>
          <p>您在本站进行注册、浏览、下单购物、评价、参加活动等行为时，涉及您真实姓名/名称、通信地址、联系电话、电子邮箱、订单详情、评价或反馈、投诉内容、cookies等信息的，本站有权从完成交易、提供配送、售后及客户服务、开展活动、完成良好的客户体验等多种角度予以收集，并将对其中涉及个人隐私信息予以严格保密，除非得到您的授权、或为履行强行性法律义务（如国家机关指令）、或按照您的需求为您提高更良好的合作、本注册协议或其他条款另有约定外，本站不会向外界披露您的隐私信息。<br>本站会通过用户注册的邮箱为用户发送衡水老白干官方商城相关产品及活动信息，如不想继续订阅接收，可通过邮件页面的退订按钮实现退订。<br>如您需更改您在本站注册的手机、邮箱等个人隐私信息，可在用户中心自行修改或通过以下方式联系我们进行修改：</p>
          <p>衡水老白干官方商城客服电话：<b>400-8877-519</b></p>
        </div>

        <div class="prC_post">
          <h3>九、法律适用、管辖与其它</h3>
          <p>1.本协议之效力、解释、变更、执行与争议解决均适用中华人民共和国法律，如无相关法律规定的，则应参照通用商业惯例和行业惯例。</p>
          <p>2.因本协议产生之争议，应依照中华人民共和国法律予以处理。</p>
        </div>

      </div>
      <!-- /prC_body -->
      
    </div>
    <!-- /protocol_Con -->
 </div>
 <!--/古井协议-->

<?php W('Home/foot');?>