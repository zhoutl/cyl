<?php
namespace Home\Controller;
use Home\Controller\HomeController;


/**
* 退货
*/
class RefundController extends HomeController
{    
     public function _initialize()  
    {  
        parent::_initialize();  
        $this->refund_reason=array(
            '1'=>'质量有问题',
            '2'=>'不喜欢',
            '3'=>'其他' 
        ); 
        $this->status=array(
            '1'=>'待审核',
            '2'=>'填写物流',
            '3'=>'退货中',
            '4'=>'退货成功',
            '-1'=>'退货失败' 
        ); 
    }  

	public function index(){

        $count =D('OrdersRefund')->where(array('account_id'=>$this->mid))->count();
        $Page=new \Think\Page($count,15);
        $data['refund'] =D('OrdersRefund')->where(array('account_id'=>$this->mid))->limit($Page->firstRow,$Page->listRows)->select();
         foreach ($data['refund'] as $key => $value) {
             $data['refund'][$key]['reason']=$this->refund_reason[$value['refund_reason']];
             $data['refund'][$key]['status_title']=$this->status[$value['status']];
             $data['refund'][$key]['refund_item']=D('OrdersRefundItem')->join('left join md_item_image on md_item_image.item_id=md_orders_refund_item.item_id and md_item_image.is_default=1')->where(array('orders_refund_id'=>$value['orders_refund_id']))->select(); 
         }
        $seo_data['title']        = '个人中心-我的退货';
        $seo_data['keywords']     = '衡水老白干官方商城';
        $seo_data['description']  = '衡水老白干官方商城';
        $this -> assign('seo_data',$seo_data);
        $this -> assign('page',$Page);
        $this -> assign('data',$data);
        $this -> display();
	}

    //申请退货
    public function applyRefund(){
        $account_id=$this->mid;
        $data['orders_id']=I('get.orders_id',0,'intval'); 
        $data['order']=D('Orders')->where(array('orders_id'=>$data['orders_id'],'account_id'=>$account_id))->find(); 
            if(!empty($data['order']) && $data['order']['status']==1){
                $data['orders_item']=D('OrdersItem')->join('left join md_item_image on md_item_image.item_id=md_orders_item.item_id and md_item_image.is_default=1')->where(array('orders_id'=>$data['orders_id']))->select(); 
                $seo_data['title']        = '退货申请';
                $seo_data['keywords']     = '衡水老白干官方商城';
                $seo_data['description']  = '衡水老白干官方商城';
                $this -> assign('data',$data);
                $this -> assign('seo_data',$seo_data);
                $this -> display();
            }else{
                $this -> assign('msg','抱歉，此订单不可以申请退货');
                $this -> display('Common/miss');
            }

    
    }
    //申请退货处理
    public function doApply(){
       if(IS_AJAX){
           $data=I('post.');
           $orders_id=I('post.orders_id');
           $result=D('OrdersRefund')->applyRefund($this->mid,$orders_id,$data);
           $this->ajaxReturn($result);
        }
        
    }
    //退货详情
    public function refundDetail(){
        $orders_refund_id=I('orders_refund_id',0,'intval');
        $data['OrdersRefund']=D('OrdersRefund')->where(array('orders_refund_id'=>$orders_refund_id,'account_id'=>$this->mid))->find();
        if(empty($data['OrdersRefund'])){
                $this -> assign('msg','抱歉，没有找到退货信息');
                $this -> display('Common/miss');
        }else{
            $data['OrdersRefundItem']=D('OrdersRefundItem')->join('left join md_item_image on md_item_image.item_id=md_orders_refund_item.item_id and md_item_image.is_default=1')->where(array('orders_refund_id'=>$orders_refund_id))->select();
            $data['OrdersRefundImage']=D('OrdersRefundImage')->where(array('orders_refund_id'=>$orders_refund_id))->select();
            $data['OrdersRefund']['reason']=$this->refund_reason[$data['OrdersRefund']['refund_reason']];
            $seo_data['title']        = '退货详情';
            $seo_data['keywords']     = '衡水老白干官方商城';
            $seo_data['description']  = '衡水老白干官方商城';
            $this -> assign('data',$data);
            $this -> assign('seo_data',$seo_data);
            if($data['OrdersRefund']['status']==1 || $data['OrdersRefund']['status']==-1 ){
                //退货审核
                $this -> display('detailSh');
            }else if($data['OrdersRefund']['status']==2 || $data['OrdersRefund']['status']==3 ){
                //填写物流
                $this -> display('detailWl');
            }else if($data['OrdersRefund']['status']==4 ){
                //退货完成
                $this -> display('detailWc');
            }


        }


    }

    //填写物流信息
    public function addExpress(){
        if(IS_AJAX){
            $data=I('post.');
            $result=D('OrdersRefund')->addExpress($this->mid,I('post.orders_refund_id',0,'intval'),$data);
            $this->ajaxReturn($result);
        }  
    }


	
}

