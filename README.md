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

-- column config the column name what you want mark for delete.
-- ignore config the table you want not use soft delete.

## How Use

- You can use model or db method delete directly like this

```php
User::where('id', 1)->delete();
DB:table('user')->where('id', 1)->delete();
```

- Then you can use every method you want get data, even if multiple table query, like this

```php
User::find(1);
User::where('id', 1)->first();
User::where('id', 1)->get();
Db::from('user a u')->join('role as r', u.id, r.user_id)->where('u.id', 1)->get();
```

## LICENSE

The Component is open-sourced software licensed under the [Apache license](LICENSE).
