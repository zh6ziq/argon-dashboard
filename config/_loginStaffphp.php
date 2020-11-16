<?php
  $connection = mysqli_connect("localhost", "root", "", "leaveSystem") or die ('Unable to connect to MySQL: ' . mysqli_connect_error());

  session_start();


  if(isset($_POST['login']))
  {
    if (empty($_POST['staffID']) || empty($_POST['staffPassword']) )
    {
      header ("location:index.php?Empty=Please Fill in the Blanks");
    }
    else
    {
      $query = "SELECT * FROM staff WHERE staffID = '".$_POST['staffID']."' AND staffPassword = '".$_POST['staffPassword']."'";
      $result = mysqli_query($connection, $query);
      $row = $result->fetch_array();
      $count = $result->num_rows;

      if($count==1)
      {
        $_SESSION['staffID'] = $row['staffID'];
        $_SESSION['staffRole'] = $row['staffRole'];
        if($row['staffRole'] == "Admin")
        {
          header("location:dashboardAdmin.php");
        }
        else if($row['staffRole'] == "Staff")
        {
          header("location:dashboardStaff.php");
        }
        else
        {
          header("location:index.php?ERROR!!!!");
        }
      }
      else {
        header("location:index.php?Invalid= Please Enter Correct User Name and Password");
      }
      }

      /*if(mysqli_fetch_assoc($result))
      {
        $_SESSION['staffID'] = $_POST['staffID'];
        $abc = $_SESSION['staffID'];
        header("location:dashboardAdmin.php");
      }
      else
      {
        header("location:index.php?Invalid= Please Enter Correct User Name and Password ");
      }*/
    }
    else
    {
      header('location: index.php');
    }
 ?>
