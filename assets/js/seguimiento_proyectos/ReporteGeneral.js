$(document).on("ready" ,function(){

              //  ListaconsolidadoAvance();/*llamar a mi datatablet listar funcion*/
         });

var ListaconsolidadoAvance=function()
{
    var myTableUA1=$("#table-consolidadoAvance").DataTable({
    "processing":true,
    "serverSide":false,
    displayLength: 15,
    destroy:true,
    "language":idioma_espanol
    });
        new $.fn.DataTable.Buttons( myTableUA1, {
          buttons: [
            {
            "extend": "excel",
            "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span style='color:white'>Excel</span>",
            "className": "btn btn-white btn-primary btn-bold",
            "exportOptions":  {
                    columns: [ 0, 1, 2, 3,4,5,6,7,8,9,10,11,12,13 ]
                }
            },
            {
            "extend": "pdf",
            "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span style='color:white'>PDF</span>",
            "className": "btn btn-white btn-primary btn-bold",
            "exportOptions":  {
                    columns: [ 0, 1, 2, 3,4,5,6,7,8,9,10,11,12,13 ]
                },
            "orientation": 'landscape'
            }
          ]
        } );
        myTableUA1.buttons().container().appendTo( $('.tableTools-container-consolidadoAvance') );
       }
