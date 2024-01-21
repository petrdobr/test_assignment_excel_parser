<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class ProductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    public function model(array $row)
    {
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
            'photo_links' => $row["Доп. поле: Ссылки на фото"],
        ]);
        $price = str_replace(',', '.', ltrim($row["Цена: Цена продажи"], "'"));
        return new Product([
            "name" => $row["Наименование"],
            "price" => $price,
            "discount" => $row["Запретить скидки при продаже в розницу"],
            "description" => $row["Описание"],
            "type" => $row["Тип"],
            "external_code" => $row["Внешний код"],
            "barcodes" => $barcodes,
            "additional_features" => $additional,
        ]);
    }

}

