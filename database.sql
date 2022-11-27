-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2022 at 04:11 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doppell-real`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prd_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `prd_id`, `quantity`) VALUES
(157, 33, 9, 4),
(163, 33, 7, 1),
(164, 33, 4, 1),
(165, 33, 1, 5),
(166, 33, 10, 2),
(167, 33, 6, 1),
(168, 33, 11, 2);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `cat_slug` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_slug`) VALUES
(1, 'headphones', 'headphones'),
(2, 'laptops', 'laptops'),
(3, 'phones', 'phones'),
(4, 'laptop accessories', 'laptop_accessories'),
(5, 'phone accessories', 'phone_accessories'),
(6, 'uncategorized', 'uncategorized');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment_text` varchar(255) NOT NULL,
  `comment_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `comment_text`, `comment_status`) VALUES
(1, 1, 'This is a test comment. How are you doing?', 1),
(2, 2, 'hello again', 1),
(3, 3, 'I am tired', 1),
(4, 4, 'Hello, this is the test comment for top 10 gaming laptops', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_slug` varchar(255) NOT NULL,
  `post_image` varchar(255) NOT NULL,
  `post_content` varchar(10000) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `post_day` int(11) NOT NULL,
  `post_month` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_title`, `post_slug`, `post_image`, `post_content`, `post_author`, `post_date`, `post_day`, `post_month`) VALUES
(1, '3 accessories you need to get for your laptop FAST!', '3_accessories_you_need_to_get_for_your_laptop_fast', 'laptop-accessories.jpeg', '<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iusto iure possimus magnam laboriosam repellat eius voluptatem ullam illum inventore natus doloribus, culpa quia tempora sint est odio exercitationem. Perferendis nobis architecto rerum repudiandae atque, autem cumque fugiat. Distinctio, non corrupti?</p>\n\n<h2>1. Perferendis nobis</h2>\n<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Deserunt fugiat vel asperiores quibusdam aperiam nostrum explicabo, recusandae consectetur laudantium tempora voluptas eius praesentium inventore facilis itaque enim in totam rem error numquam aliquam laborum. Natus asperiores aliquid esse quas dolorum ut fugit aut, delectus itaque doloremque numquam nam sapiente libero nobis suscipit fuga praesentium qui nisi ab nulla a hic rerum ducimus? Illo, quaerat commodi?</p>\n\n<h2>2. Doloremque numquam nam sapiente</h2>\n<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sit libero mollitia amet sequi harum tenetur, aliquid voluptatibus nulla perspiciatis! Facere culpa deleniti itaque, aspernatur qui earum architecto reprehenderit optio sed libero mollitia animi cupiditate suscipit laboriosam blanditiis enim at impedit eius distinctio nihil ipsa vitae hic error quos! Dicta laborum repellat repudiandae praesentium vero ullam sequi facere?</p>\n\n<h2>3. Impedit eius distinctio</h2>\n<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolore soluta quidem magnam minus, suscipit corrupti reiciendis ullam ipsam quisquam voluptas nesciunt doloribus possimus commodi saepe fuga deserunt, ducimus eligendi. Tenetur praesentium animi eveniet distinctio, laboriosam pariatur. Magnam rem exercitationem veniam, fuga modi alias pariatur asperiores doloremque sit iusto dolorem soluta quo ad culpa ducimus aperiam aspernatur nesciunt quos.</p>', 'Taiwo Adewale', '2022-05-25 02:58:47', 17, 'Nov'),
(2, '5 signs you are addicted to your phone', '5_signs_you_are_addicted_to_your_phone', 'phone addiction.jpg', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias est vel tempore hic, voluptatem aut laudantium ipsa odio dolorum molestiae in, dolorem deleniti quas consequatur. Quo deserunt ab recusandae iusto.</p>\n\n<h2>1. Dolorum molestiae</h2>\n<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestiae vero sed quisquam ut nemo reprehenderit voluptatibus quaerat, laboriosam id soluta delectus accusantium molestias consequatur perspiciatis. Odio in atque, aspernatur, mollitia vero eius assumenda molestias rerum sint provident harum numquam culpa magnam sed. Quaerat veritatis temporibus suscipit, molestias numquam optio esse!</p>\n\n<h2>2. Consequatur perspiciatis</h2>\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium amet repellat nam esse recusandae fuga numquam voluptas neque, pariatur doloribus modi rem voluptate sunt hic quibusdam id eveniet enim voluptatum ad tempora? Non iure explicabo cumque optio possimus unde impedit!</p>\n\n<h2>3. Pariatur doloribus modi</h2>\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio enim quo voluptatum quas doloremque. Cum velit quam libero distinctio, blanditiis est iusto quo ratione fuga architecto, quia facilis, amet nemo. Dignissimos totam eos eius repellat voluptate ducimus. Temporibus odio optio non sint nisi ab qui ratione et maxime dolores unde, veniam ipsum explicabo similique reprehenderit molestiae, vero exercitationem eius recusandae!</p>\n\n<h2>4. Veniam ipsum</h2>\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid rerum aspernatur molestias eos reprehenderit repellendus libero numquam iusto qui ullam sequi odio, eum eius perspiciatis tempore placeat dolore officia ut ab deleniti vel odit est.</p>\n\n<h2>5. Repellendus libero numquam</h2>\n<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolorum accusantium quisquam, eius voluptas repudiandae rerum numquam! Tempore, minima. Debitis repudiandae corrupti eveniet rem labore molestiae quod enim laudantium deleniti beatae excepturi laborum unde modi numquam dolores, cum necessitatibus accusamus. Quasi facilis officia repellendus dignissimos quisquam.</p>', 'Michael Vardy', '2022-05-25 03:29:57', 4, 'Mar'),
(3, 'Micro USB vs USB type C', 'micro_usb_vs_usb_type_c', 'usb-typeC-vs-micro-usb.jpg', '<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Tempora natus reprehenderit enim magnam libero voluptate dignissimos repellendus excepturi voluptatum quis iste, minus officia suscipit ipsam debitis laboriosam ex est nam sunt quidem quo, ipsa accusantium? Odit, esse consectetur ab illum voluptas ex neque est dolores inventore ut, non voluptatum iste quam? Repellat quae voluptate itaque provident praesentium numquam distinctio veritatis sunt odit. Ducimus cupiditate ipsum beatae, laborum molestias unde soluta molestiae dolores placeat reiciendis eligendi itaque, debitis quas fugiat obcaecati, iste iure. Quia architecto voluptatum nostrum perferendis. Placeat magni corporis cupiditate exercitationem veniam suscipit veritatis perferendis? Aspernatur ut voluptatum quis.</p>\r\n\r\n<h2Micro USB</h2>\r\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem iure expedita, explicabo perspiciatis minima obcaecati blanditiis tenetur placeat suscipit distinctio sed ullam beatae fugit magni laborum, dolorum illum veniam necessitatibus.</p>\r\n\r\n<img src=\"images/micro-usb.jpg\" alt=\"a micro usb cable\">\r\n\r\n<h3>Pros</h3>\r\n<ul>\r\n<li>Ernatur ut voluptatum quis.</li>\r\n<li>Voluptatum nostrum perferendis</li>\r\n</ul>\r\n<h3>Cons</h3>\r\n<ul>\r\n<li>Repellat quae</li>\r\n<li>Sunt quidem quo</li>\r\n<li>Ipsam debitis laboriosam</li>\r\n</ul>\r\n\r\n<h2>Type C</h2>\r\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem iure expedita, explicabo perspiciatis minima obcaecati blanditiis tenetur placeat suscipit distinctio sed ullam beatae fugit magni laborum, dolorum illum veniam necessitatibus.</p>\r\n\r\n\r\n<img src=\"images/usb type c.jpg\" alt=\"a micro usb cable\">\r\n\r\n<h3>Pros</h3>\r\n<ul>\r\n<li>Ernatur ut voluptatum quis.</li>\r\n<li>Voluptatum nostrum perferendis</li>\r\n<li>Ipsam debitis laboriosam</li>\r\n</ul>\r\n<h3>Cons</h3>\r\n<ul>\r\n<li>Repellat quae</li>\r\n<li>Sunt quidem quo</li>\r\n</ul>\r\n', 'Michael Vardy', '2022-05-25 03:43:06', 23, 'Jul'),
(4, 'Top 10 Gaming Laptops of 2022', 'top_10_gaming_laptops_of_2022', 'gaming-laptop-students.jpeg', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam in adipisci repudiandae repellendus, recusandae tenetur beatae facilis ullam consequatur autem! Nihil incidunt cum autem at ipsam maiores in alias distinctio! Reprehenderit, praesentium. Nemo, perspiciatis corrupti eum cupiditate odit libero fugiat explicabo itaque sit rerum amet voluptatum voluptate enim sint fugit inventore, temporibus, ea ipsam aspernatur mollitia labore? Animi quis nam soluta similique hic cum incidunt error quae, nesciunt a odio atque possimus distinctio labore quisquam repellat corporis libero quia ipsam enim temporibus? Et dignissimos dolorem sit ipsa ad debitis eligendi aliquid? Ducimus provident minus id ipsa perspiciatis atque omnis harum.</p>\r\n\r\n<img src=\"images/HP-Omen-15-1024x576.jpg\" alt=\"hp omen laptop\">\r\n\r\n<h2>Budget Gaming Laptops</h2>\r\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam in adipisci repudiandae repellendus, recusandae tenetur beatae facilis ullam consequatur autem! Nihil incidunt cum autem at ipsam maiores in alias distinctio! Reprehenderit, praesentium. Nemo, perspiciatis corrupti eum cupiditate odit libero fugiat explicabo itaque sit rerum amet voluptatum voluptate enim sint fugit inventore, temporibus, ea ipsam aspernatur mollitia labore? Animi quis nam soluta similique hic cum incidunt error quae, nesciunt a odio atque possimus distinctio labore quisquam repellat corporis libero quia ipsam enim temporibus? Et dignissimos dolorem sit ipsa ad debitis eligendi aliquid? Ducimus provident minus id ipsa perspiciatis atque omnis harum.</p>\r\n\r\n<img src=\"images/ASUS-Zephyrus-Duo-15-SE-review-1.webp\" alt=\"asus duo 15 laptop\">', 'Taiwo Adewale', '2022-05-25 03:53:15', 19, 'Apr');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prd_id` int(11) NOT NULL,
  `prd_name` varchar(100) NOT NULL,
  `prd_slug` varchar(255) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `prd_image` varchar(100) NOT NULL,
  `prd_price` int(11) NOT NULL,
  `prd_description` varchar(10000) DEFAULT NULL,
  `prd_stock` int(11) NOT NULL,
  `prd_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `prd_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prd_id`, `prd_name`, `prd_slug`, `cat_id`, `prd_image`, `prd_price`, `prd_description`, `prd_stock`, `prd_date`, `prd_status`) VALUES
(1, 'Sony PS4 Wireless Controller', 'sony_ps4_wireless_controller', 4, 'Sony PS4 Wireless controller.jpg', 63000, NULL, 50, '2022-10-03 19:20:58', 1),
(2, 'Xbox One Wireless Controller', 'xbox_one_wireless_controller', 4, 'Xbox One Wireless Controller.jpg', 8500, NULL, 60, '2022-05-15 19:20:58', 1),
(3, 'Havit Gaming Mouse', 'havit_gaming_mouse', 4, 'Havit Gaming Mouse.jpg', 54300, NULL, 50, '2022-10-10 19:20:58', 1),
(4, 'Magic Keyboard', 'magic_keyboard', 4, 'Magic Keyboard.jpg', 85500, NULL, 20, '2022-05-31 19:20:58', 1),
(5, 'Camo Headphones', 'camo_headphones', 1, 'camo headphones.jpg', 27000, NULL, 40, '2022-05-09 19:20:58', 1),
(6, 'Asus ROG Zephyrus G15', 'asus_rog_zephyrus_g15', 2, 'ASUS-ROG-Zephyrus-G15.jpg', 1995000, NULL, 70, '2022-05-01 19:20:58', 1),
(7, 'HP Spectre 15 x360', 'hp_spectre_15_x360', 2, 'HP spectre 15 x360.jpg', 790000, NULL, 30, '2022-10-13 19:20:58', 1),
(8, 'USB Type C', 'usb_type_c', 5, 'usb type c.jpg', 3000, NULL, 45, '2022-05-25 19:20:58', 1),
(9, 'Samsung Galaxy S20 Ultra', 'samsung_galaxy_s20_ultra', 3, 'samsung s20.jpg', 420000, NULL, 40, '2022-04-17 22:37:38', 1),
(10, 'ABRO Superglue', 'abro_superglue', 6, 'superglue.jpeg', 150, NULL, 78, '2022-08-20 19:00:56', 1),
(11, 'Samsung Galaxy Earbuds Pro', 'samsung_galaxy_earbuds_pro', 5, 'Samsung-Galaxy-Ear-Buds-Pro.jpg', 67900, NULL, 56, '2022-05-16 23:23:49', 1),
(12, 'Apple Airpods Pro', 'apple_airpods_pro', 5, 'airpods pro.jpg', 78300, NULL, 46, '2022-10-16 23:25:20', 1),
(13, 'Beats Headphones', 'beats_headphones', 1, 'beats headphones.jpg', 65000, NULL, 70, '2022-10-16 23:26:37', 1),
(14, 'iPhone 14 Pro Max', 'iphone_14_pro_max', 3, 'iphone 14 pro max.jpg', 927000, NULL, 21, '2022-09-29 23:38:11', 1),
(15, 'Samsung Galaxy S22 Ultra', 'samsung_galaxy_s22_ultra', 3, 'samsung s22 ultra.jpg', 798000, NULL, 54, '2022-10-16 23:43:55', 1),
(16, 'Jacks Plier', 'jacks_plier', 6, 'jacks_pliers.jpg', 4200, NULL, 73, '2022-09-30 23:52:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pay_id` int(11) NOT NULL,
  `sales_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sales_details`
--

CREATE TABLE `sales_details` (
  `details_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `prd_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `country` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `postcode` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `firstname`, `lastname`, `country`, `address`, `postcode`) VALUES
(1, 'a@admin.com', 'wwe', 'wal', 'wale', NULL, NULL, NULL),
(2, 'b@admin.com', 'wef132e4r3r23o32uio;q.;dpo30i', 'Kelly', 'Price', NULL, NULL, NULL),
(33, 'adewaletaiwo08@gmail.com', '$2y$10$WI0RI5yijTcOrdvAEV/zL.Xr8U/tNre2ZdTxcjDtEiNeuxZZA8uOq', 'Adewale', 'Taiwo', NULL, NULL, NULL),
(36, 'tunjistep@yahoo.com', '$2y$10$aR/ER.rwF282Ci3NzbPpOejAFlTwOYRP60WDF6CCJUljXJZU7zV96', 'Tunji', 'Stephen', NULL, NULL, NULL),
(37, 'Johnchidi01@gmail.com', '$2y$10$9MAHDLc9n5PpCrINF5vnneUTWdnyeseB698vEDaSABKAGwaLgKgOy', 'Chidi', 'John', NULL, NULL, NULL),
(38, 'wale@wale.com', '$2y$10$lE1/rBVUSye87UtXtAL7/O1auH3bc3O/2EnbDi12Smn2JxmKjqYYa', 'Mike', 'Blake', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prd_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishlist_id`, `user_id`, `prd_id`) VALUES
(22, 38, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `prd_id` (`prd_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prd_id`),
  ADD KEY `prd_cat_id` (`cat_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sales_details`
--
ALTER TABLE `sales_details`
  ADD PRIMARY KEY (`details_id`),
  ADD KEY `sales_id` (`sales_id`),
  ADD KEY `prd_id` (`prd_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `prd_id` (`prd_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_details`
--
ALTER TABLE `sales_details`
  MODIFY `details_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `link_prd_id_1` FOREIGN KEY (`prd_id`) REFERENCES `products` (`prd_id`),
  ADD CONSTRAINT `link_user_id_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `link_comment_to_post` FOREIGN KEY (`post_id`) REFERENCES `posts` (`post_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `link_categories` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `link_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `sales_details`
--
ALTER TABLE `sales_details`
  ADD CONSTRAINT `link_product_id` FOREIGN KEY (`prd_id`) REFERENCES `products` (`prd_id`),
  ADD CONSTRAINT `link_sales_id` FOREIGN KEY (`sales_id`) REFERENCES `sales` (`sales_id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`prd_id`) REFERENCES `products` (`prd_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
