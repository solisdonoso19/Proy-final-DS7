<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gastos APP</title>
    <link rel="stylesheet" href="./styles/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <section class="container-1 gap-4">
        <div class="div-1">
            <img src="https://images.unsplash.com/photo-1698853956230-6cf4027c05c6?q=80&w=2700&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="">
        </div>
        <div class="div-2">
            <h1 class="w-100 align-center">FinanceTracker</h1>
            <form id="auth">
                <label class="mt-4" for="email">Introduzca su correo electrónico</label>
                <input class="form-control" type="email" name="email" id="email">
                <label class="mt-4" for="pass">Introduzca su contraseña</label>
                <input class="form-control" type="password" name="pass" id="pass">
                <button class="mt-5 btn btn-primary" type="button" onclick="auth()">Iniciar Sesión</button>
            </form>
            <p class="text-left mt-2 register" onclick="register()">No tienes una cuenta? Crea una aqui!</p>
        </div>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script type="text/javascript" src="./js/auth.js"></script>
<script type="text/javascript" src="./js/main.js"></script>

</html>