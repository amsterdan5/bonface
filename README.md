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
├── static
│   ├── js                 js文件
│   └── css                css文件
└── upload
    ├── product            产品图
    └── banner             banner
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
  root /data/wwwroot/php/personal/face/views/bonface;

  include /usr/local/openresty/nginx/conf/rewrite/other.conf;
  #error_page 404 /404.html;
  #error_page 502 /502.html;



  location /api {
      rewrite ^/api/(.*)$ /index.php/$1;
  }

  location / {
      index index.html;
  }

  location /admin {
      rewrite ^/admin/(.*)$ /bonface-admin/$1;
  }

  location /bonface-admin {
      root /data/wwwroot/php/personal/face/views/;
  }

  location ~ [^/]\.php(/|$) {
    set $new_request_uri $request_uri;

    if ($request_uri ~ ^/api/(.+)$) {
        set $new_request_uri /index.php/$1;
    }

    root /data/wwwroot/php/personal/face/api/public;
    fastcgi_param AP_ENV   'DEVELOPMENT';
    #fastcgi_pass 127.0.0.1:9999;
    fastcgi_pass unix:/dev/shm/php-cgi.sock;
    fastcgi_index index.php;
    include fastcgi.conf;

    fastcgi_param REQUEST_URI $new_request_uri;
  }

  location ~ .*\.(gif|jpg|jpeg|png|bmp|swf|flv|mp4|ico)$ {
    expires 30d;
    access_log off;
  }
  location ~ .*\.(js|css)?$ {
    expires 7d;
    access_log off;
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
