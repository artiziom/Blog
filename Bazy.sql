CREATE TABLE `User` (
  `UserID` int PRIMARY KEY,
  `RoleID` int,
  `Username` varchar(200),
  `Password` varchar(200),
  `email` varchar(200)
);

CREATE TABLE `Comments` (
  `CommentID` int PRIMARY KEY,
  `PostsID` int,
  `UserID` int,
  `CreationDate` datetime,
  `Content` varchar(200)
);

CREATE TABLE `Role` (
  `RoleID` int PRIMARY KEY,
  `RoleType` varchar(200)
);

CREATE TABLE `Posts` (
  `PostsID` int PRIMARY KEY,
  `UserID` int,
  `CategoryID` int,
  `Title` varchar(200),
  `CreationDate` datetime,
  `Images` varchar(200),
  `Content` varchar(200)
);

CREATE TABLE `PostsCategory` (
  `CategoryID` int PRIMARY KEY,
  `CategoryType` varchar(200)
);
ALTER TABLE parent_table ENGINE=InnoDB;

ALTER TABLE `Comments` ADD FOREIGN KEY (`PostsID`) REFERENCES `Posts` (`PostsID`);

ALTER TABLE `Comments` ADD FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`);

ALTER TABLE `Posts` ADD FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`);

ALTER TABLE `PostsCategory` ADD FOREIGN KEY (`CategoryID`) REFERENCES `Posts` (`CategoryID`);

ALTER TABLE `Role` ADD FOREIGN KEY (`RoleID`) REFERENCES `User` (`RoleID`);
