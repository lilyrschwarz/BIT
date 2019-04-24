


/*******************
ADVISING
********************/
--Advising Drop
set session foreign_key_checks = 0;

drop table if exists alumni cascade;
drop table if exists systems_administrator cascade;
drop table if exists graduate_secretary cascade;
--drop table if exists transcript cascade;
drop table if exists student cascade;
drop table if exists advisor cascade;
drop table if exists form1 cascade;
drop table if exists users cascade;
drop table if exists courses cascade;
drop table if exists thesis cascade;

create table thesis (
  university_id int (8),
  FileName varchar (250),
  FilePath varchar (250),
  primary key (university_id)
);

-- create table courses (
--   subject varchar(4),
--   course_num int (5),
--   title varchar (30),
--   credits int (2),
--   prereq_sub1 varchar (4),
--   prereq_1 int (5),
--   prereq_sub2 varchar (4),
--   prereq_2 int (5),
--   primary key (course_num, subject),
--   foreign key (prereq_1, prereq_sub1) references courses(course_num, subject),
--   foreign key (prereq_2, prereq_sub2) references courses(course_num, subject)
-- );

create table loginusers (
  user_type varchar (30),
  university_id int (8),
  password varchar(30),
  primary key (university_id)
);

create table form1 (
  num int AUTO_INCREMENT,
  university_id int (8),
  subject varchar(4),
  course_num int(5),
  primary key (num, university_id),
  foreign key(university_id) references loginusers (university_id)
);

create table advisor (
  university_id int(8),
  name varchar(30),
  primary key (university_id),
  foreign key(university_id) references loginusers (university_id)
);

create table student (
  university_id int (8),
  f_name varchar (30),
  l_name varchar (30),
  address varchar (255),
  email varchar (255),
  phone_num bigint,
  program_type varchar (20),
  advisor int (8),
  GPA float (5, 4),
  total_credits int(5),
  clear_for_grad int (1),
  thesis_approved int (1),
  thesis MEDIUMTEXT,
  primary key (university_id),
  foreign key (advisor) references advisor (university_id),
  foreign key (university_id) references loginusers (university_id)
);



create table alumni (
  university_id int (8),
  f_name varchar (30),
  l_name varchar (30),
  address varchar (255),
  email varchar (255),
  phone_num bigint,
  program_type varchar (20),
  advisor int (8),
  grad_year int (4),
  grad_semester varchar (10),
  primary key (university_id)
);

-- create table transcript (
-- 	semester varchar(6),
-- 	year int(4),
-- 	final_grade varchar(2),
-- 	credits int(2),
-- 	course_num int(5),
-- 	subject varchar(4),
-- 	university_id int(8),
-- 	primary key (semester, year, course_num, university_id),
-- 	foreign key (university_id) references student (university_id)
-- );


create table systems_administrator (
  university_id int(8),
  primary key (university_id),
  foreign key(university_id) references loginusers (university_id)
);

create table graduate_secretary (
  university_id int(8),
  primary key (university_id),
  foreign key(university_id) references loginusers (university_id)
);

set session foreign_key_checks = 1;

/********************
Applications
********************/
--Applications drop
DROP TABLE IF EXISTS rec_review CASCADE;
DROP TABLE IF EXISTS app_review CASCADE;
DROP TABLE IF EXISTS gre CASCADE;
DROP TABLE IF EXISTS prior_degrees CASCADE;
DROP TABLE IF EXISTS rec_letter CASCADE;
DROP TABLE IF EXISTS academic_info CASCADE;
DROP TABLE IF EXISTS personal_info CASCADE;
DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS undertranscript CASCADE;


CREATE TABLE users (
  role varchar(3) NOT NULL,
  fname char(15) NOT NULL,
  lname char(15) NOT NULL,
  password varchar(20) NOT NULL,
  email varchar(50) NOT NULL,
  userID int(8) NOT NULL,
  PRIMARY KEY (userID)
);

CREATE TABLE personal_info (
  fname char(15),
  lname char(15),
  uid int(8) NOT NULL,
  street varchar(20),
  city varchar(20),
  state varchar(2),
  zip int(5),
  phone varchar(10),
  ssn int(9),
  PRIMARY KEY (uid),
  FOREIGN KEY (uid) REFERENCES users(userID)
);

CREATE TABLE academic_info (
  uid int(8) NOT NULL,
  degreeType char(3),
  AOI varchar(30),
  experience varchar(100),
  semester char(2),
  year int(4),
  transcript boolean,
  recletter boolean, 
  PRIMARY KEY (uid),
  FOREIGN KEY (uid) REFERENCES users(userID)
);

CREATE TABLE rec_letter  (
  fname char(15),
  lname char(15),
  email varchar(30),
  institution varchar(30),
  uid int(8) NOT NULL,
  recID int NOT NULL AUTO_INCREMENT,
  recommendation varchar(10000),
  PRIMARY KEY (recID),
  FOREIGN KEY (uid) REFERENCES users(userID)
);

CREATE TABLE app_review (
  uid int(8) NOT NULL,
  reviewID int(8) NOT NULL AUTO_INCREMENT,
  reviewerRole varchar(3),
  comments varchar(100),
  deficiency varchar(20),
  reason char,
  rating int,
  advisor char(30),
  status int NOT NULL DEFAULT 1,  #1-app incomplete, 2-app complete (both t/r pending), 3-transcript pending, 4-letter pending, 5-review pending, 6-admitted without aid, 7-admitted with aid, 8-rejected, 9-admitted
  PRIMARY KEY (reviewID),
  FOREIGN KEY (uid) REFERENCES users(userID)
);

CREATE TABLE rec_review (
  reviewID int(8) NOT NULL, 
  reviewerRole varchar(3),
  rating int,
  generic boolean, 
  credible boolean, 
  uid int(8) NOT NULL,
  PRIMARY KEY (recID, reviewerRole),
  FOREIGN KEY (uid) REFERENCES users(userID),
  recID int,
  FOREIGN KEY (recID) REFERENCES rec_letter(recID),
  FOREIGN KEY (reviewID) REFERENCES app_review(reviewID)
);

CREATE TABLE gre (
  verbal int,
  quant int,
  year int,
  advScore int,
  subject varchar(15),
  toefl int,
  advYear int,
  uid int(8) NOT NULL,
  PRIMARY KEY (uid),
  FOREIGN KEY (uid) REFERENCES users(userID)
);

CREATE TABLE prior_degrees (
  gpa float,
  year int(4),
  university varchar(30),
  major varchar(30),
  uid int(8) NOT NULL,
  deg_type char(3),
  PRIMARY KEY (deg_type, uid),
  FOREIGN KEY (uid) REFERENCES users(userID)
);

CREATE TABLE undertranscript (
	uid int(8),
	pdf BLOB,
	PRIMARY KEY (uid),
	FOREIGN KEY (uid) REFERENCES users(userID)
);



/********************
Registration
********************/

--Registration Drop
DROP TABLE IF EXISTS transcript CASCADE;
DROP TABLE IF EXISTS course CASCADE;
DROP TABLE IF EXISTS room CASCADE;
DROP TABLE IF EXISTS user CASCADE;

CREATE TABLE user (
  fname varchar(20),
  lname varchar(20),
  uid int(8) auto_increment,
  street varchar(20),
  city varchar(20),
  state varchar(2),
  zip int(5),
  phone varchar(10),
  email varchar(40),
  password varchar(20),
  active varchar(5),
  type varchar(5),
  isAdvisor varchar(3),
  isReviewer varchar(3),
  PRIMARY KEY (uid)
);

CREATE TABLE room (
  roomid int(6),
  cap int(2),
  building varchar(20),
  rmnumber int(4),
  PRIMARY KEY (roomid)
);

CREATE TABLE course (
  semester varchar(6),
  credits int(1),
  section int(2),
  year int(4),
  name varchar(40),
  dept varchar(20),
  courseno int(4),
  prereq1 varchar(20),
  prereq2 varchar(20),
  day varchar(20),
  tme varchar(20),
  instructor int(8),
  crn int(10) auto_increment,
  location int(6),
  PRIMARY KEY (crn),
  foreign key (instructor) references user(uid),
  foreign key (location) references room(roomid)
);

CREATE TABLE transcript (
  uid int(8),
  grade varchar(2),
  crn int(10),
  lineid int auto_increment primary key,
  foreign key (uid) references user(uid),
  foreign key (crn) references course(crn)
);




