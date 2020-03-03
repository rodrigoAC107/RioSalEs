// Call the dataTables jQuery plugin
// $(document).ready(function() {
//   $('#dataTable').DataTable();
// });

//Funcion para el lenguaje de la libreria dataTable sea en español

$(document).ready(function() {
    $('#dataTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        }
    });
    $(document).ready(function() {
        $('#example').DataTable({
            "order": [
                [3, "desc"]
            ],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
        });
    });
});