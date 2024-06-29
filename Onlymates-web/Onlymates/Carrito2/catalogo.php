<?php
include_once 'header.php';
?>
<?php


//Iniciamos una sesión, para poder guardar lo que vamos a ir agregando y quitando de nuestro carrito
session_start();

//Conectamos con nuestra base de datos. Esta vez estamos haciendo MySQLi pero con objetos.
require_once('config.php');
$db_handle = new DBController();

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




<!--Nuestro carrito. Tiene un botón de vaciar, que hace referencia a la acción vaciar, que armamos arriba. Al clickearlo, entonces ejecutará esa acción-->

<!--Y finalmente, necesitaremos una grilla con los productos que podemos agregar a nuestro carrito. Los productos los recibimos de nuestra base de datos
 Primero, creamos un array con los productos, que se llenará con lo que reciba de una query. Esta query le devolverá todas las entradas de la tabla con nuestros productos.
Luego, revisa que nuestro array no este vacío. Si no lo está, hará un foreach, que creará un cuadro por cada entrada en nuestra base de datos.
Como pueden ver, esto lo manejamos con un form, con un method="post" cuyas acción es "meter", y de paso también pasa el código del producto.
Finalmente, hay un botón con un "submit" que toma la cantidad del producto, y la lleva a la acción "meter", para que haga su trabajo tal y como vimos antes.-->
<div class=""id="grilla-productos">
	<div class="txt-heading" id="titulo">Catalogo</div>
	<?php
	$array_productos = $db_handle->runQuery("SELECT * FROM mates ORDER BY id_mate ASC");
	if (!empty($array_productos)) { 
		foreach($array_productos as $clave=>$valor){
	?>
		<div class="item-producto">
			<form method="post" action="catalogo.php?accion=meter&codigo=<?php echo $array_productos[$clave]["codigo"]; ?>">
			<div ><img  class="product-image" src="<?php echo  $array_productos[$clave]["imagen"]; ?>"></div>
			<div class="product-tile-footer">
			<div class="product-title"><?php echo $array_productos[$clave]["nombre"]; ?></div>
			<div class="product-price"><?php echo "$".$array_productos[$clave]["precio"]; ?></div>
			<div class="cart-action"><input type="text" class="cantidad-producto" name="cantidad" value="1" size="2" /><input type="submit" value="Agregar al Carrito" class="botonAgregarAccion" /></div>
			</div>
			</form>
		</div>
	<?php
		}
	}
	?>
</div>

<br>

<div class="container-fluid mover">
    <div class="col-7">
      <?php
      include_once 'footer.php'
      ?>
    </div>
</div>

