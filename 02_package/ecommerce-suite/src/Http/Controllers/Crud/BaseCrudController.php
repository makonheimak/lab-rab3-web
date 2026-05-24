<?php

namespace MaksimYurash\EcommerceSuite\Http\Controllers\Crud;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

abstract class BaseCrudController extends Controller
{
    protected string $modelClass;
    protected string $title;
    protected string $routeKey;
    protected array $fields = [];
    protected array $rules = [];
    protected array $fieldLabels = [];

    public function index(Request $request): View
    {
        $items = $this->modelClass::query()->latest()->paginate(config('ecommerce-suite.pagination.per_page', 10));

        return view('ecommerce-suite::crud.index', [
            'items' => $items,
            'fields' => $this->fields,
            'title' => $this->title,
            'routeKey' => $this->routeKey,
            'fieldLabels' => $this->fieldLabels,
        ]);
    }

    public function create(): View
    {
        return view('ecommerce-suite::crud.form', [
            'item' => null,
            'fields' => $this->fields,
            'title' => 'Добавление: ' . mb_strtolower($this->title),
            'routeKey' => $this->routeKey,
            'fieldLabels' => $this->fieldLabels,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate($this->rules);
        $this->modelClass::query()->create($data);

        return redirect()->route('ecommerce-suite.' . $this->routeKey . '.index')->with('status', 'Запись добавлена.');
    }

    public function show(int $id): View
    {
        $item = $this->modelClass::query()->findOrFail($id);

        return view('ecommerce-suite::crud.show', [
            'item' => $item,
            'fields' => $this->fields,
            'title' => $this->title,
            'routeKey' => $this->routeKey,
            'fieldLabels' => $this->fieldLabels,
        ]);
    }

    public function edit(int $id): View
    {
        $item = $this->modelClass::query()->findOrFail($id);

        return view('ecommerce-suite::crud.form', [
            'item' => $item,
            'fields' => $this->fields,
            'title' => 'Редактирование: ' . mb_strtolower($this->title),
            'routeKey' => $this->routeKey,
            'fieldLabels' => $this->fieldLabels,
        ]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $item = $this->modelClass::query()->findOrFail($id);
        $data = $request->validate($this->rules);
        $item->update($data);

        return redirect()->route('ecommerce-suite.' . $this->routeKey . '.index')->with('status', 'Изменения сохранены.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->modelClass::query()->findOrFail($id)->delete();

        return redirect()->route('ecommerce-suite.' . $this->routeKey . '.index')->with('status', 'Запись удалена.');
    }
}
