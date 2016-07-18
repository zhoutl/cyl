<?php
namespace Home\Controller;
use    Think\Controller;

class SearchsController extends Controller{

	public function search(){
		//获取关键字
		$keyword=I('get.keyword');
		$price=I('get.price',0);
		$order_param=I('get.order_param',0);
        $order_param=$order_param?$order_param:0;
		//价格标签信息
		$price_search = array(
			'1'=>'1-99',
			'2'=>'100-299',
			'3'=>'300-599',
			'4'=>'600-999',
			'5'=>'1000-1999',
			'6'=>'2000以上',
		);

		$condition='1=1 and t3.item_spec_ids=0 and t1.is_on_sale=1 and  t1.is_del=0';
		//关键字检索
		if(!empty($keyword)){
			$condition.=" and t1.name like '%" .$keyword."%'";
		}
		
		//价格检索
		switch($price){
						case '1':
							$condition.=' and t3.online_price>=1 and t3.online_price<=99';
							break;
						case '2':
							$condition.=' and t3.online_price>=100 and t3.online_price<=299';
							break;
						case '3':
							$condition.=' and t3.online_price>=300 and t3.online_price<=599';
							break;
						case '4':
							$condition.=' and t3.online_price>=600 and t3.online_price<=999';
							break;
						case '5':
							$condition.=' and t3.online_price>=1000 and t3.online_price<=1999';
							break;
						case '6':
							$condition.=' and t3.online_price>=2000';
							break;	
						default:
							$tmp_pr = explode('_',$price);
							if(is_array($tmp_pr) && count($tmp_pr)==2){
								$condition.=' and t3.online_price>='.intval($tmp_pr[0]).' and t3.online_price<='.intval($tmp_pr[1]);
							}
			   }

		$sql="select  t1.item_id,t1.name,t1.short_name,t1.seo_description,t3.online_price,t3.shop_price,t3.app_price,t4.img_uri  from (md_item t1 inner join  md_item_spec_price t3 on  t1.item_id=t3.item_id ) left join md_item_image t4 on t1.item_id =t4.item_id  and t4.is_default=1  where ".$condition ;	   
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

        $this->assign('keyword',$keyword);
        $this->assign('order_param',$order_param);
        $this->assign('price',$price);
		$this->assign('price_search',$price_search);
		$this->assign('items',$items);
        $seo_data['page']=$Page;
		$seo_data['title'] = '商品搜索';
        $seo_data['keywords'] = '衡水老白干官方商城';
        $seo_data['description'] = '衡水老白干官方商城';
        $this->assign('seo_data',$seo_data);
		$this->display();
	}

}