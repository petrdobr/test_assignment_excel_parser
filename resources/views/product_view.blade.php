@extends('layouts.app')

@section('title', __('Excel Upload'))

@section('content')
<div class="container">
        <div class="row">
        <a href="{{ url('/products') }}"><< {{__('Products')}}</a>
            <div class="col-md-8 offset-md-2">
                <h1>{{ $product->name }}</h1>

                <!-- Product Photos -->
                <div class="product-photos">
                    @foreach ($photos as $photo)
                        <img width="200" src="data:image/jpg;base64,{{ base64_encode($photo->photo) }}" alt="Фото товара">
                    @endforeach
                </div>

                <!-- Main Characteristics -->
                <div class="main-characteristics">
                    <h2>{{__('Information')}}</h2>
                    <p>{{ $product->description }}</p>
                    <ul>
                            <li>{{__('Name')}}: {{ $product->name }}</li>
                            <li>{{__('Price')}}: {{ $product->price }} {{ $currency[$product->product_id] }}</li>
                            <li>{{__('Discount')}}: {{ $product->discount }}</li>
                            <li>{{__('Type')}}: {{ $product->type }}</li>
                            <li>{{__('External code')}}: {{ $product->external_code }}</li>
                            <li>   @foreach($barcodes as $type => $bc)
                                        {{ __('Barcode') . ' ' . $type . ': ' . $bc }}
                                @endforeach
                            </li>

                    </ul>
                    <h2>{{__('Product characteristics')}}</h2>
                    <ul>
                        <li>{{__('Size')}}: {{ $addFeatures['size'] }}</li>
                        <li>{{__('Color')}}: {{ $addFeatures['color'] }}</li>
                        <li>{{__('Brand')}}: {{ $addFeatures['brand'] }}</li>
                        <li>{{__('Contents')}}: {{ $addFeatures['contents'] }}</li>
                        <li>{{__('Amount')}}: {{ $addFeatures['amount'] }}</li>
                    </ul>
                </div>
                <!-- Secondary Characteristics -->
                <div class="secondary-characteristics">
                    <h2>{{__('Additional information')}}</h2>
                    <ul>
                        @foreach ($characteristics as $char)
                            <li>{{ $char->key }}: {{ $char->value }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection