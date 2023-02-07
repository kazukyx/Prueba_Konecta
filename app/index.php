<!DOCTYPE html>
<?php
error_reporting(0);
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>KONECTA</title>
	<script src="../js/validaciones.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<?php
	include_once("../funciones/funciones.php");
	?>
</head>
<body>
	<form method="POST" action="" id="formularioProductos">
		<div class="position-absolute top-50 start-50 translate-middle">
			<table class="table table-hover">

				<tr>
					<td colspan="2" style="text-align: center;">
						<b>Cafeteria Konecta</b>
						<br>
						<a href="../index.php">INICIO</a> <br> 
						<a href="./stock.php">MAS STOCK</a> || <a href="./ventas.php">MAS VENDIDO</a>
					</td>
				</tr>

				<tr>
					<td>
						Consultar Producto
					</td>
					<td>
						<?php
						$funciones = new Funciones();
						$datos = $funciones->ConsultaProducto();
						//var_dump($datos);

						?>
						<select name="producto" id="producto" onchange="Validar_producto();">
						<?php

						if (!empty($datos)) {
							echo "<option value='0'>Agregar Nuevo</option>";

							if (!empty($datos[0]['nombre'])) {

								for ($i=0; $i <count($datos) ; $i++) { 
									echo "<option value=".$datos[$i]['id'].">".$datos[$i]['nombre']."</option>";
								}

							}else{
								echo "<option value=".$datos['id'].">".$datos['nombre']."</option>";
							}
							
						}else{

							echo "<option value='0' selected>No existe productos!</option>";
						}
						?>
						</select>
					
					</td>
				</tr>

				<tr>
	  				<td>
	  					ID
	  				</td> 
	  				<td>
	  					<input type="text" name="idProducto" id="idProducto" disabled required>
	  				</td>
	  			</tr>


	  			<tr>
	  				<td>
	  					Nombre producto*
	  				</td> 
	  				<td>
	  					<input type="text" name="nombreProducto" id="nombreProducto" required>
	  				</td>
	  			</tr>

	  			<tr>
	  				<td>
	  					Referencia*
	  				</td>
	  				<td>
	  					<input type="text" name="referencia" id="referencia" required>
	  				</td>
	  			</tr>

	  			<tr>
	  				<td>
	  					Precio*
	  				</td>
	  				<td>
	  					<input type="number" name="precio" id="precio" required>
	  				</td>
	  			</tr>

	  			<tr>
	  				<td>
	  					Peso*
	  				</td>
	  				<td>
	  					<input type="number" name="peso" id="peso" required>
	  				</td>
	  			</tr>

	  			<tr>
	  				<td>
	  					Categoria*
	  				</td>
	  				<td>
	  					<input type="text" name="categoria" id="categoria" required>
	  				</td>
	  			</tr>

	  			<tr>
	  				<td>
	  					Stock*
	  				</td>
	  				<td>
	  					<input type="number" name="stock" id="stock" required>
	  				</td>
	  			</tr>

	  			<tr>
	  				<td id="botonEliminar">
  						<input type="button" onclick="Validar_Formulario();" class="btn btn-primary" id="eventoBoton" name="eventoBoton" value="Guardar">
	  				</td>
	  				<td>
	  					<input type="button" onclick="Limpiar_Formulario();" class="btn btn-warning" id="eventoBoton" name="eventoBoton" value="Limpiar">
	  				</td>
	  			</tr>
			</table>

			<div id="respuesta"></div>

			<?php
			if (!empty($datos)) {
			?>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<td>Id</td>
						<td>Nombre</td>
						<td>Referencia</td>
						<td>Precio</td>
						<td>Peso</td>
						<td>Categoria</td>
						<td>Stock</td>
					</tr>
				</thead>
				<tbody>
					<?php
					if (!empty($datos[0]['nombre'])) {
						
						for ($i=0; $i <count($datos) ; $i++) { 
							echo "<tr>
								  <td>".$datos[$i]['id']."</td>
								  <td>".$datos[$i]['nombre']."</td>
								  <td>".$datos[$i]['referencia']."</td>
								  <td>".$datos[$i]['precio']."</td>
								  <td>".$datos[$i]['peso']."</td>
								  <td>".$datos[$i]['categoria']."</td>
								  <td>".$datos[$i]['stock']."</td>
								  </tr>";
						}

					}else{

						echo "<tr>
							  <td>".$datos['id']."</td>
							  <td>".$datos['nombre']."</td>
							  <td>".$datos['referencia']."</td>
							  <td>".$datos['precio']."</td>
							  <td>".$datos['peso']."</td>
							  <td>".$datos['categoria']."</td>
							  <td>".$datos['stock']."</td>
							  </tr>";
					}
					?>
				</tbody>
			</table>
			<?php
			}
			?>

		</div>
	</form>
</body>
</html>