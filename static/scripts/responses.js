function getBotResponse(input) {
    input = input.toLowerCase();
    
    if (input.includes("hola") || input.includes("saludo") || input.includes("saludos") || input.includes("hallo")||
    input.includes("buenas tardes")||input.includes("buen dia")||input.includes("buenos dias")|| input.includes("buenas noches")
    || input.includes("ola")){
        return "Hola, ¿en que te puedo ayudar?";
    } else if (input.includes("adios") || input.includes("nos vemos luego") || input.includes("bye") || input.includes("chiao")) {
        return "Hasta luego";
    } else if (input=="no") {
        return " Entendido, cualquier pregunta con toda confianza";
    }else if (input.includes("no realmente") || input.includes("eso seria todo gracias")||input.includes("por el momento no")) {
        return "Entendido, hasta luego";
    }else if (input.includes("gracias")||input.includes("agradezco")) {
        return "No hay de que, alguna otra pregunta?";
    }else if ((input.includes("convenio")||input.includes("alianza")) && (input.includes("psicologos"))||input.includes("psicologo")) {
        return "Tenemos convenios y alianzas con psicólogos y especialistas";
    }else if ( (input.includes("como funciona")||input.includes("funciona")||input.includes("funcion") )&& (input.includes("sitio")||input.includes("pagina"))    ) {
        return "Usted puede explorar nuestros productos didácticos y realizar compras de estos juegos. Nuestros productos ayudan al desarrollo de quienes tengan algúna condición que se puedan beneficiar de este tipo de artículos";
    }else if ( (input.includes("como funciona")||input.includes("encontrare")||input.includes("encontrar") )&& (input.includes("sitio")||input.includes("pagina")  )   ) {
        return "Aqui usted puede encontrar diversos juegos didácticos que ayudarán en el desarrollo de las habilidades de los niños y niñas quienes los usen.  ";
    }else if ((input.includes("como")||input.includes("carrito")||input.includes("como puedo") )&& input.includes("eliminar")    ) {
        return "En cualquier producto encontrara la opción de agregar a carrito, le da click y se agregará.";
    }else if ((input.includes("como")||input.includes("carrito")||input.includes("como puedo") )&& input.includes("eliminar")    ) {
        return "Para eliminar se dirige a su carrito y va a encontrar la opcion de *Borrar de carrito*, le da click y se eliminará";
    }else if ((input.includes("como")||input.includes("como puedo crear perfil") ) || input.includes("crear") && input.includes("perfil")) {
        return "Para crear un perfil, selecciona el apartado de registro e introduce la información que se solicita, es rápido";
    }else if ((input.includes("como")||input.includes("como puedo modificar perfil") ) || input.includes("modificar") && input.includes("perfil")) {
        return "Para modificar su perfil, selecciona el apartado de perfil en la parte superior derecha donde encontrara su información de perfil y opciones para modificar sus datos";
    }else if ( input.includes("metodo") ||input.includes("pago")  || input.includes("metodos de pago")  ) {
        return "Se aceptan transferencias, tarjetas de crédito y débito, eventualmente aceptaremos otros tipos";
    } else {
        return "¿Te puedo ayudar en algo?";
    }
}

/* Base 
else if (      ) {
        return "  ";
    }

    ||input.includes("  ")

retorno = pez
*/
