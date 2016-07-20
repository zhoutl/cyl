<?php if (!defined('THINK_PATH')) exit(); W('Admin/head',array(array('admin_user_id'=>$admin_user_id)));?>

    
    <!--main-->
    <div id="main" class="clearfix">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="main_table_left" align="left" valign="top">

    	<?php W('Admin/menu',array(array('admin_user_id'=>$admin_user_id)));?>
        
        </td>
        <td class="main_table_right" align="left" valign="top">


        <!--right-->
        <div id="Right">
        
        
        
        
        
        
        </div>
        <!--/right-->
        



        </td>
        </tr>
        </table>
            
        
    
    </div>
    <!--/main-->


<?php W('Admin/foot');?>