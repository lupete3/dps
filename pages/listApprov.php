<?php 

  require_once '../model/Model.php';

  $model = new Model;

  $list_approv = $model->getApprov();

  if ($list_approv) {
    foreach($list_approv as $res){ ?>
                               
      <tr style="font-size: 13px;">
        <td><?php echo $res['id'] ?></td>
        <td><?php echo $res['designation'] ?></td>
        <td><?php echo $res['prix'] ?></td>
        <td><?php echo $res['quantite'] ?></td>
        <td><?php echo $res['date_approv'] ?></td>
        <td><?php echo $res['nom_four'] ?></td>
        <td>
          <a href="" id="deleteBtn" value="<?php echo $res['id'] ?>" class="btn btn-danger btn-sm " title=""><i class="fa fa-trash"></i></a>
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
