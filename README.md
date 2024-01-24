[![github action status](https://github.com/petrdobr/test_assignment_excel_parser/workflows/Laravel/badge.svg)](../../actions)
## Парсер Excel файлов
Приложение, написанное на фреймворке Laravel для парсинга файлов Excel, имеющих определенную структуру данных.

### Установка
Понадобятся установленные composer и php 8.2 или выше с установленным sqlite3.

Скопируйте репозиторий себе на компьютер и установите зависимости:
```
composer install
```
Скопировать содержимое файла .env.example в файл .env:
```
cp .env.example .env
```
Генерация уникального ключа приложения:
```
php artisan key:generate
```
В файле .env следует поменять базу данных на sqlite:
```env
DB_CONNECTION=sqlite
#DB_HOST=127.0.0.1
#DB_PORT=3306
#DB_DATABASE=test_excel
#DB_USERNAME=
#DB_PASSWORD=
```
Установка базы данных sqlite (создание файла базы данных database.sqlite)
```
touch database/database.sqlite
```
Создать необходимые таблицы в базе данных (накатить миграции):

```
php artisan migrate
```

Так как файлы изображений для базы данных сохраняются в папке storage/app/public, необходимо установить связь с папкой public/storage, доступной публично при запуске сервера. Делается это следующей командой:
```
php artisan storage:link
```

**Запустить сервер** по адресу localhost:8000, использовать приложение в браузере.
```
php artisan serve
```
Или запустить тесты
```
php artisan test
```

### Использование приложения и описание
В папке tests/fixtures находится тестовый файл import_example.xlsx, который можно использовать для импорта данных. 

Импорт производится на странице "Импорт" через форму загрузки файла, просмотр результатов импорта возможен на странице "Товары".

Каждый товар имеет отдельную индивидуальную страницу с отображением всех характеристик, внесенных в базу данных. На общей странице "Товары" название товара в таблице является ссылкой на индивидуальную страницу.

В базе данных приложения используется 3 таблицы: products, product_characteristics, product_photos.

Основные характеристики товара сохраняются в таблицу products, колонки таблицы соответствуют основным характеристикам (название, описание, внешний код, штрихкоды и т.д.).

В таблице product_characteristics, связанной с таблицей products внешним ключом по product_id, свойства хранятся в виде колонок key, value.

Изображения скачиваются по ссылкам, данным в таблице excel и сохраняются в хранилище приложения в папке storage/app/public. В базу данных сохраняется внешняя ссылка, путь в хранилище и само изображение. 

Отображение фотографий товаров производится загрузкой изображения из базы данных. Альтернативно возможна подстановка ссылки на файл в локальном хранилище приложения.

### Спасибо за внимание!
