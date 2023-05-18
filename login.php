<?php

session_start();

include_once 'database\conexion.php';
// include('session.php');
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$objeto2 = new Conexion();
$db = $objeto2->ConectarSqli();

if($_SERVER["REQUEST_METHOD"] == "POST") {
  // username and password sent from form 
  
  $myemail = mysqli_real_escape_string($db,$_POST['email']);
  $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
  
  $sql = "SELECT numCuenta FROM cuenta WHERE correo = '$myemail' and contrasena = '$mypassword'";
  $result = mysqli_query($db,$sql);
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  // $active = $row['active'];
  
  $count = mysqli_num_rows($result);
  
  // If result matched $myusername and $mypassword, table row must be 1 row

  if($count == 1) {
    $_SESSION['login_user'] = $myemail;
     
    header("location: catalogo.php");
  }else {
    echo "<script> alert('Los datos ingresados son invalidos.') </script>";
  }
}

if(isset($_SESSION["id"])) {
header("Location:index.php");
}

?>
<!doctype html>
<html lang="en">
  <head> 
    
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="#" />
    <title>Inicio</title>
    <!-- Otros -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css">
    <link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.11.4/css/dataTables.bootstrap5.min.css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/all.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="static/css/chat.css">
  </head>

  <body>
  <header class="p-3 mb-3 border-bottom">
  
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        
      <a href="catalogo.php">
        <img src="img/logoSmall.png"  width="40%" height="70%" class="rounded mx-auto d-block" alt="Responsive image">
      </a>
      
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        
          <li><a href="#" class="nav-link px-2 link-primary">Inicio</a></li>
          <li><a href="catalogo.php" class="nav-link px-2 link-dark">Catalogo</a></li>
        </ul>
        
        <?php 

          if(isset($_SESSION['login_user'])){
            require_once("php/usernav.php");
          }
          else{
            ?>
            <a href="login.php" class="nav-link px-2 link-dark">Inicia Sesión</a>
        <a href="register.php" class="nav-link px-2 link-dark">Registrate</a>
        <?php
          }
        ?>
        <?php require_once("php/carticon.php")?>
      </div>
    </div>
  </header>

  <section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp" class="img-fluid"
          alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form name="frmUser" method="post" action="" align="center">
          

          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0"></p>
          </div>

          <!-- Email input -->
          <div class="form-outline mb-4">
            <label class="form-label" for="form3Example3">Correo electrónico</label>
            <input type="email" id="form3Example3" class="form-control form-control-lg" name="email"
              placeholder="Ingresa un correo electrónico válido" maxlength="40" required/>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
            <label class="form-label" for="form3Example4">Contraseña</label>
            <input type="password" id="form3Example4" class="form-control form-control-lg" name="password"
              placeholder="Ingresa contraseña" maxlength="50" required/>
          </div>

          <div class="d-flex justify-content-between align-items-center">
            <!-- Checkbox -->
            <div class="form-check mb-0">
              <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
              <label class="form-check-label" for="form2Example3">
                Recordarme
              </label>
            </div>
            <a href="#!" class="text-body">¿Olvidaste tú contraseña?</a>
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;" name="submit" href="#">Entrar</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">¿No tienes cuenta? <a href="register.php"
                class="link-danger">Regístrate</a></p>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>

<footer class="text-center text-white" style="background-color: #1755cf">
    <!-- Grid container -->
    <div class="container">
      <!-- Section: Links -->
      <section class="mt-5">
        <!-- Grid row-->
        <div class="row text-center d-flex justify-content-center pt-5">
          <!-- Grid column -->
          <div class="col-md-2">
            <h6 class="text-uppercase font-weight-bold">
              <a href="#!" class="text-white">¿Quiénes somos?</a>
            </h6>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-2">
            <h6 class="text-uppercase font-weight-bold">
              <a href="catalogo.php" class="text-white">Productos</a>
            </h6>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-2">
            <h6 class="text-uppercase font-weight-bold">
              <a href="faq.php" class="text-white">Ayuda</a>
            </h6>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-2">
            <h6 class="text-uppercase font-weight-bold">
              <a href="#!" class="text-white">Contacto</a>
            </h6>
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row-->
      </section>
      <!-- Section: Links -->

      <hr class="my-5"/>

      <!-- Section: Text -->
      <section class="mb-5">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-8">
            <p>
              En Sión queremos ayudarte a ti y a tu familia                    
              Aquí te ayudamos con lo mejor del mercado en juegos didácticos
              Ven a conocernos
            </p>
          </div>
        </div>
      </section>
      <!-- Section: Text -->

      <!-- Section: Social -->
      <section class="text-center mb-5">
        <a target="_blank" href="https://www.facebook.com/AutismoABP" class="text-white me-4 social">
          <i class="fab fa-facebook fa-2x"></i>
        </a>

        <a target="_blank" href="https://instagram.com/globospuntoycomaa" class="text-white me-4 social">
          <i class="fab fa-instagram fa-2x"></i>
        </a>
      </section>
      <!-- Section: Social -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div
         class="text-center p-3"
         style="background-color: rgba(0, 0, 0, 0.2)"
         >
      © 2022 Copyright:
      <a class="text-white"
         >Sión</a
        >
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->

    <script src="jQuery/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="datatables/datatables.min.js"></script>
    <!-- chatbot-->
    <div class="chat-bar-collapsible">
        <button id="chat-button" type="button" class="collapsible">SION
            <i id="chat-icon" style="color: #fff;" class="fa fa-fw fa-comments-o"></i>
        </button>

        <div class="content">
            <div class="full-chat-block">
                <!-- Message Container -->
                <div class="outer-container">
                    <div class="chat-container">
                        <!-- Messages -->
                        <div id="chatbox">
                            <h5 id="chat-timestamp"></h5>
                            <p id="botStarterMessage" class="botText"><span>Cargando...</span></p>
                        </div>

                        <!-- User input box -->
                        <div class="chat-bar-input-block">
                            <div id="userInput">
                                <input id="textInput" class="input-box" type="text" name="msg"
                                    placeholder="Presiona 'Enter' para enviar un mensaje">
                                <p></p>
                            </div>

                            <div class="chat-bar-icons">
                                <i id="chat-icon" style="color: #3b6fff;" class="fa fa-fw fa-heart"
                                    onclick="heartButton()"></i>
                                <i id="chat-icon" style="color: #333;" class="fa fa-fw fa-send"
                                    onclick="sendButton()"></i>
                            </div>
                        </div>

                        <div id="chat-bar-bottom">
                            <p></p>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
  </body>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="static/scripts/responses.js"></script>
<script src="static/scripts/chat.js"></script>
</html>
