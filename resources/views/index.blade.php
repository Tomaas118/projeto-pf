<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Baixas24</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="text-center">

    <div class="help-button">
        <a href="{{ asset('manual.pdf') }}" target="_blank" class="btn btn-info" title="Manual de Instruções">?</a>
    </div>

    <div class="container">
        <img class="img-top img-fluid" src="Imagens/SNS24.png" alt="SNS 24"><br>
        <h3 class="mt-3">Qual é o tipo de conta que vai utilizar?</h3>

        <div class="row justify-content-center dis-top">
            <div class="col-md-4 text-center">
                <div class="img-container" onclick="redirectToPage('/Login-Medico')">
                    <img src="{{ asset('Imagens/medico.png') }}" class="img-resp" alt="Medico">
                    <h4 class="mt-1">Medico</h4>
                </div>
            </div>
            <div class="col-md-4 text-center">
                <div class="img-container" onclick="redirectToPage('/Login-Paciente')">
                    <img src="{{ asset('Imagens/paciente.png') }}" class="img-resp" alt="Paciente">
                    <h4 class="mt-1">Paciente</h4>
                </div>
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
