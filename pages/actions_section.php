<?php 
  
  require_once '../model/Model.php';

  //Appel de la classe Model
  $model = new Model;

  //Bloc d'enregstrement d'une section
  if (isset($_POST['add_section']) ){

      if (!empty($_POST['libelleSection'])&& !empty($_POST['id_ecole'])) {

        $libelleSection = $_POST['libelleSection'];
        $id_ecole = $_POST['id_ecole'];

        $section_exist = $model->sectionExists($libelleSection,$id_ecole);

        if (!empty($section_exist)) {
          echo '
            <div class="alert alert-info alert-dismissible" id="msg" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6>Cette section existe déjà dans le système</h6>
            </div> ';
        }else{

          if ($add_data = $model->insertSection($libelleSection,$id_ecole)) {
                
            echo '
              <div class="alert alert-success alert-dismissible" id="msg" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h6>section ajoutée avec succès</h6>
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
    
  //Bloc d'affichage du détail d'une seule section séléctionnée  
  }elseif(isset($_POST['id']) && !empty($_POST['id'])){
    
    $id = $_POST['id'];

    $row = $model->getSectionSingle($id);

    if (!empty($row)) { 
      foreach($row as $data):
      ?>

      <form action="" method="post" was-validate>
        <div class="form-group">
          <input type="hidden" name="idM" value="<?php echo $data['idSection']; ?>" id="idM" class="form-control" placeholder="Id" required="required" >
        </div>
        <div class="form-group">
          <label for="libelleSectionM">Libellé Section</label>
          <input type="text" name="libelleSectionM" value="<?php echo $data['designationSection']; ?>" id="libelleSectionM" class="form-control" placeholder="Libellé" required="required" >
        </div>
        <div class="form-group ">
          <label for="id_ecoleM">Ecole</label>
          <select class="form-control" id="id_ecoleM" required>
            <option value="<?php echo $data['idEcole']; ?>" ><?php echo $data['designationEcole']; ?></option>
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

    //Bloc d'affichage des toutes les sections de la base de données 
  
  //Bloc affichage de toutes les sections 
  }elseif (isset($_POST['showAllSections']) && $_POST['showAllSections'] === "showAllSections") {
    $list_sections = $model->getAllSections();

    if (!empty($list_sections)) {

      foreach ($list_sections as $res) { ?>
                                 
        <tr style="font-size: 13px;">
          <td><?php echo $res['idSection'] ?></td>
          <td><?php echo $res['designationSection'] ?></td>
          <td><?php echo $res['designationEcole'] ?></td>
          <td>
            <a href="" id="editBtn" value="<?php echo $res['idSection'] ?>" class="btn btn-primary btn-sm " title=""><i class="fa fa-edit"></i></a> 
            <a href="" id="deleteBtn" value="<?php echo $res['idSection'] ?>" class="btn btn-danger btn-sm " title=""><i class="fa fa-trash"></i></a> 
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

    //Bloc de modification des informations d'une section

  
  //Bloc modification d'une section
  }elseif (isset($_POST['editSection']) && $_POST['editSection'] === "editSection" && isset($_POST['idM'])){

    if (!empty(isset($_POST['idM'])) && !empty($_POST['libelleSectionM'])&& !empty($_POST['id_ecoleM']) ) {

        $idM = $_POST['idM'];
        $libelleSectionM = $_POST['libelleSectionM'];
        $id_ecoleM = $_POST['id_ecoleM'];

        if ($edit_data = $model->editSection($libelleSectionM,$id_ecoleM,$idM)) {
                
            echo '
              <div class="alert alert-success alert-dismissible" id="msg" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h6>section modifiée avec succès</h6>
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
  
  //Bloc suppression d'une section
  }elseif (isset($_POST['supprimSection']) && $_POST['supprimSection'] === "supprimSection" && isset($_POST['idS'])){

      if (!empty($_POST['idS']) ) {

        $id = $_POST['idS'];

        if ($delete_data = $model->deleteSection($id)) {
                
          echo '
            <div class="alert alert-success alert-dismissible" id="msg" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6>section supprimée avec succès</h6>
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
              <h6>Séléctionner une section valide</h6>
          </div> ';
      }
      
  }
    

?>