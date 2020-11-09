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
                        <th>Status</th>
                        <th>Date</th>
                        <th>Supplier</th>
                        <th>Total</th>
                        <th class="text-center">Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{$order->po_number}}</td>
                            <td>{{$order->status}}</td>
                            <td>{{$order->date}}</td>
                            <td>{{$order->company}}</td>
                            <td>${{$order->total}}</td>
                            @if ($order->status == 'En proceso')
                                <td class="text-center">
                                    <a href="{{route('descargarPDF', $order->id)}}" target="_blank" class="btn btn-primary">Imprimir</a>
                                    <a href="{{route('order.edit', $order->id)}}" class="btn btn-warning">Editar</a>
                                </td>
                            @else
                                <td class="text-center">
                                    <a href="{{route('descargarPDF', $order->id)}}" target="_blank" class="btn btn-primary">Imprimir</a>
                                    <a href="{{route('order.edit', $order->id)}}" class="btn btn-light">Ver</a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$orders->links()}}
        </div>
    </div>

@stop

