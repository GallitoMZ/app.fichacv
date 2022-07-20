$(document).ready(function() {



    fn_guardar_dinamica();

});






function fn_guardar_dinamica() {


    //obteniendo la url
    var form = $("#modal_form_guardar");
    var url = form.attr('action');

    $('#btn_guardar_info').on('click', function(e) {
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