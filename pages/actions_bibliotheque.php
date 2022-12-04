<?php 
  
  require_once '../model/Model.php';

  //Appel de la classe Model
  $model = new Model;

  //Bloc d'enregstrement d'une bibliotheque
  if (isset($_POST['add_bibliotheque']) ){

      if (!empty($_POST['libelleBibliotheque'])&& !empty($_POST['id_ecole'])) {

        $libelleBibliotheque = $_POST['libelleBibliotheque'];
        $id_ecole = $_POST['id_ecole'];

        $bibliotheque_exist = $model->bibliothequeExists($libelleBibliotheque,$id_ecole);

        if (!empty($bibliotheque_exist)) {
          echo '
            <div class="alert alert-info alert-dismissible" id="msg" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6>Cette bibliotheque existe déjà dans le système</h6>
            </div> ';
        }else{

          if ($add_data = $model->insertBibliotheque($libelleBibliotheque,$id_ecole)) {
                
            echo '
              <div class="alert alert-success alert-dismissible" id="msg" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h6>Bibliotheque ajoutée avec succès</h6>
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
    
  //Bloc d'affichage du détail d'une seule bibliotheque séléctionnée  
  }elseif(isset($_POST['id']) && !empty($_POST['id'])){
    
    $id = $_POST['id'];

    $row = $model->getBibliothequeSingle($id);

    if (!empty($row)) { 
      foreach($row as $data):
      ?>

      <form action="" method="post" was-validate>
        <div class="form-group">
          <input type="hidden" name="idM" value="<?php echo $data['idBibliotheque']; ?>" id="idM" class="form-control" placeholder="Id" required="required" >
        </div>
        <div class="form-group">
          <label for="libelleBibliothequeM">Libellé bibliotheque</label>
          <input type="text" name="libelleBibliothequeM" value="<?php echo $data['designationBibliotheque']; ?>" id="libelleBibliothequeM" class="form-control" placeholder="Libellé" required="required" >
        </div>
        <div class="form-group ">
          <label for="id_ecoleM">Ecole</label>
          <select class="form-control" id="id_ecoleM" required>
            <option value="<?php echo $data['idECole']; ?>" ><?php echo $data['designationEcole']; ?></option>
            <?php 
              $list_ecoles = $model->getAllEcoles();

              if (!empty($list_ecoles)) { 
                foreach($list_ecoles as $res):
            ?>
              <option value="<?php echo $res['idEcole'] ?>"><?php echo $res['designationEcole'] ?></option>

            <?php endforeach; 
            } ?>
          </select>
        </div>
        </div>

    <?php endforeach; 
    }

    //Bloc d'affichage des toutes les bibliotheques de la base de données 
  
  //Bloc affichage de toutes les bibliotheques 
  }elseif (isset($_POST['showAllBibliotheques']) && $_POST['showAllBibliotheques'] === "showAllBibliotheques") {
    $list_bibliotheques = $model->getAllBibliotheques();

    if (!empty($list_bibliotheques)) {

      foreach ($list_bibliotheques as $res) { ?>
                                 
        <tr style="font-size: 13px;">
          <td><?php echo $res['idBibliotheque'] ?></td>
          <td><?php echo $res['designationBibliotheque'] ?></td>
          <td><?php echo $res['designationEcole'] ?></td>
          <td>
            <a href="" id="editBtn" value="<?php echo $res['idBibliotheque'] ?>" class="btn btn-primary btn-sm " title=""><i class="fa fa-edit"></i></a> 
            <a href="" id="deleteBtn" value="<?php echo $res['idBibliotheque'] ?>" class="btn btn-danger btn-sm " title=""><i class="fa fa-trash"></i></a> 
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

    //Bloc de modification des informations d'une bibliotheque

  
  //Bloc modification d'une bibliotheque
  }elseif (isset($_POST['editBibliotheque']) && $_POST['editBibliotheque'] === "editBibliotheque" && isset($_POST['idM'])){

    if (!empty(isset($_POST['idM'])) && !empty($_POST['libelleBibliothequeM'])&& !empty($_POST['id_ecoleM']) ) {

        $idM = $_POST['idM'];
        $libelleBibliothequeM = $_POST['libelleBibliothequeM'];
        $id_ecoleM = $_POST['id_ecoleM'];

        if ($edit_data = $model->editBibliotheque($libelleBibliothequeM,$id_ecoleM,$idM)) {
                
            echo '
              <div class="alert alert-success alert-dismissible" id="msg" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h6>bibliotheque modifiée avec succès</h6>
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
  
  //Bloc suppression d'une bibliotheque
  }elseif (isset($_POST['supprimBibliotheque']) && $_POST['supprimBibliotheque'] === "supprimBibliotheque" && isset($_POST['idS'])){

      if (!empty($_POST['idS']) ) {

        $id = $_POST['idS'];

        if ($delete_data = $model->deleteBibliotheque($id)) {
                
          echo '
            <div class="alert alert-success alert-dismissible" id="msg" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6>bibliotheque supprimée avec succès</h6>
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
              <h6>Séléctionner une bibliotheque valide</h6>
          </div> ';
      }
      
  }
    

?>