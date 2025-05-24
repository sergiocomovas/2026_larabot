<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PruebaController extends Controller
{
    // GET /pruebas
    public function index()
    {
        $pruebas = DB::select('SELECT * FROM pruebas');
        // $pruebas = DB::table('pruebas')->get();

        return response()->json($pruebas, 200);
    }

    // GET /pruebas/{id}
    public function show($id)
    {
        $prueba = DB::select('SELECT * FROM pruebas WHERE id = ?', [$id]);
        // $prueba = DB::table('pruebas')->where('id', $id)->first();

        if (!$prueba) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        return response()->json($prueba[0], 200);
    }

    // POST /pruebas
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable',
        ]);

        DB::insert('INSERT INTO pruebas (nombre, descripcion, created_at, updated_at) VALUES (?, ?, ?, ?)', [
            $request->nombre,
            $request->descripcion,
            now(),
            now(),
        ]);
        // DB::table('pruebas')->insert([...]);

        return response()->json(['message' => 'Prueba creada correctamente'], 201);
    }

    // PUT/PATCH /pruebas/{id}
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable',
        ]);

        $affected = DB::update('UPDATE pruebas SET nombre = ?, descripcion = ?, updated_at = ? WHERE id = ?', [
            $request->nombre,
            $request->descripcion,
            now(),
            $id,
        ]);
        // $affected = DB::table('pruebas')->where('id', $id)->update([...]);

        if ($affected === 0) {
            return response()->json(['message' => 'No encontrado o sin cambios'], 404);
        }

        return response()->json(['message' => 'Prueba actualizada correctamente'], 200);
    }

    // DELETE /pruebas/{id}
    public function destroy($id)
    {
        $deleted = DB::delete('DELETE FROM pruebas WHERE id = ?', [$id]);
        // $deleted = DB::table('pruebas')->where('id', $id)->delete();

        if ($deleted === 0) {
            return response()->json(['message' => 'No encontrado'], 404);
        }

        return response()->json(['message' => 'Prueba eliminada correctamente'], 200);
    }
}
