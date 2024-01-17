@extends('layouts.appticket')

@section('etiqueta')
    @foreach ($rows as $item)
        <div class="card">
            <div class="card-head">
                
            </div>
            <div class="card-body">
                <b>{{$item->color}} Lote: {{$item->lote}} Paq.:{{$item->paquete}} Peso: {{ number_format($item->kilos,2 ) }} KG </b> <br />
                <img width="256px" src="{{ route('general.code2d', $item->lote . $item->paquete) }}" ><br />
                <label class="h3"><b> $ {{ number_format($item->costo,2) }} </b></label><br />
            </div>
            <div class="card-foot">
                
            </div>
        </div>
    @endforeach
@endsection