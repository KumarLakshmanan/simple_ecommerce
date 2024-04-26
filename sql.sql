
		-- $rooms = array(
		-- 	1 => [
		-- 		'name' => "Open Ward Bedroom",
		-- 		'cost' => 40,
		-- 		'available' => true,
		-- 	],
		-- 	2 => [
		-- 		'name' => "Open Ward Bedroom",
		-- 		'cost' => 40,
		-- 		'available' => true,
		-- 	],
		-- 	3 => [
		-- 		'name' => "Open Ward Bedroom",
		-- 		'cost' => 40,
		-- 		'available' => true,
		-- 	],
		-- 	4 => [
		-- 		'name' => "Open Ward Bedroom",
		-- 		'cost' => 40,
		-- 		'available' => true,
		-- 	],
		-- 	5 => [
		-- 		'name' => "Open Ward Bedroom",
		-- 		'cost' => 40,
		-- 		'available' => true,
		-- 	],
		-- 	6 => [
		-- 		'name' => "Open Ward Bedroom",
		-- 		'cost' => 40,
		-- 		'available' => true,
		-- 	],
		-- 	7 => [
		-- 		'name' => "Open Ward Bedroom",
		-- 		'cost' => 40,
		-- 		'available' => true,
		-- 	],
		-- 	8 => [
		-- 		'name' => "Open Ward Bedroom",
		-- 		'cost' => 40,
		-- 		'available' => true,
		-- 	],
		-- 	9 => [
		-- 		'name' => "Open Ward Bedroom",
		-- 		'cost' => 40,
		-- 		'available' => true,
		-- 	],
		-- 	10 => [
		-- 		'name' => "Open Ward Bedroom",
		-- 		'cost' => 40,
		-- 		'available' => true,
		-- 	],
		-- 	11 => [
		-- 		'name' => "Open Ward Bedroom",
		-- 		'cost' => 40,
		-- 		'available' => true,
		-- 	],
		-- 	12 => [
		-- 		'name' => "Open Ward Bedroom",
		-- 		'cost' => 40,
		-- 		'available' => true,
		-- 	],
		-- 	13 => [
		-- 		'name' => "Open Ward Bedroom",
		-- 		'cost' => 40,
		-- 		'available' => true,
		-- 	],
		-- 	14 => [
		-- 		'name' => "Open Ward Bedroom",
		-- 		'cost' => 40,
		-- 		'available' => true,
		-- 	],
		-- 	15 => [
		-- 		'name' => "Open Ward Bedroom",
		-- 		'cost' => 40,
		-- 		'available' => true,
		-- 	],
		-- 	16 => [
		-- 		'name' => "Private Bedroom",
		-- 		'cost' => 40,
		-- 		'available' => true,
		-- 	],
		-- 	17 => [
		-- 		'name' => "Private Bedroom",
		-- 		'cost' => 40,
		-- 		'available' => true,
		-- 	],
		-- 	18 => [
		-- 		'name' => "Private Bedroom",
		-- 		'cost' => 40,
		-- 		'available' => true,
		-- 	],
		-- 	19 => [
		-- 		'name' => "Private Bedroom",
		-- 		'cost' => 40,
		-- 		'available' => true,
		-- 	],
		-- 	20 => [
		-- 		'name' => "Private Bedroom",
		-- 		'cost' => 40,
		-- 		'available' => true,
		-- 	],
		-- 	21 => [
		-- 		'name' => "Private Bedroom",
		-- 		'cost' => 40,
		-- 		'available' => true,
		-- 	],
		-- 	22 => [
		-- 		'name' => "Private Bedroom",
		-- 		'cost' => 40,
		-- 		'available' => true,
		-- 	],
		-- 	23 => [
		-- 		'name' => "Private Bedroom",
		-- 		'cost' => 40,
		-- 		'available' => true,
		-- 	],
		-- 	24 => [
		-- 		'name' => "Private Bedroom",
		-- 		'cost' => 40,
		-- 		'available' => true,
		-- 	],
		-- 	25 => [
		-- 		'name' => "Private Bedroom",
		-- 		'cost' => 40,
		-- 		'available' => true,
		-- 	],
			
		-- );

CREATE TABLE rooms (
	id INT(6) AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) NOT NULL,
	cost INT(6) NOT NULL,
	available BOOLEAN NOT NULL,
	current_occupant INT(6) DEFAULT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO rooms (name, cost, available) VALUES ('Open Ward Bedroom', 40, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Open Ward Bedroom', 40, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Open Ward Bedroom', 40, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Open Ward Bedroom', 40, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Open Ward Bedroom', 40, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Open Ward Bedroom', 40, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Open Ward Bedroom', 40, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Open Ward Bedroom', 40, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Open Ward Bedroom', 40, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Open Ward Bedroom', 40, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Open Ward Bedroom', 40, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Open Ward Bedroom', 40, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Open Ward Bedroom', 40, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Open Ward Bedroom', 40, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Open Ward Bedroom', 40, 1);

INSERT INTO rooms (name, cost, available) VALUES ('Private Bedroom', 50, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Private Bedroom', 50, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Private Bedroom', 50, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Private Bedroom', 50, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Private Bedroom', 50, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Private Bedroom', 50, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Private Bedroom', 50, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Private Bedroom', 50, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Private Bedroom', 50, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Private Bedroom', 50, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Private Bedroom', 50, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Private Bedroom', 50, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Private Bedroom', 50, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Private Bedroom', 50, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Private Bedroom', 50, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Private Bedroom', 50, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Private Bedroom', 50, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Private Bedroom', 50, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Private Bedroom', 50, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Private Bedroom', 50, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Private Bedroom', 50, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Private Bedroom', 50, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Private Bedroom', 50, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Private Bedroom', 50, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Private Bedroom', 50, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Private Bedroom', 50, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Private Bedroom', 50, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Private Bedroom', 50, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Private Bedroom', 50, 1);
INSERT INTO rooms (name, cost, available) VALUES ('Private Bedroom', 50, 1);

-- The Clinical Centre has 5 treatment rooms (i.e. numbers 1-5), 6 -15 are open ward bedrooms and 16 - 45 are private bedrooms. When patients visit the clinic, the clinic manager books them into any available room they request. The clinic manager records the patients’ names and personal details along with the payee’s credit card details. The payee’s details are entered as PRIVATE if the patient is the payee or the name of the company. The cost of visiting a doctor and receiving treatment in the treatment room is £40. Each treatment room is managed by a doctor and two staff nurses. The cost of a private bedroom is £40 and £40 for the open ward bedroom per week.
CREATE TABLE bookings (
	id INT(6) AUTO_INCREMENT PRIMARY KEY,
	room_id INT(6) NOT NULL,
	patient_name VARCHAR(255) NOT NULL,
	patient_address VARCHAR(255) NOT NULL,
	patient_phone VARCHAR(255) NOT NULL,
	patient_email VARCHAR(255) NOT NULL,
	payee_type ENUM('PERSONAL', 'COMPANY') NOT NULL,
	payee_name VARCHAR(255) NOT NULL,
	card_number VARCHAR(255) NOT NULL,
	expiry_year INT(4) NOT NULL,
	expiry_month INT(2) NOT NULL,
	cvc INT(3) NOT NULL,
	card_name VARCHAR(255) NOT NULL,
	created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

ALTER TABLE bookings ADD COLUMN room_name VARCHAR(255) NOT NULL;
ALTER TABLE bookings ADD COLUMN room_cost INT(6) NOT NULL;

ALTER TABLE bookings ADD COLUMN check_in TIMESTAMP DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE bookings ADD COLUMN check_out TIMESTAMP DEFAULT CURRENT_TIMESTAMP;