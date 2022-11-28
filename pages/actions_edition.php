<?php 
  
  require_once '../model/Model.php';

  //Appel de la classe Model
  $model = new Model;

  //Bloc d'enregstrement d'une édition
  if (isset($_POST['add_edition']) ){

      if (!empty($_POST['libelle'])) {

        $libelle = $_POST['libelle'];

        $edition_exist = $model->editionExists($libelle);

        if (!empty($edition_exist)) {
          echo '
            <div class="alert alert-info alert-dismissible" id="msg" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6>Cette édition existe déjà dans le système</h6>
            </div> ';
        }else{

          if ($add_data = $model->insertEdition($libelle)) {
                
            echo '
              <div class="alert alert-success alert-dismissible" id="msg" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h6>edition ajoutée avec succès</h6>
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
    
  //Bloc d'affichage du détail d'une seule édition séléctionnée  
  }elseif(isset($_POST['id']) && !empty($_POST['id'])){
    
    $id = $_POST['id'];

    $row = $model->getEditionSingle($id);

    if (!empty($row)) { 
      foreach($row as $data):
      ?>

      <form action="" method="post" was-validate>
        <div class="form-group">
          <input type="hidden" name="idM" value="<?php echo $data['idEdition']; ?>" id="idM" class="form-control" placeholder="Id" required="required" >
        </div>
        <div class="form-group">
          <label for="libelleM">Libellé</label>
          <input type="text" name="libelleM" value="<?php echo $data['libelle']; ?>" id="libelleM" class="form-control" placeholder="Libellé" required="required" >
        </div>
        </div>

    <?php endforeach; 
    }

    //Bloc d'affichage des toutes les éditions de la base de données 
  
  //Bloc affichage de toutes les éditions 
  }elseif (isset($_POST['showAlleditions']) && $_POST['showAlleditions'] === "showAlleditions") {
    $list_editions = $model->getAllEditions();

    if (!empty($list_editions)) {

      foreach ($list_editions as $res) { ?>
                                 
        <tr style="font-size: 13px;">
          <td><?php echo $res['idEdition'] ?></td>
          <td><?php echo $res['libelle'] ?></td>
          <td>
            <a href="" id="editBtn" value="<?php echo $res['idEdition'] ?>" class="btn btn-primary btn-sm " title=""><i class="fa fa-edit"></i></a> 
            <a href="" id="deleteBtn" value="<?php echo $res['idEdition'] ?>" class="btn btn-danger btn-sm " title=""><i class="fa fa-trash"></i></a> 
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

    //Bloc de modification des informations d'une édition

  
  //Bloc modification d'une édition
  }elseif (isset($_POST['editEdition']) && $_POST['editEdition'] === "editEdition" && isset($_POST['idM'])){

    if (!empty(isset($_POST['idM'])) && !empty($_POST['libelleM']) ) {

        $idM = $_POST['idM'];
        $libelleM = $_POST['libelleM'];

        if ($edit_data = $model->editEdition($libelleM,$idM)) {
                
            echo '
              <div class="alert alert-success alert-dismissible" id="msg" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h6>edition modifiée avec succès</h6>
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
  }elseif (isset($_POST['suppimEdition']) && $_POST['suppimEdition'] === "suppimEdition" && isset($_POST['idS'])){

      if (!empty($_POST['idS']) ) {

        $id = $_POST['idS'];

        if ($delete_data = $model->deleteEdition($id)) {
                
          echo '
            <div class="alert alert-success alert-dismissible" id="msg" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6>edition supprimée avec succès</h6>
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