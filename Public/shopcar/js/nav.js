/* nav.js Tsjdfksljlkjsj 7102 主要应用于首页右侧导航栏 */
$(document).ready(function(){
	$('.tbar-tab-cart').click(function (){ 
		if($('.toolbar-wrap').hasClass('toolbar-open')){
			$('.toolbar-wrap').removeClass('toolbar-open');
			$(this).removeClass('tbar-tab-click-selected');
			$('.tbar-panel-cart').css({'visibility':"hidden","z-index":"-1"});
		}else{ 
			$(this).addClass('tbar-tab-click-selected'); 
			$('.tbar-panel-cart').css({'visibility':"visible","z-index":"1"});
			$('.toolbar-wrap').addClass('toolbar-open'); 
		}
	});
	
	$('.close-panel').click(function(){
		$('.toolbar-wrap').removeClass('toolbar-open');
		$(this).removeClass('tbar-tab-click-selected');
		$('.tbar-panel-cart').css({'visibility':"hidden","z-index":"-1"});
	});
});