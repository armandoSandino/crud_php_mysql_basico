<?php 

require_once("conexion.php");
require_once("Producto.php");

class ProductoModel{
	private $conex;
	public function __construct(){
		try{
		$this->conex = Conexion::Conectar();
		$this->conex->setAttribute( PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION );
		}catch( Exception $ex){
			echo "error de conexion.";
			die( $ex->getMessage() );
		}
	}
	public function __destruct(){
	}
	public function  registrarProducto(&$cod,&$des,&$pre,&$sto){
		try{
			$query = $this->conex->prepare("INSERT INTO producto(Cod_producto,Descripcion,Precio,Stock) values(:cod,:des,:pre,:sto)");
			$query->bindValue(":cod",$cod);
			$query->bindValue(":des",$des);
			$query->bindParam(":pre",$pre);
			$query->bindParam(":sto",$sto);
			$query->execute();
			$res = $query->rowCount();
			if( $res > 0 ) return true;
			else return  false;
		}catch(Exception $ex){
			die( $ex->getMessage());
		}
	}
	public function editarProducto( &$id , &$cod , &$des , &$pre , &$sto ){
		try{
			$query = $this->conex->prepare("UPDATE producto SET Cod_producto=?,Descripcion=?, Precio=?,Stock=? WHERE Id_pro=?");
			$query->execute( array($cod,$des,$pre,$sto, $id) );
			$res = $query->rowCount();
			if( $res > 0 )return true;
			else return false;
		}catch( Exception $ex){
			die( $ex->getMessage() );
		}
	}
	public function eliminarProducto($Id_pro){
		try{
			$query = $this->conex->prepare("DELETE FROM producto WHERE Id_pro=?");
			$query->execute( array($Id_pro) );
			$res = $query->rowCount();//filas afectadas po el sql
			if( $res > 0)
				return true;
			else
				return false;
		}catch(Exception $ex){
			die( $ex->getMessage());
		}
	}
	public function sacarProducto($Cod_producto){
		try{
			$query = $this->conex->prepare("SELECT * FROM producto WHERE Cod_producto=?");
			$query->execute( array($Cod_producto) );
			$res = $query->fetch(PDO::FETCH_OBJ);
			$data = new Producto();
			$data->__SET('Id_pro',$res->Id_pro);
			$data->__SET('Cod_producto',$res->Cod_producto);
			$data->__SET('Descripcion',$res->Descripcion);
			$data->__SET('Precio',$res->Precio);
			$data->__SET('Stock',$res->Stock);
			return $data;
		}catch(Exception $ex){
			die( $ex->getMessage() );
		}
	}
	public function mostrar_todo(){
		try{
			$response = array();
			$query = $this->conex->prepare("SELECT * FROM producto");
			$query->execute();
	/*while($proveedor = mysqli_fetch_array($query)){
       echo $proveedor['Descripcion'].', ';
    }
	foreach(mysqli_fetch_all($query, MYSQLI_ASSOC) as $proveedor){
       echo $proveedor['Descripcion'].', ';
    }*/
			foreach( $query->fetchAll() as $item ){
				$data = new Producto();
				//print_r($item);
				$data->__SET('Id_pro',$item['Id_pro']);
				//$data->__SET('Cod_producto',$item->Cod_producto);
				$data->__SET('Cod_producto',$item['Cod_producto']);
				$data->__SET('Descripcion',$item['Descripcion']);
				$data->__SET('Precio',$item['Precio']);
				$data->__SET('Stock',$item['Stock']);
				$response[] = $data;
			}
			return $response;
		}catch( Exception  $ex ){
			die( $ex->getMessage() );
		}
	}
}

?>