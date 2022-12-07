<?php 
  $title = 'Gestion Inscription ';
  require_once('include/headerEcole.php'); 

 ?>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php include('include/sidebarEcole.php'); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="admin">Tableau de Bord</a>
          </li>
          <li class="breadcrumb-item active">Ajouter une inscription</li>
        </ol>
        <div class="row">
          <div class="col-md-4">
            <form action="" id="form" method="POST" enctype="multipart/form-data">
       
        <!-- DataTables Example -->
            <div class="card ">
              <div class="card-header text-uppercase">Ajouter une inscription</div>
                <div class="card-body">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-12">
                      <!-- Affichage de la notification -->
                      <div id="result">
                        
                      </div>
                      </div>
                      <div class="col-md-12">
                        <select class="form-control" id="id_eleve" required>
                          <option value="" selected disabled>---Choisir Elève---</option>
                          <?php 
                            $list_eleve = $model->getAllEleves();

                            if (!empty($list_eleve)) { 
                              foreach($list_eleve as $res):
                          ?>
                            <option value="<?php echo $res['idEleve'] ?>"><?php echo $res['nomEleve'].' '.$res['postnomEleve'] ?></option>

                          <?php endforeach; 
                          } ?>
                        </select><br>
                      </div>
                      <div class="col-md-12">
                        <select class="form-control" id="id_edition" required>
                          <option value="" selected disabled>---Choisir Année scolaire---</option>
                          <?php 
                            $list_edition = $model->getAllEditions();

                            if (!empty($list_edition)) { 
                              foreach($list_edition as $res):
                          ?>
                            <option value="<?php echo $res['idEdition'] ?>"><?php echo $res['libelle'] ?></option>

                          <?php endforeach; 
                          } ?>
                        </select><br>
                      </div>
                      <div class="col-md-12">
                        <select class="form-control" id="id_section" required>
                          <option value="" selected disabled>---Choisir Section---</option>
                          <?php 
                            $list_sections = $model->getAllSectionsByEcole($id);

                            if (!empty($list_sections)) { 
                              foreach($list_sections as $res):
                          ?>
                            <option value="<?php echo $res['idSection'] ?>"><?php echo $res['designationSection'] ?></option>

                          <?php endforeach; 
                          } ?>
                        </select><br>
                      </div>
                      <div class="col-md-12">
                        <select class="form-control" id="id_classe" required>
                          <option value="" selected disabled>---Choisir Classe---</option>
                          <?php 
                            $list_classes = $model->getAllClassesByEcole($id);

                            if (!empty($list_classes)) { 
                              foreach($list_classes as $res):
                          ?>
                            <option value="<?php echo $res['idClasse'] ?>"><?php echo $res['designationClasse'] ?></option>

                          <?php endforeach; 
                          } ?>
                        </select><br>
                      </div>
                      <div class="col-md-12">
                        <button type="submit" name="add_inscription" id="add_inscription" class="btn btn-sm btn-success "><i class="fa fa-check-circle"></i> Enregistrer </button>
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
                Liste des élèves inscrits <div class="float-right">     
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Nom et Postnom</th>
                      <th>Edition</th>
                      <th>Date Inscription</th>
                      <th>Section</th>
                      <th>Classe </th>
                      <th>Statut </th>
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
                <h4 class="modal-title" id="AddbibliothèqueLabel">Détail inscription</h4>
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
        function getInsriptions(){

          let showAllInscriptions = "showAllInscriptions";

          $.ajax({
            url : "actions_inscription.php",
            type : "post",
            data:{showAllInscriptions:showAllInscriptions},
            success : function(data){
              $("#data_list").html(data);
            }
          });
        }

        //Appel fonction qui affiche les bibliothèques de la base de données 
        getInsriptions();

        //Enregistrement des données de la table bibliothèque
        $(document).on("click","#add_inscription", function(e){
          e.preventDefault();

          let id_eleve = $("#id_eleve").val();
          let id_edition = $("#id_edition").val();
          let id_section = $("#id_section").val();
          let id_classe = $("#id_classe").val();

          let add_inscription = $("#add_inscription").val();
        
          let fd = new FormData();

            fd.append('id_eleve',id_eleve);
            fd.append('id_edition',id_edition);
            fd.append('id_section',id_section);
            fd.append('id_classe',id_classe);
            fd.append('add_inscription',add_inscription);
        
          $.ajax({
            url: 'actions_inscription.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              $("#result").html(response);
              $("#form")[0].reset();
              getInsriptions();
            },
          });      
        });

         //Affichage fenetre modale de l'inscription
        $(document).on("click","#editBtn", function(e){
          e.preventDefault();

          $("#editForm").modal("show");

          let id = $(this).attr("value");

          $.ajax({
            url : "actions_inscription.php",
            type : "post",
            data : {
              id : id
            },
            success : function(data){
              $("#ed_data").html(data);
            }

          });

        });

         //Modification de l'inscription
        $(document).on("click","#update", function(e){
          e.preventDefault();

            let idM = $("#idM").val();
            let id_eleveM = $("#id_eleveM").val();
            let id_editionM = $("#id_editionM").val();
            let id_sectionM = $("#id_sectionM").val();
            let id_classeM = $("#id_classeM").val();
            let statutM = $("#statutM").val();

            let editInscription = "editInscription";
           
           $.ajax({
              url:'actions_inscription.php',
              type : "post",
              data : {
                idM:idM,
                id_eleveM:id_eleveM,
                id_editionM:id_editionM,
                id_sectionM:id_sectionM,
                id_classeM:id_classeM,
                statutM:statutM,
                editInscription:editInscription},
              success : function(data){
                $("#editForm").modal("hide");
                getInsriptions();
                $("#result").html(data);
              }

           });
        });

         //Suppression de l'ouvrage
        $(document).on("click","#deleteBtn", function(e){
          e.preventDefault();

          if(window.confirm("Voulez-vous supprimer cette inscription ?")){

            let idS = $(this).attr("value");
            let supprimInscription = "supprimInscription";

            $.ajax({
              url:'actions_inscription.php',
              type:'post',
              data:{
                idS:idS,
                supprimInscription:supprimInscription
              },
              success : function(data){
                getInsriptions();
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
