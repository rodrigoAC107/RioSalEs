function obtenerValorAlergia(datos) {
    var id = document.getElementById('alergiaId');
    var legajo = document.getElementById('alergiaLegajo');
    var tipo = document.getElementById('alergiaTipo');
    var observacion = document.getElementById('alergiaObservacion');
    id.value = datos['id'];
    legajo.value = datos['legajo_id'];
    tipo.value = datos['tipo'];
    observacion.value = datos['observacion'];
};

function obtenerValorDieta(datos) {
    var id = document.getElementById('dietaId');
    var legajo = document.getElementById('dietaLegajo');
    var tipo_1 = document.getElementById('dietaTipo');
    var tipo_2 = document.getElementById('dietaTipo2');
    var comidas_permitidas = document.getElementById('dietacomidas_permitidas');
    var comidas_no_permitidas = document.getElementById('dietacomidas_no_permitidas');
    id.value = datos['id'];
    legajo.value = datos['legajo_id'];
    tipo_1.value = datos['tipo_1'];
    tipo_2.value = datos['tipo_2'];
    comidas_permitidas.value = datos['comidas_permitidas'];
    comidas_no_permitidas.value = datos['comidas_no_permitidas'];
};

function obtenerValorFamiliar(datos) {
    var id = document.getElementById('familiarId');
    var legajo = document.getElementById('familiarLegajo');
    var tipo = document.getElementById('familiarTipo');
    var observacion = document.getElementById('familiarObservacion');
    id.value = datos['id'];
    legajo.value = datos['legajo_id'];
    tipo.value = datos['tipo'];
    observacion.value = datos['observacion'];
};

function obtenerValorEmpleado(datos) {
    console.log(datos);
    var id = document.getElementById('empleadoId');
    var legajo = document.getElementById('empleadoLegajo');
    var tipo = document.getElementById('empleadoTipo');
    var observacion = document.getElementById('empleadoObservacion');
    id.value = datos['id'];
    legajo.value = datos['legajo_id'];
    tipo.value = datos['tipo'];
    observacion.value = datos['observacion'];
};

function obtenerValorHabito(datos) {
    console.log(datos);
    var id = document.getElementById('habitoId');
    var legajo = document.getElementById('habitoLegajo');
    var observacion = document.getElementById('habitoObservacion');
    id.value = datos['id'];
    legajo.value = datos['legajo_id'];
    observacion.value = datos['observacion'];
};