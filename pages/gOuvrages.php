<?php 
  $title = 'Gestion Ouvrages ';
  require_once('include/headerAdmin.php'); 

 ?>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php include('include/sidebarAdmin.php'); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="admin">Tableau de Bord</a>
          </li>
          <li class="breadcrumb-item active">Ajouter un ouvrage</li>
        </ol>
        <div class="row">
          <div class="col-md-4">
            <form action="" id="form" method="POST" enctype="multipart/form-data">
       
        <!-- DataTables Example -->
            <div class="card ">
              <div class="card-header text-uppercase">Ajouter un ouvrage</div>
                <div class="card-body">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-12">
                      <!-- Affichage de la notification -->
                      <div id="result">
                        
                      </div>
                      </div>
              
                      <div class="col-md-12">
                        <input type="text" id="titre" name="titre" class="form-control" placeholder="Titre ouvrage"  autocomplete="off"><br>
                      </div>
              
                      <div class="col-md-12">
                        <input type="text" id="auteur" name="auteur" class="form-control" placeholder="Auteur"  autocomplete="off"><br>
                      </div>
              
                      <div class="col-md-12">
                        <label for="datePublication">Date publication</label>
                        <input type="date" id="datePublication" name="datePublication" class="form-control" placeholder="Date Publication"  autocomplete="off"><br>
                      </div>
              
                      <div class="col-md-12">
                        <label for="fichier">Choisir le fichier</label>
                        <input type="file" id="fichier" name="fichier" class="form-control" placeholder="Pièce jointe "  autocomplete="off"><br>
                      </div>
              
                      <div class="col-md-12">
                        <select class="form-control" required id="id_bibliotheque">
                          <option value="" selected disabled>---Bibliothèque---</option>
                          <?php 
                            $list_bibliotheques = $model->getAllBibliotheques();

                            if (!empty($list_bibliotheques)) { 
                              foreach($list_bibliotheques as $rows):
                          ?>
                            <option value="<?php echo $rows['idBibliotheque'] ?>"><?php echo $rows['designationBibliotheque'] ?></option>

                          <?php endforeach; 
                          } ?>
                        </select><br>
                      </div>
                      <div class="col-md-12">
                        <button type="submit" name="add_ouvrage" id="add_ouvrage" class="btn btn-sm btn-success "><i class="fa fa-check-circle"></i> Enregistrer </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <!-- Affichage des données de la base de donnée -->
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-table"></i>
                Liste des ouvrages <div class="float-right">     
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Titre Ouvrage</th>
                      <th>Auteur</th>
                      <th>Date Publication</th>
                      <th>Fichier</th>
                      <th>Nom Bibliothèque </th>
                      <th>Action</th>
                  </tr>
                  </thead>
                  
                  <tbody id="data_list">
                    
                  </tbody>
                </table>            
              </div>
            </div>  
            
          </div>
        </div>

        <!-- fenetre modal d'affichage donnée user -->
        <div class="modal fade" id="editForm" tabindex="-1" role="dialog" aria-labelledby="Modregister" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content panel-danger">
              <div class="modal-header">
                <h4 class="modal-title" id="AddbibliothèqueLabel">Info ouvrage</h4>
                <button type="button" class="close btn " data-dismiss="modal" aria-hidden="true">&times;</button>
              </div>
              <div class="modal-body">
                <form action="" method="post" was-validate>
                  <div class="form-group">
                  </div>
                  <div class="form-group " id="ed_data" >
                    
                  </div><br>

                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-secondary btn-block" data-dismiss="modal" name="btn">Annuler </button>
                  <button type="submit" class="btn btn-primary btn-block" id="update" name="update"> Modifier </button>
                </div>
              </form>
              
            </div>
          </div>
        </div>
        <!-- /.modal-content -->

      <!-- Sticky Footer -->
      <?php include('include/footer.php'); ?>

      <script>
        
        //Fonction pour afficher les bibliothèques
        function getOuvrages(){

          let showAllOuvrages = "showAllOuvrages";

          $.ajax({
            url : "actions_ouvrages.php",
            type : "post",
            data:{showAllOuvrages:showAllOuvrages},
            success : function(data){
              $("#data_list").html(data);
            }
          });
        }

        //Appel fonction qui affiche les bibliothèques de la base de données 
        getOuvrages();

        //Enregistrement des données de la table bibliothèque
        $(document).on("click","#add_ouvrage", function(e){
          e.preventDefault();

          let titre = $("#titre").val();
          let auteur = $("#auteur").val();
          let datePublication = $("#datePublication").val();
          let id_bibliotheque = $("#id_bibliotheque").val();

          let add_ouvrage = $("#add_ouvrage").val();
        
          let fd = new FormData();
          let fichier = $('#fichier')[0].files;

           fd.append('fichier',fichier[0]);
          fd.append('titre',titre);
          fd.append('auteur',auteur);
          fd.append('datePublication',datePublication);
          fd.append('id_bibliotheque',id_bibliotheque);
          fd.append('add_ouvrage',add_ouvrage);
        
          $.ajax({
            url: 'actions_ouvrages.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              $("#result").html(response);
              $("#form")[0].reset();
              getOuvrages();
            },
          });      
        });

         //Affichage fenetre modale de l'ouvrage
        $(document).on("click","#editBtn", function(e){
          e.preventDefault();

          $("#editForm").modal("show");

          let id = $(this).attr("value");

          $.ajax({
            url : "actions_ouvrages.php",
            type : "post",
            data : {
              id : id
            },
            success : function(data){
              $("#ed_data").html(data);
            }

          });

        });

         //Modification de l'bibliothèque
        $(document).on("click","#update", function(e){
          e.preventDefault();

            let idM = $("#idM").val();
            let titreM = $("#titreM").val();
            let auteurM = $("#auteurM").val();
            let datePublicationM = $("#datePublicationM").val();
            let id_bibliothequeM = $("#id_bibliothequeM").val();

            let editOuvrage = "editOuvrage";
           
           $.ajax({
              url:'actions_ouvrages.php',
              type : "post",
              data : {
                idM:idM,
                titreM:titreM,
                auteurM:auteurM,
                datePublicationM:datePublicationM,
                id_bibliothequeM:id_bibliothequeM,
                editOuvrage:editOuvrage},
              success : function(data){
                $("#editForm").modal("hide");
                getOuvrages();
                $("#result").html(data);
              }

           });
        });

         //Suppression de l'ouvrage
        $(document).on("click","#deleteBtn", function(e){
          e.preventDefault();

          if(window.confirm("Voulez-vous supprimer cette bibliothèque ?")){

            let idS = $(this).attr("value");
            let supprimBibliotheque = "supprimBibliotheque";

            $.ajax({
              url:'actions_ouvrages.php',
              type:'post',
              data:{
                idS:idS,
                supprimBibliotheque:supprimBibliotheque
              },
              success : function(data){
                getOuvrages();
                $("#result").html(data);
              }
            });

          }
        });
      </script>

<!-- bootstrap-wysiwyg -->
  <script src="js/jquery.hotkeys.js"></script>
  <script src="js/bootstrap-wysiwyg.js"></script>
  <script src="js/bootstrap-wysiwyg-custom.js"></script>
  <script src="js/moment.js"></script>
  <script src="js/bootstrap-colorpicker.js"></script>
  <script src="js/daterangepicker.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <!-- ck editor -->
  <script type="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
  <!-- custom form component script for this page-->
  <script src="js/form-component.js"></script>
  <!-- custome script for all page -->
  <script src="js/scripts.js"></script>
