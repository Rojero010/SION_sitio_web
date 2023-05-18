$(document).ready(function(){
  tablaInventario = $("#tablaInventario").DataTable({
     "columnDefs":[{
      "targets": -1,
      "data":null,
      "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-secondary btneditar'><i class='fas fa-edit'></i></button><button class='btn btn-danger btnborrar'><i class='fas fa-trash-alt'></i></button></div></div>" 
     },{
      'targets': 4,
      'searchable': false,
      'orderable':false,
      'render': function (data, type, full, meta) {
      return '<img src="'+data+'" width="100px" height="100px" class="rounded mx-auto d-block"/>';
    }
      }],
          //Para cambiar el lenguaje a español
    "language": {
          "lengthMenu": "Mostrar _MENU_ registros",
          "zeroRecords": "No se encontraron resultados",
          "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
          "infoFiltered": "(filtrado de un total de _MAX_ registros)",
          "sSearch": "Buscar:",
          "oPaginate": {
              "sFirst": "Primero",
              "sLast":"Último",
              "sNext":"Siguiente",
              "sPrevious": "Anterior"
           },
           "sProcessing":"Procesando...",
      },
      fixedColumns:   {
          heightMatch: 'auto'
      }
  });

  var fila; //capturar la fila para editar o borrar el registro

  //añadir
  $("#agregar").click(function(){
      $("#registrar").trigger("reset");
      $(".modal-header").css("background-color", "#28a745");
      $(".modal-header").css("color", "white");
      $(".modal-title").text("Nuevo producto");            
      $("#agregarProducto").modal("show");
      idProducto=null;
      opcion = 1; //alta
  });

  //editar
  $(document).on("click", ".btneditar", function(){
    fila = $(this).closest("tr");
    idProducto = parseInt(fila.find('td:eq(0)').text());
    unidad = fila.find('td:eq(1)').text();
    nombreProducto = fila.find('td:eq(2)').text();
    descripcion = fila.find('td:eq(3)').text();
    img = fila.find('td:eq(4)').html().replace('<img src="','').replace('" width="100px" height="100px" class="rounded mx-auto d-block">','');
    precio = fila.find('td:eq(5)').text();
    disponibilidad = fila.find('td:eq(6)').text();
    nombrecategoria = fila.find('td:eq(7)').text();
    switch(nombrecategoria){
      case 'Juguetes':
        idCategoria=1;
        break;
      case 'Didácticos':
        idCategoria=2;
        break;
      case 'Niños':
        idCategoria=3;
        break;
    }
    opcion = 2; //editar
    $("#unidad").val(unidad);
    $("#nombreProducto").val(nombreProducto);
    $("#descripcion").val(descripcion);
    $("#img").val(img);
    $("#precio").val(precio);
    $("#disponibilidad").val(disponibilidad);
    $("#idCategoria").val(idCategoria);
    
    $(".modal-header").css("background-color", "#6C757D");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar producto");            
    $("#agregarProducto").modal("show");  
    
  });

  //borrar
  $(document).on("click", ".btnborrar", function(){    
    fila = $(this);
    idProducto = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el producto con ID: "+idProducto+"?");
    if(respuesta){
        $.ajax({
            url: "database/crud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, idProducto:idProducto},
            success: function(){
              tablaInventario.row(fila.parents('tr')).remove().draw();
            }
        });
        alert("Eliminado con éxito");
    }
  });


  $("#registrar").submit(function(e){
    e.preventDefault();    
    unidad = $.trim($("#unidad").val());
    nombreProducto = $.trim($("#nombreProducto").val());
    descripcion = $.trim($("#descripcion").val());
    img = $.trim($("#img").val());
    precio = $.trim($("#precio").val());
    idCategoria = $.trim($("#idCategoria").val());
    disponibilidad = $.trim($("#disponibilidad").val());
    $.ajax({
        url: "database/crud.php",
        type: "POST",
        dataType: "json",
        data: {unidad:unidad, nombreProducto:nombreProducto, descripcion:descripcion, img:img,
          idProducto:idProducto, precio:precio, idCategoria:idCategoria, disponibilidad:disponibilidad, opcion:opcion},
        success: function(data){  
            console.log(data);
            idProducto = data[0].idProducto;            
            unidad = data[0].unidad;
            nombreProducto = data[0].nombreProducto;
            descripcion = data[0].descripcion;
            img = data[0].img;
            precio = data[0].precio;
            disponibilidad = data[0].disponibilidad;
            nombre_categoria = data[0].nombre_categoria;
            if(opcion==1){
              tablaInventario.row.add([idProducto,unidad,nombreProducto,descripcion,img,precio,disponibilidad,nombre_categoria]).draw();
            }else{
              tablaInventario.row(fila).data([idProducto,unidad,nombreProducto,descripcion,img,precio,disponibilidad,nombre_categoria]).draw();
            }
        }        
    });
    $("#agregarProducto").modal("hide");    
    alert("Realizado con éxito");
  });
});
