function Validar_Formulario()
{	
	//traigo todo los datos
    var formularioProductos = $("#formularioProductos").serializeArray();

    //datos de formulario
	var producto = $("#producto").val();
	var nombreProducto = $("#nombreProducto").val();
	var referencia = $("#referencia").val();
	var precio = $("#precio").val();
	var peso = $("#peso").val();
	var categoria = $("#categoria").val();
	var stock = $("#stock").val();

	//console.log(Object.values(formularioProductos));

	if (nombreProducto === ""){
        $("#nombreProducto").attr("style", "border: 1px solid red;");
        $("#respuesta").html(" <span class='Requerido'>Debe llenar los campos obligatorios *</span>");
        return false;
    }else{
        $("#nombreProducto").attr("style", "border: 1px solid #ccc;");
        $("#respuesta").empty();
    }

    if (referencia === ""){
        $("#referencia").attr("style", "border: 1px solid red;");
        $("#respuesta").html(" <span class='Requerido'>Debe llenar los campos obligatorios *</span>");
        return false;
    }else{
        $("#referencia").attr("style", "border: 1px solid #ccc;");
        $("#respuesta").empty();
    }

    if (precio === ""){
        $("#precio").attr("style", "border: 1px solid red;");
        $("#respuesta").html(" <span class='Requerido'>Debe llenar los campos obligatorios *</span>");
        return false;
    }else{
        $("#precio").attr("style", "border: 1px solid #ccc;");
        $("#respuesta").empty();
    }

    if (peso === ""){
        $("#peso").attr("style", "border: 1px solid red;");
        $("#respuesta").html(" <span class='Requerido'>Debe llenar los campos obligatorios *</span>");
        return false;
    }else{
        $("#peso").attr("style", "border: 1px solid #ccc;");
        $("#respuesta").empty();
    }

    if (categoria === ""){
        $("#categoria").attr("style", "border: 1px solid red;");
        $("#respuesta").html(" <span class='Requerido'>Debe llenar los campos obligatorios *</span>");
        return false;
    }else{
        $("#categoria").attr("style", "border: 1px solid #ccc;");
        $("#respuesta").empty();
    }

    if (stock === ""){
        $("#stock").attr("style", "border: 1px solid red;");
        $("#respuesta").html(" <span class='Requerido'>Debe llenar los campos obligatorios *</span>");
        return false;
    }else{
        $("#stock").attr("style", "border: 1px solid #ccc;");
        $("#respuesta").empty();
    }

    var consultaProducto = {'name' : 'consulta', 'value': '0' };
    var formularioProducto = [].concat(formularioProductos,consultaProducto);

	$.ajax({
        type: "POST",
        dataType: "html",
        url: "../funciones/servicios.php",
        data: formularioProducto,
        success: function(resp){
            $("#respuesta").html(resp);
            alert(resp);
            location.reload();
        }
    });
    
}

function Validar_producto()
{

	var producto = $("#producto").val()
	
	if (producto != 0 ) {

		var consultaProducto = {'name' : 'consulta', 'value': '1' };
		var productoId = {'name' : 'productoId', 'value': $("#producto").val() };
		var productoConsulta = [].concat(productoId,consultaProducto);

		 $.ajax({
	        type: "POST",
	        dataType: "html",
	        url: "../funciones/servicios.php",
	        data: productoConsulta,
	        success: function(resp){
	            //$("#respuesta").html(resp);
	            var data = JSON.parse(resp);
	            //console.log(data);
	            //alert(data['resultado']['id']);

	            if (data['resultado'] != null) {

	            	$("#idProducto").val(data['resultado']['id']);
					$("#nombreProducto").val(data['resultado']['nombre']);
					$("#referencia").val(data['resultado']['referencia']);
					$("#precio").val(data['resultado']['precio']);
					$("#peso").val(data['resultado']['peso']);
					$("#categoria").val(data['resultado']['categoria']);
					$("#stock").val(data['resultado']['stock']);

					$("#eventoBoton").removeAttr("value");
					$("#eventoBoton").attr("value","Actualizar");

					$("#Eliminar").remove();
					var button = '<input type="button" value="Eliminar" id="Eliminar" name="Eliminar" class="btn btn-danger" onclick="Eliminar_Producto();">';
					$('#botonEliminar').append(button);
				}
	        }
	    });	

	}else{
		
		$("#eventoBoton").removeAttr("value");
		$("#eventoBoton").attr("value","Guardar");

		$("#idProducto").val("");
		$("#nombreProducto").val("");
		$("#referencia").val("");
		$("#precio").val("");
		$("#peso").val("");
		$("#categoria").val("");
		$("#stock").val("");
	}
}

function Eliminar_Producto(){

	//traigo todo los datos
    var formularioProductos = $("#formularioProductos").serializeArray();
	var consultaProducto = {'name' : 'consulta', 'value': '2' };
    var formularioProducto = [].concat(formularioProductos,consultaProducto);

	$.ajax({
        type: "POST",
        dataType: "html",
        url: "../funciones/servicios.php",
        data: formularioProducto,
        success: function(resp){
            $("#respuesta").html(resp);
            alert(resp);
            location.reload();
        }
    });
}

function Limpiar_Formulario(){

	$("#nombreProducto").val("");
	$("#referencia").val("");
	$("#precio").val("");
	$("#peso").val("");
	$("#categoria").val("");
	$("#stock").val("");
}