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
    <h1 id="title">MONITORAMENTO DE SAÚDE - COVID 19</h1>


    <form method=post name="form" method="post" action="">

    <div>
        </select>
        </br></br>

        <h4 class="destaque">Situação de Trabalho</h4>

        <input type="radio" id="tr" name="situacao" value="tr">
        <label for="tr">Trabalho Remoto</label>
        </br>

        <input type="radio" id="tp" name="situacao" value="tp">
        <label for="tp">Trabalho Presencial</label>       
        </br>
        
        <input type="radio" id="tm" name="situacao" value="tm">
        <label for="tm">Trabalho Misto</label>
        </br></br>

        <h4 class="destaque">Sintomas</h4>

        <input type="checkbox" id="nsintomas" value="nsintomas">
        <label for="nsintomas">Não apresento sintomas</label>
        </br>

        <input type="checkbox" id="febre" value="febre">
        <label for="febre">Febre</label>
        </br>

        <input type="checkbox" id="dorcorpo" value="dorcorpo">
        <label for="dorcorpo">Dor no corpo</label>
        </br>

        <input type="checkbox" id="dorgarganta" value="dorgarganta">
        <label for="dorgarganta">Tosse seca</label>
        </br>

        <input type="checkbox" id="diarreia" value="diarreia">
        <label for="diarreia">Cansaço</label>
        </br>

        <input type="checkbox" id="nauseav" value="nauseav">
        <label for="nauseav">Dificuldade para respirar</label>
        </br>
           
        </br>
        <label for="mensagem" class="destaque">Mensagem (Caso esteja com algum sintoma que não se encontra neste formulário informe abaixo):</label></br>
        <textarea id="mensagem" placeholder="Digite aqui os sintomas"></textarea>

    </div>
    </br>

    <div>
        <h4 class="destaque">Quando os sintomas começaram?</h4>
        <label for="data" class="destaque">Data:</label>
        <input type="date" id=data>

        <label for="hora" class="destaque hora">Hora:</label>
        <input type="time" id="hora" min="00:00" max="24:59"> 
        </br>      
 
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