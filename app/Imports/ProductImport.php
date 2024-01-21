<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\ProductCharacteristic;
use App\Models\ProductPhoto;
use GuzzleHttp\Client;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Storage;

HeadingRowFormatter::default('none');

class ProductImport implements OnEachRow, WithHeadingRow
{
    
    public function onRow(Row $row)
    {
        $row = $row->toArray();
        $barcodes = json_encode([
            'EAN13' => $row["Штрихкод EAN13"],
            'EAN8' => $row["Штрихкод EAN8"],
            'Code128' => $row["Штрихкод Code128"],
            'UPC' => $row["Штрихкод UPC"],
            'GTIN' => $row["Штрихкод GTIN"],
        ]);
        $additional = json_encode([
            'size' => $row["Доп. поле: Размер"],
            'color' => $row["Доп. поле: Цвет"],
            'brand' => $row["Доп. поле: Бренд"],
            'contents' => $row["Доп. поле: Состав"],
            'amount' => $row["Доп. поле: Кол-во в упаковке"],
            'package_link' => $row["Доп. поле: Ссылка на упаковку"],
        ]);
        $price = str_replace(',', '.', ltrim($row["Цена: Цена продажи"], "'"));
        
        $product = Product::create([
            "name" => $row["Наименование"],
            "price" => $price,
            "discount" => $row["Запретить скидки при продаже в розницу"],
            "description" => $row["Описание"],
            "type" => $row["Тип"],
            "external_code" => $row["Внешний код"],
            "barcodes" => $barcodes,
            "additional_features" => $additional,
        ]);

        $productId = $product->id;

        $excludeKeys = [
            "Наименование",
            "Запретить скидки при продаже в розницу",
            "Описание",
            "Тип",
            "Внешний код",
            "Штрихкод EAN13",
            "Штрихкод EAN8",
            "Штрихкод Code128",
            "Штрихкод UPC",
            "Штрихкод GTIN",
            "Цена: Цена продажи",
            "Доп. поле: Размер",
            "Доп. поле: Цвет",
            "Доп. поле: Бренд",
            "Доп. поле: Состав",
            "Доп. поле: Кол-во в упаковке",
            "Доп. поле: Ссылка на упаковку",
            "Доп. поле: Ссылки на фото",
            ];

        $characteristics = array_filter($row, function ($key) use ($excludeKeys) {
            return !in_array($key, $excludeKeys);
        }, ARRAY_FILTER_USE_KEY);

        foreach($characteristics as $key => $value) {
            if ($value !== null) {
                ProductCharacteristic::create([
                    'product_id' => $productId,
                    'key' => $key,
                    'value' => $value,
                ]);
            }
        }

        $photos = explode(',', trim($row["Доп. поле: Ссылки на фото"]));
        $client = new Client();
        foreach($photos as $photo) {
            $photoPath = $this->storePhoto($photo, $client);
            ProductPhoto::create([
                "product_id" => $productId,
                "photo_link" => $photo,
                "photo_path" => $photoPath,
            ]);
        }
    }

    public function storePhoto(string $photoUrl, Client $client): string | null
    {
        if (!filter_var($photoUrl, FILTER_VALIDATE_URL)) {
            return null;
        }
        try {
            $photoContent = $client->get($photoUrl);
        } catch (ClientException $e) {
            return null;
        }
        $extension = pathinfo($photoUrl)['extension'];

        $photoName = md5(uniqid()) . '.' . $extension;
        $filePath = storage_path() . $photoName;
        if (file_put_contents($filePath, $photoContent)) {
            return $filePath;
        }
        return null;
        
    }

}

