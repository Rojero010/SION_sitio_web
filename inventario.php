<?php
include_once 'database\conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT idProducto, unidad, nombreProducto, descripcion, img, precio, disponibilidad, nombre_categoria
        FROM producto, categoria 
        WHERE producto.idCategoria=categoria.idCategoria";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="en">
  <head> 
    
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="#" />
    <title>Inventario</title>
    <!-- Otros -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css">
    <link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.11.4/css/dataTables.bootstrap5.min.css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/all.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

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

  <body>
  <br>
    <h3 class="text-center">
      Inventario
    </h3>
    <br>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <button type="button" class="btn btn-success" id="agregar" data-bs-toggle="modal">Agregar producto</button>
        </div>
      </div>
    </div>
    <br>
  <div class="container">
      <div class="row">
        <div class="col">
          <div class="table-responsive">
            <table id="tablaInventario" class="table table-light table-striped table-bordered table-condensed"
            style="width: 100%">
            <thead class="text-center">
                <tr>
                  <th scope="col"># ID</th>
                  <th>Unidades</th>
                  <th>Nombre</th>
                  <th>Descripción</th>
                  <th>Link Imagen</th>
                  <th>Precio</th>
                  <th>Disponibilidad</th>
                  <th>Categoría</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
              <?php                            
                foreach($data as $dat) {                                                        
              ?>
                <tr>
                  <td><?php echo $dat['idProducto'] ?></td>
                  <td><?php echo $dat['unidad'] ?></td>
                  <td><?php echo $dat['nombreProducto'] ?></td>
                  <td><?php echo $dat['descripcion'] ?></td>
                  <td><?php echo $dat['img'] ?></td>
                  <td><?php echo $dat['precio'] ?></td>
                  <td><?php echo $dat['disponibilidad'] ?></td>
                  <td><?php echo $dat['nombre_categoria'] ?></td>
                  <td></td>
                </tr>
              <?php
                }
              ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal agregarProducto -->
    <div class="modal fade" id="agregarProducto" tabindex="-1" aria-labelledby="agregarProductoLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="agregarProductoLabel"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form id="registrar">
            <div class="modal-body">
              <div class="mb-3">
                <label for="idCategoria" class="form-label">Seleccionar la categoría del producto</label>
                  <select class="form-select" name="idCategoria" id="idCategoria" required>
                    <option value="1">Juguetes</option>
                    <option value="2">Didácticos</option>
                    <option value="3">Niños</option>                 
                  </select>
              </div>
              <div class="mb-3">
                <label for="nombreProducto" class="form-label">Nombre del producto</label>
                <textarea class="form-control" maxlength="100" name="nombreProducto" placeholder="Nombre del producto" id="nombreProducto" required></textarea>
              </div>
              <div class="mb-3">
                <label for="unidad" class="form-label">Unidades</label>
                <input type="number" class="form-control" min="0" max="999" placeholder="Ej. 145" id="unidad" name="unidad" required>
              </div>
              <div class="mb-3">
              <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" maxlength="300" name="descripcion" placeholder="Descripción del producto" rows="3" id="descripcion" required></textarea>
              </div>
              <label for="img" class="form-label">Link de imágen</label>
                <input type="text" class="form-control" maxlength="300" name="img" placeholder="Ej. https://www.imglink.com/img.png" id="img" required>
              </div>
              <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" min="0" class="form-control" id="precio" placeholder="Ej. 145" name="precio" aria-describedby="duracionHelp"></input>
                <div id="duracionHelp" class="form-text">Escribe el precio del producto. Valores válidos desde 0 con 2 decimales.</div>
              </div>
              
              <div class="mb-3">
                <label for="disponibilidad" class="form-label">Seleccionar la disponibilidad del producto</label>
                  <select class="form-select" name="disponibilidad" id="disponibilidad" required>
                    <option value="Disponible">Disponible</option>
                    <option value="No disponible">No disponible</option>          
                  </select>
              </div>
              <div class="col-12">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                  <label class="form-check-label" for="invalidCheck">
                    Quiero registrar el producto con estos datos
                  </label>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary" name="submit">Registrar</button>
            </div>
          </form>
        </div>
      </div>
    </div>


    <script src="jQuery/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="datatables/datatables.min.js"></script>
    <script src="javascript/datatb.js"></script>
  </body>
</html>
