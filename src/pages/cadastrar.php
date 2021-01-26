<?php
	require_once '../../class/classe_usuario.php';
	require_once '../../utils/utils.php';
	$usuario = new Usuario("formulario_covid_pmjm","localhost","root","");
?>

<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Página de Cadastro</title>
	
	<link href="../../styles/style.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>

	<script type="text/javascript" src="../../res/jquery.mask.min.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$("#cpf").mask("000.000.000-00")

			$("#phone").mask("(00) 0000-00009")
			$("#phone").blur(function(event){
				if($(this).val().length == 15){
					$("#phone").mask("(00) 00000-0009")
				}else{
					$("#phone").mask("(00) 0000-00009")
				}
			})
		})

	</script>


	<link rel="stylesheet" href="../styles/style.css">
	
	<?php
		session_start();
		// Inicializar variáveis de erro com valor vazio
		$nome_erro = $cpf_erro = $telefone_erro = $email_erro = $senha_erro = "";

		if($_SERVER["REQUEST_METHOD"] == "POST") {

			$nome = $_POST["nome"];
			$cpf = str_replace('.', '', $_POST["cpf"]);
			$telefone = $_POST["telefone"];
			$email = $_POST["email"];
			$senha = $_POST["senha"];
			$confirmar_senha = $_POST["confirmar_senha"];

			// Validação cpf
			if(empty($cpf))
				$cpf_erro = "*Campo obrigatório";
			else if(!validaCPF($cpf))
				$cpf_erro = "CPF inválido";
			else {
				$resultados = $usuario->findBy(array("cpf" => $cpf));

				if (count($resultados) >= 1)
					$cpf_erro = "O cpf já está em uso";
			}

			// Validação email
			if(empty($email))
				$email_erro = "*Campo obrigatório";
			else {
				$resultados = $usuario->findBy(array("email" => $email));

				if(count($resultados) >= 1)
					$email_erro = "Este email já está em uso";
			}
			
			if(empty($nome))
				$nome_erro = "*Campo obrigatório";

			if(empty($telefone))
				$telefone_erro = "*Campo obrigatório";

			if(empty($senha) || empty($confirmar_senha))
				$senha_erro = "*Campo obrigatório";
			else if(strlen($senha) < 8)
				$senha_erro = "A senha precisa ter pelo menos 8 caracteres";
			else if($senha != $confirmar_senha)
				$senha_erro = "As senhas precisam ser iguais";

			if(!$nome_erro && !$cpf_erro && !$telefone_erro && !$email_erro && !$senha_erro)
				if($usuario->cadastrarUsuario($nome, $cpf, $telefone, $email, $senha)) {
					$_SESSION["cpf"] = $cpf;
					header('Location: login.php?success');
					exit();
				}
		}
	?>
</head>

<body>
	<div id="corpo_formulario">
		<h2>CADASTRO</h2>
			<form method="POST">
		
				<input
					name="nome"
					value="<?php if(isset($_POST["nome"])) echo $_POST["nome"]?>"
					type="text"
					placeholder="Nome Completo"
					maxlength="40">
				<span><?php echo $nome_erro ?></span>
				
				<input
					name="cpf"
					value="<?php if(isset($_POST["cpf"])) echo $_POST["cpf"]?>"
					id="cpf"
					type="text"
					placeholder="CPF"
					maxlength="14">
				<span><?php echo $cpf_erro ?></span>
				
				<input
					name="telefone"
					value="<?php if(isset($_POST["telefone"])) echo $_POST["telefone"]?>"
					id="phone"
					type="text"
					placeholder="Telefone"
					maxlength="15">
				<span><?php echo $telefone_erro ?></span>
				
				<input name="email" value="<?php if(isset($_POST["email"])) echo $_POST["email"]?>" type="email" placeholder="e-mail" maxlength="40">
				<span><?php echo $email_erro ?></span>
				</br>
              
				<input name="senha" type="password" placeholder="digite uma senha">
				<input name="confirmar_senha" type="password" placeholder="confirmar senha">
				<span><?php echo $senha_erro ?></span>
				</br>
				
                <input type="submit" value="CADASTRAR" name="cadastrar">
				</br>

				<span>Já tem uma conta?<a href="login.php" class="inline">Clique aqui</a>para fazer login.</span>
			</form>
		
	</div>
		
	
</body>
</html>