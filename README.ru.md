# medialib

Универсальная библиотека медиафайлов для вашего сайта

Требует установки как модуль medialib

Настраивает UrlManager на ссылки вида /medialib/pic<picid> на изображения

### 1. Загрузка

```bash
composer require "simplator/medialib:dev-master"
```

### 2. Настройка

> **Замечание:** Модуль требуется установить как "medialib".

Добавим следующие строки в конфигурацию:

```php
'modules' => [
    'medialib' => [
        'class' => 'simplator\medialib\Module',
    ],
],
```

## Для добавления изображения к модели требуется:

### 1. К требуемой модели добавляем поле, содержащее id изображения (например pictureid)

### 2. Добавляем функцию получения изображения из модели
```php
    public function getPicture()
    {
        return \simplator\medialib\models\Picture::getPicture($this->pictureid);
    }
```
Данном коде если изображения с таким id нет или id пустое то возвращяет изображение по умолчанию

### 3. Добавляем виджет на форму ретактирования
```php
    <?php echo $form->field($model, 'pictureid')->widget(simplator\medialib\widgets\PicSelect::className()) ?>
```

Виджет предоставляет интерфейс для выбора изображения и его предпросмотра.

Поддерживает drug&drop

Использует jQuery-file-upload.