<?php
	require_once "../../class/classe_usuario.php";
	
	$usuario = new Usuario("formulario_covid_pmjm", "localhost", "root", "");
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!-- Meta tags Obrigatórias -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Formulário de Monitoramento de Saúde - Covid 19</title>

        <link rel="stylesheet" href="../../styles/style.css">
        <link rel="stylesheet" href="../../styles/style_form.css">

		<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <script src="../../res/jquery.mask.min.js"></script>
       
        <script type="text/javascript">
            $(document).ready(function(){
            $("#cpf").mask("999.999.999-99");
        });
    </script>

    </head>

<body>

    <?php
        session_start();

        $user_id = isset($_SESSION["usuario_id"]);

        // Verificar se o usuário está conectado
        if(!$user_id)
            header("Location: ./login.php");
    
		// Inicializar variáveis de erro com valor vazio
		$idade_erro = "";

		if($_SERVER["REQUEST_METHOD"] == "POST") {

            $user_id = $_SESSION["usuario_id"];
			$idade = $_POST["idade"];
			$sexo = $_POST["sexo"];
            $gestante = isset($_POST["gestante"]);
            $trabalho = $_POST["trabalho"];
            $grupo_risco = isset($_POST["grupo_risco"]);
            
            // echo print_r($_POST);
            echo "Idade: " . $idade, "<br>";
            echo "Sexo: " . $sexo, "<br>";
            echo "Gestante: " . $gestante, "<br>";
            echo "Trabalho: " . $trabalho, "<br>";
            echo "Grupo de risco: " . $grupo_risco, "<br>";

			// Validação idade
			if(empty($idade))
				$idade_erro = "*Campo obrigatório";

			if(!$idade_erro)
				if($usuario->cadastrarDados($user_id, $idade, $sexo, $gestante, $trabalho, $grupo_risco)) {
            		header('Location: form_covid.php');
					exit();
                } else {
                    $dados_usuario_conectado = $usuario->getDados($user_id);

                    if(count($dados_usuario_conectado) > 0)
                        header("Location: ./form_covid.php");
                }
		}
	?> 

    <h1 id="title">FORMULÁRIO GRUPO DE RISCO</h1>


    <form method="POST">
        <script>
            function genero(obj) {
                const checkGestante = document.getElementById('gestante');

                if(obj.value === 'm') {
                    checkGestante.disabled = true;
                    checkGestante.checked = false;
                } else
                    checkGestante.disabled = false;
            }
        </script>

        <div>        
            <h4 class="destaque">Identificação Grupo de Risco</h4></br>

            <strong for="idade">Idade</strong>
            <input type="number" id="idade" name="idade" min="0" max="100">
            <span><?php echo $idade_erro ?></span>
            </br></br>

            <strong>Sexo</strong></br>

            <input type="radio" id="fem" name="sexo" value="f" onclick="genero(this)" checked>
            <label for="fem">Feminino</label>
            </br>

            <input type="radio" id="masc" name="sexo" value="m" onclick="genero(this)">
            <label for="masc">Masculino</label>
            </br></br>

            <input type="checkbox" id="gestante" name="gestante">
            <label for="gestante">Gestante ou Puérpera</label>
            </br></br>

            <label>Situação de Trabalho</label></br>
            <select name="trabalho">
                <option value="Remoto" selected>Trabalho Remoto</option>
                <option value="Presencial">Trabalho Presencial</option>
                <option value="Misto">Trabalho Misto</option>
            </select>
            </br></br>

            <strong>Quem faz parte do grupo de risco do Coronavírus?</strong>
            <p>São considerados grupo de risco para agravamento da COVID-19 os portadores de doenças crônicas, como diabetes e hipertensão, 
                asma, doença pulmonar obstrutiva crônica, e indivíduos fumantes (que fazem uso de tabaco incluindo narguilé).</p>

            <strong>Fonte: </strong><a target="_blank" href="https://aps.bvs.br/aps/quais-sao-os-grupos-de-risco-para-agravamento-da-covid-19/">aps.bvs.br</a>
            </br></br>

            <input type="checkbox" id="grupo_risco" name="grupo_risco">        
            <label for="grupo_risco">Declaro que sou portador de alguma das doenças descritas acima.</label></br>        
        </div>
        </br>
        
        <div class="button">
            <button type="submit">Salvar</button>
            <a href="formulario.html"></a>
        </div>
    </form>

</body>
</html>