<?php

require_once "conexion.php";

class ModeloPersonal{


	/*=============================================
	GUARDAR DATOS LOGISTICA
	=============================================*/
	static public function mdlGuardarPersonal($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET documento = :documento, nombre = :nombre, cargo = :cargo, telefono = :telefono, correo = :correo, archivos = :archivos, fechaRegistro = :fechaRegistro WHERE id = :id");
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt -> bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":cargo", $datos["cargo"], PDO::PARAM_STR);
		$stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt -> bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$stmt -> bindParam(":archivos", $datos["archivos"], PDO::PARAM_INT);
		$stmt -> bindParam(":fechaRegistro", $datos["fechaRegistro"], PDO::PARAM_STR);

		if($stmt -> execute()){
			return "ok";
		}else{
			return $stmt->errorInfo();	
		}

		$stmt = null;
	}
}