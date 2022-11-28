<?php 
  
  require_once '../model/Model.php';

  //Appel de la classe Model
  $model = new Model;

  if (isset($_POST['id_com'])){

    if (!empty($_POST['id_com']) ) {

      $id_com = $_POST['id_com'];
      $remise = $_POST['remise'];

      if ($uptdate_data = $model->updateRemise($id_com,$remise)) {
        echo '
          <div class="alert alert-success alert-dismissible" id="msg" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h6>Remise accordée avec succès</h6>
          </div> ';
      }else{
        echo '
          <div class="alert alert-danger alert-dismissible" id="msg" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h6>Une erreur est survenu</h6>
          </div> ';
      }

    }else{

      echo '
        <div class="alert alert-danger alert-dismissible" id="msg" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h6>Cette commande est inéxistante</h6>
        </div> ';

    }
  }

  if (isset($_POST['id_val'])){

    if (!empty($_POST['id_val']) ) {

      $id_com = $_POST['id_val'];
      $etat = 'accepte';

      if ($uptdate_data = $model->accepteVente($id_com,$etat)) {
        echo '
          <div class="alert alert-success alert-dismissible" id="msg" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h6>Vente acceptée avec succès</h6>
          </div> ';
      }else{
        echo '
          <div class="alert alert-danger alert-dismissible" id="msg" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h6>Une erreur est survenu</h6>
          </div> ';
      }

    }else{

      echo '
        <div class="alert alert-danger alert-dismissible" id="msg" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h6>Cette commande est inéxistante</h6>
        </div> ';

    }
  }

  if (isset($_POST['id_ann'])){

    if (!empty($_POST['id_ann']) ) {

      $id_com = $_POST['id_ann'];
      $etat = 'annule';

      if ($uptdate_data = $model->accepteVente($id_com,$etat)) {
        echo '
          <div class="alert alert-success alert-dismissible" id="msg" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h6>Commande annulée avec succès</h6>
          </div> ';
      }else{
        echo '
          <div class="alert alert-danger alert-dismissible" id="msg" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h6>Une erreur est survenu</h6>
          </div> ';
      }

    }else{

      echo '
        <div class="alert alert-danger alert-dismissible" id="msg" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h6>Cette commande est inéxistante</h6>
        </div> ';

    }
  }

  if (isset($_POST['id_liv'])){

    if (!empty($_POST['id_liv']) ) {

      $id_com = $_POST['id_liv'];
      $etat = 'livre';

      if ($uptdate_data = $model->accepteVente($id_com,$etat)) {
        echo '
          <div class="alert alert-success alert-dismissible" id="msg" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h6>Commande livrée avec succès</h6>
          </div> ';
      }else{
        echo '
          <div class="alert alert-danger alert-dismissible" id="msg" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h6>Une erreur est survenu</h6>
          </div> ';
      }

    }else{

      echo '
        <div class="alert alert-danger alert-dismissible" id="msg" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h6>Cette commande est inéxistante</h6>
        </div> ';

    }
  }
?>