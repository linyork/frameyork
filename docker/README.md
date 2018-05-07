# HypeNode Project #

## Getting Started Docker ##

### 1. set hosts ###
/etc/hosts 
``` 
127.0.0.1   dev-hypenode.tw
127.0.0.1	  design-hypenode.tw
```
### 2. run env.sh ###
```
    ----------------------------------------
    選擇要啟動的系統:
    ----------------------------------------
    a. PHP + Nginx + Mariadb + PhpMyAdmin + Redis
    ----------------------------------------
    1. PHP
    2. Nginx
    3. Mariadb
    4. PhpMyAdmin
    5. Redis
    ----------------------------------------
    工具:
    ----------------------------------------
    r. 重啟 Docker 所有容器
    c. 關閉 Docker 所有容器
    l. 顯示 Docker 所有容器
    d. 指定重啟 Docker 項目編號容器
      - Example: 重啟 PHP 容器
      - input: d 1
    q. Exit
    ----------------------------------------
    選擇 migrate 設定:
    ----------------------------------------
    t. create table
    b. rollback to 0
    ----------------------------------------
    Input:
```
### 3. run migration ###
@ /hypenode/docker

run
```
phinx migrate
```
rollback
```
phin rollback -t 0
```
add
```
php ../vendor/bin/phinx create MigrationName
```

### 4. browser ###
http://dev-hypenode.tw/
