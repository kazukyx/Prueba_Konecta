<?php
/**
 * Funciones de Prueba
 */
class Funciones
{
  
  function Conectar()
  {
    include "../config/config.php";
    $this->Link = mysqli_connect($servidor,$usuario,$password,$baseDeDatos)or die("ERROR al conectarse a la BD");
    return $this->Link;
  }

  function ConsultaProducto(){

    $query = "SELECT * FROM productos";

    return $datos = $this->Consultar($query);
  }

  function ConsultaProductoId($id){

    $query = "SELECT * FROM productos WHERE id =".$id." ";

    return $datos = $this->Consultar($query);
  }

  function ProductosMasStock(){

    echo $query = "SELECT id, nombre, stock
              FROM productos
              ORDER BY stock DESC ";

    return $datos = $this->Consultar($query);
  }

 function ProductosMasVendido(){
  
    echo $query = "SELECT P.id
                     , P.nombre
                     , SUM(V.cantidad) AS total
              FROM ventas V
              JOIN productos P
                ON P.id = V.id_producto
              GROUP BY P.nombre
              ORDER BY total DESC ";

    return $datos = $this->Consultar($query);

  }


  //Consultar
  function Consultar($query){ 

    //llamo a una funcion de la misma clase
    $db = new Funciones();
    $db->Conectar();

    //Creo UTF8
    mysqli_query($db->Link,"SET NAMES 'utf8'");

    //Realizo Consulta
    $resultado=mysqli_query($db->Link,$query)or die ("Error -> ".$query);
    
    //valido Cantidad
    $cantidad=mysqli_num_rows($resultado);

    //Traigo datos de consulta 
    if ($cantidad > 1) {
      
      //Si es mas de uno llena el array
      $datos = array();
      while ( $Dato = mysqli_fetch_array($resultado,MYSQLI_ASSOC)){
        array_push($datos, $Dato);
      } 
    }else{
      
       $datos = mysqli_fetch_array($resultado,MYSQLI_ASSOC);
    }

    //Libero consulta
    mysqli_free_result($resultado);
    
    //Cierro conexion
    mysqli_close($db->Link);

    return $datos;
    
  }

  //Insertar
  function Insertar($query){ 

    //llamo a una funcion de la misma clase
    $db = new Funciones();
    $db->Conectar();

    //Creo UTF8
    mysqli_query($db->Link,"SET NAMES 'utf8'");

    //Realizo Consulta
    $Resultado=mysqli_query($db->Link,$query)or die ("Error -> ".$query);
    
    //valido Cantidad
    $Cantidad=mysqli_insert_id($db->Link);

    //Traigo datos de consulta 
    if (!empty($Cantidad)) {
      
      $registro = true;
    
    }else{
      
       $registro = false;

    }

    //Cierro conexion
    mysqli_close($db->Link);

    return $registro;
  }

  //actualizar
  function Actualizar($query){ 

    //llamo a una funcion de la misma clase
    $db = new Funciones();
    $db->Conectar();

    //Creo UTF8
    mysqli_query($db->Link,"SET NAMES 'utf8'");

    //Realizo Consulta
    $resultado=mysqli_query($db->Link,$query)or die ("Error -> ".$query);
    
    //valido Cantidad
    $cantidad=mysqli_affected_rows($db->Link);

    //Cierro conexion
    mysqli_close($db->Link);

    return $cantidad;
  }

  //Eliminar
  function Eliminar($query){ 

    //llamo a una funcion de la misma clase
    $db = new Funciones();
    $db->Conectar();

    //Creo UTF8
    mysqli_query($db->Link,"SET NAMES 'utf8'");

    //Realizo Consulta
    $resultado=mysqli_query($db->Link,$query)or die ("Error -> ".$query);
    
    //valido Cantidad
    $cantidad=mysqli_affected_rows($db->Link);

    //Cierro conexion
    mysqli_close($db->Link);

    return $cantidad;
  }

}
?>