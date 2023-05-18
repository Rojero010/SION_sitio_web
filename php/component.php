<?php

function component($productname, $productprice, $productimg, $productid){
    $element = "
    
        <div class=\"col\">
          <form action=\"catalogo.php\" method=\"post\">
          <div class=\"card shadow-sm\">
            
            <img   
              src=\"$productimg\" 
              alt=\"Rainbow Fraction Tower Cubes\" 
            >

            <div class=\"card-body\">
              <h5 class=\"card-title\">$productname</h5>
              <p class=\"card-text\">Enseñe a los niños a nombrar fracciones y decimales, comparando y ordenando fracciones, fracciones inadecuadas, números mixtos y modelando diferentes 
                operaciones que involucran fracciones.</p>
              <div class=\"d-flex justify-content-between align-items-center\">
                <div class=\"btn-group\">
                  <button type=\"button\" class=\"btn btn-sm btn-outline-secondary\">Ver</button>
                  <button type=\"submit\" name=\"add\" class=\"btn btn-sm btn-outline-secondary\"><i class=\"fas fa-cart-plus\"></i></button>
                  <input type='hidden' name='productid' value='$productid'>
                </div>
                <div class=\"text-muted\">$$productprice MXN</div>
              </div>
            </div>
          </div>
          </form>
        </div>
    ";
    echo $element;
}

function cartElement($productimg, $productname, $productprice, $productid, $cantidad){
    $element = "
    
    <form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"cart-items\">
                    <div class=\"border rounded\">
                        <div class=\"row bg-white\">
                            <div class=\"col-md-3 pl-0\">
                                <img src=$productimg alt=\"Image1\" class=\"img-fluid\">
                            </div>
                            <div class=\"col-md-5 mb-1\">
                                <h5 class=\"pt-2\">$productname</h5>
                                <h4 class=\"pt-2 text-secondary\">$$productprice</h5>
                                <button type=\"submit\" class=\"btn btn-danger mx-1\" name=\"remove\">Remover</button>
                            </div>
                            </form>
                            <div class=\"col-md-4 py-5\">
                            <form action=\"cart.php?action=update-&id=$productid&cant=$cantidad\" method=\"post\" class=\"cart-items\">
                                <div>
                                    <button type=\"submit\" name='update-' class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-minus\"></i></button>
                                    <form action=\"cart.php?action=update&id=$productid&cant=$cantidad\" method=\"post\" class=\"cart-items\">
                                    <input type=\"text\" value=\"$cantidad\" class=\"form-control w-25 d-inline-flex text-center\">
                                    <form action=\"cart.php?action=update+&id=$productid&cant=$cantidad\" method=\"post\" class=\"cart-items\">
                                    <button type=\"submit\" name='update+' class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-plus\"></i></button>
                                    
                                </div>

                            </div>
                        </div>
                    </div>
                
    
    ";
    echo  $element;
}