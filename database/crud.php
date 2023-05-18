<?php
include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$idCategoria = (isset($_POST['idCategoria'])) ? $_POST['idCategoria'] : '';
$unidad = (isset($_POST['unidad'])) ? $_POST['unidad'] : '';
$nombreProducto = (isset($_POST['nombreProducto'])) ? $_POST['nombreProducto'] : '';
$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
$img = (isset($_POST['img'])) ? $_POST['img'] : '';
$precio = (isset($_POST['precio'])) ? $_POST['precio'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$idProducto = (isset($_POST['idProducto'])) ? $_POST['idProducto'] : '';
$disponibilidad = (isset($_POST['disponibilidad'])) ? $_POST['disponibilidad'] : '';


switch ($opcion) {
        case 1:
                $sql = "INSERT INTO producto (idProducto, idCategoria, nombreProducto, unidad, descripcion, img, precio, disponibilidad) 
                        VALUES (NULL, '$idCategoria', '$nombreProducto', '$unidad', '$descripcion', '$img', '$precio', '$disponibilidad')";
                $resultado = $conexion->prepare($sql);
                $resultado->execute();
                $sql = "SELECT idProducto, unidad, nombreProducto, descripcion, img, precio, disponibilidad, nombre_categoria
                FROM producto, categoria 
                WHERE producto.idCategoria=categoria.idCategoria
                ORDER BY idProducto DESC LIMIT 1";
                $resultado = $conexion->prepare($sql);
                $resultado->execute();
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                break;
        case 2:
                $sql = "UPDATE producto SET idCategoria = '$idCategoria', nombreProducto = '$nombreProducto', unidad = '$unidad', 
                descripcion = '$descripcion', img ='$img', precio ='$precio', disponibilidad ='$disponibilidad' 
                WHERE producto.idProducto = '$idProducto'";
                $resultado = $conexion->prepare($sql);
                $resultado->execute();
                $sql = "SELECT idProducto, unidad, nombreProducto, descripcion, img, precio, disponibilidad, nombre_categoria
                FROM producto, categoria 
                WHERE producto.idCategoria=categoria.idCategoria AND producto.idProducto='$idProducto'";
                $resultado = $conexion->prepare($sql);
                $resultado->execute();
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                break;
        case 3:
                $sql = "DELETE FROM producto WHERE producto.idProducto = '$idProducto'";
                $resultado = $conexion->prepare($sql);
                $resultado->execute();
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
                break;
        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
?>