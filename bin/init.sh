#!/usr/bin/env bash

image_path=$(cd "$(dirname $0)"; cd ../; pwd)
if [ ! -d "$image_path/upload" ]; then
    mkdir -p "$image_path/upload/product"
    mkdir -p "$image_path/upload/banner"
    chmod -R 777 "$image_path/upload/product"
    chmod -R 777 "$image_path/upload/banner"
fi

if [ ! -d "$image_path/upload/product" ]; then
    mkdir -p "$image_path/upload/product"
    chmod -R 777 "$image_path/upload/product"
fi

if [ ! -d "$image_path/upload/banner" ]; then
    mkdir -p "$image_path/upload/banner"
    chmod -R 777 "$image_path/upload/banner"
fi
