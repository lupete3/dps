<?php 

  require_once '../model/Model.php';

  $model = new Model;


    $list_product = $model->getAllProductAdmin();


  if ($list_product) {
    foreach($list_product as $res){ ?>
                               
       <tr style="font-size: 13px;">
                    
                    <td><?php echo $res['id'] ?></td>
                    <td><?php echo $res['designation'] ?></td>
                    <td><?php echo $res['libelle'] ?></td>
                    <td><?php echo number_format($res['prix'],2) ?> $</td>
                    <td><?php echo $res['quantite'] ?></td>
                    <td><?php echo $res['disponible'] ?></td>
                    <td><img src="../../img/<?php echo $res['image'] ?>" height="30" border="4" alt="">
                      <input type="hidden" id="path" value="<?php echo $res['image'] ?>" name="">
                     </td>
                    <td><?php echo $res['description'] ?></td>
                    <td>
                    <a href="show_product.php?idAr=<?php echo $res['id'] ?>" title=""><button type="button" class="btn btn-sm btn-primary "><i class="fa fa-edit"></i> Modifier</button></a>
                    <a href="" title=""><button type="button" value="<?php echo $res['id'] ?>" class="btn btn-sm btn-danger " id="supBtn"><i class="fa fa-trash"></i> Supprimer</button></a>
                   
                  </td>
                  </tr>
    <?php  
    } 
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
