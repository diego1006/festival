<?php

require_once "conexion.php";

class ModeloLogistica
{
	/*=============================================
	GUARDAR DATOS LOGISTICA
	=============================================*/
	static public function mdlGuardarLogistica($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, apellido = :apellido, fechaNacimiento = :fechaNacimiento, ciudad = :ciudad, edad = :edad, estatura = :estatura, grupoSanguineo = :grupoSanguineo, genero = :genero, formacionAcademica = :formacionAcademica, ocupacion = :ocupacion, trabajoAnterior = :trabajoAnterior, direccion = :direccion, telefono = :telefono, celular = :celular, archivos = :archivos, estado = :estado WHERE idUsuario = :id");
		$stmt -> bindParam(":id", $datos["idUsuario"], PDO::PARAM_INT);
		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
		$stmt -> bindParam(":fechaNacimiento", $datos["fechaNacimiento"], PDO::PARAM_STR);
		$stmt -> bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
		$stmt -> bindParam(":edad", $datos["edad"], PDO::PARAM_INT);
		$stmt -> bindParam(":estatura", $datos["estatura"], PDO::PARAM_STR);
		$stmt -> bindParam(":grupoSanguineo", $datos["grupoSanguineo"], PDO::PARAM_STR);
		$stmt -> bindParam(":genero", $datos["genero"], PDO::PARAM_STR);
		$stmt -> bindParam(":formacionAcademica", $datos["formacionAcademica"], PDO::PARAM_STR);
		$stmt -> bindParam(":ocupacion", $datos["ocupacion"], PDO::PARAM_STR);
		$stmt -> bindParam(":trabajoAnterior", $datos["trabajoAnterior"], PDO::PARAM_STR);
		$stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt -> bindParam(":celular", $datos["celular"], PDO::PARAM_STR);
		$stmt -> bindParam(":archivos", $datos["archivos"], PDO::PARAM_STR);
		$stmt -> bindParam(":estado", $datos["estado"], PDO::PARAM_INT);

		if($stmt -> execute()){
			return "ok";
		}else{
			return $stmt->errorInfo();	
		}

		$stmt = null;
	}

	/*=============================================
	MOSTRAR LOGISTICA PENDIENTE
	=============================================*/
	static public function mdlMostrarLogistica($item, $valor, $estado)
	{
		if ($item != null && $estado == null) {
			// SELECT usuarios.id, logistica.nombre, usuarios.documento, usuarios.correoUsuario, logistica.fechaNacimiento, logistica.ciudad, logistica.edad, logistica.estatura, logistica.grupoSanguineo, logistica.genero, logistica.formacionAcademica, logistica.ocupacion, logistica.trabajoAnterior, logistica.direccion, logistica.telefono, logistica.celular FROM logistica, usuarios WHERE usuarios.id = logistica.idUsuario
			$stmt = Conexion::conectar()->prepare("SELECT usuarios.id, logistica.nombre, logistica.apellido, usuarios.documento, usuarios.usuario, usuarios.correoUsuario, logistica.fechaNacimiento, logistica.ciudad, logistica.edad, logistica.estatura, logistica.grupoSanguineo, logistica.genero, logistica.formacionAcademica, logistica.ocupacion, logistica.trabajoAnterior, logistica.direccion, logistica.telefono, logistica.celular, logistica.estado FROM logistica, usuarios WHERE usuarios.id = logistica.idUsuario AND usuarios.id = :$item");
			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetch();
		} else {
			// SELECT * FROM logistica, usuarios where logistica.idUsuario = usuarios.id
			$stmt = Conexion::conectar()->prepare("SELECT usuarios.id, logistica.nombre, logistica.apellido, usuarios.documento, usuarios.usuario, usuarios.correoUsuario, logistica.fechaNacimiento, logistica.ciudad, logistica.edad, logistica.estatura, logistica.grupoSanguineo, logistica.genero, logistica.formacionAcademica, logistica.ocupacion, logistica.trabajoAnterior, logistica.direccion, logistica.telefono, logistica.celular, logistica.estado FROM logistica, usuarios WHERE usuarios.id = logistica.idUsuario AND logistica.estado = :$estado");
			$stmt->bindParam(":" . $estado, $estado, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll();
		}

		$stmt = null;
	}

	// ============================================================================
	// APROBAR USUARIO
	// ============================================================================
	static public function mdlAprobarUsuario($id)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE logistica SET estado = 1 WHERE idUSuario = :id");

		$stmt->bindParam(":id", $id, PDO::PARAM_INT);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt = null;
	}

	// ============================================================================
	// RECHAZAR USUARIO
	// ============================================================================
	static public function mdlRechazarUsuario($id)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE logistica SET estado = 2 WHERE idUSuario = :id");

		$stmt->bindParam(":id", $id, PDO::PARAM_INT);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt = null;
	}
}