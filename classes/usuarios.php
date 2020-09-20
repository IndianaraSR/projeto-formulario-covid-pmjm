<?php
$link = mysqli_connect("HOST", "USUARIO", "SENHA", "BASE");

class usuario{
	private $pdo; /*variavel instaciada usada nas três fuções*/
	public $msgErro = "";
	
	/*faz a conexão com o banco de dados, exige quatro parametros nome do banco de dados, host(servidor utilizado), usuario e senha*/
	public function conectar($nome, $host, $usuario, $senha){
		global $pdo;
		try{
			$pdo= new PDO("mysql:dbname".$nome.";host=".$host,$usuario,$senha);
			
		}catch (PDOException $e){			
			$msgErro = $e->getMessage();
			
		}
	}
	
	/*envia as informações para o banco de dados*/
	public function cadastrar($nome, $cpf, $telefone, $email, $senha){
		global $pdo;
		
		/*verificar se já existe cadastro*/
		$sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE cpf = :c");
		$sql -> bindValue(":c", $cpf);
		$sql -> execute();
		
		if($sql -> rowCount() > 0){
			return false; /*já existe cadastro*/
			
		}else{
			/*se não existir cadastro*/			
			$sql = $pdo->prepare("INSERT INTO usuarios(nome, cpf, telefone, email, senha) VALUES (:n, :c, :t, :e, :s)");
			
			$sql -> bindValue(":n", $nome);
			$sql -> bindValue(":c", $cpf);
			$sql -> bindValue(":t", $telefone);
			$sql -> bindValue(":e", $email);
			$sql -> bindValue(":s", md5$senha); /*md5 criptografa a senha*/
			$sql -> execute();
			return true();				
			
		}
	}
	
	/*tela de login*/
	public function logar($cpf, $senha){
		global $pdo;
		
		/*verifica se email e senha estão cadastrados, caso esteja cadastrado entra no sistema*/
		$sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE cpf = :c AND senha = :s"); /*cpf e senha iguais ao cadastrado no banco de dados*/
		$sql -> bindValue(":c", $cpf);
		$sql -> bindValue(":s", md5$senha);
		$sql -> execute();
		
		/*se existe o id na consulta*/
		if($sql->rowCount()>0){
			
			/*para acessar o sistema*/
			$dado = $sql->fetch(); /*informações do banco de dados são tranformados em array*/
			session_start(); /*iniciando sessão*/
			$_SESSION['id_usuario'] = $dado['id_usuario'];
			return true; /*logado com sucesso*/
			
		}else{			
			return false; /*não foi possivel logar*/
			
		}
		
	}
}

?>