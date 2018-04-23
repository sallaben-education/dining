drop table if exists Hours;
drop table if exists Student;
drop table if exists Faculty;
drop table if exists Administrator;
drop table if exists Ratings;
drop table if exists FoodType;
drop table if exists Food;
drop table if exists Users;
drop table if exists DiningHall;


create table Users (
 UserID INT,
 Email VARCHAR(200),
 SignupDate DATETIME NOT NULL,
 Password VARCHAR(255) NOT NULL,
 Name VARCHAR(255) NOT NULL,
 PRIMARY KEY (UserID)
);
create table DiningHall(
 DiningID INT,
 Name VARCHAR(100) NOT NULL,
 SchoolName VARCHAR(100) NOT NULL,
 Price DECIMAL(18,2),
 PRIMARY KEY(DiningID)
);
create table Student (
 UserID INT,
 Declining DECIMAL(18,2),
 Swipes INT,
 PRIMARY KEY(UserID),
 FOREIGN KEY(UserID) REFERENCES Users(UserID) ON DELETE CASCADE
);
create table Administrator(
 UserID INT,
 PIN VARCHAR(255) NOT NULL UNIQUE,
 PRIMARY KEY(UserID),
 FOREIGN KEY(UserID) REFERENCES Users(UserID) ON DELETE CASCADE
);
create table Faculty(
 UserID INT,
 PRIMARY KEY(UserID),
 FOREIGN KEY(UserID) REFERENCES Users(UserID) ON DELETE CASCADE);
create table Hours(
 DiningID INT,
 Day VARCHAR(20),
 TimeOfDay TINYINT,
 Stime TIME NOT NULL,
 Etime TIME NOT NULL,
 PRIMARY KEY(DiningID, Day, TimeOfDay),
 FOREIGN KEY(DiningID) REFERENCES DiningHall(DiningID) ON DELETE CASCADE);
create table Ratings(
 RatingID INT,
 Comment VARCHAR(255),
 FoodRating TINYINT,
 StaffRating TINYINT,
 PriceRating TINYINT,
 CleanRating TINYINT,
 SpeedRating TINYINT,
 DiningID INT,
 UserID INT,
 TotalRating TINYINT NOT NULL,
 Anonymous BOOLEAN NOT NULL,
 Time DATETIME NOT NULL,
 PRIMARY KEY(RatingID),
 FOREIGN KEY(UserID) REFERENCES Users(UserID) ON DELETE CASCADE,
 FOREIGN KEY(DiningID) REFERENCES DiningHall(DiningID) ON DELETE CASCADE
);
create table Food(
 FoodName VARCHAR(100),
 DiningID INT,
 Price DECIMAL(18,2),
 PRIMARY KEY(FoodName, DiningID),
 FOREIGN KEY(DiningID) REFERENCES DiningHall(DiningID) ON DELETE CASCADE
);
create table FoodType(
 FoodName VARCHAR(100),
 Type VARCHAR(100),
 PRIMARY KEY(FoodName),
 FOREIGN KEY(FoodName) REFERENCES Food(FoodName) ON DELETE CASCADE
);
