@extends('adminlte::page')

@section('title', 'AFP - Historial Orders')
@section('content_header')
    <h1>Historial de Ordenes</h1>
@endsection
@section('content')

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>P.O #</th>
                        <th>Date</th>
                        <th>Supplier</th>
                        <th>Total</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{$order->po_number}}</td>
                            <td>{{$order->date}}</td>
                            <td>{{$order->supplier->company}}</td>
                            <td>${{$order->total}}</td>
                            <td>
                                {{-- <a href="{{route('descargarPDF')}}" target="_blank">Imprimir</a> --}}
                                {{-- <a href="{{route('descargarPDF', $order->id)}}" target="_blank" class="btn btn-primary">Imprimir</a> --}}
                                <a href="{{route('descargarPDF', $order->id)}}" target="_blank" class="btn btn-primary">Imprimir</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$orders->links()}}
        </div>
    </div>

@stop

