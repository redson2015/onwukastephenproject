

DROP TABLE IF EXISTS Booking, Module, Course, Room,Building, Campus, Tutor, User;

CREATE TABLE User(
User_Id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
LastName VARCHAR(255),
FirstName VARCHAR(255),
Title VARCHAR(10),
Email VARCHAR(255),
password VARCHAR(255),
JobRole VARCHAR(50),
AccessLevel VARCHAR(4),
UNIQUE (Email)
) DEFAULT CHARACTER SET utf8;

CREATE TABLE Tutor(
Tutor_ID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
User_Id int,
officeHours VARCHAR(500),
Photo BLOB,
FOREIGN KEY (User_Id) REFERENCES User(User_ID)
)DEFAULT CHARACTER SET utf8;

CREATE TABLE Campus(
Campus_ID int NOT NULL PRIMARY KEY,
CampusName VARCHAR(255)
)DEFAULT CHARACTER SET utf8;

CREATE TABLE Building(
Building_ID int NOT NULL AUTO_INCREMENT PRIMARY KEY, 
BuildingNmae VARCHAR(50),
campus_ID int NOT NULL,
FOREIGN KEY (Campus_ID) REFERENCES Campus(Campus_ID)
) DEFAULT CHARACTER SET utf8;

CREATE TABLE Room(
Room_Id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
Building_ID int NOT NULL,
RoomName VARCHAR(50),
RoomType VARCHAR(25),
Facility VARCHAR(500),                
SeatingLayout VARCHAR(10),
Capicity int,
FOREIGN KEY (Building_ID) REFERENCES Building(Building_ID)
)DEFAULT CHARACTER SET utf8;

CREATE TABLE Course(
Course_ID VARCHAR(255) NOT NULL PRIMARY KEY,
CourseName VARCHAR(255)
) DEFAULT CHARACTER SET utf8;

CREATE TABLE Module(
Module_Id VARCHAR(255) NOT NULL PRIMARY KEY,
ModuleName VARCHAR(255),
Course_ID VARCHAR(255) NOT NULL,
FOREIGN KEY (Course_ID) REFERENCES Course(Course_ID)
) DEFAULT CHARACTER SET utf8;

CREATE TABLE Booking (
Booking_Id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
User_Id int NOT NULL,
Room_Id int NOT NULL,
Module_Id VARCHAR(255),
BookingDate DATE NOT NULL,
TimeStarting TIME NOT NULL,
DateBooked date NOT NULL,
Notes VARCHAR(500),
Authorised tinyint(1) DEFAULT '3',
FOREIGN KEY (Room_Id) REFERENCES Room(Room_Id),
FOREIGN KEY (User_Id) REFERENCES User(User_Id),
FOREIGN KEY (Module_Id) REFERENCES Module(Module_Id)
) DEFAULT CHARACTER SET utf8;