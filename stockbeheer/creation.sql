DROP TABLE IF EXISTS  scans;
CREATE TABLE scans (
	id INT NOT NULL AUTO_INCREMENT,
	barcode  VARCHAR(32),
	scantime TIMESTAMP,
	tag VARCHAR(20),
	PRIMARY KEY(id)
);

DROP TABLE IF EXISTS  products;
CREATE TABLE products (
	barcode  VARCHAR(32) NOT NULL,
	name      VARCHAR(128),
	ptype      INT,
	PRIMARY KEY(barcode)
);

DROP TABLE IF EXISTS producttypes;
CREATE TABLE producttypes (
	id INT NOT NULL AUTO_INCREMENT,
	name      VARCHAR(128),
	stock       INT  NOT NULL DEFAULT 0,
	reorderlevel INT,
	PRIMARY KEY(id)
);

INSERT INTO producttypes (name, stock, reorderlevel) VALUES ("Melk", 10, 2);
INSERT INTO producttypes (name, stock, reorderlevel) VALUES ("Brood", 0, 1);

