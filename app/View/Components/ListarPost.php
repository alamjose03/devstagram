<?php
// Obtener la informacion que se desea mostrar en el template
namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListarPost extends Component
{
    // Se crea la variable para que lo registre.
    public $posts;

    public function __construct($posts)
    {
        // Va ser la informacion que se le pasará a un componente.
        //
        $this->posts = $posts;
    }

    /**
     * Get the view / contents that represent the component.
     * Muestra una vista almacenada en resources/views/components/nombredecomponente.
     */
    public function render(): View|Closure|string
    {
        return view('components.listar-post');
    }
}
