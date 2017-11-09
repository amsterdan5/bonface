# bonface
## bonface 官网


### 目录结构

```
├── api                    接口代码
│   ├── app                项目代码
│   ├── bootstrap          初始化代码
│   ├── database           数据库说明
│   ├── public             代码根文件
│   ├── resources          资源文件
│   ├── routes             路由
│   └── vendor             Composer 第三方库
├── docs                   接口文档
├── images
│   ├── product            产品图
│   └── banner             banner
├── views
│   ├── bonface            用户端页面
│   ├── bonface-admin      后台页面
│   └── static             静态文件
```

### 说明
```
使用 php7.0 以上版本、基于 lumen5.4 开发
```

### 环境

#### nginx 配置

```
server {
  listen 80;
  server_name 7.hujs.test.com;
  access_log /data/wwwlogs/nginx/7.hujs.test.com_access.log combined;
  error_log /data/wwwlogs/nginx/7.hujs.test.com_error.log;
  index index.html index.htm index.php;
  set $common_path /data/wwwroot/php/personal/face;
  root $common_path/views;

  include /usr/local/openresty/nginx/conf/rewrite/other.conf;

  error_page 404 = /error.html;
  location /api {
    rewrite ^/api/(.*)$ /index.php/$1;
  }

  location / {
      root $common_path/views/bonface/;
  }

  location /admin {
      rewrite ^/admin/(.*)$ /bonface-admin/$1;
  }

  location /bonface-admin {
      root $common_path/views/;
  }

  location ~ [^/]\.php(/|$) {
    set $new_request_uri $request_uri;

    if ($request_uri ~ ^/api/(.+)$) {
        set $new_request_uri /index.php/$1;
    }

    root $common_path/api/public;
    fastcgi_param AP_ENV   'DEVELOPMENT';
    #fastcgi_pass 127.0.0.1:9999;
    fastcgi_pass unix:/dev/shm/php-cgi.sock;
    fastcgi_index index.php;
    include fastcgi.conf;

    fastcgi_param REQUEST_URI $new_request_uri;
  }

  location ~ .*\.(gif|jpg|jpeg|png|bmp|swf|flv|mp4|ico)$ {
    root $common_path;
    expires 30d;
    access_log off;
  }

  location ~ .*\.(js|css|ttf)?$ {
      root $common_path/views/static/;
    expires 7d;
    access_log off;
    rewrite ^/admin/(.*)$ /bonface-admin/$1;
  }

  location ~ /\.ht {
    deny all;
  }

}

```

#### 执行脚本
```
composer install
```
