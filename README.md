## Laravel - Showcase

### Требования
- PHP 8.2+
- Composer
- MySQL
### Установка
1. Скачиваем проект:
    - Вариант 1: скачайте [архив](https://github.com/TheKompreso/laravel-showcase/archive/refs/heads/master.zip) с проектом  и разархивируйте в нужную папку.
    - Вариант 2: с помощью git clone:
```
git clone https://github.com/TheKompreso/laravel-showcase
```
2. Устанавливаем зависимости:
```
composer install
```
3. Настраиваем базу данных:
копируем файл <b>.env.example</b>, переименовываем его в <b>.env</b> и настраиваем связь с нашей базой данных. Пример:
```
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```
4. Выполняем миграции:
```
php artisan migrate
```
5. Заполняем базу данных:
```
php artisan db:seed
```
6. Запускаем сервер и Тестируем АПИ.
```
php artisan serve 
```

### АПИ
### GET: /api/v1/products
Получить список продуктов.

| Query Parameter | Type  | Description                                     |
|-----------------|-------|-------------------------------------------------|
| ``properties``  | array | Выполняет поиск по свойствам.                   |
| ``per_page``    | int   | Количество элементов на страницу (от 1 до 100). |

Пример запроса:<br>
```
GET: /api/v1/products?per_page=5&properties[Цвет][]=Синий&properties[Материал][]=Джинсовая%20ткань

Ответ:
{
  "data": [
    {
      "id": 2,
      "name": "Джинсы",
      "price": 49.99,
      "quantity": 20,
      "properties": [
        {
          "property": "Цвет",
          "value": "Синий"
        },
        {
          "property": "Размер",
          "value": "L"
        },
        {
          "property": "Материал",
          "value": "Джинсовая ткань"
        }
      ]
    }
  ],
  "links": {
    "first": "http://127.0.0.1:8000/api/v1/products?page=1",
    "last": "http://127.0.0.1:8000/api/v1/products?page=1",
    "prev": null,
    "next": null
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 1,
    "links": [
      {
        "url": null,
        "label": "&laquo; Previous",
        "active": false
      },
      {
        "url": "http://127.0.0.1:8000/api/v1/products?page=1",
        "label": "1",
        "active": true
      },
      {
        "url": null,
        "label": "Next &raquo;",
        "active": false
      }
    ],
    "path": "http://127.0.0.1:8000/api/v1/products",
    "per_page": 40,
    "to": 1,
    "total": 1
  }
}
```
