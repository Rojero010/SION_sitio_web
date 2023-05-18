<?php

//start session
session_start();

include_once 'database\conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

require_once('./php/component.php');




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


  <main>  
<div class="container">
    <div class="row px-5">
        <div class="col-md-7">
        <div class='form-row mt-2 mb-2'>
              <div class='col-md-2'>
                <a href="cart.php" class='form-control btn btn-primary submit-button' type='submited'>« Atras</a>
              </div>
            </div>
            <div class="shopping-cart">
            <form id="processCard" name="processCard">
  
        <div class="padding">
            <div class="row">
                <div class="d-flex">
                    <div class="card">
                        <div class="card-header">
                            <strong>Información de Tarjeta</strong>
                            <small>(Débito/Crédito)</small>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="name">Nombre de Propietario</label>
                                        <input class="form-control" data-openpay-card="holder_name" size="50" type="text" placeholder="Nombre que aparece en su tarjeta">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    <div class="row form-group">
                                        <div class="col-auto"><label for="ccnumber">Número de Tarjeta </label></div>
                                        <div class="input-group">
                                            <input class="form-control" id="cardNumber" data-openpay-card="card_number" maxlength="16" size="50" type="text" placeholder="0000 0000 0000 0000">
                                        </div>
                                        <div class="col-auto text-end">
                                            <i class="fab fa-cc-visa fa-lg" style="color:navy;"></i>
                                            <i class="fab fa-cc-mastercard fa-lg" style="color:red;"></i>
                                            <i class="fab fa-cc-amex fa-lg" style="color:blue;"></i>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="form-group col-sm-4">
                                    <label for="ccmonth">Mes</label>
                                    <select class="form-control" id="ccmonth" data-openpay-card="expiration_month" size="" type="text">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="ccyear">Año (20XX)</label>
                                    <select class="form-control" id="ccyear" data-openpay-card="expiration_year" size="" type="text">
                                        <option>21</option>
                                        <option>22</option>
                                        <option>23</option>
                                        <option>24</option>
                                        <option>25</option>
                                        <option>26</option>
                                        <option>27</option>
                                        <option>28</option>
                                        <option>29</option>
                                        <option>30</option>
                                        <option>31</option>
                                        <option>32</option>
                                        <option>33</option>
                                        <option>34</option>
                                        <option>35</option>
                                        <option>36</option>
                                        <option>37</option>
                                        <option>38</option>
                                        <option>39</option>
                                        <option>40</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="cvv">CVV/CVC</label>
                                        <input class="form-control" id="cvv" data-openpay-card="cvv2" maxlength="4" size="5" type="text" placeholder="123">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn  btn-success float-end p-2" input id="makeRequestCard" type="button" value="Make Card">
                                <i class="mdi mdi-gamepad-circle "></i> Pagar</button>
                            <i class="fas fa-spinner fa-pulse" id="loadingSpinner" hidden></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form method="POST" action="{{ route('users.ui.payment_method.store') }}" class="form" id="storeForm" hidden>
        @csrf
        <input class="form-control" id="token_id" name="token_id" value="" type="string" hidden>
        <input class="form-control" id="device_session_id" name="device_session_id" value="" hidden>
        <button class="btn btn-primary btn-block mt-4" id="storeInfo" type="submit" hidden></button>
    </form>
          
            </div>
        </div>
        <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">

            <div class="pt-4">
                <h6>Resumen de Pedido</h6>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <?php
                            $total = $_SESSION['total'];
                            if (isset($_SESSION['cart'])){
                                $count = 0;
                                foreach ($_SESSION['cart'] as $key => $value){
                                  $count += $_SESSION['cart'][$key]['cantidad'];
                                }
                                echo "<h6>Precio ($count)</h6>";
                            }else{
                                echo "<h6>Precio (0 productos)</h6>";
                            }
                        ?>
                        <h6>Costo Envio</h6>
                        <hr>
                        <h6>Monto a Pagar</h6>
                    </div>
                    <div class="col-md-6">
                        <h6>$<?php echo $total; ?></h6>
                        <h6 class="text-success">GRATIS</h6>
                        <hr>
                        <h6>$<?php
                            echo $total;
                            ?></h6>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

</main>

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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="static/scripts/responses.js"></script>
<script src="static/scripts/chat.js"></script>
</html>
