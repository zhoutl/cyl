$(document).ready(function(e) {
    
	var winhei = $(window).height();
	var winwid = $(window).width();
	
	//侧边二级菜单
/*	$('.mainNav li').find('a').first().on("click",function(){
		alert($(this).html());
		return false;
	});*/
	
	$('.nav_menu').on('click',function(){
		if($(this).parents('li').find('ul.childnav').length!=0){
						
			if($(this).parents('li').hasClass('checked')){
				//alert('12');
				$(this).parents('li').removeClass('checked');
				$('ul.childnav').addClass('none');
				
			}else{
			
				$('.mainNav li').removeClass('hover');
				$('.mainNav li').removeClass('checked');
				$(this).parents('li').addClass('checked');
				$('ul.childnav').addClass('none');
				
				$(this).parents('li').find('ul.childnav').removeClass('none')
				
			}
			
		}
	})
	
	
/*	
	$('.mainNav li').on('click',function(){		
		if($(this).find('ul.childnav').length!=0){			
			if($(this).find('ul.childnav').hasClass('none')){
				$('.mainNav li').removeClass('hover');
				if(!$(this).hasClass('hover')){
					$(this).addClass('hover');
				}
				$('ul.childnav').addClass('none');
				$(this).find('ul.childnav').removeClass('none');
			}else{
				if($(this).hasClass('hover')){
					$(this).removeClass('hover');
				}
				$(this).find('ul.childnav').addClass('none');
			}
		}
	})
	
*/	
	if($('.page_right_common').length!=0){
		$('.page_right_common').css('height',winhei-100);
	}
	
	
	$('#top_menu_btn').on('click',function(){
		if($(this).hasClass('checked')){
			$(this).removeClass('checked');
			$('#Left').animate({marginLeft:'-150px'},300);
			$('#Main').animate({left:'0'},300);
		}else{
			$(this).addClass('checked');
			$('#Left').animate({marginLeft:'0'},300);
			$('#Main').animate({left:'150px'},300);
		}
	})
	
	
	
	if($('#common_num').length>0){
		var sttime1 = setInterval(function(){$("#common_num").html( yanbtn($('#common_num').html()) )},1000);
	}
	
	function yanbtn(num){
		if(num<=1){
			clearInterval(sttime1);
			var the_url=$('#common_link').attr('href');
			if(the_url){
				top.location=the_url;
			}else{
				alert(the_url);
			}
		}
		if(num){num=num-1;}
		return num;		
	}	
	
	
	
	//点击按钮弹出层
	$('#modal_botton').on('click',function(){
		$('#myModal2').modal('show');
	})


//List
	
	$('.del_button').on('click',function(){
		$('#DelAlert').insertAfter($(this));
		$('#DelAlert').css('padding-top',(winhei-300)/2);
		$('#DelAlert').modal('show');
		return false;
	})
	$('#DelConfirm').on('click',function(){
		alert($(this).parents('td').find('.this_id').val());
		$('#DelAlert').modal('hide');
		return false;
	})
	
	
	$('.this_check').on('click',function(){
		if($(this).hasClass('icon-ok')){
			$(this).addClass('icon-remove').removeClass('icon-ok');
		}else{
			$(this).addClass('icon-ok').removeClass('icon-remove');
		}
		return false;
	})
	
	$('#del_all_button').on("click",function(){
		if(!$("input[type=checkbox]:checked").val()){
			$('#DelAllAlert').css('padding-top',(winhei)/2);
			$('#DelAllAlert').modal('show');
			return false;
		}
	})





//TREE
    $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', '33333333333');
    $('.tree li.parent_li > span').on('click', function (e) {
        var children = $(this).parent('li.parent_li').find(' > ul > li');
        if (children.is(":visible")) {
			if(!children.hasClass('none')){children.addClass('none')};
			//children.hide(200);
			//children.animate(3000).css('display', 'none');
            $(this).attr('title', '22222222222').find(' > i').addClass('icon-folder-close-alt').removeClass('icon-folder-open-alt');
        } else {
			if(children.hasClass('none')){children.removeClass('none')};
			//children.show(200);
			//children.animate(3000).css('display', 'inherit');
            $(this).attr('title', '1111111111').find(' > i').addClass('icon-folder-open-alt').removeClass('icon-folder-close-alt');
        }
        e.stopPropagation();
    });


//Add From
	//隔行换色
	$('.add_from_table tr:even').addClass('alt');

	//经过TR变色
	$('.add_from_table tr').hover(function(){
		if(!$(this).hasClass('over')){
			$(this).addClass('over');	
		}
	},function(){
		if($(this).hasClass('over')){
			$(this).removeClass('over');
		}
	})
	
	
	//the_add_td
	$('.the_add_td_button').on('click',function(){
		the_add_td='<tr><td><input type="text" class="form-control the_text2" placeholder="请输入文字"></td><td><button type="button" class="btn btn-danger the_del_td_button"><i class="icon-minus"></i></button></td></tr>';
		$(this).parents('.the_add_td').append(the_add_td);
	})
	
	
	$('.the_add_td').on('click','.the_del_td_button',function(){
		$(this).parent().parent().remove();
	})


//TAB
	//$('#myTab a:f').tab('show');
	
	
	




//404
	$('body.error-body').height(winhei);
	

//Table
	
	//隔行换色
	$('.jadmin_table tr:even').addClass('alt');
	
	//经过TR变色
	$('.jadmin_table tr').hover(function(){
		if(!$(this).hasClass('over')){
			$(this).addClass('over');	
		}
	},function(){
		if($(this).hasClass('over')){
			$(this).removeClass('over');
		}
	})
		
	
	//点击选中checkbox
	$('.jadmin_table tr td').on('click',function(){
		if($(this).parent('tr').hasClass('click')){			
			$(this).parent('tr').find('input[type=checkbox]').attr('checked',false);
			$(this).parent('tr').removeClass('click');
		}else{			
			$(this).parent('tr').find('input[type=checkbox]').attr('checked',true);	
			$(this).parent('tr').addClass('click');	
		}		
	})
	
	//全选、取消
	$('#checkbox_all').on('click',function(){
		if(!$(this).attr('checked')){
			$('.jadmin_table td').find('input:checkbox').each(function(index, element) {
                $(this).attr('checked',false);
				$(this).parents('tr').removeClass('click');
            });
		}else{
			$('.jadmin_table td').find('input:checkbox').each(function(index, element) {
                $(this).attr('checked',true);
				$(this).parents('tr').addClass('click');
            });
		}
	})
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
});