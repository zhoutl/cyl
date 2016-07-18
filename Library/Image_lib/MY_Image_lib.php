<?php
require_once(dirname(__FILE__).'/Image_lib.php');


class aa{
	
}

	class MY_Image_lib extends Image_lib{
		var $lessen_width; //实际压缩图像大小
		var $lessen_height;
		var $dst_x; //补白
		var $dst_y;
		function __construct(){
			parent::__construct();
		}
		
	/**
	 * 创建缩略图
	 * @param  $width
	 * @param  $height
	 * @param $name
	 * @param  $src
	 */
	 function createThumbImg($thumb_w,$thumb_h,$orig_width,$orig_height,$new_src,$src){	
	 	$ratio = $orig_width/$orig_height; //原图比例
	 	if($orig_width/$thumb_w>$orig_height/$thumb_h){ //w做为基轴
	 		$this->lessen_width  = $thumb_w;
            $this->lessen_height  = $thumb_w / $ratio;
            $dim = 'width';
	 	}else{
	 		/* 原始图片比较高，则以高度为准 */
            $this->lessen_width  = $thumb_h * $ratio;
            $this->lessen_height = $thumb_h;
            $dim = 'height';
	 	}
	 	//设置补白区域
	 	$this->dst_x = ($thumb_w  - $this->lessen_width)  / 2;
        $this->dst_y = ($thumb_h - $this->lessen_height) / 2;
	 	
		$config['image_library'] = 'gd2';
		$config['source_image'] = $src;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$path_parts = pathinfo($src);
		$newsrc =$new_src.$path_parts['basename'];
		//$newsrc1 =substr($newsrc,0, strrpos($newsrc,'\/')); 
		$config['new_image'] = $newsrc;
		$config['width'] = $thumb_w;
		$config['height'] = $thumb_h;
		$config['thumb_marker']= NULL;	
		$config['quality'] =100;	
		$config['master_dim'] = $dim;
		$this->initialize($config); 
		$this->crop_image($orig_width,$orig_height,$thumb_w,$thumb_h);
		//$this->resize();
	}
	/**
	 * 重写图片压缩类
	 *
	 * @copyright  2011-2013  Digirun.cn
	 * @since      File available since Release 1.0 -- 2013-7-15 下午01:35:39
	 * @author liub
	 * 
	 */
	public function crop_image($orig_width,$orig_height,$thumb_w,$thumb_h){
		//  Reassign the source width/height if cropping
		$this->orig_width  = $orig_width;
		$this->orig_height = $orig_height;

		// GD 2.0 has a cropping bug so we'll test for it
		if ($this->gd_version() !== FALSE)
		{
			$gd_version = str_replace('0', '', $this->gd_version());
			$v2_override = ($gd_version == 2) ? TRUE : FALSE;
		}
		//  Create the image handle
		if ( ! ($src_img = $this->image_create_gd()))
		{
			return FALSE;
		}

		//  Create The Image
		//
		//  old conditional which users report cause problems with shared GD libs who report themselves as "2.0 or greater"
		//  it appears that this is no longer the issue that it was in 2004, so we've removed it, retaining it in the comment
		//  below should that ever prove inaccurate.
		//
		//  if ($this->image_library == 'gd2' AND function_exists('imagecreatetruecolor') AND $v2_override == FALSE)
		if ($this->image_library == 'gd2' AND function_exists('imagecreatetruecolor'))
		{
			$create	= 'imagecreatetruecolor';
			$copy	= 'imagecopyresampled';
		}
		else
		{
			$create	= 'imagecreate';
			$copy	= 'imagecopyresized';
		}

		$dst_img = $create($thumb_w, $thumb_h);
		if ($this->image_type == 3) // png we can actually preserve transparency
		{
			imagealphablending($dst_img, FALSE);
			imagesavealpha($dst_img, TRUE);
		}
		$bgcolor = "#FFFFFF";
		$bgcolor = trim($bgcolor,"#");//设置补白颜色
        sscanf($bgcolor, "%2x%2x%2x", $red, $green, $blue);
        $clr = imagecolorallocate($dst_img, $red, $green, $blue);
        imagefilledrectangle($dst_img, 0, 0, $thumb_w, $thumb_h, $clr);
		$copy($dst_img, $src_img, $this->dst_x,$this->dst_y, $this->x_axis, $this->y_axis, $this->lessen_width, $this->lessen_height, $this->orig_width, $this->orig_height);

		//  Show the image
		if ($this->dynamic_output == TRUE)
		{
			$this->image_display_gd($dst_img);
		}
		else
		{
			// Or save it
			if ( ! $this->image_save_gd($dst_img))
			{
				return FALSE;
			}
		}

		//  Kill the file handles
		imagedestroy($dst_img);
		imagedestroy($src_img);

		// Set the file to 777
		@chmod($this->full_dst_path, FILE_WRITE_MODE);

		return TRUE;
	}
	/**
	 * 等比压缩
	 *
	 * @copyright  2011-2013  Digirun.cn
	 * @since      File available since Release 1.0 -- 2013-9-9 下午05:17:05
	 * @author liub
	 * 
	 */
	 function createRatioImg($width,$height,$name,$src){	
		  $config['image_library'] = 'gd2';
		  $config['source_image'] = $src;
		  $config['create_thumb'] = TRUE;
		  $config['maintain_ratio'] = TRUE;
		  $newsrc =substr($src,0, strrpos($src,'\/')); 
		  $config['new_image'] = $newsrc;
		  $config['width'] = $width;
		  $config['height'] = $height;
		  $config['thumb_marker']= $name;		
		  $this->initialize($config); 
		  $this->resize();
		}
	}
	
?>