
<?php

require_once("ProductoModel.php");

function registrarProducto($cod,$des,$pre,$sto){
$ob = new ProductoModel();
if( $ob->registrarProducto($cod,$des,$pre,$sto) ){
	echo"<script type='text/javascript'>alert('Producto registrado correctamente');</script>"; 
}else{
echo "<script type='text/javascript'>alert('Producto no registrado correctamente'); </script>";
}
$ob = null;
}

registrarProducto(2345,"Disco Duro",23000,49);

function updateProducto( $id,$cod,$des,$pre,$sto){
$ob = new ProductoModel();
if( $ob->editarProducto($id,$cod,$des,$pre,$sto) ){echo"<script type='text/javascript'>alert('Producto editado correctamente');</script>"; 
}else{
echo "<script type='text/javascript'>alert('Producto no editado correctamente'); </script>";
}
$ob = null;
}
//updateProducto(2,420,"Celular",20000.00,23);

function DeleteProducto($id){
	$ob = new ProductoModel();
if( $ob->eliminarProducto($id) ){echo"<script type='text/javascript'>alert('Producto eliminado correctamente');</script>"; 
}else{
echo "<script type='text/javascript'>alert('Producto no eliminado correctamente'); </script>";
}
$ob = null;
}
//DeleteProducto(1);

function sacarProducto(){
$test = new ProductoModel();
$response = $test->sacarProducto(999);
echo "</br>";
echo "<table>
	<thead>
		<tr>
			<td>
			Identificacion	
			</td>
			<td>
			Codigo Producto
			</td>
			<td>
			Descripcion
			</td>
			<td>
			Precio
			</td>
			<td>
			Stock
			</td>
		</tr>
	</thead>
	<tbody>";
	echo "
	<tr>
		<td>
		".$response->__GET('Id_pro')."	
		</td>
		<td>
		".$response->__GET('Cod_producto')."
		</td>
		<td>
		".utf8_encode( $response->Descripcion)."
		</td>
		<td>
		".$response->Precio."
		</td>
		<td>
		".$response->Stock."
		</td>
	</tr>";

echo "</tbody>
</table>";
echo "</br>";
echo "</br>";
$test = null;
}

//sacarProducto();

function listarProductos(){
$test = new ProductoModel();
//print_r(  $test->mostrar_todo() );
$response = $test->mostrar_todo();
//print_r( $response );
echo "</br>";
/*
foreach ($response as $value) {
	echo $value->__GET('Descripcion');
	echo $value->Descripcion;
	print_r($value);

	$pro = new Producto();
	$pro = $value;
	echo $pro->__GET('Descripcion');
}*/
//print_r( $response[0] );
echo "<table>
	<thead>
		<tr>
			<td>
			Identificacion	
			</td>
			<td>
			Codigo Producto
			</td>
			<td>
			Descripcion
			</td>
			<td>
			Precio
			</td>
			<td>
			Stock
			</td>
		</tr>
	</thead>
	<tbody>";
foreach ($response as $key => $value) {
	echo "
	<tr>
		<td>
		".$value->__GET('Id_pro')."	
		</td>
		<td>
		".$value->__GET('Cod_producto')."
		</td>
		<td>
		".utf8_encode( $value->Descripcion)."
		</td>
		<td>
		".$value->Precio."
		</td>
		<td>
		".$value->Stock."
		</td>
	</tr>";
}
echo "</tbody>
</table>";
echo "</br>";
echo "</br>";
$test = null;
}
//listarProductos();

?>	
	