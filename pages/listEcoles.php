<?php 

    $title = 'Liste des produits';

    require_once('include/headerAdmin.php'); 

    $model = new Model;

    $list_ecoles = $model->getAllEcoles();


?>
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include('include/sidebarAdmin.php'); ?>

    <div id="content-wrapper" class="container-fluid">

      <div class="container-fluid">

        <div id="result">
          
        </div>

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="admin">Tableau de bord</a>
          </li>
          <li class="breadcrumb-item active">Liste des ecoles</li>
        </ol>
        <span class="etat"></span>
        <!-- DataTables Example -->
       <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Liste des écoles 
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Nom Ecole</th>
                    <th>Adresse Ecole</th>
                    <th>Login</th>
                    <th>Password</th>
                    <th>Type</th>
                    <th>Action</th>
                  </tr>
                </thead>
                
                <tbody>
                  <?php 
                    if (!empty($list_ecoles)) {
                      foreach ($list_ecoles as $res) {
                    ?>

                  <tr style="font-size: 13px;">
                    <td><?php echo $res['idEcole'] ?></td>
                    <td><?php echo $res['designationEcole'] ?></td>
                    <td><?php echo $res['adresseEcole'] ?></td>
                    <td><?php echo $res['login'] ?></td>
                    <td><?php echo $res['password'] ?></td>
                    <td><?php echo $res['type'] ?></td>
                    
                    <td>
                      <button type="button" value="<?php echo $res['idEcole'] ?>" class="btn btn-sm btn-primary btnMod"><i class="fa fa-edit"></i> Modifier</button>               
                      <button type="button" value="<?php echo $res['idEcole'] ?>" class="btn btn-sm btn-danger btnAnnul"><i class="fa fa-trash"></i> Supprimer</button>               
                  </td>
                  </tr>
                  <?php }

                  }else { ?>
                    <tr>
                      <td class="text-center" colspan="9" rowspan="" headers=""><h3>Aucune donné trouvée </h3></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
    </div>
        
  
 <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>
    
  <!-- Bootstrap core JavaScript-->


  <script type="text/javascript">
    
    //Actualiser le prix total apès changement de la remise
      $(".itmQt").on("change", function(){

        var $element = $(this).closest("tr");

        var id_com = $element.find('.id_com').val();
        var remise = $element.find('.itmQt').val();

        $.ajax({
          url:'action_admin.php',
          type:'post',
          cache:false,
          data:{id_com:id_com,remise:remise},
          success:function(response){
            location.reload(true);
            alert("Remise accordée avec success");
          }
        });

      });
    //Valider une commande
      $(".btnVal").on("click", function(){
        var $element = $(this).closest("tr");

        var id_val = $element.find('.id_com').val();

        $.ajax({
          url:'action_admin.php',
          type:'post',
          cache:false,
          data:{id_val:id_val},
          success:function(response){
            location.reload(true);
            alert("Commande validée avec success");
          }
        });
      });
    //Annuler une commande
      $(".btnAnn").on("click", function(){
        if(window.confirm('Voulez-vous annuler cette commande ?')){
          var $element = $(this).closest("tr");

          var id_ann = $element.find('.id_com').val();

          $.ajax({
            url:'action_admin.php',
            type:'post',
            cache:false,
            data:{id_ann:id_ann},
            success:function(response){
              location.reload(true);
              alert("Commande annulée avec success");
            }
          });
        }
        
      });
    //Livrer une commande
      $(".btnLiv").on("click", function(){
        if(window.confirm('Vous ête sur que cette commade est bien livrée ?')){
          var $element = $(this).closest("tr");

          var id_liv = $element.find('.id_com').val();

          $.ajax({
            url:'action_admin.php',
            type:'post',
            cache:false,
            data:{id_liv:id_liv},
            success:function(response){
              location.reload(true);
              alert("Commande livrée avec success");
            }
          });
        }
        
      });
  </script>

</body>

</html>
