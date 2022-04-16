CREATE TABLE `Employee`(
	`Name`VARCHAR(255),
    `Dept`VARCHAR(255)
);

SHOW DATABASEs;
USE sql_test;
SHOW TABLES;


insert into `Employee` values ('John','Marketing'), ('Mary', 'Sales'), ('Peter', 'Sales'), ('Andy', 'Marketing'), ('Anne', 'Marketing');

insert into `Employee` values ('John','Sales');

SELECT * FROM `Employee`;

SELECT A.Name FROM Employee A, Employee B Where A.Dept = B.Dept AND B.Name = 'Andy';

SELECT * FROM Employee A, Employee B Where A.Dept = B.Dept AND B.Name = 'Andy';

SELECT Name FROM `Employee` Where Dept = (SELECT `Dept` FROM `Employee` WHERE Name = 'Andy');

SELECT * FROM `Employee` WHERE Name = 'Andy';

SELECT Name FROM `Employee` Where Dept = (SELECT `Dept` FROM `Employee` WHERE Name = 'Andy');

SELECT Name FROM `Employee` Where Dept IN (SELECT `Dept` FROM `Employee` WHERE Name = 'John');

SELECT Name FROM `Employee` Where Dept IN ('Marketing', 'Sales');

SELECT `Dept` FROM `Employee` WHERE Name = 'John';

DROP TABLE `Employee`;