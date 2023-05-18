<?php

//start session
session_start();
//conectar con base de datos
include_once 'database\conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
//llamar a component.php 
require_once('./php/component.php');

//agregar producto a carrito 
if(isset($_POST['add'])){
  // print_r($_POST['productid']);
  if(isset($_SESSION['cart'])){

    $item_array_id = array_column($_SESSION['cart'], "productid");

    if(in_array($_POST['productid'], $item_array_id)){
      echo "<script>alert('Ese producto ya fue agregado.')</script>";
      echo "<script>window.location='cart.php'</script>";
    }else{
      $count = count($_SESSION['cart']);
      $item_array = array(
        'productid' => $_POST['productid'],
        'cantidad' => 1
      );

      $_SESSION['cart'][$count] = $item_array;
      // print_r($_SESSION['cart']);
    }

  }else{
    $item_array = array(
      'productid' => $_POST['productid'],
      'cantidad' => 1
    );

    //create new session variable
    $_SESSION['cart'][0] = $item_array;
    // print_r($_SESSION['cart']);
  }
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
    <!-- navbar y contenido-->
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
  
  

  <main>
<!-- mostrar catalogo-->
  <section class="py-4 text-center container col-md-4">
    <select id="cat" class="form-select">
      <option selected>Seleccione una categoría</option>
      <?php
        $sql = "SELECT nombre_categoria, idCategoria FROM categoria";
        $resultado = $conexion->prepare($sql);
        $resultado->execute();
        while($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
        echo '<option value="'.$row['idCategoria'].'">'.$row['nombre_categoria'].'</option>';
        }
      ?>
    </select>
  </section>

  <div class="album py-5 bg-light" id="products">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php
          $catId= $_COOKIE['catId'];
          $sql = 'SELECT nombreProducto, precio, img, idProducto FROM producto WHERE idCategoria='.$catId.';';
          $resultado = $conexion->prepare($sql);
          $resultado->execute();
          while($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            component($row['nombreProducto'],$row['precio'],$row['img'],$row['idProducto']);
          }
        ?>
      </div>
    </div>
  </div>

</main>
    <!-- footer -->
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
    <script src="javascript/categorias.js"></script>


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
<!-- llamada a scripts necesarios -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="static/scripts/responses.js"></script>
<script src="static/scripts/chat.js"></script>
</html>
