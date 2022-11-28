<?php 
  $title = 'Gestion Produits';
  require_once('include/headerAdmin.php'); 

  $model = new Model;

  $list_product_stock = $model->getProdMaison();
  

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
          <li class="breadcrumb-item active">Ajouter une entrée en stock</li>
        </ol>
        <div class="row">
          <div class="col-md-4">
            <form action="" id="form" method="POST" enctype="multipart/form-data">
       
        <!-- DataTables Example -->
            <div class="card ">
              <div class="card-header text-uppercase">Approvisionnement Stock Maison  </div>
                <div class="card-body">
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-12">
                      <!-- Affichage de la notification -->
                      <div id="result">
                        
                      </div>
                      </div>
                      <div class="col-md-12">
                        <select name="produit" id="produit" class="form-control">
                          <option value="" selected="">Choisir un produit</option>
                            <?php 
                              if (!empty($list_product_stock)) {
                                  foreach($list_product_stock as $row){
                            ?>
                          <option value="<?php echo $row['id']?>"><?php echo $row['libelle'].' ==> '.$row['stock']?></option>
                            <?php }} ?>
                         </select><br>
                        <input type="text" id="qte" name="qte" class="form-control" placeholder="Quantité Achetée"  autocomplete="off"><br>
                        <input type="text" id="prix" name="prix" class="form-control" placeholder="Prix Achat"  autocomplete="off"><br>
                        <input type="text" id="fournisseur" name="fournisseur" class="form-control" placeholder="Noms Fournisseur"  autocomplete="off"><br>
                      </div>
                      <div class="col-md-12">
                        <button type="submit" name="add_approv" id="add_approv" class="btn btn-sm btn-success "><i class="fa fa-check-circle"></i> Enregistrer </button>
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
                Historique Entrée Stock Dépôt <div class="float-right">
                <a href="imprimEntreeMaison.php" class="btn btn-primary" title=""><i class="fa fa-print"></i> Imprimer</a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Designation</th>
                      <th>Prix Achat</th>
                      <th>Quantité Achetée</th>
                      <th>Date Approv</th>
                      <th>Nom Fournisseur</th>
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
        function getApprovProdMaison(){
          $.ajax({
            url : "listApprovProdMaison.php",
            type : "post",
            success : function(data){
              $("#data_list").html(data);
            }
          });
        }

        //Appel fonction qui affiche les catégories
        getApprovProdMaison();

        //Enregistrement des données de la table approvisionnement
         $(document).on("click","#add_approv", function(e){
          e.preventDefault();

          var produit = $("#produit").val();
          var qte = $("#qte").val();
          var prix = $("#prix").val();
          var fournisseur = $("#fournisseur").val();

          var add_approv = $("#add_approv").val();
        
          $.ajax({
            url: 'add_approv_product_maison.php',
            type: 'post',
            data: {
              produit:produit,
              qte:qte,
              prix:prix,
              fournisseur:fournisseur,
            },
            success: function(response){
              getApprovProdMaison();
              $("#result").html(response);
              $("#form")[0].reset();
            },
          });     
        });

         //Suppression de l'apprivionnement
         $(document).on("click","#deleteBtn", function(e){
          e.preventDefault();

          if(window.confirm("Voulez-vous supprimer cet enregistrement ?")){
            var id = $(this).attr("value");

            $.ajax({
              url:'delete_approv_stock_maison.php',
              type:'post',
              data:{
                id:id,
              },
              success : function(data){
                getApprovProdMaison();
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
