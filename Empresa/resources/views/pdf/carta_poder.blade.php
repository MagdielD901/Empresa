<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carta Poder</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; margin: 40px; }
        h1 { text-align: center; }
        .info { margin-bottom: 20px; }
        .dispositivo { border: 1px solid #000; padding: 10px; margin-bottom: 10px; }
        .qr { text-align: center; margin-top: 30px; }
    </style>
</head>
<body>
    <h1>CARTA PODER</h1>

    <div class="info">
        <strong>Nombre:</strong> {{ $user->name }} <br>
        <strong>Correo:</strong> {{ $user->email }} <br>
        <strong>Rol:</strong> {{ $user->role }} <br>
        <strong>Departamento:</strong> {{ $user->department ?? '—' }} <br>
        <strong>Estado:</strong> {{ $user->active ? 'Activo' : 'Inactivo' }}
    </div>

    <h3>Dispositivos Asignados:</h3>
    @if($user->dispositivo)
        <div class="dispositivo">
            <strong>Tipo:</strong> {{ $user->dispositivo->tipo }} <br>
            <strong>Marca:</strong> {{ $user->dispositivo->marca }} <br>
            <strong>Modelo:</strong> {{ $user->dispositivo->modelo }} <br>
            <strong>N° Serie:</strong> {{ $user->dispositivo->numero_serie }}
        </div>
    @else
        <p>Este usuario no tiene dispositivos asignados.</p>
    @endif

    <div class="qr">
        <p><strong>Verificación QR</strong></p>
        {{-- ⚡️ Insertamos el SVG directamente --}}
        {!! $qrSvg !!}
    </div>
</body>
</html>
