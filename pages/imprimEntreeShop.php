<?php 

  require_once '../model/Model.php';
  $title = 'Facture Client';
  require_once('include/headerAdmin.php'); 

  $model = new Model;

  $list_ventes = $model->getApprov(); 

  if (isset($_GET['btnAffiche'])) {
    $debut = $_GET['from'];
    $fin = $_GET['to'];

    $list_ventes = $model->getApprovSearch($debut,$fin); 

  }

?>

  <div class="container " style="margin-bottom: 100px;">
    <div class="row">
      <div class="col-md-2">
        <img src="img/Logo NTC.png" style="width: 100%">
      </div>
      <div class="col-md-8  text-center" style="border-bottom: 3px solid">
        <h3>Mson NEW TECHNOLOGY CENTER<br>Chez FRANCK</h3>
          <p style="font-weight:bold; font-family:Century Gothic; font-size:1em;">Ventes des ordinateurs et autres accessoires informatiques<br> C.Ibanda, Q. Ndendere, Av. Kibombo N°49
          N° RCCM : CD/BKV/RCCM/20-A-00194<br>
          Téléphone : +243 974 473 790<br>
          Newtechnologycenter202@gmail.com
          </p>
      </div>
      <div class="col-md-12 text-center" >
        <h2 class="text-center">FICHE ENTREE SHOP</h2>
          <form action="" method="get" class="cache" accept-charset="utf-8">
            <div class="row">
              <div class=" col-md-5">
              <label for="from"><b>Date Début</b> </label> 
              <input type="date" class="form-control " name="from" id="from"> 
            </div>
            <div class=" col-md-5">
              <label for="to"><b>Date Fin</b> </label> 
              <input type="date" class="form-control " name="to" id="to"> 
            </div>
            <div class=" col-md-2">
              <button class="btn btn-primary mt-4 float-left" name="btnAffiche" id="btnAffiche"><i class="fa fa-search"></i> Afficher</button> 
            </div>
          </form>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered " width="100%" style="font-size: 20px;" cellspacing="0">
              <thead>
                <tr>
                  <th>Id</th>
                      <th>Designation</th>
                      <th>Prix Achat</th>
                      <th>Quantité Achetée</th>
                      <th>Date Approv</th>
                      <th>Nom Fournisseur</th>
                </tr>
              </thead>
              <tbody >                  
                <?php
                  if ($list_ventes) {
                    foreach($list_ventes as $res){ ?>

                      <tr style="font-size: 13px;">
                        <td><?php echo $res['id'] ?></td>
                        <td><?php echo $res['designation'] ?></td>
                        <td><?php echo $res['prix'] ?></td>
                        <td><?php echo $res['quantite'] ?></td>
                        <td><?php echo $res['date_approv'] ?></td>
                        <td><?php echo $res['nom_four'] ?></td>
                      </tr>
                                               
                    <?php  
                    } 
                ?>
              </tbody>
            </table>            
          </div>
        </div>  
           <button type="button"class="print cache btn btn-dark"> <i class="fa fa-print"></i>Imprimer</button><br>
      </div>
    </div>
  </div><br>
  <?php
  }else{
    echo'
      <tr>
        <td colspan="4" class="text-center" headers="">
          <h3>Aucune donné trouvée !</h3>
        </td>
      </tr> 
    ';
  }

  ?>  

<?php include('include/footer.php'); ?>
  <script>
    $('.print').on('click',function(){
      $(".cache").hide();
      window.print();
      if(!window.print()){  
        $('.cache').show();
      }
    });
  </script>
    
