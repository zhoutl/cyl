<?php 
namespace Admin\Model;
use Think\Model;
class BannerModel extends Model {
	
	protected $_validate = array(
		array('name','1,20','banner名称为1-20个字',1,'length'), 
		array('type',array(1,2,3),'请输入正确的所属版本',1,'in'),
		array('link_url','url','请输入正确格式的URL地址',2),
		array('orderno','is_numeric','排序必须为数字',1,'function'),
		array('is_show',array(0,1),'请选择是否显示',1,'in'),
	);
	
	//新增banner
    public function addBanner($data){
		while(true){
			if(!$this->create($data)){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			
			if(!file_exists('.'.$data['img_uri']) || empty($data['img_uri'])){
				$result = array('status'=>0,'msg'=>'请上传BANNER图片');
				break;
			}
			
			$this->add($data);
			$result = array('status'=>1,'msg'=>'新增成功');
			break;
		}
		
		return $result;
	}
	
	//修改banner
	public function editBanner($banner_id,$data){

		while(true){
			if(!$this->create($data,2)){
				$result = array('status'=>0,'msg'=>$this->getError());
				break;
			}
			
			if(!file_exists('.'.$data['img_uri']) || empty($data['img_uri'])){
				$result = array('status'=>0,'msg'=>'请上传BANNER图片');
				break;
			}
			$map['banner_id'] = intval($banner_id);
			$this->where($map)->save($data);
			$result = array('status'=>1,'msg'=>'修改成功');
			break;
		}
		
		return $result;
	}
	
	//删除Banner
	public function delBanner($banner_id){
		$map['banner_id'] = intval($banner_id);
		$this->where($map)->delete();
		$result = array('status'=>1,'msg'=>'删除成功');
		return $result;
	}
	
	
}


?>