<?php
//start session
session_start();
//conectar con la base de datos
include_once 'database\conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
//llama a component.php
require_once('./php/component.php');
// eliminar articulos
if (isset($_POST['remove'])){
  if ($_GET['action'] == 'remove'){
      foreach ($_SESSION['cart'] as $key => $value){
          if($value["productid"] == $_GET['id']){
              unset($_SESSION['cart'][$key]);
              echo "<script>alert('Producto removido.')</script>";
              echo "<script>window.location = 'cart.php'</script>";
          }
      }
  }
} 
//actualizar articulos
if (isset($_POST['update-'])){
  if ($_GET['cant'] > '1'){
      $newcant = $_GET['cant'] - 1;
      $prodid = $_GET['id'];

      foreach ($_SESSION['cart'] as $key => $value){
          if($value["productid"] == $_GET['id']){
              $_SESSION['cart'][$key]['cantidad'] = $newcant;
          }
      }

  } else {
    foreach ($_SESSION['cart'] as $key => $value){
      if($value["productid"] == $_GET['id']){
          unset($_SESSION['cart'][$key]);
          echo "<script>alert('Producto removido.')</script>";
          echo "<script>window.location = 'cart.php'</script>";
      }
    }
  }
}

if (isset($_POST['update+'])){
  if ($_GET['cant'] >= '1'){
      $newcant = $_GET['cant'] + 1;
      $prodid = $_GET['id'];
      
      foreach ($_SESSION['cart'] as $key => $value){
          if($value["productid"] == $_GET['id']){
              $_SESSION['cart'][$key]['cantidad'] = $newcant;
          }
      }
      
  }
}
//calculo del pago
if (isset($_POST['pay'])){
  if ($_GET['cant'] >= '1'){
      $newcant = $_GET['cant'] + 1;
      $prodid = $_GET['id'];
      
      $sql = "UPDATE producto SET unidad = '$newcant' WHERE idProducto = '$prodid'";
      $resultado = $conexion->prepare($sql);
      $resultado->execute();
      
  }
}
?>

<!doctype html>
<html lang="en">
  <head> 
    <!-- llamada a css-->
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="static/css/chat.css">
  </head>

  <body>
  <header class="p-3 mb-3 border-bottom">
  <!-- navbar y contenido -->
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        
      <a href="catalogo.php">
        <img src="img/logoSmall.png"  width="40%" height="70%" class="rounded mx-auto d-block" alt="Responsive image">
      </a>
      
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        
          <li><a href="#" class="nav-link px-2 link-primary">Inicio</a></li>
          <li><a href="catalogo.php" class="nav-link px-2 link-dark">Catalogo</a></li>
        </ul>
        
        <?php 
      //revisa si hay inicio de sesión
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
        <!-- llama icono de carrito y sus funciones-->
        <?php require_once("php/carticon.php")?>
      </div>
    </div>
  </header>


  <main>  
    <!-- opciones de carrito -->
<div class="container">
    <div class="row px-5">
        <div class="col-md-7">
            <div class="shopping-cart">
            <div class="d-flex justify-content-between">
              <h4>Mi Carrito</h4>
              <div class="col-md-3">
                <button onclick="gift()" class='form-control btn btn-success submit-button' type='submited'>Es un Regalo</button>
            
              </div>
            </div>
                <hr>

                <?php
          //<!-- productos de carrito -->
                $_SESSION['total'] = 0;
                
                    if (isset($_SESSION['cart'])){
                        $productid = array_column($_SESSION['cart'], 'productid');

                        $sql = "SELECT nombreProducto, precio, img, idProducto FROM producto";
                        $resultado = $conexion->prepare($sql);
                        $resultado->execute();
                        while($row = $resultado->fetch(PDO::FETCH_ASSOC)){
                            foreach ($productid as $id){
                                if ($row['idProducto'] == $id){
                                  foreach ($_SESSION['cart'] as $key => $value){
                                    if($value["productid"] == $id){
                                    cartElement($row['img'], $row['nombreProducto'],$row['precio'], $row['idProducto'], $_SESSION['cart'][$key]['cantidad']);
                                    $_SESSION['total'] = $_SESSION['total'] + (int)$row['precio']* $_SESSION['cart'][$key]['cantidad'];
                                    }
                                  }
                                }
                            }
                        }
                    }
                    if($_SESSION['total'] == 0) {
                        echo "<h5>Carrito Vacio.</h5>";
                    }

                ?>

            </div>
        </div>
        <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">
      <!-- monto total a pagar -->
            <div class="pt-4">
                <h6>DETALLES DE PRECIO</h6>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <?php
                            if (isset($_SESSION['cart'])){
                              $count = 0;
                              foreach ($_SESSION['cart'] as $key => $value){
                                $count += $_SESSION['cart'][$key]['cantidad'];
                              }

                                echo "<h6>Precio ($count)</h6>";
                            }else{
                                echo "<h6>Precio (0 productos)</h6>";
                            }
                            if(isset($_SESSION['regalo'])){
                              echo "<h6>Regalo </h6>";
                            }
                        ?>
                        <h6>Costo Envio</h6>
                        <hr>
                        <h6>Monto a Pagar</h6>
                    </div>
                    <div class="col-md-6">
                        <h6>$<?php echo $_SESSION['total']; ?></h6>
                        <?php
                            if(isset($_SESSION['regalo'])){
                              echo "<h6>$ "; echo $_SESSION['total']; echo "</h6>";
                            }
                        ?>
                        <h6 class="text-success">GRATIS</h6>
                        <hr>
                        <h6>$<?php
                            echo $_SESSION['total'];
                            ?></h6>
                    </div>
                </div>
            </div>
            <?php
              if ($_SESSION['total'] != 0){
                echo "<div class='form-row mt-2 mb-2 d-flex justify-content-between'>

                  <a href=\"payment.php\" class='form-control btn btn-primary submit-button' type='submited'>Pagar »</a>

                </div>";
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
    <script type="text/javascript">
<!-- opciones de regalo -->
      function gift(){
        Swal.fire({
          title: 'Selecciona las Opciones',
          html:
          '<div class="form mx-auto" style="width: 300px;">'+
            '<div class="form-group">'+
              '<label for="exampleFormControlSelect1">Color<span></span></label>'+
              '<select class="form-control round" id="exampleFormControlSelect1">'+
                '<option class="">Azul Cielo</option>'+
                '<option class="amount">Azul Marino</option>'+
                '<option class="amount">Verde Vivo</option>'+
                '<option class="amount">Amarillo</option>'+
                '<option class="amount">Rojo</option>'+
                '<option class="amount">Rosa</option>'+
                '<option class="amount">Morado</option>'+
             '</select>'+
            '</div>'+
            '<div class="form-group mt-2">'+
              '<label for="exampleFormControlSelect1">Liston<span></span></label>'+
              '<select class="form-control round" id="exampleFormControlSelect1">'+
                '<option class="">Azul Cielo</option>'+
                '<option class="amount">Azul Marino</option>'+
                '<option class="amount">Verde Vivo</option>'+
                '<option class="amount">Amarillo</option>'+
                '<option class="amount">Rojo</option>'+
                '<option class="amount">Rosa</option>'+
                '<option class="amount">Morado</option>'+
                '<option class="amount">Ninguno</option>'+
             '</select>'+
            '</div>'+
            '<div class="form-group mt-2">'+
              '<label for="exampleFormControlSelect1">Caja<span></span></label>'+
              '<select class="form-control round" id="exampleFormControlSelect1">'+
                '<option class="">Azul Cielo</option>'+
                '<option class="amount">Azul Marino</option>'+
                '<option class="amount">Verde Vivo</option>'+
                '<option class="amount">Amarillo</option>'+
                '<option class="amount">Rojo</option>'+
                '<option class="amount">Rosa</option>'+
                '<option class="amount">Morado</option>'+
                '<option class="amount">Ninguno</option>'+
             '</select>'+
            '</div>'+
            '<div class="form-group mt-2">'+
              '<label for="exampleFormControlSelect1">Papel<span></span></label>'+
              '<select class="form-control round" id="exampleFormControlSelect1">'+
                '<option class="">Azul Cielo</option>'+
                '<option class="amount">Azul Marino</option>'+
                '<option class="amount">Verde Vivo</option>'+
                '<option class="amount">Amarillo</option>'+
                '<option class="amount">Rojo</option>'+
                '<option class="amount">Rosa</option>'+
                '<option class="amount">Morado</option>'+
                '<option class="amount">Ninguno</option>'+
             '</select>'+
            '</div>'+
      
            '<div class="form-group mt-2">'+
              '<label>Mensaje de Etiqueta</label>'+
              '<input class="form-control amount" placeholder="Con mucho amor!" />'+
            '</div>'+
          '</div>',
          showCloseButton: true,
          focusConfirm: false,
          confirmButtonColor: '#3b6fff',
          confirmButtonText:
            '<i class=""></i> Listo!',
          confirmButtonAriaLabel: 'Thumbs up, great!',
        })
      }

    </script>
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
<!-- llamadas a scripts necesarios-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="static/scripts/responses.js"></script>
<script src="static/scripts/chat.js"></script>
</html>
