<?php
require('../../db.php');
require_once('../CONTROLADOR/controladorCamionero.php');
session_start();

if (isset($_SESSION['username'])) {
    ($camionero = $camioneroModel->infoCamionero($_SESSION['username']));
} else {
    header("Location: ../../HOMEPAGE/VISTA/index.html");
    exit();
}

if (isset($_GET["id_recoleccion"])) {
    $id_recoleccion = $_GET["id_recoleccion"];
} else {
    header("Location: rutasCamionero.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es" id="htmlTag">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rutas</title>
    <link rel="stylesheet" href="../CSS/stylesCrudPaquetes.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../IMAGES/gorraBlanca.png" type="image/x-icon">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark p-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="rutasCamionero.php" id="logo"><img src="../../IMAGES/gorraBlanca.png"
                    height="40" alt="">MeshCap</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar"
                aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title text-center" id="offcanvasDarkNavbarLabel" data-i18n="menuTitle">Menú del Backoffice</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="rutasCamionero.php" data-i18n="home">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../VISTA/perfilCamionero.php" data-i18n="profile">Perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../VISTA/rutasCamionero.php" data-i18n="routes">Rutas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="../../HOMEPAGE/VISTA/index.html" data-i18n="logout">Cerrar sesión</a>
                        </li>
                        <li>
                            <p class="nav-link" aria-current="page" onclick="changeLanguage()" data-i18n="changeLanguage">Change language</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="mb-3" data-i18n="addPackage">Agregar paquete</h1>
                <form
                    action="../CONTROLADOR/controladorCamionero.php?agregarPaquete=agregarPaquete&id_recoleccion=<?php echo $id_recoleccion ?>"
                    method="POST">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label" data-i18n="department">Departamento:</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="departamento">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label" data-i18n="location">Localidad:</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="localidad">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label" data-i18n="street">Calle:</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="calle">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label" data-i18n="number">Numero:</label>
                        <input type="text" class="form-control" id="exampleInputPassword1" name="numero">
                    </div>
                    <div class="container mt-3"><button type="submit" class="btn btn-secondary" data-i18n="submit">Submit</button></div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc"
        crossorigin="anonymous"></script>
    <script>
        var textStrings = {
            es: {
                menuTitle: "Camionero",
                home: "Inicio",
                profile: "Perfil",
                routes: "Rutas",
                logout: "Cerrar sesión",
                changeLanguage: "Change language",
                addPackage: "Agregar paquete",
                department: "Departamento:",
                location: "Localidad:",
                street: "Calle:",
                number: "Numero:",
                submit: "Enviar"
            },
            en: {
                menuTitle: "Driver",
                home: "Home",
                profile: "Profile",
                routes: "Routes",
                logout: "Log out",
                changeLanguage: "Cambiar idioma",
                addPackage: "Add Package",
                department: "Department:",
                location: "Location:",
                street: "Street:",
                number: "Number:",
                submit: "Submit"
            }
        };

        function changeLanguage() {
            var htmlTag = document.getElementById('htmlTag');
            var language = htmlTag.getAttribute('lang');
            if (language === 'en') {
                htmlTag.setAttribute('lang', 'es');
                updateText('es');
            } else {
                htmlTag.setAttribute('lang', 'en');
                updateText('en');
            }
        }

        function updateText(language) {
            var elements = document.querySelectorAll('[data-i18n]');
            elements.forEach(function (element) {
                var key = element.getAttribute('data-i18n');
                if (textStrings[language][key]) {
                    element.innerText = textStrings[language][key];
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            updateText('es');
        });
    </script>
</body>

</html>
