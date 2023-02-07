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
	<div class="position-absolute top-50 start-50 translate-middle">
		
		<?php
		$funciones = new Funciones();
		$datos = $funciones->ConsultaProducto();

		if (!empty($datos)) {
		?>

		<table class="table table-hover">
			<tr>
				<td colspan="7" style="text-align: center;">
					<b>Cafeteria Konecta Venta</b>
					<br>
					<a href="../index.php">INICIO</a>
				</td>
			</tr>

			<tr>
				<td>Id</td>
				<td>Nombre</td>
				<td>Stock</td>
				<td></td>
			</tr>

			<tbody>
				<?php
				if (!empty($datos[0]['nombre'])) {
					
					for ($i=0; $i <count($datos) ; $i++) { 
						echo "<tr>
							  <td>".$datos[$i]['id']."</td>
							  <td>".$datos[$i]['nombre']."</td>
							  <td>".$datos[$i]['stock']."</td>
							  <td>";
							  ?>
							  <form method="POST" action="#">
							  	<input type="hidden" value="<?php echo $datos[$i]['id']; ?>" name="id" required>
							  	<input type="hidden" value="<?php echo $datos[$i]['stock']; ?>" name="stock" required>
							  	<input type="hidden" value="<?php echo $datos[$i]['nombre']; ?>" name="nombre" required>
							  	<input type="number" value="" name="cantidad" required>
							  	<input type="submit" name="comprar" value="Comprar" class="btn btn-success">
							  </form>
							  <?php
					    echo "</td></tr>";
					}

				}else{

					echo "<tr>
						  <td>".$datos['id']."</td>
						  <td>".$datos['nombre']."</td>
						  <td>".$datos['stock']."</td>
						  <td>";
						  ?>
						  <form method="POST" action="#">
						  	<input type="hidden" value="<?php echo $datos['id']; ?>" name="id" required>
						  	<input type="hidden" value="<?php echo $datos['stock']; ?>" name="stock" required>
						  	<input type="hidden" value="<?php echo $datos['nombre']; ?>" name="nombre" required>
						  	<input type="number" value="" name="cantidad" required>
						  	<input type="submit" name="comprar" value="Comprar" class="btn btn-success">
						  </form>
						  <?php
				    echo "</td></tr>";
						  
				}
				?>
			</tbody>
		
		</table>
		<?php
		}else{
			echo "No hay productos para venta! <br>";
			echo '<a href="../index.php">INICIO</a>';
		}
		?>

		<?php
		if (!empty($_POST)) {
			
			//var_dump($_POST);

			$valor = ($_POST['stock'] - $_POST['cantidad']);
			if ($valor < 0 ) {
				
				echo "No es posible realizar la venta, esta cantidad de ".$_POST['cantidad']." no esta en el stock!";
			}else{

				$query = "UPDATE `productos` SET 
						 `stock` = ".$valor."
						 WHERE `id` = ".$_POST['id']." ";

				$actualizar = $funciones->Actualizar($query);

				if ($actualizar) {
					echo "Se actualizo producto! <br>";

					$query = "INSERT INTO `ventas` (
						      `id_producto`
						      ,`cantidad`
							  )VALUES(
							  ".$_POST['id']."
							  ,".$_POST['cantidad']."
						      ) ";

					$insertar = $funciones->Insertar($query);

					if ($insertar) {
						echo "Se guardo producto!";
						?>
						<script type="text/javascript">
							alert("Gracias por su compra de <?php echo $_POST['nombre']?> !");
						</script>
						<META HTTP-EQUIV="REFRESH" CONTENT="1;URL=<?php $_SERVER['HTTP_ORIGIN'].$_SERVER['REQUEST_URI']; ?>">
						<?php
					}else{
						echo "Error al guardar producto!";
					}
					
				}else{
					echo "Error al actualizar producto!";
				}
			}

		}
		
		?>
	</div>

</body>
</html>