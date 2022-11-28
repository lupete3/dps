<?php 
  $title = 'Gestion editions';
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
          <li class="breadcrumb-item active">Ajouter une édition</li>
        </ol>
        <div class="row">
          <div class="col-md-4">
            <form action="" id="form" method="POST" enctype="multipart/form-data">
       
        <!-- DataTables Example -->
            <div class="card ">
              <div class="card-header text-uppercase">Ajouter une édition</div>
                <div class="card-body">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-12">
                      <!-- Affichage de la notification -->
                      <div id="result">
                        
                      </div>
                      </div>
              
                      <div class="col-md-12">
                        <input type="text" id="libelle" name="libelle" class="form-control" placeholder="Libellé édition"  autocomplete="off"><br>
                      </div>
                      <div class="col-md-12">
                        <button type="submit" name="add_edition" id="add_edition" class="btn btn-sm btn-success "><i class="fa fa-check-circle"></i> Enregistrer </button>
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
                Liste des éditions <div class="float-right">     
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Libellé edition</th>
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
                <h4 class="modal-title" id="AddSectionLabel">Info édition</h4>
                <button type="button" class="close btn " data-dismiss="modal" aria-hidden="true">&times;</button>
              </div>
              <div class="modal-body">
                <form action="delete_agent.php" method="post" was-validate>
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
        
        //Fonction pour afficher les catégories
        function getEditions(){

          let showAlleditions = "showAlleditions";

          $.ajax({
            url : "actions_edition.php",
            type : "post",
            data:{showAlleditions:showAlleditions},
            success : function(data){
              $("#data_list").html(data);
            }
          });
        }

        //Appel fonction qui affiche les éditions de la base de données 
        getEditions();

        //Enregistrement des données de la table édition
         $(document).on("click","#add_edition", function(e){
          e.preventDefault();

          let libelle = $("#libelle").val();

          let add_edition = $("#add_edition").val();
        
          $.ajax({
            url: 'actions_edition.php',
            type: 'post',
            data: {
              libelle:libelle,
              add_edition:add_edition,
            },
            success: function(response){
              getEditions();
              $("#result").html(response);
              $("#form")[0].reset();
            },
          });     
        });

         //Affichage fenetre modale de l'édition
        $(document).on("click","#editBtn", function(e){
          e.preventDefault();

          $("#editForm").modal("show");

          let id = $(this).attr("value");

          $.ajax({
            url : "actions_edition.php",
            type : "post",
            data : {
              id : id
            },
            success : function(data){
              $("#ed_data").html(data);
            }

          });

        });

         //Modification de l'édition
        $(document).on("click","#update", function(e){
          e.preventDefault();

            let idM = $("#idM").val();
            let libelleM = $("#libelleM").val();

            let editEdition = "editEdition";
           
           $.ajax({
              url:'actions_edition.php',
              type : "post",
              data : {idM:idM,libelleM:libelleM,editEdition:editEdition},
              success : function(data){
                $("#editForm").modal("hide");
                getEditions();
                $("#result").html(data);
              }

           });
        });

         //Suppression de l'édition
        $(document).on("click","#deleteBtn", function(e){
          e.preventDefault();

          if(window.confirm("Voulez-vous supprimer cette édition ?")){

            let idS = $(this).attr("value");
            let suppimEdition = "suppimEdition";

            $.ajax({
              url:'actions_edition.php',
              type:'post',
              data:{
                idS:idS,
                suppimEdition:suppimEdition
              },
              success : function(data){
                getEditions();
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
