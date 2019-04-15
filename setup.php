<?php
$completed = false;

if($_SERVER['REQUEST_METHOD'] === 'POST' 
	&& isset($_REQUEST['password']) 
	&& $_REQUEST['password'] === 'password') {
							// db host // db username // db password
	$connection = new Mysqli('localhost:3306', 'root', 'root');
	if(!$connection || $connection->error) {
		die('Connection failed.');
	}
	//AFTER THE CONNECTION CREATE DABASE FOR APPLICATION 
	//WHICH IS SUPPOSED TO BE "db_college_project"
	$connection->query('CREATE DATABASE IF NOT EXISTS `db_college_project`');

	$connection->select_db('db_college_project');


	/*Table structure for table `users` */
	$create_table_users = "CREATE TABLE `users` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `cur_id` varchar(10) NOT NULL,
	  `first_name` varchar(100) NOT NULL,
	  `last_name` varchar(100) NOT NULL,
	  `business_name` varchar(100) DEFAULT NULL,
	  `job_title` varchar(100) DEFAULT NULL,
	  `email` varchar(100) NOT NULL,
	  `username` varchar(255) DEFAULT NULL,
	  `phone` varchar(20) DEFAULT NULL,
	  `password` varchar(255) NOT NULL,
	  `role` enum('user','admin','moderator','contributor') DEFAULT 'user',
	  `profile_img` varchar(255) DEFAULT NULL,
	  PRIMARY KEY (`id`),
	  UNIQUE KEY `email` (`email`),
	  KEY `first_name` (`first_name`)
	) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;";

	$connection->query($create_table_users);

	/*Data for the table `users` */
	$insert_into_users =  "insert  into`users`
	(`cur_id`,`first_name`,`last_name`,
	`business_name`,`job_title`,`email`,
	`username`,`phone`,`password`,`role`,
	`profile_img`) 
	values (
	'CUR-000001',
	'Basanta',
	'Tajpuriya',
	'Softwarica College',
	'Student',
	'basanta@gmail.com',
	'basanta',
	'9817916444',
	'7507239f3c3eb689db85a29151c0cf5bb5f4a1fd',
	'admin',
	'assets/img/users/01john_doe.jpg'
	)";

	$connection->query($insert_into_users);


	/*Table structure for table `address` */
	$create_table_addresses = "CREATE TABLE `address` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `add1` varchar(100) NOT NULL,
	  `add2` varchar(100) DEFAULT NULL,
	  `zip` varchar(10) DEFAULT NULL,
	  `city` varchar(100) NOT NULL,
	  `state` varchar(100) DEFAULT NULL,
	  `provience` varchar(100) DEFAULT NULL,
	  `country` varchar(100) DEFAULT NULL,
	  PRIMARY KEY (`id`),
	  KEY `city` (`city`),
	  KEY `add1` (`add1`)
	) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;";

	$connection->query($create_table_addresses);

	/*Data for the table `address` */
	$insert_into_addresses = "insert  into `address`
	(`id`,`add1`,`add2`,`zip`,`city`,`state`,`provience`,`country`) 
	values 
	(1,'Bhrikuti Mandap Mall',NULL,'44600','Kathmandu',NULL,NULL,'Nepal')";

	$connection->query($insert_into_addresses);


	/*Table structure for table `events` */
	$create_table_events = "CREATE TABLE `events` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `slug` varchar(255) NOT NULL,
	  `title` varchar(255) NOT NULL,
	  `category` varchar(150) DEFAULT NULL,
	  `start_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
	  `end_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
	  `org` varchar(200) DEFAULT NULL,
	  `address_id` int(11) DEFAULT NULL,
	  `description` longtext NOT NULL,
	  PRIMARY KEY (`id`),
	  UNIQUE KEY `slug` (`slug`),
	  KEY `address_id` (`address_id`),
	  KEY `title` (`title`),
	  KEY `category` (`category`),
	  CONSTRAINT `events_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`)
	) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;";

	$connection->query($create_table_events);

	/*Data for the table `events` */
	$insert_into_events = "insert  into `events`
	(`id`,`slug`,`title`,`category`,`start_date`,
	`end_date`,`org`,`address_id`,`description`) 
	values (1,'appsec-europe','APPSEC EUROPE',
	'Annual conference',
	'2019-04-18 00:00:00','2019-04-19 00:00:00',
	'Open Web Application Security Project (OWASP)',
	1,
	'AppSec Europe is an annual conference hosted');";

	$connection->query($insert_into_events);


	/*Table structure for table `user_interests` */
	$create_table_user_interests = "CREATE TABLE `user_interests` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `title` varchar(200) NOT NULL,
	  `user_id` int(11) DEFAULT NULL,
	  PRIMARY KEY (`id`),
	  KEY `user_id` (`user_id`),
	  CONSTRAINT `user_interests_ibfk_1` 
	  FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
	) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;";

	$connection->query($create_table_user_interests);


	/*Table structure for table `bookings` */

	$create_table_bookings = "CREATE TABLE `bookings` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `event_id` int(11) DEFAULT NULL,
	  `user_id` int(11) DEFAULT NULL,
	  `full_name` varchar(200) NOT NULL,
	  `email` varchar(100) NOT NULL,
	  `phone` varchar(20) NOT NULL,
	  `booking_date` date DEFAULT NULL,
	  `seat` int(11) DEFAULT NULL,
	  PRIMARY KEY (`id`),
	  KEY `event_id` (`event_id`),
	  KEY `user_id` (`user_id`),
	  CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`event_id`) 
	  REFERENCES `events` (`id`) ON DELETE SET NULL,
	  CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`user_id`) 
	  REFERENCES `users` (`id`) ON DELETE SET NULL
	) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8";

	$connection->query($create_table_bookings);

	/*Data for the table `bookings` */
	$insert_into_bookings = "insert  into `bookings`
	(`id`,`event_id`,`user_id`,
	`full_name`,`email`,`phone`,`booking_date`,`seat`) 
	values 
	(1,1,NULL,'Basanta Tajpuriya','basanta@gmail.com',
	'9817916444','2019-04-11',2)";

	$connection->query($insert_into_bookings);

	/*Table structure for table `services` */
	$create_table_services = "CREATE TABLE `services` (
	  `id` int(11) NOT NULL AUTO_INCREMENT,
	  `slug` varchar(255) DEFAULT NULL,
	  `title` varchar(255) NOT NULL,
	  `description` longtext,
	  `file_path` varchar(255) DEFAULT NULL,
	  `img_path` varchar(255) DEFAULT NULL,
	  PRIMARY KEY (`id`),
	  UNIQUE KEY `slug` (`slug`)
	) ENGINE=InnoDB DEFAULT CHARSET=utf8";

	$connection->query($create_table_services);

	$completed = true;
	echo 'setup is completed...';
}
if(!$completed):
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Setup | Curiouse Cybersecurity</title>
</head>
<body>
	
</body>
</html>
<script>
	let password = prompt('Enter password for authentication');
	if (!password) {
		location.reload();
	} else {
		let form = document.createElement('form');
		form.action = '/setup.php';
		form.method = 'post';
		form.innerHTML = '<input type="hidden" name="password" value="'+ password +'">';
		document.body.appendChild(form);
		form.submit();
	}
</script>

<?php endif; ?>