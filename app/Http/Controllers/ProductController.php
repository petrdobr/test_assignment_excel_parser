<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Product;

class ProductController extends Controller
{
    public function showForm()
    {
        return view("upload");
    }

    public function upload(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('excel_file');

        $import = new ProductImport();
        Excel::import($import, $file);

        $collection = Excel::toCollection($import, $file);

        return redirect('/products')->with('success', 'Data imported successfully!');
    }

    public function showProducts()
    {
        $products = Product::all();
        $barcodes = Product::pluck('barcodes', 'product_id')->toArray();
        $barcodes = array_map(function ($barcodesData) {
            $barcodesArray = json_decode($barcodesData, true);
            return array_filter($barcodesArray, function ($barcode) {
                return $barcode !== NULL;
            });
        }, $barcodes);
        return view("products", ['products' => $products, 'barcodes' => $barcodes]);
    }
}
