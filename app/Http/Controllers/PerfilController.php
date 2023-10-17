<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('perfil.index');
    }
    public function store(Request $request)
    {
        // Modificar el Request
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter,editar-perfil'],
        ]);
        if ($request->imagen) {
            $imagen = $request->file('imagen');

            // Obtener la imagen y por cada uno crear un id unico
            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            // Intervention image
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);

            //Obtener el path de la imagen
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;

            // Guardar la imagen en el servidor y se le da el path donde se desea guardar
            $imagenServidor->save($imagenPath);
        }

        // Guardar los cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $usuario->save();

        //Redireccionar
        return redirect()->route('posts.index', $usuario->username);
    }
}
