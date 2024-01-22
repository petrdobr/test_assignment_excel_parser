@extends('layouts.app')

@section('title', 'Upload Excel')

@section('content')
<div class="container">
        <div class="row">
        <a href="{{ url('/products') }}"><< Товары</a>
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
                    <h2>Информация</h2>
                    <p>{{ $product->description }}</p>
                    <ul>
                            <li>Название: {{ $product->name }}</li>
                            <li>Цена: {{ $product->price }} {{ $currency[$product->product_id] }}</li>
                            <li>Скидка: {{ $product->discount }}</li>
                            <li>Тип: {{ $product->type }}</li>
                            <li>Внешний код: {{ $product->external_code }}</li>
                            <li>   @foreach($barcodes as $type => $bc)
                                        {{ 'Штрихкод ' . $type . ': ' . $bc }}
                                @endforeach
                            </li>

                    </ul>
                    <h2>Характеристики товара</h2>
                    <ul>
                        <li>Размер: {{ $addFeatures['size'] }}</li>
                        <li>Цвет: {{ $addFeatures['color'] }}</li>
                        <li>Бренд: {{ $addFeatures['brand'] }}</li>
                        <li>Состав: {{ $addFeatures['contents'] }}</li>
                        <li>Количество: {{ $addFeatures['amount'] }}</li>
                    </ul>
                </div>
                <!-- Secondary Characteristics -->
                <div class="secondary-characteristics">
                    <h2>Дополнительные сведения</h2>
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