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
	studentid INT,
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
    PRIMARY KEY (queueid),
    FOREIGN KEY (sessionid) REFERENCES session(sessionid)
);

CREATE TABLE studentsession (
	studentid INT ,
	sessionid INT ,
    FOREIGN KEY (sessionid) REFERENCES session(sessionid),
    FOREIGN KEY (studentid) REFERENCES student(studentid)
    
);

INSERT INTO staff ( staffid, name, username, password, role, contactnumber, email)
VALUES ( 1, "John Brown", "admin", "admin", "admin", '0412345678', "johnbrown@gmail.com"),
       ( 2, "Amy Smith", "staff01", "staff01", "teacher", '0412345999', "amysmith@gmail.com"),
       (3, 'JohnDoe', 'John Doe', 'JohnDoe', 'Teacher', 123456789, 'JohnDoe@google.com'),
       (4, 'AliceSmith', 'Alice Smith', 'AliceSmith', 'Teacher', 987654321, 'AliceSmith@google.com'),
       (5, 'BobJohnson', 'Bob Johnson', 'BobJohnson', 'Teacher', 555123456, 'BobJohnson@google.com'),
       (6, 'EvaSmith', 'Eva Smith', 'EvaSmith', 'Teacher', 555987654, 'EvaSmith@google.com'),
       (7, 'DanielBrown', 'Daniel Brown', 'DanielBrown', 'Administrator', 789123456, 'DanielBrown@google.com'),
       (8, 'SophiaJohnson', 'Sophia Johnson', 'SophiaJohnson', 'Teacher', 987654321, 'SophiaJohnson@google.com');

INSERT INTO student ( studentid, name, username, password, fees, contactnumber, email)
VALUES ( 100, "John Wick", "johnwick", "johnwick", 1000.00, '0412378912', "johnwick@gmail.com"),
       ( 101, "Ramesh Brown", "rameshbrown", "rameshbrown", 1200.00, '0456789012', "rameshbrown@gmail.com");

INSERT INTO speciality (staffid, speciality) VALUES
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
    (8, 'French'),
    (8, 'Political Science'),
    (8, 'Engineering'),
    (8, 'Environmental Science'),
    (8, 'Philosophy');



-- Add data to the timetable table for one week
INSERT INTO timetable (date, time) VALUES
    ('2023-11-01', '15:00:00'),
    ('2023-11-01', '16:00:00'),
    ('2023-11-01', '17:00:00'),
    ('2023-11-01', '18:00:00'),
    ('2023-11-02', '15:00:00'),
    ('2023-11-02', '16:00:00'),
    ('2023-11-02', '17:00:00'),
    ('2023-11-02', '18:00:00'),
    ('2023-11-03', '15:00:00'),
    ('2023-11-03', '16:00:00'),
    ('2023-11-03', '17:00:00'),
    ('2023-11-03', '18:00:00'),
    ('2023-11-04', '15:00:00'),
    ('2023-11-04', '16:00:00'),
    ('2023-11-04', '17:00:00'),
    ('2023-11-04', '18:00:00'),
    ('2023-11-05', '15:00:00'),
    ('2023-11-05', '16:00:00'),
    ('2023-11-05', '17:00:00'),
    ('2023-11-05', '18:00:00'),
    ('2023-11-06', '15:00:00'),
    ('2023-11-06', '16:00:00'),
    ('2023-11-06', '17:00:00'),
    ('2023-11-06', '18:00:00'),
    ('2023-11-07', '15:00:00'),
    ('2023-11-07', '16:00:00'),
    ('2023-11-07', '17:00:00'),
    ('2023-11-07', '18:00:00');


-- Adding staffids to each teachersession record
INSERT INTO teachersessions (date, time, staffid, speciality) VALUES
    ('2023-11-01', '15:00:00', 2, 'Mathematics'),
    ('2023-11-01', '16:00:00', 2, 'English Literature'),
    ('2023-11-01', '17:00:00', 3, 'History'),
    ('2023-11-01', '18:00:00', 3, 'Art and Design'),
    ('2023-11-02', '15:00:00', 4, 'Music'),
    ('2023-11-02', '16:00:00', 4, 'Biology'),
    ('2023-11-02', '17:00:00', 5, 'Chemistry'),
    ('2023-11-02', '18:00:00', 5, 'Geography'),
    ('2023-11-03', '15:00:00', 6, 'Computer Science'),
    ('2023-11-03', '16:00:00', 6, 'Physics'),
    ('2023-11-03', '17:00:00', 7, 'Economics'),
    ('2023-11-03', '18:00:00', 7, 'Psychology'),
    ('2023-11-04', '15:00:00', 8, 'Sociology'),
    ('2023-11-04', '16:00:00', 8, 'Spanish'),
    ('2023-11-04', '17:00:00', 8, 'French'),
    ('2023-11-04', '18:00:00', 8, 'Political Science'),
    ('2023-11-05', '15:00:00', 2, 'Engineering'),
    ('2023-11-05', '16:00:00', 2, 'Environmental Science'),
    ('2023-11-05', '17:00:00', 3, 'Philosophy'),
    ('2023-11-05', '18:00:00', 3, 'Mathematics'),
    ('2023-11-06', '15:00:00', 4, 'English Literature'),
    ('2023-11-06', '16:00:00', 4, 'Physics'),
    ('2023-11-06', '17:00:00', 5, 'History'),
    ('2023-11-06', '18:00:00', 5, 'Art and Design'),
    ('2023-11-07', '15:00:00', 6, 'Music'),
    ('2023-11-07', '16:00:00', 6, 'Biology'),
    ('2023-11-07', '17:00:00', 7, 'Chemistry'),
    ('2023-11-07', '18:00:00', 7, 'Geography');
