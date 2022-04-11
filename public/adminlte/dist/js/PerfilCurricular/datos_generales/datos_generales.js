$(document).ready(function() {

    var $select = $('.select2').select2({
        theme: 'bootstrap',
    });


    fecha_custom();

    fn_guardar();


    var existe_foto = $('#existe_foto_id').val();
    var texto_image = 'Seleccione Foto';
    var texto_image_2 = 'No hay foto adjunta';
    if (existe_foto.length > 0) {
        texto_image = 'Cambiar Foto';
        texto_image_2 = 'foto_adjunta.jpg';
    }

    $('#modal_form_documento_file').filestyle({
        htmlIcon: '<i class="fas fa-folder-open"></i> ',
        text: texto_image,
        btnClass: "bg-gradient-warning",
        size: "",
        placeholder: texto_image_2

    });
    document.getElementById("modal_form_documento_file").onchange = function(e) {
        // Creamos el objeto de la clase FileReader
        let reader = new FileReader();

        // Leemos el archivo subido y se lo pasamos a nuestro fileReader
        reader.readAsDataURL(e.target.files[0]);

        // Le decimos que cuando este listo ejecute el código interno
        reader.onload = function() {
            let preview = document.getElementById('preview'),
                image = document.getElementById('imagen_preview_id');

            image.src = reader.result;

            preview.innerHTML = '';
            // preview.append(image);
        };
    }
});






function fn_guardar() {


    //obteniendo la url
    var form = $("#modal_form_guardar");
    var url = form.attr('action');

    $('#btn_guardar').on('click', function(e) {
        e.preventDefault();
        // var data = form.serialize();
        var data = new FormData($('#modal_form_guardar')[0]);
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
                                        data: data,
                                        cache: false,
                                        processData: false,
                                        contentType: false
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