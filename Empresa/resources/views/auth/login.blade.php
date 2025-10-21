<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Página de Login">
    <meta name="author" content="">

    <title>Login Premium</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Iconos de FontAwesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;700&display=swap" rel="stylesheet">

    <style>
        /* Fondo degradado */
        body {
            background: linear-gradient(135deg, #ff6f00, #ff8c00);
            font-family: 'Nunito', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Caja de login más grande y centrada */
        .login-card {
            border-radius: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            background-color: white;
            padding: 2rem;
            width: 100%;
            max-width: 500px; /* Mayor tamaño de la tarjeta */
            margin: 0 auto;
        }

        /* Cabecera */
        .login-card-header {
            text-align: center;
            background-color: #ff6f00;
            color: white;
            border-radius: 1.5rem 1.5rem 0 0;
            padding: 1.5rem 0;
            font-weight: bold;
            font-size: 1.7rem; /* Título más grande */
        }

        /* Cuerpo de la tarjeta */
        .login-card-body {
            padding: 2rem;
        }

        /* Input de texto */
        .form-control {
            border-radius: 25px;
            border-color: #ddd;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #ff6f00;
            box-shadow: 0 0 8px rgba(255, 111, 0, 0.7);
        }

        /* Botón de login */
        .btn-login {
            background-color: #ff6f00;
            border-radius: 25px;
            padding: 12px;
            width: 100%;
            border: none;
            color: white;
            font-size: 18px;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            background-color: #e65c00;
            transform: translateY(-3px);
        }

        /* Enlaces */
        .forgot-password-link, .register-link {
            color: #ff6f00;
            text-decoration: none;
            font-weight: bold;
        }

        .forgot-password-link:hover, .register-link:hover {
            text-decoration: underline;
        }

        /* Botones de redes sociales */
        .social-btns a {
            padding: 12px;
            border-radius: 25px;
            text-align: center;
            width: 100%;
            margin-top: 10px;
            font-size: 16px;
        }

        .btn-google {
            background-color: #db4437;
            color: white;
        }

        .btn-facebook {
            background-color: #4267b2;
            color: white;
        }

        .social-btns .btn:hover {
            transform: translateY(-3px);
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="login-card">
            <div class="login-card-header">
                <h3>¡Bienvenido de nuevo!</h3>
            </div>
            <div class="login-card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Campo de email -->
                    <div class="form-group mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Correo electrónico" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Campo de contraseña -->
                    <div class="form-group mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Contraseña" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Recordar contraseña -->
                    <div class="form-group form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Recuérdame</label>
                    </div>

                    <!-- Botón de inicio de sesión -->
                    <button type="submit" class="btn-login mb-3">Iniciar sesión</button>

                    <!-- Enlaces de ayuda -->
                    <div class="d-flex justify-content-between mb-3">
                        <a href="{{ route('password.request') }}" class="forgot-password-link">¿Olvidaste tu contraseña?</a>
                        <a href="{{ route('register') }}" class="register-link">Crear cuenta</a>
                    </div>

                    <hr>

                    <!-- Botones de redes sociales -->
                    <div class="social-btns">
                        <a href="#" class="btn btn-google"><i class="fab fa-google"></i> Iniciar sesión con Google</a>
                        <a href="#" class="btn btn-facebook"><i class="fab fa-facebook-f"></i> Iniciar sesión con Facebook</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS y Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
