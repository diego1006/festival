<?php

require_once "conexion.php";

class ModeloMedios{


	/*=============================================
	INSERTAR PERSONAL
	=============================================*/
												
	static public function mdlInsertaPersonal($valor){
		
		$stmt = Conexion::conectar()->prepare("INSERT INTO personal(idMedio) VALUES ($valor)");

		if($stmt->execute()){

			return "ok";	

		}else{

			return $stmt->errorInfo();
		
		}

	}



	/*=============================================
	MOSTRAR MEDIOS
	=============================================*/
												
	static public function mdlMostrarMedios($item, $valor, $estado){
		
		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT tipo_medio.id as idTipo, tipo_medio.cupo as cupo, tipo_medio.nombre as tipo, medios.id, medios.nombre, medios.representante, medios.documento, medios.ciudad, medios.telefono, medios.direccion, medios.correo, medios.estado,medios.foto FROM medios, tipo_medio WHERE medios.id = :$item AND medios.tipoMedio = tipo_medio.id");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);
			
			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT medios.id, medios.fechaRegistro, medios.nombre,  medios.representante, medios.documento, medios.telefono, medios.direccion, medios.correo, medios.estado, tipo_medio.nombre as tipo FROM medios INNER JOIN tipo_medio ON medios.tipoMedio = tipo_medio.id where estado = :$estado");

			$stmt -> bindParam(":".$estado, $estado, PDO::PARAM_INT);


			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR MEDIOS SIN TIPO
	=============================================*/

	static public function mdlMostrarMediosSinTipo($item, $valor, $estado){
		
		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT usuarios.documento as usudoc, usuarios.correoUsuario as usuco,  medios.estado FROM medios, usuarios  WHERE medios.id = :$item AND medios.idUsuario = :$estado AND medios.idUsuario = usuarios.id");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);
			$stmt -> bindParam(":".$estado, $estado, PDO::PARAM_INT);

			
			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT medios.id, medios.fechaRegistro, medios.nombre,  medios.representante, medios.documento, medios.telefono, medios.direccion, medios.correo, medios.estado, tipo_medio.nombre as tipo FROM medios INNER JOIN tipo_medio ON medios.tipoMedio = tipo_medio.id where estado = :$estado");

			$stmt -> bindParam(":".$estado, $estado, PDO::PARAM_INT);


			$stmt -> execute();

			return $stmt -> fetchAll();

		}


		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR TIPO MEDIOS
	=============================================*/

	static public function mdlMostrarTipoMedios($item, $valor){
		
		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM medios WHERE activo=1 and $item = :$item"  );

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			
			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM tipo_medio");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR TIPO MEDIOS
	=============================================*/

	static public function mdlMostrarTipoMediosById($id){
		
		$stmt = Conexion::conectar()->prepare("SELECT * FROM tipo_medio WHERE id = $id"  );

		$stmt -> execute();

		return $stmt -> fetch();		

	}

	/*=============================================
	VALIDAR ESTADO MEDIO
	=============================================*/

	static public function mdlValidarEstadoMedio($item, $valor){
		
		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT medios.estado, medios.id as medio FROM usuarios INNER JOIN medios ON usuarios.id = medios.idUsuario WHERE  $item = :$valor");

			$stmt -> bindParam(":".$valor, $valor, PDO::PARAM_STR);
			
			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM tipo_medio");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

	// ============================================================================
	// APROBAR O RECHAZAR MEDIO
	// ============================================================================

	static public function mdlCambiosMedios($id, $cambio)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE medios SET estado = $cambio WHERE id = :id");

		$stmt->bindParam(":id", $id, PDO::PARAM_INT);
		// $stmt->bindParam(":cambio", $cambio, PDO::PARAM_INT);


		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt = null;
	}

	/*=============================================
	MOSTRAR PERSONAL
	=============================================*/

	static public function mdlMostrarPersonal($item){				

		$stmt = Conexion::conectar()->prepare("SELECT * FROM personal WHERE idMedio  = :$item");

		$stmt -> bindParam(":".$item, $item, PDO::PARAM_STR);
		
		$stmt -> execute();

		return $stmt -> fetchAll();


		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE MEDIO
	=============================================*/

	static public function mdlCrearMedio($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, representante = :representante, documento = :documento, telefono = :telefono, direccion = :direccion, ciudad = :ciudad, correo = :correo, tipoMedio = :tipoMedio, estado = :estado, fechaRegistro = :fechaRegistro,foto=:foto WHERE idUsuario = :idUsuario");

		$stmt->bindParam(":idUsuario", $datos["idUsuario"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":representante", $datos["representante"], PDO::PARAM_STR);
		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$stmt->bindParam(":tipoMedio", $datos["tipoMedio"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
		$stmt->bindParam(":fechaRegistro", $datos["fechaRegistro"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";	

		}else{

			return $stmt->errorInfo();
		
		}

	}
}