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

	$.fn.borrar = function() {
		var e = $(this);
		
		e.on('click', function(){
			var url = e.data('urldelete');

			$.ajax({
				method: 'post',
				url: url,
				success: function(response) {
					if (response.status === true) {
						document.location.reload();
					}
				}
			});
		});
	}
})(jQuery);