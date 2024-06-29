<?php
include_once 'header.php';

//Iniciamos una sesión, para poder guardar lo que vamos a ir agregando y quitando de nuestro carrito
session_start();

//Conectamos con nuestra base de datos. Esta vez estamos haciendo MySQLi pero con objetos.
require_once('config.php');
$db_handle = new DBController();

//Acá empezamos a manejar la lógica de nuestro carrito. Como pueden ver, vamos a chequear que nos esté llegando una "acción". Si nos llega (lo verificamos con !empty($_GET["accion])), entonces pasamos al
//siguiente paso.
if(!empty($_GET["accion"])) {

//Abrimos un switch, con un $_GET que esta recibiendo la acción de la que hablabamos antes. Este Switch va a tener 3 casos: "Meter", "Quitar" y "Vaciar.
    switch($_GET["accion"]) {

//El primer caso es "Meter". Para esto, revisamos que la cantidad que recibamos con $_POST en nuestro carrito no sea 0.
//Si no lo esta, entonces pasamos el primer "if", y recibimos el código de nuestro producto (una variable para identificarlo), y hacemos la query para traer el producto que coincida con ese código.
//Luego, creamos un array con nuestros productos.
        case "meter":
            if(!empty($_POST["cantidad"])) {
                $codigoProducto = $db_handle->runQuery("SELECT * FROM mates WHERE codigo='" . $_GET["codigo"] . "'");
                $itemArray = array($codigoProducto[0]["codigo"]=>array('nombre'=>$codigoProducto[0]["nombre"], 'codigo'=>$codigoProducto[0]["codigo"], 'cantidad'=>$_POST["cantidad"], 'precio'=>$codigoProducto[0]["precio"], 'imagen'=>$codigoProducto[0]["imagen"]));
                
//Ahora, vamos a otros dos "if". El primero chequea que el carrito de nuestra sesión no esté vacio. Si no lo está, pasamos al segundo "if", en donde revisamos si los productos en el array comparten
//el mismo código. En caso de que si, entonces sabemos que son el mismo producto, y el carrito entonces sabrá la cantidad que tiene de ese producto en específico.
                if(!empty($_SESSION["item_carrito"])) {
                    if(in_array($codigoProducto[0]["codigo"],array_keys($_SESSION["item_carrito"]))) {
                        foreach($_SESSION["item_carrito"] as $k => $v) {
                                if($codigoProducto[0]["codigo"] == $k) {
                                    if(empty($_SESSION["item_carrito"][$k]["cantidad"])) {
                                        $_SESSION["item_carrito"][$k]["cantidad"] = 0;
                                    }
                                    $_SESSION["item_carrito"][$k]["cantidad"] += $_POST["cantidad"];
                                }
                        }
//Si ya tenemos un carrito armado, pero agregamos más cosas a este luego, vamos a unir el array que armamos ahora con el que ya está en el carrito de nuestra sesión.
                    } else {
                        $_SESSION["item_carrito"] = array_merge($_SESSION["item_carrito"],$itemArray);
                    }
//Si no tenemos carrito en esta sesión, creamos uno nuevo con el array que recibimos.
                } else {
                    $_SESSION["item_carrito"] = $itemArray;
                }
            }
        break;

//En el caso "quitar", revisamos que el carrito no esté vacío. Si no lo esta, revisa qué código que recibió de un producto (Lo recibe con un botón que veremos más abajo) y quita al producto con ese
//código del carrito.
        case "quitar":
            if(!empty($_SESSION["item_carrito"])) {
                foreach($_SESSION["item_carrito"] as $k => $v) {
                        if($_GET["codigo"] == $k)
                            unset($_SESSION["item_carrito"][$k]);	
//Si el carrito quedaría vacío, quitamos el carrito directamente. 			
                        if(empty($_SESSION["item_carrito"]))
                            unset($_SESSION["item_carrito"]);
                }
            }
        break;

//El ultimo caso es Vaciar. Quita el carrito enteramente.
        case "vaciar":
            unset($_SESSION["item_carrito"]);
        break;	
    }
    }
    ?>

<!--Ahora pasamos al HTML. Como siempre, ponemos nuestra hoja de estilos y lo que necesitemos en el head -->
<div id="shopping-cart">
    <div><h1>Carrito</h1></div>
    <a id="botonVaciar" href="catalogo.php?accion=vaciar">Vaciar Carrito</a>

<!--Ahora vamos a chequear que el carrito exista. Si existe, por defecto va a poner todos los valores en 0.
Luego, haremos una tabla en donde se mostrarán los productos que hay actualmente en el carro. -->
    <?php
if(isset($_SESSION["item_carrito"])){
    $cantidad_total = 0;
    $precio_total = 0;
?>	
<table class="tabla-carrito" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<!--los titulos de cada columna de nuestra tabla-->
<th style="text-align:left;">Nombre</th>
<th style="text-align:left;">Código</th>
<th style="text-align:right;" width="5%">Cantidad</th>
<th style="text-align:right;" width="10%">Precio</th>
<th style="text-align:right;" width="10%">Precio total</th>
<th style="text-align:center;" width="5%">Quitar</th>
</tr>	
<!--Acá armamos un foreach con todos los items del carrito. Revisa los items del array de items que vimos arriba, y por cada uno hará una fila dentro de nuestro carrito, mostrando entonces
los contenidos de este. Recibe los nombres, cantidades y precios del array para mostrarlos con un echo
 También, cada producto que metamos en el carrito incluye un botón para quitar ese producto del carrito.
Como pueden ver, hace href a la acción "quitar" que armamos arriba, y le pasa también el código del producto-->
<?php		
    foreach ($_SESSION["item_carrito"] as $item){
        $item_precio = $item["cantidad"]*$item["precio"];
		?>
				<tr class="color">
				<td><img width="150" height="" src="<?php echo $item["imagen"]; ?>" class="imagen-item-carrito" /><span class="" ><?php  echo  $item["nombre"]; ?></td></span>
				<td><?php echo $item["codigo"]; ?></td>
				<td style="text-align:right;"><?php echo $item["cantidad"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ".$item["precio"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ". number_format($item_precio,2); ?></td>
				<td style="text-align:center;"><a href="carrito.php?accion=quitar&codigo=<?php echo $item["codigo"]; ?>" class="botonQuitarAccion"><img src="icon-delete.png" alt="Quitar item" /></a></td>
				</tr>
				<?php
                //$cantidad_total suma las cantidades entre los distintos productos. Si tenemos 2 manzanas y 1 naranja, entonces haría 2+1
				$cantidad_total += $item["cantidad"];
                //$precio_total hace lo mismo, pero sumando sus precios.
				$precio_total += ($item["precio"]*$item["cantidad"]);
		}
		?>
<!--Finalmente, en una última fila, mostramos el precio y la cantidad total de lo que hay en nuestro carrito-->
<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $cantidad_total; ?></td>
<td align="right" colspan="2"><strong><?php echo "$ ".number_format($precio_total, 2); ?></strong></td>
<td></td>
</tr>
</tbody>
</table>	
<!--Para terminar, si no hay nada en el carrito, simplemente mostraremos un cartel que dice "El carrito esta vacío"-->	
  <?php
}else {
?>
    <div class="no-hay-nada">El carrito esta vacío</div>
<?php 
    }
?>
</div>



<div class="">
    <div class="col-7">
      <?php
      include_once 'footer.php'
      ?>
    </div>
</div>
