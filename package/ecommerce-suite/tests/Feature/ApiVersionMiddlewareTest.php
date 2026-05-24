<?php

namespace MaksimYurash\EcommerceSuite\Tests\Feature;

use Illuminate\Support\Facades\Route;
use MaksimYurash\EcommerceSuite\Tests\TestCase;

class ApiVersionMiddlewareTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Route::middleware('ecommerce.api.version:2')->get('/test-version', fn () => response()->json(['ok' => true]));
    }

    public function test_it_rejects_missing_api_version_header(): void
    {
        $this->getJson('/test-version')->assertStatus(400);
    }

    public function test_it_rejects_non_numeric_api_version_header(): void
    {
        $this->getJson('/test-version', ['X-API-VERSION' => 'v2'])->assertStatus(400);
    }

    public function test_it_accepts_matching_numeric_api_version_header(): void
    {
        $this->getJson('/test-version', ['X-API-VERSION' => '2'])->assertOk()->assertJson(['ok' => true]);
    }
}
