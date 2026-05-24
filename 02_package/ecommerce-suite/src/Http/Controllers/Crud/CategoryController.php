<?php

namespace MaksimYurash\EcommerceSuite\Http\Controllers\Crud;

use MaksimYurash\EcommerceSuite\Models\Category;

class CategoryController extends BaseCrudController
{
    protected string $modelClass = Category::class;
    protected string $title = 'Категории';
    protected string $routeKey = 'categories';
    protected array $fields = ['name', 'slug', 'description', 'cover_path', 'is_active'];
    protected array $fieldLabels = ['name' => 'Название', 'slug' => 'Символьный код', 'description' => 'Описание', 'cover_path' => 'Обложка', 'is_active' => 'Активна'];
    protected array $rules = ['name' => ['required','string','max:255'], 'slug' => ['required','string','max:255'], 'description' => ['nullable','string'], 'cover_path' => ['nullable','string','max:255'], 'is_active' => ['nullable','boolean']];
}
