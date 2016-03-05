'use sctrict';

(function($){
	$.fn.myfunction = function() {
		//This is a example for a new method plugin		
	}

	$.fn.editar = function() {
		var e = $(this);
		var url = e.data('urledit');
		
		e.on('click', function(){
			window.document.location.href = url;
		});
	}
})(jQuery);