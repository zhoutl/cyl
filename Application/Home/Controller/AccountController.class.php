<?php
namespace Home\Controller;
use Think\Controller;
class AccountController extends HomeController {

    public function index(){

        $seo_data['title']        = '个人主页';
        $seo_data['keywords']     = '衡水老白干官方商城';
        $seo_data['description']  = '衡水老白干官方商城';
        
        $map['account_id']        = $this->mid;
        //获取用户表信息
        $data['account']          = M('Account') -> where($map) -> find();
        $coupon_count             = M('CouponBind') -> where($map) -> count();
        $data['account']['coupon_count'] = $coupon_count;

        $this -> assign('seo_data',$seo_data);
        $this -> assign('data',$data);
        $this -> display();
    }

    public function userInfo() {

        $seo_data['title']        = '个人资料';
        $seo_data['keywords']     = '衡水老白干官方商城';
        $seo_data['description']  = '衡水老白干官方商城';

        //查出昵称和真实姓名
        $map['account_id']        = $this->mid;
        $field                    = array('nickname','real_name');
        $userInfo                 = M('Account') -> field($field) -> where($map) -> find();

        //查询出全国省份
        $map                      = array();
        $map['pid']               = 0;
        $province                 = M('Area') -> where($map) -> select();

        //查出附表中的相关信息
        $map                      = array();
        $map['account_id']        = $this->mid;
        $field                    = array();
        $field                    = array(
                                    'sex',
                                    'province_id',
                                    'city_id',
                                    'area_id',
                                    'home_address',
                                    'birthday'
                                   );
        $userExtra                = M('AccountExtra') -> field($field) ->where($map) -> find();

        //获取城市细信息
        $map['pid']               = $userExtra['province_id'];
        $city                     = M('Area') -> where($map) ->select();

        //获取区域信息
        $map['pid']               = $userExtra['city_id'];
        $area                     = M('Area') -> where($map) ->select();

        $this -> assign('seo_data',$seo_data);
        $this -> assign('userInfo',$userInfo);
        $this -> assign('userExtra',$userExtra);
        $this -> assign('province',$province);
        $this -> assign('city',$city);
        $this -> assign('area',$area);
        $this -> display();
    }

    /* 用户信息保存 */
    public function userInfoSave () {

        if (IS_AJAX) {
            $data                 = I('post.');
            $result               = D('AccountExtra') -> userExtraSave($this ->mid,$data);
            $this -> ajaxReturn($result);
        }
    }

    /* 收货地址 */
    public function address () {

        $seo_data['title']        = '收货地址';
        $seo_data['keywords']     = '衡水老白干官方商城';
        $seo_data['description']  = '衡水老白干官方商城';

        //查出全国省份
        $map                      = array();
        $map['pid']               = 0;
        $province                 = M('Area') -> where($map) -> select();

        //查出现有的收货地址
        $map                      = array();
        $map['account_id']        = $this->mid;
        $data                     = M('AccountAddress') -> where($map) -> select();

        $this -> assign('seo_data',$seo_data);
        $this -> assign('province',$province);
        $this -> assign('data',$data);
        $this -> display();
    }

    /*收货地址增加控制器*/
    public function addressAdd () {

        if (IS_AJAX) {
            $data                  = I('post.');
            $result                = D('AccountAddress') -> addressAdd($this ->mid,$data);
            $this -> ajaxReturn($result);
        }
    }

    /* 设为默认收货地址 */
    public function setDefault () {

        if (IS_AJAX) {
            $data                  = I('post.');
            $result                = D('AccountAddress') -> setDefault($this ->mid,$data);
            $this -> ajaxReturn($result);
        }
    }

    /* 修改地址 */
    public function editor () {

        $seo_data['title']         = '收货地址';
        $seo_data['keywords']      = '衡水老白干官方商城';
        $seo_data['description']   = '衡水老白干官方商城';

        //获取现有的收货地址信息
        $map['account_address_id'] = intval(I('get.account_address_id'));
        $data                      = M('AccountAddress') -> where($map) -> find();
        $data['account_address_id']= intval(I('get.account_address_id'));

        //查询出全国省份
        $map                       = array();
        $map['pid']                = 0;
        $province                  = M('Area') -> where($map) -> select();

        //查询出全省城市
        $map                       = array();
        $map['pid']                = $data['province_id'];
        $city                      = M('Area') -> where($map) -> select();

        //查询出全市区域
        $map                       = array();
        $map['pid']                = $data['city_id'];
        $area                      = M('Area') -> where($map) -> select();


        $this -> assign('data',$data);
        $this -> assign('province',$province);
        $this -> assign('city',$city);
        $this -> assign('area',$area);
        $this -> assign('seo_data',$seo_data);
        $this -> display();
    }

    /* 修改地址操作 */
    public function doEditor () {

        if (IS_AJAX) {
            $data                 = I('post.');
            $result               = D('AccountAddress') -> setEditor($this->mid,$data);
            $this -> ajaxReturn($result);
        }
    }

    /* 删除地址 */
    public function setDelete () {

        if (IS_AJAX) {
            $data                 = I('post.');
            $result               = D('AccountAddress') -> setDelete($this ->mid,$data);
            $this -> ajaxReturn($result);
        }
    }

    /* 我的积分页面 */
    public function myScore () {

        $seo_data['title']        = '我的积分';
        $seo_data['keywords']     = '衡水老白干官方商城';
        $seo_data['description']  = '衡水老白干官方商城';

        //获取积分数据
        $map['account_id']        = $this ->mid;

        //对积分数据进行分页
        $limit                    = 5;
        $data['score']            = M('AccountPointsDetailed') -> order('pubdate desc') -> page(intval(I('get.p')),$limit) -> where($map) -> select();

        $count = M('AccountPointsDetailed') -> where($map) -> count();
        $data['pages']            = new \Think\Page($count,$limit);

        //获取积分总数
        $paypoints                = M('Account') -> field('pay_points') -> where($map) -> find();
        $data['pay_points']       = $paypoints['pay_points'];
        
        $this -> assign('data',$data);
        $this -> assign('seo_data',$seo_data);
        $this -> display();
    }

    /* 我的优惠券页面 */
    public function myCoupon () {
        
        $seo_data['title']        = '我的优惠券';
        $seo_data['keywords']     = '衡水老白干官方商城';
        $seo_data['description']  = '衡水老白干官方商城';

        //获取优惠券数据
        $map['account_id']        = $this ->mid;
        $limit                    = 2;
        $join                     = 'md_coupon ON md_coupon_bind.coupon_id = md_coupon.coupon_id';
        $data                     = M('CouponBind') -> join($join) -> page(intval(I('get.p')),$limit) ->where($map) -> select();
        $count                    = M('CouponBind') -> where($map) -> count();
        $pages                    = new \Think\Page($count,$limit);
        $time                     = time();

        $this -> assign('pages',$pages);
        $this -> assign('count',$count);
        $this -> assign('time',$time);
        $this -> assign('data',$data);
        $this -> assign('seo_data',$seo_data);
        $this -> display();
    }


    /* 领取优惠券 */
    public function getCoupon () {

        if (IS_AJAX) {
            $data                 = I('post.');
            $result               = D('CouponBind') -> getCoupon($this ->mid,$data);
            $this -> ajaxReturn($result);
        }
    }


    /* 消息提醒页面 */
    public function message () {

        $seo_data['title']        = '消息提醒';
        $seo_data['keywords']     = '衡水老白干官方商城';
        $seo_data['description']  = '衡水老白干官方商城';

        $this -> assign('seo_data',$seo_data);
        $this -> display();
    }

    /* 修改密码页面 */
    public function password () {

        $seo_data['title']        = '修改密码';
        $seo_data['keywords']     = '衡水老白干官方商城';
        $seo_data['description']  = '衡水老白干官方商城';

        $this -> assign('seo_data',$seo_data);
        $this -> display();
    }

    /* 修改密码操作 */
    public function passwordEditor () {

        if (IS_AJAX) {
            $data                 = I('post.');
            $data['account_id']   = $this ->mid;
            $data['uname']        = $_SESSION['lbg_account']['name'];

            $result               = D('Account') -> passwordEditor($this->mid,$data);
            if (empty($result)) {
                $this -> ajaxReturn($result);
            }
            $result['url']        = U('Account/index');
            $this -> ajaxReturn($result);
        }   
    }
    
    /* 我的收藏 */
    public function favorite () {

        $seo_data['title']        = '我的收藏';
        $seo_data['keywords']     = '衡水老白干官方商城';
        $seo_data['description']  = '衡水老白干官方商城';

        $limit                    = 3;
        $data                     = D('AccountFavorite') -> favoriteDetail($this ->mid,I('get.p'),$limit);
        $map['account_id']        = $this ->mid;
        $count                    = M('AccountFavorite') -> where($map) -> count();
        $pages                    = new \Think\Page($count,$limit);
        
        $this -> assign('pages',$pages);
        $this -> assign('data',$data);
        $this -> assign('seo_data',$seo_data);
        $this -> display();
    }

    /* 删除收藏 */
    public function favoriteDelete () {
		
        if (IS_AJAX) {
            $data                 = I('post.account_favorite_id',0,'intval');
            $result               = D('AccountFavorite') -> setDelete($this->mid,$data);
            $this -> ajaxReturn($result);
        }
    }


   //添加商品收藏
    public function favoriteAdd(){

        if(IS_AJAX){
            $item_id               = I('post.item_id',0,'intval');
            $result                = D('AccountFavorite') -> favoriteAdd($this ->mid,$item_id);
            $this -> ajaxReturn($result);
        }
        
    }

    

}
?>