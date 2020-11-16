<?php
session_start();
unset($_SESSION["staffID"]);
unset($_SESSION["patientIC"]);
header("Location:login.php");
?>