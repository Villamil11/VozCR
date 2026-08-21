<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>VozCR | Iniciar sesión</title>

    <link rel="stylesheet" href="../CSS/Style.css">
</head>

<body class="login-body">

    <div class="login-container">

        <div class="login-header">
            <div class="login-icon">🗣️</div>

            <h1>VozCR</h1>

            <p>
                Plataforma de Transparencia y Reporte Ciudadano
            </p>
        </div>

        <div class="login-form">

            <h2>Iniciar sesión</h2>

            <p class="login-description">
                Ingresa tus datos para acceder a la plataforma.
            </p>

            <form action="validar_login.php" method="POST">

                <div class="form-group">

                    <label for="correo">
                        Correo electrónico
                    </label>

                    <input
                        type="email"
                        id="correo"
                        name="correo"
                        placeholder="ejemplo@correo.com"
                        required
                    >

                </div>

                <div class="form-group">

                    <label for="password">
                        Contraseña
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Ingresa tu contraseña"
                        required
                    >

                </div>

                <button type="submit" class="login-button">
                    Iniciar sesión
                </button>

            </form>

<div class="login-footer">

    <p>
        ¿Solo quieres consultar la plataforma?
    </p>

    <a href="../Index.php" class="guest-button">
        Continuar sin iniciar sesión
    </a>

    <div class="login-divider"></div>

    <a href="../Index.php">
        Volver al inicio
    </a>

</div>

        </div>

    </div>

</body>

</html>