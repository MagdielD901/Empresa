<?php

namespace App\Http\Controllers;

use App\Models\Dispositivo;
use Illuminate\Http\Request;

class DispositivoController extends Controller
{
    // ✅ Mostrar todos los dispositivos
    public function index()
    {
        $dispositivos = Dispositivo::with('usuario')->get();
        // Coincide con tu vista actual: resources/views/admin/device.blade.php
        return view('admin.devices', compact('dispositivos'));
    }

    // ✅ Guardar un nuevo dispositivo
    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string|max:50',
            'marca' => 'required|string|max:100',
            'modelo' => 'required|string|max:100',
            'numero_serie' => 'required|string|max:100|unique:dispositivos,numero_serie',
            'estado' => 'required|string|max:50',
        ]);

        Dispositivo::create($request->all());

        return redirect()->route('dispositivos.index')
            ->with('success', 'Dispositivo agregado correctamente.');
    }

    // ✅ Mostrar formulario (o modal) para editar un dispositivo
    public function edit($id)
    {
        $dispositivo = Dispositivo::findOrFail($id);
        // Si usarás el mismo modal para editar, puedes devolver los datos en JSON (Ajax)
        return response()->json($dispositivo);
    }

    // ✅ Actualizar dispositivo
    public function update(Request $request, $id)
    {
        $dispositivo = Dispositivo::findOrFail($id);

        $request->validate([
            'tipo' => 'required|string|max:50',
            'marca' => 'required|string|max:100',
            'modelo' => 'required|string|max:100',
            'numero_serie' => 'required|string|max:100|unique:dispositivos,numero_serie,' . $dispositivo->id,
            'estado' => 'required|string|max:50',
        ]);

        $dispositivo->update($request->all());

        return redirect()->route('dispositivos.index')
            ->with('success', 'Dispositivo actualizado correctamente.');
    }

    // ✅ Eliminar dispositivo
    public function destroy($id)
    {
        $dispositivo = Dispositivo::findOrFail($id);
        $dispositivo->delete();

        return redirect()->route('dispositivos.index')
            ->with('success', 'Dispositivo eliminado correctamente.');
    }

    public function asignar(Request $request)
{
    $request->validate([
        'usuario_id' => 'required|exists:users,id',
        'dispositivo_id' => 'required|exists:dispositivos,id',
    ]);

    $dispositivo = Dispositivo::findOrFail($request->dispositivo_id);
    $dispositivo->usuario_id = $request->usuario_id;
    $dispositivo->estado = 'Asignado';
    $dispositivo->save();

    return redirect()->back()->with('success', 'Dispositivo asignado correctamente.');
}

}
