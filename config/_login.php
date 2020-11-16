<?php
    $conn = new mysqli ("localhost", "root", "", "bookingappointment");

    if($conn->connect_error) {
        die("Connection Failed" . $conn->connect_error);
    }else{
      echo "Connected successfully: ";
      echo "<br>";
    }

    


    $patientIC = $patientName = $patientPhone = $patientEmail = $patientPassword = "";

    $result = array ('error'=>false);
    $action = '';

    if(isset($_GET['action'])) {
        $action = $_GET['action'];
    }


    if($action == 'read'){
      $sql = "SELECT * FROM patient";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo "Identity Number: " . $row["patientIC"]. " - Name: " . $row["patientName"]. " Phone Number:" . $row["patientEmail"]. "<br>";
        }
      } else {
        echo "0 results";
      }
    }


    if ($action == 'create') {
      $patientIC = $_POST['patientIC'];
      $patientName = $_POST['patientName'];
      $patientPhone = $_POST['patientPhone'];
      $patientEmail = $_POST['patientEmail'];
      $patientPassword = $_POST['patientPassword'];

      $sql = "INSERT INTO patient (patientIC, patientName, patientPhone, patientEmail, patientPassword)
      VALUES ('$patientIC' , '$patientName' , '$patientPhone', '$patientEmail', '$patientPassword' )";

      if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
      } else {
         echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }

    if ($action == 'login') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM staff WHERE staffEmail = '$email' AND staffPassword = '$password'";
        $result = mysqli_query($conn, $query);
        $row = $result->fetch_array();
        $count = $result->num_rows;
  
        $query2 = "SELECT * FROM patient WHERE patientEmail = '$email' AND patientPassword = '$password'";
        $result2 = mysqli_query($conn, $query2);
        $row2 = $result2->fetch_array();
        $count2 = $result2->num_rows;
  
        if($count==1)
        {
         
          $staffEmail = $row['staffEmail'];
          $staffRole = $row['staffRole'];
          
          $_SESSION ['staffID']=  $row['staffID'];

          if($row['staffRole'] == "Admin")
          {
           
            $abc = $_SESSION ['staffID'];
            echo "staffID: " . $abc . "<br";
          }
          else if($row['staffRole'] == "Nurse")
          {
                     
            $abc = $_SESSION ['staffID'];
            echo "staffID: " . $abc . "<br";
            
          }
          else
          {
            echo "gila";
            echo  $row["staffID"];
          }
        }
        else if ($count2==1)
        {
          $patientEmail = $row2['patientEmail'];
          $_SESSION ['patientIC'] =  $row2['patientIC'];
          $abc = $_SESSION ['patientIC'];
         
          $abc = $_SESSION ['patientIC'];
          echo  "patientIC: " . $abc . "<br>";
          
        }
        else
        {
            //header ("login.html?ERROR");
            echo "Email address not found. Please register";
        }


    }

?>

