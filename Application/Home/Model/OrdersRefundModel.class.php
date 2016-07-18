<?php
namespace Home\Model;
use Think\Model;

/**
* 
*/
class OrdersRefundModel extends Model
{
    protected $_validate = array(
    	//array('refund_reason',array(1,2,3),'请选择退货原因',1,'in'), 
    	array('refund_reason_message','1,200','退货详细描述为1-200个字',2,'length'), 
	);

	 //申请退货
    public function applyRefund($account_id,$orders_id,$data){
       
       while (true) {
         
       	//订单是否满足
       	$order=D('Orders')->where(array('status'=>1,'pay_status'=>1,'shipping_status'=>1,'orders_id'=>$orders_id,'account_id'=>$account_id))->find();

       	if(empty($order)){
			$result=array('status'=>0,'msg'=>'不存在此订单');
       		break;
       	}
       	//是否已退货
       	$refund=$this->where(array('account_id'=>$account_id,'orders_id'=>$orders_id))->find();
       	if($refund && $refund['status']!=-1){
       		$result=array('status'=>0,'msg'=>'此订单已经申请退货');
       		break;
       	}
       	$order_item=D(OrdersItem)->where(array('orders_id'=>$orders_id))->field('item_id,quantity,item_spec_ids,item_name,price')->select();
       	//单个商品退货数量
       	foreach ($order_item as $key => $value) {
       		$item_array[$key]=$value['item_id'];
       		$item_one[$value['item_id']]['quantity']=$value['quantity'];
       		$item_one[$value['item_id']]['item_spec_ids']=$value['item_spec_ids'];
       		$item_one[$value['item_id']]['item_name']=$value['item_name'];
       		$item_one[$value['item_id']]['price']=$value['price'];


       	}
       	//退货总数大于1

       	$insert_item=array_intersect($item_array, $data['item']);
       // print_r($data['quantity_16']);
       	for($i=0;$i<count($insert_item);$i++){

            $total+=$data['quantity_'.$insert_item[$i]];
            if($item_one[$insert_item[$i]]['quantity_'] < $data['quantity'.$insert_item[$i]]){
            	$result=array('status'=>0,'msg'=>'退货数量不能大于购买数量');
       		    break;
            }
       	}

       	if($total<=0 ){
            	$result=array('status'=>0,'msg'=>'退货数量不能小于0');
       		    break;
        }
       	
       	//退款金额不大于实付总金额
         if($data['refund_amount'] > $order['pay_amount']){
           	$result=array('status'=>0,'msg'=>'退款金额不能大于实付总金额');
           	break;
          }
         

         //退货原因
         if($data['refund_reason']==0){
				$result=array('status'=>0,'msg'=>'请选择退货原因');
       		    break;
         }elseif ($data['refund_reason']==3 && $data['refund_reason_message']=='') {
         	$result=array('status'=>0,'msg'=>'请填写详细退货原因');
       		    break;
         }
         $data['account_id']=$account_id;
         $data['order_no']=$order['order_no'];
         $data['serial_no']=$order['serial_no'];
         $data['payment_id']=$order['payment_id'];
         $data['payment_name']=$order['payment_name'];
         $data['status']=1;
         $data['apply_time']=time();
         
         if(!$this->create($data)){
         	$result=array('status'=>0,'msg'=>$this->getError());
       		 break;
         }
               
          $orders_refund_id=$this->add();
              if($orders_refund_id){
                //退货商品信息
		         for ($k=0;$k<count($insert_item);$k++) { 
		         	    $item_id=$insert_item[$k];
		         	    if($item_one[$item_id]['quantity']>0){
							$orders_refund_item_insert=array(
				         	'orders_refund_id'=>$orders_refund_id,
				         	'item_id'=>$item_id,
				         	'item_spec_ids'=>$item_one[$item_id]['item_spec_ids'],
				         	'item_name'=>$item_one[$item_id]['item_name'],
				         	'price'=>$item_one[$item_id]['price'],
				         	'quantity'=>intval($data['quantity_'.$item_id]),
				         	);
				         	D('OrdersRefundItem')->add($orders_refund_item_insert);
				         	unset($orders_refund_item_insert);
		         	    }
			         	unset($item_id);
		         }
				//退货图片信息
		         for ($j=0;$j<count($data['filename']);$j++){
		         	$file_uri='.'.$data['filename'][$j];
		         	if(!empty($file_uri) &&file_exists($file_uri)){
						$orders_refund_image_insert=array(
			         	'orders_refund_id'=>$orders_refund_id,
			         	'img_uri'=>$data['filename'][$j],
			         	);
			         	D('OrdersRefundImage')->add($orders_refund_image_insert);
			         	unset($orders_refund_image_insert);
		         	}
                      
		         } 

              }else{
              	$result=array('status'=>0,'msg'=>'申请失败');
       		     break;
              }
        //更改订单状态
        M('Orders')->where(' orders_id= '.$orders_id)->save(array('status'=>2)); 
        $result=array('status'=>1,'msg'=>'申请成功','orders_refund_id'=>$orders_refund_id);
       	  break;
       }
        return $result;
    }
	

	//添加物流信息
	public function addExpress($account_id,$orders_refund_id,$data){
       while (true) {
       	$one=$this->where(array('account_id'=>$account_id,'orders_refund_id'=>$orders_refund_id))->find();
       	if(empty($one)){
          $result=array('status'=>0,'msg'=>'不存在该退货信息');
          break;
       	}
        $data['status']=3;
        if(!$this->create($data)){
		  $result=array('status'=>0,'msg'=>$this->getError());
          break;
        }
        
        if($one['status']==2){
            $this->save($data);
        }else{
          $result=array('status'=>0,'msg'=>'退货异常');
          break;
        }
        $result=array('status'=>1,'msg'=>'退货成功');
       	break;
       }
       return $result;
	}

	
}