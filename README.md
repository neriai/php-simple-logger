# php-simple-logger

## 概要

- 簡易的なロガークラスです。

## 準備

Composerを使ってMonologを入れます。

### Composerのインストール

```text
curl -s https://getcomposer.org/installer | php -- --install-dir={インストール先}
```

### composer.jsonの作成

```json
{
  "require": {
    "monolog/monolog": "1.2.*"
  }
}
```

### Monologのインストール

```text
composer install
```

## 使い方

### セットアップする

```php
<?php

$config = array();

$config['path'] = {ログ出力先}
$config['level'] = {デフォルトのログレベル}

Log::setup($config);
```

### 出力する

```php
<?php

try {
    return true;
} catch (Exception $e) {
    Log::output($e, {ログレベル});
    return false;
}
```

## 出力結果

```text
{日付} [{エラーレベル}] {エラーメッセージ}
```
