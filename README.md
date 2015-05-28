# medialib

Universal media library

[In Russian](README.ru.md)

Provided links /medialib/picture/<picid>

### 1. Download

```bash
composer require "simplator/medialib:dev-master"
```

### 2. Configure

> **NOTE:** Module need install as "medialib" module.

Add following lines to your main configuration file:

```php
'modules' => [
    'medialib' => [
        'class' => 'simplator\medialib\Module',
    ],
],
```
