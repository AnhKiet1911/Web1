$(document).ready(function(e) {
	$('#next').click(function(){				
		chieu_dai_anh1 = parseInt($('.list_item > img:first-child').width());
		keo = chieu_dai_anh1 + (parseInt($('.list_item > img:first-child').css("margin-left").replace("px", "")) * 2);
		margin = parseInt($('.list_item').css("margin-left").replace("px", ""));
		tong = parseInt($('.list_item').width());
		 
		if((tong + margin) <= (keo + 20)){
			$('.list_item').animate({marginLeft:'0px'},1000,function(){});
		}else{
			$('.list_item').animate({marginLeft:'-='+keo+'px'},1000,function(){});		
		}			
	});
	
	$('#back').click(function(){
		chieu_dai_anh1 = parseInt($('.list_item > img:first-child').width());
		tong = parseInt($('.list_item').width());
		chieu_dai_cate = parseInt($('.cate').width());
		keo = tong - chieu_dai_cate;
		margin = parseInt($('.list_item').css("margin-left").replace("px", ""));
		
		if(margin == 0){
			$('.list_item').animate({marginLeft:'-='+keo+'px'},1000,function(){});			
		}else if(margin >= (chieu_dai_anh1)){
			$('.list_item').animate({marginLeft:'-='+keo+'px'},1000,function(){});
		}else{
			$('.list_item').animate({marginLeft:'+='+ (chieu_dai_anh1 + (parseInt($('.list_item > img:first-child').css("margin-left").replace("px", "")) * 2)) +'px'},1000,function(){});		
		}			
	});	
});