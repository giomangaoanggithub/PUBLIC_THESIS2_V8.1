-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2023 at 11:34 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `essay_speed_checker_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_teacher_conn`
--

CREATE TABLE `admin_teacher_conn` (
  `a_t_c_id` int(11) NOT NULL,
  `admin_email` text NOT NULL,
  `teacher_email` text NOT NULL,
  `connection` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_teacher_conn`
--

INSERT INTO `admin_teacher_conn` (`a_t_c_id`, `admin_email`, `teacher_email`, `connection`) VALUES
(1, 'newgioadmin@gmail.com', 'gioteacher@gmail.com', 1),
(6, 'newgioadmin@gmail.com', 'gioteacher215@gmail.com', 1),
(12, 'newgioadmin@gmail.com', 'migstheman@gmail.com', -1),
(13, 'newgioadmin@gmail.com', 'migstheman@gmail.com', 0),
(14, 'newgioadmin@gmail.com', 'newteacher@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE `classrooms` (
  `room_id` int(11) NOT NULL,
  `room_name` text NOT NULL,
  `room_code` text NOT NULL,
  `owner_email` text NOT NULL,
  `company_src` text NOT NULL,
  `deletion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classrooms`
--

INSERT INTO `classrooms` (`room_id`, `room_name`, `room_code`, `owner_email`, `company_src`, `deletion`) VALUES
(1, 'Science Room', '_vje3452JN3467EUk', 'scienceteacher@gmail.com', 'none', 0),
(2, 'English Room', '_gkl72242JN3467fer', 'englishteacher@gmail.com', 'none', 0),
(3, 'New Room Made', 'room_code_yada', 'gioteacher@gmail.com', 'newgioadmin@gmail.com', 0),
(4, 'Another New Room Made', 'another yada yada', 'gioteacher@gmail.com', 'newgioadmin@gmail.com', 0),
(9, 'Newly Room', 'qqwdqwqwd', 'gioteacher@gmail.com', 'newgioadmin@gmail.com', 0),
(10, 'generated', 'room', 'gioteacher@gmail.com', 'newgioadmin@gmail.com', 0),
(11, 'fam', 'fam', 'gioteacher@gmail.com', 'newgioadmin@gmail.com', 0),
(12, 'New room by me', 'qq', 'gioteacher@gmail.com', 'newgioadmin@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `company_id` int(11) NOT NULL,
  `company_name` text NOT NULL,
  `company_admin_email` text NOT NULL,
  `company_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`company_id`, `company_name`, `company_admin_email`, `company_code`) VALUES
(1, 'NEW MDPS', 'newgioadmin@gmail.com', 'stored_code'),
(2, 'New Company', 'new@gmail.com', 'new_code'),
(3, 'lol', 'lol@gmail.com', 'lol_code'),
(4, 'qq', 'gioteacherqq215@gmail.com', ''),
(5, 'New Company Yada', 'adminan@gmail.com', 'lordoftherings'),
(6, 'New Admin Company', 'adminan@gmail.com', ''),
(16, 'Testing Comp', 'testing@gmail.com', ''),
(17, 'Pizza Company', 'parker@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `created_questions`
--

CREATE TABLE `created_questions` (
  `question_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `HPS` int(11) NOT NULL,
  `time_of_issue` datetime NOT NULL DEFAULT current_timestamp(),
  `due_date` datetime DEFAULT NULL,
  `owner_teacher` text NOT NULL,
  `classroom_id` text NOT NULL,
  `publish` int(11) NOT NULL,
  `checking_param` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `created_questions`
--

INSERT INTO `created_questions` (`question_id`, `question`, `HPS`, `time_of_issue`, `due_date`, `owner_teacher`, `classroom_id`, `publish`, `checking_param`) VALUES
(1, 'What happened to the story of the three little pigs?', 50, '2023-02-12 06:23:44', '2023-03-24 23:59:00', 'englishteacher@gmail.com', '2', 0, '<!@#CORRECT$%^>'),
(3, 'Is distance the same as displacement? Explain Why?', 20, '2023-02-12 06:23:44', '2023-03-24 23:59:00', 'scienceteacher@gmail.com', '1', 0, '<!@#CORRECT$%^>'),
(4, 'Which house that hasn\'t blown off by the big bad wolf?', 15, '2023-02-12 06:23:44', '2023-03-24 23:59:00', 'englishteacher@gmail.com', '2', 0, '<!@#CORRECT$%^>'),
(5, 'yolo', 60, '2023-02-12 13:29:16', '2023-03-24 23:59:00', 'gioteacher@gmail.com', '3', 1, '<!@#CORRECT$%^>'),
(6, 'yolo doggo', 20, '2023-02-12 14:20:44', '2023-03-24 23:59:00', 'gioteacher@gmail.com', '4', 0, '<!@#CORRECT$%^>'),
(29, 'eee', 15, '2023-02-20 22:22:21', '2023-03-24 23:59:00', 'gioteacher@gmail.com', '4', 0, '<!@#CORRECT$%^>'),
(30, 'finally', 10, '2023-02-20 22:46:34', '2023-03-24 23:59:00', 'gioteacher@gmail.com', '3', 1, '<!@#CORRECT$%^>'),
(31, 'lol', 65, '2023-02-20 22:56:54', '2023-03-24 23:59:00', 'gioteacher@gmail.com', '3', 0, '<!@#CORRECT$%^>'),
(32, 'testing123', 100, '2023-02-20 23:20:00', '2023-03-24 23:59:00', 'gioteacher@gmail.com', '3', 0, '<!@#CORRECT$%^>'),
(64, 'This is a simulated question. What is Speed, Velocity, Distance and Displacement', 45, '0000-00-00 00:00:00', '3000-03-20 00:00:00', 'gioteacher@gmail.com', '3', 1, '<!@#CORRECT$%^><&*>0<&*>0<&*>0<&*>0<&*>0<&*>0<&*>0<&*>Speed refers to an object travel distance over time, while velocity is basically speed with an inclusion of direction or known as a vector. As for the distance and displacement, both are similar, but the core difference is that the distance tells how much ground an object has covered, while displacement shows how far out of place an object is.<&*>Speed  and  distance  are  scalar  quantities,  in  other  words,  they  only  consider  size,  while  speed  and  displacement  are  vector  quantities,  which  consider  not  only  size  but  also  direction  of  the  object.  <&*>Speed  and  distance  are  scalar  quantities,  in  other  words,  they  only  consider  size,  while  speed  and  displacement  are  vector  quantities,  which  consider  not  only  size  but  also  direction  of  the  object.  <&*>Speed  and  distance  are  scalar  quantities,  in  other  words,  they  only  consider  size,  while  speed  and  displacement  are  vector  quantities,  which  consider  not  only  size  but  also  direction  of  the  object.  <&*>Speed  and  distance  are  scalar  quantities,  in  other  words,  they  only  consider  size,  while  speed  and  displacement  are  vector  quantities,  which  consider  not  only  size  but  also  direction  of  the  object.  <&*>Speed  and  distance  are  scalar  quantities,  in  other  words,  they  only  consider  size,  while  speed  and  displacement  are  vector  quantities,  which  consider  not  only  size  but  also  direction  of  the  object.  <&*>Speed  and  distance  are  scalar  quantities,  in  other  words,  they  only  consider  size,  while  speed  and  displacement  are  vector  quantities,  which  consider  not  only  size  but  also  direction  of  the  object.<&*>Speed  and  distance  are  scalar  quantities,  in  other  words,  they  only  consider  size,  while  speed  and  displacement  are  vector  quantities,  which  consider  not  only  size  but  also  direction  of  the  object.  '),
(69, 'qqwwee', 50, '2023-03-12 11:14:30', '2023-03-24 23:59:00', 'gioteacher@gmail.com', '3', 0, '<!@#CORRECT$%^>'),
(70, 'yo by new teacher', 20, '2023-03-13 21:05:50', '2023-03-24 23:59:00', 'newteacher@gmail.com', '12', 0, '<&^>dfgdfgd  dfgdf  <&^>dfgdfgd  <!@#CORRECT$%^><&*>erferferf  <&*>e  e  <&*>erferferf  ');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semester_id` int(11) NOT NULL,
  `room_code` text NOT NULL,
  `teacher_email` text NOT NULL,
  `student_email` text NOT NULL,
  `semester_start` date NOT NULL,
  `semester_end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_answers`
--

CREATE TABLE `student_answers` (
  `answer_id` int(11) NOT NULL,
  `answer` text NOT NULL,
  `question_id` int(11) NOT NULL,
  `owner_student` text NOT NULL,
  `time_of_submission` datetime NOT NULL DEFAULT current_timestamp(),
  `grades` float NOT NULL,
  `checked` int(11) NOT NULL,
  `system_confidence` int(11) NOT NULL,
  `re_eval` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_answers`
--

INSERT INTO `student_answers` (`answer_id`, `answer`, `question_id`, `owner_student`, `time_of_submission`, `grades`, `checked`, `system_confidence`, `re_eval`) VALUES
(1, 'The third house, which is made out of bricks, unlike the first and the second house, built with straws and sticks respectively.', 4, 'giostudent111@gmail.com', '2023-02-16 16:52:36', 0, 0, -1, 0),
(2, 'To answer it simply, the process of calculating the distance and displacement is not the same.', 3, 'giostudent@gmail.com', '2023-02-16 16:52:36', 0, 0, -1, 0),
(3, 'it\'s a yolo response by student.', 5, 'giostudent@gmail.com', '2023-02-16 16:52:36', 0, 0, -1, 0),
(4, 'It\'s a yolo doggo response by a student. Another set of words to simulate a paragraph filled with sentence. As a programmer, I hate to deal with in making stuff up but atleast I tried to make it happen.', 6, 'giostudent215@gmail.com', '2023-02-16 16:52:36', 0, 0, -1, 0),
(5, 'Another simulation to try the array of array', 5, 'random_student@gmail.com', '2023-02-17 03:09:04', 0, 0, -1, 0),
(226, 'Speed refers to an object travel distance over time, while velocity is basically speed with an inclusion of direction or known as a vector. As for the distance and displacement, both are similar, but the core difference is that the distance tells how much ground an object has covered, while displacement shows how far out of place an object is.', 64, 'bot', '2023-02-22 16:09:15', 100, 2, 1, 0),
(227, 'Speed is the amount of space an object covers in a given amount of time, whereas velocity is simply speed plus direction, also referred to as a vector. The difference between distance and displacement is that while both measure how much ground an object has covered, displacement demonstrates how far an object has moved from its original location.', 64, 'bot', '2023-02-22 16:09:15', 100, 2, 1, 0),
(228, 'Speed is the distance an object travels in a unit of time, whereas velocity is speed plus direction, often known as a vector. Although distance and displacement are comparable, they differ primarily in that distance indicates how much ground an object has covered and displacement indicates how far an object has moved from its original location.', 64, 'bot', '2023-02-22 16:09:15', 100, 2, 1, 0),
(229, 'Speed is the distance traveled by an object over time, whereas velocity is speed with the addition of direction, sometimes known as a vector. Distance and displacement are comparable, but the main distinction is that distance informs how much ground an item has covered, whereas displacement shows how far out of position an object is.', 64, 'bot', '2023-02-22 16:09:15', 100, 2, 1, 0),
(230, 'Speed is the distance an item travels over time, whereas velocity is speed plus direction, often known as a vector. Both distance and displacement are comparable, but the main distinction is that distance indicates how much ground an object has covered, whereas displacement indicates how far out of place an object is.', 64, 'bot', '2023-02-22 16:09:15', 100, 2, 1, 0),
(231, 'Speed is the distance traveled by an object over time, whereas velocity is speed plus direction, also known as a vector. Distance and displacement are similar, but the main difference is that distance indicates how much ground an object has covered, whereas displacement indicates how far out ', 64, 'bot', '2023-02-22 16:09:15', 100, 2, 1, 0),
(232, 'Speed refers to how far an object travels in a given time, while velocity describes the speed and direction of an object. The two measures of distance and displacement are similar, but the key difference is that distance shows how much ground an object has covered, while displacement shows how far away an object is from its original location.', 64, 'bot', '2023-02-22 16:09:15', 100, 2, 1, 0),
(233, 'Speed refers to an object travel distance over time, while velocity is basically speed with an inclusion of direction or known as a vector. The distance an object has traveled and the displacement it has caused are both similar, but the core difference is that the distance tells how much ground an object has covered, while displacement shows how far out of place an object is.', 64, 'bot', '2023-02-22 16:09:15', 100, 2, 1, 0),
(234, 'Speed refers to the distance an object travels over time, while velocity is a measure of speed with an inclusion of direction or known as a vector. As for the distance and displacement, both are similar, but the core difference is that the distance tells how much ground an object has covered, while displacement shows how far away from its original location an object is.', 64, 'bot', '2023-02-22 16:09:15', 100, 2, 1, 0),
(235, 'Speed refers to an object travel distance over time, while velocity is basically speed with an inclusion of direction or known as a vector. Regarding the distance and displacement, both are similar, but the core difference is that the distance tells how much ground an object has covered, while displacement shows how far out of place an object is.', 64, 'bot', '2023-02-22 16:09:15', 100, 2, 1, 0),
(236, 'Speed refers to how far an object travels in a short period of time, while velocity is how fast an object is moving in a particular direction. As for the distance and displacement, both are similar, but the core difference is that the distance tells how much ground an object has covered, while displacement shows how far away from its original location an object is.', 64, 'bot', '2023-02-22 16:09:15', 100, 2, 1, 0),
(237, 'Speed refers to an object travel distance over time, while velocity is basically speed with an inclusion of direction or known as a vector. The distance and displacement measurements are both similar, but the core difference is that distance measures how much ground an object has covered, while displacement shows how far out of place an object is.', 64, 'bot', '2023-02-22 16:09:15', 100, 2, 1, 0),
(238, 'Speed and Distance are scalar quantity in other words it only considers the magnitude, while Velocity and Displacement is a vector quantity which not only considers the magnitude, but also the direction of the object.', 64, 'bot', '2023-02-22 16:09:15', 92.58, 2, 1, 0),
(239, 'Speed talks about how fast and velocity also fast but with a sense of route. Distance and Displacement may look the same if we only calculate one line, but with more multiple lines we can easily differ displacement from distance.', 64, 'bot', '2023-02-22 16:09:15', 71.44, 2, 1, 0),
(240, 'If the object heads only from point A to point B without any form of direction then it is scalar value, but if the object has some direction, then it is considered a vector value.', 64, 'bot', '2023-02-22 16:09:15', 55.39, 2, 3, 0),
(241, 'Speed is the amount of space an object covers in a given amount of time, whereas velocity is simply speed plus direction, also referred to as a vector. The difference between distance and displacement is that while both measure how much ground an object has covered, displacement demonstrates how far an object has moved from its original location.', 64, 'bot', '2023-02-22 16:09:15', 100, 2, 1, 0),
(242, 'Speed is the distance an object travels in a unit of time, whereas velocity is speed plus direction, often known as a vector. Although distance and displacement are comparable, they differ primarily in that distance indicates how much ground an object has covered and displacement indicates how far an object has moved from its original location.', 64, 'bot', '2023-02-22 16:09:15', 100, 2, 1, 0),
(243, 'Speed refers to an object travel distance over time, while velocity is basically speed with an inclusion of direction or known as a vector. Regarding the distance and displacement, both are similar, but the core difference is that the distance tells how much ground an object has covered, while displacement shows how far out of place an object is.', 64, 'bot', '2023-02-22 16:09:15', 100, 2, 1, 0),
(244, 'Speed refers to how far an object travels in a short period of time, while velocity is how fast an object is moving in a particular direction. As for the distance and displacement, both are similar, but the core difference is that the distance tells how much ground an object has covered, while displacement shows how far away from its original location an object is.', 64, 'bot', '2023-02-22 16:09:15', 100, 2, 1, 0),
(245, 'Speed refers to an object travel distance over time, while velocity is basically speed with an inclusion of direction or known as a vector. The distance and displacement measurements are both similar, but the core difference is that distance measures how much ground an object has covered, while displacement shows how far out of place an object is.', 64, 'bot', '2023-02-22 16:09:15', 100, 2, 1, 0),
(246, 'Speed and Distance are scalar quantity in other words it only considers the magnitude, while Velocity and Displacement is a vector quantity which not only considers the magnitude, but also the direction of the object.', 64, 'bot', '2023-02-22 16:09:15', 92.58, 2, 1, 0),
(247, 'Speed refers to an object travel distance over period, while velocity is fundamentally speed with an addition of course or known as a heading. As for the distance and dislocation, both are related, but the center difference is that the distance discerns how much ground an object has closed, while displacement shows by virtue of what unusual of place an object is.', 64, 'bot', '2023-02-22 16:09:15', 100, 2, 1, 0),
(248, 'Speed refers to an object travel distance over occasion, while speed is fundamentally speed accompanying an addition of course or famous as a heading. Concerning the distance and dislocation, two together are identical, but the center distinctness is that the distance speaks by means of what much ground an object has hidden, while dislocation shows in what way or manner unusual of place an object is.', 64, 'bot', '2023-02-22 16:09:15', 100, 2, 1, 0),
(249, 'Speed refers to an object travel distance over opportunity, while speed is fundamentally speed accompanying an addition of course or popular as a heading. Concerning the distance and dislocation, two together are analogous, but the center dissimilarity is that the distance speaks by what method much ground an object has marked, while dislocation shows by virtue of what unusual of place an object is.', 64, 'bot', '2023-02-22 16:09:15', 100, 2, 1, 0),
(250, 'Speed refers to an object travel distance over period, while speed is fundamentally speed accompanying an addition of course or famous as a heading. Concerning the distance and dislocation, two together are related, but the center dissimilarity is that the distance understands in what way or manner much ground an object has hidden, while dislocation shows by what method unusual of place an object is.', 64, 'bot', '2023-02-22 16:09:15', 100, 2, 1, 0),
(251, 'Speed refers to an object travel distance over occasion, while speed is fundamentally speed accompanying an addition of management or popular as a heading. Concerning the distance and dislocation, two together are identical, but the gist dissimilarity is that the distance reports by means of what much ground an object has dotted, while dislocation shows in what way or manner unusual of place an object is.', 64, 'bot', '2023-02-22 16:09:15', 100, 2, 1, 0),
(252, 'Speed alludes to an question travel remove over time, whereas speed is essentially speed with an consideration of heading or known as a vector. As for the remove and uprooting, both are comparable, but the center distinction is that the separate tells how much ground an question has secured, whereas uprooting appears how distant out of put an protest is.', 64, 'bot', '2023-02-22 16:09:15', 44.04, 2, 3, 0),
(253, 'Speed and Remove are scalar amount in other words it as it were considers the greatness, whereas Speed and Uprooting may be a vector amount which not as it were considers the greatness, but moreover the course of the question.', 64, 'bot', '2023-02-22 16:09:15', 52.22, 2, 3, 0),
(254, 'Speed and Distance are scalar amount in different phrases it handiest considers the magnitude, even as Velocity and Displacement is a vector amount which now no longer handiest considers the magnitude, however additionally the course of the object.', 64, 'bot', '2023-02-22 16:09:15', 61.24, 2, 1, 0),
(255, 'Speed and Distance are scalar amount in different words it solely considers the magnitude, whereas rate and Displacement could be a vector quantity that not only considers the magnitude, however conjointly the direction of the object.', 64, 'bot', '2023-02-22 16:09:15', 74.54, 2, 1, 0),
(256, 'Speed and distance are scalar quantities, in other words, they only consider size, while speed and displacement are vector quantities, which consider not only size but also direction of the object.', 64, 'bot', '2023-02-22 16:09:15', 100, 1, 1, 0),
(257, 'Speed refers to an object travel distance over period, while speed is fundamentally speed accompanying an addition of course or famous as a heading. Concerning the distance and dislocation, two together are related, but the center dissimilarity is that the distance understands in what way or manner much ground an object has hidden, while dislocation shows by what method unusual of place an object is.', 64, 'bot', '2023-02-22 16:09:15', 100, 2, 1, 0),
(258, 'Speed refers to an object travel distance over occasion, while speed is fundamentally speed accompanying an addition of management or popular as a heading. Concerning the distance and dislocation, two together are identical, but the gist dissimilarity is that the distance reports by means of what much ground an object has dotted, while dislocation shows in what way or manner unusual of place an object is.', 64, 'bot', '2023-02-22 16:09:15', 100, 2, 1, 0),
(259, 'Speed alludes to an question travel remove over time, whereas speed is essentially speed with an consideration of heading or known as a vector. As for the remove and uprooting, both are comparable, but the center distinction is that the separate tells how much ground an question has secured, whereas uprooting appears how distant out of put an protest is.', 64, 'bot', '2023-02-22 16:09:15', 44.04, 2, 3, 0),
(260, 'Speed and Remove are scalar amount in other words it as it were considers the greatness, whereas Speed and Uprooting may be a vector amount which not as it were considers the greatness, but moreover the course of the question.', 64, 'bot', '2023-02-22 16:09:15', 52.22, 2, 3, 0),
(261, 'The ancient Greeks called cake πλακοῦς (plakous), which was derived from the word for \"flat\", πλακόεις (plakoeis). It was baked using flour mixed with eggs, milk, nuts, and honey. They also had a cake called \"satura\", which was a flat heavy cake. During the Roman period, the name for cake became \"placenta\" which was derived from the Greek term. A placenta was baked on a pastry base or inside a pastry case.', 64, 'bot', '2023-02-22 16:09:15', 0, 2, 0, 0),
(262, 'American teenager Peter Parker, a poor sickly orphan, is bitten by a radioactive spider. As a result of the bite, he gains superhuman strength, speed, and agility, along with the ability to cling to walls, turning him into Spider-Man. Parker also acquired a precognitive “spidey-sense” that alerted him to approaching dangers.', 64, 'bot', '2023-02-22 16:09:16', 10.37, 2, 0, 0),
(263, 'When The Flash reaches his destination, he can activate the skill again to return to where he started, dealing magic damage. Enemies damaged by the initial dash are dealt an additional magic damage. Shortly after settling back in Titans Tower, Bart reveals to Conner that during his brief stay in the future, he went through a number of records and schematics concerning technology from the era.', 64, 'bot', '2023-02-22 16:09:16', 0, 2, 0, 0),
(264, 'A dissertation tesis doctoral, with an average of 250 pages, is the main requisite along with typically one previously published journal article. Once candidates have published their written dissertations, they will be evaluated by two external academics evaluadores externos and subsequently it is usually exhibited publicly for fifteen natural days.', 64, 'bot', '2023-02-22 16:09:16', 0, 2, 0, 0),
(265, 'Glory to God in the highest And on earth, peace to people of good will We praise You We bless You We adore You We glorify You We give You thanks for Your great glory Lord God, heavenly king O God, almighty Father Lord Jesus Christ Only begotten Son Lord God, Lamb of God Son of the Father You take away the sins of the world Have mercy on us You take away the sins of the world Receive our prayer You are seated at the right hand of the Father Have mercy on us For You alone are the Holy One You alone are the Lord You alone are the Most High, Jesus Christ With the Holy Spirit In the glory of God, the Father Amen', 64, 'bot', '2023-02-22 16:09:16', 0, 2, 0, 0),
(315, 'Speed is a scalar quantity that measures only distance per second covered by an object. Velocity, same as speed, with an inclusion of direction which makes it as a vector quantity. Distance and Displacement are not the same because distance is scalar while the other is a vector.', 64, 'giostudent@gmail.com', '2023-03-16 22:37:02', 100, 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_student_connection`
--

CREATE TABLE `teacher_student_connection` (
  `t_s_conn_id` int(11) NOT NULL,
  `teacher_email` text NOT NULL,
  `student_email` text NOT NULL,
  `t_s_connection` int(11) NOT NULL,
  `room_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_student_connection`
--

INSERT INTO `teacher_student_connection` (`t_s_conn_id`, `teacher_email`, `student_email`, `t_s_connection`, `room_name`) VALUES
(1, 'gioteacher@gmail.com', 'giostudent@gmail.com', 1, 'New Room Made'),
(2, 'gioteacher215@gmail.com', 'giostudent@gmail.com', 0, '0'),
(3, 'gioteacher@gmail.com', 'giostudent215@gmail.com', 1, 'Another New Room Made'),
(4, 'scienceteacher@gmail.com', 'giostudent@gmail.com', 1, 'Room not really exist'),
(5, 'gioteacher@gmail.com', 'newstudent@gmail.com', 1, 'Newly Room');

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `user_id` int(11) NOT NULL,
  `email` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `contact_number` text NOT NULL,
  `user_role` int(11) NOT NULL,
  `profile_pic_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`user_id`, `email`, `username`, `password`, `contact_number`, `user_role`, `profile_pic_address`) VALUES
(6, 'englishteacher@gmail.com', 'SC teacher', '8228a11d555fd7129be3d7f20f2ac1c1', '09608663386', 1, 'profiles/profile_pic.png'),
(7, 'scienceteacher@gmail.com', 'EN teacher', '8228a11d555fd7129be3d7f20f2ac1c1', '09608663386', 1, 'profiles/profile_pic.png'),
(18, 'newgioadmin@gmail.com', 'Gio UPDATED ADMIN', '8228a11d555fd7129be3d7f20f2ac1c1', '09608663386', 2, 'profiles/gioadmin@gmail.com.jpg'),
(20, 'gioteacher@gmail.com', 'Gio Da Teacher', '8228a11d555fd7129be3d7f20f2ac1c1', '09608663386', 1, 'profiles/gioteacher@gmail.com.jpg'),
(22, 'giostudent@gmail.com', 'Gio Student', '8228a11d555fd7129be3d7f20f2ac1c1', '09608663386', 0, 'profiles/giostudent@gmail.com.jpg'),
(23, 'new@gmail.com', 'Newman', '8228a11d555fd7129be3d7f20f2ac1c1', '09608663386', 2, 'profiles/new@gmail.com.jpg'),
(24, 'lol@gmail.com', 'Lol', '8228a11d555fd7129be3d7f20f2ac1c1', '09608663386', 2, 'profiles/lol@gmail.com.jpg'),
(32, 'gioteacher215@gmail.com', 'Gio 215', '8228a11d555fd7129be3d7f20f2ac1c1', '09608663386', 1, 'profiles/gioteacher215@gmail.com.jpg'),
(33, 'giostudent215@gmail.com', 'Student Gio Yada', '8228a11d555fd7129be3d7f20f2ac1c1', '09608663386', 0, 'profiles/giostudent215@gmail.com.jpg'),
(36, 'adminan@gmail.com', 'Adminanlol', '8228a11d555fd7129be3d7f20f2ac1c1', '09608663386', 2, 'profiles/adminan@gmail.com.jpg'),
(37, 'migstheman@gmail.com', 'Migs', '8228a11d555fd7129be3d7f20f2ac1c1', '09608663382', 1, 'profiles/migstheman@gmail.com.jpg'),
(38, 'bot', 'bot', 'none', '00000000000', 0, 'profiles/bot_pic.png'),
(39, 'newteacher@gmail.com', 'New Teacher', '8228a11d555fd7129be3d7f20f2ac1c1', '09608663386', 1, 'profiles/profile_pic.png'),
(40, 'newstudent@gmail.com', 'New Student', '8228a11d555fd7129be3d7f20f2ac1c1', '09608663386', 0, 'profiles/profile_pic.png'),
(45, 'testing@gmail.com', 'testingqq', '8228a11d555fd7129be3d7f20f2ac1c1', '09608663386', 2, 'profiles/testing@gmail.com.jpg'),
(67, 'sampleteacher@gmail.com', 'sampleteacher', '8228a11d555fd7129be3d7f20f2ac1c1', '09608663386', 1, 'profiles/sampleteacher@gmail.com.jpg'),
(68, 'sampleadmin@gmail.com', 'sampleadmin', '8228a11d555fd7129be3d7f20f2ac1c1', '09608663386', 2, 'profiles/sampleadmin@gmail.com.webp'),
(69, 'samplestudent@gmail.com', 'samplestudent', '8228a11d555fd7129be3d7f20f2ac1c1', '09608663381', 0, 'profiles/samplestudent@gmail.com.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_teacher_conn`
--
ALTER TABLE `admin_teacher_conn`
  ADD PRIMARY KEY (`a_t_c_id`);

--
-- Indexes for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `created_questions`
--
ALTER TABLE `created_questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semester_id`);

--
-- Indexes for table `student_answers`
--
ALTER TABLE `student_answers`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `teacher_student_connection`
--
ALTER TABLE `teacher_student_connection`
  ADD PRIMARY KEY (`t_s_conn_id`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_teacher_conn`
--
ALTER TABLE `admin_teacher_conn`
  MODIFY `a_t_c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `created_questions`
--
ALTER TABLE `created_questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_answers`
--
ALTER TABLE `student_answers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=316;

--
-- AUTO_INCREMENT for table `teacher_student_connection`
--
ALTER TABLE `teacher_student_connection`
  MODIFY `t_s_conn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
