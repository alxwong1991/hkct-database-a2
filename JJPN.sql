
create database if not exists `JJPN`;
use  `JJPN`;

show databases;

show tables;
describe`location`;

create table `location`(
`locationid` int(11) not null primary key,
`name` varchar(20) not null,
`contact` varchar(8) not null,
`address` varchar(255),
`district` varchar(50)

) charset=utf8;

create table `NGYIKLOK`(
	`demoInt` varchar(20)
);

DROP table `NGYIKLOK`;

create table `NGYIKLOK2`(
	`demoInt` varchar(20)
);