create table phones (
  id INT UNSIGNED NOT NULL auto_increment,
  phone VARCHAR(20) NOT NULL ,
  phone_books_id INT UNSIGNED NOT NULL ,
  PRIMARY KEY (id),
  FOREIGN KEY (phone_books_id) REFERENCES  phone_books (id)
    ON DELETE CASCADE
) ENGINE=INNODB;