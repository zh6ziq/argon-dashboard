
<?php

    $con = mysqli_connect("localhost", "root", "", "bookingappointment") or die ('Unable to connect to MYSQL: ' . mysqli_connect_error());

    session_start();
    
    if(isset($_POST['create']))
    {
        $_SESSION['patientIC']=$_POST['patientIIC'];
        $patientIC = $_SESSION['patientIC'];

        $patientIC = $_POST['patientIC'];
        $patientName = $_POST['patientName'];
        $patientPhone = $_POST['patientPhone'];
        $patientEmail = $_POST['patientEmail'];
        $patientPassword = $_POST['patientPassword'];



        if (preg_match("/^[a-zA-Z\s]+$/", $patientName))
        {

            if(ctype_digit($patientPhone))
            {
       
                $sql = "INSERT INTO patient 
                        VALUES ('$patientIC' , '$patientName' , '$patientPhone', '$patientEmail', '$patientPassword' )";
                $result = mysqli_query($con, $sql);


                if ($result)
                {
                    echo "<script> alert('User registered');window.location='login.php'</script>";
                }
                else
                {
                  $query2="SELECT * FROM patient WHERE patientIC='$patientIC'";
                  $result2 = mysqli_query($con, $query2) or die ('Unable to connect to MYSQL: ' . mysqli_error());

                    echo "<script> alert('Error! You have an account already.');window.location='login.php'</script>";
                }
            }
            else
              { echo "<script> alert('Phone Number should be in numberic.');window.location='../index.php'</script>" ; }
        }
        else
          { echo "<script> alert('Name should be in alphabeth');window.location='../index.php'</script>" ; }

    mysqli_close($con);
  }

  if (isset($_POST['login'])) {
    

    $query = "SELECT * FROM staff WHERE staffEmail = '".$_POST['email']."' AND staffPassword = '".$_POST['password']."'";
    $result = mysqli_query($con, $query);
    $row = $result->fetch_array();
    $count = $result->num_rows;

    $query2 = "SELECT * FROM patient WHERE patientEmail = '".$_POST['email']."' AND patientPassword = '".$_POST['password']."'";
    $result2 = mysqli_query($con, $query2);
    $row2 = $result2->fetch_array();
    $count2 = $result2->num_rows;

    

    if($count==1)
    {
      $_SESSION['staffID'] = $row['staffID'];
      $_SESSION['staffRole'] = $row['staffRole'];

      $_SESSION ['staffID']=  $row['staffID'];

      if($row['staffRole'] == "Admin")
      {
        header("location:dashboardAdmin.php");
      }
      else if($row['staffRole'] == "Nurse")
      {
        header("location:dashboardNurse.php");
      }
      else
      {
        header("location:login.php?ERROR!!!!");
      }
    }
    else if ($count2==1)
    {
      $_SESSION ['patientIC'] =  $row2['patientIC'];
      header("location:dashboardPatient.php");
      
    }
    else
    {
        header ("location: login.php?ERROR");
    }


}

// if(isset($_POST['logout']))
// {
//     destroy($_SESSION['patientIC']);
//     // echo json_encode('nada');
//     header("location: login.php");
// }

?>
