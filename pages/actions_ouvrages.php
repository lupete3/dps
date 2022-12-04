<?php 
  
  require_once '../model/Model.php';

  //Appel de la classe Model
  $model = new Model;

  //Bloc d'enregstrement d'un ouvrage
  if (isset($_POST['add_ouvrage']) ){

      if (!empty($_POST['titre']) && !empty($_POST['auteur'])&& !empty($_POST['datePublication'])&& !empty($_POST['id_bibliotheque'])) {

        $titre = $_POST['titre'];
        $auteur = $_POST['auteur'];
        $datePublication = $_POST['datePublication'];
        $id_bibliotheque = $_POST['id_bibliotheque'];

          $filename = $_FILES['fichier']['name'];

          /* Location */
           $location = "../ouvrages/".$filename;
           $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
           $imageFileType = strtolower($imageFileType);

           /* Valid extensions */
           $valid_extensions = array("pdf");

           /* Check file extension */
        if(in_array(strtolower($imageFileType), $valid_extensions)) {
          $newname = rand() . "." . $imageFileType;
          $location = "../ouvrages/". $newname;
          /* Upload file */
          if(move_uploaded_file($_FILES['fichier']['tmp_name'],$location)){
            $ouvrage_exist = $model->ouvrageExists($titre,$auteur,$datePublication,$id_bibliotheque);

            if (!empty($ouvrage_exist)) {
                echo '
                  <div class="alert alert-info alert-dismissible" id="msg" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h6>Cet ouvage existe déjà dans le système</h6>
                  </div> ';
            }else{


              if ($add_data = $model->insertOuvrage($titre,$auteur,$datePublication,$newname,$id_bibliotheque)) {
                  
                echo '
                  <div class="alert alert-success alert-dismissible" id="msg" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h6>Ouvrage ajouté avec succès</h6>
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
                    <h6>Une erreur est survenu lors de l\'importation de la photo</h6>
                </div> ';  
          }
        }else{
          echo '
            <div class="alert alert-danger alert-dismissible" id="msg" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h6>Ovrahe doit être au format PDF</h6>
            </div> ';
        }
      }else{

        echo '
          <div class="alert alert-danger alert-dismissible" id="msg" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h6>Completer tous les champs</h6>
          </div> ';
      }
    
  //Bloc d'affichage du détail d'un seul ouvrage séléctionné 
  }elseif(isset($_POST['id']) && !empty($_POST['id'])){
    
    $id = $_POST['id'];

    $row = $model->getOuvrageSingle($id);

    if (!empty($row)) { 
      foreach($row as $data):
      ?>

      <form action="" method="post" enctype="multipart/form-data" was-validate>
        <div class="form-group">
          <input type="hidden" name="idM" value="<?php echo $data['idOuvrage']; ?>" id="idM" class="form-control" placeholder="Id" required="required" >
        </div>
        <div class="form-group">
          <label for="titreM">Titre Ouvrage</label>
          <input type="text" name="titreM" value="<?php echo $data['titre']; ?>" id="titreM" class="form-control" placeholder="Titre ouvrage" required="required" >
        </div>
        <div class="form-group">
          <label for="auteurM">Auteur</label>
          <input type="text" name="auteurM" value="<?php echo $data['auteur']; ?>" id="auteurM" class="form-control" placeholder="Auteur " required="required" >
        </div>
        <div class="form-group">
          <label for="datePublicationM">Date Publication </label>
          <input type="text" name="datePublicationM" value="<?php echo $data['datePublication']; ?>" id="datePublicationM" class="form-control" placeholder="Date Publication" required="required" >
        </div>
        <div class="form-group ">
          <label for="id_bibliothequeM">Choisir ue bibliothèque</label>
          <select class="form-control" id="id_bibliothequeM" required>
            <option value="<?php echo $data['idBibliotheque']; ?>" ><?php echo $data['designationBibliotheque']; ?></option>
            <?php 
              $list_bibliotheques = $model->getAllBibliotheques();

              if (!empty($list_bibliotheques)) { 
                foreach($list_bibliotheques as $res):
            ?>
              <option value="<?php echo $res['idBibliotheque'] ?>"><?php echo $res['designationBibliotheque'] ?></option>

            <?php endforeach; 
            } ?>
          </select>
        </div>
        </div>

    <?php endforeach; 
    }

    //Bloc d'affichage des tous les ouvrages dans la base de données  
  
  //Bloc affichage de toutes les bibliotheques 
  }elseif (isset($_POST['showAllOuvrages']) && $_POST['showAllOuvrages'] === "showAllOuvrages") {
    $list_ouvrages = $model->getAllOuvrages();

    if (!empty($list_ouvrages)) {

      foreach ($list_ouvrages as $res) { ?>
                                 
        <tr style="font-size: 13px;">
          <td><?php echo $res['idOuvrage'] ?></td>
          <td><?php echo $res['titre'] ?></td>
          <td><?php echo $res['auteur'] ?></td>
          <td><?php echo $res['datePublication'] ?></td>
          <td><a href="../ouvrages/<?php echo $res['fichier'] ?>" target='_blank'><i class="fa fa-eye"></i>Afficher</a></td>
          <td><?php echo $res['designationBibliotheque'] ?></td>
          <td>
            <a href="" id="editBtn" value="<?php echo $res['idOuvrage'] ?>" class="btn btn-primary btn-sm " title=""><i class="fa fa-edit"></i></a> 
            <a href="" id="deleteBtn" value="<?php echo $res['idOuvrage'] ?>" class="btn btn-danger btn-sm " title=""><i class="fa fa-trash"></i></a> 
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

    //Bloc de modification des informations d'un ouvrage de la base de données 
    }elseif (isset($_POST['editOuvrage']) && $_POST['editOuvrage'] === "editOuvrage" && isset($_POST['idM'])){

    if (!empty(isset($_POST['idM'])) && !empty($_POST['titreM'])&& !empty($_POST['auteurM'])&& !empty($_POST['datePublicationM'])&& !empty($_POST['id_bibliothequeM']) ) {

        $idM = $_POST['idM'];
        $titreM = $_POST['titreM'];
        $auteurM = $_POST['auteurM'];
        $datePublicationM = $_POST['datePublicationM'];
        $id_bibliothequeM = $_POST['id_bibliothequeM'];

        if ($edit_data = $model->editOuvrage($titreM,$auteurM,$datePublicationM,$id_bibliothequeM,$idM)) {
                
            echo '
              <div class="alert alert-success alert-dismissible" id="msg" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h6>ouvrage modifié avec succès</h6>
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

  
  //Bloc suppression d'un ovrage dans la base de données 
  }elseif (isset($_POST['supprimBibliotheque']) && $_POST['supprimBibliotheque'] === "supprimBibliotheque" && isset($_POST['idS'])){

      if (!empty($_POST['idS']) ) {

        $id = $_POST['idS'];

        if ($delete_data = $model->deleteOuvrage($id)) {
                
          echo '
            <div class="alert alert-success alert-dismissible" id="msg" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h6>Ouvrage supprimée avec succès</h6>
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
              <h6>Séléctionner un ouvrage valide</h6>
          </div> ';
      }
      
  }
    

?>