<?php

namespace App\Imports;

use App\Models\ProductCharacteristic;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class ProductCharacteristics implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Collection|null
    */
    public function collection(Collection $rows)
    {
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

            $rows->map(function ($row) {
                
            });

            foreach ($rows as $row) 
            {
                ProductCharacteristic::create([
                    'name' => $row[0],
                ]);
            }
    }
}
