/*
$('#kore_agentbundle_domicilio_buscar').click(function(){
    var via_id = $('#kore_agentbundle_domicilio_calle').val();
    var numero = $('#kore_agentbundle_domicilio_numero').val();
    var conj_residencial_id = $('#kore_agentbundle_domicilio_poblacion').val();
    var edificioblock_id = $('#kore_agentbundle_domicilio_edificio').val();
    var depto_id = $('#kore_agentbundle_domicilio_departamento').val();
    var casabodegalocal_id = $('#kore_agentbundle_domicilio_casa').val();
    var chacra_id = $('#kore_agentbundle_domicilio_chacra').val();
    var parcela_id = $('#kore_agentbundle_domicilio_parcela').val();
    var paraderokm_id = $('#kore_agentbundle_domicilio_paradero').val();
    var sector_id = $('#kore_agentbundle_domicilio_sector').val();

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

    data = {
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
    };

    $.get('http://sig.emprendequillota.cl/interno/modulos/jstore/RolxDireccion.php', data, function(result) {
        tabla = '<table class="table table-responsive table-roles table-bordered"><thead><tr><th>Dirección</th><th>Rol</th><th>Seleccionar</th></tr></thead><tbody id="kore_agentbundle_domicilio_direcciones"></tbody></table>';
        $('#kore_agentbundle_domicilio_tablaroles').html(tabla);

        result = jQuery.parseJSON(result);
        var id;
        var rol;
        var script;
        var row;
        for(var k in result) {
            id = result[k].id;
            rol = result[k].rol;
            row = '<tr><td>' + id + '</td><td>' + rol + '</td><td><button type="button" class="btn btn-success btn-xs btn-block btn-rol" rolid="' + id + '" rol="' + rol + '" onclick="setRol(this)">Seleccionar</button></td></tr>';
            $('#kore_agentbundle_domicilio_direcciones').append(row);
        }
    });
});
*/
$(function () { $('[data-toggle="tooltip"]').tooltip() })

$('#kore_agentbundle_domicilio_buscar_submit').click(function(){
    var direccion = $('#kore_agentbundle_domicilio_buscar').val();
    data = {
        query: direccion,
        start: 0,
        limit: 100,
        page: 1,
    };

    $.get('http://sig.emprendequillota.cl/jstore/general/direccion.php', data, function(result) {
        tabla = '<table class="table table-responsive table-middle table-condensed table-bordered"><thead><tr><th>Dirección</th><th>Rol</th><th><button type="button" class="btn btn-default btn-xs disabled"><span class="fa fa-arrow-right fa-fw"></span></button></th></tr></thead><tbody id="kore_agentbundle_domicilio_direcciones"></tbody></table>';
        $('#kore_agentbundle_domicilio_tablaroles').html(tabla);
        result = jQuery.parseJSON(result);
        for(var k in result.data) {
            direccion = result.data[k].Direcciones;
            rol = result.data[k].rol;
            row = '<tr><td>' + direccion + '</td><td>' + rol + '</td><td><button type="button" class="btn btn-success btn-xs btn-rol" onclick="setDireccion(\''+rol+'\',\''+direccion+'\')"><span class="fa fa-arrow-right fa-fw"></span></button></td></tr>';
            $('#kore_agentbundle_domicilio_direcciones').append(row);
        }
    });
});

function setDireccion(rol, direccion){
    $('#kore_agentbundle_domicilio_rol').val(rol);
    $('#kore_agentbundle_domicilio_direccion').val(direccion);
}

function setRol(button){
    var rol = $(button).attr('rol');
    var id = $(button).attr('rolid')
    $('#kore_agentbundle_domicilio_rolid').val(id);
    $('#kore_agentbundle_domicilio_rol').val(rol);
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
            $('#kore_agentbundle_domicilio_calle').val(direccion[0].calle);
            $('#kore_agentbundle_domicilio_numero').val(direccion[0].numero);
            $('#kore_agentbundle_domicilio_poblacion').val(direccion[0].poblacion);
            $('#kore_agentbundle_domicilio_edificio').val(direccion[0].edificio);
            $('#kore_agentbundle_domicilio_departamento').val(direccion[0].departamento);
            $('#kore_agentbundle_domicilio_casa').val(direccion[0].casa);
            $('#kore_agentbundle_domicilio_chacra').val(direccion[0].chacra);
            $('#kore_agentbundle_domicilio_parcela').val(direccion[0].parcela);
            $('#kore_agentbundle_domicilio_paradero').val(direccion[0].paradero);
            $('#kore_agentbundle_domicilio_sector').val(direccion[0].sector);
        },
    });
}

$('#kore_agentbundle_domicilio_calle').autocomplete({
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

$('#kore_agentbundle_domicilio_poblacion').autocomplete({
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

$('#kore_agentbundle_domicilio_edificio').autocomplete({
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

$('#kore_agentbundle_domicilio_departamento').autocomplete({
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

$('#kore_agentbundle_domicilio_casa').autocomplete({
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

$('#kore_agentbundle_domicilio_chacra').autocomplete({
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

$('#kore_agentbundle_domicilio_parcela').autocomplete({
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

$('#kore_agentbundle_domicilio_paradero').autocomplete({
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

$('#kore_agentbundle_domicilio_sector').autocomplete({
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
