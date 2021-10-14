<?php 
  
  $connection = mysqli_connect("localhost", "root", "", "daily_task");

  if(!$connection){
      throw new Exception("Sorry ! Connection Hoy nai");

  }else{
     
    if(isset($_POST['button'])){
       $name =  $_POST['tname'];
        $date =  $_POST['tdate'];


        $query = "INSERT INTO `task`(`task_name`, `task_date`) VALUES ('$name','$date')";

         if(mysqli_query($connection, $query)){
             header("location:index.php");
         }

        
    }

    if($_POST['action']=='complete'){
      $taskid = $_POST['taskid'];

      $update_query = "UPDATE `task` SET `task_status`=1 WHERE `id`= $taskid";

      if(mysqli_query($connection, $update_query)){
        header("location:index.php");
      }
    }
    if($_POST['action']=='delete'){
      $delid = $_POST['delid'];

      $del_query = "DELETE FROM `task` WHERE `id`=$delid";

      if(mysqli_query($connection, $del_query)){
        header("location:index.php");
      }
    }

  }


?>

