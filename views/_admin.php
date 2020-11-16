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


    //CRUD APPOINTMENT LIST

    // # READ APPT
    // if ($action == '0') {
        
    //     // $sql = $conn->query("SELECT * FROM appointment");
    //     $sql = $conn->query("SELECT patient.*, appointment.* FROM patient INNER JOIN appointment
    //         ON patient.patientIC=appointment.patientIC ORDER BY appDate");
    //     $appointments = array();

    //     while ($row = $sql->fetch_assoc()) {
    //         array_push($appointments, $row);
    //     }

    //     $result ['appointments'] = $appointments;
    // }

    # CREATE APPT
    if (isset($_POST['addAppt'])) {

        $sql = $conn->prepare("INSERT INTO appointment (patientIC, appService, appDate, appTime) VALUES (?,?,?,?)");
        $sql->bind_param("ssss", $patientIC, $appService, $appDate, $appTime);
        
        //set params and execute
        $patientIC = $_POST['patientIC'];
        $appService = $_POST['appService'];
        $appDate = $_POST['appDate'];
        $appTime = $_POST['appTime'];
        $sql->execute();

        if ($sql) {
            header("Location: listApp.php");
            $result['message'] = "Appointment added successfully!";
        } else {
            $result['error'] = true;
            $result['message'] = "Failed to add appointment!";
        }
    }

    # UPDATE APPT
    if (isset($_POST['updateAppt'])) {
        

        $sql = $conn->prepare("UPDATE appointment SET appService = ?, appDate = ?, appTime = ? WHERE appID = ?");
        $sql->bind_param("sssi", $appService, $appDate, $appTime, $id);

        $id = $_POST['appID'];
        $appService = $_POST['appService'];
        $appDate = $_POST['appDate'];
        $appTime = $_POST['appTime'];
        $sql->execute();

        if ($sql) {
            header("Location: listApp.php");
            $result['message'] = "Appointment updated successfully!";
        } else {
            $result['error'] = true;
            $result['message'] = "Failed to update appointment!";
        }
    }

    # DELETE APPT
    if (isset($_POST['deleteAppt'])) {
     
        $sql = $conn->prepare("DELETE FROM appointment WHERE appID = ?");
        $sql->bind_param("i", $id);

        $id = $_POST['appID'];
        $sql->execute();

        if ($sql) {
            header("Location: listApp.php");
            $result['message'] = "Appointment deleted successfully!";
        } else {
            $result['error'] = true;
            $result['message'] = "Failed to delete appointment!";
        }
    }



    //CRUD PATIENT LIST

    // # READ PATIENT
    // if ($action == '4') {
        
    //     $sql = $conn->query("SELECT * FROM patient ORDER BY patientName");
    //     $patients = array();

    //     while ($row = $sql->fetch_assoc()) {
    //         array_push($patients, $row);
    //     }

    //     $result ['patients'] = $patients;
    // }

    # CREATE PATIENT
    if (isset($_POST['addPatient'])) {

        $sql = $conn->prepare("INSERT INTO patient (patientIC, patientName, patientPhone, patientEmail) VALUES (?,?,?,?)");
        $sql->bind_param("ssss", $patientIC, $patientName, $patientPhone, $patientEmail);

        $patientIC = $_POST['patientIC'];
        $patientName = $_POST['patientName'];
        $patientPhone = $_POST['patientPhone'];
        $patientEmail = $_POST['patientEmail'];
        $sql->execute();

        if ($sql) {
            header("Location: listPatient.php");
            $result['message'] = "Patient added successfully!";
        } else {
            $result['error'] = true;
            $result['message'] = "Failed to add patient!";
        }
    }

    # UPDATE PATIENT
    if (isset($_POST['updatePatient'])) {

        $sql = $conn->prepare("UPDATE patient SET patientName = ?, patientPhone = ?, patientEmail = ? WHERE patientIC = ? ");
        $sql->bind_param("ssss", $patientName, $patientPhone, $patientEmail, $ic);

        $ic = $_POST['patientIC'];
        $patientName = $_POST['patientName'];
        $patientPhone = $_POST['patientPhone'];
        $patientEmail = $_POST['patientEmail'];
        $sql->execute();

        if ($sql) {
            header("Location: listPatient.php");
            $result['message'] = "Patient updated successfully!";
        } else {
            $result['error'] = true;
            $result['message'] = "Failed to update patient!";
        }
    }

    # DELETE PATIENT
    if (isset($_POST['deletePatient'])) {

        $sql = $conn->prepare("DELETE FROM patient WHERE patientIC = ?");
        $sql->bind_param("s", $ic);

        $ic = $_POST['patientIC'];
        $sql->execute();

        if ($sql) {
            header("Location: listPatient.php");
            $result['message'] = "Patient deleted successfully!";
        } else {
            $result['error'] = true;
            $result['message'] = "Failed to delete patient!";
        }
    }


    //CRUD STAFF LIST

    # READ STAFF
    // if ($action == '8') {
        
    //     $sql = $conn->query ("SELECT * FROM staff");
    //     $staffs = array ();

    //     while ($row = $sql->fetch_assoc()) {
    //         array_push($staffs, $row);
    //     }

    //     $result ['staffs'] = $staffs;
    // }

    # CREATE STAFF
    if (isset($_POST['addStaff'])) {

        $sql = $conn->prepare("INSERT INTO staff (staffID, staffName, staffPhone, staffEmail, staffRole) VALUES (?,?,?,?,?)");
        $sql->bind_param("sssss", $staffID, $staffName, $staffPhone, $staffEmail, $staffRole);

        $staffID = $_POST['staffID'];
        $staffName = $_POST['staffName'];
        $staffPhone = $_POST['staffPhone'];
        $staffEmail = $_POST['staffEmail'];
        $staffRole = $_POST['staffRole'];
        $sql->execute();

        if ($sql) {
            header("Location: listStaff.php");
            $result['message'] = "Staff added successfully!";
        } else {
            $result['error'] = true;
            $result['message'] = "Failed to add staff!";
        }
    }

    # UPDATE STAFF
    if (isset($_POST['updateStaff'])) {

        $sql = $conn->prepare("UPDATE staff SET staffName = ?, staffPhone = ?, staffEmail = ?, staffRole = ? WHERE staffID = ? ");
        $sql->bind_param("sssss", $staffName, $staffPhone, $staffEmail, $staffRole, $staffID);
         
        $staffID = $_POST['staffID'];
        $staffName = $_POST['staffName'];
        $staffPhone = $_POST['staffPhone'];
        $staffEmail = $_POST['staffEmail'];
        $staffRole = $_POST['staffRole'];
        $sql->execute();

        if ($sql) {
            header("Location: listStaff.php");
            $result['message'] = "Staff updated successfully!";
        } else {
            $result['error'] = true;
            $result['message'] = "Failed to update staff!";
        }
    }

    # DELETE STAFF
    if (isset($_POST['deleteStaff'])) {

        $sql = $conn->prepare("DELETE FROM staff WHERE staffID = ?");
        $sql->bind_param("s", $staffID);

        $staffID = $_POST['staffID'];
        $sql->execute();

        if ($sql) {
            header("Location: listStaff.php");
            $result['message'] = "Staff deleted successfully!";
        } else {
            $result['error'] = true;
            $result['message'] = "Failed to delete staff!";
        }
    }

    # UPDATE PROFILE
    if(isset($_POST['updateProfile'])){
        
        $staffName = $_POST['staffName'];
        $staffPhone = $_POST['staffPhone'];
        $staffEmail = $_POST['staffEmail'];
        $staffID = $_SESSION['staffID'];


        $query = "UPDATE staff SET staffName='$staffName', staffPhone='$staffPhone', staffEmail='$staffEmail' 
            WHERE staffID='$staffID'";
        mysqli_query($conn, $query) or die ('Failed to query ' . mysqli_error());
        header("location:profileAdmin.php");

        mysqli_close($con);
    }


    $conn->close();
    

?>