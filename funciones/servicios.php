<?php
include_once("../funciones/funciones.php");

if(!empty($_POST))
{

	$funciones = new Funciones();

	if ($_POST["consulta"] == 1) {
		
		$consultaProductoId = $funciones->ConsultaProductoId($_POST["productoId"]);
		//var_dump($ConsultaProductoId);
		echo json_encode(array('resultado' => $consultaProductoId));

	}elseif($_POST["consulta"] == 2){

		//Elimino
		$query = "DELETE FROM `productos` WHERE `id` = '".$_POST["producto"]."' ";

		$eliminar = $funciones->Eliminar($query);

		if ($eliminar) {
			echo "Se elimino producto!";
		}else{
			echo "Error al eliminar producto!";
		}

	}else{

		if ($_POST["producto"]==0) {
			
			//Guardo 
			$query = "INSERT INTO `productos` (
				                      `nombre`
				                    , `referencia`
				                    , `precio`
				                    , `peso`
				                    , `categoria`
				                    , `stock`
				                    ) VALUES (
				                     '".$_POST["nombreProducto"]."'
							 	    ,'".$_POST["referencia"]."'
							 	    ,'".$_POST["precio"]."'
							 	    ,'".$_POST["peso"]."'
							 	    ,'".$_POST["categoria"]."'
							 	    ,'".$_POST["stock"]."'
							 		)";
			$inserto = $funciones->Insertar($query);

			if ($inserto) {
				echo "Se guardo producto!";
			}else{
				echo "Error al guardar producto!";
			}

			
		}elseif ($_POST["producto"] >= 1) {
			
			//actualizo
			$query = "UPDATE `productos` SET
					  						 `nombre` = '".$_POST["nombreProducto"]."'
						                    , `referencia` = '".$_POST["referencia"]."'
						                    , `precio` = '".$_POST["precio"]."'
						                    , `peso` = '".$_POST["peso"]."'
						                    , `categoria` = '".$_POST["categoria"]."'
						                    , `stock` = '".$_POST["stock"]."'
						                    WHERE id = '".$_POST["producto"]."' ";

			$actualizar = $funciones->Actualizar($query);

			if ($actualizar) {
				echo "Se actualizo producto!";
			}else{
				echo "Error al actualizar producto!";
			}

		}
	}

}else{
	echo "<span class='Error'>Error al traer datos!</span>";
}
?>