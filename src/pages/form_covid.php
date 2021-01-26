<?php
	require_once '../../class/classe_formulario.php';
	$formulario = new Formulario("formulario_covid_pmjm","localhost","root","");
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!-- Meta tags Obrigatórias -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Formulário de Monitoramento de Saúde - Covid 19</title>

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
    
		// Inicializar variáveis de erro com valor vazio
        $idade_erro = "";
        
        $user_id = isset($_SESSION["usuario_id"]);

        // Verificar se o usuário está conectado
        if(!$user_id)
            header("Location: ./login.php");

		if($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $febre = isset($_POST["febre"]);
            $dor_corpo = isset($_POST["dor_corpo"]);
            $dor_garganta = isset($_POST["dor_garganta"]);
            $diarreia = isset($_POST["diarreia"]);
            $dificuldade_respirar = isset($_POST["dificuldade_respirar"]);
            $mensagem_sintomas = isset($_POST["mensagem_sintomas"]);
            $data_sintomas = isset($_POST["data_sintomas"]);

            // $to = 'indi.srodrigues@gmail.com';
            // $subject = 'the subject';
            // $message = 'hello';
            // $headers = 'From: webmaster@example.com' . "\r\n" .
            //     'Reply-To: webmaster@example.com' . "\r\n" .
            //     'X-Mailer: PHP/' . phpversion();

            // mail($to, $subject, $message, $headers);

			// Validação idade
			// if(empty($idade))
			// 	$idade_erro = "*Campo obrigatório";

            // if(!$idade_erro)
            
                print_r($formulario->getLast($user_id));

                // if($formulario->cadastrarRelatorio($user_id, $febre, $dor_corpo, $dor_garganta, $diarreia, $dificuldade_respirar, $mensagem_sintomas)) {
                //     echo "RELATÓRIO ENVIADO COM SUCESSO.";
            // 		header('Location: form_covid.php');
			// 		exit();
            //     } else {
            //         $dados_usuario_conectado = $usuario->getDados($user_id);

            //         if(count($dados_usuario_conectado) > 0)
            //             header("Location: ./form_covid.php");
                // }
		}
	?> 

    <h1 id="title">MONITORAMENTO DE SAÚDE - COVID 19</h1>

    <form method=post name="form" method="post" action="">

    <div>
        </select>
        </br></br>

        <h4 class="destaque">Sintomas</h4>

        <input type="checkbox" id="febre" name="febre">
        <label for="febre">Febre</label>
        </br>

        <input type="checkbox" id="dorcorpo" name="dor_corpo">
        <label for="dorcorpo">Dor no corpo</label>
        </br>

        <input type="checkbox" id="dorgarganta" name="dor_garganta">
        <label for="dorgarganta">Tosse seca</label>
        </br>

        <input type="checkbox" id="diarreia" name="diarreia">
        <label for="diarreia">Cansaço</label>
        </br>

        <input type="checkbox" id="nauseav" name="dificuldade_respirar">
        <label for="nauseav">Dificuldade para respirar</label>
        </br>
           
        </br>
        <label for="mensagem" class="destaque">Mensagem (Caso esteja com algum sintoma que não se encontra neste formulário informe abaixo):</label></br>
        <textarea id="mensagem" name="mensagem_sintomas" placeholder="Digite aqui os sintomas"></textarea>

    </div>
    </br>

    <div>
        <?php echo "TESTE: " . $data_sintomas ?>
        <h4 class="destaque">Quando os sintomas começaram?</h4>
        <label for="data" class="destaque">Data:</label>
        <input type="date" id="data_sintomas" name="data_sintomas" value="<?php echo isset($data_sintomas) ? date($data_sintomas) : date("Y-m-d") ?>"> 
    </div>
    </br>

    <div>
        <input type="checkbox" id="contato" name="cont" value="contato">
        <label for="contato">Tive contato com pessoas com suspeita ou com confirmação de COVID-19 nos últimos 14 dias.</label>
    </div>
    </br>
    </br>

    <div class="button">
        <button type="submit">Enviar Formulário</button>
        <a href="formulario.html"></a>
    </div>

</form>

</body>
</html>