set session foreign_key_checks = 0;
drop table if exists alumni cascade;
drop table if exists systems_administrator cascade;
drop table if exists graduate_secretary cascade;
drop table if exists transcript cascade;
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

create table courses (
  subject varchar(4),
  course_num int (5),
  title varchar (30),
  credits int (2),
  prereq_sub1 varchar (4),
  prereq_1 int (5),
  prereq_sub2 varchar (4),
  prereq_2 int (5),
  primary key (course_num, subject),
  foreign key (prereq_1, prereq_sub1) references courses(course_num, subject),
  foreign key (prereq_2, prereq_sub2) references courses(course_num, subject)
);

create table users (
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
  foreign key(university_id) references users (university_id)
);

create table advisor (
  university_id int(8),
  name varchar(30),
  primary key (university_id),
  foreign key(university_id) references users (university_id)
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
  foreign key (university_id) references users (university_id)
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

create table transcript (
	semester varchar(6),
	year int(4),
	final_grade varchar(2),
	credits int(2),
	course_num int(5),
	subject varchar(4),
	university_id int(8),
	primary key (semester, year, course_num, university_id),
	foreign key (university_id) references student (university_id)
);


create table systems_administrator (
  university_id int(8),
  primary key (university_id),
  foreign key(university_id) references users (university_id)
);

create table graduate_secretary (
  university_id int(8),
  primary key (university_id),
  foreign key(university_id) references users (university_id)
);

set session foreign_key_checks = 1;
