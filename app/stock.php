<!DOCTYPE html>
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
	
		<?php
		$funciones = new Funciones();
		$datos = $funciones->ProductosMasStock();

		//var_dump($datos);

		if (!empty($datos)) {
		?>
		<div class="position-absolute top-50 start-50 translate-middle">
		<table class="table table-hover" border="1">
			<tr>
				<td colspan="7" style="text-align: center;">
					<b>Productos mas stock</b>
					<br>
					<a href="../index.php">INICIO</a> <br> 
					<a href="./index.php">ADMINISTRADOR</a> || <a href="./stock.php">MAS STOCK</a> || <a href="./ventas.php">MAS VENDIDO</a>
				</td>
			</tr>

			<tr>
				<td><b>Id</b></td>
				<td><b>Nombre</b></td>
				<td><b>Stock</b></td>
			</tr>

			<tbody>
				<?php
				if (!empty($datos[0]['nombre'])) {
					
					for ($i=0; $i <count($datos) ; $i++) { 
						echo "<tr>
							  <td>".$datos[$i]['id']."</td>
							  <td>".$datos[$i]['nombre']."</td>
							  <td>".$datos[$i]['stock']."</td>
	 					      </tr>";
					}

				}else{

					echo "<tr>
						  <td>".$datos['id']."</td>
						  <td>".$datos['nombre']."</td>
						  <td>".$datos['stock']."</td>
						  </tr>";
				}
				?>
			</tbody>
		
		</table>
		<?php
		}else{
			echo "No hay productos en stock!";
			echo '<br><a href="./index.php">ADMINISTRADOR</a> || <a href="./stock.php">MAS STOCK</a> || <a href="./ventas.php">MAS VENDIDO</a>';
		}
		?>
	</div>
</body>
</html>