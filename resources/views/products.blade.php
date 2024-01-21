@extends('layouts.app')

@section('title', 'Upload Excel')

@section('content')
<h1>{{ __('Products') }}</h1>
<table>
<thead><tr>
<th>№</th>
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
<ul>
@foreach($chars as $char)
<li>{{ $char['product_id'] }}</li>
<li>{{ $char['key'] }}</li>
<li>{{ $char['value'] }}</li>
@endforeach
@endsection