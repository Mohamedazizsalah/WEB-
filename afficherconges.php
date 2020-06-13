<?PHP
include "../core/congec.php";
$congec = new congec();
$listeconges=$congec->afficherconges();

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
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  <link href="css/table-responsive.css" rel="stylesheet">

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
            <a href="javascript:;">
              <i class="fa fa-desktop"></i>
              <span>Enseignants</span>
              </a>
            <ul class="sub">
              <li><a href="afficherenseignants.php">Afficher enseignants</a></li>
              <li><a href="ajouterenseignant.php">Ajouter enseignants</a></li>
            </ul>
          </li>

          <li class="sub-menu">
            <a class="active" href="javascript:;">
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
        <h3><i class="fa fa-angle-right"></i> Liste des congés</h3>
        <div class="row mt">
          <div class="col-lg-12">
            <div class="content-panel">
              <section id="unseen">
                <table class="table table-bordered table-striped table-condensed">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Nom enseignant</th>
                      <th>Prénom enseignant</th>
                      <th>Date début congé</th>
                      <th>Date fin congé</th>
                      <th class="numeric">Durée congé</th>
                      <th class="numeric">Nbr total pour l'année</th>
                      <th class="numeric">Solde restant</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?PHP
                  foreach($listeconges as $row){
                    $result = $congec->getnomprenombyid($row['id_enseignant']);
                  ?>
                    <tr>
                      <td><?PHP echo $row['id']; ?></td>
                      <td><?PHP echo $result['nom']; ?></td>
                      <td><?PHP echo $result['prenom']; ?></td>
                      <td><?PHP echo $row['date']; ?></td>
                      <td><?PHP
                        $date1 = date($row['date']);
                        $jour = $row['duree']-1;
                        $newDate = date('Y-m-d', strtotime($date1. " + {$jour} days")); 
                        echo $newDate;
                      ?></td>
                      <td class="numeric"><?PHP echo $row['duree']; ?></td>
                      <td class="numeric"><?PHP 
                        $result = $congec->calculsoldeanneetotal($row['id_enseignant'],$row['date']);
                        echo $result["sommeconges"];
                      ?></td>
                      <td class="numeric"><?PHP echo 45-$result["sommeconges"];?></td>
                      <td class="center">
                      <form method="POST" action="supprimerconge.php">
                      <input type="hidden" value="<?PHP echo $row['id']; ?>" name="id">
                      <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash-o "></i></button>
                      </input>
                      </form>
                      </td>
                      <?php
                      $date1 = date($row['date']);
                      $date2 = date("Y-m-d");
                      if ($date1 > $date2){
                      ?>
                      <td>
                      <a href="modifierconge.php?id=<?PHP echo $row['id']; ?>">
                      <button class="btn btn-primary btn-xs">
                        <i class="fa fa-pencil "></i>
                      </button>
                      </a>
                      </td>
                      <?php
                      }
                      ?>
                    </tr>
                    <?php
                  }
                  ?>
                  </tbody>
                </table>
              </section>
            </div>
            <!-- /content-panel -->
          </div>
          <!-- /col-lg-4 -->
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
        <a href="responsive_table.html#" class="go-top">
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
</body>

</html>
