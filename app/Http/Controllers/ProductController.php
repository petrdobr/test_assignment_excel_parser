<?php

namespace App\Http\Controllers;

use App\Models\ProductCharacteristic;
use App\Models\ProductPhoto;
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
        $photos = ProductPhoto::all();
        $currency = ProductCharacteristic::where('key', 'Валюта (Цена продажи)')->pluck('value', 'product_id');
        return view("products", [
            'products' => $products, 
            'barcodes' => $barcodes, 
            'photos' => $photos,
            'currency' => $currency,
        ]);
    }

    public function showProductById($id)
    {
        $product = Product::where('product_id', $id)->first();
        $barcodes = $product->barcodes;
        $barcodes = json_decode($barcodes, true);
        $barcodes = array_filter($barcodes, function ($barcode) {
                return $barcode !== NULL;
            });
        $additionalFeatures = $product->additional_features;
        $additionalFeatures = json_decode($additionalFeatures, true);
        $characteristics = ProductCharacteristic::where('product_id', $id)->get();
        $currency = ProductCharacteristic::where('key', 'Валюта (Цена продажи)')->pluck('value', 'product_id');
        $photos = ProductPhoto::where('product_id', $id)->get();
        return view("product_view", [
            'product' => $product, 
            'barcodes' => $barcodes,
            'photos' => $photos,
            'addFeatures' => $additionalFeatures,
            'characteristics' => $characteristics,
            'currency' => $currency,
        ]);
    }
}
