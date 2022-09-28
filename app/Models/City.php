<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    /**
     * Atributos preenchivel
     *
     * @var array
     */
    protected $fillable = [
        'city_name', 'latitude', 'longitude',
    ];

    /**
     * Listar postos da cidade
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
