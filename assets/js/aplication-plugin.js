'use sctrict';


(function($){
	$.fn.myfunction = function() {
		//This is a example for a new method plugin		
	}

    /**
     * editar
     *
     * Edita un item de una lista.
     */
	$.fn.editar = function() {
		$(this).on('click', function(){
			var e = $(this);
			var url = e.data('urledit');
			window.document.location.href = url;
		});
	}

    /**
     * borrar
     *
     * Elimina un item de una lista.
     */
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

    /**
     * confirm
     *
     * Crea modal con mensaje de confirmación para ejecutar una acción.
     *
     * @param options
     * @param callback
     */
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

	/**
	 * appValidate
     *
     * Genera mensaje con alertas de validación a un formulario
     *
	 * @param options
     */
	$.fn.appValidate = function(options){
        $.fn.confirm.defaults = {
            debug: false,
            rules: {},
            messages: {},
            errorElement: 'div'
        };

        var opts = $.extend( {}, $.fn.confirm.defaults, options );

        $(this).validate({
            debug: opts.debug,
            errorClass: 'alert alert-danger',
            errorElement: opts.errorElement,
            rules: opts.rules,
            messages: opts.messages
        });
	}

    /**
     * login
     *
     * Envía los datos del formulario para la autenticación de usuario.
     */
    $.fn.login = function(form) {
        var email = $($(form).find('#email')).val();
        var password = $($(form).find('#password')).val();

        $.ajax({
            method: 'post',
            async: false,
            url: 'authenticate/' + email  + '/' + password,
            success: function(response){
                $('.preloader').toggleClass('show hide');
                if (true === response.authenticated) {
                    window.location.href = '/';
                }
                window.location.href = '/login';
            }
        })
    }
})(jQuery);