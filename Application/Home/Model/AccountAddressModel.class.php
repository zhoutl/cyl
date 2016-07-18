<?php
namespace Home\Model;
use Think\Model;
/**
* 
*/
class AccountAddressModel extends Model{
    
    //数据自动验证
    protected $_validate = array(
        array('name','1,10','收货人姓名为1-10个字',1,'length',3),
        array('phone','is_phone','电话号码格式错误',1,'function',3),
        array('detail_address','1,50','详细地址1到50位字符',1,'length',3),
        array('province_id','/^[1-9][0-9]{0,}$/','请选择正确格式的省份',1,'regex',3),
        array('city_id','/^[1-9][0-9]{0,}$/','请选择正确格式的城市',1,'regex',3),
        array('area_id','/^[1-9][0-9]{0,}$/','请选择正确格式的区县',1,'regex',3),
    );

    protected $_auto = array(
        array('pubdate_time','time',1,'function'),
    );

    //增加收货地址
    public function addressAdd ($account_id,$data) {

        while (true) {
            if (!$this -> create($data)) {
                $result               = array('status' => 0,'msg' => $this -> getError());
                break;
            }

            //判断该用户是否已经有10个地址了
            $map['account_id']        = $account_id;
            $count                    = $this -> where($map) -> count();
            if ($count >= 10) {
                $result = array('status' => 0,'msg' => '收货地址已经达到10条');
                break;
            }

            //判断是否设置默认地址
            if (!empty($data['is_default'])) {
                //查询是否已经设置了默认地址
                $map['is_default']    = $data['is_default'];
                $map['account_id']    = $account_id;
                $arr                  = $this -> field('account_address_id') ->where($map) -> find(); 
                if (!empty($arr)) {
                    //置空查询条件
                    $map              = array();
                    $map['account_address_id'] = $arr['account_address_id'];
                    $val              = $this -> where($map) -> setField('is_default',0);
                    if (empty($val)) {
                        $result       = array('status' => 0,'msg' => '设置默认失败');
                        break;
                    } 
                }   
            }

            //如果没有设置收货地址则第一条地址
            if ($count == 0) {
                $data['is_default']   = 1;
            }


            //置空查询条件
            $map                      = array();
            //获取省地址
            $map['area_id']           = $data['province_id'];
            $province                 = M('Area') -> field('title') -> where($map) -> find();

            //获取市地址
            $map['area_id']           = $data['city_id'];
            $city                     = M('Area') -> field('title') -> where($map) -> find();

            //获得区域地址
            $map['area_id']           = $data['area_id'];
            $area                     = M('Area') -> field('title') -> where($map) -> find();

            //将所有地址组装成字符串
            $data['address']          = $province['title'].$city['title'].$area['title'].$data['detail_address'];
            
            $data['account_id']       = $account_id;

            $val = $this -> add($this -> create($data));
            if (empty($val)) {
                $result               = array('status' => 0,'msg' => '添加失败');
                break;
            }
            $result                   = array('status' => 1,'msg' => '添加成功');
            break;
        }
        return $result;
    }
    
    //修改默认地址
    public function setDefault ($account_id,$data) {

        while (true) {

           //判断收货地址是否存在
           $map['account_id']         = $account_id;
           $map['account_address_id'] = $data['account_address_id'];
           $count                     = $this -> where($map) -> count();
           if (empty($count)) {
               $result                = array('status' => 0,'msg' => '该收货地址不存在');
               break;
           }

           //将原先默认地址改为非默认地址
           $map                       = array();
           $map['account_id']         = $account_id;
           $this -> where($map) -> setField('is_default',0);

           //将设置新的默认地址
           $map['account_address_id'] = $data['account_address_id'];
           $val                       = $this -> where($map) -> setField('is_default',1);
           if (empty($val)) {
               $result                = array('status' => 0,'msg' => '设置默认地址失败');
               break;
           }
           $result                    = array('status' => 1, 'msg' => '设置默认地址成功');
           break;
        }
        return $result;
    }
    
    //删除地址
    public function setDelete ($account_id,$data) {

        while (true) {
            $map['account_id']         = $account_id;
            $map['account_address_id'] = $data['account_address_id'];
            $val                       = $this -> where($map) -> delete();
            if (empty($val)) {
                $result = array('status' => 0,'msg' => '删除失败');
                break;
            }
            $result                    = array('status' => 1,'msg' => '删除成功');
            break;
        }
        return $result;
    }

    /* 修改地址 */
    public function setEditor ($account_id,$data) {
        while (true) {
             
             $map['account_id']         = $account_id;
             $map['account_address_id'] = $data['account_address_id'];
             $count                     = $this -> where($map) -> count();

             if (empty($count)) {
                 $result = array('status' => 0,'msg' =>'该收货地址不存在');
                 break;
             }

            if (!$this -> create($data)) {
                $result  = array('status' => 0,'msg' => $this -> getError());
                break;
            }
            
            //判断是否选择默认，然后修改其他信息
            if (!empty($data['is_default'])) {
                $this -> setDefault($account_id,$data);
            }
            
            //获取省地址
            $map['area_id']            = $data['province_id'];
            $province                  = M('Area') -> field('title') -> where($map) -> find();

            //获取市地址
            $map['area_id']            = $data['city_id'];
            $city                      = M('Area') -> field('title') -> where($map) -> find();

            //获得区域地址
            $map['area_id']            = $data['area_id'];
            $area                      = M('Area') -> field('title') -> where($map) -> find();

            //将所有地址组装成字符串
            $data['address']           = $province['title'].$city['title'].$area['title'].$data['detail_address'];
            
            //置空查询条件
            $map                       = array();
            //没有选择默认是直接修改其他信息
            $map['account_id']         = $account_id;
            $map['account_address_id'] = $data['account_address_id'];
            
            $this -> where($map) -> save($data);
            $result                    = array('status' => 1,'msg' => '保存成功');
            break;
        }
        return $result;
    }
	
	
	//AJAX获取新增地址form
	public function getAddAddressForm(){
		$province_list = M('Area') -> where("pid=0") -> select();
		
		$html='';
		$html.='<div class="data-box mt30 xgmm2">';
		$html.='<div class="width c666 font-16 mb25">新增收货地址</div>';
		$html.='<form method="post" class="addForm">';
		$html.='<div class="demoformbox demoformbox4">';
		$html.='<label class="f_l c666 mr10"><em class="red">* </em>收货人姓名：</label>';
		$html.='<input type="text" class="form-control data-kk4" name="name" placeholder="请输入收货人姓名" datatype="*2-12" errormsg="收货人姓名为2-12个字" nullmsg="请输入收货人姓名">';
		$html.='<span class="Validform_checktip"></span>';
		$html.='</div>';
		$html.='<div class="demoformbox demoformbox4">';
		$html.='<label class="f_l c666 mr10 sjkd"><em class="red">* </em>收货人手机号码：</label>';
		$html.='<input type="text" class="form-control data-kk4" name="phone" placeholder="请输入手机号" datatype="m" errormsg="请输入正确格式的手机号" nullmsg="请输入手机号">';
		$html.='<span class="Validform_checktip"></span>';
		$html.='</div>';
		$html.='<div class="demoformbox adrheight">';
		$html.='<label class="f_l c666 mr10"><em class="red">* </em>收货人地址：</label>';
		$html.='<select name="province_id" class="form-control data-kk1 data-kk2 f_l" datatype="/^[1-9][0-9]{0,}$/" nullmsg="请选择省份" errormsg="请选择省份" onchange="choose_city();" id="province" >';
		$html.='<option value="">请选择省份</option>';
		foreach($province_list as $v){
			$html.='<option value="'.$v['area_id'].'">'.$v['title'].'</option>';
		}
		$html.='</select><span class="f_l line30 mr10 ml5"> 省</span>';
		$html.='<select name="city_id" class="form-control data-kk1 data-kk2 f_l" datatype="/^[1-9][0-9]{0,}$/" nullmsg="请选择城市" errormsg="请选择城市" onchange="choose_area();" id="city" >';
		$html.='<option value="">请选择城市</option>';	
		$html.='</select><span class="f_l line30 mr10 ml5"> 市</span>';
		$html.='<select name="area_id" class="form-control data-kk1 data-kk2 f_l" datatype="/^[1-9][0-9]{0,}$/" nullmsg="请选择区域" errormsg="请选择区域" id="area" >';
		$html.='<option value="">请选择区域</option>';	
		$html.='</select><span class="f_l line30 mr10 ml5"> 区</span>';
		$html.='<span class="Validform_checktip"></span>';
		$html.='</div>';
		$html.='<div class="demoformbox">';
		$html.='<label class="f_l c666 mr10"><em class="red">* </em>详细地址：</label>';
		$html.='<input type="text" name="detail_address" class="form-control data-kk4 data-kk5" placeholder="请输入详细地址" datatype="*1-50" errormsg="详细地址为1-50个字" nullmsg="请输入详细地址">';
		$html.='<span class="Validform_checktip"></span>';
		$html.='</div>';	
		$html.='<div class="demoformbox demoformbox3">';
		$html.='<input type="button" id="addForm" class="btn btn-blue save f_r mr17" value="保存" />';
		$html.='<div class="f_r mt8">';
		$html.='<span class="f_r c666 font-12 mr17 ml5">设为默认</span>';
		$html.='<input type="checkbox" name="is_default" value="1" class="f_r">';
		$html.='</div>';
		$html.='</div>';				
		$html.='</form>';
		$html.='</div>';
		$html.='<script type="text/javascript" src="/Public/Home/js/order.js"></script>';
		
		
		$result = array('status'=>1,'msg'=>'','html'=>$html);
		return $result;
	}
	
	
	//AJAX获取新增地址form
	public function getEditAddressForm($account_id,$account_address_id){
		$map = array('account_id'=>$account_id,'account_address_id'=>$account_address_id);
		$list = $this->where($map)->find();
		if(empty($list)){
			$result = array('status'=>0,'msg'=>'地址不存在或已被删除');
		}else{
			$province_list = M('Area') -> where("pid=0") -> select();
			$city_list = M('Area')->where("pid=".$list['province_id'])->select();
			$area_list = M('Area')->where("pid=".$list['city_id'])->select();
			
			$html='';
			$html.='<div class="data-box mt30 xgmm2">';
			$html.='<div class="width c666 font-16 mb25">修改收货地址</div>';
			$html.='<form method="post" class="editForm">';
			$html.='<div class="demoformbox demoformbox4">';
			$html.='<label class="f_l c666 mr10"><em class="red">* </em>收货人姓名：</label>';
			$html.='<input type="text" class="form-control data-kk4" name="name" value="'.$list['name'].'" placeholder="请输入收货人姓名" datatype="*2-12" errormsg="收货人姓名为2-12个字" nullmsg="请输入收货人姓名">';
			$html.='<span class="Validform_checktip"></span>';
			$html.='</div>';
			$html.='<div class="demoformbox demoformbox4">';
			$html.='<label class="f_l c666 mr10 sjkd"><em class="red">* </em>收货人手机号码：</label>';
			$html.='<input type="text" class="form-control data-kk4" name="phone" value="'.$list['phone'].'" placeholder="请输入手机号" datatype="m" errormsg="请输入正确格式的手机号" nullmsg="请输入手机号">';
			$html.='<span class="Validform_checktip"></span>';
			$html.='</div>';
			$html.='<div class="demoformbox adrheight">';
			$html.='<label class="f_l c666 mr10"><em class="red">* </em>收货人地址：</label>';
			$html.='<select name="province_id" class="form-control data-kk1 data-kk2 f_l" datatype="/^[1-9][0-9]{0,}$/" nullmsg="请选择省份" errormsg="请选择省份" onchange="choose_city();" id="province" >';
			$html.='<option value="">请选择省份</option>';
			foreach($province_list as $v){
				$select = '';
				if($v['area_id'] == $list['province_id']) $select = 'selected';
				$html.='<option value="'.$v['area_id'].'" '.$select.'>'.$v['title'].'</option>';
			}
			$html.='</select><span class="f_l line30 mr10 ml5"> 省</span>';
			$html.='<select name="city_id" class="form-control data-kk1 data-kk2 f_l" datatype="/^[1-9][0-9]{0,}$/" nullmsg="请选择城市" errormsg="请选择城市" onchange="choose_area();" id="city" >';
			$html.='<option value="">请选择城市</option>';	
			foreach($city_list as $v){
				$select = '';
				if($v['area_id'] == $list['city_id']) $select = 'selected';
				$html.='<option value="'.$v['area_id'].'" '.$select.'>'.$v['title'].'</option>';
			}
			$html.='</select><span class="f_l line30 mr10 ml5"> 市</span>';
			$html.='<select name="area_id" class="form-control data-kk1 data-kk2 f_l" datatype="/^[1-9][0-9]{0,}$/" nullmsg="请选择区域" errormsg="请选择区域" id="area" >';
			$html.='<option value="">请选择区域</option>';
			foreach($area_list as $v){
				$select = '';
				if($v['area_id'] == $list['area_id']) $select = 'selected';
				$html.='<option value="'.$v['area_id'].'" '.$select.'>'.$v['title'].'</option>';
			}			
			$html.='</select><span class="f_l line30 mr10 ml5"> 区</span>';
			$html.='<span class="Validform_checktip"></span>';
			$html.='</div>';
			$html.='<div class="demoformbox">';
			$html.='<label class="f_l c666 mr10"><em class="red">* </em>详细地址：</label>';
			$html.='<input type="text" name="detail_address" value="'.$list['detail_address'].'" class="form-control data-kk4 data-kk5" placeholder="请输入详细地址" datatype="*1-50" errormsg="详细地址为1-50个字" nullmsg="请输入详细地址">';
			$html.='<span class="Validform_checktip"></span>';
			$html.='</div>';	
			$html.='<div class="demoformbox demoformbox3">';
			$html.='<input type="hidden" name="account_address_id" value="'.$list['account_address_id'].'" />';
			$html.='<input type="button" id="editForm" class="btn btn-blue save f_r mr17" value="保存" />';
			$html.='<div class="f_r mt8">';
			$html.='<span class="f_r c666 font-12 mr17 ml5">设为默认</span>';
			if($list['is_default'] == '1'){
				$check = 'checked';
			}else{
				$check = '';
			}
			$html.='<input type="checkbox" name="is_default" value="1" '.$check.' class="f_r">';
			$html.='</div>';
			$html.='</div>';				
			$html.='</form>';
			$html.='</div>';
			$html.='<script type="text/javascript" src="/Public/Home/js/order.js"></script>';
			
			
			$result = array('status'=>1,'msg'=>'','html'=>$html);
		}

		return $result;
	}
	
}



?>