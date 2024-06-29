<?php
include_once 'header.php';

// Verificar la conexión a la base de datos
$con = mysqli_connect('localhost', 'root', '', 'basedatos');
if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Función para obtener todos los registros de la tabla "mates"
function obtenerMates($con) {
    $query = "SELECT * FROM mates";
    $result = mysqli_query($con, $query);
    $mates = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $mates;
}

// Función para agregar un nuevo mate a la base de datos
function agregarMate($con, $nombre, $precio, $codigo, $imagen) {
    $nombre = mysqli_real_escape_string($con, $nombre);
    $precio = floatval($precio);
    $codigo = mysqli_real_escape_string($con, $codigo);
    
    // Procesamiento de la imagen
    $nombreImagen = "imgs/" . basename($imagen['name']);
    $imagenTmp = $imagen['tmp_name'];
    $rutaImagen = "../../../Carrito2/" . $nombreImagen;
    move_uploaded_file($imagenTmp, $rutaImagen);
    
    $query = "INSERT INTO mates (nombre, precio, codigo, imagen) VALUES ('$nombre', $precio, '$codigo', '$nombreImagen')";
    mysqli_query($con, $query);
}

// Resto del código...

// Manejar las solicitudes POST para agregar, modificar o eliminar un mate
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['agregar'])) {
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $codigo = $_POST['codigo'];
        agregarMate($con, $nombre, $precio, $codigo, $_FILES['imagen']);
    } elseif (isset($_POST['modificar'])) {
        $idMate = $_POST['id_mate'];
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $codigo = $_POST['codigo'];
        modificarMate($con, $idMate, $nombre, $precio, $codigo);
    } elseif (isset($_POST['eliminar'])) {
        $idMate = $_POST['id_mate'];
        eliminarMate($con, $idMate);
    }
}

// Obtener todos los mates de la base de datos
$mates = obtenerMates($con);
?>


<div class="tablaAdmin">
	<div class="tabla-responsive">
		<h1 id="listaDeProductos">Listado de Mates</h1>
		<table border="1" class="tabla-usuarios">
			<tr >
				<th>ID</th>
				<th>Nombre</th>
				<th>Precio</th>
				<th>Código</th>
				<th>Imagen</th>
				<th>Acciones</th>
			</tr>
			<?php foreach ($mates as $mate) : ?>
				<tr>
					<td><?= $mate['id_mate']; ?></td>
					<td><?= $mate['nombre']; ?></td>
					<td><?= $mate['precio']; ?></td>
					<td><?= $mate['codigo']; ?></td>
					<td><?= $mate['imagen']; ?></td>
					<td>
						<a href="modificar.php?id=<?= $mate['id_mate']; ?>">Modificar</a>
						<a href="eliminar.php?id=<?= $mate['id_mate']; ?>">Eliminar</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
		
				<br>
			<div class="formAlta">
							
			<h2>Agregar Nuevo Mate</h2>
			
			<form action="" method="post" enctype="multipart/form-data">
				<label for="nombre">Nombre:</label>
				<input type="text" id="nombre" name="nombre" required>
				<br>
				<label for="precio">Precio:</label>
				<input type="number" id="precio" name="precio" step="0.01" required>
				<br>
				<label for="codigo">Código:</label>
				<input type="text" id="codigo" name="codigo" required>
				<br>
				<label for="imagen">Imagen: imgs/nombre</label>
				<input type="file" id="imagen" name="imagen" required>
				<br>
				<input type="submit" name="agregar" value="Agregar">
			</form>
		</div>
</div>
</div>

<div class="">
    <div class="col-7">
      <?php
      include_once 'footer.php'
      ?>
    </div>
</div>
