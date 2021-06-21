CREATE TABLE IF NOT EXISTS t_sale (
	id INT(11) NOT NULL AUTO_INCREMENT,
	operationDate DATE DEFAULT NULL,
	number VARCHAR(255) DEFAULT NULL,
	label VARCHAR(100) DEFAULT NULL,
	description TEXT DEFAULT NULL,
	clientId INT(12) DEFAULT NULL,
	code VARCHAR(255) DEFAULT NULL,
	created DATETIME DEFAULT NULL,
	createdBy VARCHAR(50) DEFAULT NULL,
	updated DATETIME DEFAULT NULL,
	updatedBy VARCHAR(50) DEFAULT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;