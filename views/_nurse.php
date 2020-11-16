<?php 

    header('Access-Control-Allow-Origin: *');
    session_start();
    $conn = new mysqli ("localhost", "root", "", "bookingappointment");

    
    if($conn->connect_error) {
        die("Connection Failed" . $conn->connect_error);
    }
    
    $result = array ('error'=>false);
    $action = '';

    // if(isset($_GET['action'])) {
    //     $action = $_GET['action'];
    // }

    // // READ APPT
    // if ($action == '0') {
    //     $condition = 'Processing';
        
    //     $sql = $conn->query("SELECT patient.*, appointment.* FROM patient INNER JOIN appointment
    //         ON patient.patientIC=appointment.patientIC WHERE appStatus = '$condition' ORDER BY appDate ");
    //     $appointments = array();

    //     while ($row = $sql->fetch_assoc()) {
    //         array_push($appointments, $row);
    //     }

    //     $result ['appointments'] = $appointments;
    // }



    //APPROVE APPT 
    if (isset($_POST['approveAppt'])) {
        

        $sql = $conn->prepare("UPDATE appointment SET appStatus = ? WHERE appID = ?");
        $sql->bind_param("si", $condition, $id);

        $id = $_POST['appID'];
        $condition = 'Approved';
        $sql->execute();

        if ($sql) {
            $result['message'] = "Appointment approved!";
        } else {
            $result['error'] = true;
            $result['message'] = "Failed to approve appointment!";
        }
    }

    //REJECT APPT 
    if (isset($_POST['rejectAppt'])) {
        

        $sql = $conn->prepare("UPDATE appointment SET appStatus = ? WHERE appID = ?");
        $sql->bind_param("si", $condition, $id);

        $id = $_POST['appID'];
        $condition = 'Rejected';
        $sql->execute();

        if ($sql) {
            $result['message'] = "Appointment rejected!";
        } else {
            $result['error'] = true;
            $result['message'] = "Failed to reject appointment!";
        }
    }

    

    $conn->close();
    echo json_encode($result);

?>