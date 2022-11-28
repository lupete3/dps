<?php 

  require_once '../model/Model.php';

  $model = new Model;

  $list_ecoles = $model->getAllEcoles();

  if (!empty($list_ecoles)) {

    foreach ($list_ecoles as $res) { ?>
                               
      <tr style="font-size: 13px;">
        <td><?php echo $res['idEcole'] ?></td>
        <td><?php echo $res['designationEcole'] ?></td>
        <td><?php echo $res['adresseEcole'] ?></td>
        <td><?php echo $res['login'] ?></td>
        <td><?php echo $res['password'] ?></td>
        <td><?php echo $res['type'] ?></td>
        <td>
          <a href="" id="editBtn" value="<?php echo $res['idEcole'] ?>" class="btn btn-primary btn-sm " title=""><i class="fa fa-edit"></i></a> 
          <a href="" id="deleteBtn" value="<?php echo $res['idEcole'] ?>" class="btn btn-danger btn-sm " title=""><i class="fa fa-trash"></i></a> 
        </td>
      </tr>
    <?php  
    } 
  }else{
    echo'
      <tr>
        <td colspan="6" class="text-center" headers="">
          <h3>Aucune donné trouvée !</h3>
        </td>
      </tr>
    ';
  }

  ?>          
