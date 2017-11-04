create database `bonface`;

use bonface;

create table if not exists admin
(
    `id` int(10) unsigned not null auto_increment comment '管理员id',
    `name` varchar(30) not null default '' comment '账号名',
    `password` varchar(32) not null default '' comment '密码',
    `salt` varchar(5) not null default '' comment 'salt',
    `ctime` int(10) unsigned not null default 0 comment '创建时间',
    `mtime` int(10) unsigned not null default 0 comment '修改时间',
    primary key(`id`)
)engine=innodb default charset=utf8 comment='管理员表';

create table  if not exists token
(
    `token` varchar(255)  not null default '' comment '登录token',
    `validate` int(10)  unsigned not null default 0 comment '有效期',
    key token(`token`)
)engine=innodb default charset=utf8 comment='登录token';

create table if not exists product
(
    `id` int(10) unsigned not null auto_increment comment '产品id',
    `name` varchar(40) not null default '' comment '产品名',
    `image` varchar(255) not null default '' comment '产品图',
    `desc` varchar(255) not null default '' comment '产品描述',
    primary key(`id`)
)engine=innodb default charset=utf8 comment='产品表';

create table if not exists banner
(
    `id` int(10) unsigned not null auto_increment comment 'banner id',
    `image` varchar(255) not null default '' comment 'banner图',
    primary key(`id`)
)engine=innodb default charset=utf8 comment='banner表';
