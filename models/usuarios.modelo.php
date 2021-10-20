<?php

require_once "conexion.php";

class ModeloUsuarios{
	
	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function mdlMostrarUsuarios($item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE activo=1 and $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE activo=1 order by nombre asc");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function mdlIngresarUsuario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, usuario,correoUsuario, password, perfil, documento,estado,fechaIngreso) VALUES (:nombre, :usuario,:correo, :password, :perfil,:documento,1,:fechaIngreso)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
		$stmt->bindParam(":fechaIngreso", $datos["fechaIngreso"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";	

		}else{

			return $stmt->errorInfo();
		
		}

		$stmt->close();
		
		$stmt = null;

	}

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function mdlEditarUsuario($tabla, $datos){
		
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre,usuario=:usuario,correoUsuario=:correoUsuario, perfil = :perfil WHERE id = :id");

		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_STR);
		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":correoUsuario", $datos["correoUsuario"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR USUARIO
	=============================================*/

	static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	CAMBIAR CONTRASEÑA
	=============================================*/

	static public function mdlCambiarPass($valor1,$valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE usuarios SET password = :pass WHERE id = :id");

		$stmt -> bindParam(":pass", $valor2, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor1, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=====================================
	REGISTRO DE USUARIO
	======================================*/

	static public function mdlRegistroUsuario($tabla, $datos){

		$db = new Conexion();

		$stmt = $db->pdo->prepare("INSERT INTO $tabla(documento, usuario, correoUsuario, password, perfil, estado, emailEncriptado) VALUES (:documento, :usuario, :correoUsuario, :password, :perfil, :estado, :emailEncriptado)");

		$stmt ->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
		$stmt ->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt ->bindParam(":correoUsuario", $datos["correoUsuario"], PDO::PARAM_STR);
		$stmt ->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt ->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt ->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);
		$stmt ->bindParam(":emailEncriptado", $datos["emailEncriptado"], PDO::PARAM_STR);

		if ($stmt->execute()){

			return	$stmt = $db->pdo->lastInsertId();

		}else{

			return $stmt->errorInfo();
		}

	}

	/*=============================================
	REGISTRO LOGISTICA
	=============================================*/

	static public function mdlIngresarLogistica($id){

		$stmt = Conexion::conectar()->prepare("INSERT INTO logistica(idUsuario) VALUES ($id)");

		if($stmt->execute()){

			return "ok";	

		}else{

			return $stmt->errorInfo();
		
		}

		$stmt->close();
		
		$stmt = null;

	}

	/*=============================================
	REGISTRO MEDIOS
	=============================================*/

	static public function mdlIngresarMedios($id){

		$stmt = Conexion::conectar()->prepare("INSERT INTO medios(idUsuario) VALUES ($id)");

		if($stmt->execute()){

			return "ok";	

		}else{

			return $stmt->errorInfo();
		
		}

		$stmt->close();
		
		$stmt = null;

	}
	
}