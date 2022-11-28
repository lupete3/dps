<?php 
  
  require_once '../model/Model.php';

  //Appel de la classe Model
  $model = new Model;

  //Bloc d'enregstrement d'une école
  if (isset($_POST['add_ecole']) ){

      if (!empty($_POST['designation'])) {

        $designation = $_POST['designation'];
        $adresse = $_POST['adresse'];
        $typeEcole = $_POST['typeEcole'];
        $login = $_POST['login'];
        $password = $_POST['password'];

        $ecole_exist = $model->ecoleExists($designation,$login);

        if (!empty($ecole_exist)) {
          echo '
            <div class="alert alert-info alert-dismissible" id="msg" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6>Cette école existe déjà dans le système</h6>
            </div> ';
        }else{

          if ($add_data = $model->insertEcole($designation,$adresse,$typeEcole,$login,$password)) {
                
            echo '
              <div class="alert alert-success alert-dismissible" id="msg" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h6>Ecole ajoutée avec succès</h6>
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
    
  //Bloc d'affichage du détail d'une seule école séléctionnée  
  }elseif(isset($_POST['id']) && !empty($_POST['id'])){
    
    $id = $_POST['id'];

    $row = $model->getEcoleSingle($id);

    if (!empty($row)) { 
      foreach($row as $data):
      ?>

      <form action="" method="post" was-validate>
        <div class="form-group">
          <input type="hidden" name="idM" value="<?php echo $data['idEcole']; ?>" id="idM" class="form-control" placeholder="Id" required="required" >
        </div>
        <div class="form-group">
          <label for="nom">Designation</label>
          <input type="text" name="nom" value="<?php echo $data['designationEcole']; ?>" id="designationM" class="form-control" placeholder="Designation" required="required" >
        </div>
        <div class="form-group">
          <label for="email">Adresse</label>
          <input type="text" name="adresseEcoleM" value="<?php echo $data['adresseEcole']; ?>" id="adresseEcoleM" class="form-control" placeholder="Id" required="required" >
        </div>
        <div class="form-group">
          <label for="email">Login</label>
          <input type="text" name="loginM" value="<?php echo $data['login']; ?>" id="loginM" class="form-control" placeholder="Login ecole" required="required" >
        </div>
        <div class="form-group">
          <label for="email">Mot de passe</label>
          <input type="text" name="Détail" value="<?php echo $data['password']; ?>" id="passwordM" class="form-control" placeholder="Mot de passe" required="required" >
        </div>
        <div class="form-group">
          <label for="email">Type</label>
          <select class="form-control" id="typeEcoleM" required>
            <option value="<?php echo $data['type']; ?>" ><?php echo $data['type']; ?></option>
            <option value="ITM" >ITM</option>
            <option value="IEM" >IEM</option>
          </select><br>
        </div>
        </div>

    <?php endforeach; 
    }

    //Bloc d'affichage des toutes les écoles de la base de données 
  
  //Bloc affichage de toutes les écoles 
  }elseif (isset($_POST['showAllEcoles']) && $_POST['showAllEcoles'] === "showAllEcoles") {
    $list_ecoles = $model->getAllEcoles();

    if (!empty($list_ecoles)) {

      foreach ($list_ecoles as $res) { ?>
                                 
        <tr style="font-size: 13px;">
          <td><?php echo $res['idEcole'] ?></td>
          <td><?php echo $res['designationEcole'] ?></td>
          <td><?php echo $res['adresseEcole'] ?></td>
          <td><?php echo $res['login'] ?></td>
          <td><?php echo $res['password'] ?></td>
          <td><?php echo $res['type'] ?></td>
          <td>
            <a href="" id="editBtn" value="<?php echo $res['idEcole'] ?>" class="btn btn-primary btn-sm " title=""><i class="fa fa-edit"></i></a> 
            <a href="" id="deleteBtn" value="<?php echo $res['idEcole'] ?>" class="btn btn-danger btn-sm " title=""><i class="fa fa-trash"></i></a> 
          </td>
        </tr>
      <?php  
      } 
    }else{
      echo'
        <tr>
          <td colspan="6" class="text-center" headers="">
            <h3>Aucune donné trouvée !</h3>
          </td>
        </tr>
      ';
    }

    //Bloc de modification des informations d'une école

  
  //Bloc modification d'une école
  }elseif (isset($_POST['editEcole']) && $_POST['editEcole'] === "editEcole" && isset($_POST['idM'])){

    if (!empty(isset($_POST['idM'])) && !empty($_POST['designationM']) && !empty($_POST['adresseEcoleM'])&& !empty($_POST['loginM'])&& !empty($_POST['passwordM'])&& !empty($_POST['typeEcole'])) {

        $idM = $_POST['idM'];
        $designationM = $_POST['designationM'];
        $adresseEcoleM = $_POST['adresseEcoleM'];
        $loginM = $_POST['loginM'];
        $passwordM = $_POST['passwordM'];
        $typeEcole = $_POST['typeEcole'];

        if ($edit_data = $model->editEcole($designationM,$adresseEcoleM,$loginM,$passwordM,$typeEcole,$idM)) {
                
            echo '
              <div class="alert alert-success alert-dismissible" id="msg" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h6>Ecole modifiée avec succès</h6>
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
  
  //Bloc suppression d'une école
  }elseif (isset($_POST['suppimEcole']) && $_POST['suppimEcole'] === "suppimEcole" && isset($_POST['idS'])){

      if (!empty($_POST['idS']) ) {

        $id = $_POST['idS'];

        if ($delete_data = $model->deleteEcole($id)) {
                
          echo '
            <div class="alert alert-success alert-dismissible" id="msg" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6>Ecole supprimée avec succès</h6>
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
              <h6>Séléctionner une école valide</h6>
          </div> ';
      }
      
  }
    

?>