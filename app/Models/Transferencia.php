<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transferencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'idTransacción',
        'requerimientoFuente',
        'nombreUsuario',
        'celularEmisor',
        'celularDestinatario',
        'indentificaiconCliente',
        'claseServicio',
        'subServicio',
        'transferenciaFechaHora',
        'montoRequerimiento',
        'montoCredito',
        'bono',
        'horariosProcesamiento'
    ];
}