 <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3> <small></small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">




                </div>
              </div>
            </div>
            
            <div class="clearfix"></div>

              <div class="col-md-12 col-xs-12 col-xs-12">


                  <?php
                  $openTag=false;
                  $arrayMenu=$this->session->userdata('menuUsuario');
                  for($i=0;$i<count($arrayMenu);$i++){
                  if($arrayMenu[$i]['id_modulo']=='E'){
                  if($i>0 and ($arrayMenu[$i]['id_menu']!=$arrayMenu[$i-1]['id_menu'])){
                      if($openTag==true){
                          echo '</ul></li>';
                          $openTag=false;
                      }

                      ?>
                      <?php
                  }
                  if($arrayMenu[$i]['url']==''){

                  if($openTag==false){
                  ?>


                      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                          <a href="<?php echo site_url($arrayMenu[$i]["urlSubmenu"]); ?>">
                              <div class="tile-stats">
                                  <div class="icon"><i class="<?php echo $arrayMenu[$i]['class_icono']; ?>"></i></div>
                                  <div class="count"> &nbsp;</div>
                                  <h4 style="font-size:14px; font-weight: bold; "><center><?php echo $arrayMenu[$i]["nombreSubmenu"] ?> </center></h4>
                                  <p><?php echo $arrayMenu[$i]['nombre']; ?></p>
                              </div>
                          </a>
                      </div>



                      <?php
                          $openTag=true;
                          }
                          else{
                              ?>

                              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                  <a href="<?php echo site_url($arrayMenu[$i]["urlSubmenu"]); ?>">
                                      <div class="tile-stats">
                                          <div class="icon"><i class="<?php echo $arrayMenu[$i]['class_icono']; ?>"></i></div>
                                          <div class="count"> &nbsp;</div>
                                          <h4 style="font-size:14px; font-weight: bold; "><center><?php echo $arrayMenu[$i]["nombreSubmenu"] ?> </center></h4>
                                          <p><?php echo $arrayMenu[$i]['nombre']; ?></p>
                                      </div>
                                  </a>
                              </div>


                              <?php
                          }
                          }
                          else{
                              ?>

                              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                  <a href="<?php echo site_url($arrayMenu[$i]["url"]); ?>">
                                      <div class="tile-stats">
                                          <div class="icon"><i class="<?php echo $arrayMenu[$i]['class_icono']; ?>"></i></div>
                                          <div class="count"> &nbsp;</div>
                                          <h4 style="font-size:14px; font-weight: bold; "><center><?php echo $arrayMenu[$i]['nombre']; ?></center></h4>
                                          <p><?php echo $arrayMenu[$i]["nombreSubmenu"] ?></p>
                                      </div>
                                  </a>
                              </div>

                              <?php
                          }
                          }
                          }
                          ?>



              </div>


          </div>
        </div>
        <!-- /page content -->
