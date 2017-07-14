$('#sig_fichasocialbundle_domicilio_calle').autocomplete({
    minlength: 1,
    autoFocus: true,
    source: function( request, response ) {
        $.ajax({
            url: 'http://sig.emprendequillota.cl/interno/modulos/jstore/Via.php',
            dataType: "json",
            data: {
                query: request.term,
            },
            success: function( data ) {
                response( $.map( data, function( item ) {
                    return {
                        label: item.nombre,
                        value: item.nombre
                    }
                }));
            },
            select: function(event, ui) { 
                $(this).val(ui.item.nombre);
                return false;
            },
        });
    },
});
$('#sig_fichasocialbundle_domicilio_poblacion').autocomplete({
    minlength: 1,
    autoFocus: true,
    source: function( request, response ) {
        $.ajax({
            url: 'http://sig.emprendequillota.cl/interno/modulos/jstore/ConjResidencial.php',
            dataType: "json",
            data: {
                query: request.term,
            },
            success: function( data ) {
                response( $.map( data, function( item ) {
                    return {
                        label: item.nombre,
                        value: item.nombre
                    }
                }));
            },
            select: function(event, ui) { 
                $(this).val(ui.item.nombre);
                return false;
            },
        });
    },
});
$('#sig_fichasocialbundle_domicilio_edificio').autocomplete({
    minlength: 1,
    autoFocus: true,
    source: function( request, response ) {
        $.ajax({
            url: 'http://sig.emprendequillota.cl/interno/modulos/jstore/Edificio.php',
            dataType: "json",
            data: {
                query: request.term,
            },
            success: function( data ) {
                response( $.map( data, function( item ) {
                    return {
                        label: item.nombre,
                        value: item.nombre
                    }
                }));
            },
            select: function(event, ui) { 
                $(this).val(ui.item.nombre);
                return false;
            },
        });
    },
});
$('#sig_fichasocialbundle_domicilio_departamento').autocomplete({
    minlength: 1,
    autoFocus: true,
    source: function( request, response ) {
        $.ajax({
            url: 'http://sig.emprendequillota.cl/interno/modulos/jstore/Depto.php',
            dataType: "json",
            data: {
                query: request.term,
            },
            success: function( data ) {
                response( $.map( data, function( item ) {
                    return {
                        label: item.nombre,
                        value: item.nombre
                    }
                }));
            },
            select: function(event, ui) { 
                $(this).val(ui.item.nombre);
                return false;
            },
        });
    },
});
$('#sig_fichasocialbundle_domicilio_casa').autocomplete({
    minlength: 1,
    autoFocus: true,
    source: function( request, response ) {
        $.ajax({
            url: 'http://sig.emprendequillota.cl/interno/modulos/jstore/CasaLocalBodega.php',
            dataType: "json",
            data: {
                query: request.term,
            },
            success: function( data ) {
                response( $.map( data, function( item ) {
                    return {
                        label: item.nombre,
                        value: item.nombre
                    }
                }));
            },
            select: function(event, ui) { 
                $(this).val(ui.item.nombre);
                return false;
            },
        });
    },
});
$('#sig_fichasocialbundle_domicilio_chacra').autocomplete({
    minlength: 1,
    autoFocus: true,
    source: function( request, response ) {
        $.ajax({
            url: 'http://sig.emprendequillota.cl/interno/modulos/jstore/Chacra.php',
            dataType: "json",
            data: {
                query: request.term,
            },
            success: function( data ) {
                response( $.map( data, function( item ) {
                    return {
                        label: item.nombre,
                        value: item.nombre
                    }
                }));
            },
            select: function(event, ui) { 
                $(this).val(ui.item.nombre);
                return false;
            },
        });
    },
});
$('#sig_fichasocialbundle_domicilio_parcela').autocomplete({
    minlength: 1,
    autoFocus: true,
    source: function( request, response ) {
        $.ajax({
            url: 'http://sig.emprendequillota.cl/interno/modulos/jstore/Parcela.php',
            dataType: "json",
            data: {
                query: request.term,
            },
            success: function( data ) {
                response( $.map( data, function( item ) {
                    return {
                        label: item.nombre,
                        value: item.nombre
                    }
                }));
            },
            select: function(event, ui) { 
                $(this).val(ui.item.nombre);
                return false;
            },
        });
    },
});
$('#sig_fichasocialbundle_domicilio_paradero').autocomplete({
    minlength: 1,
    autoFocus: true,
    source: function( request, response ) {
        $.ajax({
            url: 'http://sig.emprendequillota.cl/interno/modulos/jstore/ParaderoKm.php',
            dataType: "json",
            data: {
                query: request.term,
            },
            success: function( data ) {
                response( $.map( data, function( item ) {
                    return {
                        label: item.nombre,
                        value: item.nombre
                    }
                }));
            },
            select: function(event, ui) { 
                $(this).val(ui.item.nombre);
                return false;
            },
        });
    },
});
$('#sig_fichasocialbundle_domicilio_sector').autocomplete({
    minlength: 1,
    autoFocus: true,
    source: function( request, response ) {
        $.ajax({
            url: 'http://sig.emprendequillota.cl/interno/modulos/jstore/Sector.php',
            dataType: "json",
            data: {
                query: request.term,
            },
            success: function( data ) {
                response( $.map( data, function( item ) {
                    return {
                        label: item.nombre,
                        value: item.nombre
                    }
                }));
            },
            select: function(event, ui) { 
                $(this).val(ui.item.nombre);
                return false;
            },
        });
    },
});
$('#sig_fichasocialbundle_domicilio_rol').autocomplete({
    minlength: 0,
    autoFocus: true,
    source: function( request, response ) {

        var via_id = $('#sig_fichasocialbundle_domicilio_calle').val();
        var numero = $('#sig_fichasocialbundle_domicilio_numero').val();
        var conj_residencial_id = $('#sig_fichasocialbundle_domicilio_poblacion').val();
        var edificioblock_id = $('#sig_fichasocialbundle_domicilio_edificio').val();
        var depto_id = $('#sig_fichasocialbundle_domicilio_departamento').val();
        var casabodegalocal_id = $('#sig_fichasocialbundle_domicilio_casa').val();
        var chacra_id = $('#sig_fichasocialbundle_domicilio_chacra').val();
        var parcela_id = $('#sig_fichasocialbundle_domicilio_parcela').val();
        var paraderokm_id = $('#sig_fichasocialbundle_domicilio_paradero').val();
        var sector_id = $('#sig_fichasocialbundle_domicilio_sector').val();

        via_id = (via_id != '') ? via_id : 'null';
        numero = (numero != '') ? numero : 'null';
        conj_residencial_id = (conj_residencial_id != '') ? conj_residencial_id : 'null';
        edificioblock_id = (edificioblock_id != '') ? edificioblock_id : 'null';
        depto_id = (depto_id != '') ? depto_id : 'null';
        casabodegalocal_id = (casabodegalocal_id != '') ? casabodegalocal_id : 'null';
        chacra_id = (chacra_id != '') ? chacra_id : 'null';
        parcela_id = (parcela_id != '') ? parcela_id : 'null';
        paraderokm_id = (paraderokm_id != '') ? paraderokm_id : 'null';
        sector_id = (sector_id != '') ? sector_id : 'null';

        $.ajax({
            url: 'http://sig.emprendequillota.cl/interno/modulos/jstore/RolxDireccion.php',
            dataType: "json",
            data: {
                via_id: via_id,
                numero: numero,
                conj_residencial_id: conj_residencial_id,
                edificioblock_id: edificioblock_id,
                depto_id: depto_id,
                casabodegalocal_id: casabodegalocal_id,
                chacra_id: chacra_id,
                parcela_id: parcela_id,
                paraderokm_id: paraderokm_id,
                sector_id: sector_id,
            },
            success: function( data ) {
                response( $.map( data, function( item ) {
                    return {
                        label: item.rol,
                        value: item.rol,
                        id: item.id,
                    }
                }));
            },
        });
    },
    select: function (event, ui) {
        $('#sig_fichasocialbundle_domicilio_rolId').val(ui.item.id);
        $(this).val(ui.item.value);
        var id = $('#sig_fichasocialbundle_domicilio_rolId').val();
        $.ajax({
            url: 'http://sig.emprendequillota.cl/interno/modulos/jstore/DireccionXId.php',
            dataType: "json",
            data: {
                query: id,
                limit: 100,
            },
            success: function( data ) {
                direccion = $.map( data, function( item ) {
                    return {
                        numero: item.numero,
                        calle: item.via,
                        poblacion: item.conjresidencial,
                        parcela: item.parcela,
                        chacra: item.chacra,
                        paradero: item.paradero,
                        sector: item.sector,
                        casa: item.casa,
                        edificio: item.edificio,
                        departamento: item.depto,
                        id: item.id,
                    }
                });
                $('#sig_fichasocialbundle_domicilio_calle').val(direccion[0].calle);
                $('#sig_fichasocialbundle_domicilio_numero').val(direccion[0].numero);
                $('#sig_fichasocialbundle_domicilio_poblacion').val(direccion[0].poblacion);
                $('#sig_fichasocialbundle_domicilio_edificio').val(direccion[0].edificio);
                $('#sig_fichasocialbundle_domicilio_departamento').val(direccion[0].departamento);
                $('#sig_fichasocialbundle_domicilio_casa').val(direccion[0].casa);
                $('#sig_fichasocialbundle_domicilio_chacra').val(direccion[0].chacra);
                $('#sig_fichasocialbundle_domicilio_parcela').val(direccion[0].parcela);
                $('#sig_fichasocialbundle_domicilio_paradero').val(direccion[0].paradero);
                $('#sig_fichasocialbundle_domicilio_sector').val(direccion[0].sector);
            },
        });
    },
});

$('#sig_fichasocialbundle_domicilio_rolId').change( function() {
    var id = $('#sig_fichasocialbundle_domicilio_rolId').val();
    $.ajax({
        url: 'http://sig.emprendequillota.cl/interno/modulos/jstore/DireccionXId.php',
        dataType: "json",
        data: {
            query: id,
            limit: 100,
        },
        success: function( data ) {
            direccion = $.map( data, function( item ) {
                return {
                    numero: item.numero,
                    calle: item.via,
                    poblacion: item.conjresidencial,
                    parcela: item.parcela,
                    chacra: item.chacra,
                    paradero: item.paradero,
                    sector: item.sector,
                    casa: item.casa,
                    edificio: item.edificio,
                    departamento: item.depto,
                    id: item.id,
                }
            });
            $('#sig_fichasocialbundle_domicilio_calle').val(direccion[0].calle);
            $('#sig_fichasocialbundle_domicilio_numero').val(direccion[0].numero);
            $('#sig_fichasocialbundle_domicilio_poblacion').val(direccion[0].poblacion);
            $('#sig_fichasocialbundle_domicilio_edificio').val(direccion[0].edificio);
            $('#sig_fichasocialbundle_domicilio_departamento').val(direccion[0].departamento);
            $('#sig_fichasocialbundle_domicilio_casa').val(direccion[0].casa);
            $('#sig_fichasocialbundle_domicilio_chacra').val(direccion[0].chacra);
            $('#sig_fichasocialbundle_domicilio_parcela').val(direccion[0].parcela);
            $('#sig_fichasocialbundle_domicilio_paradero').val(direccion[0].paradero);
            $('#sig_fichasocialbundle_domicilio_sector').val(direccion[0].sector);
        },
    });
});
/*
$('#sig_fichasocialbundle_domicilio_rol').on('autocompleteselect', function (event, ui) {
    $('#sig_fichasocialbundle_domicilio_rolId').val(ui.item.id);
    $(this).val(ui.item.value);
    return false;
});*/