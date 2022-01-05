<?php
    session_start();
    $conn= new mysqli('localhost', 'root', '', 'test') or die(mysqli_error($conn));
    $update = false;
    $id = 0;
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
      
      

      if (isset($_POST['ajouter'])){
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $password = $_POST['password1'] ; 

        

        $sql = "INSERT INTO test_bd (nom, email, password1)
        VALUES ('$nom', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
          echo "un nv utilisateur a été ajouté";
          
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $_SESSION['message'] = "utilisateur a été ajouté";;
        $_SESSION['msg_type'] = "success";
        header("location: test.php");
      }
      
      if (isset($_GET['del'])){
        $id = $_GET['del'];
        $sql_req = "DELETE FROM test_bd WHERE id=$id";
      
        if ($conn->query($sql_req) === TRUE) {
          echo "un nv utilisateur a été supprimé";
        } else {
          echo "Error: " . $conn->error;
        }
        $_SESSION['message'] = "utilisateur a été supprimé";;
        $_SESSION['msg_type'] = "danger";
        header("location: test.php");
      }

      if (isset($_POST['update'])){
        $id = $_POST['id'];
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $password = $_POST['password1'] ; 
        $mysqli->query("UPDATE test_bd SET nom='$nom', email='$email', password1='$password' WHERE id=$id" ) or die(mysqli_error($conn));

        $_SESSION['message'] = "utilisateur a été updaté";;
        $_SESSION['msg_type'] = "warning";
        header("location: test.php");
      }
      $conn->close();
      
      ?>