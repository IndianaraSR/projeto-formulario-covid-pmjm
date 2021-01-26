<?php
	session_start();

	define('DB_HOST', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'formulario_covid_pmjm');

	try {
		$connect = new PDO("mysql:host=".dbhost."; dbname=".dbname, dbuser, dbpass);
		$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}

/*conexão com o banco de dados*/
/*try{
	$pdo = new PDO("mysql:dbname=formulario_covid_pmjm;host=localhost","root","");
}catch (PDOException $e){
	echo "Erro com BD".$e->getMessage();
}catch(Exception $e){
	echo "Erro".$e->getMessage();
}
/*inerção de dados 1*/
/*$res = $pdo->prepare("INSERT INTO usuarios(nome, cpf, telefone, email, senha) VALUES (:n, :c, :t, :e, :s)");
	
	$res->bindValue(":n", "Indianara");
	$res->bindValue(":c", "369258147");
	$res->bindValue(":t", "999999");
	$res->bindValue(":e", "teste2");
	$res->bindValue(":s", "1234"); //md5 criptografa a senha
	$res->execute();*/
	


/*deletar e atualizar dados - DELETE*/
/*$cmd = $pdo->prepare("DELETE FROM usuarios WHERE id_usuario = :id");
$id = 3;
$cmd->bindValue(":id",$id);
$cmd->execute();*/

/*atualizar o banco de dados UPDATE*/
/*$cmd = $pdo->prepare("UPDATE usuarios SET email = :e WHERE id_usuario = :id");
$cmd->bindValue(":e","guga@gmail.com");
$cmd->bindValue(":id",3);
$cmd->execute();*/

/*-----SELECT------*/
/*$cmd = $pdo->prepare("SELECT * FROM usuarios WHERE id_usuario = :id");
$cmd->bindValue(":id",1);
$cmd->execute();
$resultado = $cmd->fetch(PDO::FETCH_ASSOC);

foreach($resultado as $key => $value){
	echo $key.": ".$value."\n";
}*/
?>