SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `famliyproducts`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin@gmail.com', '$2y$10$rmBnmFdpbtw4DatgAogaf.uAJp.EYQs8koJ.I7ThwspQw7SVYo3ce');


CREATE TABLE `assigned_orders` (
  `id` int(11) NOT NULL,
  `od_id` int(11) NOT NULL,
  `dv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `business_type` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `total` float DEFAULT 0,
  `is_applied` tinyint(1) DEFAULT 0,
  `promo` float DEFAULT 0,
  `is_add_w` tinyint(1) DEFAULT 0,
  `wl_amt` float DEFAULT 0,
  `final_amt` float DEFAULT 0,
  `ship_fee` tinyint(1) DEFAULT 0,
  `belonging_city` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `cart_detail` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `categories` (`id`, `category`, `status`) VALUES
(1, 'food', 1);



CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `city_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `cnfrm_delivery` (
  `id` int(11) NOT NULL,
  `od_id` int(11) NOT NULL,
  `dv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `cnfrm_undelivery` (
  `id` int(11) NOT NULL,
  `od_id` int(11) NOT NULL,
  `dv_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `commission` (
  `id` int(11) NOT NULL,
  `scat_id` int(11) NOT NULL,
  `com` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `cntry_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `country` (`id`, `cntry_name`) VALUES
(1, 'Ø§Ù„Ù…Ù…Ù„ÙƒØ© Ø§Ù„Ø¹Ø±Ø¨ÙŠØ© Ø§Ù„Ø³Ø¹ÙˆØ¯ÙŠØ©');


CREATE TABLE `dc` (
  `id` int(11) NOT NULL,
  `dc` float NOT NULL,
  `pc` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `dc` (`id`, `dc`, `pc`) VALUES
(1, 0, 0);



CREATE TABLE `delivery_boy` (
  `id` int(11) NOT NULL,
  `dv_name` varchar(255) NOT NULL,
  `dv_username` varchar(255) NOT NULL,
  `dv_password` text NOT NULL,
  `dv_email` varchar(255) NOT NULL,
  `dv_mobile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `dv_time` (
  `id` int(11) NOT NULL,
  `from` varchar(100) NOT NULL,
  `tto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `filter` (
  `id` int(11) NOT NULL,
  `subcat_id` int(11) NOT NULL,
  `filter` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `isue` (
  `id` int(11) NOT NULL,
  `oid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
































  ALTER TABLE `cnfrm_undelivery`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cnfrm_undelivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `commission`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `commission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


ALTER TABLE `dc`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `dc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


ALTER TABLE `delivery_boy`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `delivery_boy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `dv_time`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `dv_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `filter`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `filter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `isue`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `isue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `cnfrm_delivery`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cnfrm_delivery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `cart_detail`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cart_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `business_type`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `business_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `assigned_orders`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `assigned_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

