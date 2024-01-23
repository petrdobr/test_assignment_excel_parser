<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Imports\ProductImport;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;

class StoreImagesTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testThatPhotoIsStored(): void
    {

        $client = $this->createMock(Client::class);
        $responseBody = 'Mocked response content';
        $response = new Response(200, [], $responseBody);
        $client->method('get')->willReturn($response);

        $directory = __DIR__;
        $photoUrl = 'https://example.com/test-photo.jpg';

        $photoHandler = new ProductImport();
        $result = $photoHandler->storePhoto($photoUrl, $directory, $client);
        $this->assertNotNull($result);

        $filePath = $directory . DIRECTORY_SEPARATOR . $result;
        $this->assertFileExists($filePath);

        unlink($filePath);
    }
}
