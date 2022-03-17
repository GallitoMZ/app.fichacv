$(document).ready(function() {

    var $select = $('.select2').select2({
        theme: 'bootstrap',
    });
    jQuery.validator.setDefaults({
        onfocusout: function(e) {
            this.element(e);


        },

        onkeyup: function(e) {
            this.element(e);


        },



        highlight: function(element) {
            jQuery(element).closest('.form-control').addClass('is-invalid');
            jQuery(element).closest('.form-group').addClass('has-error');
            // jQuery(element).closest('.select2').addClass('has-error');


            jQuery(element).closest('.form-group').removeClass('has-success');
            jQuery(element).closest('.form-control').removeClass('is-valid');
            // jQuery(element).closest('.select2').removeClass('has-success');



        },
        unhighlight: function(element) {
            jQuery(element).closest('.form-control').removeClass('is-invalid');
            jQuery(element).closest('.form-group').removeClass('has-error');
            // jQuery(element).closest('.select2').removeClass('has-error');

            jQuery(element).closest('.form-control').addClass('is-valid');
            jQuery(element).closest('.form-group').addClass('has-success');
            // jQuery(element).closest('.select2').addClass('has-success');


        },


        errorElement: 'div',
        errorClass: 'invalid-feedback',
        errorPlacement: function(error, element) {
            if (element.parent('.input-group-prepend').length) {
                $(element).siblings(".invalid-feedback").append(error);
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },

    });
    // $select.on('change', function() {
    //     $(this).trigger('blur');
    // });
    $select.on('select2:select', function() {
        $(this).trigger('blur');
    });
    $("#modal_form_guardar").validate({
        lang: 'es',
        debug: true,
        ignore: '.select2-input, .select2-focusser',
    });

    $select.rules('add', {
        required: true,
        messages: {
            required: "Seleccione una Opcion"
        }
    });

    fecha_custom();



});


function fn_guardar() {
    var form_estado = $("#modal_form_guardar");
    var url_estado = form_estado.attr('action');
    var data_estado = form_estado.serialize();
    $("#txt_guardado_id").html('<i class="fas fa-spinner fa-pulse"></i> Guardando...');
    $.ajax({
        url: url_estado,
        type: "POST",
        data: data_estado,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),

        }
    }).then(function(data_recibida) {

        if (data_recibida.status === 'ok') {
            console.log("Estado Cambiado Correctamente");

            setTimeout(function() {
                $("#txt_guardado_id").html('<i class="fas fa-check-circle"></i> Guardado automaticamente');
            }, 500);
        } else {
            console.log("Error al cambiar Estado  ");

        }
    })
}

function fecha_custom(params) {
    $('.daterangepick').daterangepicker({

        "locale": {
            "format": "DD/MM/YYYY",
            "separator": " - ",
            "applyLabel": "Guardar",
            "cancelLabel": "Cancelar",
            "fromLabel": "Desde",
            "toLabel": "Hasta",
            "customRangeLabel": "Personalizar",
            "daysOfWeek": [
                "Dom",
                "Lun",
                "Mar",
                "Mie",
                "Jue",
                "Vie",
                "Sab"
            ],
            "monthNames": [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Setiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
            ],
            "firstDay": 1
        },
        "singleDatePicker": true,
        "showDropdowns": true,
        "minYear": 1901,
        "autoApply": true,
        "drops": "auto",
        maxYear: parseInt(moment().format('YYYY'), 10) + 1,
    });
}