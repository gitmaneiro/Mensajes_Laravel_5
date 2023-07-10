$.fn.reset = function () {
    $(this).each (function() { this.reset(); });
}

function decision(message, url){
    if(confirm(message)) location.href = url;
}
function confirmSubmit(form, message) { 
    var agree=confirm(message); 
    if (agree) {
        form.submit();
        return false; //de todas formas el link no se ejecutara
    } else {
        return false;
    } 
}

$("form#loginForm").validate({
    rules: {
        username: {
            required: true
        },
        password: {
            required: true
        }
    },
    messages: {
        username: {
            required: 'Ingrese un usuario'
        },
        password: {
            required: 'Ingrese una contraseña'
        }
    },
    invalidHandler: function (event, validator) { 
        $('.alert-error', $('.login-form')).show();
    },

    highlight: function (e) {
        $(e).closest('.form-group').removeClass('has-info').addClass('has-danger');
    },

    success: function (e) {
        $(e).closest('.form-group').removeClass('has-danger').addClass('has-success');
        $(e).remove();
    },
    errorPlacement: function (error, element) {
        if(element.is(':checkbox') || element.is(':radio')) {
            var controls = element.closest('.controls');
            if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
            else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
        }
        else if(element.is('.select2')) {
            error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
        }
        else if(element.is('.chzn-select')) {
            error.insertAfter(element.siblings('[class*="chzn-container"]:eq(0)'));
        }
        else error.insertAfter(element);
    },
    submitHandler: function () {
        var accion = '';
        var cargando = '<img src="assets/images/loading.gif" />';
        var token = $("input[name=_token]").val();
        var formData = new FormData($("form#loginForm")[0]);
        $.ajax({
            url:  $("form#loginForm").attr('action'),
            type: $("form#loginForm").attr('method'),
            headers: {'X-CSRF-TOKEN' : token},
            data: formData,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $('div#respuesta').html(cargando);
                $('.btn-block').attr('disabled', true);
            },
            success:function(respuesta){
                if(respuesta.message == "error") {
                    var mensaje = 'Usuario o contraseña incorrectos';
                    toastr.options = {
                    	closeButton: true,
                    	debug: false,
                    	newestOnTop: false,
                    	progressBar: false,
                    	positionClass: "toast-top-right",
                    	preventDuplicates: true,
                    	showDuration: "300",
                    	hideDuration: "1000",
                    	timeOut: "5000",
                    	extendedTimeOut: "1000",
                    	showEasing: "swing",
                    	hideEasing: "linear",
                    	showMethod: "fadeIn",
                    	hideMethod: "fadeOut"
                    }
                    toastr["error"](mensaje);
                    $('.btn-block').attr('disabled', false);
                    $('div#respuesta').empty();
                }
                else {
                    window.location = 'http://'+window.location.host+"/mensajes";
                }
            }
        })            
        return false;
    }
});

$("form#usuarioForm").validate({
    rules: {
        name: {
            required: true
        },
        email: {
            required: true,
            email: true
        },
        username: {
            required: true
        },
        password: {
            required: true
        },
        password_confirmation: {
            required: true,
            equalTo: "#password"
        },
        rol: {
            required: true
        },
        cedula: {
            required: true
        }
    },
    messages: {
        name: {
            required: 'Ingrese nombre y apellido'
        },
        username: {
            required: 'Ingrese un nombre de usuario'
        },
        email: {
            required: 'Ingrese un email',
            email: 'Ingrese un email válido'
        },
        password: {
            required: 'Ingrese una contraseña'
        },
        password_confirmation: {
            required: 'Repita la contraseña',
            equalTo: 'Las contraseñas deben de ser iguales'
        },
        rol: {
            required: 'Seleccione un rol'
        },
        cedula: {
            required: 'Ingrese un número de cédula'
        }
    },
    invalidHandler: function (event, validator) { 
        $('.alert-error', $('.login-form')).show();
    },

    highlight: function (e) {
        $(e).closest('.form-group').removeClass('has-info').addClass('has-danger');
    },

    success: function (e) {
        $(e).closest('.form-group').removeClass('has-danger').addClass('has-success');
        $(e).remove();
    },
    errorPlacement: function (error, element) {
        if(element.is(':checkbox') || element.is(':radio')) {
            var controls = element.closest('.controls');
            if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
            else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
        }
        else if(element.is('.select2')) {
            error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
        }
        else if(element.is('.chzn-select')) {
            error.insertAfter(element.siblings('[class*="chzn-container"]:eq(0)'));
        }
        else error.insertAfter(element);
    },
    submitHandler: function () {
        var accion = '';
        if($("button#usuarioSubmit").attr('data') == 1)
            accion = 'agregado';
        else if($("button#usuarioSubmit").attr('data') == 0)
            accion = 'actualizado';
        var alertMessage = 'Usuario '+accion+' satisfactoriamente';
        var token = $("input[name=_token]").val();
        var formData = new FormData($("form#usuarioForm")[0]);
        $.ajax({
            url:  $("form#usuarioForm").attr('action'),
            type: $("form#usuarioForm").attr('method'),
            headers: {'X-CSRF-TOKEN' : token},
            data: formData,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $("button#usuarioSubmit").addClass('disabled');
                $("button#cancelar").addClass('disabled');
            },
            success:function(respuesta){
                swal("¡Registrado!", alertMessage, "success");
                if($("button#usuarioSubmit").attr('data') == 1) {
                    $('form#usuarioForm').reset();
                    $('.form-group').removeClass('has-success');
                }
                $("button#usuarioSubmit").removeClass('disabled');
                $("button#cancelar").removeClass('disabled');
            }
        })
        return false;
    }
});

$("form#usuarioEditarForm").validate({
    rules: {
        name: {
            required: true
        },
        email: {
            required: true,
            email: true
        },
        username: {
            required: true
        },
        password: {
            required: false
        },
        password_confirmation: {
            required: false,
            equalTo: "#password"
        },
        rol: {
            required: true
        },
        cedula: {
            required:true
        }
    },
    messages: {
        name: {
            required: 'Ingrese nombre y apellido'
        },
        username: {
            required: 'Ingrese un nombre de usuario'
        },
        email: {
            required: 'Ingrese un email',
            email: 'Ingrese un email válido'
        },
        password: {
            required: 'Ingrese una contraseña'
        },
        password_confirmation: {
            required: 'Repita la contraseña',
            equalTo: 'Las contraseñas deben de ser iguales'
        },
        rol: {
            required: 'Seleccione un rol'
        },
        cedula:{
            required: 'Ingrese un número de cédula'
        }
    },
    invalidHandler: function (event, validator) { 
        $('.alert-error', $('.login-form')).show();
    },

    highlight: function (e) {
        $(e).closest('.form-group').removeClass('has-info').addClass('has-danger');
    },

    success: function (e) {
        $(e).closest('.form-group').removeClass('has-danger').addClass('has-success');
        $(e).remove();
    },
    errorPlacement: function (error, element) {
        if(element.is(':checkbox') || element.is(':radio')) {
            var controls = element.closest('.controls');
            if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
            else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
        }
        else if(element.is('.select2')) {
            error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
        }
        else if(element.is('.chzn-select')) {
            error.insertAfter(element.siblings('[class*="chzn-container"]:eq(0)'));
        }
        else error.insertAfter(element);
    },
    submitHandler: function () {
        var accion = '';
        if($("button#usuarioEditarSubmit").attr('data') == 1)
            accion = 'agregado';
        else if($("button#usuarioEditarSubmit").attr('data') == 0)
            accion = 'actualizado';
        var alertMessage = 'Usuario '+accion+' satisfactoriamente';
        var token = $("input[name=_token]").val();
        var formData = new FormData($("form#usuarioEditarForm")[0]);
        $.ajax({
            url:  $("form#usuarioEditarForm").attr('action'),
            type: $("form#usuarioEditarForm").attr('method'),
            headers: {'X-CSRF-TOKEN' : token},
            data: formData,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $("button#usuarioEditarSubmit").addClass('disabled');
                $("button#cancelar").addClass('disabled');
            },
            success:function(respuesta){
                swal("¡Registrado!", alertMessage, "success");
                if($("button#usuarioEditarSubmit").attr('data') == 1)
                {
                    $('form#usuarioEditarForm').reset();
                    $('.form-group').removeClass('has-success');
                }
                $("button#usuarioEditarSubmit").removeClass('disabled');
                $("button#cancelar").removeClass('disabled');
            }
        })
        return false;
    }
});

$("form#configuracionForm").validate({
    rules: {
        cantidadMensajes: {
            required: true, 
            number: true,
            min: 1
        },
        velocidad: {
            required: true
        }
    },
    messages: {
        cantidadMensajes: {
            required: 'Ingrese la cantidad de mensajes', 
            number: 'Ingrese solo números', 
            min: 'La cantidad mínima a mostrar es un (1) mensaje'

        },
        velocidad: {
            required: 'Seleccione una velocidad'
        }
    },
    invalidHandler: function (event, validator) { 
        $('.alert-error', $('.login-form')).show();
    },

    highlight: function (e) {
        $(e).closest('.form-group').removeClass('has-info').addClass('has-danger');
    },

    success: function (e) {
        $(e).closest('.form-group').removeClass('has-danger').addClass('has-success');
        $(e).remove();
    },
    errorPlacement: function (error, element) {
        if(element.is(':checkbox') || element.is(':radio')) {
            var controls = element.closest('.controls');
            if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
            else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
        }
        else if(element.is('.select2')) {
            error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
        }
        else if(element.is('.chzn-select')) {
            error.insertAfter(element.siblings('[class*="chzn-container"]:eq(0)'));
        }
        else error.insertAfter(element);
    },
    submitHandler: function () {
        var token = $("input[name=_token]").val();
        var formData = new FormData($("form#configuracionForm")[0]);
        $.ajax({
            url:  $("form#configuracionForm").attr('action'),
            type: $("form#configuracionForm").attr('method'),
            headers: {'X-CSRF-TOKEN' : token},
            data: formData,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $("button#configuracionSubmit").addClass('disabled');
            },
            success:function(respuesta){
                swal("¡Registrado!", "'Configuración actualizada satisfactoriamente'", "success");
                $("button#configuracionSubmit").removeClass('disabled');
            }
        })
        return false;
    }
});

$("form#mensajeForm").validate({
    rules: {
        status: {
            required: true
        },
        mensaje: {
            required: true
        }
    },
    messages: {
        status: {
            required: 'Ingrese un asunto'
        },
        mensaje: {
            required: 'Ingrese un mensaje'
        }
    },
    invalidHandler: function (event, validator) { 
        $('.alert-error', $('.login-form')).show();
    },

    highlight: function (e) {
        $(e).closest('.form-group').removeClass('has-info').addClass('has-danger');
    },

    success: function (e) {
        $(e).closest('.form-group').removeClass('has-danger').addClass('has-success');
        $(e).remove();
    },
    errorPlacement: function (error, element) {
        if(element.is(':checkbox') || element.is(':radio')) {
            var controls = element.closest('.controls');
            if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
            else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
        }
        else if(element.is('.select2')) {
            error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
        }
        else if(element.is('.chzn-select')) {
            error.insertAfter(element.siblings('[class*="chzn-container"]:eq(0)'));
        }
        else error.insertAfter(element);
    },
    submitHandler: function () {
        var accion = '';
        if($("button#mensajeSubmit").attr('data') == 1)
            accion = 'enviado';
        else if($("button#mensajeSubmit").attr('data') == 0)
            accion = 'actualizado';
        var alertMessage = 'Mensaje '+accion+'';
        var token = $("input[name=_token]").val();
        var formData = new FormData($("form#mensajeForm")[0]);
        $.ajax({
            url:  $("form#mensajeForm").attr('action'),
            type: $("form#mensajeForm").attr('method'),
            headers: {'X-CSRF-TOKEN' : token},
            data: formData,
            processData: false,
            contentType: false,
            beforeSend:function(){
                $("button#mensajeSubmit").addClass('disabled');
                $("button#cancelar").addClass('disabled');
            },
            success:function(respuesta){
                //swal("¡Registrado!", alertMessage, "success");
                if($("button#mensajeSubmit").attr('data') == 1) {
                    $('form#mensajeForm').reset();
                    $('.form-group').removeClass('has-success');
                }
                $("button#mensajeSubmit").removeClass('disabled');
                $("button#cancelar").removeClass('disabled');
            }
        })
        return false;
    }
});