<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carta Poder - {{ $user->name }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        h1 { text-align: center; }
        .qr { text-align: center; margin-top: 40px; }
    </style>
</head>
<body>
    <h1>CARTA PODER</h1>

    <p>Yo, <strong>{{ $user->name }}</strong>, con correo <strong>{{ $user->email }}</strong>,
    por medio de la presente otorgo poder amplio, cumplido y bastante a quien corresponda
    para realizar gestiones necesarias relacionadas con mi puesto en la empresa.</p>

    <p>Departamento: {{ $user->department ?? 'No especificado' }}</p>
    <p>Rol: {{ ucfirst($user->role) }}</p>
    <p>Fecha de ingreso: {{ $user->hired_at ? \Carbon\Carbon::parse($user->hired_at)->format('d/m/Y') : '—' }}</p>

    <div class="qr">
        <p>Código QR de validación:</p>
        <img src="data:image/png;base64,{{ $qr }}">
    </div>

    <p style="margin-top: 60px;">Atentamente,</p>
    <p><strong>{{ $user->name }}</strong></p>
</body>
</html>
