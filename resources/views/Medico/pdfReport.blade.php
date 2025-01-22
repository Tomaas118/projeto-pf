<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Baixas Médicas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: left;
            margin-bottom: 20px;
        }
        .content {
            margin: 20px;
        }
        .flex-container {
            display: flex;
            justify-content: left;
            margin-bottom: 20px;
        }
        .flex-item {
            flex: 1;
            margin: 10px;
            text-align: left;
        }
        .bottom-section {
            margin-top: 20px;
        }
        .left-align {
            text-align: left;
        }
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Relatório de Baixas Médicas</h1>
    </div>
    <div class="content">
        <div class="flex-container">
            <div class="flex-item">
                <h2>Informações Gerais</h2>
                <img src="{{ $generalChartUrl }}" alt="General Chart">
            </div>
            <div class="flex-item">
                <h2>Diagnósticos</h2>
                <img src="{{ $diagnosticChartUrl }}" alt="Diagnostic Chart">
            </div>
        </div>
        <div class="bottom-section">
            <div class="section">
                <h2>Idade dos Pacientes</h2>
                <img src="{{ $ageChartUrl }}" alt="Age Chart">
            </div>
            <div class="section left-align">
                <h2>Estatísticas</h2>
                <p>Tempo Médio das Baixas: {{ $averageTime }} dias</p>
            </div>
        </div>
    </div>
</body>
</html>