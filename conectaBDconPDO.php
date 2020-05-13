<?php
	class conectaBD{
		private $conn = null ;
		private static $instancia;

		private function __construct($database='agenda'){
			$dsn ="mysql:host=localhost;dbname=$database" ;
			try {
				$this->conn = new PDO( $dsn, 'root', '' );

			} catch ( PDOException $e) {
				die( "¡Error!: " . $e->getMessage() . "<br/>");
			}
		}
		
		//método singleton que crea instancia sí no está creada
		public static function singleton(){ 
			if (!isset(self::$instancia)) {
				$miclase = __CLASS__;
				self::$instancia = new $miclase;
			}
				return self::$instancia;
		}
		 // Cierra conexión asignándole valor null
		public function __destruct(){

			$this->conn = null;

		}
		public function __clone(){
			trigger_error("La clonación no esta permitida", E_USER_ERROR);
		}
		public function registroDeUsuario($correo,$usuario,$contra,$dni) { 
			try{ 
				//tabla 1
				$sql = "INSERT INTO usuarios (correo, nombre, contrasenia, DNI) VALUES(:miCorreo,:miNom,:miContra,:miDNI)";
				$resultado = $this->conn->prepare($sql);
				$resultado->execute(array( ":miCorreo"=>$correo,":miNom"=>$usuario, ":miContra"=>$contra,":miDNI"=>$dni));

				//tabla 2
				$sql = "INSERT INTO usuarios_roles (correo,idR) VALUES(:miCorreo,1)";
				$resultado = $this->conn->prepare($sql);
				$resultado->execute(array( ":miCorreo"=>$correo));
			} catch (PDOException $pe){
				die("Error al ejecutar orden select :" . $pe->getMessage());
			} 
		}

		public function inicioSesion($correo) { 
			try{ 
				$consulta = "select contrasenia from usuarios where correo=:miCorreo ";
				$consulta = $this->conn->prepare($consulta);
				$consulta->execute(array(':miCorreo' =>$correo));
			
				$resultado = $consulta->fetch();
				return $resultado['contrasenia'];
			} catch (PDOException $pe){
				die("Error al ejecutar orden select :" . $pe->getMessage());
			} 
		}

		public function telefonosPublicos() { 
			try{ 
				$consulta = "select * from tlf_publicos ";
				$consulta = $this->conn->prepare($consulta);		
				$consulta->execute();

				$resultado = $consulta->fetchAll(PDO::FETCH_NUM);
				return $resultado;
			} catch (PDOException $pe){
				die("Error al ejecutar orden select :" . $pe->getMessage());
			} 
		}
		public function consultaPreparada4($nombre) { 
			try{ 
				$consulta = "select * from tlf_publicos where nombre LIKE '%:miNombre%' ";
				$consulta = $this->conn->prepare($consulta);		
				$consulta->execute(array(':miNombre' =>$nombre));

				$resultado = $consulta->fetchAll(PDO::FETCH_NUM);
				return $resultado;
			} catch (PDOException $pe){
				die("Error al ejecutar orden select :" . $pe->getMessage());
			} 
		}

		public function consultaPreparada5($correo) { 
			try{ 
				//select * from usuarios_tlf_privados utlf join usuarios u on u.correo = utlf.correo join tlf_privados tlf on tlf.numero = utlf.numero
				$consulta = "select nombre from tlf_privados ORDER BY nombre ASC";
				$consulta = $this->conn->prepare($consulta);		
				$consulta->execute(array(':miCorreo' =>$correo));

				$resultado = $consulta->fetchAll(PDO::FETCH_NUM);
				return $resultado;
			} catch (PDOException $pe){
				die("Error al ejecutar orden select :" . $pe->getMessage());
			} 
		}
	}
?>