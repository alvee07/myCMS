-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 06, 2017 at 06:48 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(4) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_title`) VALUES
(1, 'Category 01'),
(2, 'Category 02'),
(3, 'Category 03'),
(4, 'Category 04');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_post_id` int(11) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_date` datetime NOT NULL,
  `comment_status` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_date`, `comment_status`) VALUES
(1, 5, 'Akash', 'alvee.akash@gmail.com', 'Nice Work, Alvee. Picture really looks awesome.', '2017-04-08 18:32:26', 'submitted'),
(5, 3, 'Akash', 'alvee.akash@gmail.com', 'So true, and so deep.', '2017-04-08 18:33:17', 'approved'),
(7, 1, 'Ibrahim', 'safwon@gmail.com', 'This comment is only for Author named &quot;Akash&quot;', '2017-04-08 20:18:16', 'submitted'),
(8, 6, 'Akash', 'alvee.akash@gmail.com', '24 Hours comment.\r\nYou used to live here.', '2017-04-16 17:11:22', 'approved'),
(9, 7, 'Alvee', 'alvee.akash@gmail.com', 'I know him. He can sing.', '2017-04-16 22:26:24', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `login_id` int(4) NOT NULL,
  `user_id` int(4) NOT NULL,
  `username` varchar(54) NOT NULL,
  `password` varchar(255) NOT NULL,
  `random_salt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `user_id`, `username`, `password`, `random_salt`) VALUES
(1, 1, 'a', '$2y$10$7vT.GqM0XX74fTnyZHPUseC4kTskG/dL6W.6Zc6pEroHSaGfPnWDG', ''),
(2, 2, 'poet', '$2y$10$Sv77Z7i7P7a9rLQBLt0ZgOi5vFlnW0jZEWQeqWHoPodA3o8rnl0Ja', ''),
(3, 3, 'sub', '$2y$10$ns5uMLDfJzmYNu9L/Sb5NuxlH8PMFtFdp9fMpcI/bvKbcLzO/52My', ''),
(14, 14, 'some', '$2y$10$Xk3xV615yK/LJDOmOK3kDetEqE9YLAYGwl00pxOLw92Im0ZU9LZsu', ''),
(15, 15, 'saara', '$2y$10$hX.P1qgpL3FuQx9ZdVMokuU8ghJXux1tHuOVEUXFEe2aerHIa5Z2G', ''),
(16, 16, 'sharmin', '$2y$10$gFb9XW4zlymRRsbwbE3uveZCk9mmJTF304ru5yVwFoRURYrRswL/.', ''),
(17, 17, 'tania', '$2y$10$kj/WkMjKN28ls4X5jLsoTO0qyIz/crUOdk9FA99ZOTB8L/fTS8IcG', ''),
(18, 18, 'sandy', '$2y$10$XrNiUnJb7htl.dcAhtYpOemDyMFlu6/bZVqHhbqR.pJbQLHa/EmAm', ''),
(19, 19, 'dani', '$2y$10$nenQnCiK94p7PF/KDuoM5eiXbzi3.Rw0gjs6fSLgwXskOWcKSgREe', ''),
(20, 20, 'last', '$2y$10$MyRwz1B2S.e5yhkbsUw5tuNUelSehfdHkTQZCNc4KHJgT0z9wSMSa', NULL),
(23, 23, 'one', '$2y$10$Uw34EDkpn/81CxNAEhZ6B.GvBoPFMF6rnZhaw4xDt4uyd.AOXCWvi', NULL),
(25, 25, 'sandy', '$2y$10$w//qxBstpEFU7tM4N8xZ0OS.1upJ9rTj68h4QHvlsHLzdQI78RGnu', NULL),
(26, 26, 'asma', '$2y$10$s39ldRVPiUTRDq34wbP3ROR0xvHv00ivEydoCKyCw4Xd1FOuYZAqS', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(4) NOT NULL,
  `post_cat_id` int(4) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` datetime NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) DEFAULT NULL,
  `post_comments` int(4) NOT NULL,
  `post_status` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_cat_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comments`, `post_status`) VALUES
(1, 1, 'Title 01', 'Author A', '2017-04-06 21:35:22', '1.JPG', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\n\n', 'alvee', 0, 'published'),
(2, 1, 'Title 02', 'Author B', '2017-04-07 12:18:47', '2.jpg', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.\n\n', 'alvee', 0, 'published'),
(3, 2, 'Title 03', 'Author A', '2017-04-06 21:31:08', '3.jpg', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.\n\n', 'alvee', 0, 'published'),
(4, 1, 'Title 04', 'Author C', '2017-04-08 16:09:18', '4.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\n\n', 'tahsin', 0, 'published'),
(5, 2, 'Title 05', 'Author C', '2017-04-07 16:34:22', '5.JPG', 'Proin pretium auctor nibh nec mollis. Quisque sollicitudin placerat nibh vitae pharetra. Praesent pharetra diam a viverra consectetur. Interdum et malesuada fames ac ante ipsum primis in faucibus. Proin urna mi, laoreet ac dapibus et, sollicitudin a elit. Integer bibendum faucibus nisi vitae interdum. Vestibulum sit amet hendrerit risus, sed viverra orci. Ut vitae leo orci. Integer congue magna id diam pharetra, sit amet commodo enim congue. Sed pulvinar, ex nec suscipit tristique, lorem lorem laoreet dui, a iaculis purus diam et est. Suspendisse sed velit sapien. Morbi sapien mauris, euismod nec ullamcorper non, ullamcorper non lorem. Pellentesque interdum quam maximus justo consequat, eget fermentum est pulvinar. Morbi vehicula metus tempor, dapibus lectus a, ultrices dui. Donec ac fringilla urna, placerat viverra diam.\n\n', 'So many works', 0, 'published'),
(6, 3, 'Title 06', 'Author A', '2017-04-16 16:31:50', '6.jpg', 'Donec nec quam vel libero accumsan vehicula. Etiam sed interdum mi, at aliquet mauris. Aenean aliquet scelerisque dui quis malesuada. Praesent tincidunt, mauris et varius sagittis, dolor nulla hendrerit augue, quis tincidunt tellus enim eu neque. Sed convallis nulla sed massa consequat pharetra. Mauris scelerisque, purus eu ultrices commodo, erat est tempor lectus, ut faucibus lectus urna sit amet dui. Nulla maximus nulla eget purus tincidunt, vel interdum quam lacinia. Vestibulum eu urna convallis, dictum nibh vel, suscipit purus. Vestibulum tempus, nunc vel condimentum venenatis, elit metus ultrices tellus, eget pharetra turpis turpis vulputate ante. Suspendisse potenti. Cras a dapibus ex. Aliquam elit neque, commodo sit amet enim nec, dignissim consectetur libero. Aenean nec porttitor libero.\n\n', 'sanjana', 0, 'published'),
(7, 4, 'Title 07', 'Author D', '2017-04-16 22:20:41', '7.JPG', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sit amet faucibus ligula, nec rutrum eros. Ut et quam sed leo dictum tempor. Nullam dapibus est in ultrices laoreet. Vivamus scelerisque, tortor et faucibus sodales, odio arcu mollis odio, fermentum porttitor massa ipsum et lorem. Nunc hendrerit turpis quis ipsum consequat tristique. Phasellus a arcu aliquam, sodales leo eu, gravida sapien. Fusce in est ut justo laoreet euismod at non lacus. Curabitur metus lectus, viverra ut porttitor at, gravida vitae neque. Aliquam quam nisl, tempor nec erat sed, tristique condimentum mi. Suspendisse in libero lorem. Pellentesque aliquet magna quis dapibus scelerisque. Mauris ornare lacinia malesuada. Duis a scelerisque justo. Curabitur consequat euismod neque ut porttitor. Fusce posuere non dui vitae fermentum.\n\n', 'musa', 0, 'published'),
(8, 4, 'Title 08', 'Author D', '2017-04-18 09:58:09', '8.JPG', 'Sed volutpat est vel gravida dignissim. Sed facilisis augue aliquet, ornare tortor ac, euismod turpis. Praesent in lacinia lacus. Vivamus sit amet sem mauris. Ut condimentum turpis id turpis gravida finibus. Maecenas ut elit nec tellus bibendum commodo. Quisque eget augue nisi. Phasellus eu augue molestie, porta velit et, efficitur velit. Nam eget tortor vel urna commodo convallis ut tincidunt lectus. Morbi ornare, ipsum vel placerat pharetra, metus nulla vehicula velit, quis aliquet risus lacus ut turpis. Sed vel rutrum eros, id eleifend nunc. Nam sollicitudin euismod mauris, vitae imperdiet mauris scelerisque et. Suspendisse nisl neque, auctor a velit quis, vulputate interdum metus. Donec elementum, lectus vitae congue maximus, felis lectus sodales lorem, nec malesuada ex elit nec neque.\n\n', 'alvee/ this is the update', 0, 'published');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(4) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `user_role` int(11) NOT NULL,
  `user_image` text NOT NULL,
  `user_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_firstname`, `user_lastname`, `user_email`, `user_address`, `user_phone`, `user_role`, `user_image`, `user_date`) VALUES
(1, 'Author A', 'Akash', 'alvee@dal.ca', '3001 Olivet Street', '9029892355', 0, 'IMG_0306.JPG', '2017-04-06 21:35:22'),
(2, 'Author C', 'poem', 'poet@dal.ca', '67 Monipuripara', '01820155476', 1, 'Atahsin.jpg', '2017-04-06 21:35:22'),
(3, 'Author C', 'Abdul', 'saf@gmail.com', '2 Egeria Street', '07825815286', 2, 'safwon.jpg', '2017-04-06 21:35:22'),
(14, 'Author C', 'One', 'some@dal.ca', 'some where', '123456', 2, 'lonely.jpg', '2017-04-06 21:35:22'),
(15, 'Saara', 'Khadiza', 'saara@dal.ca', '67, Monipuripara', '9127800', 2, 'P1000427.JPG', '2017-04-06 21:35:22'),
(16, 'Sharmin', 'Fatema', 'sharmin@dal.ca', '69, Monipuripara', '9138835', 2, 'IMG_0099.JPG', '2017-04-06 21:35:22'),
(17, 'Author B', 'Tania', 'fahmida@dal.ca', 'Peter Green', '902909090', 1, 'P1000636-.JPG', '2017-04-06 21:35:22'),
(18, 'Author D', 'Mahmid', 'sandy@dal.ca', 'Mumford terminal', '902909090', 1, 'sandy.jpg', '2017-04-06 21:35:22'),
(19, 'Author A', 'Paff', 'daniellapaffile@hotmail.com', 'Bedford', '9027189330', 0, 'daniella.jpg', '2017-04-06 21:35:22'),
(20, 'Author D', 'try', 'last@email.com', 'somewhere', '9029892355', 1, 'ross2.jpg', '2017-04-16 17:11:22'),
(23, 'One', 'more', 'one@email.com', '', '', 1, 'IMG_0306.JPG', '2017-04-16 22:11:02'),
(25, 'Author A', 'Baba', 'hrtalukder07@gmail.com', '67, Monipuripara.', '+8801820155476', 1, 'Habib PP PHOTO.jpg', '2017-04-16 22:11:02'),
(26, 'asma', 'masum', 'asma@gmail.com', 'london', '123123123', 2, '', '2017-06-18 23:42:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_2` (`user_id`),
  ADD KEY `user_id_3` (`user_id`),
  ADD KEY `user_id_4` (`user_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_user_id_fk_to_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
