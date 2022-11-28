<?php 
  
  require_once '../model/Model.php';

  //Appel de la classe Model
  $model = new Model;

  //Bloc d'enregstrement d'une classe
  if (isset($_POST['add_classe']) ){

      if (!empty($_POST['libelleClasse'])&& !empty($_POST['id_section'])) {

        $libelleClasse = $_POST['libelleClasse'];
        $id_section = $_POST['id_section'];

        $classe_exist = $model->classeExists($libelleClasse,$id_section);

        if (!empty($classe_exist)) {
          echo '
            <div class="alert alert-info alert-dismissible" id="msg" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6>Cette classe existe déjà dans le système</h6>
            </div> ';
        }else{

          if ($add_data = $model->insertClasse($libelleClasse,$id_section)) {
                
            echo '
              <div class="alert alert-success alert-dismissible" id="msg" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h6>classe ajoutée avec succès</h6>
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
    
  //Bloc d'affichage du détail d'une seule classe séléctionnée  
  }elseif(isset($_POST['id']) && !empty($_POST['id'])){
    
    $id = $_POST['id'];

    $row = $model->getClasseSingle($id);

    if (!empty($row)) { 
      foreach($row as $data):
      ?>

      <form action="" method="post" was-validate>
        <div class="form-group">
          <input type="hidden" name="idM" value="<?php echo $data['idClasse']; ?>" id="idM" class="form-control" placeholder="Id" required="required" >
        </div>
        <div class="form-group">
          <label for="libelleClasseM">Libellé classe</label>
          <input type="text" name="libelleClasseM" value="<?php echo $data['designationClasse']; ?>" id="libelleClasseM" class="form-control" placeholder="Libellé" required="required" >
        </div>
        <div class="form-group ">
          <label for="id_sectionM">Section</label>
          <select class="form-control" id="id_sectionM" required>
            <option value="<?php echo $data['idSection']; ?>" ><?php echo $data['designationSection'].' / '.$data['designationEcole'] ?></option>
            <?php 
              $list_ecoles = $model->getAllClasses();

              if (!empty($list_ecoles)) { 
                foreach($list_ecoles as $res):
            ?>
              <option value="<?php echo $res['idSection'] ?>"><?php echo $res['designationSection'].' / '.$res['designationEcole'] ?></option>

            <?php endforeach; 
            } ?>
          </select>
        </div>
        </div>

    <?php endforeach; 
    }

    //Bloc d'affichage des toutes les classes de la base de données 
  
  //Bloc affichage de toutes les classes 
  }elseif (isset($_POST['showAllClasses']) && $_POST['showAllClasses'] === "showAllClasses") {
    $list_classes = $model->getAllClasses();

    if (!empty($list_classes)) {

      foreach ($list_classes as $res) { ?>
                                 
        <tr style="font-size: 13px;">
          <td><?php echo $res['idClasse'] ?></td>
          <td><?php echo $res['designationClasse'] ?></td>
          <td><?php echo $res['designationSection'].' / '.$res['designationEcole'] ?></td>
          <td>
            <a href="" id="editBtn" value="<?php echo $res['idClasse'] ?>" class="btn btn-primary btn-sm " title=""><i class="fa fa-edit"></i></a> 
            <a href="" id="deleteBtn" value="<?php echo $res['idClasse'] ?>" class="btn btn-danger btn-sm " title=""><i class="fa fa-trash"></i></a> 
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

    //Bloc de modification des informations d'une classe

  
  //Bloc modification d'une classe
  }elseif (isset($_POST['editClasse']) && $_POST['editClasse'] === "editClasse" && isset($_POST['idM'])){

    if (!empty(isset($_POST['idM'])) && !empty($_POST['libelleClasseM'])&& !empty($_POST['id_sectionM']) ) {

        $idM = $_POST['idM'];
        $libelleClasseM = $_POST['libelleClasseM'];
        $id_sectionM = $_POST['id_sectionM'];

        if ($edit_data = $model->editClasse($libelleClasseM,$id_sectionM,$idM)) {
                
            echo '
              <div class="alert alert-success alert-dismissible" id="msg" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h6>classe modifiée avec succès</h6>
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
  
  //Bloc suppression d'une classe
  }elseif (isset($_POST['supprimClasse']) && $_POST['supprimClasse'] === "supprimClasse" && isset($_POST['idS'])){

      if (!empty($_POST['idS']) ) {

        $id = $_POST['idS'];

        if ($delete_data = $model->deleteClasse($id)) {
                
          echo '
            <div class="alert alert-success alert-dismissible" id="msg" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6>classe supprimée avec succès</h6>
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
              <h6>Séléctionner une classe valide</h6>
          </div> ';
      }
      
  }
    

?>