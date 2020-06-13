<?php
include "../core/enseignantc.php";
if ( isset($_POST['nom']) and isset($_POST['prenom']) and isset($_POST['numtel']) and isset($_POST['jour']) and (isset($_FILES['image_enseignant']['tmp_name']))){
    $disponibilite = "";
    foreach ($_POST['jour'] as $jour){
        $disponibilite = $disponibilite.",".$jour;
    }
    $disponibilite = substr($disponibilite,1);
    //get image type (png,jpeg ..)
    $img_type = substr($_FILES['image_enseignant']['name'],strlen($_FILES['image_enseignant']['name'])-4);
    //copy image
    $img_name = $_POST['nom'].$_POST['prenom'].$img_type;
    copy($_FILES['image_enseignant']['tmp_name'],'images/'.$img_name);
    $enseignant=new enseignant($_POST['nom'],$_POST['prenom'],$img_name,$_POST['numtel'],$disponibilite);
    $enseignantc = new enseignantc();
    $enseignantc->ajouterenseignant($enseignant);
    header('Location: afficherenseignants.php');
      
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Dashio - Bootstrap Admin Template</title>

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-fileupload/bootstrap-fileupload.css" />
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">

  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
  <section id="container">
    <!-- **********************************************************************************************************************************************************
        TOP BAR CONTENT & NOTIFICATIONS
        *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
      </div>
      <!--logo start-->
      <a href="index.html" class="logo"><b>DASH<span>IO</span></b></a>
      <!--logo end-->
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <li><a class="logout" href="login.html">Logout</a></li>
        </ul>
      </div>
    </header>
    <!--header end-->
    <!-- **********************************************************************************************************************************************************
        MAIN SIDEBAR MENU
        *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="profile.html"><img src="img/ui-sam.jpg" class="img-circle" width="80"></a></p>
          <h5 class="centered">Aziz</h5>
          <li class="mt">
            <a href="../">
              <i class="fa fa-dashboard"></i>
              <span>Acceuil</span>
              </a>
          </li>

          <li class="sub-menu">
            <a class="active" href="javascript:;">
              <i class="fa fa-desktop"></i>
              <span>Enseignants</span>
              </a>
            <ul class="sub">
              <li><a href="afficherenseignants.php">Afficher enseignants</a></li>
              <li><a href="ajouterenseignant.php">Ajouter enseignants</a></li>
            </ul>
          </li>

          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-desktop"></i>
              <span>Conges</span>
              </a>
            <ul class="sub">
              <li><a href="afficherconges.php">Afficher congé</a></li>
              <li><a href="ajouterconge.php">Ajouter congé</a></li>
            </ul>
          </li>
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--sidebar end-->
    <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Ajouter enseignant</h3>
        <!-- FORM VALIDATION -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <div class=" form">
                <form class="cmxform form-horizontal style-form" id="commentForm" method="post" action="" enctype="multipart/form-data">
                  <div class="form-group ">
                    <label for="cname" class="control-label col-lg-2">Nom</label>
                    <div class="col-lg-3">
                      <input class=" form-control" id="nom" name="nom" type="text" />
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="cemail" class="control-label col-lg-2">Prenom</label>
                    <div class="col-lg-3">
                    <input class=" form-control" id="prenom" name="prenom" type="text" />
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="curl" class="control-label col-lg-2">Numero telephone</label>
                    <div class="col-lg-2">
                      <input class="form-control " id="numtel" name="numtel" type="text"/>
                      <small> Format : 12345678 </small>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-2">Image Upload</label>
                    <div class="col-md-9">
                      <div class="fileupload fileupload-new" data-provides="fileupload"><input type="hidden">
                        <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                          <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="">
                        </div>
                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;"></div>
                        <div>
                          <span class="btn btn-theme02 btn-file">
                            <span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span>
                          <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                          <input type="file" class="default" name="image_enseignant">
                          </span>
                          <a href="advanced_form_components.html#" class="btn btn-theme04 fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Remove</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group ">
                    <label for="ccomment" class="control-label col-lg-2">Disponibilité(s)</label>
                    <div class="col-lg-10">
                        <label class="checkbox-inline">
                        <input type="checkbox" id="jour" name="jour[]" value="Lundi"> Lundi
                        </label>
                        <label class="checkbox-inline">
                        <input type="checkbox" id="jour" name="jour[]" value="Mardi"> Mardi
                        </label>
                        <label class="checkbox-inline">
                        <input type="checkbox" id="jour" name="jour[]" value="Mercredi"> Mercredi
                        </label>
                        <label class="checkbox-inline">
                        <input type="checkbox" id="jour" name="jour[]" value="Jeudi"> Jeudi
                        </label>
                        <label class="checkbox-inline">
                        <input type="checkbox" id="jour" name="jour[]" value="Vendredi"> Vendredi
                        </label>
                        <label class="checkbox-inline">
                        <input type="checkbox" id="jour" name="jour[]" value="Samedi"> Samedi
                        </label>
                        <label class="checkbox-inline">
                        <input type="checkbox" id="jour" name="jour[]" value="Dimanche"> Dimanche
                        </label>
                    </div>
                  </div>
                
                  <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                      <button class="btn btn-theme" type="submit">Save</button>
                      <button class="btn btn-theme04" type="button">Cancel</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- /form-panel -->
          </div>
          <!-- /col-lg-12 -->
        </div>
        <!-- /row -->
      </section>
      <!-- /wrapper -->
    </section>
    <!-- /MAIN CONTENT -->
    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
      <div class="text-center">
        <p>
          &copy; Copyrights <strong>Dashio</strong>. All Rights Reserved
        </p>
        <div class="credits">
          <!--
            You are NOT allowed to delete the credit link to TemplateMag with free version.
            You can delete the credit link only if you bought the pro version.
            Buy the pro version with working PHP/AJAX contact form: https://templatemag.com/dashio-bootstrap-admin-template/
            Licensing information: https://templatemag.com/license/
          -->
          Created with Dashio template by <a href="https://templatemag.com/">TemplateMag</a>
        </div>
        <a href="form_validation.html#" class="go-top">
          <i class="fa fa-angle-up"></i>
          </a>
      </div>
    </footer>
    <!--footer end-->
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <!--script for this page-->
  <script type="text/javascript" src="lib/bootstrap-fileupload/bootstrap-fileupload.js"></script>
  <script src="lib/form-validation-script.js"></script>

</body>

</html>
