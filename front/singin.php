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
            <img src="https://images.unsplash.com/photo-1698853983454-7e819026af6c?q=80&w=2160&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="">
        </div>
        <div class="div-2">
                <h1 class="w-100">FinanceTracker</h1>
                <form id="singin">
                <label class="mt-4" for="name">Introduzca su nombre</label>
                <input class="form-control" type="name" name="name" id="name">
                <label class="mt-4" for="prep">Introduzca su presupuesto mensual</label>
                <input class="form-control" type="number" name="prep" id="prep">
                <label class="mt-4" for="email">Introduzca su correo electrónico</label>
                <input class="form-control" type="email" name="email" id="email">
                <label class="mt-4" for="pass">Introduzca su contraseña</label>
                <input class="form-control" type="password" name="pass" id="pass">
                <button type="button" class="mt-5 btn btn-primary" onclick="singin()">Iniciar Sesión</button>
            </form>
            <p class="text-left mt-2 register" onclick="login()">Ya tienes una cuenta? Inicia sesión aqui!</p>

        </div>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script type="text/javascript" src="./js/singin.js"></script>
<script type="text/javascript" src="./js/main.js"></script>

</html>