# Crawler 專案建立
---

## Requirements
- php >= 8.1
---

## Install Requirements

### Via Composer
```
composer install
```

### Via Laravel Sail (for development)
```
sh ./sail
```
```
./vendor/bin/sail up -d
```

#### 設定 alias 指令
- vi ~/.bashrc

- 捲到最下面，新增
    ```
    alias sail='bash vendor/bin/sail'
    ```
- 套用
    ```
    . ~/.bashrc
    ```
- 打指令用 sail 代替 php & docker-compose, e.g.
    ```
        sail artisan tinker
    ```
    ```
        sail php -V
    ```
    ```
        sail up -d
    ```
    ```
        sail down
    ```
---

## Set Environment

### Copy .env.example file to .env
```
cp .env.example .env
```

### Edit .env for your use (e.g. database)
---

## Artisan Command

### Generate Application Key
```
php artisan key:generate
```
