CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `phone_num` varchar(30) NOT NULL COMMENT '手机号',
  `photo` varchar(240) DEFAULT 'http://lolita.yiwangchunyu.wang:8081/img/profilephoto/boy.jpg' COMMENT '用户头像url',
  `gender` int DEFAULT 0 COMMENT '性别',
  `city` varchar(5) DEFAULT '' COMMENT '所在城市',
  `ctime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `mtime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `save_unique_index` (`username`,`phone_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table `img_lib` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) not null comment '1,动态；',
  `object_id` int(11) not null,
  `url` varchar(200) not null,
  `ctime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `mtime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table `follow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) not null,
  `follow_id` int(11) not null,
  `ctime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `mtime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table `dynamic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) not null,
  `content` text not null,
  `pic` int not null comment '有无图片',
  `like` int default 0,
  `ctime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `mtime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dynamic_id` int(11) not null,
  `uid` int(11) not null,
  `content` text not null,
  `ctime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `mtime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table `fovoar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) not null,
  `type` int(11) not null comment '101,动态；201，橱窗；301，出物求物; 401，提问',
  `object_id` int(11) not null,
  `ctime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `mtime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) not null,
  `content` text not null,
  `pic` int not null comment '有无图片',
  `like` int default 0,
  `ctime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `mtime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table `anwser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) not null,
  `uid` int(11) not null,
  `content` text not null,
  `ctime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `mtime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table `showcase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pic` int default 0 comment '是否有图片',
  `style` varchar(32) default '' comment '裙子风格',
  `dress_name` varchar(32) default '' comment '裙子名称',
  `dress_store` varchar(32) default '' comment '裙子店家名称',
  `small_name` varchar(32) default '' comment '小物名称',
  `small_store` varchar(32) default '' comment '小物店家名称',
  `shoes_name` varchar(32) default '' comment '鞋子名称',
  `shoes_store` varchar(32) default '' comment '鞋子店家名称',
  `ctime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `mtime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table `market` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) not null,
  `type` int(11) not null comment '',
  `style` varchar(100) default '' comment '风格类型',
  `title` varchar(100) default '' comment '',
  `content` text not null,
  `pic` int default 0 comment '是否有图片',
  `price` int default 0,
  `ctime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `mtime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


create table `purchase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) not null,
  `type` int(11) not null comment '',
  `object_id` int(11) not null comment '',
  `ctime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `mtime` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
