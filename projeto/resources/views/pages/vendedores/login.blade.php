<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <title>Login - Sistema de Vendas</title>
</head>
<body>

    <div class="container">
        <div class="mt-5 mb-4 d-flex flex-column justify-content-center">
            <h3>Login</h3>

            <form action="{{ route('vendedores.index') }}" method="POST">
                <div class="row mb-3">
                    <label for="inputText3" class="col-sm-2 col-form-label">CPF</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" name="cpf" id="inputText3">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                    <input type="password" class="form-control" name="senha" id="inputPassword3">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>

</body>
</html>
