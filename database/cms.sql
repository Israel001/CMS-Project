-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2018 at 02:35 PM
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
(1, 'Cars'),
(2, 'Motorbikes'),
(3, 'Buses');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_user_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(320) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL DEFAULT 'unapproved',
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_user_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(1, 10, 2, 'DAVID', 'david@gmail.com', 'Waoo! Money talks,money do everything. \r\n\r\nSweptail Rolls Royce \r\n\r\nis higher than maybech? ', 'Approved', '2018-07-16'),
(2, 9, 2, 'SIKEH', 'sikeh@gmail.com', 'Wow!!!! Koenisegg CCXR Trevita – $13 million, I can believe this. This ride is breathe taking but the \r\n\r\nowner of such an icon must be feeling out of this world. I hope I can feel that way one day. ', 'Approved', '2018-07-16'),
(3, 8, 2, 'Anonymous', 'anonymous@gmail.com', 'these are so beautiful and amazing cars . \r\n\r\ngood article . \r\n\r\nwhen i see this technology it make me happy , but another aspect of these most expensive cars are poor people who destroy because these rich people have cars like this … \r\n\r\nanyway , thanks because u made this article . ', 'Approved', '2018-07-16'),
(4, 7, 2, 'DENISE', 'denise@gmail.com', 'Utter greed. How revolting to want to own one.How many cities of hungry people can you feed with 3.6 million dollars. Simply satanic ', 'Approved', '2018-07-16'),
(5, 6, 2, 'CHRIS', 'chris@gmail.com', 'How is that satanic? \r\n\r\nIt was just some rich asshole with way too much money. \r\n\r\nNow that I think of it… \r\n\r\nYou’re probably one of those fake christians ', 'Approved', '2018-07-16'),
(6, 5, 2, 'RMI', 'rmi@gmail.com', 'What\'s there to say one cannot do both!', 'Approved', '2018-08-12'),
(7, 4, 2, 'JOHN REED', 'reedj@gmail.com', 'Exactly. This is a beautiful, awe inspiring example of an extreme. Just think what could happen if, just for a while we would turn all of our resources towards making Global every day life a pleasure for everyone World-Wide.', 'Approved', '2018-08-12'),
(8, 21, 3, 'RJ', 'rj@gmail.com', 'That Dodge Tomahawk is a mean machine straight out of Tron world. I go for the Porcupine. Nothing beats old school. It\'s got character that no turbo revving can match.', 'Approved', '2018-08-12'),
(9, 20, 3, 'Naman', 'naman@gmail.com', 'Why legendary british vintage black is so expensive but the tomahawk is great it and harley deserves their prices', 'Approved', '2018-08-12'),
(10, 19, 3, 'cosmic1', 'cosmic@gmail.com', 'The \"Cosmic Harley\" Starship, is beyond Amazing!', 'Approved', '2018-08-12'),
(11, 18, 3, 'PBNL', 'support@pbnl.com', 'Testing out comments!!!', 'unapproved', '2018-08-12'),
(12, 22, 4, 'Unknown', 'pgcurtisexecutiveproducer@gmail.com', 'Likewise like the bus we would like to see some interior of the bus. Would you have any available by November 17, 2018.', 'Approved', '2018-09-03');

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
(11, 1, 10),
(12, 3, 6),
(13, 3, 9),
(14, 3, 8),
(15, 3, 7),
(16, 3, 4),
(17, 3, 5),
(18, 1, 21),
(19, 1, 19);

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
(1, 1, 'Bugatti Chiron', 'Godwin', '2', '2018-07-16', 'image_7.jpg', '<h2><strong>Bugatti Chiron - $ 2.7 million</strong></h2><p>Heirs to the Veyron supercars, Bugati’s latest is quite high-priced and starts at around $2.7 million based on the present exchange rates. However, prices are expected to reach $3 million in the least, long before it hits the market. Touted as the ‘world’s most powerful, fastest, most luxurious and most exclusive production super sports car’ by the manufacturers, it is the vision of former VW czar Ferdinand Piech, who demanded the fastest cars from Bugatti.&nbsp;</p><p>So now here is a car handmade in an atelier, faster, more advanced and more powerful than the Veyron. It is a fine example of the collusion of aerospace and automotive engineering to produce a classic device that could give a speed of 268 mph. The 8.0 liter turbo-charged W-16, 1,500-horsepower engine is actually 300 more than the Super Sport, the fastest Veyron model. While its top speed has been limited to 261 mph on the road, its actual top speed is yet to be tested.&nbsp;</p><p>&nbsp;</p>', 'cars, bugatti', 0, 'published', 1, 0),
(2, 1, 'Pagani Huayra BC', 'Godwin', '2', '2018-07-16', 'image_10.jpg', '<h2><strong>Pagani Huayra BC - $2.8 million</strong></h2><p>Coming after the Pagani Huayra, the Pagani Huayra BC is the priciest Pagani car ever made. Named as a tribute to Benny Caiola, a noted Italian investor with probably the best collection of Ferraris and a very close friend of Horacio Pagani, this car is a delight for the lovers of Pagani’s details.</p><p>Debuting at the 2016 Geneva Motor Show, this car has a wider rear track, new side tracks, and many cool aero features. Like the earlier version, the 6.0 liter V-12 bi-turbo engine of the BC is sourced from AMG, and produces 790 horsepower and 811 lb-ft torque. This power is run to the rear wheels through the tripod drive shafts leveraging a 7-speed Xtrac transmission. And the most amazing bit is that the BC takes over the Huayra by changing the model’s standard 150 milliseconds to 75 milliseconds.&nbsp;</p><p>At 2,685 pounds (1,218 kilograms), the BC also happens to be a lot lighter than the Huayra due to the extensive use of carbon fibres and other lightweight materials.&nbsp;</p>', 'cars, pagani', 0, 'published', 1, 0),
(3, 1, 'Ferrari Pininfarina Sergio', 'Godwin', '2', '2018-07-16', 'image_12.jpg', '<h2><strong>Ferrari Pininfarina Sergio - $3 million</strong></h2><p>Originally introduced as a concept car in 2013 in memory of a deceased son of the founder of Pininfarina, the legendary Italian design house, only six of these cars have been made as of yet, thus becoming one of the most coveted cars. This is one of the costliest Ferraris ever made and is based on the Ferrari 458 Spider.&nbsp;</p><p>Each of the handmade units has an all-carbon-fibre frame, and is an open air <strong>luxury car</strong> with two seats. Like the Ferrari 458, it has no roof, side windows and windshield, and is 330 pounds lighter than its ancestor. This makes it smarter and quicker, though it has the same naturally-aspirated 4.5 liter F136F V-8 engine, which sends 562 hp to the rear wheels. The renovated interior also comes with a host of interesting details like aerodynamic headrests built directly into the roll cage.&nbsp;</p><p>The coolest fact about this car though is that the owners of each of the six models were chosen by the manufacturers themselves, making this one of the rarest of the rare invite-only vehicles.&nbsp;</p>', 'cars, ferrari', 0, 'published', 1, 0),
(4, 1, 'Aston Martin Valkyrie', 'Godwin', '2', '2018-07-16', 'image_16.jpg', '<h2><strong>Aston Martin Valkyrie - $3.2 million</strong></h2><p>While there has been no price announced for this car as of yet, expert estimates place it at around 3.2 million dollars. Built under Andy Palmer, the new president of Aston Martin committed to solvency and relevance with awesome cars, this model is a renovation of the old Aston Martin-Red Bull AM-RB 001.&nbsp;</p><p>Legend has it that Palmer agreed to this car over a drink with Red Racing’s Adrian Newey and Christian Horner. Newey, renowned aerodynamicist behind Red Bull’s <strong>expensive and award-winning sports cars</strong> in the Formula 1 tracks, devised an aerodynamic scheme specifically for this car that pushes air via the chassis, resulting in downforce without using the wings.&nbsp;</p><p>The 6.5 liter, naturally- aspirated V-12 designed specifically for the Cosworth, has a 1:1 power /weight ratio, and comes with a Rimac-built hybrid battery system coming with the engine which yields about a 1,000 horsepower. As of yet, 150 units of this model has been planned by the company, and the deliveries are expected to start 2019 onward. In addition, 25 track-only editions have been planned whose prices can only be speculated at present.&nbsp;</p>', 'cars, aston martin', 0, 'published', 5, 1),
(5, 1, 'Bugatti Veyron', 'Godwin', '2', '2018-07-16', 'image_21.jpg', '<h2><strong>Bugatti Veyron - $3.4 million</strong></h2><p>Upgraded four times since its releasze in 2005, the Mansory Vivere edition of the Bugatti Veyron is not only among the priciest cars of the world, but also one of the fastest.&nbsp;</p><p>Modelled on the Grand Sport Vitesse Roadster, this German car has an awesome lacquered carbon-fibre body along with a new spoiler package providing new diffusers, a smarter cabin and front grill, larger side scoops, a shortened hood, and the like. The upgraded LED lights are everywhere – the headlight and taillight clusters, the cockpit.&nbsp;</p><p>And for the aesthetically conscious, maps of history making events like the Targa Florio race and the like are laser etched into both the upholstered, carbon fiber interior, and the exterior. The 8.0 liter W16 engine of the car can produce 1,200 horsepower and 1,106 pound-feet of torque. The original version could reach up to 253 mph and was named the Car of the Decade 2000-2009.&nbsp;</p>', 'cars, bugatti', 0, 'published', 5, 1),
(6, 1, 'Lykan Hypersport', 'Godwin', '2', '2018-07-16', 'image_22.jpg', '<h2><strong>Lykan Hypersport - $3.4 million</strong></h2><p>The headlights being made of, urm, 240 15-carat diamonds, is the price very surprising? And then there are the LED blades made of 420 15-carat diamonds. And all the gems are customizable.&nbsp;</p><p>Looking like an armored car with scissor doors and an interior straight out of a sci-fi movie, this featured in the ‘Furious 7’, and has actually been drafted by the Abu Dhabi police for patrol duty!&nbsp;</p><p>Built by W Motors, based in Lebanon, this is the first Arab supercar. And it doesn’t fare badly when compared with the traditional European biggies. Apart from its awesome looks, the twin-turbo mid-rear mounted 3.8 liter flat-six boxer can produce 780 horsepower through the rear wheels, and a 708 pound-feet of torque. It can do a 62 in a mere 2.8 seconds, and can reach speeds up to 240 mph.&nbsp;</p>', 'cars, sport car, hypersport', 0, 'published', 6, 1),
(7, 1, 'McLaren P1 LM', 'Godwin', '2', '2018-07-16', 'image_25.jpg', '<h2><strong>McLren P1 LM - $3.6 million</strong></h2><p>Not a production car, this is more or less a street-legal version of the track-only McLaren P1 GTR. Converted by the British firm Lanzante, who bought the original P1 built by McLaren, it was made keeping in mind a select group of buyers in the U. S., Japan, U. K., and the UAE.&nbsp;</p><p>This car has a lot in common with the P1 GTR and the legendary McLaren F1 road car. For example, the gold plating surrounding the engine bay with a 3.8 liter twin-turbo V-8. It is much smarter than the P1 GTR. Not only does it weigh 132 pounds (60 kg0 less than the P1 GTR, but its modified rear wing and enlarged front splitter join with the dive planes to generate 40% increased downforce as compared to the P1 GTR.&nbsp;</p><p>The awesomeness of the aerodynamics can be witnessed where it is made for- on track, where it can produce 1000 horsepower. As of yet, only five units have been built, all of them being sold.&nbsp;</p>', 'cars, mclaren', 0, 'published', 7, 1),
(8, 1, 'Lamborghini Veneno Roadster', 'Godwin', '2', '2018-07-16', 'image_28.jpg', '<h2><strong>Lamborghini Veneno Roadster - $4.5 million</strong></h2><p>Built to celebrate the company’s 50th birthday, ‘Veneno’ literally means poison in Spanish, and well, the design does look deadly. Looking almost like an alien space capsule, this car can reach speeds that can give one of those a run for their money, literally. The 6.5 liter V12 with a seven-speed single clutch ISR automated manual transmission can spin at 8,400 rpm to yield 740 horsepowers and 507 pound-feet of torque, meaning that the car can do a 60 mph at 2.9 seconds!&nbsp;</p><p>The monoque is heavily inspired by the LP700-4 Aventador, and is made of carbon fiber. The sprung portion is placed on the top of a pushrod-actuated suspension, and its total dryweight of this carbon-fiber vehicle is a mere 3,285 pounds, although it is driven by a full all-wheel-drive system.&nbsp;</p><p>Only 9 units being made, the biggets problem of these cars is their crazy resells rates- one was sold at $11 millions! It was the most expensive car in the world ever produced upon its introduction, and only three being available to customers in the first lot, there was a crazy scramble to get hands on the remaining ones.&nbsp;</p>', 'cars, lamborghini', 0, 'published', 6, 1),
(9, 1, 'Koenisegg CCXR Trevita', 'Godwin', '2', '2018-07-16', 'image_31.jpg', '<h2><strong>Koenisegg CCXR Trevita - $4.8 million</strong></h2><p>The most expensive street-legal production car in the world, this is coated with real diamonds. Yes, you read that right. ‘Trevita’ is an abbreviation translating into ‘three whites’. The carbon fibers are indeed coated with a diamond dust-impreganted resin, called the Koenigsegg Proprietary Diamond Weave. This technology transformed the fibres from the traditional black to shining, silvery white, making the bodywork of this car renowned throughout for its unique design and perfection.&nbsp;</p><p>And that’s not all. Beneath the coating is a 4.8 liter, dual-supercharged V8 having a total output of 1,004 horsepower and 797 pound-feet of torque. This makes it well-equipped at overtaking semis in the freeway. This car comes with a one-of-its-kind dual carbon rear wing, iconell exhaust system, airbags, ABS powered carbon ceramic brakes, paddle-shift, infotainment system, chronometer instrument cluster, tires monitoring systems along with a hydraulic system.&nbsp;</p><p>Only three cars of this model had been initially decided upon, before getting reduced to two, because the carbon fibre made it too difficult and time-consuming for regular manufacture.</p>', 'cars, koenisegg', 0, 'published', 5, 1),
(10, 1, 'Sweptail', 'Godwin', '2', '2018-07-16', 'image_33.jpg', '<h2><strong>Sweptail by Rolls Royce - $13 million</strong></h2><p>Before you gasp at the price, do note that this car is off the markets. That’s because it was made on the recommendations of one specific customer whose name the company has refused to divulge. A company famous for its <strong>luxurious</strong> rollouts, there were only 4,000 Rolls Royce cars manufactured in 2016!&nbsp;</p><p>This particular <strong>exclusive car</strong> comes with its custom coach work, reminiscent of the royal carriages of yore. Probably modeled on the Wraith, this car can seat only two people (see what they mean by being exclusive?). The sunroof is fully panoramic, tapering down sharply like those of the racing yachts, as per the orders of the customer.&nbsp;</p><p>Something very cool about the interior handcrafted with wood and leather are the hidden attaché cases for holding laptops behind each door. Not much else is available on this <strong>most expensive car in the world</strong>, except that it is based on the 1920s and 30s models, and looks like a yacht from the back. The owner does happen to be a collector of super-yachts and private planes.&nbsp;</p>', 'cars, rolls royce', 0, 'published', 90, 1),
(11, 2, 'Ducati Testa Stretta NCR Macchia Nera Concept', 'Tobiloba', '3', '2018-08-12', 'image_37.jpg', '<h2><strong>Ducati Testa Stretta NCR Macchia Nera Concept - $225,000</strong></h2><p>Motorcycles are priced for their technical performance, designs, frameworks and outlook. Another way is to manufacture only a certain number of them, to make them limited edition.</p><p>Ducati Macchia Nera may not compete with the other big bikes in this list in terms of pure speed - notwithstanding that <i>Macchia Nera</i> or <i>Block Spot</i> humorously suggests you could create a charred pavement behind while driving it - but titanium and carbon fiber materials to render it impressively lightweight at 297 pounds, artistic contribution by visionary designer Aldo Drudi, and only a number of them made available convinced most aficionados the price is justified to ensure the model makes it to their collection.</p>', 'automotives, ducati', 0, 'published', 1, 0),
(12, 2, 'Ducati Desmosedici D16RR NCR M16', 'Tobiloba', '3', '2018-08-12', 'image_38.jpg', '<h2><strong>Ducati Desmosedici D16RR NCR M16 – $232,500</strong></h2><p>NCR starts with a $72,500 Desmosedici D16RR and reworks it to make it lighter and more powerful. The result: the $232,500 road missile NCR Millona 16.</p><p>Where does the money go? Carbon fiber everywhere on the M16, check, including load-bearing parts such as the frame, swingarm and wheels. The fuel tank, fairing, tail and fenders are carbon too. Mechanical parts are either titanium, right down to the bolts, or avionic-grade aluminum.</p><p>A stock 989cc V-four Ducati motor sends around 175 horsepower to the back wheel, but NCR has tuned the M16 to send 200-plus hp to the tarmac. Current-generation MotoGP suspension helps get that power down, and the M16 also uses race-style electronics with traction control, data recording and user-selectable maps.</p><p>Without gas, M16 is claimed to weigh at 319 lbs (145 kg), lighter than the regulation 330 lb minimum of a four-cylinder MotoGP bike.</p>', 'automotives, ducati', 0, 'published', 0, 0),
(13, 2, 'Ecosse FE Ti XX Titanium Series', 'Tobiloba', '3', '2018-08-12', 'image_39.jpg', '<h2><strong>Ecosse FE Ti XX Titanium Series – $300,000</strong></h2><p>Back in 2007, many thought a $300,000 price tag for a big bike was insane, no matter if it sported the mostest in every detail that mattered. How times have changed, and in ten years &nbsp;$300,000 easily lost its number one spot, instead going good only for an eighth place in the top ten most expensive big bikes in the world.</p><p>The FE Ti XX is powered by a 2,409cc billet aluminium engine transmitting 228PS of power to the rear wheel. Carbon fiber has been used abundantly on the bike to keep the weight low. The saddle has been handcrafted by posh Italian leather virtuoso Berluti. Its grade-9 titanium exhaust pipes have a ceramic media shot-peened finish on them.</p><p>Those who managed to get their hands on the FE Ti XX no doubt belong to a tightly exclusive lot, as only 13 units of them were ever made.</p>', 'automotives, ecosse', 0, 'published', 0, 0),
(14, 2, 'Dodge Tomahawk V10 Superbike', 'Tobiloba', '3', '2018-08-12', 'image_40.jpg', '<h2><strong>Dodge Tomahawk V10 Superbike – $550,000</strong></h2><p>If you think the Dodge Tomahawk V10 Superbike suspiciously looks like a 4-wheel Dodge squeezed on both sides, you won’t be alone. This Tomahawk V10 Superbike is a strange beast indeed, and not just because it uses a V10 four-stroke Dodge Viper engine that could easily power up any chassis with more than two wheels attached to it to give you the feeling of being dragged by a fleet of 500 supercharged ponies looking forward to storm the Bastille. Now talk about the soul of two-wheel steeds!</p><p>As introduced in 2003, the one-of-a-kind Tomahawk was operational and road-ready, but not fully road-tested. At the minimum, this Tomahawk is capable of reaching 60 mph (96.5 kph) in about 2.5 seconds with a theoretical top speed of 400 mph. In practice, it’s hard to imagine anyone willing to prove it. Evel Knievel probably, but he’s long retired at the time of the Tomahawk’s release and now he’s dead. Would you, however?</p><p>You might have serious doubts riding this big bike, but certainly many enthusiasts are more than eager to walk this monster to their garage. This Tomahawk whose components were custom-milled from blocks of aluminum sure would not fail to catch the eyes of everyone in any showroom.</p>', 'automotives, dodge', 0, 'published', 0, 0),
(15, 2, 'Harley Davidson Cosmic Starship', 'Tobiloba', '3', '2018-08-12', 'image_41.jpg', '<h2><strong>Harley Davidson Cosmic Starship – $1.5 million</strong></h2><p>What used to occupy first place in many top-ten list of most expensive big bikes is now only good for a sixth position. However, it claims to have been sold at $3.5 million and is now up for sale at $12 million. If that happens, it should recapture the crown it once had—or not, since we don’t imagine the rest of the entries here would remain with static prices days ahead too.</p><p>Not a few people already consider most big bikes as a work of art in their own right, so making one that is a literal work of art is the next obvious step. Right?</p><p>Harley Davidson appears to think so, and in their Cosmic Starship, they partnered with the famed rebel cosmic existentialist artist Jack Armstrong to apply yellow-and-red paint over a Harley V-rod and originally sold it at a flat $1 million dollars after much fanfare broadcast all over the world. &nbsp;</p><p>If you bought a Cosmic Starship, though, you would want to think twice before parading such prized treasure all over the place.</p><p>What to do? You could strip the painted parts and secure it in a vault and replace with regular parts, but that is hardly a wise decision. Art and machine went out together and priced with that combo consideration. Your next best choice is shell out another &nbsp;$16,000 and buy a V-rod that came without that art paint on it. Which brings us to another reality: that artwork is worth $984,000. But when you consider that some of Armstrong’s works go for $3 million, there really is no reason to balk about the added price.</p>', 'automotives, harley', 0, 'published', 0, 0),
(16, 2, 'BMS Nehmesis', 'Tobiloba', '3', '2018-08-12', 'image_42.jpg', '<h2><strong>BMS Nehmesis – $3 million</strong></h2><p>The first thing you would notice about the BMS Nehmesis is the yellow glitter and absence of side stand, making it look like it’s lying flat on its underbelly like a marooned whale.</p><p>“Would it even run?” you ask yourself.</p><p>In fact it would: fully functional, it incorporates an air-ride system that, along with the single-sided swingarm rear suspension, can lift the motorcycle 10 inches or lower it right onto the ground. This renders a side stand unnecessary, as Nehmesis softly lands on its frame rails when it’s time to park.</p><p>As for the yellow glitter, that’s the 24-karat gold for you. This easily explains the $3 million tag price, and everyone sure would understand if you wouldn’t want to let it out of your house from the day of purchase. Most likely you’d want a showroom installed in front of the house, raised to a spectacular level so everybody gets a good view of your jewel. Make the showroom at least large enough to move about a bit with the Nehmesis for more satisfaction.</p>', 'automotives, bms', 0, 'published', 0, 0),
(17, 2, 'Hildebrand & Wolfmuller', 'Tobiloba', '3', '2018-08-12', 'image_43.jpg', '<h2><strong>Hildebrand &amp; Wolfmuller – $3.5 million</strong></h2><p>History is expensive, and at $3.5 million your purchase would send you back 124 years ago to 1894 when this first production motorcycle appeared on the scene.</p><p>Heinrich and Wilhelm Hidebrand were steam-engine engineers before they teamed up with Alois Wolfmüller to produce their internal combustion Motorrad in Munich in 1894. This momentous event started sending the flesh-and-blood steeds out of fashion, reinventing themselves as emblem of the refined gentry, while the special breed of men simply moved on and transferred their affections to the two-wheeled metallic petrol-guzzling steeds that took over the roads.</p><p>If you manage to get your hands on this and want to literally have a go at history by testing how it handles on the road, better watch for a bit of fun fact: with neither clutch nor pedal, be prepared to run and jump with this ancient one. On the other hand, your family, financial adviser, or friends would probably just drag you and bike to safety like the madman you are for putting such a substantial investment at risk.</p>', 'automotives, hilderbrand', 0, 'published', 0, 0),
(18, 2, 'Ecosse ES1 Spirit', 'Tobiloba', '3', '2018-08-12', 'image_44.jpg', '<h2><strong>Ecosse ES1 Spirit – $3.6 million</strong></h2><p>When a bike manufacturer requires even a professional driver to first take a two-week training before trying to ride one of its models, you just know something is up with this bike.</p><p>And why not, indeed. This is not two-wheel machine as traditionally defined: first, there is no chassis framework to speak of. Swingarm and rear suspension attach to the gearbox, and front suspension to the engine. The much touted 265 pounds speck of a weight comes from eliminating the extra pounds associated with transmitting front-wheel forces up a slender fork through a steering-head then back down to the rest of the machine. The front suspension consists of twin A-arms, projecting forward, their apices defining a steer axis and carrying an upright from which projects the front-wheel spindle. The lower A-arm is, in effect, a single-sided swingarm. To avoid the “muddy” steering feel of earlier articulated front ends, the handlebars are on the upward-projected steer axis, their motions so defined that resulting feel will be like that of the familiar direct-steering telescopic fork.</p><p>An integrated bespoke transverse inline-Four engine, driver sitting in a position that allows the knees to be close to the body for greater ergonomics and control, that unique front and back carbon fiber suspension, and handlebars mounted to the front fork for superior front tire control all enable the ES1 Spirit to perform like a truly F1 car as its two British and American engineers envisioned.</p><p>Nothing better caps these impressive technical details than the knowledge that the likely purchaser is going to be only one of ten exclusive owners of this two-wheel heaven</p>', 'automotives, ecosse', 0, 'published', 2, 0),
(19, 2, '1949 E90 AJS Porcupine', 'Tobiloba', '3', '2018-08-12', 'image_45.jpg', '<h2><strong>1949 E90 AJS Porcupine – $7 Million</strong></h2><p>A bike manufacturer with a rich history and winning racetrack heritage marred by several financial turbulence early on, AJS could only manage to produce 4 Porcupine units in 1949. As it turned out, one of these under the very able hands of Les Graham won the 1949 World Championship.</p><p>An open frame, aluminium alloy, 500cc, DOHC twin engine with horizontal cylinders and heads give the Porcupine a low centre of gravity. It uses what’s called “Jam-pot” shocks and Teledraulic race forks. The design and manufacturing decisions made by AJS first through the original owners and then through the succeeding ones read like a virtual and veritable source of what-to-do ideas for any aspiring bike professional.</p><p>Having lived through the Cold War itself, the veteran Porcupine then spent twenty years in the Coventry National Motorcycle Museum before being made available for the refined enthusiast with a deep pocket to match.</p>', 'automotives, porcupine', 0, 'published', 0, 1),
(20, 2, 'Neiman Marcus Limited Edition Fighter', 'Tobiloba', '3', '2018-08-12', 'image_46.jpg', '<h2><strong>Neiman Marcus Limited Edition Fighter – $11 million</strong></h2><p>Steampunk triumphs with the Neiman Marcus Limited Edition Fighter! There, that’s out first thing. Now to the details.</p><p>Whoever saw it coming that Neiman Marcus Limited Edition Fighter would later claim pole position at any top ten list of big bikes is probably a seer of the highest order, especially when one considers how it began the market at a “humble” $110,000. And mind you, Neiman Marcus is a name you would rightly connect with department store rather than a superbike.</p><p>The unique clockwork design, however, seems to have taken care of all that. The bike’s eye-catching chassis, carved from a single piece of metal, proved to be an extreme hit with enthusiasts. As it turned out, even Apple just used the same approach for its new laptop case at the time. Many design experts agreed: this is styling at its best, where the utility of the vehicle is styled rather than hidden from sight.</p><p>When reviewers first saw the bike, they were simply knocked over by its evolutionary style. Neiman rightly pounced on the immediate trance-like reaction and came up with this line: “It’s an evolution of the machine, at once taken back down to its core elements while being reinvented and re-engineered for optimal performance. It’s our street-legal sci-fi dream come to life, in the form of the limited-edition Fighter Motorcycle.”</p><p>How limited? As it stands, only 45 of this Fighter is ever released in the market.</p><p>Despite the $11 million price tag and mean looks, the Neiman Marcus Limited Edition Fighter is completely street-legal, managing the road at a 190 mph top speed, the power coming from a 120ci 45-degree air-cooled V-Twin engine complemented by titanium, aluminum, and carbon fiber body parts.</p>', 'automotives, neiman', 0, 'published', 0, 0),
(21, 2, 'Suzuki AEM Carbon Fiber Hayabusa', 'Tobiloba', '3', '2018-08-12', 'image_47.jpg', '<h2><strong>Suzuki AEM Carbon Fiber Hayabusa $200,000</strong></h2><p>Suzuki released the 1300cc Hayabusa in 1999 and followed it up with the AEM Carbon Fiber Hayabusa in 2008. Easily capable of reaching speeds of over 188 miles per hour, the Hayabusa claimed the title of the world’s fastest production motorcycle, a distinction it still holds to this day. It probably would have shot for more ways to destroy roads, had it not made nannies in Europe overly nervous to slap a street-legal speed limit of 186 mph for anything that shows movement in the road with something resembling two wheels.</p><p>But behind a man’s passion for a motorbike is the heart of a rebel, and the phrase “fastest production motorcycle” is a dead giveaway for the rebels to push the performance of the Hayabusa even more. Going with technical modifications and replacing as much part with carbon fiber did the trick, never mind the new sky-high price tag that went with it.</p><p>Experts hail the Hayabusa’s all-around performance, citing how it does not drastically compromise other qualities like handling, comfort, reliability, noise, fuel economy or price in pursuit of a single function.</p>', 'automotives, suzuki', 0, 'published', 2, 1),
(22, 3, 'Marchi Mobile Elemment Palazzo', 'Kenny', '4', '2018-09-03', 'image_48.jpg', '<h2><strong>Marchi Mobile Elemment Palazzo - $3,000,000</strong></h2><p>The Marchi Mobile Elemment Palazzo is an listed at the first position in the list of top 10 most expensive buses in the World, which is truly looks like something same a futuristic Hollywood buckbuster. Its cockpit wouldn\'t be out of place in a star trek feature, with a circular central window for panoramic vision. Inside the bus, found a luxury hotel, such as hand-cut wooden flooring, marble finishing and a staircase that leads to the vehicle\'s upper desk.</p>', 'marchi, mobile, elemment, palazzo, bus', 0, 'published', 38, 0),
(23, 3, 'Featherlite Vantare Platinum Plus', 'Kenny', '4', '2018-09-03', 'image_56.jpg', '<h2><strong>Featherlite Vantare Platinum Plus - $2,500,000</strong></h2><p>Featherlite Vantare Platinum Plus is a second most expensive bus in the World. Inside, there are custom-built sculptures on the ceiling surrounded by Swarovski crystals, marble steps leading up to the cabin, rare Inca marble, copper, pearlized Italian leather, and many more ridiculously expensive materials and decorations, making this a true mansion on wheels. The master bedroom is equipped with a king bed with a full HD plasma TV that lifts out of the floorboard, bath hardware from France, a washer and dryer, and a built-in treadmill</p>', 'featherlite, vantare, platinum, bus', 0, 'published', 0, 0),
(24, 3, '2015 Prevost H3-45 VIP ', 'Kenny', '4', '2018-09-03', 'image_49.jpg', '<h2><strong>2015 Prevost H3-45 VIP - $1,600,000</strong></h2><p>The Prevost H3-45 VIP bus is a part of the H-series, is one of two lines from the luxury RV makers at Prevost. The company describes it as the \"sleek and modern\" line, whereas the other series, the X-series is dubbed \"timeless and classic\". It is the tallest converted luxury coach, standing at 12 feet 5 inches, giving unparalleled roominess, the industry\'s highest cabin floor, and unmatched panoramic views for the driver and passengers.</p>', 'prevost, vip, bus', 0, 'published', 0, 0),
(25, 3, '2015 Foretravel IH-45 Luxury Motor Coach ', 'Kenny', '4', '2018-09-03', 'image_50.jpg', '<h2><strong>2015 Foretravel IH-45 Luxury Motor Coach - $1,300,000</strong></h2><p>The Foretravel has been in the Motorhome-building business since 1967, located out of Nacogdoches, the \"Oldest Town in Texas\". The IH-45 is a 45\' expensive luxury motor coach with completely custom and unique designs. It is configured with many luxury features that set it apart from the competition include a 20,000 kilowatt generator, slide-out rooms, a Knoedler air-ride pilot seat, 4 roof A/C units, and a steel constructed cockpit, walls and floor.</p>', 'foretravel, luxury, motor, bus', 0, 'published', 0, 0),
(26, 3, '2014 Country Coach Prevost', 'Kenny', '4', '2018-09-03', 'image_51.jpg', '<h2><strong>2014 Country Coach Prevost - $1,000,000</strong></h2><p>This luxury coach isn\'t for riding over rugged terrain or adventurous use, but it\'s perfect bus for those who want to enjoy traveling in luxury between cities and towns. This converted bus is an amazing touring machine, with functional elegance, a sleek stainless-steel shell, and an aerodynamic profile.</p>', 'prevost, bus', 0, 'published', 0, 0),
(27, 3, '2015 Newmar King Aire', 'Kenny', '4', '2018-09-03', 'image_52.jpg', '<h2><strong>2015 Newmar King Aire - $740,650</strong></h2><p>The Newmar King Aire will have you ruling the road and campsite, built to showcase its luxury, innovation and quality. This bus Class A motor powered by a 600HP Cummins ISX turbo diesel engine, and supported by a custom-built Spartan K3 chassis. It is configured with a Comfort Drive steering system with power control, and a Safety Cruise Collision Avoidance system to help you navigate through adverse weather and hazards.</p>', 'newmar, king, aire, bus', 0, 'published', 0, 0),
(28, 3, '2015 Monaco Dynasty 45P', 'Kenny', '4', '2018-09-03', 'image_53.jpg', '<h2><strong>2015 Monaco Dynasty 45P - $585,000</strong></h2><p>The Monaco is one of the leaders in luxury RVs, and the all-new 2015 Dynasty is their most ambitious creation yet. It is configured with an all-new Roadmaster chassis with a 600HP Cummins engine, and its design drew on opinions from current Monaco owners so that the company could create a product inspired by their customers, for their customers.</p>', 'monaco, dynasty, bus', 0, 'published', 1, 0),
(29, 3, 'UNICAT Amerigo International', 'Kenny', '4', '2018-09-03', 'image_54.jpg', '<h2><strong>UNICAT Amerigo International - $500,000</strong></h2><p>The UNICAT Amerigo International looks a bit like a garbage truck, but its humble exterior is deceptive. Its body doesn\'t provide very much to look at in terms of \"luxury\", but its interior that counts here - and that adds up to half a million dollars.</p>', 'amerigo, bus', 0, 'published', 0, 0),
(30, 3, 'Country Coach Magna 630', 'Kenny', '4', '2018-09-03', 'image_57.png', '<h2><strong>Country Coach Magna 630 - $495,000</strong></h2><p>This beautiful 40\' bus-converted RV is another most expensive luxury bus in the World, was created by the luxury RV company Country Coach. It is powered by a 600HP Cummins engine, and it climbs over mountains beautifully when towed thanks to its power tilt and telescope wheels. The interior is fully decorated with walnut cabinets and earth tones, as well as a custom sofa, queen-sized bed, chairs, a washer and dryer, a dinette booth, and a tiled entry step.</p>', 'magna, bus', 0, 'published', 0, 0),
(31, 3, '2015 Entegra Coach Cornerstone 45DLQ', 'Kenny', '4', '2018-09-03', 'image_55.jpg', '<h2><strong>2015 Entegra Coach Cornerstone 45DLQ - $464,000</strong></h2><p>The Entegra Coach gives drivers a cab-forward design, including eight-way power seats and SmartWheel integrated steering to make the ride comfortable, while also offering advanced Mobile and touch screen technology.</p>', 'entegra, cornerstone, bus', 0, 'published', 21, 0);

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
(1, 'Israel', 'Obanijesu', 'PBNL', 'israelobanijesu2@gmail.com', '$2y$12$mUHdepQnc8Ifhxl59V.MoOGzUuSvzSGYi67/Dn4dD50hraTaQoC6m', '', 'admin', ''),
(2, 'Godwin', 'Ngaju', 'Godwin', 'ngajugodwingt00565@fpt.edu.vn', '$2y$10$UGPfvbS7t7hHwTtcLG5QHO6MhvQH9BjeRQm3pS2FkIBcST.HBSDbW', '', 'subscriber', '3f3fb2ce97bfe75111dbe2a55d90263c99a44da56cba71e6f118f1bafa64eae3527f7a76ad14c75d76d0be38a606b4aa2867'),
(3, 'Tobiloba', 'Adeyinka', 'Tobiloba', 'adeyinkagch16001@fpt.edu.vn', '$2y$10$YFrK4gQS0NdfOTNNre3cMOhRJJQnyUfz4pyLFSMVjpUW.vM8ytcPG', '', 'subscriber', ''),
(4, 'Oluwasami', 'Kehinde', 'Kenny', 'oluwasamikehinde@gmail.com', '$2y$10$AeKJ.7qN3He.hd.f9dK3dOnuter/4u4wbSIL0sprUvV6X24I77PAi', '', 'subscriber', ''),
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
(4, 'm8pq01dsjqtali56upi8aldnk1', 1531603041),
(5, 'ekqaalggeerq2omrain1550hqu', 1534326626),
(6, '20eo92o7e840mkvl24l31n4q4r', 1534825833),
(7, 'akpptm8noc7k8aqhsr7i9sb05c', 1534937646),
(8, 'ik359vnrr4s17ord5ctdktd70r', 1535992506),
(9, 'tf112ljnum7rl1tqgjhe91ostu', 1536062966);

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
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
