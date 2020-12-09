drop database if exists slika;
create database slika default character set utf8;
#c:\xampp\mysql\bin\mysql.exe -uspoljo -pcaau.99F --default_character_set=utf8 < "D:\PP20\inchootest\slika.sql"
use slika;


create table user(
    id              int not null primary key auto_increment,
    name            varchar(50) not null,
    email           varchar(50) not null ,
    pass            char(60) not null,
    role            int not null,
    unique key      unique_email (email)

);

create table picture(
    id          int not null primary key auto_increment,
    picpath     varchar(200) not null,
    name        varchar(100) not null,
    user_id     int not null
);

create table role(
    id          int not null primary key auto_increment,
    name        varchar(20) not null
);


alter table picture add foreign key(user_id) references user(id) on DELETE CASCADE;
alter table user add foreign key(role) references role(id);

insert into role(id,name) values 
(null, 'Administrator'),
(null, 'Subscriber');
