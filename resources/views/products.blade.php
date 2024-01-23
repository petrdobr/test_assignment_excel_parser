@extends('layouts.app')

@section('title', __('Excel Upload'))

@section('content')
<h1>{{ __('Products') }}</h1>
<table>
<thead><tr>
    <th>ID</th>
    <th>{{__('Photo')}}</th>
    <th>{{__('Name')}}</th>
    <th>{{__('Price')}}</th>
    <th>{{__('Discount')}}</th>
    <th>{{__('Description')}}</th>
    <th>{{__('Type')}}</th>
    <th>{{__('External code')}}</th>
    <th>{{__('Barcodes')}}</th>
</tr>
</thead>
<tbody>
@foreach($products as $product)

<tr>
<td>   {{ $product['product_id'] }} </td>
<td> <img width="100" src="data:image/jpg;base64,{{ base64_encode($photos[$product->product_id]['photo']) }}">
</td>
    <td>   <a href="products/{{ $product['product_id'] }}">{{ $product['name'] }} </a> </td>
    <td>   {{ $product['price'] }} {{ $currency[$product->product_id] }}</td>
    <td>   {{ $product['discount'] }} </td>
    <td>   {{ $product['description'] }} </td>
    <td>   {{ $product['type'] }} </td>
    <td>   {{ $product['external_code'] }} </td>
    <td>   @foreach($barcodes[$product['product_id']] as $type => $bc)
        {{ __('Barcode') . ' ' . $type . ': ' . $bc }}
        @endforeach
    </td>
</tr>

@endforeach
</tbody>
</table>
@endsection