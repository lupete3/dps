<?php 
  $title = 'Gestion classes';
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
          <li class="breadcrumb-item active">Ajouter une classe</li>
        </ol>
        <div class="row">
          <div class="col-md-4">
            <form action="" id="form" method="POST" enctype="multipart/form-data">
       
        <!-- DataTables Example -->
            <div class="card ">
              <div class="card-header text-uppercase">Ajouter une classe</div>
                <div class="card-body">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-12">
                      <!-- Affichage de la notification -->
                      <div id="result">
                        
                      </div>
                      </div>
              
                      <div class="col-md-12">
                        <input type="text" id="libelleClasse" name="libelleClasse" class="form-control" placeholder="Libellé classe"  autocomplete="off"><br>
                      </div>
              
                      <div class="col-md-12">
                        <select class="form-control" required id="id_section">
                          <option value="" selected disabled>---Section---</option>
                          <?php 
                            $list_section = $model->getAllSections();

                            if (!empty($list_section)) { 
                              foreach($list_section as $rows):
                          ?>
                            <option value="<?php echo $rows['idSection'] ?>"><?php echo $rows['designationSection'].' / '.$rows['designationEcole'] ?></option>

                          <?php endforeach; 
                          } ?>
                        </select><br>
                      </div>
                      <div class="col-md-12">
                        <button type="submit" name="add_classe" id="add_classe" class="btn btn-sm btn-success "><i class="fa fa-check-circle"></i> Enregistrer </button>
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
                Liste des classes <div class="float-right">     
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Libellé classe</th>
                      <th>Section</th>
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
                <h4 class="modal-title" id="AddclasseLabel">Info classe</h4>
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
        
        //Fonction pour afficher les classes
        function getClasses(){

          let showAllClasses = "showAllClasses";

          $.ajax({
            url : "actions_classe.php",
            type : "post",
            data:{showAllClasses:showAllClasses},
            success : function(data){
              $("#data_list").html(data);
            }
          });
        }

        //Appel fonction qui affiche les classes de la base de données 
        getClasses();

        //Enregistrement des données de la table classe
        $(document).on("click","#add_classe", function(e){
          e.preventDefault();

          let libelleClasse = $("#libelleClasse").val();
          let id_section = $("#id_section").val();

          let add_classe = $("#add_classe").val();
        
          $.ajax({
            url: 'actions_classe.php',
            type: 'post',
            data: {
              libelleClasse:libelleClasse,
              id_section:id_section,
              add_classe:add_classe,
            },
            success: function(response){
              getClasses();
              $("#result").html(response);
              $("#form")[0].reset();
            },
          });     
        });

         //Affichage fenetre modale de l'classe
        $(document).on("click","#editBtn", function(e){
          e.preventDefault();

          $("#editForm").modal("show");

          let id = $(this).attr("value");

          $.ajax({
            url : "actions_classe.php",
            type : "post",
            data : {
              id : id
            },
            success : function(data){
              $("#ed_data").html(data);
            }

          });

        });

         //Modification de l'classe
        $(document).on("click","#update", function(e){
          e.preventDefault();

            let idM = $("#idM").val();
            let libelleClasseM = $("#libelleClasseM").val();
            let id_sectionM = $("#id_sectionM").val();

            let editClasse = "editClasse";
           
           $.ajax({
              url:'actions_classe.php',
              type : "post",
              data : {idM:idM,libelleClasseM:libelleClasseM,id_sectionM:id_sectionM,editClasse:editClasse},
              success : function(data){
                $("#editForm").modal("hide");
                getClasses();
                $("#result").html(data);
              }

           });
        });

         //Suppression de l'classe
        $(document).on("click","#deleteBtn", function(e){
          e.preventDefault();

          if(window.confirm("Voulez-vous supprimer cette classe ?")){

            let idS = $(this).attr("value");
            let supprimClasse = "supprimClasse";

            $.ajax({
              url:'actions_classe.php',
              type:'post',
              data:{
                idS:idS,
                supprimClasse:supprimClasse
              },
              success : function(data){
                getClasses();
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
