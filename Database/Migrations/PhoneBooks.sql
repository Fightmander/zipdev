create table phone_books (
  id INT UNSIGNED NOT NULL auto_increment,
  first_name VARCHAR(30) NOT NULL,
  sur_name VARCHAR(30) NOT NULL,
  image varchar(255) NULL ,
    PRIMARY KEY (id)
) ENGINE=INNODB;