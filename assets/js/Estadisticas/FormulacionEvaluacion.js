function getNumProyectosNuevosEvaluacion() {
    //$.growl({ title: "Aviso", message: "Usted Tiene Proyectos Nuevos en Formulacion" });
    //   $.growl.error({ message: "The kitten is attacking!" });
    //$.growl.notice({ message: "The kitten is cute!" });
    //   $.growl.warning({ message: "The kitten is ugly!" });

    $.ajax({
        url: base_url + "index.php/PrincipalFyE/getDatosEstudiosInversionNotificacion",
        type: "POST",
        success: function (respuesta) {
            var registros = eval(respuesta);
            var panel_notificacion = $("#panel_notificacion_fe");
            var menu1_notificacion = $("#menu1_notificacion");

            var num_eval = registros[0]["num_eval"];
            var num_form = registros[0]["num_form"];
            var suma = num_eval + num_form;
            var mensaje_reloj_sup_der;
            //alert(num);

            if (suma >= 1) {
                //mostrando numero de notificaciones
                var numProyEnEvaluacionNuevos = "<span class=\"badge bg-green\">" + suma + "</span>";
                panel_notificacion.append(numProyEnEvaluacionNuevos);

                var pathArray = location.href.split( '/' );
                var protocol = pathArray[0];
                var host = pathArray[2];
                var url = protocol + '/' + host + '/' + pathArray[3]+ '/'+ 'index.php/';

                var mensaje_notificacion;

                mensaje_notificacion = ""
                    + "<li>\n"
                    + "    <a href=\""+ url+"EvaluacionFE" +"\">\n"
                    + "    <span class=\"image\">Por Evaluar</span>\n"
                    + "    <span id=\"span_reloj_mensaje_alerta\">\n"
                    + "        <span class=\"time\">"+num_eval+" Nuevos proyectos</span>\n"
                    + "    </span>\n"
                    + "         <span class=\"message\">\n"
                    + "         </span>\n"
                    + "    </a>\n"
                    + "</li>";

                menu1_notificacion.append(mensaje_notificacion);
                mensaje_notificacion = ""
                    + "<li>\n"
                    + "    <a href=\""+ url+"FEformulacion" +"\">\n"
                    + "    <span class=\"image\">En Formulacion</span>\n"
                    + "    <span id=\"span_reloj_mensaje_alerta\">\n"
                    + "        <span class=\"time\">"+num_form+" Proyectos</span>\n"
                    + "    </span>\n"
                    + "         <span class=\"message\">\n"
                    + "         </span>\n"
                    + "    </a>\n"
                    + "</li>";

                menu1_notificacion.append(mensaje_notificacion);
            }
            else {
                mensaje_reloj_sup_der = "<span class=\"time\">Sin proyectos pendientes</span>";
                menu1_notificacion.append(mensaje_reloj_sup_der);
            }
        }
    });
}

$(document).ready(function () {
    getNumProyectosNuevosEvaluacion();
});