<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title> <!-- O título será definido em cada página -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .icon-pequeno {
            font-size: 20px; 
            position: absolute;
            top: 20px;
            left: 20px;
            color: #333;
            background-color: #f0f0f0; 
            border-radius: 50%; 
            padding: 8px; 
            border: 2px solid #333;
        }

        .form-container {
            background-color: #fff;
            padding: 20px; 
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row min-vh-100">
            <div class="col-md-6 d-flex justify-content-center align-items-center position-relative bg-light">
                <i class="fas fa-arrow-left icon-pequeno" onclick="redirectToPage('/')"></i>
                <img src="{{ asset('Imagens/SNS24.png') }}" class="img-fluid" alt="Imagem Central">
            </div>

            <div class="col-md-6 d-flex justify-content-center align-items-center bg-light">
                <div class="form-container w-75">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script>
        function redirectToPage(url) {
            window.location.href = url;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
