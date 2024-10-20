-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jan 07, 2024 at 09:07 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healthcare4mys`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `postcode` varchar(5) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `avatar` varchar(50) DEFAULT NULL,
  `register_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `first_name`, `last_name`, `email`, `phone_number`, `password`, `street`, `postcode`, `city`, `state`, `avatar`, `register_at`) VALUES
(1, 'admin', 'test', 'admin@mail.com', '0123456789', 'Admin_1234', 'Jalan U1/35, Hicom-glenmarie Industrial Park,', '12345', 'Shah Alam', 'Perak', 'images/admin_avatar.png', '2023-12-31 00:19:34');

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `article_id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `images` longtext DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `published_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`article_id`, `title`, `category`, `description`, `images`, `status`, `created_by`, `created_at`, `published_at`) VALUES
(1, 'Make Healthy Choices: 7 Ways to Protect Yourself from HIV Transmission', 'General', 'Human immunodeficiency virus (HIV) remains a significant global health concern, but with the proper knowledge and precautions, you can lower your risk of contracting the virus and protect yourself from HIV.\r\n\r\nHIV is a viral infection that attacks the immune system, specifically T cells that fight infections alongside the immune system. When left untreated, HIV can lead to acquired immunodeficiency syndrome (AIDS). In this condition, the immune system is severely damaged, making individuals susceptible to opportunistic infections and certain cancers.\r\n\r\nInfectious diseases, including HIV, rank as the third leading cause of death in the U.S. Despite significant medical advancements, the impact of infectious diseases remains substantial due to factors like antibiotic resistance, emerging pathogens and ongoing challenges in public health infrastructure.\r\n\r\nHIV is more prevalent in developing countries, particularly those in Sub-Saharan Africa, where approximately 20% of individuals in the region are infected by the virus. While two-thirds of all HIV diagnoses occur in African countries, according to the most recent study, 1.2 million Americans are living with the virus. \r\n\r\nHere are seven ways to protect yourself from contracting HIV.\r\n\r\n1. Educate Yourself\r\n2. Practice Safe Sex\r\n3. Communicate With Sexual Partners\r\n4. Get Tested\r\n5. Pre-Exposure Prophylaxis (PrEP)\r\n6. Avoid Sharing Needles\r\n7. Prevent Mother-to-Child Transmission\r\n8. Make Healthy Choices to Protect Yourself from HIV', 'images/article/article-2.jpeg, images/article/article-1.png', 'Approved', 1, '2024-01-01 16:31:28', '2024-01-01 10:07:08'),
(2, 'World mental health support and the effect of stigma and discrimination', 'Psychiatry', 'The global burden of mental health and the need for mental health support services remain major health issues throughout the world. Mental illnesses are often overlooked and not prioritized by governments and other stakeholders.\r\n\r\nThe World Health Organization (WHO) defines health as “a state of complete physical, mental and social well-being and not merely the absence of disease or infirmity.”  There are challenges embedded within this definition as more people with chronic complex co-morbidities are living longer.\r\n\r\nMental health, as with any other aspects of health, can be affected by a range of socioeconomic factors that need to be addressed through comprehensive strategies involving access to preventions, treatments and facilitating recovery as well as raising awareness', 'images/article/article-3.png, images/article/article-4.png', 'Approved', 1, '2024-01-01 17:34:50', '2024-01-06 16:42:39');

-- --------------------------------------------------------

--
-- Table structure for table `consultation`
--

CREATE TABLE `consultation` (
  `consultation_id` int(11) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `visitor_id` int(11) DEFAULT NULL,
  `slot` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `book_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consultation`
--

INSERT INTO `consultation` (`consultation_id`, `doctor_id`, `visitor_id`, `slot`, `date`, `book_at`) VALUES
(1, 1, 1, 1, '2024-01-06', '2024-01-06 13:41:29'),
(3, 1, 1, 4, '2024-01-12', '2024-01-06 15:30:30'),
(4, 2, 1, 1, '2024-01-06', '2024-01-06 15:30:46'),
(5, 2, 1, 1, '2024-01-12', '2024-01-06 15:31:06'),
(6, 1, 1, 3, '2024-01-13', '2024-01-06 23:41:21');

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `coupon_id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `valid_from` datetime DEFAULT NULL,
  `valid_to` datetime DEFAULT NULL,
  `point` int(11) DEFAULT NULL,
  `images` longtext DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`coupon_id`, `title`, `description`, `valid_from`, `valid_to`, `point`, `images`, `created_at`) VALUES
(1, 'Discount Coupon 1', 'Get 10% off on your next purchase', '2023-01-01 00:00:00', '2023-01-31 23:59:59', 50, 'coupon-1.jpg', '2024-01-05 21:52:17'),
(2, 'Free Shipping Coupon', 'Enjoy free shipping on orders over $50', '2023-02-01 00:00:00', '2023-02-28 23:59:59', 75, 'coupon-2.jpg', '2024-01-05 21:52:17'),
(3, 'Cashback Coupon', 'Earn $5 cashback on your next purchase', '2023-03-01 00:00:00', '2023-03-31 23:59:59', 100, 'coupon-3.jpg', '2024-01-05 21:52:17'),
(4, 'Discount Coupon 2', 'Get 20% off on selected items', '2023-04-01 00:00:00', '2023-04-30 23:59:59', 80, 'coupon-4.jpg', '2024-01-05 21:52:17'),
(5, 'Special Offer Coupon', 'Unlock a special offer with this coupon', '2023-05-01 00:00:00', '2023-05-31 23:59:59', 120, 'coupon-5.jpg', '2024-01-05 21:52:17');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctor_id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `postcode` varchar(5) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `speciality` varchar(100) DEFAULT NULL,
  `medical_degree` varchar(100) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `avatar` varchar(50) DEFAULT 'images/doctor_avatar.png',
  `register_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctor_id`, `first_name`, `last_name`, `email`, `phone_number`, `password`, `street`, `postcode`, `city`, `state`, `speciality`, `medical_degree`, `language`, `avatar`, `register_at`) VALUES
(1, 'test', 'test', 'test@test.com', '0123456789', 'Test_12345', 'test', '12345', 'test', 'test', 'General Practitioner', 'Doctor of Osteopathic Medicine (DO)', 'Malay', 'images/doctor_avatar.png', '2023-12-28 19:20:46'),
(2, 'Doc', 'Test', 'doc@test.com', '0123456789', 'Doc_1234', 'testdoc', '65423', 'docadd', 'Johor', 'Dermatologist', 'Doctor of Osteopathic Medicine (DO)', 'English', 'images/doctor_avatar.png', '2024-01-05 20:26:54');

-- --------------------------------------------------------

--
-- Table structure for table `donation`
--

CREATE TABLE `donation` (
  `donation_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `visitor_id` int(11) DEFAULT NULL,
  `donation_type` varchar(100) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `donator` varchar(100) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `event_type` varchar(100) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `postcode` varchar(5) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `images` longtext DEFAULT NULL,
  `additional_file` longtext DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `title`, `description`, `event_type`, `start_date`, `end_date`, `street`, `postcode`, `city`, `state`, `images`, `additional_file`, `status`, `created_by`, `created_at`) VALUES
(1, 'Goop\'s In Good Health Summit Wellness Event', 'How Goop\'s In Good Health Summit Became The Most Forward-looking Wellness Event', 'Health', '2023-12-29', '2023-12-31', 'Lot 5. 11 Level 5 1 Teck Park, Bandar Utama', '12345', 'Kuala Lumpur', 'Kuala Lumpur', 'images/event/health-event-1.jpg, images/event/health-event-2.jpg', '', 'Approved', 1, '2023-12-30 23:41:12'),
(2, 'Fitness Event', 'Keep your body shape!', 'Fitness', '2024-01-01', '2024-01-03', '1 94 Jln Othman Seksyen 1', '46000', 'Petaling Jaya', 'Selangor', 'images/event/fitness-event-1.jpg', '', 'Approved', 1, '2023-12-30 23:59:58');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_type` enum('doctor','visitor') DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `user_id`, `user_type`, `title`, `description`, `created_at`) VALUES
(1, 1, 'visitor', 'test', 'testfeedback', '2024-01-04 12:19:22'),
(2, 1, 'visitor', 'dsfsd', 'sfsdsf', '2024-01-04 12:21:02');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `images` longtext DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `title`, `description`, `images`, `created_by`, `created_at`) VALUES
(1, 'Form of vitamin B3 may help manage Parkinson’s disease', 'Researchers estimate that more than 10 million people around the world have Parkinson’s disease, making it the second most prevalent neurodegenerative disease after Alzheimer’s disease.\r\n\r\nThere is currently no cure for Parkinson’s disease. Medications, lifestyle changesTrusted Source, and sometimes surgery are used to manage symptoms through the disease’s stages.\r\n\r\nOver the past few years, researchers have also looked at nicotinamide adenine dinucleotide (NAD+) — an important molecule that helps the body create energy — as a possible treatment for Parkinson’s disease.\r\n\r\nPrevious research suggests people with Parkinson’s may have a NAD+ deficiencyTrusted Source, and increasingTrusted Source NAD+ levels may have a positive effect.\r\n\r\nNow, a phase 1 clinical trial has found that a high dose supplementation of nicotinamide ribosideTrusted Source (NR) — a source of vitamin B3 and precursor to NAD+ — increased whole blood NAD+ levels and expanded the NAD+ metabolomeTrusted Source in people with Parkinson’s disease, and may be associated with clinical symptomatic improvement for those with the condition.\r\n\r\nThe research is still in its early stages, and it remains to be conclusively proven that NR supplementation can improve the symptoms of Parkinson’s disease.', 'images/news/news-2.jpg, images/news/news-1.jpg', 1, '2023-12-31 21:16:55'),
(2, 'Could a vibrating, ingestible capsule help treat obesity?', 'As of 2020, about 38% of the world’s population is considered to have obesity or overweight, with that percentage expected to jump to 42% by 2025.\r\n\r\nObesity is a known risk factor for a variety of health concerns, including high blood pressureTrusted Source, high cholesterolTrusted Source, sleep apneaTrusted Source, and depression.\r\n\r\nAdditionally, obesity may increase a person’s chance of developing diseases such as cardiovascular diseaseTrusted Source, type 2 diabetesTrusted Source, osteoarthritisTrusted Source, dementiaTrusted Source, and even certain cancersTrusted Source.\r\n\r\nAlthough there are treatments available for obesity, some interventions, such as making dietary changesTrusted Source can be difficult for a person to stick with for a long time, and others, such as weight loss surgeryTrusted Source also have barriers that may keep a person from that treatment.\r\n\r\nTo help provide a new option for noninvasive obesity treatment, researchers from the Massachusetts Institute of Technology (MIT) have developed an ingestible capsule that vibrates within the stomach, tricking the brain into thinking it is full.\r\n\r\nDr. Shriya Srinivasan, a former MIT graduate student and postdoc who is now an assistant professor of bioengineering at Harvard University, and the lead author of this study, told Medical News Today that the development of new noninvasive methods for treating obesity is of importance in confronting the multifaceted challenges posed by this global health crisis.\r\n\r\n“Traditional interventions, such as invasive surgeries, can be associated with significant risks, costs, and lifestyle modifications, limiting their applicability and effectiveness,” Dr. Srinivasan continued. “Noninvasive methods for treating obesity offer alternatives to invasive procedures, reducing associated risks and costs while improving accessibility for a broader population.”\r\n\r\nIn developing the ingestible capsule, she explained they wanted to develop a method that relied on the body’s natural signaling mechanisms in a closed-loop fashion.\r\n\r\n“We believe that relying on these mechanisms will minimize side effects. Relying on mechanostimulationTrusted Source has not yet been explored in this application and may offer a new modality that could lead to increased efficacy, overcoming the limitations of current methods. (And) a capsule-based solution offers scalability and minimization of costs, making this accessible to global populations,” she added.', 'images/news/news3.jpg, images/news/news4.jpg', 1, '2024-01-01 11:56:07');

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE `visitor` (
  `visitor_id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `street` varchar(100) DEFAULT NULL,
  `postcode` varchar(5) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `avatar` varchar(50) DEFAULT 'images/visitor_avatar.png',
  `point` int(10) DEFAULT 0,
  `register_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitor`
--

INSERT INTO `visitor` (`visitor_id`, `first_name`, `last_name`, `email`, `phone_number`, `password`, `street`, `postcode`, `city`, `state`, `avatar`, `point`, `register_at`) VALUES
(1, 'test', 'test', 'test@test.com', '0123456789', 'Test_122344', 'test', '12345', 'test', 'test', 'images/visitor_avatar.png', 770, '2023-12-28 19:19:52');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_coupon`
--

CREATE TABLE `visitor_coupon` (
  `visitor_coupon_id` int(11) NOT NULL,
  `visitor_id` int(11) DEFAULT NULL,
  `coupon_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitor_coupon`
--

INSERT INTO `visitor_coupon` (`visitor_coupon_id`, `visitor_id`, `coupon_id`) VALUES
(1, 1, 1),
(2, 1, 4),
(3, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `visitor_event`
--

CREATE TABLE `visitor_event` (
  `visitor_event_id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `visitor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitor_event`
--

INSERT INTO `visitor_event` (`visitor_event_id`, `event_id`, `visitor_id`) VALUES
(2, 1, 1),
(3, 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `consultation`
--
ALTER TABLE `consultation`
  ADD PRIMARY KEY (`consultation_id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `visitor_id` (`visitor_id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `donation`
--
ALTER TABLE `donation`
  ADD PRIMARY KEY (`donation_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `visitor_id` (`visitor_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `visitor`
--
ALTER TABLE `visitor`
  ADD PRIMARY KEY (`visitor_id`);

--
-- Indexes for table `visitor_coupon`
--
ALTER TABLE `visitor_coupon`
  ADD PRIMARY KEY (`visitor_coupon_id`),
  ADD KEY `visitor_id` (`visitor_id`),
  ADD KEY `coupon_id` (`coupon_id`);

--
-- Indexes for table `visitor_event`
--
ALTER TABLE `visitor_event`
  ADD PRIMARY KEY (`visitor_event_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `visitor_id` (`visitor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `consultation`
--
ALTER TABLE `consultation`
  MODIFY `consultation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `donation`
--
ALTER TABLE `donation`
  MODIFY `donation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `visitor`
--
ALTER TABLE `visitor`
  MODIFY `visitor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `visitor_coupon`
--
ALTER TABLE `visitor_coupon`
  MODIFY `visitor_coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `visitor_event`
--
ALTER TABLE `visitor_event`
  MODIFY `visitor_event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `doctor` (`doctor_id`);

--
-- Constraints for table `consultation`
--
ALTER TABLE `consultation`
  ADD CONSTRAINT `consultation_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`),
  ADD CONSTRAINT `consultation_ibfk_2` FOREIGN KEY (`visitor_id`) REFERENCES `visitor` (`visitor_id`);

--
-- Constraints for table `donation`
--
ALTER TABLE `donation`
  ADD CONSTRAINT `donation_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`),
  ADD CONSTRAINT `donation_ibfk_2` FOREIGN KEY (`visitor_id`) REFERENCES `visitor` (`visitor_id`);

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `visitor` (`visitor_id`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `visitor_coupon`
--
ALTER TABLE `visitor_coupon`
  ADD CONSTRAINT `visitor_coupon_ibfk_1` FOREIGN KEY (`visitor_id`) REFERENCES `visitor` (`visitor_id`),
  ADD CONSTRAINT `visitor_coupon_ibfk_2` FOREIGN KEY (`coupon_id`) REFERENCES `coupon` (`coupon_id`);

--
-- Constraints for table `visitor_event`
--
ALTER TABLE `visitor_event`
  ADD CONSTRAINT `visitor_event_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `event` (`event_id`),
  ADD CONSTRAINT `visitor_event_ibfk_2` FOREIGN KEY (`visitor_id`) REFERENCES `visitor` (`visitor_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
