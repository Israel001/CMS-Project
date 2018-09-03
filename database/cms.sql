-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2018 at 11:18 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Automotives');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(320) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL DEFAULT 'unapproved',
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(1, 10, 'DAVID', 'david@gmail.com', 'Waoo! Money talks,money do everything. \r\n\r\nSweptail Rolls Royce \r\n\r\nis higher than maybech? ', 'Approved', '2018-07-16'),
(2, 9, 'SIKEH', 'sikeh@gmail.com', 'Wow!!!! Koenisegg CCXR Trevita – $13 million, I can believe this. This ride is breathe taking but the \r\n\r\nowner of such an icon must be feeling out of this world. I hope I can feel that way one day. ', 'Approved', '2018-07-16'),
(3, 8, 'Anonymous', 'anonymous@gmail.com', 'these are so beautiful and amazing cars . \r\n\r\ngood article . \r\n\r\nwhen i see this technology it make me happy , but another aspect of these most expensive cars are poor people who destroy because these rich people have cars like this … \r\n\r\nanyway , thanks because u made this article . ', 'Approved', '2018-07-16'),
(4, 7, 'DENISE', 'denise@gmail.com', 'Utter greed. How revolting to want to own one.How many cities of hungry people can you feed with 3.6 million dollars. Simply satanic ', 'Approved', '2018-07-16'),
(5, 6, 'CHRIS', 'chris@gmail.com', 'How is that satanic? \r\n\r\nIt was just some rich asshole with way too much money. \r\n\r\nNow that I think of it… \r\n\r\nYou’re probably one of those fake christians ', 'Approved', '2018-07-16');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`) VALUES
(11, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_user` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL,
  `post_views_count` int(11) NOT NULL,
  `likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`, `likes`) VALUES
(1, 1, 'Bugatti Chiron', 'Godwin', '', '2018-07-16', 'image_7.jpg', '<h2><strong>Bugatti Chiron - $ 2.7 million</strong></h2><p>Heirs to the Veyron supercars, Bugati’s latest is quite high-priced and starts at around $2.7 million based on the present exchange rates. However, prices are expected to reach $3 million in the least, long before it hits the market. Touted as the ‘world’s most powerful, fastest, most luxurious and most exclusive production super sports car’ by the manufacturers, it is the vision of former VW czar Ferdinand Piech, who demanded the fastest cars from Bugatti.&nbsp;</p><p>So now here is a car handmade in an atelier, faster, more advanced and more powerful than the Veyron. It is a fine example of the collusion of aerospace and automotive engineering to produce a classic device that could give a speed of 268 mph. The 8.0 liter turbo-charged W-16, 1,500-horsepower engine is actually 300 more than the Super Sport, the fastest Veyron model. While its top speed has been limited to 261 mph on the road, its actual top speed is yet to be tested.&nbsp;</p><p>&nbsp;</p>', 'cars, bugatti', 0, 'published', 1, 0),
(2, 1, 'Pagani Huayra BC', 'Godwin', '', '2018-07-16', 'image_10.jpg', '<h2><strong>Pagani Huayra BC - $2.8 million</strong></h2><p>Coming after the Pagani Huayra, the Pagani Huayra BC is the priciest Pagani car ever made. Named as a tribute to Benny Caiola, a noted Italian investor with probably the best collection of Ferraris and a very close friend of Horacio Pagani, this car is a delight for the lovers of Pagani’s details.</p><p>Debuting at the 2016 Geneva Motor Show, this car has a wider rear track, new side tracks, and many cool aero features. Like the earlier version, the 6.0 liter V-12 bi-turbo engine of the BC is sourced from AMG, and produces 790 horsepower and 811 lb-ft torque. This power is run to the rear wheels through the tripod drive shafts leveraging a 7-speed Xtrac transmission. And the most amazing bit is that the BC takes over the Huayra by changing the model’s standard 150 milliseconds to 75 milliseconds.&nbsp;</p><p>At 2,685 pounds (1,218 kilograms), the BC also happens to be a lot lighter than the Huayra due to the extensive use of carbon fibres and other lightweight materials.&nbsp;</p>', 'cars, pagani', 0, 'published', 1, 0),
(3, 1, 'Ferrari Pininfarina Sergio', 'Godwin', '', '2018-07-16', 'image_12.jpg', '<h2><strong>Ferrari Pininfarina Sergio - $3 million</strong></h2><p>Originally introduced as a concept car in 2013 in memory of a deceased son of the founder of Pininfarina, the legendary Italian design house, only six of these cars have been made as of yet, thus becoming one of the most coveted cars. This is one of the costliest Ferraris ever made and is based on the Ferrari 458 Spider.&nbsp;</p><p>Each of the handmade units has an all-carbon-fibre frame, and is an open air <strong>luxury car</strong> with two seats. Like the Ferrari 458, it has no roof, side windows and windshield, and is 330 pounds lighter than its ancestor. This makes it smarter and quicker, though it has the same naturally-aspirated 4.5 liter F136F V-8 engine, which sends 562 hp to the rear wheels. The renovated interior also comes with a host of interesting details like aerodynamic headrests built directly into the roll cage.&nbsp;</p><p>The coolest fact about this car though is that the owners of each of the six models were chosen by the manufacturers themselves, making this one of the rarest of the rare invite-only vehicles.&nbsp;</p>', 'cars, ferrari', 0, 'published', 0, 0),
(4, 1, 'Aston Martin Valkyrie', 'Godwin', '', '2018-07-16', 'image_16.jpg', '<h2><strong>Aston Martin Valkyrie - $3.2 million</strong></h2><p>While there has been no price announced for this car as of yet, expert estimates place it at around 3.2 million dollars. Built under Andy Palmer, the new president of Aston Martin committed to solvency and relevance with awesome cars, this model is a renovation of the old Aston Martin-Red Bull AM-RB 001.&nbsp;</p><p>Legend has it that Palmer agreed to this car over a drink with Red Racing’s Adrian Newey and Christian Horner. Newey, renowned aerodynamicist behind Red Bull’s <strong>expensive and award-winning sports cars</strong> in the Formula 1 tracks, devised an aerodynamic scheme specifically for this car that pushes air via the chassis, resulting in downforce without using the wings.&nbsp;</p><p>The 6.5 liter, naturally- aspirated V-12 designed specifically for the Cosworth, has a 1:1 power /weight ratio, and comes with a Rimac-built hybrid battery system coming with the engine which yields about a 1,000 horsepower. As of yet, 150 units of this model has been planned by the company, and the deliveries are expected to start 2019 onward. In addition, 25 track-only editions have been planned whose prices can only be speculated at present.&nbsp;</p>', 'cars, aston martin', 0, 'published', 0, 0),
(5, 1, 'Bugatti Veyron', 'Godwin', '', '2018-07-16', 'image_21.jpg', '<h2><strong>Bugatti Veyron - $3.4 million</strong></h2><p>Upgraded four times since its releasze in 2005, the Mansory Vivere edition of the Bugatti Veyron is not only among the priciest cars of the world, but also one of the fastest.&nbsp;</p><p>Modelled on the Grand Sport Vitesse Roadster, this German car has an awesome lacquered carbon-fibre body along with a new spoiler package providing new diffusers, a smarter cabin and front grill, larger side scoops, a shortened hood, and the like. The upgraded LED lights are everywhere – the headlight and taillight clusters, the cockpit.&nbsp;</p><p>And for the aesthetically conscious, maps of history making events like the Targa Florio race and the like are laser etched into both the upholstered, carbon fiber interior, and the exterior. The 8.0 liter W16 engine of the car can produce 1,200 horsepower and 1,106 pound-feet of torque. The original version could reach up to 253 mph and was named the Car of the Decade 2000-2009.&nbsp;</p>', 'cars, bugatti', 0, 'published', 0, 0),
(6, 1, 'Lykan Hypersport', 'Godwin', '', '2018-07-16', 'image_22.jpg', '<h2><strong>Lykan Hypersport - $3.4 million</strong></h2><p>The headlights being made of, urm, 240 15-carat diamonds, is the price very surprising? And then there are the LED blades made of 420 15-carat diamonds. And all the gems are customizable.&nbsp;</p><p>Looking like an armored car with scissor doors and an interior straight out of a sci-fi movie, this featured in the ‘Furious 7’, and has actually been drafted by the Abu Dhabi police for patrol duty!&nbsp;</p><p>Built by W Motors, based in Lebanon, this is the first Arab supercar. And it doesn’t fare badly when compared with the traditional European biggies. Apart from its awesome looks, the twin-turbo mid-rear mounted 3.8 liter flat-six boxer can produce 780 horsepower through the rear wheels, and a 708 pound-feet of torque. It can do a 62 in a mere 2.8 seconds, and can reach speeds up to 240 mph.&nbsp;</p>', 'cars, sport car, hypersport', 0, 'published', 2, 0),
(7, 1, 'McLaren P1 LM', 'Godwin', '', '2018-07-16', 'image_25.jpg', '<h2><strong>McLren P1 LM - $3.6 million</strong></h2><p>Not a production car, this is more or less a street-legal version of the track-only McLaren P1 GTR. Converted by the British firm Lanzante, who bought the original P1 built by McLaren, it was made keeping in mind a select group of buyers in the U. S., Japan, U. K., and the UAE.&nbsp;</p><p>This car has a lot in common with the P1 GTR and the legendary McLaren F1 road car. For example, the gold plating surrounding the engine bay with a 3.8 liter twin-turbo V-8. It is much smarter than the P1 GTR. Not only does it weigh 132 pounds (60 kg0 less than the P1 GTR, but its modified rear wing and enlarged front splitter join with the dive planes to generate 40% increased downforce as compared to the P1 GTR.&nbsp;</p><p>The awesomeness of the aerodynamics can be witnessed where it is made for- on track, where it can produce 1000 horsepower. As of yet, only five units have been built, all of them being sold.&nbsp;</p>', 'cars, mclaren', 0, 'published', 4, 0),
(8, 1, 'Lamborghini Veneno Roadster', 'Godwin', '', '2018-07-16', 'image_28.jpg', '<h2><strong>Lamborghini Veneno Roadster - $4.5 million</strong></h2><p>Built to celebrate the company’s 50th birthday, ‘Veneno’ literally means poison in Spanish, and well, the design does look deadly. Looking almost like an alien space capsule, this car can reach speeds that can give one of those a run for their money, literally. The 6.5 liter V12 with a seven-speed single clutch ISR automated manual transmission can spin at 8,400 rpm to yield 740 horsepowers and 507 pound-feet of torque, meaning that the car can do a 60 mph at 2.9 seconds!&nbsp;</p><p>The monoque is heavily inspired by the LP700-4 Aventador, and is made of carbon fiber. The sprung portion is placed on the top of a pushrod-actuated suspension, and its total dryweight of this carbon-fiber vehicle is a mere 3,285 pounds, although it is driven by a full all-wheel-drive system.&nbsp;</p><p>Only 9 units being made, the biggets problem of these cars is their crazy resells rates- one was sold at $11 millions! It was the most expensive car in the world ever produced upon its introduction, and only three being available to customers in the first lot, there was a crazy scramble to get hands on the remaining ones.&nbsp;</p>', 'cars, lamborghini', 0, 'published', 4, 0),
(9, 1, 'Koenisegg CCXR Trevita', 'Godwin', '', '2018-07-16', 'image_31.jpg', '<h2><strong>Koenisegg CCXR Trevita - $4.8 million</strong></h2><p>The most expensive street-legal production car in the world, this is coated with real diamonds. Yes, you read that right. ‘Trevita’ is an abbreviation translating into ‘three whites’. The carbon fibers are indeed coated with a diamond dust-impreganted resin, called the Koenigsegg Proprietary Diamond Weave. This technology transformed the fibres from the traditional black to shining, silvery white, making the bodywork of this car renowned throughout for its unique design and perfection.&nbsp;</p><p>And that’s not all. Beneath the coating is a 4.8 liter, dual-supercharged V8 having a total output of 1,004 horsepower and 797 pound-feet of torque. This makes it well-equipped at overtaking semis in the freeway. This car comes with a one-of-its-kind dual carbon rear wing, iconell exhaust system, airbags, ABS powered carbon ceramic brakes, paddle-shift, infotainment system, chronometer instrument cluster, tires monitoring systems along with a hydraulic system.&nbsp;</p><p>Only three cars of this model had been initially decided upon, before getting reduced to two, because the carbon fibre made it too difficult and time-consuming for regular manufacture.</p>', 'cars, koenisegg', 0, 'published', 3, 0),
(10, 1, 'Sweptail', 'Godwin', '', '2018-07-16', 'image_33.jpg', '<h2><strong>Sweptail by Rolls Royce - $13 million</strong></h2><p>Before you gasp at the price, do note that this car is off the markets. That’s because it was made on the recommendations of one specific customer whose name the company has refused to divulge. A company famous for its <strong>luxurious</strong> rollouts, there were only 4,000 Rolls Royce cars manufactured in 2016!&nbsp;</p><p>This particular <strong>exclusive car</strong> comes with its custom coach work, reminiscent of the royal carriages of yore. Probably modeled on the Wraith, this car can seat only two people (see what they mean by being exclusive?). The sunroof is fully panoramic, tapering down sharply like those of the racing yachts, as per the orders of the customer.&nbsp;</p><p>Something very cool about the interior handcrafted with wood and leather are the hidden attaché cases for holding laptops behind each door. Not much else is available on this <strong>most expensive car in the world</strong>, except that it is based on the 1920s and 30s models, and looks like a yacht from the back. The owner does happen to be a collector of super-yachts and private planes.&nbsp;</p>', 'cars, rolls royce', 0, 'published', 89, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_email` varchar(320) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL DEFAULT 'subscriber',
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_firstname`, `user_lastname`, `username`, `user_email`, `user_password`, `user_image`, `user_role`, `token`) VALUES
(1, 'Israel', 'Obanijesu', 'Pbnl', 'israelobanijesu2@gmail.com', '$2y$10$XV5QrfhQxF/qzt4KrWliJ.INL91ZaKNkdTc5y9Qs3LhG7yt8kcACa', '', 'admin', ''),
(2, 'Godwin', 'Ngaju', 'Godwin', 'ngajugodwingt00565@fpt.edu.vn', '$2y$10$UGPfvbS7t7hHwTtcLG5QHO6MhvQH9BjeRQm3pS2FkIBcST.HBSDbW', '', 'subscriber', ''),
(3, 'Tobiloba', 'Adeyinka', 'Tobiloba', 'adeyinkagch16001@fpt.edu.vn', '$2y$10$IhtOVnL/TG5uOG58Np4uleaFGQK9Pp.INUj62JQGTmQFQh5QspZ1u', '', 'subscriber', ''),
(4, 'Oluwasami', 'Kehinde', 'Kenny', 'oluwasamikehinde@gmail.com', '$2y$10$PDUANalg7JyLpFUgnPW8VOyIF6J843Jdw.e4FfmuvIBpFvdMBekxC', '', 'subscriber', ''),
(5, 'Tobiloba', 'Owaboye', 'Owaboye', 'thobby@gmail.com', '$2y$10$ZwcIkbm5s1W5GTTM4Zii0eJAVu4ghGRiAZr9mq1rCa3sMNdcicUmy', '', 'subscriber', ''),
(6, 'Remi', 'Oluwasami', 'Remy', 'remycare@yahoo.com', '$2y$10$kvrhXtoUDcU7kimZSkglcuKbJLoDCCWsjC4IKye64sgv4JnHKIAwm', '', 'subscriber', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(1, 'h69qb7k7ki9ef48bgp9r6jag7k', 1531818950),
(2, 'djef09np4qk7c6g85bkfrnu4nd', 1530995421),
(3, '3njfr9va4e7p66p43sreqe84dj', 1531602331),
(4, 'm8pq01dsjqtali56upi8aldnk1', 1531603041);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
