### Установка

Добавить в `tailwind.admin.config.js`, созданный в пакете `tailwindcss-theme`.

    "./vendor/4geo35/editable-steps-block/src/resources/views/livewire/admin/**/*.blade.php",
    "./vendor/4geo35/editable-steps-block/src/resources/views/admin/**/*.blade.php",

Добавить в `tailwind.config.js`, созданный в пакете `tailwindcss-theme`.

    "./vendor/4geo35/editable-steps-block/src/resources/views/components/**/*.blade.php",

Запустить миграции для создания таблиц `php artisan migrate`

#### Views

Сокращение для представлений: `esb`

#### Config

Название файла: `editable-steps-block`  
Название типа блока: `steps`

- `maxTitleLength` => `70`: максимальная длина заголовка
- `maxDigit` => `999`: максимальное число
