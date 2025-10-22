<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CartaPoderController extends Controller
{
    public function generarCarta($id)
    {
        $user = User::findOrFail($id);

        // Datos para el QR
        $qrData = "Carta poder de: {$user->name} - Email: {$user->email}";
        $qr = base64_encode(QrCode::format('png')->size(150)->generate($qrData));

        // Generar PDF con la vista Blade
        $pdf = Pdf::loadView('pdf.carta_poder', compact('user', 'qr'));

        // Descargar PDF
        return $pdf->download("CartaPoder_{$user->name}.pdf");
    }
}
