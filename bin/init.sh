#!/usr/bin/env bash

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
