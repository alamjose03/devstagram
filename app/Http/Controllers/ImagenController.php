<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        $imagen = $request->file('file');

        // Obtener la imagen y por cada uno crear un id unico
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        // Intervention image
        $imagenServidor = Image::make($imagen);
        $imagenServidor->fit(1000, 1000);

        //Obtener el path de la imagen
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;

        // Guardar la imagen en el servidor y se le da el path donde se desea guardar
        $imagenServidor->save($imagenPath);
        return response()->json(['imagen' => $nombreImagen]);
    }
}
