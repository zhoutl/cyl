<?php
namespace Home\Model;
use Think\Model;
/**
* 
*/
class AccountExtraModel extends Model{

    protected $_validate = array(
        array('nickname','1,10','请输入1-10位字符串',2,'length',2),
        array('real_name','is_letter','姓名格式错误',2,'function',2),
        array('birthday','strtotime','日期格式错误',2,'function',2),
        array('home_address','1,200','请输入1-200位字符串',2,'length',2),
        array('province_id','/^[0-9]+$/','请选择正确格式的省份',2,'regex',2),
        array('city_id','/^[0-9]+$/','请选择正确格式的城市',2,'regex',2),
        array('area_id','/^[0-9]+$/','请选择正确格式的区县',2,'regex',2),
        array('sex','/^[0-9]+$/','请选择正确格式的区县',2,'regex',2),
    );

    protected $_auto = array(
        array('add_time','time',1,'function'),
        array('mod_time','time',2,'function'),
    );

    //附表数据添加
    public function userExtraAdd ($var) {
        while (true) {
             $data['account_id'] = $var;
             $val = $this -> add($this->create($data));
             if (empty($val)) {
                 $result = array('status' => 1,'msg' => '信息添加失败');
                 break;
             }
             $result = array('status' =>1 ,'msg' => '','uid' =>$var);
             break;
        }
        return $result;
    }
    
    //附表信息修改
    public function userExtraSave ($account_id,$data) {

        while (true) {

            //去除地址空格
            $data['nickname']     = trim($data['nickname']);
            $data['home_address'] = trim($data['home_address']);
            
            $data['province_id']  = intval($data['province_id']);
            $data['city_id']      = intval($data['city_id']);
            $data['area_id']      = intval($data['area_id']);
            $data['sex']          = intval($data['sex']);

            if (!$this -> create($data,2)) {
                $result = array('status' => 0,'msg' => $this -> getError());
                break;
            }

            //对昵称和真实姓名修改
            $val = D('Account') -> userInfoSave($account_id,$data);
            if (empty($val['status'])) {
                $result = array('status' => 0,'msg' => $val['msg']);
                break;
            }
        	$data['birthday']      = strtotime($data['birthday']);

            //判断是否选择地址
            if (empty($data['province_id'])) {
                $data['province_id'] = 0;
                $data['city_id']     = 0;
                $data['area_id']     = 0;
            }
            
            if (empty($data['city_id'])) {
                $data['city_id']     = 0;
                $data['area_id']     = 0;
            }

            //获取省地址
            $map['area_id']       = $data['province_id'];
            $province             = M('Area') -> field('title') -> where($map) -> find();

            //获取市地址
            $map['area_id']       = $data['city_id'];
            $city                 = M('Area') -> field('title') -> where($map) -> find();

            //获得区域地址
            $map['area_id']       = $data['area_id'];
            $area                 = M('Area') -> field('title') -> where($map) -> find();

            //将所有地址组装成字符串
            $data['address']      = $province['title'].$city['title'].$area['title'].$data['home_address'];

            //置空where条件
            $map                  = array();
            $map['account_id']    = $account_id;
            $this -> where($map) ->save($data);
            $result = array('status' =>1,'msg' => '保存成功');
            break;
        }
        return $result;
    }




}




?>