<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['nombre', 'costo'];

    public function facturaDetalles()
    {
        return $this->hasMany(FacturaDetalle::class);
    }
}
