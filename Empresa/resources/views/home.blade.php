<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,800" rel="stylesheet">

    {{-- Font Awesome --}}
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background: #f6f5f7;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: 'Montserrat', sans-serif;
            height: 100vh;
            margin: -20px 0 50px;
        }

        h1 {
            font-weight: bold;
            margin: 0;
        }

        h2 {
            text-align: center;
        }

        p {
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
        }

        span {
            font-size: 12px;
        }

        a {
            color: #333;
            font-size: 14px;
            text-decoration: none;
            margin: 15px 0;
        }

        button {
            border-radius: 20px;
            border: 1px solid #FF4B2B;
            background-color: #FF4B2B;
            color: #FFFFFF;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
        }

        button:hover {
            transform: scale(1.05);
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25),
                        0 10px 10px rgba(0,0,0,0.22);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 480px;
            text-align: center;
            padding: 50px;
        }

        .welcome {
            color: #FF4B2B;
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .user-name {
            font-size: 1.2rem;
            color: #555;
        }

        .logout-btn {
            margin-top: 20px;
            background-color: #FF4B2B;
            color: white;
            border: none;
            padding: 12px 45px;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #ff3a1f;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <h2>Bienvenido al Panel</h2>

    <div class="container">
        <div class="welcome">
            ¡Hola, {{ Auth::user()->name }}! 👋
        </div>

        <p class="user-name">Has iniciado sesión correctamente.</p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">Cerrar sesión</button>
        </form>
    </div>

    <footer>
        <p>
            Creado con ❤️ por <a target="_blank" href="https://florin-pop.com">Nexure</a> —
            Adaptado para Nexure.
        </p>
    </footer>
</body>
</html>
