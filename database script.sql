CREATE DATABASE brightboost_db;

CREATE TABLE staff (
	staffid INT AUTO_INCREMENT,
    username varchar(10) UNIQUE,
    name VARCHAR(255) NOT NULL,
    password VARCHAR(10) NOT NULL,
    role VARCHAR(10) NOT NULL,
    contactnumber int NOT NULL,
    email VARCHAR(100),
    PRIMARY KEY(staffid,email)
);

CREATE TABLE student (
	studentid INT AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    username varchar(30) UNIQUE,    
    password VARCHAR(30) NOT NULL,
    fees DECIMAL(10,2),
    contactnumber int NOT NULL,
    email VARCHAR(100),
    PRIMARY KEY(studentid,email)
);

CREATE TABLE speciality (
    staffid INT,
    speciality VARCHAR(100) NOT NULL,
    PRIMARY KEY(staffid, speciality),
    FOREIGN KEY (staffid) REFERENCES staff(staffid)
);

CREATE TABLE timetable (
    date DATE,
    time TIME,
    PRIMARY KEY (date, time)
);

CREATE TABLE teachersessions (
    date DATE,
    time TIME,
    staffid INT,
    speciality VARCHAR(255),
    FOREIGN KEY (staffid) REFERENCES staff(staffid),
    FOREIGN KEY (speciality) REFERENCES speciality(speciality),
    FOREIGN KEY (date) REFERENCES timetable(date),
    FOREIGN KEY (time) REFERENCES timetable(time)
);

CREATE TABLE session (
	sessionid INT auto_increment,
    date DATE,
    time TIME,
    PRIMARY KEY (sessionid),
    FOREIGN KEY (date) REFERENCES timetable(date),
    FOREIGN KEY (time) REFERENCES timetable(time)
);

CREATE TABLE queue (
	queueid INT auto_increment,
	sessionid INT ,
    studentid INT,
    PRIMARY KEY (queueid),
    FOREIGN KEY (sessionid) REFERENCES session(sessionid)
);

CREATE TABLE studentsession (
	studentid INT ,
	sessionid INT ,
    FOREIGN KEY (sessionid) REFERENCES session(sessionid),
    FOREIGN KEY (studentid) REFERENCES student(studentid)
    
);

CREATE TABLE learning_materials (
  'material_id' int NOT NULL AUTO_INCREMENT,
  'material_name' varchar(255) NOT NULL,
  'material_link' varchar(255) NOT NULL,
  PRIMARY KEY ('material_id')
) 

INSERT INTO staff ( name, username, password, role, contactnumber, email)
VALUES ( "John Brown", "admin", "admin", "admin", '0412345678', "johnbrown@gmail.com"),
       ("Amy Smith", "AmySmith", "AmySmith", "Teacher", '0412345999', "amysmith@gmail.com"),
       ('JohnDoe', 'JohnDoe', 'JohnDoe', 'Teacher', 123456789, 'JohnDoe@google.com'),
       ('AliceSmith', 'AliceSmith', 'AliceSmith', 'Teacher', 987654321, 'AliceSmith@google.com'),
       ('BobJohnson', 'BobJohnson', 'BobJohnson', 'Teacher', 555123456, 'BobJohnson@google.com'),
       ('EvaSmith', 'EvaSmith', 'EvaSmith', 'Teacher', 555987654, 'EvaSmith@google.com'),
       ( 'DanielBrown', 'DanielBrown', 'DanielBrown', 'Admin', 789123456, 'DanielBrown@google.com'),
       ( 'SophiaJohnson', 'SophiaJohnson', 'SophiaJohnson', 'Teacher', 987654321, 'SophiaJohnson@google.com');

INSERT INTO student (  name, username, password, fees, contactnumber, email)
VALUES  ( "John Wick", "johnwick", "johnwick", 1000.00, '0412378912', "johnwick@gmail.com"),
        (  "Ramesh Brown", "rameshbrown", "rameshbrown", 1200.00, '0456789012', "rameshbrown@gmail.com"),
        ("Sarah Johnson", "sarahjohnson", "sarahjohnson", 950.00, '0369874123', "sarahjohnson@gmail.com"),
        ("Michael Smith", "michaelsmith", "michaelsmith", 1100.00, '0498761234', "michaelsmith@gmail.com"),
        ("Emily Davis", "emilydavis", "emilydavis", 1050.00, '0321987654', "emilydavis@gmail.com"),
        ( "David Wilson", "davidwilson", "davidwilson", 1150.00, '0452317890', "davidwilson@gmail.com"),
        ( "Linda Martinez", "lindamartinez", "lindamartinez", 980.00, '0412345678', "lindamartinez@gmail.com"),
        ( "William Thompson", "williamthompson", "williamthompson", 1120.00, '0356789012', "williamthompson@gmail.com"),
        ( "Olivia Harris", "oliviaharris", "oliviaharris", 990.00, '0451298760', "oliviaharris@gmail.com"),
        ( "James Adams", "jamesadams", "jamesadams", 1050.00, '0398765432', "jamesadams@gmail.com"),
        ( "Sophia White", "sophiawhite", "sophiawhite", 1180.00, '0487654321', "sophiawhite@gmail.com"),
        ( "Benjamin Turner", "benjaminturner", "benjaminturner", 1020.00, '0356789123', "benjaminturner@gmail.com"),
        ( "Ava Robinson", "avarobinson", "avarobinson", 950.00, '0412398765', "avarobinson@gmail.com"),
        ( "Jacob Garcia", "jacobgarcia", "jacobgarcia", 1210.00, '0456781230', "jacobgarcia@gmail.com"),
        ( "Mia Perez", "miaperez", "miaperez", 980.00, '0321987654', "miaperez@gmail.com"),
        ( "Elijah Martinez", "elijahmartinez", "elijahmartinez", 1130.00, '0412345678', "elijahmartinez@gmail.com"),
        ( "Charlotte Lewis", "charlottelewis", "charlottelewis", 1000.00, '0398765421', "charlottelewis@gmail.com"),
        ( "Alexander Young", "alexanderyoung", "alexanderyoung", 1080.00, '0356790123', "alexanderyoung@gmail.com"),
        ( "Harper Hall", "harperhall", "harperhall", 950.00, '0451987650', "harperhall@gmail.com"),
        ( "Daniel King", "danielking", "danielking", 1140.00, '0321987657', "danielking@gmail.com"),
        ( "Evelyn Scott", "evelynscott", "evelynscott", 1020.00, '0356789564', "evelynscott@gmail.com"),
        ( "Matthew Nelson", "matthewnelson", "matthewnelson", 1200.00, '0412398765', "matthewnelson@gmail.com"),
        ( "Liam Baker", "liambaker", "liambaker", 970.00, '0456781230', "liambaker@gmail.com"),
        ( "Amelia Adams", "ameliaadams", "ameliaadams", 1030.00, '0321298765', "ameliaadams@gmail.com"),
        ( "Aiden Rivera", "aidenrivera", "aidenrivera", 1170.00, '0487654321', "aidenrivera@gmail.com"),
        ( "Grace Foster", "gracefoster", "gracefoster", 990.00, '0412387654', "gracefoster@gmail.com"),
        ( "Logan Parker", "loganparker", "loganparker", 1100.00, '0356781243', "loganparker@gmail.com");

INSERT INTO speciality (staffid, speciality) 
VALUES
        (2, 'Mathematics'),
        (2, 'English Literature'),
        (2, 'Physics'),
        (3, 'History'),
        (3, 'Art and Design'),
        (4, 'Music'),
        (4, 'Biology'),
        (5, 'Chemistry'),
        (5, 'Geography'),
        (6, 'Computer Science'),
        (6, 'Physics'),
        (6, 'History'),
        (7, 'Economics'),
        (7, 'Psychology'),
        (8, 'Sociology'),
        (8, 'Spanish'),
        (8, 'French');

INSERT INTO timetable (date, time)
VALUES  ('2023-11-04','13:00:00'),
        ('2023-11-04','15:00:00'),
        ('2023-11-06','13:00:00'),
        ('2023-11-06','15:00:00'),
        ('2023-11-07','13:00:00'),
        ('2023-11-07','15:00:00'),
        ('2023-11-08','13:00:00'),
        ('2023-11-08','15:00:00'),
        ('2023-11-09','13:00:00'),
        ('2023-11-09','15:00:00'),
        ('2023-11-10','13:00:00'),
        ('2023-11-10','15:00:00');

INSERT INTO teachersessions (date, time, staffid, speciality) 
VALUES  
        ('2023-11-04','13:00:00', 2, 'English Literature'),
        ('2023-11-04','15:00:00', 2, 'Mathematics'),
        ('2023-11-06','13:00:00', 3, 'History'),
        ('2023-11-06','15:00:00', 3, 'Art and Design'),
        ('2023-11-07','13:00:00', 4, 'Biology'),
        ('2023-11-07','15:00:00', 4 'Music'),
        ('2023-11-08','13:00:00', 5, 'Chemistry'),
        ('2023-11-08','15:00:00', 2, 'Physics'),
        ('2023-11-09','13:00:00', 2, 'Mathematics'),
        ('2023-11-09','15:00:00', 3, 'History'),
        ('2023-11-10','13:00:00', 6, 'Physics'),
        ('2023-11-10','15:00:00', 6, 'Computer Science');

INSERT INTO SESSION (date, time)
VALUES  ('2023-11-04','13:00:00'),
        ('2023-11-04','15:00:00'),
        ('2023-11-06','13:00:00'),
        ('2023-11-06','15:00:00'),
        ('2023-11-07','13:00:00'),
        ('2023-11-07','15:00:00'),
        ('2023-11-08','13:00:00'),
        ('2023-11-08','15:00:00'),
        ('2023-11-09','13:00:00'),
        ('2023-11-09','15:00:00'),
        ('2023-11-10','13:00:00'),
        ('2023-11-10','15:00:00');

INSERT INTO studentsession (studentid, sessionid)
VALUES  (1, 1),
        (2, 1),
        (3, 1),
        (4, 1),
        (5, 2),
        (6, 2),
        (7, 2),
        (8, 2),;


INSERT INTO learning_materials ('material_id', 'material_name', 'material_link') 
VALUES
        (1, 'Mathematics Textbook', 'https://example.com/math_textbook.pdf'),
        (2, 'Physics Lecture Notes', 'https://example.com/physics_notes.pdf'),
        (3, 'Literature Study Guide', 'https://example.com/lit_study_guide.pdf');

CREATE TABLE studentquestions (
    question_id INT AUTO_INCREMENT,
    studentid INT,
    sessionid INT,
    question TEXT,
    submission_time DATETIME,
    PRIMARY KEY (question_id),
    FOREIGN KEY (studentid) REFERENCES student(studentid),
    FOREIGN KEY (sessionid) REFERENCES session(sessionid)
);

