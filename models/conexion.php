<?php

class Conexion
{

	private $servidor = "localhost";
	private $db = "vallenato";
	private $port = 3306;
    public $pdo = null;
	private $charset = "utf8";
	private $usuario = "root";
	private $contrasena = "";
    private $opciones = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING];
    
	function __construct()
	{
		$this->pdo = new PDO("mysql:dbname={$this->db};host={$this->servidor};port={$this->port};charset={$this->charset}", $this->usuario, $this->contrasena, $this->opciones);
		
	}

	static public function conectar()
	{

		$link = new PDO(
			"mysql:host=localhost;dbname=vallenato",
			"root",
			""
		);

		$link->exec("set names utf8");

		return $link;
	}
}
