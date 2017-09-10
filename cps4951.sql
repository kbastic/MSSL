-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2016 at 11:16 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cps4951`
--

-- --------------------------------------------------------

--
-- Table structure for table `symptoms`
--

CREATE TABLE IF NOT EXISTS `symptoms` (
`sym_id` mediumint(8) unsigned NOT NULL,
  `user_id` mediumint(8) unsigned NOT NULL,
  `type_id` mediumint(8) unsigned NOT NULL,
  `start_date` date NOT NULL,
  `new_old` varchar(3) NOT NULL,
  `severity` smallint(6) NOT NULL,
  `description` varchar(10000) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `symptoms`
--

INSERT INTO `symptoms` (`sym_id`, `user_id`, `type_id`, `start_date`, `new_old`, `severity`, `description`) VALUES
(1, 1, 2, '2016-01-12', 'New', 2, 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia.\r\n\r\nIt is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.\r\n\r\nThe Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. She packed her seven versalia, put her initial into the belt and made herself on the way. When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Book'),
(3, 1, 6, '2016-02-16', 'Old', 3, 'This is a new symptom trying to edit'),
(12, 1, 5, '2016-03-02', 'Old', 2, 'One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.\r\n\r\nHe lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections. The'),
(13, 1, 6, '2016-03-26', 'Old', 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vehicula diam vitae ex semper maximus eleifend dapibus justo. Ut porta vulputate erat, nec dictum ex facilisis non. Cras elementum egestas elementum. Pellentesque sollicitudin, orci eu mollis molestie, libero ante iaculis ex, sed facilisis ligula tortor ut risus. \r\nInteger interdum justo erat, quis dapibus dolor commodo in. Vivamus pellentesque nibh ut fermentum dictum. Proin mattis posuere lectus vitae placerat. Nam ornare, diam id volutpat commodo, dui orci aliquam lectus, vitae iaculis magna turpis quis magna. Fusce consequat libero vitae arcu gravida vestibulum.'),
(14, 1, 7, '2016-02-11', 'New', 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sit amet tellus odio. Etiam rhoncus eros a aliquam sagittis. In tempus mi placerat scelerisque commodo. Morbi eget velit rutrum, tristique mi sit amet, semper eros. Nunc ornare pharetra nisl quis suscipit. Aenean at urna non diam consequat tincidunt. Pellentesque ultrices erat eu suscipit imperdiet. Donec ut cursus mi. Mauris ligula felis, imperdiet a ante ut, vehicula scelerisque nisi. \r\nVivamus at nisl nisi. Morbi vulputate lectus vitae diam cursus, ut tincidunt felis cursus. Nullam nec nisi dignissim, sodales tortor nec, auctor turpis.Nulla at ipsum pharetra, tempus dui vel, elementum nulla. Cras posuere ex sed neque euismod maximus. Nunc imperdiet turpis sed rhoncus rhoncus. Morbi enim justo, efficitur ut malesuada a, auctor posuere sapien. \r\nCurabitur euismod dui a ante venenatis, sit amet interdum dui consequat. Nulla ut tincidunt nibh, vitae lobortis lacus. Sed sed leo interdum elit sodales venenatis.'),
(15, 1, 5, '2016-01-06', 'Old', 3, 'The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs.\r\n\r\nWaltz, bad nymph, for quick jigs vex! Fox nymphs grab quick-jived waltz. Brick quiz whangs jumpy veldt fox. Bright vixens jump; dozy fowl quack.\r\n\r\nQuick wafting zephyrs vex bold Jim. Quick zephyrs blow, vexing daft Jim. Sex-charged fop blew my junk TV quiz. How quickly daft jumping zebras vex. Two driven jocks help fax my big quiz. Quick, Baz, get my woven flax jodhpurs! "Now fax quiz Jack! " my brave'),
(16, 1, 9, '2016-04-05', 'New', 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ultrices, leo a congue pellentesque, ligula sem tincidunt massa, non gravida magna turpis nec ante. Donec vel arcu ut ligula tristique gravida eu sit amet urna. \r\nVestibulum viverra mi massa mattis ante, in feugiat elit neque vel metus. Aliquam sed sollicitudin enim. Nullam vitae orci id erat imperdiet porta. \r\nIn non est vel lectus laoreet pharetra. Donec tempor placerat lacus id pharetra.'),
(17, 1, 6, '2016-04-14', 'Old', 1, 'The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs.\r\n\r\nWaltz, for quick jigs vex! Fox nymphs grab quick-jived waltz. Brick quiz whangs jumpy veldt fox. Bright vixens jump; dozy fowl quack.\r\n\r\nQuick wafting zephyrs vex bold Jim. Quick zephyrs blow, vexing daft Jim. Sex-charged fop blew my junk TV quiz. How quickly daft jumping zebras vex. Two driven jocks help fax my big quiz. Quick, Baz, get my woven flax jodhpurs! "Now fax quiz Jack! " my brave'),
(18, 1, 2, '2016-04-25', 'Old', 3, 'These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammeled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided.\r\n\r\n     But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted.');

-- --------------------------------------------------------

--
-- Table structure for table `symtype`
--

CREATE TABLE IF NOT EXISTS `symtype` (
  `type_id` mediumint(8) unsigned NOT NULL,
  `category` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `symtype`
--

INSERT INTO `symtype` (`type_id`, `category`) VALUES
(1, 'Vision'),
(2, 'Walking'),
(3, 'Balance'),
(4, 'Bowel/Bladder'),
(5, 'Fatigue'),
(6, 'Coordination'),
(7, 'Pain'),
(8, 'Muscle spasms'),
(9, 'Dizziness'),
(10, 'Cognitive Issues'),
(11, 'Depression'),
(12, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_id` mediumint(8) unsigned NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `pass` char(40) NOT NULL,
  `registration_date` datetime NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `pass`, `registration_date`, `role`) VALUES
(1, 'Kat', 'Bastic', 'kbastic@kean.edu', 'd84f1aa109c3ec131461e2b800fd39f03c19f29a', '2016-02-13 10:59:40', 'USER'),
(2, 'Jane', 'Doe', 'jdoe@kean.edu', 'd35514736146439b7277437016cdb40d7fb65497', '2016-04-24 16:17:03', 'USER');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `symptoms`
--
ALTER TABLE `symptoms`
 ADD PRIMARY KEY (`sym_id`);

--
-- Indexes for table `symtype`
--
ALTER TABLE `symtype`
 ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `symptoms`
--
ALTER TABLE `symptoms`
MODIFY `sym_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
