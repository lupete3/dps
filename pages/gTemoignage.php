<?php 
  $title = 'Gestion Témoignage';
  require_once('include/headerAdmin.php'); 

  $model = new Model;

  $list_temoignage = $model->getTemoignage();
  

 ?>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php include('include/sidebarAdmin.php'); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="admin.php">Tableau de Bord</a>
          </li>
          <li class="breadcrumb-item active">Ajouter un témoignage</li>
        </ol>
        <div class="row">
          <div class="col-md-12">
            <form action="" method="POST" id="form" enctype="multipart/form-data">
       
        <!-- DataTables Example -->
            <div class="card ">
              <div class="card-header text-uppercase">Ajouter un témoignage <div class="float-right"><button type="submit" name="add_temoignage" id="add_temoignage" class="btn btn-sm btn-success "><i class="fa fa-check-circle"></i> Enregistrer </button></div> </div>
                <div class="card-body">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-12">
                      <!-- Affichage de la notification -->
                      <div id="result">
                        
                      </div>
                      </div>
              
                      <div class="col-md-5">
                        <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom Client"  autocomplete="off"><br>
                        <input type="text" id="fonction" name="fonction" class="form-control" placeholder="Fonction Client"  autocomplete="off"><br>
                      </div>
                      <div class="col-md-7">
                      <textarea name="message" id="message" class="form-control" rows="3"></textarea><br>
                        <input type="file"  name="file" class="" onchange="previewFile(this);"  id="file" multiple="" ><br>
                        <div class='preview'>
                            <img src="" id="previewImg" width="70" height="70">
                        </div>
                        
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-12 mt-2">
            <!-- Affichage des données de la base de donnée -->
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-table"></i>
                Liste des témoignages <div class="float-right">     
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Nom Client</th>
                      <th>Fonction Client</th>
                      <th>Message</th>
                      <th>Date Publication</th>
                      <th>Image</th>
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
                <h4 class="modal-title" id="AddSectionLabel">Info utilisateur</h4>
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
        function getTemoignage(){
          $.ajax({
            url : "listTemoignages.php",
            type : "post",
            success : function(data){
              $("#data_list").html(data);
            }
          });
        }

        $("#previewImg").hide();

        function previewFile(input){
          var file = $("input[type=file]").get(0).files[0];
   
          if(file){
            var reader = new FileReader();
   
            reader.onload = function(){
              $("#previewImg").attr("src", reader.result);
              $("#previewImg").show();
            }
            reader.readAsDataURL(file);
          }
        }

        //Appel fonction qui affiche les témoignages seléctionnés
        getTemoignage();

        //Enregistrement des données de la table témoignage
         $(document).on("click","#add_temoignage", function(e){
          e.preventDefault();

          var nom = $("#nom").val();
          var fonction = $("#fonction").val();
          var message = $("#message").val();
          
          var fd = new FormData();
          var files = $('#file')[0].files;

          var add_temoignage = $("#add_temoignage").val();

          fd.append('file',files[0]);
          fd.append('nom',nom);
          fd.append('fonction',fonction);
          fd.append('message',message);
        
          $.ajax({
            url: 'add_temoignage.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
              $("#result").html(response);
              $("#img").attr("src",response); 
              $("#form")[0].reset();
              $("#previewImg").hide();
              getTemoignage();
            },
          });    
        });

         //Suppression du témoignage
         $(document).on("click","#deleteBtn", function(e){
          e.preventDefault();

          if(window.confirm("Voulez-vous supprimer ce témoignage ?")){
            var id = $(this).attr("value");

            $.ajax({
              url:'delete_temoignage.php',
              type:'post',
              data:{
                id:id,
              },
              success : function(data){
                getTemoignage();
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
