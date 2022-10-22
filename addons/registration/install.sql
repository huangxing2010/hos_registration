CREATE TABLE IF NOT EXISTS `__PREFIX__registration_department` (
    `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
    `pid` int(10) DEFAULT NULL COMMENT '父id',
    `name` varchar(100) DEFAULT NULL COMMENT '部门名称',
    `image` varchar(255) DEFAULT NULL COMMENT '缩略图',
    `content` text                     COMMENT '内容介绍',
    `weigh` int(10) DEFAULT NULL COMMENT '排序',
    `memo` varchar(100) DEFAULT '' COMMENT '备注',
    `status` enum('normal','hidden','rejected','pulloff') NOT NULL DEFAULT 'normal' COMMENT '状态',
    `createtime` bigint(16) DEFAULT NULL COMMENT '创建时间',
    `updatetime` bigint(16) DEFAULT NULL COMMENT '更新时间',
    `publishtime` bigint(16) DEFAULT NULL COMMENT '发布时间',
    `deletetime` bigint(16) DEFAULT NULL COMMENT '删除时间',
    PRIMARY KEY (`id`),
    KEY `pid` (`pid`)
    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='科室门诊表';


CREATE TABLE IF NOT EXISTS `__PREFIX__registration_doctor` (
    `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
    `did` int(10) DEFAULT NULL COMMENT '门诊ID',
    `name` varchar(100) DEFAULT NULL COMMENT '姓名',
    `content` text                     COMMENT '个人简介',
    `image` varchar(255) DEFAULT NULL COMMENT '缩略图',
    `memo` varchar(100) DEFAULT '' COMMENT '备注',
    `status` enum('normal','hidden','rejected','pulloff') NOT NULL DEFAULT 'normal' COMMENT '状态',
    `createtime` bigint(16) DEFAULT NULL COMMENT '创建时间',
    `updatetime` bigint(16) DEFAULT NULL COMMENT '更新时间',
    `publishtime` bigint(16) DEFAULT NULL COMMENT '发布时间',
    `deletetime` bigint(16) DEFAULT NULL COMMENT '删除时间',
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='医生表';

CREATE TABLE IF NOT EXISTS `__PREFIX__registration_duty` (
    `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
    `user_id` int(10) DEFAULT NULL COMMENT '用户id',
    `doctor_id` int(10) DEFAULT NULL COMMENT '医生id',
    `price` decimal(10,2) unsigned DEFAULT '0.00' COMMENT '价格',
    `dutydate` date DEFAULT NULL COMMENT '上班日期',
    `range` enum('1','2','3') DEFAULT '1' COMMENT '区间值:0=未选择,1=上午,2=下午,3=夜间',
    `createtime` bigint(16) DEFAULT NULL COMMENT '创建时间',
    `updatetime` bigint(16) DEFAULT NULL COMMENT '更新时间',
    `publishtime` bigint(16) DEFAULT NULL COMMENT '发布时间',
    `deletetime` bigint(16) DEFAULT NULL COMMENT '删除时间',
    `memo` varchar(100) DEFAULT '' COMMENT '备注',
    `status` enum('normal','hidden') NOT NULL DEFAULT 'normal' COMMENT '状态',
    PRIMARY KEY (`id`)
    KEY `doctorId` (`doctor_id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='排班表';

CREATE TABLE IF NOT EXISTS `__PREFIX__registration_number` (
    `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
    `start` varchar(20) DEFAULT NULL COMMENT '开始时间',
    `finish` varchar(20) DEFAULT NULL COMMENT '结束时间',
    `dutyrange` enum('1','2','3') DEFAULT '1' COMMENT '区间值:0=未选择,1=上午,2=下午,3=夜间',
    `memo` varchar(100) DEFAULT '' COMMENT '备注',
    `status` enum('normal','hidden') NOT NULL DEFAULT 'normal' COMMENT '状态',
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COMMENT='号源表';