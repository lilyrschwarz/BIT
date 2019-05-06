# inserting into applications
INSERT INTO users VALUES 
  # Systems Administrator
  ("SA", "Dietrich", "Reidenbaugh", "123456", "dreidenbaugh@gwu.edu", 5),
  # Graduate Secretary
  ("GS", "Dawn", "Ginetti", "123456", "dawn@gwu.edu", 6),
  # Faculty Reviewer
  ("FR", "Bhagi", "Narahari", "123456", "narahari@gwu.edu", 10),
  # Chair of Admissions Comm
  ("CAC", "John", "Smith" ,"123456", "jsmith@gmail.com", 42142172),
  # Applicants
  ("A", "John", "Lennon", "plsletmein", "john_lennon@gmail.com", 55551111),
  ("A", "Ringo", "Starr", "Apply!", "ringostarr@gmail.com", 66666666),
  ("A", "Louis", "Armstrong", "123456", "larm@gmail.com", 00001234),
  ("A", "Aretha", "Franklin", "123456", "frank@gmail.com", 00001235),
  ("A", "Carlos", "Santana", "123456", "santa@gmail.com", 00001236);




# insert personal data for applicants
INSERT INTO personal_info VALUES
  ("John", "Lennon", 55551111, "123 Main St", "New York", "NY", "23321", "8604626594", 111111111),
  ("Ringo", "Starr", 66666666, NULL, NULL, NULL, NULL, NULL, 222111111),
  ("Louis", "Armstrong", 00001234, NULL, NULL, NULL, NULL, NULL, 555111111),
  ("Aretha", "Franklin", 00001235, NULL, NULL, NULL, NULL, NULL, 666111111),
  ("Carlos", "Santana", 00001236, NULL, NULL, NULL, NULL, NULL, 777111111);
  


INSERT INTO academic_info VALUES 
(55551111, "MS", "Computer Science", "bioinformatics research", "FA", 2019, true, true, false),
(66666666, "MS", "Civil Engineering", "research", "FA", 2019, true, false, false),
(00001234, "MS", "Aerospace", "track and field", "FA", 2017, true, true, false),
(00001235, "MS", "Music", "singing, performace", "FA", 2017, true, true, false),
(00001236, "PHD", "mathematics", "consulting", "FA", 2017, true, true, false);




INSERT INTO rec_letter (fname, lname, email, institution, uid, recommendation) VALUES ("Reco", "Mendor", "recommend@gmail.com", "GWU", 55551111, "This applicant is satisfactory.");
INSERT INTO gre VALUES (157, 162, 2018, 150, "mathematics", 100, 2018, 55551111);
INSERT INTO prior_degrees (gpa, year, university, major, uid, deg_type) VALUES (3.6, 2017, "GWU", "Computer Science", 55551111, "BS");

#INSERT INTO app_review (uid, reviewerRole) VALUES (66666666, "FR");
INSERT INTO app_review (uid, reviewerRole, reviewerID) VALUES (66666666, "CAC", 42142172);
INSERT INTO app_review (uid, reviewerRole, status, reviewerID) VALUES (55551111, "CAC", 5, 42142172);
INSERT INTO app_review (uid, reviewerRole, status, reviewerID) VALUES (00001234, "CAC", 8, 42142172);
INSERT INTO app_review (uid, reviewerRole, status, reviewerID) VALUES (00001235, "CAC", 10, 42142172);
INSERT INTO app_review (uid, reviewerRole, status, reviewerID) VALUES (00001236, "CAC", 10, 42142172);



# Ringo's application (incomplete)
#INSERT INTO academic_info (uid, transcript, recletter) VALUES (66666666, false, false);


#Insert into registration system

insert into room VALUES
	(1, 24, "SEH", 1300),
	(2, 24, "SEH", 1400),
	(3, 24, "SEH", 1450),
	(4, 80, "SMPA", 404),
	(5, 80, "SMPA", 405),
	(6, 80, "SMPA", 204),
	(7, 80, "SMPA", 205),
	(8, 60, "SMPA", 210),
	(9, 60, "SMPA", 410),
	(10, 30, "SEH", 4040),
	(11, 30, "SEH", 3040),
	(12, 30, "SEH", 5040);

insert into user (fname, lname, street, city, state, zip, phone, email, password, active, type, isAdvisor, isReviewer)VALUES
	("Richard", "Sear", "Wisconsin Ave", "Washington", "DC", 20052, "0123456789", "searri@gwu.edu", "123456", "yes", "MS", NULL, NULL),
	("Rachell", "Kim", "I Street", "Washington", "DC", 20052, "1234567890", "rachell@gwu.edu", "123456", "yes", "MS", NULL, NULL),
	("Selin", "Onal", "Pennsylvania Ave", "Washington", "DC", 20052, "2345678901", "selingonal@gwu.edu", "123456", "no", "PHD", NULL, NULL),
	("Maya", "Shende", "Wisconsin Ave", "Washington", "DC", 20052, "3456789012", "shende@gwu.edu", "123456", "yes", "inst", NULL, NULL),
	("Dietrich", "Reidenbaugh", "Pennsylvania Ave", "Washington", "DC", 20052, "4567890123", "dreidenbaugh@gwu.edu", "123456", "yes", "admin", NULL, NULL),
	("Dawn", "Ginetti", "Franklin St", "Arlington", "VA", 22201, "5678901234", "dawn@gwu.edu", "123456", "yes", "secr", NULL, NULL),
	("Aylin", "Caliskan", "Wisconsin Ave", "Washington", "DC", 20052, "6789012345", "caliskan@gwu.edu", "123456", "yes", "inst", NULL, NULL),
	("Timothy", "Wood", "Wisconsin Ave", "Washington", "DC", 20052, "7890123456", "timwood@gwu.edu", "123456", "yes", "inst", NULL, "yes"),
	("Abdou", "Youssef", "Wisconsin Ave", "Washington", "DC", 20052, "8901234567", "youssef@gwu.edu", "123456", "yes", "inst", NULL, NULL),
	("Bhagi", "Narahari", "Wisconsin Ave", "Washington", "DC", 20052, "9012345678", "narahari@gwu.edu", "123456", "yes", "inst", "yes", "yes"),
	("Pablo", "Bolton", "Wisconsin Ave", "Washington", "DC", 20052, "0012345678", "pablo@gwu.edu", "123456", "yes", "inst", NULL, NULL),
	("Poorvi", "Vora", "Wisconsin Ave", "Washington", "DC", 20052, "112345678", "vora@gwu.edu", "123456", "yes", "inst", NULL, "yes"),
	("Hyeong-Ah", "Choi", "Wisconsin Ave", "Washington", "DC", 20052, "112345678", "hyah@gwu.edu", "123456", "yes", "inst", NULL, NULL),
	("Gabriel", "Parmer", "Wisconsin Ave", "Washington", "DC", 20052, "112345678", "gabe@gwu.edu", "123456", "yes", "inst", "yes", NULL),
	("Rachelle", "Heller", "Wisconsin Ave", "Washington", "DC", 20052, "112345678", "heller@gwu.edu", "123456", "yes", "inst", NULL, "yes");






insert into course (dept, courseno, name, credits, prereq1, prereq2, day, tme, section, year, semester, instructor, location)
VALUES
	("CSCI", 6221, "SW Paradigms", 3,  null, null, "M", "1500-1730",1,2019,"Spring",13,1), 
	("CSCI", 6461, "Computer Architecture", 3, null, null, "T", "1500-1730",1,2019,"Spring",10,1), 
	("CSCI", 6212, "Algorithms", 3, null, null, "W", "1500-1700",1,2019,"Spring",13,1), 
	("CSCI", 6220, "Machine Learning", 3, null, null, null, null,null,null,null,null,null), 
	("CSCI", 6232, "Networks 1", 3, null, null, "M", "1800-2030",1,2019,"Spring",13,2), 
	("CSCI", 6233, "Networks 2", 3, "CSCI 6232", null, "T", "1800-2030",1,2019,"Spring",8,2), 
	("CSCI", 6241, "Database 1", 3, null, null, "W", "1800-2030",1,2019,"Spring",8,2), 
	("CSCI", 6242, "Database 2", 3, "CSCI 6241", null, "R", "1800-2030",1,2019,"Spring",8,2), 
	("CSCI", 6246, "Compilers", 3, "CSCI 6461", "CSCI 6212", "T", "1500-1730",1,2019,"Spring",8,3), 
	("CSCI", 6260, "Multimedia", 3, null, null, "R", "1800-2030",1,2019,"Spring",4,3), 
	("CSCI", 6251, "Cloud Computing", 3, "CSCI 6461", null, "M", "1800-2030",1,2019,"Spring",7,6), 
	("CSCI", 6254, "SW Engineering", 3, "CSCI 6221", null,"M", "1530-1800",1,2019,"Spring",9,3), 
	("CSCI", 6262, "Graphics 1", 3, null, null,"W", "1800-2030",1,2019,"Spring",7,4), 
	("CSCI", 6283, "Security 1", 3, "CSCI 6212", null, "T", "1800-2030",1,2019,"Spring",4,3), 
	("CSCI", 6284, "Cryptography", 3, "CSCI 6212", null, "M", "1800-2030",1,2019,"Spring",12,10), 
	("CSCI", 6286, "Network Security", 3, "CSCI 6283", "CSCI 6232", "W", "1800-2030",1,2019,"Spring",11,10), 
	("CSCI", 6325, "Algorithms 2", 3, "CSCI 6212", null, null, null,null,null,null,null,null), 
	("CSCI", 6339, "Embedded Systems", 3, "CSCI 6461", "CSCI 6212", "R", "1600-1830",1,2019,"Spring",11,10), 
	("CSCI", 6384, "Cryptography 2", 3, "CSCI 6284", null, "W", "1500-1730",1,2019,"Spring",10,10), 
	("ECE", 6241, "Communication Theory", 3, null, null, "M", "1800-2030",1,2019,"Spring",4,11), 
	("ECE", 6242, "Information Theory", 2, null, null, "T", "1800-2030",1,2019,"Spring",9,11), 
	("MATH", 6210, "Logic", 2, null, null,"W", "1800-2030",1,2019,"Spring",12,9),
	("CSCI", 6212, "Algorithms", 3, null, null, "W", "1500-1700",1,2018,"Fall",9,1),
	("CSCI", 6232, "Networks 1", 3, null, null, "M", "1800-2030",1,2018,"Fall",10,2),
	("CSCI", 6233, "Networks 2", 3, "CSCI 6232", null, "T", "1800-2030",1,2018,"Fall",11,2),
	("CSCI", 6220, "Machine Learning", 3, null, null, null, null,null,2018,"Fall",null,null),
	("CSCI", 6325, "Algorithms 2", 3, "CSCI 6212", null, null, null,null,2018,"Fall",null,null);


insert into transcript (uid, grade, crn)
VALUES
	(1,"A",23),
	(1,"A",24),
	(1,"A-",25),
	(2,"B+",23),
	(2,"B",24),
	(2,"B-",25),
	(3,"C+",26),
	(3,"C",27);

insert into user (fname, lname, uid, password, type) VALUES ("Eric", "Clapton", "77777777", "123456", "alum");
insert into user (fname, lname, uid, password, type, isReviewer) VALUES ("John", "Smith", "42142172", "123456", "inst", "yes");

insert into user (fname, lname, uid, password, type, active, admit_semester, admit_year) values 
	('Billie', 'Holiday', 88888888, '123456', 'MS', 'yes', 'FA', 2018), 
	('Diana', 'Krall', 99999999, '123456', 'MS', 'yes', 'FA', 2019),
	('Eva', 'Cassidy', 87654321, '123456', 'MS', 'yes', 'FA', 2017),
	('Jimi', 'Hendrix', 45678901, '123456', 'MS', 'yes', 'FA', 2017),
	('Paul', 'McCartney', 55555555, '123456', 'MS', 'yes', 'FA', 2017),
	('George', 'Harrison', 66666666, '123456', 'MS', 'yes', 'FA', 2016),
	('Stevie', 'Nicks', 12345678, '123456', 'PHD', 'yes', 'FA', 2017),
	('Kurt', 'Cobain', 34567890, '123456', 'alum', 'no', NULL, NULL);

insert into user (fname, lname, uid, password, type, active, admit_semester, admit_year, advising_hold) values 
('Ella', 'Fitzgerald', 23456789, '123456', 'PHD', 'yes', 'FA', 2019, 'yes');




insert into transcript (uid, grade, crn) values 
	(88888888, 'IP', 2),
	(88888888, 'IP', 3),
	(87654321, 'A', 1),
	(87654321, 'A', 3),
	(87654321, 'A', 2),
	(87654321, 'A', 5),
	(87654321, 'A', 6),
	(87654321, 'A', 15),
	(87654321, 'A', 16),
	(87654321, 'C', 7),
	(87654321, 'C', 9),
	(87654321, 'C', 13),
	(45678901, 'A', 1),
	(45678901, 'A', 3),
	(45678901, 'A', 2),
	(45678901, 'A', 5),
	(45678901, 'A', 6),
	(45678901, 'A', 15),
	(45678901, 'A', 16),
	(45678901, 'A', 7),
	(45678901, 'B', 20),
	(45678901, 'B', 21),
	(45678901, 'B', 22),
	(55555555, 'A', 1),
	(55555555, 'A', 3),
	(55555555, 'A', 2),
	(55555555, 'A', 5),
	(55555555, 'A', 6),
	(55555555, 'B', 7),
	(55555555, 'B', 9),
	(55555555, 'B', 13),
	(55555555, 'B', 14),
	(55555555, 'B', 8),
	(66666666, 'C', 21),
	(66666666, 'B', 1),
	(66666666, 'B', 2),
	(66666666, 'B', 3),
	(66666666, 'B', 5),
	(66666666, 'B', 6),
	(66666666, 'B', 7),
	(66666666, 'B', 8),
	(66666666, 'B', 14),
	(66666666, 'B', 15),
	(12345678, 'A', 1),
	(12345678, 'A', 3),
	(12345678, 'A', 2),
	(12345678, 'A', 5),
	(12345678, 'A', 6),
	(12345678, 'A', 15),
	(12345678, 'A', 16),
	(12345678, 'B', 7),
	(12345678, 'B', 9),
	(12345678, 'B', 13),
	(12345678, 'B', 14),
	(12345678, 'B', 8),
	(77777777, 'B', 1),
	(77777777, 'B', 3),
	(77777777, 'B', 2),
	(77777777, 'B', 5),
	(77777777, 'B', 6),
	(77777777, 'B', 7),
	(77777777, 'B', 8),
	(77777777, 'A', 14),
	(77777777, 'A', 15),
	(77777777, 'A', 16),
	(34567890, 'A', 1),
	(34567890, 'A', 3),
	(34567890, 'A', 2),
	(34567890, 'A', 5),
	(34567890, 'A', 6),
	(34567890, 'A', 7),
	(34567890, 'A', 14),
	(34567890, 'A', 15),
	(34567890, 'A', 16),
	(34567890, 'B', 8),
	(34567890, 'B', 11),
	(34567890, 'B', 12);


#Insert into advising sysyem
insert into thesis values
    (76666667, null, null);

insert into loginusers values
     /*given the following 2*/
    ('student', 1, '123456'),/*Paul McCartney*/
    ('student', 2, '123456'),/*George Harrison*/
    ('student', 3, '123456'),/*George Harrison*/
    ('student', 88888888, '123456'),
    ('student', 99999999, '123456'),
    ('student', 23456789, '123456'),
    ('student', 87654321, '123456'),
    ('student', 45678901, '123456'),
    ('student', 55555555, '123456'),
    ('student', 66666666, '123456'),
    ('student', 12345678, '123456'),




    #('student', 66666667, '123456'),
    #('student', 76666667, '123456'),
    ('graduate_secretary', 6 , '123456'),
    ('systems_administrator', 5,  '123456'),
    ('advisor', 10, '123456'), /*Narahari*/
    ('advisor', 12, '123456'), /*Vora*/
    #('alumni', 65656565, '2222'),
    ('alumni', 77777777, '123456'),
    ('alumni', 34567890, '123456');

    #('alumni', 88888888, '8888');
    

insert into advisor values
    (10,  'Narahari'),
    (12, 'Vora'),
    (14, 'Parmer');

insert into student values
    ( 1, 'Richard', 'Sear', 'Wisconsin Ave', 'searri@gwu.edu',"0123456789", 'Masters', 10, 3.3750, null, 0, 0, null),
    ( 2, 'Rachell', 'Kim', 'Wisconsin Ave', 'rachellkim@gwu.edu', "0123456789", 'Masters', 12, 2.8888, null, 0, 0, null),
    ( 3, 'Selin', 'Onal', 'Wisconsin Ave', 'selingonal@gwu.edu', "0123456789", 'PhD', 12, 2.8888, null, 0, 0, null),
    (88888888, 'Billie', 'Holiday', 'Somewhere, someplace', 'lol@school.edu', "0123456789", 'Masters', 12, null, null, 1, 0, null),
    (99999999, 'Diana', 'Krall', 'Somewhere, someplace', 'lol@school.edu', "0123456789", 'Masters', 12, null, null, 0, 0, null),
    (23456789, 'Ella', 'Fitzgerald', 'Somewhere, someplace', 'lol@school.edu', '8604626594', 'PhD', 10, null, null, 0, 0, null),
    (87654321, 'Eva', 'Cassidy', 'Somewhere, someplace', 'lol@school.edu', '8604626594', 'Masters', 10, null, null, 0, 0, null),
    (45678901, 'Jimi', 'Hendrix', 'Somewhere, someplace', 'lol@school.edu', '8604626594', 'Masters', 10, null, null, 0, 0, null),
    (55555555, 'Paul', 'McCartney', 'Somewhere, someplace', 'lol@school.edu', '8604626594', 'Masters', 10, null, null, 0, 0, null),
    (66666666, 'George', 'Harrison', 'Somewhere, someplace', 'lol@school.edu', '8604626594', 'Masters', 14, null, null, 0, 0, null),
    (12345678, 'Stevie', 'Nicks', 'Somewhere, someplace', 'lol@school.edu', '8604626594', 'PhD', 10, null, null, 0, 0, null);

insert into alumni values
    (77777777, 'Eric', 'Clapton', 'Somewhere, Pittsburgh', 'vic@school.edu', 1234567, 'Masters', 10, 2014, 'spring'),
    (34567890, 'Kurt', 'Cobain', 'Somewhere, Pittsburgh', 'vic@school.edu', 1234567, 'PhD', 10, 2014, 'spring');



insert into systems_administrator values
    (5);

insert into graduate_secretary values
    (6);
