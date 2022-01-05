<?php require_once 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


</head>
<body>
  <!-- As a link -->

  <h2 class="text-center"> EXO CRUD PHP</h2>


  <div class="container">
    <?php

        if (isset($_SESSION['message'])):?>

          <div class="alert alert-<?=$_SESSION['msg_type'];?>">
            <?php echo $_SESSION['message'];
                  unset($_SESSION['message']);
            ?>
          </div>

      <?php endif;?></div>
  <?php 
    $conn= new mysqli('localhost', 'root', '', 'test');
    $res = $conn->query("SELECT * FROM test_bd");

    if (isset($_GET["edit"])){
      $id = $_GET["edit"];
      $resu = $mysqli->query("SELECT * FROM test_bd where id=`$id`") or die($mysqli->error());
      if(count($resu)==1){
        $row = $resu->fetch_array();
        $update = true;
        $nom = $row['nom'];
        $email = $row['email'];
        $password = $row['password'];
      }
    }


    $conn->close();
  ?> 

</div>

    <div class="container">
    <form action="connect.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <div class="form-group">
          <label  class="col-sm-2 col-form-label">Name</label>

            <input class="form-control" autocomplete="username" name="nom" value="<?php echo $nom;?>">

        </div>
        <div class="form-group">
          <label class="col-sm-2 col-form-label">Email</label>
      
            <input type="mail"  class="form-control" name="email" value="<?php echo $email;?>" >
        </div>
        <div class="form-group">
          <label class="col-sm-2 col-form-label">Password</label>

            <input type="password" class="form-control" name="password1" autocomplete="current-password" value="<?php echo $password;?>">

        </div>
          <div class="form-group">
          <?php if ($update==true):?>
            <button type="submit" class="btn btn-info" name="update">update</button>
            <?php else:?> 
            <button type="submit" class="btn btn-info" name="ajouter">ajouter</button>
            <?php endif;?>
          </div>
      
    </form>
    </div>
  <div class="container">
    <table id="datatable" class="table">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">name</th>
            <th scope="col">email</th>
            <th scope="col">password</th>
            <th scope="col" colspan="2" >modifier</th>
          </tr>
        </thead>
        <tbody>
        <?php while ($row = $res->fetch_assoc()):?>
            <tr>
              <th scope="row"><?php echo $row['id'] ?></th>
              <td><?php echo $row['nom']; ?></td>
              <td><?php echo $row['email']; ?></td>
              <td><?php echo $row['password1']; ?></td>
              <td> 
                      <a href="connect.php?del=<?php echo $row['id'];?>" onclick="return confirm('vous voulez vraiment supprimer?')" class="btn btn-danger">supprimer</a> 
              </td>
              <td>
                    <a href="test.php?edit=<?php echo $row['id'];?>" class="btn btn-info">modifier</a>
              </td>
            </tr>
          <?php endwhile;?>
          
        </tbody>
    </table>


  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>