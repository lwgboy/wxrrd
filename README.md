# wxrrd
微信人人店API

## 安装

```
composer require quanpan302/wxrrd:dev-master
```

config.php有问题，似乎是之前的一次commit导致的 [link](https://github.com/Hanson/foundation-sdk/issues/2)

```
vendor\hanson\foundation-sdk\src\Config.php

Tightenco\Collect\Support\Collection
=>
Illuminate\Support\Collection
```

## 文档

### 实例化

```php
$pospal = new \Quanpan302\Wxrrd\Wxrrd([
    'url' => 'your-url',
    'app_id' => 'your-app-id',
    'app_key' => 'your-app-key',
]);
```

### 销售单据 API

