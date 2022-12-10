<?php 
  
  require_once '../model/Model.php';

  //Appel de la classe Model
  $model = new Model;

  //Bloc d'enregstrement d'une édition
  if (isset($_POST['addEleve'])&& $_POST['addEleve'] == "addEleve" ){
    if (!empty($_POST['nomM'])&& !empty($_POST['postnomM'])&& !empty($_POST['sexeM'])&& !empty($_POST['dateNaissanceM']) ) {

      $nomM = $_POST['nomM'];
      $postnomM = $_POST['postnomM'];
      $sexeM = $_POST['sexeM'];
      $dateNaissanceM = $_POST['dateNaissanceM'];
      $lieuNaissanceM = $_POST['lieuNaissanceM'];
      $adresseM = $_POST['adresseM'];
      $telephoneM = $_POST['telephoneM'];
      $loginM = $_POST['loginM'];
      $passwordM = $_POST['passwordM'];

      $eleve_exist = $model->eleveExists($nomM,$postnomM,$sexeM,$dateNaissanceM);

      if (!empty($eleve_exist)) {
          echo '
            <div class="alert alert-info alert-dismissible" id="msg" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6>Cette édition existe déjà dans le système</h6>
            </div> ';
      }else{

        if ($insert_data = $model->insertEleve($nomM,$postnomM,$sexeM,$dateNaissanceM,$lieuNaissanceM,$adresseM,$telephoneM,$loginM,$passwordM)) {
                    
          echo '
            <div class="alert alert-success alert-dismissible" id="msg" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6>Données ajoutées avec succès</h6>
            </div> ';

        }else{

          echo '
            <div class="alert alert-danger alert-dismissible" id="msg" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6>Une erreur est survenue</h6>
            </div> ';
        }
      }
    }else{

      echo '
        <div class="alert alert-danger alert-dismissible" id="msg" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h6>Completer tous les champs</h6>
        </div> ';
    }
    
  //Bloc d'affichage du détail d'un seul élève  
  }elseif(isset($_POST['id']) && !empty($_POST['id'])){
    
    $id = $_POST['id'];

    $row = $model->getEleveSingle($id);

    if (!empty($row)) { 
      foreach($row as $data):
      ?>

      <form action="" method="post" was-validate>
        <div class="form-group" style="margin-top:-20px">
          <input type="hidden" name="idM" value="<?php echo $data['idEleve']; ?>" id="idM" class="form-control" placeholder="Id" required="required" >
        </div>
        <div class="row">
          <div class="form-group col-md-6">
          <label for="nomM">Nom Elève</label>
          <input type="text" name="nomM" value="<?php echo $data['nomEleve']; ?>" id="nomM" class="form-control" placeholder="Nom Elève" required="required" >
        </div>
        <div class="form-group col-md-6">
          <label for="postnomM">Nom Elève</label>
          <input type="text" name="postnomM" value="<?php echo $data['nomEleve']; ?>" id="postnomM" class="form-control" placeholder="Postnom ELève" required="required" >
        </div>
        <div class="form-group col-md-6">
          <label for="sexeM">Sexe</label>
          <select class="form-control" id="sexeM" name="sexeM" required>
            <option value="<?php echo $data['sexe']; ?>"><?php echo $data['sexe']; ?></option>
            <option value="M">M</option>
            <option value="F">F</option>
          </select>
        </div>
        <div class="form-group col-md-6">
          <label for="dateNaissanceM">Date Naissance</label>
          <input type="date" name="dateNaissanceM" value="<?php echo $data['dateNaissance']; ?>" id="dateNaissanceM" class="form-control" placeholder="Date Naissance" required="required" >
        </div>
        <div class="form-group col-md-6">
          <label for="lieuNaissanceM">Lieu de Naissance</label>
          <input type="text" name="lieuNaissanceM" value="<?php echo $data['lieuNaissance']; ?>" id="lieuNaissanceM" class="form-control" placeholder="Lieu Naissance" required="required" >
        </div>
        <div class="form-group col-md-6">
          <label for="adresseM">Adresse</label>
          <input type="text" name="adresseM" value="<?php echo $data['adresseEleve']; ?>" id="adresseM" class="form-control" placeholder="Adresse" required="required" >
        </div>
        <div class="form-group col-md-6">
          <label for="telephoneM">Téléphone</label>
          <input type="text" name="telephoneM" value="<?php echo $data['telephoneEleve']; ?>" id="telephoneM" class="form-control" placeholder="Téléphone" required="required" >
        </div>
        <div class="form-group col-md-6">
          <label for="loginM">Login</label>
          <input type="text" name="loginM" value="<?php echo $data['login']; ?>" id="loginM" class="form-control" placeholder="Login" required="required" >
        </div>
        <div class="form-group col-md-6">
          <label for="passwordM">Password</label>
          <input type="text" name="passwordM" value="<?php echo $data['password']; ?>" id="passwordM" class="form-control" placeholder="Date Naissance" required="required" >
        </div>
        </div>
        </div>

    <?php endforeach; 
    }

    //Bloc d'affichage des toutes les éditions de la base de données 
  
  //Bloc affichage de touts les élèves 
  }elseif (isset($_POST['showAllEleves']) && $_POST['showAllEleves'] === "showAllEleves") {
    $list_eleves = $model->getAllEleves();

    if (!empty($list_eleves)) {

      foreach ($list_eleves as $res) { ?>
                                 
        <tr style="font-size: 13px;">
          <td><?php echo $res['idEleve'] ?></td>
          <td><?php echo $res['nomEleve'] ?></td>
          <td><?php echo $res['postnomEleve'] ?></td>
          <td><?php echo $res['sexe'] ?></td>
          <td><?php echo $res['dateNaissance'] ?></td>
          <td><?php echo $res['lieuNaissance'] ?></td>
          <td><?php echo $res['adresseEleve'] ?></td>
          <td><?php echo $res['telephoneEleve'] ?></td>
          <td><?php echo $res['login'] ?></td>
          <td><?php echo $res['password'] ?></td>
          <td>
            <a href="" id="editBtn" value="<?php echo $res['idEleve'] ?>" class="btn btn-primary btn-sm " title=""><i class="fa fa-edit"></i></a> 
            <a href="" id="deleteBtn" value="<?php echo $res['idEleve'] ?>" class="btn btn-danger btn-sm " title=""><i class="fa fa-trash"></i></a> 
          </td>
        </tr>
      <?php  
      } 
    }else{
      echo'
        <tr>
          <td colspan="9" class="text-center" headers="">
            <h3>Aucune donné trouvée !</h3>
          </td>
        </tr>
      ';
    }

    //Bloc de modification des informations d'une édition

  
  //Bloc modification d'un élève
  }elseif (isset($_POST['editEleve']) && $_POST['editEleve'] === "editEleve" && isset($_POST['idM'])){

    if (!empty(isset($_POST['idM'])) && !empty($_POST['nomM'])&& !empty($_POST['postnomM'])&& !empty($_POST['sexeM'])&& !empty($_POST['dateNaissanceM']) ) {

        $idM = $_POST['idM'];
        $nomM = $_POST['nomM'];
        $postnomM = $_POST['postnomM'];
        $sexeM = $_POST['sexeM'];
        $dateNaissanceM = $_POST['dateNaissanceM'];
        $lieuNaissanceM = $_POST['lieuNaissanceM'];
        $adresseM = $_POST['adresseM'];
        $telephoneM = $_POST['telephoneM'];
        $loginM = $_POST['loginM'];
        $passwordM = $_POST['passwordM'];

        if ($edit_data = $model->editEleve($nomM,$postnomM,$sexeM,$dateNaissanceM,$lieuNaissanceM,$adresseM,$telephoneM,$loginM,$passwordM,$idM)) {
                
            echo '
              <div class="alert alert-success alert-dismissible" id="msg" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h6>Elève modifié avec succès</h6>
              </div> ';

        }else{

          echo '
            <div class="alert alert-danger alert-dismissible" id="msg" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6>Une erreur est survenue</h6>
            </div> ';
        }
    }else{

      echo '
        <div class="alert alert-danger alert-dismissible" id="msg" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h6>Completer tous les champs</h6>
        </div> ';
    }


    //Blog de suppression d'une écokle dans la base de données 
  
  //Bloc suppression d'une édition
  }elseif (isset($_POST['supprimEleve']) && $_POST['supprimEleve'] === "supprimEleve" && isset($_POST['idS'])){

      if (!empty($_POST['idS']) ) {

        $id = $_POST['idS'];

        if ($delete_data = $model->deleteEleve($id)) {
                
          echo '
            <div class="alert alert-success alert-dismissible" id="msg" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6>Elève supprimé avec succès</h6>
            </div> ';

        }else{

          echo '
            <div class="alert alert-danger alert-dismissible" id="msg" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h6>Une erreur est survenue</h6>
            </div> ';

        }
      }else{

        echo '
          <div class="alert alert-danger alert-dismissible" id="msg" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h6>Séléctionner une édition valide</h6>
          </div> ';
      }
      
  }
    

?>