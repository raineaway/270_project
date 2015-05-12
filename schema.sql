CREATE DATABASE Scheduler;

--create tables

CREATE TABLE User(
    uID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    lastName varchar(255),
    firstName varchar(255),
    username varchar(255) NOT NULL,
    emailAddress varchar(255) NOT NULL,
    password varchar(255) NOT NULL
);

CREATE TABLE Calendar(
    calenID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    calenName varchar(255) NOT NULL,
    calenColor varchar(255),
    uID int NOT NULL,
    FOREIGN KEY (uID) REFERENCES User(uID)
);

CREATE TABLE Event(
    eventID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    eventName varchar(255) NOT NULL,
    allDay BOOLEAN NOT NULL DEFAULT 0,
    dateStart DATETIME DEFAULT CURRENT_TIMESTAMP,
    dateEnd DATETIME DEFAULT CURRENT_TIMESTAMP,
    calenID int NOT NULL,
    FOREIGN KEY (calenID) REFERENCES Calendar(calenID)
);
