<?php 
  require_once ('../model/connex.php'); 

  $dt = date('Y-m-d');

  $req = $bd->prepare("SELECT COUNT(*) AS nbEcole FROM ecole ");
  $req->execute();
  $res = $req->fetch();

  $req1 = $bd->prepare("SELECT COUNT(*) AS nbSection FROM section ");
  $req1->execute();
  $res1 = $req1->fetch();

  $req2 = $bd->prepare("SELECT COUNT(*) AS nbBiliotheque FROM bibiotheque ");
  $req2->execute();
  $res2 = $req2->fetch();

  $req3 = $bd->prepare("SELECT COUNT(*) AS nbClasse FROM classe ");
  $req3->execute();
  $res3 = $req3->fetch();

  $req4 = $bd->prepare("SELECT COUNT(*) AS nbEleve FROM eleve ");
  $req4->execute();
  $res4 = $req4->fetch();

  $req5 = $bd->prepare("SELECT COUNT(*) AS nbOuvrage FROM ouvrages ");
  $req5->execute();
  $res5 = $req5->fetch();

    $title = 'Esace Administration';

    require_once('include/headerAdmin.php'); 


?>

  <div id="wrapper">

    <!-- Sidebar -->

    <?php include('include/sidebarAdmin.php'); ?>
    
    <div id="content-wrapper">

      <div class="container-fluid">
        <p style="font-size: 35px">Bonjour <?php echo $username;?> !</hp>
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Tableau de Bord</a>
          </li>
        </ol>
         <div class="alert alert-success alert-dismissible" id="msg" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button>
            <i class="fa fa-bullhorn" style="font-size: 24px;"></i> <span style="font-size: 20px;">Bienvenu dans votre espace d'Administration...</span>
          </div>

        <!-- Icon Cards-->
        <div class="row">
          <div class="col-md-3 spacer" >
            <div class="card border-info o-hidden h-100">
              <div class="card-body text-info" style="margin-bottom: -30px;">
                <div class="float-left">
                  <i class="fas fa-home" style="font-size: 55px;"></i>
                </div>
                <div class="float-right">
                  <h3 style="font-size: 35px;"><?php echo $res['nbEcole'] ?></h3>
                <p class="float-right" style="font-weight: bold;"> Ecoles </p>
                </div>
              </div>
              <a class="card-footer text-info clearfix small z-10" href="gEcoles">
                <h6 class="float-left">Voir</h6>
                <h6 class="float-right">
                  <i class="fas fa-angle-right"></i>
                </h6>
              </a>
            </div>
          </div><br>
          <div class="col-md-3 spacer" >
            <div class="card border-dark o-hidden h-100">
              <div class="card-body text-dark" style="margin-bottom: -30px;">
                <div class="float-left">
                  <i class="fas fa-fw fa-folder" style="font-size: 55px;"></i>
                </div>
                <div class="float-right">
                  <h3 style="font-size: 35px;"><?php echo $res1['nbSection'] ?></h3>
                <p class="float-right" style="font-weight: bold;">Sections</p>
                </div>
              </div>
              <a class="card-footer text-dark clearfix small z-10" href="gSections">
                <h6 class="float-left">Voir</h6>
                <h6 class="float-right">
                  <i class="fas fa-angle-right"></i>
                </h6>
              </a>
            </div>
          </div><br>
          <div class="col-md-3 spacer" >
            <div class="card border-success o-hidden h-100">
              <div class="card-body text-success" style="margin-bottom: -30px;">
                <div class="float-left">
                  <i class="fas fa-server" style="font-size: 55px;"></i>
                </div>
                <div class="float-right">
                  <h3 style="font-size: 35px;"><?php echo $res2['nbBiliotheque'] ?></h3>
                <p class="float-right" style="font-weight: bold;">Bibliothèques</p>
                </div>
              </div>
              <a class="card-footer text-success clearfix small z-10" href="gBibliotheques">
                <h6 class="float-left">Voir</h6>
                <h6 class="float-right">
                  <i class="fas fa-angle-right"></i>
                </h6>
              </a>
            </div>
          </div><br>
          <div class="col-md-3 spacer" >
            <div class="card border-warning o-hidden h-100">
              <div class="card-body text-warning" style="margin-bottom: -30px;">
                <div class="float-left">
                  <i class="fas fa-fw fa-home" style="font-size: 55px;"></i>
                </div>
                <div class="float-right">
                  <h3 style="font-size: 35px;"><?php echo $res3['nbClasse'] ?></h3>
                <p class="float-right" style="font-weight: bold;">Classes</p>
                </div>
              </div>
              <a class="card-footer text-warning clearfix small z-10" href="gClasses">
                <h6 class="float-left">Voir</h6>
                <h6 class="float-right">
                  <i class="fas fa-angle-right"></i>
                </h6>
              </a>
            </div>
          </div><br>
          <div class="col-md-3 spacer" >
            <div class="card border-danger o-hidden h-100">
              <div class="card-body text-danger" style="margin-bottom: -30px;">
                <div class="float-left">
                  <i class="fas fa-fw fa-users" style="font-size: 55px;"></i>
                </div>
                <div class="float-right">
                  <h3 style="font-size: 35px;"><?php echo $res4['nbEleve'] ?></h3>
                <p class="float-right" style="font-weight: bold;">Elèves </p>
                </div>
              </div>
              <a class="card-footer text-danger clearfix small z-10" href="gEleves">
                <h6 class="float-left">Voir</h6>
                <h6 class="float-right">
                  <i class="fas fa-angle-right"></i>
                </h6>
              </a>
            </div>
          </div><br>
          <div class="col-md-3 spacer" >
            <div class="card border-primary o-hidden h-100">
              <div class="card-body text-primary" style="margin-bottom: -30px;">
                <div class="float-left">
                  <i class="fas fa-fw fa-book" style="font-size: 55px;"></i>
                </div>
                <div class="float-right">
                  <h3 style="font-size: 35px;"><?php echo $res5['nbOuvrage'] ?></h3>
                <p class="float-right" style="font-weight: bold;">Ouvrages</p>
                </div>
              </div>
              <a class="card-footer text-primary clearfix small z-10" href="gOuvrages">
                <h6 class="float-left">Ouvrages</h6>
                <h6 class="float-right">
                  <i class="fas fa-angle-right"></i>
                </h6>
              </a>
            </div>
          </div><br>
          
        </div>
        

      </div>
      <br>
      <!-- /.container-fluid -->

            <!-- Sticky Footer -->
      <?php include('include/footer.php'); ?>
