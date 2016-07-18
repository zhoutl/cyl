<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function verify(){
		$config = array(
			'imageW'=>'150',
			'imageH'=>'40',
			'length'=>4,
			'fontSize'=>20,
		);
		$verify = new \Think\Verify($config);
		$verify->entry(I('get.id','','intval'));
	}
	
	//图片上传
	public function uploadify(){
		if (!empty($_FILES)) {
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$today = date('Ymd',time());
			$targetPath = './Public/upload/item/album/'.$today;
			create_dir($targetPath);
			$newFile = rename_file($_FILES['Filedata']['name']);
			$targetFile = $targetPath.'/'.$newFile;
			
			// Validate the file type
			$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
			$fileParts = pathinfo($_FILES['Filedata']['name']);
			
			if (in_array($fileParts['extension'],$fileTypes)) {
				move_uploaded_file($tempFile,$targetFile);
				
				//创建缩略图
				$img_lib = require_once("./Library/Image_lib/MY_Image_lib.php");
				$img_lib = new \MY_Image_lib();
				
				$big_path = './Public/upload/item/big/'.$today;
				$small_path = './Public/upload/item/small/'.$today;
				$icon_path = './Public/upload/item/icon/'.$today;
				create_dir($big_path);
				create_dir($small_path);
				create_dir($icon_path);
				
				$img_info = getimagesize($targetFile);
				
				$img_lib->createThumbImg(200,200,$img_info['0'],$img_info['1'],$big_path.'/',$targetFile);
				$img_lib->createThumbImg(100,100,$img_info['0'],$img_info['1'],$small_path.'/',$targetFile);
				$img_lib->createThumbImg(50,50,$img_info['0'],$img_info['1'],$icon_path.'/',$targetFile);
				
				$html='<div class="pro_box">
    	        <div class="pro_box_img"><img src="'.substr($targetFile,1).'"></div>
    	        <div class="pro_box_btn">
    	        <div class="f_r">
    	        <input type="hidden" name="item_image[]" value="'.substr($targetFile,1).'"/>
				<input type="hidden" name="first_img[]" value="0"/>
				<button type="button" class="btn btn-success btn-xs" onclick="set_first_img(this);"><i class="icon-ok-sign">设为封面</i></button>
    	        <button type="button" class="btn btn-danger btn-xs" onclick="remove_item_img(this);"><i class="icon-remove">删除</i></button>
    	        </div>
    	        </div>
    	        </div>';
				
				$result = array('status'=>1,'msg'=>'上传成功','html'=>$html);
			}else {
				$result = array('status'=>0,'msg'=>'文件格式错误');
			}
			
			$this->ajaxReturn($result);
		}
	}
	
		//图片上传
	public function uploadifyIcon(){
		if (!empty($_FILES)) {
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetPath = './Public/upload/icon';
			$newFile = rename_file($_FILES['Filedata']['name']);
			$targetFile = $targetPath.'/'.$newFile;
			
			// Validate the file type
			$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
			$fileParts = pathinfo($_FILES['Filedata']['name']);
			
			if (in_array($fileParts['extension'],$fileTypes)) {
				move_uploaded_file($tempFile,$targetFile);
				$result = array('status'=>1,'msg'=>'上传成功','file'=>substr($targetFile,1));
			}else {
				$result = array('status'=>0,'msg'=>'文件格式错误');
			}
			
			$this->ajaxReturn($result);
		}
	}
	
	
	//ajax获取商品信息
	public function getItemInfo(){
		$map = array('is_on_sale'=>1,'is_del'=>0);
		$item_name = I('post.item_name');
		if($item_name){
			$map['name'] = array('LIKE','%'.$item_name.'%');
		}
		$item_list = M('Item')->where($map)->select();
		$html = '';
		foreach($item_list as $v){
			$item_spec_price = M('Item_spec_price')->where("item_id='{$v['item_id']}' and item_spec_ids=0")->find();
			$html.="<div><input type='radio' name='item_id' value='{$v['item_id']}' />{$v['short_name']} WEB价：{$item_spec_price['online_price']} APP价：{$item_spec_price['app_price']}</div>";
		}
		
		$result = array('status'=>1,'msg'=>"搜索商品成功",'html'=>$html);
		$this->ajaxReturn($result);
	}

	 //删除图片
    public function delImg(){
        $filename=I('post.filename');
		$a = strstr($filename, '/Public/upload/refund/');
		$b = strstr($filename, '/Public/upload/itemComment/');
        //图片路径
        if(!empty($a) || !empty($b)){
            
            $filename='.'.$filename;
            unlink($filename);
        }
        
    }
	
	
}

?>