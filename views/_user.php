<?php

    $con = mysqli_connect("localhost", "root", "", "bookingappointment") or die ('Unable to connect to MYSQL: ' . mysqli_connect_error());

    session_start();

    //BOOK APPT
    if(isset($_POST['bookAppointment']))
    {
        
        $appService = $_POST['appService'];
        $appDate = $_POST['appDate'];
        $appTime = $_POST['appTime'];
        $patientIC = $_SESSION['patientIC'];


        $query = "INSERT INTO appointment
        VALUES (default, '$appService', '$appDate', '$appTime', default, '$patientIC', default)";
        mysqli_query($con, $query) or die ('Failed to query ' . mysqli_error());
        header("location:historyApp.php");

        mysqli_close($con);
    }

    //UPDATE PROFILE
  if(isset($_POST['updateProfile']))
    {
        
        $patientName = $_POST['patientName'];
        $patientPhone = $_POST['patientPhone'];
        $patientEmail = $_POST['patientEmail'];
        $patientIC = $_SESSION['patientIC'];


        $query = "UPDATE patient SET patientName='$patientName', patientPhone='$patientPhone', patientEmail='$patientEmail' 
            WHERE patientIC='$patientIC'";
        mysqli_query($con, $query) or die ('Failed to query ' . mysqli_error());
        header("location:profilePatient.php");

        mysqli_close($con);
    }
?>