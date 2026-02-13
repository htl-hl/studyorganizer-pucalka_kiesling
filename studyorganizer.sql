DROP DATABASE IF EXISTS Studyorganizer;
CREATE DATABASE Studyorganizer;
use Studyorganizer;

CREATE TABLE Teacher (
    teacherId int PRIMARY KEY AUTO_INCREMENT,
    name varchar(255),
    is_active BOOLEAN
);

CREATE TABLE User (
    userId int PRIMARY KEY AUTO_INCREMENT,
    username varchar(255),
    password_hash varchar(255),
    created_at Date,
    updated_at Date,
    role ENUM('user', 'admin') DEFAULT 'user'
);

CREATE TABLE Subjects (
    subjectId int PRIMARY KEY AUTO_INCREMENT,
    name varchar(255),
    teacherId int,
    FOREIGN KEY (teacherId) REFERENCES Teacher(teacherId)
);

CREATE TABLE Homework (
    homeworkId int PRIMARY KEY AUTO_INCREMENT,
    title varchar(255),
    description text,
    due_date Date,
    is_done BOOLEAN,
    userId int,
    subejctId int,
    created_at Date,
    updated_at Date
);