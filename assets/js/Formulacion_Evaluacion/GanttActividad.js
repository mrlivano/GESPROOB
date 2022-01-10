lista();
 function lista()
  {
    $.ajax({
      "url": base_url+"index.php/FEentregableEstudio/get_gantt",
      type:"POST",
      data:$(this).serialize(),
      success:function(respuesta)
      {
            //alert(respuesta);
            var registros = eval(respuesta);
            for (var i = 0; i <registros.length;i++)
            {

                         var tasks =  {
                           "data":[
                              {
                                "id":registros[i]["id"], "text":registros[i]["text"],"start_date":registros[i]["start_date"],"duration":registros[i]["duration"],"progress":0.8, "open": true}
                              ],
                          };
                          /*for (var i = 0; i <2; i++) {
                            var tasks =  {
                              "data":[
                                 {
                                   "id":registros[i]["id"], "text":registros[i]["nombre_entregable"],"start_date":registros[i]["start_date"],"parent":"12","duration":"40","progress":0.8, "open": true}
                                 ],
                             };
                          }*/


                      /*  if(i>0){
                           var tasks =  {
                             "data":[
                                {"id":registros[i]["id"], "text":registros[i]["text"], "start_date":registros[i]["start_date"], "duration":registros[i]["duration"],"parent":registros[i]["parent"], "progress":1, "open": true}
                                ],
                            };
                          }*/


                          gantt.config.work_time = true;
                          gantt.config.xml_date = "%d-%m-%Y";
                          gantt.config.start_date = new Date(2017,5, 1);
                          gantt.config.end_date = new Date(2017,5, 30);
                          gantt.init("gantt_here");
                          gantt.parse(tasks);
            };

      }
    });
  }
  var button = document.getElementById("fullscreen_button");
    button.addEventListener("click", function(){
        if (!gantt.getState().fullscreen) {
            // expanding the gantt to full screen
            gantt.expand();
        }
        else {
            // collapsing the gantt to the normal mode
            gantt.collapse();
        }
    }, false);
