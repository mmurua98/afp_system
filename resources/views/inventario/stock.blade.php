@extends('adminlte::page')

<link rel="stylesheet" href="{{ asset('css/stock.css') }}" />

@section('title', 'Dashboard')
@section('content_header')
    <h1>Stock</h1>
@endsection
@section('content')

    <div class="card">
        <div class="card-body">
            <table id="tblStock" class="table table-hover">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Product</th>
                        <th style="text-align:center">Minimum</th>
                        <th style="text-align:center">Maximum</th>
                        <th style="text-align:center">Stock</th>
                    </tr>
                </thead>
                <tbody>            
                    {{-- @foreach ($stocks as $stock)
                        <tr>
                            <td>{{$stock->code}}</td>
                            <td>{{$stock->name}}</td>
                            <td class="bg-danger" style="text-align:center">{{$stock->minimum}}</td>
                            <td class="bg-success" style="text-align:center">{{$stock->maximum}}</td>
                            <td class="bg-light" style="text-align:center">{{$stock->stock}}</td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
@stop

<script>
    document.addEventListener("DOMContentLoaded", function(event){

        let productos =  {!! json_encode($stocks) !!};

        productos.forEach(element => {
            let porcentaje = (element.stock /element.maximum) * 100
            let  = '';
            
            let tr = ``
                tr +=`<tr>`
                tr +=`  <td>${element.code}</td>`
                tr +=`  <td>${element.name}</td>`
                tr +=`  <td  style="text-align:center">${element.minimum}</td>`
                tr +=`  <td  style="text-align:center">${element.maximum}</td>`
                
            if(porcentaje >= 85){
                clase = 'green'
            }

            if(porcentaje >= 60){
                clase = 'yellow'
            }

            if(porcentaje >= 45){
                clase = 'orange'
            }

            if(porcentaje < 45){
                clase = 'red'
            }

            tr +=`  <td class="${clase}"  style="text-align:center; color: white">${element.stock}</td>`
            tr += `</tr>`

            $('#tblStock tbody').append(tr);
        });

    })
</script>
