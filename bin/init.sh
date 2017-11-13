#!/usr/bin/env bash

echo '初始化session文件夹';
session_path=$(cd "$(dirname $0)"; cd ../api; pwd)
if [ ! -d "$session_path/storage/framework/session" ]; then
    mkdir -p "$session_path/storage/framework/session"
    chmod -R 777 "$session_path/storage/framework/session"
fi
echo '初始化session文件夹完成';

echo '初始化image文件夹';
image_path=$(cd "$(dirname $0)"; cd ../; pwd)
if [ ! -d "$image_path/images" ]; then
    mkdir -p "$image_path/images/product"
    mkdir -p "$image_path/images/banner"
    chmod -R 777 "$image_path/images/product"
    chmod -R 777 "$image_path/images/banner"
fi

if [ ! -d "$image_path/images/product" ]; then
    mkdir -p "$image_path/images/product"
    chmod -R 777 "$image_path/images/product"
fi

if [ ! -d "$image_path/images/banner" ]; then
    mkdir -p "$image_path/images/banner"
    chmod -R 777 "$image_path/images/banner"
fi
echo '初始化image文件夹完成';
