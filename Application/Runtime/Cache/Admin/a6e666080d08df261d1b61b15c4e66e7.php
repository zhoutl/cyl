<?php if (!defined('THINK_PATH')) exit();?><!--left-->
<div id="Left">


  <div class="LeftMenu">
    <ul>
		<?php foreach($data['child_menu'] as $v): ?>
			<?php $hover_list = explode(',',$v['hover']); ?>
			<li>
				<a href="<?php echo U($v['url']); ?>" <?php if(in_array($data['hover'],$hover_list)){echo 'class="checked"';} ?>>
					<i class="<?php echo $v['icon']; ?>"></i> <?php echo $v['name']; ?>
				</a>
			</li>
		<?php endforeach; ?>
    </ul>
  </div>



</div>
<!--/left-->