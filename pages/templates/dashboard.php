<?php

require_once "../init.php";
if (!isset($_SESSION['user_username'])) {
  header('Location: ' . BASEURL . 'login.php');
  exit();
}

$DB = new Database('user');



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="style/css/bootstrap.css">
  <title>Dashboard</title>
</head>

<body>
  <div class="container-fluid bg-light overflow-hidden p-0" style="height: 100vh">
    <div class="row" style="width: 100%; height: 100%">
      <div class="col-2 bg-dark shadow-lg" style="height: 100%">
        <div class="row border-bottom text-center d-flex align-items-center" style="height: 5em">
          <div class="col">
            <i class="large material-icons fs-1" style="color: #1572A1">face</i>
          </div>
          <div class="col">
            <h3 style="color: white">
              <?= $_SESSION['user_username'] ?>
            </h3>
            <p style="color: white">
              <?= $_SESSION['user_rule'] ?>
            </p>
          </div>
        </div>
        <div class="row" style="color: white">
          <div class="btn border text-center" style="color: white">
            <a href="beranda.php" style="
              text-decoration: none;
              color: white
            ">Beranda</a>
          </div>
          <div class="btn border text-center" style="color: white">
            <a href="dashboard/teacher.php" style="
              text-decoration: none;
              color: white
            ">Teacher</a>
          </div>
          <div class="btn border text-center" style="color: white">
            <a href="dashboard/student.php" style="
              text-decoration: none;
              color: white
            ">Student</a>
          </div>
          <div class="btn border text-center bg-danger" style="color: white">
            <a href="dashboard/logout.php" style="
              text-decoration: none;
              color: white
            ">Logout</a>
          </div>
        </div>
      </div>
      <div class="col ">
        <div class="row text-center d-flex align-items-center" style="
          height: 5em;
          width: 100%;
          background: #1572A1
          
        ">
          <h2>DEPONIK SMK TUNAS PELITA BINJAI</h2>
        </div>
        <div class="row">