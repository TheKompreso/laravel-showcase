<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductProperty;
use App\Models\Property;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Свойства
        $propertiesData = [
            ['name' => 'Цвет'],
            ['name' => 'Размер'],
            ['name' => 'Материал'],
        ];
        foreach ($propertiesData as $propData) {
            Property::updateOrCreate($propData);
        }
        $properties = [];
        foreach (Property::all() as $property) {
            $properties[$property->name] = $property;
        }

        // Продукты
        $productsData = [
            [
                'name' => 'Футболка',
                'price' => 19.99,
                'quantity' => 50,
                'properties' => [
                    ['name' => 'Цвет', 'value' => 'Красный'],
                    ['name' => 'Размер', 'value' => 'M'],
                    ['name' => 'Материал', 'value' => 'Хлопок'],
                ],
            ],
            [
                'name' => 'Джинсы',
                'price' => 49.99,
                'quantity' => 20,
                'properties' => [
                    ['name' => 'Цвет', 'value' => 'Синий'],
                    ['name' => 'Размер', 'value' => 'L'],
                    ['name' => 'Материал', 'value' => 'Джинсовая ткань'],
                ],
            ],
            [
                'name' => 'Куртка',
                'price' => 99.99,
                'quantity' => 10,
                'properties' => [
                    ['name' => 'Цвет', 'value' => 'Черный'],
                ],
            ],
        ];

        foreach ($productsData as $prodData) {
            $product = Product::create([
                'name' => $prodData['name'],
                'price' => $prodData['price'],
                'quantity' => $prodData['quantity'],
            ]);

            foreach ($prodData['properties'] as $prop) {
                if (isset($properties[$prop['name']])) {
                    ProductProperty::create([
                        'product_id'   => $product->id,
                        'property_id'  => $properties[$prop['name']]->id,
                        'value'        => $prop['value'],
                    ]);
                }
            }
        }
    }
}
