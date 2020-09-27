<?php
	require_once "../class/classe_usuario.php";
	$usuario = new Usuario("formulario_covid_pmjm", "localhost", "root", "");
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
			})
		</script>

		<link rel="stylesheet" href="../styles/style.css">
         
</head>

<body>
	<?php
		if(isset($_POST['cpf'])){
			$cpf = addslashes($_POST['cpf']);
			$senha = addslashes($_POST['senha']);
		
			$res = $usuario->login($_POST['cpf'],$_POST['senha']);

			// foreach($res as $key => $value){
			// 	echo $key.": ".$value."\n";
			// }

			if($res['formulario_grupo_risco'])
				header("Location: ./form_covid.php");
			else
				header("Location: ./form_grupo_risco.php");

			exit();
		}	
	?> 

	<div id="corpo_formulario">
		<h2>ENTRAR</h2>
		
		<!-- <form method="post" action="processa_dados.php"> -->
		<form method="POST">
		
            <input name="cpf" id= cpf type="text" placeholder="CPF" >
			</br>
				
            <input name="senha" type="password" placeholder="digite sua senha">
			</br>
				
            <input type="submit" value="ACESSAR">
			<a href="cadastrar.php">Ainda não é cadastrado? <strong>Cadastre-se Aqui!</strong></a>
			</br>
		
		</form>

	</div>
	
</body>

</html>