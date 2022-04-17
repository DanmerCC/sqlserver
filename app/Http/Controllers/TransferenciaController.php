<?php

namespace App\Http\Controllers;

use App\Imports\TransferenciasImport;
use App\Models\Transferencia;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TransferenciaController extends Controller
{

    function response($status, $data, $mensaje)
    {
        return [
            'data' => $data,
            'success' => $status,
            'clientMensaje' => $mensaje
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->response(true, Transferencia::all(), "Correctamente cargado");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function uploadCsv()
    {
        try {
            $file = $request->file('file');
            $file->storeAs('imports', 'excelprueba.xls');
            $collection = Excel::toCollection(new TransferenciasImport, 'imports/excelprueba.xls')->first();
            $import = new TransferenciasImport();
            $data = $collection->splice($collection->count() - 10);
            $models = $import->collection($data);
            $count = 0;
            $models->each(function (Transferencia $item) use (&$count) {
                if ($item->save()) {
                    $count++;
                }
            });
            return $this->response(true, $models, "Correctamente guardado " . $count);
        } catch (\Throwable $th) {
            return $this->response(false, null, "un error al cargar los datos");
        }
    }
}