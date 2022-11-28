<?php 
  require_once ('../model/connex.php'); 

  $dt = date('Y-m-d');

  $req = $bd->prepare("SELECT COUNT(*) AS nbArticles FROM produit ");
  $req->execute();
  $res = $req->fetch();

  $req1 = $bd->prepare("SELECT COUNT(*) AS nbUsers FROM client ");
  $req1->execute();
  $res1 = $req1->fetch();

  $req2 = $bd->prepare("SELECT COUNT(*) AS nbCategorie FROM categorie ");
  $req2->execute();
  $res2 = $req2->fetch();

  $req3 = $bd->prepare("SELECT COUNT(*) AS nbCommandes FROM vente ");
  $req3->execute();
  $res3 = $req3->fetch();

  $req4 = $bd->prepare("SELECT COUNT(*) AS nbVentes FROM vente_admin ");
  $req4->execute();
  $res4 = $req4->fetch();

  $req5 = $bd->prepare("SELECT COUNT(*) AS nbEmail FROM contact ");
  $req5->execute();
  $res5 = $req5->fetch();

  $req6 = $bd->prepare("SELECT COUNT(*) AS nbAbonne FROM subscriber ");
  $req6->execute();
  $res6 = $req6->fetch();

  $req7 = $bd->prepare("SELECT COUNT(*) AS nbTemoignage FROM temoignage ");
  $req7->execute();
  $res7 = $req7->fetch();

    $title = 'Liste des produits';

    require_once('include/headerAdmin.php'); 

    $model = new Model;

    $list_command = $model->getAllVentes();


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
            <a href="../../index.php">Voir le site</a>
          </li>
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
                  <i class="fas fa-shopping-cart" style="font-size: 55px;"></i>
                </div>
                <div class="float-right">
                  <h3 style="font-size: 35px;"><?php echo $res3['nbCommandes'] ?></h3>
                <p class="float-right" style="font-weight: bold;"> Commandes </p>
                </div>
              </div>
              <a class="card-footer text-info clearfix small z-10" href="listCommandes.php">
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
                  <i class="fas fa-fw fa-laptop" style="font-size: 55px;"></i>
                </div>
                <div class="float-right">
                  <h3 style="font-size: 35px;"><?php echo $res['nbArticles'] ?></h3>
                <p class="float-right" style="font-weight: bold;">Articles</p>
                </div>
              </div>
              <a class="card-footer text-dark clearfix small z-10" href="listProduits.php">
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
                  <i class="fas fa-shopping-cart" style="font-size: 55px;"></i>
                </div>
                <div class="float-right">
                  <h3 style="font-size: 35px;"><?php echo $res4['nbVentes'] ?></h3>
                <p class="float-right" style="font-weight: bold;">Ventes</p>
                </div>
              </div>
              <a class="card-footer text-success clearfix small z-10" href="gVente.php">
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
                  <i class="fas fa-fw fa-users" style="font-size: 55px;"></i>
                </div>
                <div class="float-right">
                  <h3 style="font-size: 35px;"><?php echo $res1['nbUsers'] ?></h3>
                <p class="float-right" style="font-weight: bold;">Clients</p>
                </div>
              </div>
              <a class="card-footer text-warning clearfix small z-10" href="listClients.php">
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
                  <i class="fas fa-fw fa-folder" style="font-size: 55px;"></i>
                </div>
                <div class="float-right">
                  <h3 style="font-size: 35px;"><?php echo $res2['nbCategorie'] ?></h3>
                <p class="float-right" style="font-weight: bold;">Catégories </p>
                </div>
              </div>
              <a class="card-footer text-danger clearfix small z-10" href="gCategories.php">
                <h6 class="float-left">Voir</h6>
                <h6 class="float-right">
                  <i class="fas fa-angle-right"></i>
                </h6>
              </a>
            </div>
          </div><br>
          <div class="col-md-3 spacer" >
            <div class="card border-info o-hidden h-100">
              <div class="card-body text-info" style="margin-bottom: -30px;">
                <div class="float-left">
                  <i class="fas fa-fw fa-envelope" style="font-size: 55px;"></i>
                </div>
                <div class="float-right">
                  <h3 style="font-size: 35px;"><?php echo $res5['nbEmail'] ?></h3>
                <p class="float-right" style="font-weight: bold;">Mails</p>
                </div>
              </div>
              <a class="card-footer text-info clearfix small z-10" href="listMessages.php">
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
                  <h3 style="font-size: 35px;"><?php echo $res6['nbAbonne'] ?></h3>
                <p class="float-right" style="font-weight: bold;">Abonnés</p>
                </div>
              </div>
              <a class="card-footer text-danger clearfix small z-10" href="#">
                <h6 class="float-left"></h6>
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
                  <i class="fas fa-fw fa-inbox" style="font-size: 55px;"></i>
                </div>
                <div class="float-right">
                  <h3 style="font-size: 35px;"><?php echo $res7['nbTemoignage'] ?></h3>
                <p class="float-right" style="font-weight: bold;">Témoignages</p>
                </div>
              </div>
              <a class="card-footer text-primary clearfix small z-10" href="gTemoignage.php">
                <h6 class="float-left"></h6>
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
                  <i class="fas fa-fw fa-inbox" style="font-size: 55px;"></i>
                </div>
                <div class="float-right">
                  <h3 style="font-size: 35px;"><?php echo $res7['nbTemoignage'] ?></h3>
                <p class="float-right" style="font-weight: bold;">Articles Blog</p>
                </div>
              </div>
              <a class="card-footer text-primary clearfix small z-10" href="gBlog.php">
                <h6 class="float-left"></h6>
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
