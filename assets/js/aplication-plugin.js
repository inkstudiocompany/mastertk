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
            var title = e.attr('data-title');
            var message = e.attr('data-message');

			$('div[role="confirm"]').confirm(
				{
					title: title,
					message: message
				}, function(){
					$.ajax({
						method: 'post',
						url: url,
						success: function(response) {
							if (response.status === true) {
								document.location.reload();
							}
						}
					});
				}
			);
		});
	}

	$.fn.confirm = function(options, callback) {
		$.fn.confirm.defaults = {
		    title: 'Confirm',
		    message: 'Here are your message'
		};

		var opts = $.extend( {}, $.fn.confirm.defaults, options );

		var url = $(this).attr('data-url');

		$.ajax({
			method: 'get',
			url: url, 
			data: opts,
			success: function (response) {
				if(response.status === true) {
					$('div[role="confirm"]').find('.modal-content').html(response.html);
					$('div[role="confirm"]').modal();

					var confirmButton = $('div[role="confirm"]').find('button[button-action="confirm"]');
					confirmButton.on('click', callback);
				}
			}
		});
	}

	$.fn.appValidate = function(options){
        $.fn.confirm.defaults = {
            debug: false,
            rules: {},
            messages: {}
        };

        var opts = $.extend( {}, $.fn.confirm.defaults, options );

        $(this).validate({
            debug: opts.debug,
            errorClass: 'alert alert-danger',
            errorElement: 'div',
            rules: opts.rules,
            messages: opts.messages
        });
	}
})(jQuery);