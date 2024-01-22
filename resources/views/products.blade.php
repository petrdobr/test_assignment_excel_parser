@extends('layouts.app')

@section('title', 'Upload Excel')

@section('content')
<h1>{{ __('Products') }}</h1>
<table>
<thead><tr>
<th>№</th>
<th>Фото</th>
    <th>Наименование</th>
    <th>Цена</th>
    <th>Скидка</th>
    <th>Описание</th>
    <th>Тип</th>
    <th>Внешний код</th>
    <th>Штрихкоды</th>
</tr>
</thead>
<tbody>
@foreach($products as $product)
<tr>
<td>   {{ $product['product_id'] }} </td>
<td> <img width="100" src="data:image/jpg;base64,{{ base64_encode($photos[$product->product_id]['photo']) }}">
</td>
    <td>   {{ $product['name'] }} </td>
    <td>   {{ $product['price'] }} </td>
    <td>   {{ $product['discount'] }} </td>
    <td>   {{ $product['description'] }} </td>
    <td>   {{ $product['type'] }} </td>
    <td>   {{ $product['external_code'] }} </td>
    <td>   @foreach($barcodes[$product['product_id']] as $type => $bc)
        {{ 'Штрихкод ' . $type . ': ' . $bc }}
        @endforeach
    </td>
</tr>
@endforeach
</tbody>
</table>
@endsection