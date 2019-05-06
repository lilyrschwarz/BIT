set session foreign_key_checks = 0;

truncate table users;
truncate table student;
truncate table alumni;
truncate table courses;
truncate table advisor;
truncate table systems_administrator;
truncate table graduate_secretary;
truncate table transcript;
truncate table thesis;

insert into thesis values
    (76666667, null, null);

insert into users values
     /*given the following 2*/
    ('student', 55555555, '1111'),/*Paul McCartney*/
    ('student', 66666666, '1111'),/*George Harrison*/
    ('student', 66666667, '1111'),
    ('student', 76666667, '1111'),
    ('graduate_secretary', 12345678 , '7777'),
    ('systems_administrator', 15151515,  '6666'),
    ('advisor', 12121212, '5555'), /*Narahari*/
    ('advisor', 23232323, '1234'), /*Parmer*/
    ('alumni', 65656565, '2222'),
    ('alumni', 77777777, '4444'),
    ('alumni', 88888888, '8888');

insert into student values
    ( 55555555, 'Paul', 'McCartney', 'Somewhere, someplace', 'becky@school.edu', 1234567, 'Masters', '12121212', 3.3750, null, 0, 0, null),
    ( 66666666, 'George', 'Harrison', 'Somewhere, someplace', 'lol@school.edu', 1234567, 'Masters', '23232323', 2.8888, null, 0, 0, null),
    ( 66666667, 'Test', 'GraduatingStudent', 'Somewhere, someplace', 'lol@school.edu', 1234567, 'Masters', '23232323', null, null, 1, 0, null),
    (76666667, 'Testing', 'PhD', 'Somewhere, someplace', 'lol@school.edu', 1234567, 'PhD', '23232323', null, null, 0, 0, null);

insert into alumni values
    ( 77777777, 'Eric', 'Clapton', 'Somewhere, Pittsburgh', 'vic@school.edu', 1234567, 'Masters', '12121212', 2014, 'spring');

insert into transcript values
    ('spring', 2017, 'A', 3, 6221, 'CSCI', 55555555),
    ('spring', 2019, 'IP', 3, 6212, 'CSCI', 55555555),
    ('spring', 2019, 'IP', 3, 6461, 'CSCI', 55555555),
    ('fall', 2018, 'A', 3, 6232, 'CSCI', 55555555),
    ('spring', 2017, 'A', 3, 6233, 'CSCI', 55555555),
    ('fall', 2018, 'B', 3, 6241, 'CSCI', 55555555),
    ('spring', 2018, 'B', 3, 6246, 'CSCI', 55555555),
    ('spring', 2018, 'B', 3, 6262, 'CSCI', 55555555),
    ('spring', 2018, 'B', 3, 6283, 'CSCI', 55555555),
    ('spring', 2018, 'B', 3, 6242, 'CSCI', 55555555),
    ('spring', 2018, 'C', 3, 6244, 'ECE', 66666666),
    ('spring', 2018, 'B', 3, 6221, 'CSCI', 66666666),
    ('spring', 2018, 'B', 3, 6461, 'CSCI', 66666666),
    ('spring', 2018, 'B', 3, 6212, 'CSCI', 66666666),
    ('spring', 2018, 'B', 3, 6232, 'CSCI', 66666666),
    ('spring', 2018, 'B', 3, 6233, 'CSCI', 66666666),
    ('spring', 2018, 'B', 3, 6241, 'CSCI', 66666666),
    ('spring', 2018, 'B', 3, 6242, 'CSCI', 66666666),
    ('spring', 2018, 'B', 3, 6284, 'CSCI', 66666666),
    ('spring', 2014, 'B', 3, 6221, 'CSCI', 77777777),
    ('spring', 2014, 'B', 3, 6461, 'CSCI', 77777777),
    ('spring', 2014, 'B', 3, 6212, 'CSCI', 77777777),
    ('spring', 2014, 'B', 3, 6232, 'CSCI', 77777777),
    ('spring', 2014, 'B', 3, 6233, 'CSCI', 77777777),
    ('fall', 2013, 'B', 3, 6241, 'CSCI', 77777777),
    ('fall', 2013, 'B', 3, 6242, 'CSCI', 77777777),
    ('fall', 2013, 'A', 3, 6283, 'CSCI', 77777777),
    ('fall', 2013, 'A', 3, 6286, 'CSCI', 77777777),
    ('fall', 2013, 'A', 3, 6284, 'CSCI', 77777777),
    ('spring', 2017, 'A', 3, 6221, 'CSCI', 66666667),
    ('spring', 2019, 'A', 3, 6212, 'CSCI', 66666667),
    ('spring', 2019, 'A', 3, 6461, 'CSCI', 66666667),
    ('fall', 2018, 'A', 3, 6232, 'CSCI', 66666667),
    ('spring', 2017, 'A', 3, 6233, 'CSCI', 66666667),
    ('fall', 2018, 'A', 3, 6241, 'CSCI', 66666667),
    ('spring', 2018, 'A', 3, 6246, 'CSCI', 66666667),
    ('fall', 2013, 'A', 3, 6286, 'CSCI', 66666667),
    ('spring', 2018, 'A', 3, 6262, 'CSCI', 66666667),
    ('spring', 2018, 'A', 3, 6283, 'CSCI', 66666667),
    ('spring', 2018, 'A', 3, 6242, 'CSCI', 66666667);
    -- ('spring', 2019, 'B', 3, 6246, 'CSCI', 55555555),
    -- ('spring', 2019, 'B', 3, 6262, 'CSCI', 55555555),
    -- ('spring', 2019, 'B', 3, 6283, 'CSCI', 55555555),
    -- ('spring', 2019, 'B', 3, 6242, 'CSCI', 55555555),
    -- ('spring', 2019, 'C', 3, 6224, 'ECE', 66666666),
    -- ('spring', 2019, 'B', 3, 6221, 'CSCI', 66666666),
    -- ('spring', 2019, 'B', 3, 6461, 'CSCI', 66666666),
    -- ('spring', 2019, 'B', 3, 6212, 'CSCI', 66666666),
    -- ('spring', 2019, 'B', 3, 6232, 'CSCI', 66666666),
    -- ('spring', 2019, 'B', 3, 6233, 'CSCI', 66666666),
    -- ('spring', 2019, 'B', 3, 6241, 'CSCI', 66666666),
    -- ('spring', 2019, 'B', 3, 6242, 'CSCI', 66666666),
    -- ('fall', 2018, 'B', 3, 6283, 'CSCI', 66666666),
    -- ('spring', 2019, 'A', 3, 6284, 'CSCI', 66666666),
    -- ('spring', 2019, 'B', 3, 6221, 'CSCI', 77777777),
    -- ('spring', 2019, 'B', 3, 6461, 'CSCI', 77777777),
    -- ('spring', 2019, 'B', 3, 6212, 'CSCI', 77777777),
    -- ('spring', 2019, 'B', 3, 6232, 'CSCI', 77777777),
    -- ('spring', 2019, 'B', 3, 6233, 'CSCI', 77777777),
    -- ('spring', 2019, 'B', 3, 6241, 'CSCI', 77777777),
    -- ('spring', 2019, 'B', 3, 6242, 'CSCI', 77777777),
    -- ('spring', 2019, 'A', 3, 6283, 'CSCI', 77777777),
    -- ('spring', 2019, 'A', 3, 6286, 'CSCI', 77777777),
    -- ('spring', 2019, 'A', 3, 6284, 'CSCI', 77777777);

insert into courses values
('CSCI', 6221, 'SW Paradigms', 3, null, null, null, null),
('CSCI', 6461, 'Computer Architecture', 3, null, null, null, null),
('CSCI', 6212, 'Algorithms', 3, null, null, null, null),
('CSCI', 6220, 'Machine Learning', 3, null, null, null, null),
('CSCI', 6232, 'Networks 1', 3, null, null, null, null),
('CSCI', 6233, 'Networks 2', 3, 'CSCI', '6232', null, null),
('CSCI', 6241, 'Database 1', 3, null, null, null, null),
('CSCI', 6242, 'Database 2', 3, 'CSCI', '6242', null, null),
('CSCI', 6246, 'Compilers', 3, 'CSCI', '6461', 'CSCI', '6212'),
('CSCI', 6260, 'Multimedia', 3, null, null, null, null),
('CSCI', 6251, 'Cloud Computing', 3, 'CSCI', '6461', null, null),
('CSCI', 6254, 'SW Engineering', 3, 'CSCI', '6221', null, null),
('CSCI', 6262, 'Graphics 1', 3, null, null, null, null),
('CSCI', 6283, 'Security 1', 3, 'CSCI', '6212', null, null),
('CSCI', 6284, 'Cryptography', 3, 'CSCI', '6212', null, null),
('CSCI', 6286, 'Network Security', 3, 'CSCI', '6283', 'CSCI', '6232'),
('CSCI', 6325, 'Algorithms 2', 3, 'CSCI', '6212', null, null),
('CSCI', 6339, 'Embedded Systems', 3,'CSCI',  '6461','CSCI',  '6212'),
('CSCI', 6384, 'Cryptography 2', 3, 'CSCI', '6284', null, null),
('ECE', 6241, 'Communication Theory', 3, null, null, null, null),
('ECE', 6242, 'Information Theory', 2, null, null, null, null),
('MATH', 6210, 'Logic', 2, null, null, null, null);

insert into advisor values
    (12121212,  'Narahari'),
    (23232323, 'Parmer');

insert into systems_administrator values
    (15151515);

insert into graduate_secretary values
    (12345678);
