<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!-- Meta tags Obrigatórias -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Formulário de Monitoramento de Saúde - Covid 19</title>

        <link rel="stylesheet" href="../styles/style_form.css">

		<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script src="../res/jquery.mask.min.js"></script>
       
        <script type="text/javascript">
            $(document).ready(function(){
            $("#cpf").mask("999.999.999-99");
        });
    </script>

    </head>

<body>
    <h1 id="title">FORMULÁRIO GRUPO DE RISCO</h1>


    <form method=post name="form" method="post" action="">

    <script>
        function genero(obj) {
            const checkGravidez = document.getElementById('gravidez');

            if(obj.value === 'm') {
                checkGravidez.disabled = true;
                checkGravidez.checked = false;
            } else
                checkGravidez.disabled = false;
        }
    </script>

    <div>        
        <h4 class="destaque">Identificação Grupo de Risco</h4></br>

        <strong for="idade">Idade</strong>
        <input type="number" id="idade" name="idade" min="0" max="100">
        </br></br>

        <strong>Sexo</strong></br>

        <input type="radio" id="fem" name="sexo" value="f" onclick="genero(this)">
        <label for="fem">Feminino</label>
        </br>

        <input type="radio" id="masc" name="sexo" value="m" onclick="genero(this)">
        <label for="masc">Masculino</label>
        </br></br>

        <input type="checkbox" id="gravidez" name="gravidez">
        <label for="gravidez">Gestante ou Puérpera</label>
        </br></br>

        <strong>Quem faz parte do grupo de risco do Coronavírus?</strong>
        <p>São considerados grupo de risco para agravamento da COVID-19 os portadores de doenças crônicas, como diabetes e hipertensão, 
            asma, doença pulmonar obstrutiva crônica, e indivíduos fumantes (que fazem uso de tabaco incluindo narguilé).</p>

        <strong>Fonte: </strong><a target="_blank" href="https://aps.bvs.br/aps/quais-sao-os-grupos-de-risco-para-agravamento-da-covid-19/">aps.bvs.br</a>
        </br></br>

        <input type="checkbox" id="grupo_risco" name="grupo_risco">        
        <label for="fem">Declaro que sou portador de alguma das doenças descritas acima.</label></br>        
       
    </div>
    </br>
    
    <div class="button">
        <button type="submit">Salvar</button>
        <a href="formulario.html"></a>
    </div>

 

</form>

</body>
</html>