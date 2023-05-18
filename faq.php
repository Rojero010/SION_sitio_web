<?php
include_once 'database\conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
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

    <link rel="stylesheet" href="static/css/chat.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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

  <!--Section: FAQ-->
<section>
  <h3 class="text-center mb-4 pb-2 text-primary fw-bold">FAQ</h3>
  <p class="text-center mb-5">
    A continuación encontrará las respuestas a las preguntas más frecuentes
  </p>
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col col-md-4 col-sm-6 col-12">
        <h6 class="mb-3 text-primary"><i class="far fa-paper-plane text-primary pe-2"></i> ¿Tienen algun convenio o 
        alianza con algún psicólogo?</h6>
        <p>
          Si, contamos con la ayuda de psicólogos y especialistas para determinar los beneficios que nuestros productos pueden ofrecer
        </p>
      </div>

      <div class="col col-md-4 col-sm-6 col-12">
        <h6 class="mb-3 text-primary"><i class="fas fa-pen-alt text-primary pe-2"></i>¿Dónde puedo ver para 
        qué sirve el juguete?</h6>
        <p>
          <strong><u></u></strong> Los productos están separados por el tipo de beneficio que ofrecen.
        </p>
      </div>

      <div class="col col-md-4 col-sm-6 col-12">
        <h6 class="mb-3 text-primary"><i class="fas fa-user text-primary pe-2"></i> ¿Como saber el tiempo de entrega?
        </h6>
        <p>
          El tiempo estimado de entrega es de 2 a 4 días 
        </p>
      </div>
    </div>

    <br><br>
    
    <div class="row justify-content-md-center">
      <div class="col col-md-4 col-sm-6 col-12">
        <h6 class="mb-3 text-primary"><i class="fas fa-rocket text-primary pe-2"></i> ¿Costos de envió?
        </h6>
        <p>
          Los costos de envio son a partir de 70pesos
        </p>
      </div>

      <div class="col col-md-4 col-sm-6 col-12">
        <h6 class="mb-3 text-primary"><i class="fas fa-home text-primary pe-2"></i> ¿Aceptaran devoluciones?
        </h6>
        <p>Si, aceptamos devoluciones</p>
      </div>

      <div class="col col-md-4 col-sm-6 col-12">
        <h6 class="mb-3 text-primary"><i class="fas fa-book-open text-primary pe-2"></i> ¿Tienen atención a clientes?</h6>
        <p>
          Si, ya sea contactandonos por telefono o en nuestras redes sociales
        </p>
      </div>
    </div>

    <br><br>
    
    <div class="row justify-content-md-center">
      <div class="col col-md-4 col-sm-6 col-12">
        <h6 class="mb-3 text-primary"><i class="fas fa-rocket text-primary pe-2"></i> ¿Los productos son de calidad?
        </h6>
        <p>
          Son de la mejor calidad y se encuentran al mejor precio
        </p>
      </div>

      <div class="col col-md-4 col-sm-6 col-12">
        <h6 class="mb-3 text-primary"><i class="fas fa-home text-primary pe-2"></i> ¿Qué hago si mi producto llega dañado?
        </h6>
        <p>Si tu producto llega dañado, por favor reportalo a nuestro numero</p>
      </div>

      <div class="col col-md-4 col-sm-6 col-12">
        <h6 class="mb-3 text-primary"><i class="fas fa-book-open text-primary pe-2"></i> ¿Puedo cancelar un pedido?</h6>
        <p>
          Por el momento no se pueden cancelar los pedidos
        </p>
      </div>
    </div>
  </div>  
</section>
<!--Section: FAQ-->

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
    <script src="javascript/funcs.js"></script>


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
