CREATE TABLE `workout_log` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `username` varchar(255) NOT NULL,
 `workout` varchar(255) NOT NULL,
 `points` integer NOT NULL,
 `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `month` integer NOT NULL,
 `year` integer NOT NULL,
 PRIMARY KEY (`id`)
)
