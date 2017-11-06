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

insert into `config`(`id`,`name`,`password``salt`,`ctime`) values(1,'admin','1753be7ed0a8c3993b9439ab04a14576','IeYAf',1509777653);

create table  if not exists token
(
    `admin_id` int(10) unsigned not null auto_increment comment '管理员id',
    `token` varchar(255)  not null default '' comment '登录token',
    `validate` int(10)  unsigned not null default 0 comment '有效期',
    primary key(`admin_id`)
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

create table if not exists config
(
    `id` int(10) unsigned not null auto_increment comment '配置 id',
    `type` varchar(20) not null default '' comment '类型',
    `value` varchar(255) not null default '' comment '类型对应的值',
    primary key(`id`)
)engine=innodb default charset=utf8 comment='配置表';

insert into `config`(`id`,`type`,`value`) values(1,'theme','default');
