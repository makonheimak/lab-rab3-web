# Лабораторная работа №3

Сдаваемый комплект Laravel-пакета для абстрактного интернет-магазина.

## Структура

- `report` - материалы отчета.
- `package/ecommerce-suite` - основной Laravel-пакет.
- `demo-laravel-project` - пример подключения пакета к Laravel-проекту.
- `release-materials` - материалы для релиза.
- `sql` - материалы по структуре базы данных.

Основная инструкция по запуску, проверке API, CRUD, сидеров, фасадов и тестов находится в:

```text
package/ecommerce-suite/README.md
```

## Краткая проверка

1. Создать или открыть Laravel-проект.
2. Подключить пакет из `package/ecommerce-suite` как path-зависимость.
3. Выполнить публикацию ресурсов.
4. Подключить `EcommerceSuiteSeeder` в `DatabaseSeeder`.
5. Запустить:

```bash
php artisan migrate:fresh --seed
php artisan serve
```

6. Открыть:

```text
http://localhost:8000/shop-panel
```

После сидера в базе будут демо-данные: категории, поставщики, склады, клиенты, товары и заказы.
