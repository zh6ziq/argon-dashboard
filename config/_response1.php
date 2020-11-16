<?php

   /*$data = json_decode(file_get_contents("php://input"));
   $request = $data->request;
   if($request == 1){
       $username = $data->username;
       $password = $data->password;
       if($username=='test'&&$password=='test'){
           $response[] = array('status'=>1);
       }else{
         $response[] = array('status'=>0);
       }
       echo json_encode($response);
       exit;
   }*/
  

    $conn = new mysqli ("localhost", "root", "", "bookingappointment");

    if($conn->connect_error) {
        die("Connection Failed" . $conn->connect_error);
    }else{
      echo "Connected successfully";
    }

    


    // $patientIC = $patientName = $patientPhone = $patientEmail = $patientPassword = "";

    $result = array ('error'=>false);
    $action = '';

    if(isset($_GET['action'])) {
        $action = $_GET['action'];
    }

    //get all patient data
    if($action == 'read'){
      $sql = "SELECT * FROM patient";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo "id: " . $row["patientIC"]. " - Name: " . $row["patientName"]. " " . $row["patientEmail"]. "<br>";
        }
      } else {
        echo "0 results";
      }
    }




    //get patient data based on IC
    if($action == 'readOne'){
    $sql = "SELECT * FROM patient WHERE patientIC='97' ";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
      echo "id: " . $row["patientIC"]. " - Name: " . $row["patientName"]. "<br>";
      }
    } else {
      echo "0 results";
    }
  } 



    // if($action == 'read'){
    //     $sql = $conn->query("SELECT * FROM staff");
    //     $staff = array();
    //     while($row = $sql->fetch_assoc()){
    //         array_push($staff, $row);
    //     }
    //     $result['staff'] = $staff;
    // }
    // echo $staff;

    // if ($action == 'create') {
    //     $patientIC = $_POST['patientIC'];
    //     $patientName = $_POST['patientName'];
    //     $patientPhone = $_POST['patientPhone'];
    //     $patientEmail = $_POST['patientEmail'];
    //     $patientPassword = $_POST['patientPassword'];

    //     $sql = $conn->query ("INSERT INTO patient (patientIC, patientName, patientPhone, patientEmail, patientPassword)
    //     VALUES ('$patientIC, '$patientName', '$patientPhone', '$patientEmail', '$patientPassword')");

    //     if ($sql) {
    //         $result['message'] = "User added successfully!";
    //     } else {
    //         $result['error'] = true;
    //         $result['message'] = "Failed to add user!";
    //     }
    // }

    if ($action == 'create') {
      $patientIC = isset($_POST['patientIC']) ? $_POST['patientIC'] : '';
      $patientName = isset($_POST['patientName']) ? $_POST['patientName'] : '';
      $patientPhone = isset($_POST['patientPhone']) ? $_POST['patientPhone'] : '';
      $patientEmail = isset($_POST['patientEmail']) ? $_POST['patientEmail'] : '';
      $patientPassword = isset($_POST['patientPassword']) ? $_POST['patientPassword'] : '';




      // $patientIC = $_POST['patientIC'];
      // $patientName = $_POST['patientName'];
      // $patientPhone = $_POST['patientPhone'];
      // $patientEmail = $_POST['patientEmail'];
      // $patientPassword = $_POST['patientPassword'];

      $sql = "INSERT INTO patient (patientIC, patientName, patientPhone, patientEmail, patientPassword)
      VALUES ('$patientIC' , '$patientName' , '$patientPhone', '$patientEmail', '$patientPassword' )";

      if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
      } else {
         echo "Error: <br>" . $conn->error;
      }
    }

?>
