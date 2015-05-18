create database if not exists scheduler;
grant all on scheduler.* to 'scheduler_user'@'localhost' identified by '$chedulerp@$$';

use scheduler;

create table if not exists `user` (
    user_id int(11) NOT NULL AUTO_INCREMENT,
    lastname varchar(100) NOT NULL,
    firstname varchar(100) NOT NULL,
    username varchar(100) UNIQUE NOT NULL,
    email_address varchar(255) UNIQUE NOT NULL,
    password varchar(255) NOT NULL,
    PRIMARY KEY (user_id)
);

create table if not exists calendar (
    cal_id int(11) NOT NULL AUTO_INCREMENT,
    user_id int(11) NOT NULL,
    name varchar(100) NOT NULL,
    color varchar(10) NOT NULL,
    date_created datetime NOT NULL,
    PRIMARY KEY (cal_id),
    FOREIGN KEY (user_id) REFERENCES `user` (user_id)
);

create table if not exists event (
    event_id int(11) NOT NULL AUTO_INCREMENT,
    name varchar(100) NOT NULL,
    is_all_day tinyint(1) NOT NULL,
    date_start datetime NOT NULL,
    date_end datetime NOT NULL,
    recurrence_type varchar(100),
    cal_id int(11) NOT NULL,
    date_created datetime NOT NULL,
    PRIMARY KEY (event_id),
    FOREIGN KEY (cal_id) REFERENCES calendar(cal_id)
);

