<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Writer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
class CartaPoderController extends Controller
{
    public function generar($id)
    {
        // Cargar el usuario con su dispositivo (si tiene)
        $user = User::with('dispositivo')->findOrFail($id);

        // Generar QR como SVG (evita usar Imagick/GD)
      
      

        // Texto que queremos codificar en el QR (ajústalo si lo deseas)
        $qrText = "Carta Poder - Usuario ID: {$user->id} | Nombre: {$user->name}";
        $path = public_path('qrcode/'.time().'.png');
        QrCode::size(300)->generate($qrText,$path);
        $qr= QrCode::size(300)->generate('A simple example of QR code'); 
       
        // Genera el SVG (string)
$codigo=base64_encode($qr);
        // Pasamos el SVG crudo a la vista. En la vista lo insertaremos con {!! $qrSvg !!}
        $pdf = Pdf::loadView('pdf.carta_poder', [
            'user' => $user,
            'qr' => $codigo,
        ]);
        

        // Descargar automáticamente
        $safeName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $user->name);
        return $pdf->download("Carta_Poder_{$safeName}.pdf");
      
        return view('pdf.carta_poder')
        ->with('user',$user)
        ->with('qr',$codigo);
    }
}
