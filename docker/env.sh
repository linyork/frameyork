#!/bin/bash
# Program:
#   Project frameyork 本機環境
#
# History:
#   2017/12/03 新增
#   2017/12/28 修正並新增r restart

# 切換到 evn.sh 檔案目錄底下
BASEDIR=$(dirname "$0")
cd "$BASEDIR"
clear

while :
do
    # 選擇要啟動的系統
    echo "----------------------------------------"
    echo "選擇要啟動的系統:"
    echo "----------------------------------------"
    echo "1. Nginx + PHP + MySQL + PHPMyAdmin"
    echo "----------------------------------------"
    echo "2. php"
    echo "3. Nginx"
    echo "4. MySQL"
    echo "5. phpMyAdmin"
    echo "----------------------------------------"
    echo "工具:"
    echo "----------------------------------------"
    echo "r. 重啟 Docker 所有容器"
    echo "c. 關閉 Docker 所有容器"
    echo "l. 顯示 Docker 所有容器"
    echo "q. Exit"
    echo "----------------------------------------"
    echo "選擇 migrate 設定:"
    echo "----------------------------------------"
    echo "t. create table"
    echo "b. rollback"
    echo "----------------------------------------"
    read -p "Input:" input input2

    clear

    case $input in
        1)
            # 啟動 php
            docker-compose up -d --build php
            # 啟動 nginx
            docker-compose up -d --build nginx
            # 啟動 mysql
            docker-compose up -d --build mysql
            # 啟動 phpmyadmin
            docker-compose up -d --build phpmyadmin_mysql
            ;;
        2)
            # 啟動 php
            docker-compose up -d --build php
            ;;
        3)
            # 啟動 nginx
            docker-compose up -d --build nginx
            ;;
        4)
            # 啟動 mysql
            docker-compose up -d --build mysql
            ;;
        5)
            # 啟動 phpmyadmin
            docker-compose up -d --build phpmyadmin_mysql
            ;;
        s)
            # 啟動指定的服務
            if [  "$input2" == "" ]; then
                echo "which service do you want to start?"
            else
                docker-compose up -d --build $input2
            fi
            ;;
        d)
            # 關閉指定的服務
            if [  "$input2" == "" ]; then
                echo "which service do you want to shutdown?"
            else
                docker rm -f $input2
            fi
            ;;
        r)
            # 關閉透過 docker-compose 產生的 container
            docker-compose down
            # 啟動 php
            docker-compose up -d --build php
            # 啟動 nginx
            docker-compose up -d --build nginx
            # 啟動 mysql
            docker-compose up -d --build mysql
            # 啟動 phpmyadmin
            docker-compose up -d --build phpmyadmin_mysql
            ;;
        l)
            # 查看目前的 container
            docker ps -a
            ;;
        c)
            # 關閉透過 docker-compose 產生的 container
            docker-compose down
            ;;
        t)
            # 執行 migrate
            php ../vendor/bin/phinx migrate
            ;;
        b)
            # 執行 rollback
            php ../vendor/bin/phinx rollback -t 0
            ;;
        *)
            # 離開程序
            exit
            ;;
    esac
done