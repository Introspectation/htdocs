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
Values ("xxx", "rrr"), (işte isim amk);

and to check again select * from whatever the fuck table you are using.

USE CTRL+F5 IF THE PAGE DIDNT LOADED!

INSERT INTO Video_Table (link, description, date_added, is_deleted)
VALUES
('https://www.youtube.com/watch?v=BMrCxp82n6Q', 'Fener beats 6s', '2023-06-01', 0),
('https://www.youtube.com/watch?v=oa3iJkd6_KE', 'Fener beats 6s as 4-1', '2023-06-02', 0),
('https://www.youtube.com/watch?v=8UIf8k3j9XM', 'Bale vs Maicon', '2023-06-03', 0),
('https://www.youtube.com/watch?v=1laF-an-yfM', 'Allah allah dertleri neymiş', '2023-06-03', 0),
('https://www.youtube.com/watch?v=Cz3WcZLRaWc', 'MySQL Tutorial!', '2023-06-03', 1);
