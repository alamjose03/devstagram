<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

    public function comentarios()
    {
        // Un post va a tener multiples comentarios
        return $this->hasMany(Comentario::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user)
    {
        // Se posiciona en la tabla de likes mediante la relacion y se verifica
        // si la tabla contiene el user id, y le pasamos al usuario id que deseamos verificar si ya lo contiene
        return $this->likes->contains('user_id', $user->id);
    }
}
