create database Scheduler;

--create tables

create table User(
    uID int NOT NULL AUTO_INCREMENT,
    lastName varchar(255),
    firstName varchar(255),
    username varchar(255),
    emailAddress varchar(255),
    PRIMARY KEY (uID)
);

create table Calendar(
    calID int NOT NULL AUTO_INCREMENT,
    calName
    calColor
    PRIMARY KEY (uID),
    FOREIGN KEY (calID) REFERENCES User(uID)
);

create table Event(
    
);

