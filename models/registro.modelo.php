<?php

require_once "conexion.php";

class ModeloRegistro
{

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function mdlRegistrarNegocio($datos)
	{
		$db = new Conexion();

		$stmt = $db->pdo->prepare("INSERT INTO negocios(nombre,movil,correo,correoEncriptado,estado,tipoPlan,fechaRegistro) VALUES (:nombre,:movil,:correo,:correoEncriptado,:estado,:tipoPlan, :fechaRegistro)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$stmt->bindParam(":correoEncriptado", $datos["correoEncriptado"], PDO::PARAM_STR);
		$stmt->bindParam(":movil", $datos["movil"], PDO::PARAM_STR);
		$stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
		$stmt->bindParam(":tipoPlan", $datos["tipoPlan"], PDO::PARAM_INT);
		$stmt->bindParam(":fechaRegistro", $datos["fechaRegistro"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return	$stmt = $db->pdo->lastInsertId();
		} else {

			return $stmt->errorInfo();
		}
	}

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function mdlIngresarUsuarioAdmin($datos)
	{

		$stmt = Conexion::conectar()->prepare("INSERT INTO usuarios(nombre,usuario,correoUsuario,password,perfil,documento,estado,fechaIngreso,negocio) VALUES ('ADMINISTRADOR',:usuario,:correo,:pass,'Administrador',0,1,:fechaIngreso,:idNegocio);INSERT INTO tecnicos(nombre,documento,negocio) VALUES ('seleccionar tecnico',0,:idNegocio)");

		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$stmt->bindParam(":pass", $datos["pass"], PDO::PARAM_STR);
		$stmt->bindParam(":idNegocio", $datos["idNegocio"], PDO::PARAM_INT);
		$stmt->bindParam(":fechaIngreso", $datos["fechaIngreso"], PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return $stmt->errorInfo();
		}
	}

	/*=============================================
	VALIDAR NO REPETIR CORREO
	=============================================*/

	static public function mdlValidar($valor, $item)
	{

		$stmt = Conexion::conectar()->prepare("SELECT COUNT(id) as cantidad FROM usuarios WHERE $item = :dato");

		$stmt->bindParam(":dato", $valor, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();
	}

	static public function mdlValidarCorreo($valor)
	{

		$stmt = Conexion::conectar()->prepare("SELECT id,estado FROM usuarios WHERE emailEncriptado = :correo");

		$stmt->bindParam(":correo", $valor, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();
	}

	static public function mdlCambiarValorValidado($id)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE usuarios SET estado=1 WHERE id = :id");

		$stmt->bindParam(":id", $id, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return $stmt->errorInfo();
		}
	}


}
