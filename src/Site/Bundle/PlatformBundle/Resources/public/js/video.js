var showVideo = {
	create : function(option){
		var op = option || {};
		var isIE6 = ![1,] && !window.XMLHttpRequest ;
		var wid = op.wid || 400;
		var hei = op.hei ;
		var symbol = op.symbol;
		var state = op.state;
		var con = op.con ;

		var dialog = {};
		dialog.init = function(){
			dialog.show();
			dialog.handle();
		}
		dialog.show = function(){
			var formWrap = '<div class="popCon"><a href="javascript:;" class="btn-close"></a>';
			formWrap += '<h2>提示</h2><div class="con"><p>您确定要删除该条信息？</p><div class="btn"><a href="#" class="confirm">确定</a><a href="#" class="cancel">取消</a></div></div></div>';



			
			dialog.wrap = $(formWrap);
			

			dialog.wrap.animate({
				width:wid,
				height:hei,
				marginTop:-hei/2+'px',
				marginLeft:-wid/2+'px'
			},'fast');

			dialog.mask = $("<div class='cover'></div>");

			var pageH = $(document).height();
			
			dialog.mask.css('height',pageH+'px');

			dialog.ie6scroll();

			$('body').append(dialog.mask).append(dialog.wrap);


		}
		dialog.ie6scroll = function() {
			if (isIE6) {
				alert('ie6');
				dialog.wrap.css({
					'position':'absolute',
					'top':expression(eval(document.documentElement.scrollTop))
				});
			}
		}

		dialog.removeBox = function() {
			dialog.mask.remove();
			dialog.wrap.remove();
		
		}
		/*dialog.hasClass = function(node, className) {
			if (!node || !className) {
				return false;
			}
			return -1 < (' ' + node.className + ' ').indexOf(' ' + className + ' ');//?
		}*/
		dialog.handle = function() {

			$(document).on('click', '.btn-close,.cancel',function() {
				dialog.removeBox();
			})
			

			$(document).on('keydown', function(e) {
				
				keyCode = e.keyCode;
				keyCode === 27 && dialog.removeBox();
			})
			

			
		}

		
		

		return dialog ;


	}
}



