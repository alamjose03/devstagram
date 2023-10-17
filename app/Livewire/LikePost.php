<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    // En automatico esta disponible en la vista, no necesitas pasarlo a la vista manualmente.
    public $post;
    public $isLicked;
    public $likes;

    // funcion que se ejecuta automaticamente cuando se instancia like post
    //Verificamos si al entrar a la vista ya se le dio like al post por el user autenticado, si es asi se dibuja elcorazon rojo.
    public function mount($post)
    {
        $this->isLicked = $post->checkLike(auth()->user());
        // cuando se monte, se evaluan los likes y se almacenan en el valor de likes.
        $this->likes = $post->likes->count();
    }

    public function render()
    {
        return view('livewire.like-post');
    }

    // Este metodo se va ejecutar cuando al boton que tiene el evento "like" se le de un click.
    public function like()
    {
        if ($this->post->checkLike(auth()->user())) {
            $this->post->likes()->where('post_id', $this->post->id)->delete();
            $this->isLicked = false;
            // cuando se de click, se evaluan los likes y se almacenan en el valor de likes.
            $this->likes--;
        } else {
            $this->post->likes()->create(
                [
                    'user_id' => auth()->user()->id,
                ]
            );
            $this->isLicked = true;
            // cuando se de click, se evaluan los likes y se almacenan en el valor de likes.
            $this->likes++;
        }
    }
}
