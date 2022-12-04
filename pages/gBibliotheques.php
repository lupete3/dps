<?php 
  $title = 'Gestion bibliothèques';
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
          <li class="breadcrumb-item active">Ajouter une bibliothèque</li>
        </ol>
        <div class="row">
          <div class="col-md-4">
            <form action="" id="form" method="POST" enctype="multipart/form-data">
       
        <!-- DataTables Example -->
            <div class="card ">
              <div class="card-header text-uppercase">Ajouter une bibliothèque</div>
                <div class="card-body">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-12">
                      <!-- Affichage de la notification -->
                      <div id="result">
                        
                      </div>
                      </div>
              
                      <div class="col-md-12">
                        <input type="text" id="libelleBibliotheque" name="libelleBibliotheque" class="form-control" placeholder="Libellé bibliothèque"  autocomplete="off"><br>
                      </div>
              
                      <div class="col-md-12">
                        <select class="form-control" required id="id_ecole">
                          <option value="" selected disabled>---Ecole---</option>
                          <?php 
                            $list_ecoles = $model->getAllEcoles();

                            if (!empty($list_ecoles)) { 
                              foreach($list_ecoles as $rows):
                          ?>
                            <option value="<?php echo $rows['idEcole'] ?>"><?php echo $rows['designationEcole'] ?></option>

                          <?php endforeach; 
                          } ?>
                        </select><br>
                      </div>
                      <div class="col-md-12">
                        <button type="submit" name="add_bibliotheque" id="add_bibliotheque" class="btn btn-sm btn-success "><i class="fa fa-check-circle"></i> Enregistrer </button>
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
                Liste des bibliothèques <div class="float-right">     
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Libellé bibliothèque</th>
                      <th>Nom Ecole </th>
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
                <h4 class="modal-title" id="AddbibliothèqueLabel">Info bibliothèque</h4>
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
        function getBibliotheque(){

          let showAllBibliotheques = "showAllBibliotheques";

          $.ajax({
            url : "actions_bibliotheque.php",
            type : "post",
            data:{showAllBibliotheques:showAllBibliotheques},
            success : function(data){
              $("#data_list").html(data);
            }
          });
        }

        //Appel fonction qui affiche les bibliothèques de la base de données 
        getBibliotheque();

        //Enregistrement des données de la table bibliothèque
        $(document).on("click","#add_bibliotheque", function(e){
          e.preventDefault();

          let libelleBibliotheque = $("#libelleBibliotheque").val();
          let id_ecole = $("#id_ecole").val();

          let add_bibliotheque = $("#add_bibliotheque").val();
        
          $.ajax({
            url: 'actions_bibliotheque.php',
            type: 'post',
            data: {
              libelleBibliotheque:libelleBibliotheque,
              id_ecole:id_ecole,
              add_bibliotheque:add_bibliotheque,
            },
            success: function(response){
              getBibliotheque();
              $("#result").html(response);
              $("#form")[0].reset();
            },
          });     
        });

         //Affichage fenetre modale de l'bibliothèque
        $(document).on("click","#editBtn", function(e){
          e.preventDefault();

          $("#editForm").modal("show");

          let id = $(this).attr("value");

          $.ajax({
            url : "actions_bibliotheque.php",
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
            let libelleBibliothequeM = $("#libelleBibliothequeM").val();
            let id_ecoleM = $("#id_ecoleM").val();

            let editBibliotheque = "editBibliotheque";
           
           $.ajax({
              url:'actions_bibliotheque.php',
              type : "post",
              data : {idM:idM,libelleBibliothequeM:libelleBibliothequeM,id_ecoleM:id_ecoleM,editBibliotheque:editBibliotheque},
              success : function(data){
                $("#editForm").modal("hide");
                getBibliotheque();
                $("#result").html(data);
              }

           });
        });

         //Suppression de l'bibliothèque
        $(document).on("click","#deleteBtn", function(e){
          e.preventDefault();

          if(window.confirm("Voulez-vous supprimer cette bibliothèque ?")){

            let idS = $(this).attr("value");
            let supprimBibliotheque = "supprimBibliotheque";

            $.ajax({
              url:'actions_bibliotheque.php',
              type:'post',
              data:{
                idS:idS,
                supprimBibliotheque:supprimBibliotheque
              },
              success : function(data){
                getBibliotheque();
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
