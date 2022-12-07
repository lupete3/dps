<?php 
  
  require_once '../model/Model.php';
  require_once '../model/security_eco.php';

  //Appel de la classe Model
  $model = new Model;
  $idEcole = $id;

  //Bloc d'enregstrement d'une inscription
  if (isset($_POST['add_inscription'])){

      if (!empty($id)&& !empty($_POST['id_eleve'])&& !empty($_POST['id_classe'])&& !empty($_POST['id_edition'])&& !empty($_POST['id_section'])) {

        $id_ecole = $id;
        $id_eleve = $_POST['id_eleve'];
        $id_classe = $_POST['id_classe'];
        $id_edition = $_POST['id_edition'];
        $id_section = $_POST['id_section'];
        $dateInscription = date('Y-m-d');
        $statut = 'valide';

        $inscription_exist = $model->inscriptionExists($id_ecole,$id_classe,$id_eleve,$id_edition,$id_section);

        if (!empty($inscription_exist)) {
          echo '
            <div class="alert alert-info alert-dismissible" id="msg" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6>Cette inscription existe déjà dans le système</h6>
            </div> ';
        }else{

          if ($add_data = $model->insertInscription($dateInscription,$statut,$id_ecole,$id_eleve,$id_classe,$id_edition,$id_section)) {
                
            echo '
              <div class="alert alert-success alert-dismissible" id="msg" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h6>inscriotion ajoutée avec succès</h6>
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
    
  //Bloc d'affichage du détail d'une seule inscription séléctionnée  
  }elseif(isset($_POST['id']) && !empty($_POST['id'])){
    
    $id = $_POST['id'];

    $row = $model->getInscriptionSingle($id);

    if (!empty($row)) { 
      foreach($row as $data):
      ?>

      <form action="" method="post" was-validate>
        <div class="form-group">
          <input type="hidden" name="idM" value="<?php echo $data['idInscription']; ?>" id="idM" class="form-control" placeholder="Id" required="required" >
        </div>
        <div class="form-group ">
          <label for="id_eleveM">Eleve</label>
          <select class="form-control" id="id_eleveM" required>
            <option value="<?php echo $data['id_eleve']; ?>" ><?php echo $data['nomEleve'].' '.$data['postnomEleve']; ?></option>
            <?php 
              $list_eleve = $model->getAllEleves();

              if (!empty($list_eleve)) { 
                foreach($list_eleve as $res):
            ?>
              <option value="<?php echo $res['idEleve'] ?>"><?php echo $res['nomEleve'].' '.$res['postnomEleve'] ?></option>

            <?php endforeach; 
            } ?>
          </select>
        </div>
        <div class="form-group ">
          <label for="id_editionM">Edition</label>
          <select class="form-control" id="id_editionM" required>
            <option value="<?php echo $data['id_edition']; ?>" ><?php echo $data['libelle']; ?></option>
            <?php 
              $list_edition = $model->getAllEditions();

              if (!empty($list_edition)) { 
                foreach($list_edition as $res):
            ?>
              <option value="<?php echo $res['idEdition'] ?>"><?php echo $res['libelle'] ?></option>

            <?php endforeach; 
            } ?>
          </select>
        </div>
        <div class="form-group ">
          <label for="id_sectionM">Section</label>
          <select class="form-control" id="id_sectionM" required>
            <option value="<?php echo $data['id_sesction_sec']; ?>" ><?php echo $data['designationSection']; ?></option>
            <?php 
              $list_sections = $model->getAllSectionsByEcole($idEcole);

              if (!empty($list_sections)) { 
                foreach($list_sections as $res):
            ?>
              <option value="<?php echo $res['idSection'] ?>"><?php echo $res['designationSection'] ?></option>

            <?php endforeach; 
            } ?>
          </select>
        </div>
        <div class="form-group ">
          <label for="id_classeM">Classe</label>
          <select class="form-control" id="id_classeM" required>
            <option value="<?php echo $data['id_lasse']; ?>" ><?php echo $data['designationClasse']; ?></option>
            <?php 
              $list_classes = $model->getAllClassesByEcole($idEcole);

              if (!empty($list_classes)) { 
                foreach($list_classes as $res):
            ?>
              <option value="<?php echo $res['idClasse'] ?>"><?php echo $res['designationClasse'] ?></option>

            <?php endforeach; 
            } ?>
          </select>
        </div>
        <div class="form-group ">
          <label for="statutM">Etat Elève</label>
          <select class="form-control" id="statutM" required>
            <option value="<?php echo $data['statut']; ?>" ><?php echo $data['statut']; ?></option>
            <option value="valide">valide</option>
            <option value="abandon">abandon</option>
          </select>
        </div>
        </div>

    <?php endforeach; 
    }
  
  //Bloc affichage de toutes les inscriptions 
  }elseif (isset($_POST['showAllInscriptions']) && $_POST['showAllInscriptions'] === "showAllInscriptions") {
    $list_inscriptions = $model->getAllInscriptionsByEcole($id);

    if (!empty($list_inscriptions)) {

      foreach ($list_inscriptions as $res) { ?>
                                 
        <tr style="font-size: 13px;">
          <td><?php echo $res['idInscription'] ?></td>
          <td><?php echo $res['nomEleve'].' '.$res['postnomEleve'] ?></td>
          <td><?php echo $res['libelle'] ?></td>
          <td><?php echo $res['dateInscription'] ?></td>
          <td><?php echo $res['designationSection'] ?></td>
          <td><?php echo $res['designationClasse'] ?></td>
          <td><?php echo $res['statut'] ?></td>
          <td>
            <a href="" id="editBtn" value="<?php echo $res['idInscription'] ?>" class="btn btn-primary btn-sm " title=""><i class="fa fa-edit"></i></a> 
            <a href="" id="deleteBtn" value="<?php echo $res['idInscription'] ?>" class="btn btn-danger btn-sm " title=""><i class="fa fa-trash"></i></a> 
          </td>
        </tr>
      <?php  
      } 
    }else{
      echo'
        <tr>
          <td colspan="7" class="text-center" headers="">
            <h3>Aucune donné trouvée !</h3>
          </td>
        </tr>
      ';
    }

  
  //Bloc modification d'une inscription
  }elseif (isset($_POST['editInscription']) && $_POST['editInscription'] === "editInscription" && isset($_POST['idM'])){

    if (!empty($idEcole)&& !empty($_POST['id_eleveM'])&& !empty($_POST['id_classeM'])&& !empty($_POST['id_editionM'])&& !empty($_POST['id_sectionM'])&& !empty($_POST['statutM']) ) {

        $idM = $_POST['idM'];
        $id_ecoleM = $idEcole;
        $id_eleveM = $_POST['id_eleveM'];
        $id_classeM = $_POST['id_classeM'];
        $id_editionM = $_POST['id_editionM'];
        $id_sectionM = $_POST['id_sectionM'];
        $statutM = $_POST['statutM'];

        if ($edit_data = $model->editInscription($id_ecoleM,$id_eleveM,$id_classeM,$id_editionM,$id_sectionM,$statutM,$idM)) {
                
            echo '
              <div class="alert alert-success alert-dismissible" id="msg" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h6>inscription modifiée avec succès</h6>
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

  
  //Bloc suppression d'une inscription dans la base de données 
  }elseif (isset($_POST['supprimInscription']) && $_POST['supprimInscription'] === "supprimInscription" && isset($_POST['idS'])){

      if (!empty($_POST['idS']) ) {

        $id = $_POST['idS'];

        if ($delete_data = $model->deleteInscription($id)) {
                
          echo '
            <div class="alert alert-success alert-dismissible" id="msg" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6>inscription supprimée avec succès</h6>
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
              <h6>Séléctionner une donné valide</h6>
          </div> ';
      }
      
  }
    

?>