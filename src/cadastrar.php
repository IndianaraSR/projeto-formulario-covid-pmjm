<?php
	require_once '../class/classe_usuario.php';
	$usuario = new Usuario("formulario_covid_pmjm","localhost","root","");
?>

<html lang="pt-br">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<title>Página de Loading</title>
		
		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>

		<script type="text/javascript" src="../res/jquery.mask.min.js"></script>
		
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
        
</head>

<body>
	<?php
		if(isset($_POST['cpf'])){
			$nome = addslashes($_POST['nome']);
			$cpf = addslashes($_POST['cpf']);
			$telefone = addslashes($_POST['telefone']);
			$email = addslashes($_POST['email']);
			$senha = addslashes($_POST['senha']);

			if(!empty($nome) && !empty($cpf) && !empty($telefone) && !empty($email) && !empty($senha)){

				if(!$usuario->cadastrarUsuario($nome, $cpf, $telefone, $email, $senha)) {
					echo "CPF JÁ CADASTRADO!<br>";
				}

				if($senha != $_POST['confirm_senha'])
					echo "AS SENHAS DIGITADAS NÃO SÃO IGUAIS!";

			}else{
				echo "PREENCHA TODOS OS CAMPOS";
			}
		}	
	
	?>

	<div id="corpo_formulario">
		<h2>CADASTRO</h2>
			<form method="POST">
		
				<input name="nome" value="<?php if(isset($_POST["nome"])) echo $_POST["nome"]?>" type="text" placeholder="Nome Completo" maxlength="40">
				
				<input name="cpf" value="<?php if(isset($_POST["cpf"])) echo $_POST["cpf"]?>" id="cpf" type="text" placeholder="CPF" maxlength="14">
				
				<input name="telefone" value="<?php if(isset($_POST["telefone"])) echo $_POST["telefone"]?>" id="phone" type="text" placeholder="Telefone" maxlength="15">
				
				<input name="email" value="<?php if(isset($_POST["email"])) echo $_POST["email"]?>" type="email" placeholder="e-mail" maxlength="40">
				</br>
              
				<input name="senha" type="password" placeholder="digite uma senha" maxlength="8">
				<input name="confirm_senha" type="password" placeholder="confirmar senha">
				</br>
				
                <input type="submit" value="CADASTRAR" name="cadastrar">
				</br>

				<span>Já tem uma conta?<a href="login.php" class="inline">Clique aqui</a>para fazer login.</span>
				
			</form>
		
	</div>
		
	
</body>
</html>