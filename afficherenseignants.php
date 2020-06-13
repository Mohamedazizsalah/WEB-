<?PHP
include "../core/enseignantc.php";
$enseignantc = new enseignantc();
$listeenseignants=$enseignantc->afficherenseignants();

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
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href="lib/advanced-datatable/css/demo_page.css" rel="stylesheet" />
  <link href="lib/advanced-datatable/css/demo_table.css" rel="stylesheet" />
  <link rel="stylesheet" href="lib/advanced-datatable/css/DT_bootstrap.css" />
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
        <h3><i class="fa fa-angle-right"></i> Liste des enseignants</h3>
        <div class="row mb">
          <!-- page start-->
          <div class="content-panel">
            <div class="adv-table">
              <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Image</th>
                    <th>Numero telephone</th>
                    <th>Disponibilité</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?PHP
                  foreach($listeenseignants as $row){
                    $class_ligne = "gradeA";
                    $class_status = "label label-success label-mini";
                    $text_status = "Disponible";
                    if ($enseignantc->verifstatusconges($row['id'])){
                      //red
                      $class_ligne = 'gradeX';
                      $class_status = "label label-danger label-mini";
                      $text_status = "En congé";
                    }
                  
                  ?>
                  <tr class="<?PHP echo $class_ligne; ?>">
                    <td><?PHP echo $row['id']; ?></td>
                    <td><?PHP echo $row['nom']; ?></td>
                    <td><?PHP echo $row['prenom']; ?></td>
                    <td><?PHP echo $row['image']; ?></td>
                    <td class="center"><?PHP echo $row['numerotel']; ?></td>
                    <td class="center"><?PHP echo $enseignantc->formatdisponibilite($row['disponibilite']); ?></td>
                    <td class="center"><span class="<?PHP echo $class_status; ?>"><?PHP echo $text_status; ?></span></td>
                    <td class="center">
                      <form method="POST" action="supprimerenseignants.php">
                      <input type="hidden" value="<?PHP echo $row['id']; ?>" name="id">
                      <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash-o "></i></button>
                      </input>
                      </form>
                    </td>
                    <td class="center">
                      <a href="modifierenseignant.php?id=<?PHP echo $row['id']; ?>">
                      <button class="btn btn-primary btn-xs">
                        <i class="fa fa-pencil "></i>
                      </button>
                      </a>
                    </td>
                  </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- page end-->
        </div>
        <!-- /row -->
      </section>
    </section>
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
        <a href="index.html#" class="go-top">
          <i class="fa fa-angle-up"></i>
          </a>
      </div>
    </footer>
    <!--footer end-->
  </section>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script src="lib/jquery.sparkline.js"></script>
  <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="lib/advanced-datatable/js/DT_bootstrap.js"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
</body>

</html>
