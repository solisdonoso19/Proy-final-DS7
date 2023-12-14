<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php
    if (isset($_SESSION['user'])) {
        $user = json_decode($_SESSION['user'], true);
        $user = $user['user'];
    } else {
        header("Location: index.php");
        exit();
    }
    ?>
    <header class="pt-4 pb-4 d-flex justify-content-between">
        <h2>FinanceTracker</h2>
        <form id="logout">
            <button class="btn btn-danger" type="button" onclick="logout()"> Cerrar Sesión</button>
        </form>
    </header>
    <div class="mt-3 container justify-content-center categories-menu">
        <?php
        require_once('./class/categories.php');
        $categories = new Categories();
        $data = $categories->get();
        echo '<div onclick="getAll()"><p>Todo</p></div>';
        foreach ($data as $valor) {
            $categoryID = $valor['CategoriaID'];
            $categoryName = $valor['NombreCategoria'];
            echo '<div class="ps-2 pe-2 cat" onclick="getDataByCategory(' . $user['UsuarioID'] . ', ' . $categoryID . ')"><p>'  . $categoryName .  '</p></div>';
        }
        ?>
    </div>
    <div class="mt-5 container">
        <h3>Tabla de Gastos</h3>
        <div class="overflow-auto" style="height: 500px">
            <table class="mt-5 table table-striped">
                <thead>
                    <th></th>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Categoria</th>
                    <th>Descripcion</th>
                    <th>Cantidad</th>
                    <thead>
                        </th>
                    </thead>
                <tbody id='table-body'>

                    <?php
                    require_once('./class/gastos.php');
                    $gastos = new Gastos();
                    $data = $gastos->get($user['UsuarioID']);
                    $sum = $gastos->sum($user['UsuarioID']);
                    $data = $data['records'];
                    $s = '';
                    foreach ($data as $valor) {
                        $GastoID = $valor['GastoID'];
                        $UsuarioID = $valor['UsuarioID'];
                        $Fecha = $valor['Fecha'];
                        $Cantidad = $valor['Cantidad'];
                        $Descripcion = $valor['Descripcion'];
                        $DescripcionMod = "'" . $valor['Descripcion'] . "'";
                        $CategoriaID = $valor['CategoriaID'];
                        $NombreCategoria = $valor['NombreCategoria'];
                        $s = $s . '<tr>';
                        $s = $s . '<td onclick="put(' . $GastoID . ',' . $UsuarioID . ',' . $Fecha . ',' . $Cantidad . ',' . $DescripcionMod . ',' . $CategoriaID . ')" style="cursor: pointer;">✏️</td>';
                        $s = $s . '<td>' . $GastoID . '</td>';
                        $s = $s . '<td>' . $Fecha . '</td>';
                        $s = $s . '<td>' . $NombreCategoria . '</td>';
                        $s = $s . '<td>' . $Descripcion . '</td>';
                        $s = $s . '<td>' . $Cantidad . '</td>';
                        $s = $s . '<td onclick="deleteGasto(' . $GastoID . ')" style="cursor: pointer;">🗑️</td>';

                        $s = $s . '</tr>';
                    }
                    echo $s;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="container mt-5 d-flex justify-content-between">
        <?php
        if ($sum['sum'] > $user['PresupuestoMensual']) {
            $bg = 'bg-danger';
        } else {
            $bg = 'bg-success';
        }
        echo '<p class=" p-5 rounded bg-primary fs-3 text-white">Tu presupuesto mensual es de: ' . $user['PresupuestoMensual'] . '</p>';
        echo '<p class="p-5 rounded fs-3 text-white ' . $bg . '">Has gastado un total de: ' . $sum['sum'] . '</p>'
        ?>
    </div>
    <button class='btn-insert bg-primary' onclick="showInsert()">+</button>
    <dialog id="insert">
        <div>
            <div style='display:flex;justify-content: space-between;'>
                <p class="fs-3">Crear registro</p>
                <p onclick="closeForm()" style="cursor: pointer;"'>X
            </p>
            </div>
            <form id='postGasto'>
                    <label class="mt-3" for="fecha">Introduzca la fecha</label>
                    <input class="mt-3 form-control" type="date" name="fecha" id="fecha" placeholder="YYYY-MM-DD">
                    <label class="mt-3" for="cantidad">Introduzca la cantidad</label>
                    <input class="mt-3 form-control" type="number" name="cantidad" id="cantidad">
                    <label class="mt-3" for="descripcion">Introduzca la descripción del gasto</label>
                    <input class="mt-3 form-control" type="text" name="descripcion" id="descripcion">
                    <label class="mt-3" for="categoria">Seleccione una categoria</label>
                    <select class="form-select" name="categoria" id="categoria">
                        <option value="">Seleccionar...</option>
                        <?php
                        require_once('./class/categories.php');
                        $categories = new Categories();
                        $data = $categories->get();
                        foreach ($data as $valor) {
                            $CategoriaID = $valor['CategoriaID'];
                            $NombreCategoria = $valor['NombreCategoria'];
                            echo '<option value="' . $CategoriaID . '">' . $NombreCategoria . '</option>';
                        }
                        ?>
                    </select>
                    <?php
                    echo '<button type="button" class="btn btn-primary mt-3" onclick="postGasto(' . $user['UsuarioID'] . ')">Enviar</button>';
                    ?>
                    </form>
            </div>
    </dialog>

    <dialog id="putForm">
        <div>
            <div style='display:flex;justify-content: space-between;'>
                <p class="fs-3">Editar registro</p>
                <p onclick="closeForm()" style="cursor: pointer;"'>X
            </p>
            </div>
            <form id=' putForm'>
                    <label class="mt-3" for="fecha">Introduzca la fecha</label>
                    <input class="mt-3 form-control" type="date" name="fechaP" id="fechaP" placeholder="YYYY-MM-DD">
                    <label class="mt-3" for="cantidad">Introduzca la cantidad</label>
                    <input class="mt-3 form-control" type="number" name="cantidadP" id="cantidadP">
                    <label class="mt-3" for="descripcion">Introduzca la descripción del gasto</label>
                    <input class="mt-3 form-control" type="text" name="descripcionP" id="descripcionP">
                    <label class="mt-3" for="categoria">Seleccione una categoria</label>
                    <select class="form-select" name="categoriaP" id="categoriaP">
                        <option value="">Seleccionar...</option>
                        <?php
                        require_once('./class/categories.php');
                        $categories = new Categories();
                        $data = $categories->get();
                        foreach ($data as $valor) {
                            $CategoriaID = $valor['CategoriaID'];
                            $NombreCategoria = $valor['NombreCategoria'];
                            echo '<option value="' . $CategoriaID . '">' . $NombreCategoria . '</option>';
                        }
                        ?>
                    </select>
                    <?php
                    echo '<button type="button" class="btn btn-primary mt-3" onclick="sendPut(' . $user['UsuarioID'] . ')">Enviar</button>';
                    ?>
                    </form>
            </div>
    </dialog>
</body>
<script type="text/javascript" src="./js/get.js"></script>
<script type="text/javascript" src="./js/main.js"></script>
<script type="text/javascript" src="./js/post.js"></script>
<script type="text/javascript" src="./js/put.js"></script>
<script type="text/javascript" src="./js/delete.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>