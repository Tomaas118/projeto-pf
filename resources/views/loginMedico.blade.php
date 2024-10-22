<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #FAFAFA; /* Cor de fundo desejada */
        }
        .img-top {
          margin-top: 5%; /* Espaço acima da imagem principal */
          max-width: 100%; /* Tornar a imagem responsiva */
          height: auto; /* Manter a proporção */
          max-height: 130px;
        }
        .dis-top {
            margin-top: 6%;
        }
        .img-resp {
            width: 100%; /* Faz a imagem ocupar todo o espaço do contêiner */
            max-width: 512px; /* Limite máximo da largura */
            height: auto; /* Mantém a proporção */
            max-height: 200px;
            object-fit: contain; /* Evita distorções, ajusta a imagem dentro do espaço */
        }
        .img-container {
            text-align: center; /* Centraliza a imagem e o texto */
        }
    </style>

</head>
<body class="text-center">

    <div class="container">
        <!-- Imagem SNS24 -->
        <img class="img-top img-fluid" src="Imagens/SNS24.png" alt="SNS 24"><br>
        <h3 class="mt-3">Qual é o tipo de conta que vai utilizar?</h3>

        <!-- Imagens Médicos e Pacientes -->
        <div class="row justify-content-center dis-top">
            <div class="col-md-4 img-container" onclick="redirectToPage('/')">
                <img src="{{ asset('Imagens/medico.png') }}" class="img-resp" alt="Medico">
                <h4 class="mt-1">Medico</h4>
            </div>
            <div class="col-md-4 img-container" onclick="redirectToPage('/Login-Paciente')">
                <img src="Imagens/paciente.png" class="img-resp" alt="Paciente">
                <h4 class="mt-1">Paciente</h4>
            </div>
        </div>
    </div>

    <script>
        function redirectToPage(url) {
            window.location.href = url;
        }
    </script>
    <!-- JS do Bootstrap e dependências (opcional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
