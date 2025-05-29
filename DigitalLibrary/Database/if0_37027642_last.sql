-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql206.infinityfree.com
-- Generation Time: Oct 17, 2024 at 10:45 AM
-- Server version: 10.6.19-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_37027642_last`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'Moin143264', '@Qwerty9324'),
(2, 'Pradnya', 'Pradnya');

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `image` varchar(1000) NOT NULL,
  `link` varchar(1025) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`id`, `name`, `image`, `link`) VALUES
(1, '9th Std Digest math', 'm1d9.jpg', 'm1d9.pdf'),
(2, '9th Std TestBook math', 'm1t9.png', 'm19.pdf'),
(3, 'English Testbook', 'et9.png', 'ENG9.pdf'),
(4, 'English Digest-9.', 'ed9.jpg', 'engd9.pdf'),
(5, 'Hindi Testbook', 'hindt9.png', 'hindi9.pdf'),
(6, 'Hindi Digest-9', 'hindd9.jpg', 'hindi9d.pdf'),
(7, 'Science Digest', 'science d9.jpg', 'scid9.pdf'),
(8, 'Maths-2 Testbook', 'm2t9.png', 'math29.pdf'),
(9, 'Maths-2 Digest', 'm2d9.jpg', 'm2d9.pdf'),
(10, 'History 9th Testbook', 'his t9.png', 'his9.pdf'),
(11, 'History Digest', 'hist d9.jpg', 'histd9.pdf'),
(12, '9th Geography testbook', 'gt9.png', 'geod9.pdf'),
(13, '9th Std Geo (urdu)', 'geo.jpg', 'geo9urdu.pdf'),
(14, '9th Std  hindi(urdu)', 'hindi.JPG', 'hindi9urdu.pdf'),
(15, '9th Std  History (urdu)', 'history.jpg', 'history9urdu.pdf'),
(16, '9th Std math-I(urdu)', 'm1.JPG', 'math1urdu.pdf'),
(17, '9th Std Math-II(urdu)', 'm2.JPG', 'math2urdu.pdf'),
(18, '9th Std Marathi(urdu)', 'mara.JPG', 'marathi9urdu.pdf'),
(19, '9th Std Science(urdu)', 'sci.jpg', 'sci9urdu.pdf'),
(20, '9th Std Urdu(urdu)', 'urdu.jpg', 'kumarbhartiurdu9.pdf'),
(64, 'English Testbook 10th', 'engt10.png', 'ENG.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(25) NOT NULL,
  `query` varchar(1024) NOT NULL,
  `reply` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `number`, `query`, `reply`) VALUES
(79, 'moin', 'ms66454566@gmail.com', '922E3', 'hyynf', ''),
(80, 'prdANYA', 'pradnyapanchal130@gmail.com', '9324777191', 'he;llllo\r\n', 'byy\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `curo`
--

CREATE TABLE `curo` (
  `id` int(11) NOT NULL,
  `image` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `curo`
--

INSERT INTO `curo` (`id`, `image`) VALUES
(12, '2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `dash`
--

CREATE TABLE `dash` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `image` varchar(1000) NOT NULL,
  `link` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `dash`
--

INSERT INTO `dash` (`id`, `name`, `image`, `link`) VALUES
(7, 'User Management', '22989473.jpg', 'userm.php'),
(8, 'E-content_Mangement', 'mangebook.jpg', 'productm.php'),
(9, 'Add_E-Content', '10608883.png', 'product_add.php'),
(10, 'Add_Option_On_Dashboard', 'dash.png', 'dash_image_add.php'),
(15, 'Dashboard_Manage', 'mm.jpg', 'dash_mana.php'),
(20, 'payments Manage', 'PAY.webp', 'payment_manage.php'),
(21, 'feedback_manage', 'feedback.jpg', 'feedback_mana.php'),
(22, 'contact_manage', 'cot.jpg', 'contact_manage.php');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `rating` varchar(255) NOT NULL,
  `ui_rating` varchar(255) NOT NULL,
  `functionality_rating` varchar(255) NOT NULL,
  `performance_rating` varchar(255) NOT NULL,
  `comments` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `user_id`, `name`, `email`, `rating`, `ui_rating`, `functionality_rating`, `performance_rating`, `comments`) VALUES
(23, 34, 'pradnyapanchal', 'pradnyapanchal130@gmail.com', '5-Excellent', '5-Excellent', '5-Excellent', '5-Excellent', 'VHFH\r\n'),
(24, 23, 'MOIN', 'ms66454566@gmail.com', '5-Excellent', '5-Excellent', '5-Excellent', '5-Excellent', 'Great'),
(28, 23, 'MOIN', 'ms66454566@gmail.com', '1-Poor', '1-Poor', '1-Poor', '1-Poor', 'Tgtghn'),
(29, 23, 'MOIN', 'ms66454566@gmail.com', '1-Poor', '1-Poor', '1-Poor', '1-Poor', 'Gygyfyf6ygyyg6gjjohhi76'),
(30, 37, 'Gulam gaus ', 'sartazdarvesh@gmail.com', '5-Excellent', '5-Excellent', '5-Excellent', '5-Excellent', 'Great ðŸ˜Š'),
(31, 37, 'Gulam gaus ', 'sartazdarvesh@gmail.com', '5-Excellent', '5-Excellent', '5-Excellent', '5-Excellent', 'Yyyou'),
(32, 23, 'MOIN', 'ms66454566@gmail.com', '5-Excellent', '5-Excellent', '5-Excellent', '5-Excellent', 'ðŸ˜ðŸ˜'),
(33, 23, 'MOIN', 'ms66454566@gmail.com', '1-Poor', '1-Poor', '1-Poor', '1-Poor', 'Uguguguhug'),
(34, 23, 'MOIN', 'ms66454566@gmail.com', '5-Excellent', '5-Excellent', '5-Excellent', '5-Excellent', 'hello\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `image` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `name`, `description`, `image`) VALUES
(2, 'moin shaikh', 'bgn', ''),
(5, 'gg', 'gg', 'IMG-20201122-WA0001.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `last`
--

CREATE TABLE `last` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `last`
--

INSERT INTO `last` (`id`, `name`, `email`, `username`, `password`, `token`) VALUES
(23, 'MOIN', 'ms66454566@gmail.com', 'moin', '$2y$10$ibbJAjo9Pk2aea8IdcHDCO3du7tie6mp4l37zkoJ4CBm6ipnmfj0y', 'd65d81e220976e3df270d1cf3bdf4f53'),
(26, 'chand', 'm3608701@gmail.com', 'chand', '$2y$10$tXnSaInhnN6uOkI/En', 'd052a33b937be4cc42d6d51e573d5743'),
(32, 'Raja Santosh Mandal', 'mandalraja916@gmail.com', 'raja786', '12345678', ''),
(33, 'Amit', 'y4694458@gmail.com', 'Amit', '143163', ''),
(34, 'pradnyapanchal', 'pradnyapanchal130@gmail.com', 'pradnya', '$2y$10$7RfdTugzsHmbdAITsmvYB.OZCDLFOJAvrrPs8v.a0FKuuJlwxzh..', 'f83f9ee84fb7d846bcddd3c4dbfce204'),
(35, 'SUBHASH SAH', 'subhashsah779@gmail.com', 'subu7', '$2y$10$mjW6K5JMZzC1Ysv/JvGtGu2SRCeqjcOjA2DMTpvK/QPBjnGVl1M42', 'e354a41846b298a6d46cb4c12219ddcc'),
(37, 'Gulam gaus ', 'sartazdarvesh@gmail.com', 'GULAM GAUS ', 'Gulamgaus', ''),
(38, 'Moin', 'kashishvarma@gmail.com', 'Sudhir', '143264', ''),
(40, 'Piyush Chall', 'challpiyush79@gmail.com', 'Pyush', '12345', ''),
(42, 'Sapna ', 's81604049@gmail.com', 'Sapna', '0987', ''),
(43, 'Namita Kashyap ', 'namitakashyap2004@gmail.c', 'Namita ', 'Namita123', ''),
(44, 'Shre', 'hackerinfinity69@gmail.co', 'Shre', '123456', ''),
(50, 'Ayub', 'Ayubdarbes@gmail.com', 'Ayub', 'Ayub123', ''),
(87, 'Moin Shaikh', 'ms664545666@gmail.com', '66', '$2y$10$4wnvsE0z0BOk1DHK1v15vu1Y8FcNczfzrVt08ahjzghbNeAmqaymK', ''),
(90, 'Harish', 'harishbulla4u@gmail.com', 'Hai', '$2y$10$XioRMNBP1PbnmD8kyOtGt.GWWeGG0Ncx2MQfwmvunwClDU..XPd2i', ''),
(91, 'moin14', 'MS@GMAIL.COM', 'moinmoin', '$2y$10$oFnHAW4L7SHWQzVRzfKSIeRrB94A.4S4N7E4f6xoMe6l6N/IRkYyS', ''),
(92, 'sagar', 'sagar@gmail.com', 'sagar', '$2y$10$qjSMePkpaWAsX7sEe6UH3OiPzD.IAojYBpp4mSef5OUPFzv5.wQti', '');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `cost` int(11) NOT NULL,
  `contact` varchar(1000) NOT NULL,
  `payment_id` varchar(255) NOT NULL,
  `date_one_month_later` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `pdf_id` int(11) NOT NULL,
  `purchase_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `name`, `email`, `cost`, `contact`, `payment_id`, `date_one_month_later`, `user_id`, `pdf_id`, `purchase_time`) VALUES
(108, 'English Testbook 10th', 'ms66454566@gmail.com', 50, '918424868079', 'MOJO4801A05A90769079', '2024-08-01', 26, 64, '2024-08-01 14:49:29'),
(109, 'moin', 'ms66454566@gmail.com', 50, '918424868079', 'MOJO4801V05A90769081', '2024-09-01', 26, 63, '2024-08-01 14:55:54'),
(110, 'English Testbook 10th', 'ms66454566@gmail.com', 50, '918424868079', 'MOJO4801L05A90769082', '2024-09-30', 26, 64, '2024-07-01 15:02:25'),
(111, 'English Testbook 10th', 'ms66454566@gmail.com', 50, '918424868079', 'MOJO4801205A90769085', '2024-11-15', 23, 64, '2024-08-01 15:15:28'),
(112, 'English Testbook', 'ms66454566@gmail.com', 50, '918424868079', 'MOJO4804L05A32708223', '2024-09-17', 23, 3, '2024-08-04 08:08:19'),
(113, '9th Std TestBook', 'ms66454566@gmail.com', 50, '918424868079', 'MOJO4804105A32708225', '2024-09-17', 23, 2, '2024-08-04 09:14:41'),
(122, 'English Testbook', 'ms66454566@gmail.com', 50, '918424868079', 'MOJO4806S05A37190055', '2024-09-17', 23, 3, '2024-08-06 11:12:00'),
(123, 'English Testbook', 'ms66454566@gmail.com', 50, '918424868079', 'MOJO4806205A37190061', '2024-09-17', 23, 3, '2024-08-06 13:47:15'),
(125, 'English Digest-9.', 'ms66454566@gmail.com', 50, '918424868079', 'MOJO4807M05A36311467', '2024-11-13', 23, 4, '2024-08-07 09:35:44'),
(126, '9th Std Geo (urdu)', 'ms66454566@gmail.com', 50, '918424868079', 'MOJO4808S05A70877492', '2024-11-15', 23, 13, '2024-08-07 21:55:05'),
(127, 'Geography 9 digest', 'hackerinfinity69@gmail.com', 50, '918424868079', 'MOJO4808405A70877517', '2024-09-08', 44, 66, '2024-08-08 03:50:25'),
(128, '9th Std Digest math', 'pradnyapanchal130@gmail.com', 50, '918291692317', 'MOJO4808905A70877548', '2024-11-13', 34, 1, '2024-08-08 08:22:11'),
(131, '9th Std Urdu(urdu)', 'ms66454566@gmail.com', 50, '918424868079', 'MOJO4808T05A70877547', '2024-09-17', 23, 20, '2024-08-08 08:22:22'),
(134, '9th Std Digest math', 'pradnyapanchal130@gmail.com', 50, '918291692317', 'MOJO4808V05A70877549', '2024-11-13', 34, 1, '2024-08-08 08:23:41'),
(136, 'English Testbook', 'ms66454566@gmail.com', 50, '918424868079', 'MOJO4808S05A70877550', '2024-11-13', 34, 3, '2024-08-08 08:26:07'),
(137, '9th Std TestBook math', 'ms66454566@gmail.com', 50, '918424868079', 'MOJO4809M05A89324577', '2024-09-17', 23, 2, '2024-08-09 12:29:41'),
(138, '9th Std Digest math', 'sartazdarvesh@gmail.com', 50, '918291070014', 'MOJO4809L05A89324576', '2024-09-09', 37, 1, '2024-08-09 12:29:52'),
(139, '9th Std Digest math', 'sartazdarvesh@gmail.com', 50, '918291070014', 'MOJO4809T05A89324579', '2024-09-09', 37, 1, '2024-08-09 12:30:42'),
(140, '9th Std TestBook math', 'sartazdarvesh@gmail.com', 50, '918291070014', 'MOJO4809L05A89324580', '2024-09-09', 37, 2, '2024-08-09 12:32:31'),
(141, '9th Std TestBook math', 'ms66454566@gmail.com', 50, '918424868079', 'MOJO4824Y05A48882597', '2024-11-13', 34, 2, '2024-08-24 19:14:32'),
(142, 'Maths-2 Digest', 'ms66454566@gmail.com', 50, '918424868079', 'MOJO4824205A48882614', '2024-11-17', 23, 9, '2024-08-24 20:32:14'),
(144, 'Hindi Testbook', 'ms66454566@gmail.com', 50, '918424868079', 'MOJO4826Z05A38311936', '2024-09-26', 34, 5, '2024-08-26 17:16:43'),
(145, 'Maths-2 Testbook', 'ms66454566@gmail.com', 50, '918424868079', 'MOJO4826405A38311941', '2024-09-26', 34, 8, '2024-08-26 17:34:04'),
(146, 'Hindi Testbook', 'ms66454566@gmail.com', 50, '8424868079', 'MOJO4826X05A38311973', '2024-10-30', 23, 5, '2024-08-26 21:00:30'),
(147, 'English Testbook', 'ms66454566@gmail.com', 50, '8424868079', 'MOJO4a05J05A57044509', '2024-11-05', 37, 3, '2024-10-05 09:30:28'),
(148, '9th Std TestBook math', 'm3608701@gmail.com', 50, '8424868079', 'MOJO4a05K05A57044510', '2024-11-05', 35, 2, '2024-10-05 09:34:56'),
(149, 'English Testbook', 'm3608701@gmail.com', 10, '8424868079', 'pi_3Q9JFm07CIuzAORv1ijJQvxa', '2024-11-13', 43, 3, '2024-10-13 09:48:17'),
(150, 'English Digest-9.', 'm3608701@gmail.com', 10, '8424868079', 'pi_3Q9M6807CIuzAORv1E7ovOSf', '2024-11-13', 43, 4, '2024-10-13 12:50:28'),
(151, 'Maths-2 Testbook', 'ms66454566@gmail.com', 10, '8424868079', 'pi_3Q9Mv107CIuzAORv1XSMyJq3', '2024-11-13', 37, 8, '2024-10-13 13:43:09'),
(152, 'English Testbook 10th', 'm3608701@gmail.com', 10, '8424868079', 'pi_3Q9Sc107CIuzAORv0xrxJs0G', '2024-11-13', 43, 64, '2024-10-13 19:47:49'),
(153, '9th Geography testbook', 'pradnyapanchal130@gmail.com', 10, '8291692317', 'pi_3QAAwP07CIuzAORv15Dd8QFl', '2024-11-15', 34, 12, '2024-10-15 20:04:13');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_pdf`
--

CREATE TABLE `purchase_pdf` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pdf_url` varchar(255) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `purchase_pdf`
--

INSERT INTO `purchase_pdf` (`id`, `user_id`, `pdf_url`, `name`) VALUES
(16, 23, 'http://digitallibrarymanagement.kesug.com/view_pdf.php?id=64', 'English Testbook 10th'),
(17, 23, 'http://digitallibrarymanagement.kesug.com/view_pdf.php?id=3', 'English Testbook'),
(18, 23, 'https://digitallibrarymanagement.kesug.com/view_pdf.php?id=3', 'English Testbook'),
(19, 23, 'https://digitallibrarymanagement.kesug.com/view_pdf.php?id=64', 'English Testbook 10th'),
(20, 23, 'https://digitallibrarymanagement.kesug.com/view_pdf.php?id=4', 'English Digest-9.'),
(21, 23, 'https://digitallibrarymanagement.kesug.com/view_pdf.php?id=13', '9th Std Geo (urdu)'),
(22, 44, 'https://digitallibrarymanagement.kesug.com/view_pdf.php?id=66', 'Geography 9 digest'),
(23, 34, 'https://digitallibrarymanagement.kesug.com/view_pdf.php?id=1', '9th Std Digest math'),
(24, 23, 'https://digitallibrarymanagement.kesug.com/view_pdf.php?id=20', '9th Std Urdu(urdu)'),
(25, 34, 'https://digitallibrarymanagement.kesug.com/view_pdf.php?id=1', '9th Std Digest math'),
(26, 34, 'https://digitallibrarymanagement.kesug.com/view_pdf.php?id=3', 'English Testbook'),
(27, 23, 'https://digitallibrarymanagement.kesug.com/view_pdf.php?id=2', '9th Std TestBook math'),
(28, 37, 'https://digitallibrarymanagement.kesug.com/view_pdf.php?id=1', '9th Std Digest math'),
(29, 37, 'https://digitallibrarymanagement.kesug.com/view_pdf.php?id=1', '9th Std Digest math'),
(30, 37, 'https://digitallibrarymanagement.kesug.com/view_pdf.php?id=2', '9th Std TestBook math'),
(31, 34, 'https://digitallibrarymanagement.kesug.com/view_pdf.php?id=2', '9th Std TestBook math'),
(32, 23, 'https://digitallibrarymanagement.kesug.com/view_pdf.php?id=9', 'Maths-2 Digest'),
(33, 34, 'https://digitallibrarymanagement.kesug.com/view_pdf.php?id=5', 'Hindi Testbook'),
(34, 34, 'https://digitallibrarymanagement.kesug.com/view_pdf.php?id=8', 'Maths-2 Testbook'),
(35, 23, 'https://digitallibrarymanagement.kesug.com/view_pdf.php?id=5', 'Hindi Testbook'),
(36, 37, 'https://digitallibrarymanagement.kesug.com/view_pdf.php?id=3', 'English Testbook'),
(37, 35, 'https://digitallibrarymanagement.kesug.com/view_pdf.php?id=2', '9th Std TestBook math'),
(38, 43, 'https://digitallibrarymanagement.kesug.com/view_pdf.php?id=3', 'English Testbook'),
(39, 43, 'https://digitallibrarymanagement.kesug.com/view_pdf.php?id=4', 'English Digest-9.'),
(40, 37, 'https://digitallibrarymanagement.kesug.com/view_pdf.php?id=8', 'Maths-2 Testbook'),
(41, 43, 'https://digitallibrarymanagement.kesug.com/view_pdf.php?id=64', 'English Testbook 10th'),
(42, 34, 'https://digitallibrarymanagement.kesug.com/view_pdf.php?id=12', '9th Geography testbook');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `curo`
--
ALTER TABLE `curo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dash`
--
ALTER TABLE `dash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `last`
--
ALTER TABLE `last`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_id` (`payment_id`),
  ADD KEY `fk_user` (`user_id`),
  ADD KEY `name` (`name`),
  ADD KEY `pdf_id` (`pdf_id`);

--
-- Indexes for table `purchase_pdf`
--
ALTER TABLE `purchase_pdf`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `card`
--
ALTER TABLE `card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `curo`
--
ALTER TABLE `curo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `dash`
--
ALTER TABLE `dash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `last`
--
ALTER TABLE `last`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `purchase_pdf`
--
ALTER TABLE `purchase_pdf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchase_pdf`
--
ALTER TABLE `purchase_pdf`
  ADD CONSTRAINT `fk_purchase_pdf_name` FOREIGN KEY (`name`) REFERENCES `payments` (`name`),
  ADD CONSTRAINT `purchase_pdf_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `payments` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
