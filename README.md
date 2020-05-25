# Swoft/SoftDelete

Swoft/SoftDelete component for swoft framework

## Install

- install by composer

```bash
composer require gavinz8/swoft-soft-delete
```

## Config

- config in config/base.php

```php
<?php
return [
    'name'  => 'Swoft framework 2.0',
    'debug' => env('SWOFT_DEBUG', 1),
    'soft_delete' => [
        'column' => 'deleted_at',
        'ignore' => ['migration']
    ]
];

```

## LICENSE

The Component is open-sourced software licensed under the [Apache license](LICENSE).
