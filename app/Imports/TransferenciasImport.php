<?php

namespace App\Imports;

use App\Models\Transferencia;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class TransferenciasImport implements ToCollection
{
    const INDEX_idTransacción = 2;
    const INDEX_requerimientoFuente = 3;
    const INDEX_nombreUsuario = 4;
    const INDEX_celularEmisor = 5;
    const INDEX_celularDestinatario = 6;
    const INDEX_indentificaiconCliente = 8;
    const INDEX_claseServicio = 9;
    const INDEX_subServicio = 10;
    const INDEX_transferenciaFechaHora = 11;
    const INDEX_montoRequerimiento = 12;
    const INDEX_montoCredito = 13;
    const INDEX_bono = 14;
    const INDEX_horariosProcesamiento = 15;

    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {

        return $collection->map(function ($row) {
            $newObject = new Transferencia([
                'idTransacción' => $row[TransferenciasImport::INDEX_idTransacción],
                'requerimientoFuente' => $row[TransferenciasImport::INDEX_requerimientoFuente],
                'nombreUsuario' => $row[TransferenciasImport::INDEX_nombreUsuario],
                'celularEmisor' => $row[TransferenciasImport::INDEX_celularEmisor],
                'celularDestinatario' => $row[TransferenciasImport::INDEX_celularDestinatario],
                'indentificaiconCliente' => $row[TransferenciasImport::INDEX_indentificaiconCliente],
                'claseServicio' => $row[TransferenciasImport::INDEX_claseServicio],
                'subServicio' => $row[TransferenciasImport::INDEX_subServicio],
                'transferenciaFechaHora' => $row[TransferenciasImport::INDEX_transferenciaFechaHora],
                'montoRequerimiento' => $row[TransferenciasImport::INDEX_montoRequerimiento],
                'montoCredito' => $row[TransferenciasImport::INDEX_montoCredito],
                'bono' => $row[TransferenciasImport::INDEX_bono],
                'horariosProcesamiento' => $row[TransferenciasImport::INDEX_horariosProcesamiento]
            ]);

            $newObject->key = md5($newObject->idTransacción . $newObject->claseServicio);

            return $newObject;
        });
    }
}