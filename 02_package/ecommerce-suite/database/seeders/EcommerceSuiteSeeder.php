<?php

namespace MaksimYurash\EcommerceSuite\Database\Seeders;

use Illuminate\Database\Seeder;
use MaksimYurash\EcommerceSuite\Models\Category;
use MaksimYurash\EcommerceSuite\Models\Customer;
use MaksimYurash\EcommerceSuite\Models\Order;
use MaksimYurash\EcommerceSuite\Models\OrderItem;
use MaksimYurash\EcommerceSuite\Models\Product;
use MaksimYurash\EcommerceSuite\Models\Supplier;
use MaksimYurash\EcommerceSuite\Models\Warehouse;

class EcommerceSuiteSeeder extends Seeder
{
    public function run(): void
    {
        $categories = collect([
            ['name' => 'Ноутбуки', 'slug' => 'noutbuki', 'description' => 'Портативные компьютеры для учебы, работы и разработки.'],
            ['name' => 'Смартфоны', 'slug' => 'smartfony', 'description' => 'Мобильные устройства и аксессуары для повседневного использования.'],
            ['name' => 'Периферия', 'slug' => 'periferiya', 'description' => 'Клавиатуры, мыши, гарнитуры и устройства ввода.'],
            ['name' => 'Мониторы', 'slug' => 'monitory', 'description' => 'Дисплеи для офиса, учебы и игр.'],
            ['name' => 'Комплектующие', 'slug' => 'komplektuyushchie', 'description' => 'Детали для сборки и модернизации компьютеров.'],
            ['name' => 'Сетевое оборудование', 'slug' => 'setevoe-oborudovanie', 'description' => 'Роутеры, коммутаторы и оборудование для локальных сетей.'],
        ])->mapWithKeys(fn (array $data) => [
            $data['slug'] => Category::query()->updateOrCreate(
                ['slug' => $data['slug']],
                $data + ['cover_path' => null, 'is_active' => true]
            ),
        ]);

        $suppliers = collect([
            ['name' => 'ТехноПоставка', 'contact_person' => 'Иван Петров', 'email' => 'sales@technosupply.local', 'phone' => '+7 900 100-10-10', 'address' => 'Москва, ул. Складская, 12'],
            ['name' => 'Digital Market', 'contact_person' => 'Анна Соколова', 'email' => 'orders@digital-market.local', 'phone' => '+7 900 200-20-20', 'address' => 'Санкт-Петербург, Невский проспект, 40'],
            ['name' => 'Комплект-Сервис', 'contact_person' => 'Сергей Орлов', 'email' => 'info@komplekt.local', 'phone' => '+7 900 300-30-30', 'address' => 'Казань, ул. Техническая, 5'],
        ])->mapWithKeys(fn (array $data) => [
            $data['name'] => Supplier::query()->updateOrCreate(
                ['email' => $data['email']],
                $data + ['is_active' => true]
            ),
        ]);

        $warehouses = collect([
            ['title' => 'Основной склад', 'address' => 'Москва, ул. Логистическая, 1', 'latitude' => 55.7558000, 'longitude' => 37.6173000, 'capacity' => 1500],
            ['title' => 'Северный склад', 'address' => 'Санкт-Петербург, ул. Складская, 18', 'latitude' => 59.9343000, 'longitude' => 30.3351000, 'capacity' => 900],
            ['title' => 'Региональный склад', 'address' => 'Казань, ул. Производственная, 7', 'latitude' => 55.7961000, 'longitude' => 49.1064000, 'capacity' => 700],
        ])->mapWithKeys(fn (array $data) => [
            $data['title'] => Warehouse::query()->updateOrCreate(
                ['title' => $data['title']],
                $data + ['is_active' => true]
            ),
        ]);

        $customers = collect([
            ['full_name' => 'Максим Юраш', 'email' => 'maksim.yurash@example.local', 'phone' => '+7 901 111-11-11', 'address' => 'Москва, ул. Учебная, 8'],
            ['full_name' => 'Екатерина Смирнова', 'email' => 'ekaterina.smirnova@example.local', 'phone' => '+7 901 222-22-22', 'address' => 'Санкт-Петербург, Литейный проспект, 15'],
            ['full_name' => 'Алексей Волков', 'email' => 'aleksey.volkov@example.local', 'phone' => '+7 901 333-33-33', 'address' => 'Казань, ул. Университетская, 4'],
            ['full_name' => 'Мария Кузнецова', 'email' => 'maria.kuznetsova@example.local', 'phone' => '+7 901 444-44-44', 'address' => 'Нижний Новгород, ул. Центральная, 21'],
            ['full_name' => 'Дмитрий Иванов', 'email' => 'dmitriy.ivanov@example.local', 'phone' => '+7 901 555-55-55', 'address' => 'Екатеринбург, ул. Мира, 10'],
        ])->mapWithKeys(fn (array $data) => [
            $data['email'] => Customer::query()->updateOrCreate(
                ['email' => $data['email']],
                $data + ['registered_at' => now()]
            ),
        ]);

        $products = collect([
            ['category' => 'noutbuki', 'supplier' => 'ТехноПоставка', 'warehouse' => 'Основной склад', 'name' => 'Ноутбук AuroraBook 14', 'sku' => 'NB-AURORA-14', 'price' => 79990, 'weight' => 1.350, 'quantity' => 8],
            ['category' => 'noutbuki', 'supplier' => 'Digital Market', 'warehouse' => 'Северный склад', 'name' => 'Ноутбук WorkMate Pro 15', 'sku' => 'NB-WORKMATE-15', 'price' => 94990, 'weight' => 1.720, 'quantity' => 5],
            ['category' => 'smartfony', 'supplier' => 'Digital Market', 'warehouse' => 'Основной склад', 'name' => 'Смартфон PixelWay X', 'sku' => 'PH-PIXELWAY-X', 'price' => 45990, 'weight' => 0.210, 'quantity' => 14],
            ['category' => 'smartfony', 'supplier' => 'ТехноПоставка', 'warehouse' => 'Региональный склад', 'name' => 'Смартфон Nova S', 'sku' => 'PH-NOVA-S', 'price' => 32990, 'weight' => 0.190, 'quantity' => 20],
            ['category' => 'periferiya', 'supplier' => 'Комплект-Сервис', 'warehouse' => 'Основной склад', 'name' => 'Механическая клавиатура KeyPro', 'sku' => 'KB-KEYPRO', 'price' => 6990, 'weight' => 0.950, 'quantity' => 35],
            ['category' => 'periferiya', 'supplier' => 'Комплект-Сервис', 'warehouse' => 'Северный склад', 'name' => 'Беспроводная мышь ClickAir', 'sku' => 'MS-CLICKAIR', 'price' => 3490, 'weight' => 0.120, 'quantity' => 42],
            ['category' => 'monitory', 'supplier' => 'ТехноПоставка', 'warehouse' => 'Основной склад', 'name' => 'Монитор Vision 27 IPS', 'sku' => 'MN-VISION-27', 'price' => 24990, 'weight' => 4.800, 'quantity' => 11],
            ['category' => 'monitory', 'supplier' => 'Digital Market', 'warehouse' => 'Северный склад', 'name' => 'Монитор OfficeView 24', 'sku' => 'MN-OFFICE-24', 'price' => 15990, 'weight' => 3.600, 'quantity' => 17],
            ['category' => 'komplektuyushchie', 'supplier' => 'Комплект-Сервис', 'warehouse' => 'Региональный склад', 'name' => 'SSD DriveFast 1 ТБ', 'sku' => 'SSD-DRIVEFAST-1TB', 'price' => 8990, 'weight' => 0.080, 'quantity' => 50],
            ['category' => 'komplektuyushchie', 'supplier' => 'Комплект-Сервис', 'warehouse' => 'Основной склад', 'name' => 'Оперативная память DDR4 16 ГБ', 'sku' => 'RAM-DDR4-16', 'price' => 5490, 'weight' => 0.060, 'quantity' => 60],
            ['category' => 'setevoe-oborudovanie', 'supplier' => 'ТехноПоставка', 'warehouse' => 'Северный склад', 'name' => 'Wi-Fi роутер NetHome AX', 'sku' => 'NET-HOME-AX', 'price' => 7990, 'weight' => 0.520, 'quantity' => 23],
            ['category' => 'setevoe-oborudovanie', 'supplier' => 'Digital Market', 'warehouse' => 'Региональный склад', 'name' => 'Коммутатор OfficeSwitch 8', 'sku' => 'NET-SWITCH-8', 'price' => 5990, 'weight' => 0.740, 'quantity' => 18],
        ])->mapWithKeys(function (array $data) use ($categories, $suppliers, $warehouses) {
            $product = Product::query()->updateOrCreate(
                ['sku' => $data['sku']],
                [
                    'category_id' => $categories[$data['category']]->id,
                    'supplier_id' => $suppliers[$data['supplier']]->id,
                    'warehouse_id' => $warehouses[$data['warehouse']]->id,
                    'name' => $data['name'],
                    'description' => 'Демонстрационный товар для проверки CRUD, API и пагинации интернет-магазина.',
                    'price' => $data['price'],
                    'currency' => 'RUB',
                    'weight' => $data['weight'],
                    'cover_path' => null,
                    'quantity' => $data['quantity'],
                    'status' => 'active',
                ]
            );

            return [$data['sku'] => $product];
        });

        $this->createOrder(
            $customers['maksim.yurash@example.local'],
            'ORD-1001',
            'paid',
            'Москва, ул. Логистическая, 1',
            'Москва, ул. Учебная, 8',
            650,
            [
                [$products['NB-AURORA-14'], 1],
                [$products['MS-CLICKAIR'], 2],
            ]
        );

        $this->createOrder(
            $customers['ekaterina.smirnova@example.local'],
            'ORD-1002',
            'new',
            'Санкт-Петербург, ул. Складская, 18',
            'Санкт-Петербург, Литейный проспект, 15',
            500,
            [
                [$products['MN-OFFICE-24'], 1],
                [$products['KB-KEYPRO'], 1],
            ]
        );

        $this->createOrder(
            $customers['aleksey.volkov@example.local'],
            'ORD-1003',
            'delivered',
            'Казань, ул. Производственная, 7',
            'Казань, ул. Университетская, 4',
            350,
            [
                [$products['SSD-DRIVEFAST-1TB'], 2],
                [$products['RAM-DDR4-16'], 2],
                [$products['NET-SWITCH-8'], 1],
            ]
        );
    }

    private function createOrder(Customer $customer, string $number, string $status, string $from, string $to, float $deliveryCost, array $items): void
    {
        $order = Order::query()->updateOrCreate(
            ['number' => $number],
            [
                'customer_id' => $customer->id,
                'status' => $status,
                'currency' => 'RUB',
                'delivery_from' => $from,
                'delivery_to' => $to,
                'delivery_cost' => $deliveryCost,
                'placed_at' => now(),
            ]
        );

        $order->items()->delete();

        foreach ($items as [$product, $quantity]) {
            OrderItem::query()->create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'unit_price' => $product->price,
                'quantity' => $quantity,
                'line_total' => $product->price * $quantity,
            ]);
        }

        $order->update([
            'total_amount' => $order->items()->sum('line_total') + $deliveryCost,
        ]);
    }
}
