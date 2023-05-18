<?php
   include_once 'database\conexion.php';
   $objeto = new Conexion();
   $conexion = $objeto->Conectar();
   $objeto2 = new Conexion();
   $db = $objeto2->ConectarSqli();
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select numCuenta from cuenta where correo = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
      die();
   }
?>