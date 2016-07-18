<!-- ajax属性 -->
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="add_from_table add_from_table2">
    <?php foreach ($data['attribute_list'] as $aval):?>
		<?php 
			$item_attribute_name = '';
			if(!empty($data['item_extra_list'])){
				foreach($data['item_extra_list'] as $v){
					if($v['item_category_attribute_id'] == $aval['item_category_attribute_id']){
						$item_attribute_name = $v['item_category_attribute_id'].'_'.$v['attribute_name'].'_'.$v['item_category_attribute_value_id'].'_'.$v['attribute_value'];
					}
				}
			}
		?>
		
        <!--  通过attr_type 获取attr_value值-->
        <tr><td align="left" valign="top" class="aft_l"><?php echo $aval['attribute_name']?></td>
			<!-- 根据attr获取属性值 -->
			<?php if($aval['input_type']=='1'):?>
			   <td align="left" valign="middle" class="aft_r">
			   <select class="form-control the_text2 f_l  " name="custom_attribute[<?php echo $aval['item_category_attribute_id'];?>]">
				<?php foreach($aval['value_list'] as $vval):?>
					<?php $tmp_name =  $aval['item_category_attribute_id'].'_'.$aval['attribute_name'].'_'.$vval['item_category_attribute_value_id'].'_'.$vval['attribute_value']; ?>
				   <option value="<?php echo $tmp_name;?>" <?php if($tmp_name == $item_attribute_name){echo 'selected';} ?>><?php echo $vval['attribute_value']?></option>
				 <?php endforeach;?>
				   </select></td>
			<?php endif; ?>
    	 </tr>
    	 <?php endforeach;?>
</table>