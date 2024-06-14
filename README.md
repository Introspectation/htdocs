DATABASE SCHEMA:
CREATE TABLE Video_Table (
    id INT AUTO_INCREMENT PRIMARY KEY,
    link VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    date_added DATE NOT NULL,
    is_deleted BOOLEAN NOT NULL DEFAULT 0
);

CREATE TABLE admin_table (
    username VARCHAR(255) NOT NULL PRIMARY KEY,
    password VARCHAR(255) NOT NULL
);


To insert some admin_table use:
INSERT INTO admin_table
Values ("xxx", "rrr"),(etc);

and to check again select * from whatever the table you are using.

USE CTRL+F5 IF THE PAGE DIDNT LOADED!