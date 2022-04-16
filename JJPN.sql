create database if not exists `JJPN`;
use  `JJPN`;
create table location(
`locationid` int(11) not null,
`name` varchar(20) not null,
`contact` varchar(8) not null,
`address` varchar(255),
`district` varchar(50),
primary key (`locationid`),
) charset=utf8;