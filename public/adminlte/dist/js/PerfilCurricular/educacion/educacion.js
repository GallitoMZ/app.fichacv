$(document).ready(function() {

    $('.select2').select2({
        theme: 'bootstrap',
    });

    $("#tabla_estudios").DataTable({
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        "paging": true,
        "pageLength": 10,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "responsive": true,
    });

    $("#tabla_idiomas").DataTable({
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        "paging": true,
        "pageLength": 10,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "responsive": true,
    });

    $("#tabla_intereses").DataTable({
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        "paging": true,
        "pageLength": 10,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": false,
        "autoWidth": false,
        "responsive": true,
    });

});

function fn_agregar_estudio() {

    $("#modal-agregar-estudio").modal("toggle");


    //obteniendo la url
    var form = $("#modal_form_agregar_estudio");
    var url = form.attr('action');

    $('#modal_form_agregar_estudio').off('submit').on('submit', function(e) {
        e.preventDefault();
        var data = form.serialize();

        return new Promise(function() {
            $.confirm({
                icon: 'fa fa-warning',
                title: '¿Confirma continuar?',
                theme: 'modern',
                content: '¿Confirma guardar la estudio?',
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
                                            // $('#table_cargos').DataTable().ajax.reload();
                                            $("#modal-agregar-estudio").modal("hide");
                                            window.location.reload();
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





function fn_eliminar_estudio(id) {
    $('[data-toggle="tooltip"], .tooltip').tooltip("hide");

    var form = $("#form-eliminar-estudio");
    var url = form.attr('action');
    $("#estudio_id").val(id);
    var data = form.serialize();

    return new Promise(function() {
        $.confirm({
            icon: 'fa fa-warning',
            title: '¿Confirma continuar?',
            theme: 'modern',
            content: '¿Confirma eliminar el estudio?',
            type: 'orange',
            animationBounce: 1.5,
            closeAnimation: 'right',
            typeAnimated: true,
            closeIcon: true,
            closeIconClass: 'fa fa-close',
            buttons: {
                cancel: {
                    text: 'Cancelar',
                    action: function() {
                        setTimeout(function() {
                            $('[data-toggle="tooltip"], .tooltip').tooltip("hide");
                        }, 400);
                    }
                },
                ok: {
                    text: 'Si , Eliminar!',
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
                                        $('[data-toggle="tooltip"], .tooltip').tooltip("hide");
                                        window.location.reload();

                                    }
                                },
                                cancel: {
                                    text: 'OK',
                                    action: function() {
                                        $('[data-toggle="tooltip"], .tooltip').tooltip("hide");
                                    }
                                }
                            }
                        });
                    }
                }
            }
        });
    });
}

function fn_agregar_idioma() {

    $("#modal-agregar-idioma").modal("toggle");


    //obteniendo la url
    var form = $("#modal_form_agregar_idioma");
    var url = form.attr('action');

    $('#modal_form_agregar_idioma').off('submit').on('submit', function(e) {
        e.preventDefault();
        var data = form.serialize();

        return new Promise(function() {
            $.confirm({
                icon: 'fa fa-warning',
                title: '¿Confirma continuar?',
                theme: 'modern',
                content: '¿Confirma guardar la idioma?',
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
                                            // $('#table_cargos').DataTable().ajax.reload();
                                            $("#modal-agregar-idioma").modal("hide");
                                            window.location.reload();
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


function fn_eliminar_idioma(id) {
    $('[data-toggle="tooltip"], .tooltip').tooltip("hide");

    var form = $("#form-eliminar-idioma");
    var url = form.attr('action');
    $("#idioma_elim_id").val(id);
    var data = form.serialize();

    return new Promise(function() {
        $.confirm({
            icon: 'fa fa-warning',
            title: '¿Confirma continuar?',
            theme: 'modern',
            content: '¿Confirma eliminar el idioma?',
            type: 'orange',
            animationBounce: 1.5,
            closeAnimation: 'right',
            typeAnimated: true,
            closeIcon: true,
            closeIconClass: 'fa fa-close',
            buttons: {
                cancel: {
                    text: 'Cancelar',
                    action: function() {
                        setTimeout(function() {
                            $('[data-toggle="tooltip"], .tooltip').tooltip("hide");
                        }, 400);
                    }
                },
                ok: {
                    text: 'Si , Eliminar!',
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
                                        $('[data-toggle="tooltip"], .tooltip').tooltip("hide");
                                        window.location.reload();

                                    }
                                },
                                cancel: {
                                    text: 'OK',
                                    action: function() {
                                        $('[data-toggle="tooltip"], .tooltip').tooltip("hide");
                                    }
                                }
                            }
                        });
                    }
                }
            }
        });
    });
}

function fn_agregar_interes() {

    $("#modal-agregar-interes").modal("toggle");


    //obteniendo la url
    var form = $("#modal_form_agregar_interes");
    var url = form.attr('action');

    $('#modal_form_agregar_interes').off('submit').on('submit', function(e) {
        e.preventDefault();
        var data = form.serialize();

        return new Promise(function() {
            $.confirm({
                icon: 'fa fa-warning',
                title: '¿Confirma continuar?',
                theme: 'modern',
                content: '¿Confirma guardar la interes?',
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
                                            // $('#table_cargos').DataTable().ajax.reload();
                                            $("#modal-agregar-interes").modal("hide");
                                            window.location.reload();
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

function fn_eliminar_interes(id) {
    $('[data-toggle="tooltip"], .tooltip').tooltip("hide");

    var form = $("#form-eliminar-interes");
    var url = form.attr('action');
    $("#interes_elim_id").val(id);
    var data = form.serialize();

    return new Promise(function() {
        $.confirm({
            icon: 'fa fa-warning',
            title: '¿Confirma continuar?',
            theme: 'modern',
            content: '¿Confirma eliminar el interes?',
            type: 'orange',
            animationBounce: 1.5,
            closeAnimation: 'right',
            typeAnimated: true,
            closeIcon: true,
            closeIconClass: 'fa fa-close',
            buttons: {
                cancel: {
                    text: 'Cancelar',
                    action: function() {
                        setTimeout(function() {
                            $('[data-toggle="tooltip"], .tooltip').tooltip("hide");
                        }, 400);
                    }
                },
                ok: {
                    text: 'Si , Eliminar!',
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
                                        $('[data-toggle="tooltip"], .tooltip').tooltip("hide");
                                        window.location.reload();

                                    }
                                },
                                cancel: {
                                    text: 'OK',
                                    action: function() {
                                        $('[data-toggle="tooltip"], .tooltip').tooltip("hide");
                                    }
                                }
                            }
                        });
                    }
                }
            }
        });
    });
}