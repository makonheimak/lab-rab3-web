# Laravel Ecommerce Suite

Учебный Laravel-пакет для лабораторной работы №3. В пакете реализован абстрактный интернет-магазин: модели, миграции, фабрики, сидер с демо-данными, web CRUD, API CRUD, FormRequest-валидация, API Resources/Collections, middleware проверки версии API, фасад курса валют, фасад расчета доставки и тесты.

## Состав пакета

- `src/Models` - модели магазина: товар, категория, поставщик, клиент, склад, заказ, позиция заказа.
- `database/migrations` - миграции таблиц магазина.
- `database/factories` - фабрики моделей.
- `database/seeders/EcommerceSuiteSeeder.php` - фиксированное русскоязычное демо-наполнение.
- `src/Http/Controllers/Crud` - web CRUD-контроллеры.
- `src/Http/Controllers/Api` - API CRUD-контроллеры.
- `src/Http/Requests` - классы валидации входных параметров.
- `src/Http/Resources` - API Resources и Collections.
- `src/Http/Middleware/CheckApiVersion.php` - middleware заголовка `X-API-VERSION`.
- `src/Facades` и `src/Services` - фасады курса валют и расчета доставки.
- `resources/views` - публикуемые Blade-шаблоны CRUD-интерфейса.
- `config/ecommerce-suite.php` - публикуемая конфигурация пакета.
- `tests` - unit/feature-тесты пакета.

## Быстрый запуск в новом Laravel-проекте

Требования: PHP 8.2+, Composer, SQLite или MySQL.

1. Создать Laravel-проект:

```bash
composer create-project laravel/laravel lab3-demo "^11.0"
cd lab3-demo
```

2. Подключить локальный пакет. Если папка пакета лежит рядом с Laravel-проектом:

```bash
composer config repositories.ecommerce-suite path ../02_package/ecommerce-suite
composer config minimum-stability dev
composer config prefer-stable true
composer require maksim-yurash/ecommerce-suite:"*"
```

3. Настроить SQLite для простой проверки:

```bash
cp .env.example .env
php artisan key:generate
```

В `.env` указать:

```env
DB_CONNECTION=sqlite
```

Создать файл базы:

```bash
touch database/database.sqlite
```

На Windows можно создать файл вручную в папке `database` с именем `database.sqlite`.

4. Опубликовать ресурсы пакета:

```bash
php artisan vendor:publish --provider="MaksimYurash\EcommerceSuite\EcommerceSuiteServiceProvider" --force
```

5. Подключить демо-сидер в `database/seeders/DatabaseSeeder.php`:

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use MaksimYurash\EcommerceSuite\Database\Seeders\EcommerceSuiteSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(EcommerceSuiteSeeder::class);
    }
}
```

6. Создать таблицы и заполнить демо-данными:

```bash
php artisan migrate:fresh --seed
```

7. Запустить приложение:

```bash
php artisan serve
```

После запуска открыть:

```text
http://localhost:8000/shop-panel
```

## Что проверять в web-интерфейсе

В панели `shop-panel` доступны разделы:

- `Товары`
- `Категории`
- `Поставщики`
- `Клиенты`
- `Склады`
- `Заказы`

В каждом разделе есть CRUD-функции:

- просмотр списка;
- создание записи;
- просмотр карточки записи;
- редактирование;
- удаление.

После сидера должны быть созданы:

- 6 категорий;
- 3 поставщика;
- 3 склада;
- 5 клиентов;
- 12 товаров;
- 3 заказа.

## Проверка API

API находится по префиксу:

```text
/shop-api
```

Для основных API-маршрутов нужен заголовок:

```text
X-API-VERSION: 1
```

Примеры:

```bash
curl -H "X-API-VERSION: 1" http://localhost:8000/shop-api/products
curl -H "X-API-VERSION: 1" http://localhost:8000/shop-api/categories
curl -H "X-API-VERSION: 1" http://localhost:8000/shop-api/customers
curl -H "X-API-VERSION: 1" http://localhost:8000/shop-api/orders
```

Если открыть API без заголовка, должен вернуться ответ об ошибке. Это проверка middleware:

```json
{
  "message": "Header X-API-VERSION is required.",
  "expected_version": 1
}
```

Если передать нечисловое значение:

```bash
curl -H "X-API-VERSION: abc" http://localhost:8000/shop-api/products
```

Должен вернуться ответ:

```json
{
  "message": "Header X-API-VERSION must contain only numeric value."
}
```

## Проверка фасада доставки

Маршрут расчета доставки использует версию API `2`:

```bash
curl -X POST http://localhost:8000/shop-api/delivery/calculate \
  -H "X-API-VERSION: 2" \
  -H "Content-Type: application/json" \
  -d '{"from":{"lat":55.7558,"lng":37.6173},"to":{"lat":59.9343,"lng":30.3351},"weight":1.5}'
```

По умолчанию используется математический метод `math` на основе расстояния между координатами. В конфигурации можно выбрать другой драйвер:

```php
'delivery' => [
    'driver' => env('ECOMMERCE_DELIVERY_DRIVER', 'math'),
]
```

Доступные варианты:

- `math`;
- `google`;
- `yandex`.

## Проверка фасада курса валют

Маршрут:

```bash
curl -H "X-API-VERSION: 1" http://localhost:8000/shop-api/currency/rate?from=USD&to=RUB
```

Фасад можно использовать из кода Laravel:

```php
use MaksimYurash\EcommerceSuite\Facades\CurrencyRate;

$rate = CurrencyRate::rate('USD', 'RUB');
```

## Конфигурация

После публикации появляется файл:

```text
config/ecommerce-suite.php
```

В нем настраиваются:

- префикс web-маршрутов;
- префикс API-маршрутов;
- префикс таблиц;
- количество записей на странице;
- версия API по умолчанию;
- драйвер расчета доставки.

Пример изменения префиксов:

```php
'web_prefix' => 'shop-panel',
'api_prefix' => 'shop-api',
```

## Публикуемые ресурсы

Команда:

```bash
php artisan vendor:publish --provider="MaksimYurash\EcommerceSuite\EcommerceSuiteServiceProvider" --force
```

Публикует:

- конфигурацию в `config/ecommerce-suite.php`;
- Blade-шаблоны в `resources/views/vendor/ecommerce-suite`;
- тесты пакета в `tests/EcommerceSuite`.

## Тесты

После установки пакета и публикации ресурсов можно запустить:

```bash
php artisan test
```

В пакете есть проверки:

- математического расчета доставки;
- middleware `X-API-VERSION`;
- CRUD-операций для товаров.

## Что закрывает задание

- Модели, миграции, фабрики и сидер для сущностей интернет-магазина.
- Web CRUD-контроллеры и маршруты, подключаемые из пакета.
- Настраиваемые внутренние префиксы маршрутов через конфиг.
- Публикуемые Blade-шаблоны CRUD-интерфейса.
- Фасад курса валют.
- Фасад расчета доставки: Google, Yandex и математический метод.
- Выбор сервиса доставки через конфигурацию.
- Middleware проверки заголовка `X-API-VERSION`.
- API CRUD-контроллеры.
- FormRequest-валидация, Resources и Collections.
- Unit/feature-тесты, публикуемые после установки пакета.
