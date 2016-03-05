'use sctrict';

(function($){
	$.fn.myfunction = function() {
		//This is a example for a new method plugin		
	}

	$.fn.editar = function() {
		$(this).on('click', function(){
			var e = $(this);
			var url = e.data('urledit');
			window.document.location.href = url;
		});
	}

	$.fn.borrar = function() {
		$(this).on('click', function(){
			var e = $(this);
			var url = e.attr('data-urldelete');

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