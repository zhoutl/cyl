<?php 
namespace Home\Widget;
use Think\Controller;
class HomeWidget extends Controller {
	
	//公共头部
    public function head($data = array()){
		// $system_config = M('System_config')->where("system_config_id=1")->find();
		
		// $data['title'] = $data['title']?$data['title']:$system_config['title'];
		// $data['keywords'] = $data['keywords']?$data['keywords']:$system_config['keywords'];
		// $data['description'] = $data['description']?$data['description']:$system_config['description'];
		// //所有分类信息
		// $data['item_category']=D('ItemCategory')->where('is_show=1')->order('orderno asc')->select();
		
		// //登录信息
		// $data['account'] = session('lbg_account');
		// $account_id = $data['account']?$data['account']['uid']:0;
		// $data['cart_num'] = intval(M('Shopping_cart')->where("account_id=".$account_id)->count());
		$this->assign('data',$data);
        $this->display('Common/head');
    }
	
	//公共尾部
	public function foot($data = array()){
		$this->assign('data',$data);
        $this->display('Common/foot');
	}

	public function menu (){
	    $this -> display('Common/menu');
	}
	
}

?>