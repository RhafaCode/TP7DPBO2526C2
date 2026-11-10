-- membuat database baru jika belum ada
create database if not exists db_kursus;

-- menggunakan database db_kursus
use db_kursus;

-- membuat tabel categories untuk data kategori
create table categories (
    id int auto_increment primary key,
    name varchar(100) not null,
    description text
);

-- membuat tabel instructors untuk data pengajar
create table instructors (
    id int auto_increment primary key,
    name varchar(100) not null,
    email varchar(100) not null unique,
    phone varchar(20)
);

-- membuat tabel courses dengan foreign key ke categories dan instructors
create table courses (
    id int auto_increment primary key,
    title varchar(150) not null,
    description text,
    price int not null default 0,
    instructor_id int not null,
    category_id int not null,
    foreign key (instructor_id) references instructors(id) on delete cascade,
    foreign key (category_id) references categories(id) on delete cascade
);