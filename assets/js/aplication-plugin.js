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
    $.fn.guardar = function() {
        $(this).on('click', function(){
            var e = $(this);
            var url = e.data('urlsave');
            var form = $('#' + e.data('form'));

            form.attr('action', url);
            form.submit();
        });
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
     * detalle
     *
     * Va al detalle de algún elemento.
     */
    $.fn.detalle = function() {
        $(this).on('click', function(){
            var e = $(this);
            var url = e.data('urldetail');
            window.document.location.href = url;
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
        var email       = $($(form).find('#email')).val();
        var password    = $($(form).find('#password')).val();
        var rememberme  = $($(form).find('#rememberme')).is(':checked');

        $.fn.cleanErrorLog();

        $.ajax({
            method  : 'post',
            async   : true,
            url     : 'authenticate/' + email  + '/' + password,
            data    : 'rememberme=' + rememberme,
            success : function(response){
                $('.preloader').toggleClass('show hide');
                if (true === response.authenticated) {
                    if (false !== response.rememberme) {
                        $.fn.createCookie('Rememberme', response.rememberme, 30);
                    }
                    window.location.href = '/';
                } else if (false === response.authenticated) {
                    $.fn.errorLog('Datos de login incorrectos.');
                    return false;
                }
                window.location.href = '/login';
            }
        })
    }

    $.fn.cleanErrorLog = function() {
        $('#login_errors label').html('');
        $('#login_errors').fadeOut();
    }

    $.fn.errorLog = function(stringError) {
        $('#login_errors label').html(stringError);
        $('#login_errors').fadeIn();
    }

    /** Relacion Ajax **/
    $.fn.relation = function(options, callback) {
        $.fn.relation.defaults = {
            data        : false,
            url         : false,
            relation    : 'relacion',
            key         : 'id',
            value       : 'nombre',
        };

        var opts = $.extend( {}, $.fn.relation.defaults, options );

        var select     = $(this);
        var reference   = $(this).attr('data-reference');

        $('#' + reference).on('change', function(){
            var val = $(this).val();
            var optionHTML = '';

            if (false !== opts.data) {
                opts.data.forEach(function(element, index, array){
                    if (parseInt(element.id) === parseInt(val)) {
                        optionHTML = '';
                        if (true === element.hasOwnProperty(opts.relation)) {
                            var data_relation = element[opts.relation];
                            data_relation.forEach(function(option, index, array){
                                optionHTML += '<option value="' + option[opts.key] + '">' + option[opts.value] + '</option>';
                            });
                        }
                        select.html(optionHTML);
                    }
                });
            }

            if (false !== opts.url) {
                $.ajax({
                    method  : 'post',
                    url     : opts.url,
                    data    : 'id=' + $(this).val(),
                    success : function(response) {
                        var jsonData = eval('(' + response + ')');
                        optionHTML = '';
                        jsonData.forEach(function(element, index, array){
                            optionHTML += '<option value="' + element[opts.key] + '">' + element[opts.value] + '</option>';
                        });
                        select.html(optionHTML);
                    }
                });
            }
        });
    }
})(jQuery);