<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Writer;

class CartaPoderController extends Controller
{
    public function generar($id)
    {
        // Cargar el usuario con su dispositivo (si tiene)
        $user = User::with('dispositivo')->findOrFail($id);

        // Generar QR como SVG (evita usar Imagick/GD)
        $renderer = new ImageRenderer(
            new RendererStyle(200),
            new SvgImageBackEnd()
        );

        $writer = new Writer($renderer);

        // Texto que queremos codificar en el QR (ajústalo si lo deseas)
        $qrText = "Carta Poder - Usuario ID: {$user->id} | Nombre: {$user->name}";

        // Genera el SVG (string)
        $qrSvg = $writer->writeString($qrText);

        // Pasamos el SVG crudo a la vista. En la vista lo insertaremos con {!! $qrSvg !!}
        $pdf = Pdf::loadView('pdf.carta_poder', [
            'user' => $user,
            'qrSvg' => $qrSvg,
        ]);

        // Descargar automáticamente
        $safeName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $user->name);
        return $pdf->download("Carta_Poder_{$safeName}.pdf");
    }
}
