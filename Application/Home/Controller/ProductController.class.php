<?php
namespace Home\Controller;
use Think\Controller;
class ProductController extends Controller {


    // 分类搜索列表
    public function productsList(){
        //获取商品分类cid,获得相应的商品分类信息
        $cid=intval(I('get.cid'));
        $param=I('get.param');
        $order_param=I('get.order_param');
        $order_param=$order_param?$order_param:0;
        $cate_info=D('ItemCategory')->find($cid);
        $data['brand_info']= D('Brand')->select();
        //某个分类的属性
        $attribute_where['item_category_id']=$cate_info['item_category_id'];
        $attribute_where['is_filter']=1;
        $cate_attribute=D('ItemCategoryAttribute')->where($attribute_where)->order('orderno asc')->select();
        foreach ($cate_attribute as $key => $value) {
        	//某个分类的属性的值
        	$attribute_value_where['item_category_attribute_id']=$value['item_category_attribute_id'];
        	$cate_attribute[$key]['value']=D('ItemCategoryAttributeValue')->where($attribute_value_where)->select();
        }

        //属性标签个数。默认第一个是用途，第二个是价格,第二个是品牌
        $total=count($cate_attribute)+3;
        $param = explode('-',$param);
		for($i=0;$i<$total;$i++){
			if(!empty($param[$i])){
                if($i==1){
                	$param[$i]=$param[$i];
                }else{
					$param[$i]=intval($param[$i]);
                }			
			}else{
				$param[$i]=0;
			}
		}
		$condition='1=1 and t3.item_spec_ids=0 and t1.is_on_sale=1 and  t1.is_del=0';
		if($cid){
			$condition.=" and t1.item_category_id=$cid ";
		}
         
		//用途标签信息
		$data['purpose_list']=D('ItemPurpose')->select();
        
		//价格标签信息
		$price_search = array(
			'1'=>'1-99',
			'2'=>'100-299',
			'3'=>'300-599',
			'4'=>'600-999',
			'5'=>'1000-1999',
			'6'=>'2000以上',
		);

       //用途检索
       if($param[0]){
       		$condition.=" and t1.item_purpose_id=".intval($param[0]);
       		//用途快捷标签
       		foreach($data['purpose_list'] as $k=>$v){
				if($v['item_purpose_id'] == $param[0]){
                   $res=$this->quick_tag($total,$param,$order_param,$cid,0);
                   $quick_tag_html.='<a href="'.$res.'" class="yxzbtn mr17">场合：'.$v['purpose_name'].'<em></em></a>';
					break;
				}
			}
       }

       //价格检索
       if($param[1]){
       		switch($param[1]){
						case '1':
							$condition.=' and t3.online_price>=1 and t3.online_price<=99';
							$quick_tag_name = $this->price_search[$param[1]];
							break;
						case '2':
							$condition.=' and t3.online_price>=100 and t3.online_price<=299';
							$quick_tag_name = $this->price_search[$param[1]];
							break;
						case '3':
							$condition.=' and t3.online_price>=300 and t3.online_price<=599';
							$quick_tag_name = $this->price_search[$param[1]];
							break;
						case '4':
							$condition.=' and t3.online_price>=600 and t3.online_price<=999';
							$quick_tag_name = $this->price_search[$param[1]];
							break;
						case '5':
							$condition.=' and t3.online_price>=1000 and t3.online_price<=1999';
							$quick_tag_name = $this->price_search[$param[1]];
							break;
						case '6':
							$condition.=' and t3.online_price>=2000';
							$quick_tag_name = $this->price_search[$param[1]];
							break;	
						default:
							$tmp_pr = explode('_',$param[1]);
							if(is_array($tmp_pr) && count($tmp_pr)==2){
								$condition.=' and t3.online_price>='.intval($tmp_pr[0]).' and t3.online_price<='.intval($tmp_pr[1]);
								$quick_tag_name = $tmp_pr[0].'-'.$tmp_pr[1];
							}
			   }
       		//价格快捷标签
       		    $tmp_pr = explode('_',$param[1]);
       		    if(is_array($tmp_pr) && count($tmp_pr)==2){
					$quick_tag_name=$tmp_pr[0].'-'.$tmp_pr[1];
				}else{
					$quick_tag_name=$price_search[$param[1]];
				}
                $res=$this->quick_tag($total,$param,$order_param,$cid,1);
                $quick_tag_html.='<a href="'.$res.'" class="yxzbtn mr17">价格：'.$quick_tag_name.'<em></em></a>';
       }
       //品牌检索
       if($param[2]){
       		$condition.=" and t1.brand_id=".intval($param[2]);
       		//用途快捷标签
       		foreach($data['brand_info'] as $k=>$v){
				if($v['brand_id'] == $param[2]){
                   $res=$this->quick_tag($total,$param,$order_param,$cid,0);
                   $quick_tag_html.='<a href="'.$res.'" class="yxzbtn mr17">品牌：'.$v['brand_name'].'<em></em></a>';
					break;
				}
			}
       }

       //多属性检索
       if(count($param)>3){
       	  $c_flag=array();
       	  //属性快捷标签
          foreach ($cate_attribute as $key => $value) {
          	 $tag=$key+3;
          	 if($param[$tag]){
				$c_flag[] = intval($value['item_category_attribute_id']);
				$c_v_flag[$key] = intval($param[$tag]);
          	 	$res=$this->quick_tag($total,$param,$order_param,$cid,$tag);
	            $cate_attribute_one=D('ItemCategoryAttributeValue')->where(array('item_category_attribute_value_id' => $param[$tag], ))->find();
	            $quick_tag_html.='<a href="'.$res.'" class="yxzbtn mr17">'.$value['attribute_name'].'：'.$cate_attribute_one['attribute_value'].'<em></em></a>';
          	 }
          }
          if(!empty($c_flag)){
          	$condition.=" and t2.item_category_attribute_value_id in (".implode(',',$c_v_flag).") ";
			$condition.=' and t2.item_category_attribute_id in ('.implode(',',$c_flag).')';
			$having=' having count(t1.item_id)= '.count($c_v_flag);
          }
       }
       
       // sql语句拼装
       $sql="select count(t1.item_id), t1.item_id,t1.name,t1.short_name,t1.seo_description,t3.online_price,t3.shop_price,t3.app_price,t4.img_uri  from ((md_item t1 left join md_item_extra t2 on t1.item_id=t2.item_id )inner join md_item_spec_price t3 on  t1.item_id=t3.item_id ) left join md_item_image t4 on t1.item_id =t4.item_id  and t4.is_default=1  where ".$condition ." group by t1.item_id ".$having;
      // print_r($sql);
      //生成排序
		switch($order_param){
			//最新降序 
			case '1':
				$order = 't1.pubdate DESC';
				break;
			//最新升序
			case '2':
				$order = 't1.pubdate ASC';
				break;
			//销量降序
			case '3':
				$order = 't3.sales_volume DESC';
				break;
			//销量升序
			case '4':
				$order = 't3.sales_volume ASC';
				break;
			//价格升序
			case '5':
				$order = 't3.online_price ASC';
				break;
			//价格降序
			case '6':
				$order = 't3.online_price DESC';
				break;
			default:
				$order = 't1.pubdate DESC';
		}
		$sql.=" order by ".$order;
		
        $itemsa=M('')->query($sql); 
        $count=count($itemsa);
 		//分页
        $Page       = new \Think\Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $sql.=" limit ".$Page->firstRow.",".$Page->listRows ;
        $items=M('')->query($sql); 

        $this->assign('cid',$cid);
        $this->assign('total',$total);
        $this->assign('param',$param);
        $this->assign('order_param',$order_param);
        $this->assign('data',$data);
        $this->assign('price_search',$price_search);
        $this->assign('cate_attribute',$cate_attribute);
        $this->assign('cate_info',$cate_info);
        $this->assign('quick_tag_html',$quick_tag_html);
        $this->assign('items',$items);
        $seo_data['page']=$Page;
        $seo_data['title'] = $cate_info['seo_title'];
        $seo_data['keywords'] = $cate_info['seo_keywords'];
        $seo_data['description'] = $cate_info['seo_description'];
        $this->assign('seo_data',$seo_data);
		$this->display();
	}



	public function quick_tag($total,$param,$order_param,$cid,$tag){
		$str = '';
		$url = '';
		for($i=0;$i<$total;$i++){
			if($i==$tag){
				$str.='0-';
			}else{
				$str.=$param[$i].'-';
			}

		}
		$str = substr($str,0,-1);
		$url=U('Product/productsList/param/'.$str.'/order_param/'.$order_param.'?cid='.$cid.'#p');
		return $url;
	}

	public function quick_tag_purpose($total,$param,$order_param,$cid,$tag){
		$str = '';
		$url = '';
		for($i=0;$i<$total;$i++){
			if($i==$tag){
				$str.='0-';
			}else{
				$str.=$param[$i].'-';
			}

		}
		$str = substr($str,0,-1);
		$url=U('Product/purposeList/param/'.$str.'/order_param/'.$order_param.'#p');
		return $url;
	}

    // 用途搜索列表
	public function  purposeList(){

        $param=I('get.param');
        $order_param=I('get.order_param');
        $order_param=$order_param?$order_param:0;


        //属性标签个数。默认第一个是用途，第二个是价格，第三个是品牌
        $total=3;
        $param = explode('-',$param);
		for($i=0;$i<$total;$i++){
			if(!empty($param[$i])){
                if($i==1){
                	$param[$i]=$param[$i];
                }else{
					$param[$i]=intval($param[$i]);
                }			
			}else{
				$param[$i]=0;
			}
		}
		$condition='1=1 and t3.item_spec_ids=0 and t1.is_on_sale=1 and t1.is_del=0';
         
		//用途标签信息
		$data['purpose_list']=D('ItemPurpose')->select();
        $data['brand_info']=D('Brand')->select();
		//价格标签信息
		$price_search = array(
			'1'=>'1-99',
			'2'=>'100-299',
			'3'=>'300-599',
			'4'=>'600-999',
			'5'=>'1000-1999',
			'6'=>'2000以上',
		);

       //用途检索
       if($param[0]){
            //用途信息
            $purpose_info=D('ItemPurpose')->find(intval($param[0]));
       		$condition.=" and t1.item_purpose_id=".intval($param[0]);
       		//用途快捷标签
       		foreach($data['purpose_list'] as $k=>$v){
				if($v['item_purpose_id'] == $param[0]){
                   $res=$this->quick_tag_purpose($total,$param,$order_param,$cid,0);
                   $quick_tag_html.='<a href="'.$res.'" class="yxzbtn mr17">场合：'.$v['purpose_name'].'<em></em></a>';
					break;
				}
			}
       }

       //价格检索
       if($param[1]){
       		switch($param[1]){
						case '1':
							$condition.=' and t3.online_price>=1 and t3.online_price<=99';
							$quick_tag_name = $this->price_search[$param[1]];
							break;
						case '2':
							$condition.=' and t3.online_price>=100 and t3.online_price<=299';
							$quick_tag_name = $this->price_search[$param[1]];
							break;
						case '3':
							$condition.=' and t3.online_price>=300 and t3.online_price<=599';
							$quick_tag_name = $this->price_search[$param[1]];
							break;
						case '4':
							$condition.=' and t3.online_price>=600 and t3.online_price<=999';
							$quick_tag_name = $this->price_search[$param[1]];
							break;
						case '5':
							$condition.=' and t3.online_price>=1000 and t3.online_price<=1999';
							$quick_tag_name = $this->price_search[$param[1]];
							break;
						case '6':
							$condition.=' and t3.online_price>=2000';
							$quick_tag_name = $this->price_search[$param[1]];
							break;	
						default:
							$tmp_pr = explode('_',$param[1]);
							if(is_array($tmp_pr) && count($tmp_pr)==2){
								$condition.=' and t3.online_price>='.intval($tmp_pr[0]).' and t3.online_price<='.intval($tmp_pr[1]);
								$quick_tag_name = $tmp_pr[0].'-'.$tmp_pr[1];
							}
			   }
       		//价格快捷标签
       		    $tmp_pr = explode('_',$param[1]);
       		    if(is_array($tmp_pr) && count($tmp_pr)==2){
					$quick_tag_name=$tmp_pr[0].'-'.$tmp_pr[1];
				}else{
					$quick_tag_name=$price_search[$param[1]];
				}
                $res=$this->quick_tag_purpose($total,$param,$order_param,$cid,1);
                $quick_tag_html.='<a href="'.$res.'" class="yxzbtn mr17">价格：'.$quick_tag_name.'<em></em></a>';
       }
      
      //品牌检索
       if($param[2]){
           
       		$condition.=" and t1.brand_id=".intval($param[2]);
       		//用途快捷标签
       		foreach($data['brand_info'] as $k=>$v){
				if($v['brand_id'] == $param[2]){
                   $res=$this->quick_tag_purpose($total,$param,$order_param,$cid,0);
                   $quick_tag_html.='<a href="'.$res.'" class="yxzbtn mr17">场合：'.$v['brand_name'].'<em></em></a>';
					break;
				}
			}
       }

       // sql语句拼装
       $sql="select  t1.item_id,t1.name,t1.short_name,t1.seo_description,t3.online_price,t3.shop_price,t3.app_price,t4.img_uri  from (md_item t1 inner join  md_item_spec_price t3 on  t1.item_id=t3.item_id ) left join md_item_image t4 on t1.item_id =t4.item_id  and t4.is_default=1  where ".$condition ." group by t1.item_id ";
      // print_r($sql);
      //生成排序
		switch($order_param){
			//最新降序 
			case '1':
				$order = 't1.pubdate DESC';
				break;
			//最新升序
			case '2':
				$order = 't1.pubdate ASC';
				break;
			//销量降序
			case '3':
				$order = 't3.sales_volume DESC';
				break;
			//销量升序
			case '4':
				$order = 't3.sales_volume ASC';
				break;
			//价格升序
			case '5':
				$order = 't3.online_price ASC';
				break;
			//价格降序
			case '6':
				$order = 't3.online_price DESC';
				break;
			default:
				$order = 't1.pubdate DESC';
		}
		$sql.=" order by ".$order;
        $itemsa=M('')->query($sql); 
        $count=count($itemsa);
 		//分页
        $Page       = new \Think\Page($count,20);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $sql.=" limit ".$Page->firstRow.",".$Page->listRows ;
        $items=M('')->query($sql); 

        $this->assign('cid',$cid);
        $this->assign('total',$total);
        $this->assign('param',$param);
        $this->assign('order_param',$order_param);
        $this->assign('data',$data);
        $this->assign('price_search',$price_search);
        $this->assign('cate_attribute',$cate_attribute);
        $this->assign('purpose_info',$purpose_info);
        $this->assign('quick_tag_html',$quick_tag_html);
        $this->assign('items',$items);
        $seo_data['page']=$Page;
        $seo_data['title'] = $purpose_info['purpose_name'];
        $seo_data['keywords'] = '衡水老白干官方商城';
        $seo_data['description'] = '衡水老白干官方商城';
        $this->assign('seo_data',$seo_data);
		$this->display();
	}


	//商品详情
	public function productDetail(){
		$item_id=intval(I('item_id',0,'intval'));
	    $Model=D('Item');
	    //商品基本信息
	    $item =$Model->productDetail($item_id);
		
		//获取促销信息
		$now = time();
		$map['item_id'] = $item_id;
		$map['start_time'] = array('elt',$now);
		$map['end_time'] = array('egt',$now);
		$data['item_sale_info'] = M('Item_sale')->field('sale_price,start_time,end_time')->where($map)->order('start_time ASC')->find();
		//如果存在商品促销
		if(!empty($data['item_sale_info'])){
			$item['online_price'] = $item['app_price'] = $data['item_sale_info']['sale_price'];
			$item['has_sale'] = 1;
		}else{
			$item['has_sale'] = 0;
		}
		
	    //商品评论
	    $count=M('Item_comment')->where(array('item_id'=>$item_id,'is_show'=>1,'parent_id'=>0))->count();
	    $data['totle_num']=$count;
        $item_comment=  M('Item_comment') ->where(array('item_id'=>$item_id,'is_show'=>1,'parent_id'=>0))-> select();
        $data['bad_num']=$data['mid_num']=$data['good_num']=$data['img_num']=0;
        foreach ($item_comment as $key => $value) {
        	//评价图片
        	$comment_image=0;
        	$comment_image= M('Item_comment_image') ->where(array('item_comment_id'=>$value['item_comment_id']))-> count();
        	if($comment_image!=0){
               $data['img_num']+=1;
        	}
        	//评分等级
        	if($value['score']==1 || $value['score']==2){
 				$data['bad_num']+=1;
        	}else if($value['score']==3 || $value['score']==4){
                $data['mid_num']+=1;
        	}else{
                $data['good_num']+=1;
        	}
        }
	    //优惠券
	    $data['coupon']=M('Coupon')->where('status=1 and is_pc=1 and start_time <= '.time().' and end_time >= '.time().' and is_item_show=1')->select();

		$seo_data['title'] = $item['item_info']['seo_title'];
        $seo_data['keywords'] = $item['item_info']['seo_keywords'];
        $seo_data['description'] = $item['item_info']['seo_description'];
        $this->assign('seo_data',$seo_data);
	    if(empty($item['item_info'])){
	       $this->assign('msg','不存在此商品或已下架');
           $this->display('Common/miss');
	    }else{
           $this->assign('item',$item);
           $this->assign('data',$data);
           $this->display();
	    }
	}

    //获取wap商品详情二维码
    public function get_code(){
		 vendor('code.phpqrcode');
		$item_id=I('get.item_id',0,'intval');
		$url = U('Wap/Product/productDetail',array('item_id',$item_id));
		$sc= urldecode($url);
		$img =new  \QRcode();
		$img_uri=$img->png($sc);	
		return $img_uri;
	}
    
    //评论AJAX分页
    public function commentPage(){
    	if(IS_AJAX){
            $map=array();
            $item_id=I('get.item_id',0,'intval');
            $data=I('get.');
            $result=D('ItemComment')->ajax_page($item_id,$data); 
            $this->ajaxReturn($result);
    	}
    }

	

}