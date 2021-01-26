<?php
	require_once "../../class/classe_usuario.php";
	require_once '../../utils/utils.php';
	
	$usuario = new Usuario("formulario_covid_pmjm", "localhost", "root", "");
?>

<html lang="pt-br">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Página de Login</title>

		<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>

		<script type="text/javascript" src="../../res/jquery.mask.min.js"></script>
		
		<script type="text/javascript">
			$(document).ready(function(){
				$("#cpf").mask("000.000.000-00")
			})
		</script>

		<link rel="stylesheet" href="../../styles/style.css">
         
</head>

<body>
	<?php
		session_start();
		$success = isset($_REQUEST['success']);

		// Inicializar variáveis de erro com valor vazio
		$erro = "";

		if($_SERVER["REQUEST_METHOD"] == "POST") {
			$cpf = addslashes(str_replace('.', '', $_POST["cpf"]));
			$senha = addslashes($_POST['senha']);
		
			$_SESSION["cpf"] = $cpf;

			$usuario_conectado = $usuario->login($cpf, $senha);

			if(count($usuario_conectado) <= 0)
				$erro = "Usuário ou senha incorretos";
			else {
				$userId = $usuario_conectado[0]["id"];
				$_SESSION["usuario_id"] = $userId;

				$dados_usuario_conectado = $usuario->getDados($userId);

				if(count($dados_usuario_conectado) <= 0)
					header("Location: ./form_grupo_risco.php");
				else
					header("Location: ./form_covid.php");
				
				exit();
			}
		}
	?> 

	<div id="corpo_formulario" action="?go=logar">
		<h2>ENTRAR</h2>

		<span><?php echo $success ? "Cadastro efetuado com sucesso" : "" ?></span>
		
		<!-- <form method="post" action="processa_dados.php"> -->
		<form method="POST">
		
            <input name="cpf" value="<?php if(isset($_SESSION["cpf"])) echo $_SESSION["cpf"] ?>" id= cpf type="text" placeholder="CPF" >
			</br>
				
            <input name="senha" type="password" placeholder="digite sua senha">
			</br>
				
            <input type="submit" value="ACESSAR">
			<span><?php echo $erro ?></span>
			<a href="cadastrar.php">Ainda não é cadastrado? <strong>Cadastre-se Aqui!</strong></a>
			</br>
		
		</form>

	</div>
	
</body>

</html>