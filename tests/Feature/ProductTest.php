<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function testPagesWorkCorrectly(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $response = $this->get('/upload');
        $response->assertStatus(200);

        $response = $this->get('/products');
        $response->assertStatus(200);
    }

    public function testImportWorksCorrectly(): void
    {
        $filePath = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 
        'fixtures' . DIRECTORY_SEPARATOR . 'import_example.xlsx');
         
        $file = new UploadedFile($filePath, 'import_example.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', null, true);

        $response = $this->post('/upload', ['excel_file' => $file]);
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/products');

        $this->assertDatabaseHas('products', [
            'external_code' => '3UHfAid1jaMiwgBuNvnsf3',
        ]);
        $response = $this->get('/products');
        $response->assertSee('Бермуды мужские');

        $response = $this->get('/products/9');
        $response->assertStatus(200);
        $response->assertSee('kxNTbNeJiHRZH3gE47ntk2');
        $response->assertSee('780 руб');
        $response->assertSee('90% Полиамид, 10% Эластан');
    }

    public function tearDown(): void
    {
        $folderPath = public_path('storage');

        if (File::exists($folderPath)) {
            foreach (File::allFiles($folderPath) as $file) {
                File::delete($file);
            }
        }
        parent::tearDown();
    }
}
