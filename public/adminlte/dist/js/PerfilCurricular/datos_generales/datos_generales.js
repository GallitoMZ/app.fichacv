$(document).ready(function() {

    var $select = $('.select2').select2({
        theme: 'bootstrap',
    });
    // jQuery.validator.setDefaults({
    //     onfocusout: function(e) {
    //         this.element(e);

    //     },

    //     onkeyup: function(e) {
    //         this.element(e);

    //     },


    //     highlight: function(element) {
    //         jQuery(element).closest('.form-control').addClass('is-invalid');
    //         jQuery(element).closest('.form-group').addClass('has-error');
    //         // jQuery(element).closest('.select2').addClass('has-error');


    //         jQuery(element).closest('.form-group').removeClass('has-success');
    //         jQuery(element).closest('.form-control').removeClass('is-valid');
    //         // jQuery(element).closest('.select2').removeClass('has-success');

    //     },
    //     unhighlight: function(element) {
    //         jQuery(element).closest('.form-control').removeClass('is-invalid');
    //         jQuery(element).closest('.form-group').removeClass('has-error');
    //         // jQuery(element).closest('.select2').removeClass('has-error');

    //         jQuery(element).closest('.form-control').addClass('is-valid');
    //         jQuery(element).closest('.form-group').addClass('has-success');
    //         // jQuery(element).closest('.select2').addClass('has-success');


    //     },


    //     errorElement: 'div',
    //     errorClass: 'invalid-feedback',
    //     errorPlacement: function(error, element) {
    //         if (element.parent('.input-group-prepend').length) {
    //             $(element).siblings(".invalid-feedback").append(error);
    //             error.insertAfter(element.parent());
    //         } else {
    //             error.insertAfter(element);
    //         }
    //     },

    // });
    // $select.on('change', function() {
    //     $(this).trigger('blur');
    // });
    // $select.on('select2:select', function() {
    //     $(this).trigger('blur');
    // });
    // $("#modal_form_guardar").validate({
    //     lang: 'es',
    //     debug: true,
    //     ignore: '.select2-input, .select2-focusser',
    // });

    // $select.rules('add', {
    //     required: true,
    //     messages: {
    //         required: "Seleccione una Opcion"
    //     }
    // });

    fecha_custom();

    fn_guardar();

});






function fn_guardar() {


    //obteniendo la url
    var form = $("#modal_form_guardar");
    var url = form.attr('action');

    $('#btn_guardar').on('click', function(e) {
        e.preventDefault();
        var data = form.serialize();
        var dataj = form.serializeArray();
        console.log(JSON.stringify(dataj, null, "  "));
        return new Promise(function() {
            $.confirm({
                icon: 'fa fa-warning',
                title: '¿Confirma continuar?',
                theme: 'modern',
                content: '¿Confirma guardar?',
                type: 'orange',
                typeAnimated: true,
                closeIcon: true,
                closeIconClass: 'fa fa-close',
                buttons: {
                    cancel: {
                        text: 'Cancelar',
                        action: function() {}
                    },
                    ok: {
                        text: 'Si , Guardar!',
                        btnClass: 'btn-success',
                        keys: ['enter'],
                        action: function() {
                            $.alert({
                                theme: 'modern',
                                typeAnimated: true,
                                content: function() {
                                    var self = this;
                                    return $.ajax({
                                        url: url,
                                        dataType: "json",
                                        type: 'post',
                                        data: data
                                    }).then(function(data) {
                                        if (data.status === 'ok') {
                                            self.setContent(data.message);
                                            self.setTitle(data.titulo);
                                            self.setIcon('far fa-check-circle');
                                            self.setType('green');
                                            self.buttons.ok.removeClass('d-none');
                                            self.buttons.cancel.addClass('d-none');

                                        } else {
                                            self.setContent(data.message);
                                            self.setTitle(data.titulo);
                                            self.setIcon('fa fa-warning');
                                            self.setType('orange');
                                            self.buttons.ok.addClass('d-none');
                                            self.buttons.cancel.removeClass('d-none');
                                        }

                                    }).fail(function(reason) {
                                        var name_error = '';
                                        var mensaje_error = '';
                                        if (reason.responseJSON) {
                                            if (reason.responseJSON.exception) {
                                                name_error = reason.responseJSON.exception;
                                            }
                                            if (reason.responseJSON.message) {
                                                mensaje_error = reason.responseJSON.message;
                                            }
                                        }
                                        self.setContent(mensaje_error);
                                        self.setTitle('Error ' + name_error);
                                        self.setIcon('far fa-times-circle');
                                        self.setType('red');
                                        self.buttons.ok.addClass('d-none');
                                        self.buttons.cancel.removeClass('d-none');
                                    });
                                },
                                buttons: {
                                    ok: {
                                        text: 'OK',
                                        action: function() {

                                        }
                                    },
                                    cancel: {
                                        text: 'OK',
                                        action: function() {

                                        }
                                    }
                                }
                            });
                        }
                    }
                }
            });
        });

    });

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