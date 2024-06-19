-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 19, 2024 at 10:22 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_proj`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
                              `cart_item_id` int(11) NOT NULL,
                              `user_id` int(11) NOT NULL,
                              `product_id` int(11) NOT NULL,
                              `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`cart_item_id`, `user_id`, `product_id`, `quantity`) VALUES
    (1, 7, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
                          `order_id` int(11) NOT NULL,
                          `order_cost` decimal(6,2) NOT NULL,
                          `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
                          `user_id` int(11) NOT NULL,
                          `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `order_date`) VALUES
                                                                                             (4, 1599.98, 'completed', 1, '2024-06-10 14:06:45'),
                                                                                             (5, 89.99, 'shipped', 2, '2024-06-10 14:06:45'),
                                                                                             (6, 29.99, 'on_hold', 3, '2024-06-11 14:06:45');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
                               `item_id` int(11) NOT NULL,
                               `order_id` int(11) NOT NULL,
                               `product_id` int(11) NOT NULL,
                               `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `quantity`) VALUES
                                                                                (1, 5, 1, 1),
                                                                                (2, 6, 2, 1),
                                                                                (3, 5, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
                            `product_id` int(11) NOT NULL,
                            `product_name` varchar(100) NOT NULL,
                            `product_category` varchar(108) NOT NULL,
                            `product_description` varchar(255) NOT NULL,
                            `product_image` varchar(255) NOT NULL,
                            `product_price` decimal(6,2) NOT NULL,
                            `product_special_offer` int(2) DEFAULT NULL,
                            `product_color` varchar(108) DEFAULT NULL,
                            `quantity_in_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_price`, `product_special_offer`, `product_color`, `quantity_in_stock`) VALUES
                                                                                                                                                                                                      (1, 'Gaming Laptop', 'Computers', 'High performance gaming laptop with latest graphics card', 'gaming_laptop.png', 1499.99, 10, 'Black', 5),
                                                                                                                                                                                                      (2, 'Wireless Mouse', 'Accessories', 'Ergonomic wireless mouse with long battery life', '2design3.jpg', 29.99, 0, 'Gray', 1),
                                                                                                                                                                                                      (3, 'Mechanical Keyboard', 'Accessories', 'RGB mechanical keyboard with programmable keys', 'mechanical_keyboard.jpg', 89.99, 15, 'Black', 2),
                                                                                                                                                                                                      (4, 'Dell XPS 13', 'Laptops', 'Dell XPS 13 with Intel Core i7, 16GB RAM, 512GB SSD', 'dell_xps_13.jpg', 999.99, 100, 'Silver', 50),
                                                                                                                                                                                                      (5, 'Asus ROG Zephyrus', 'Laptops', 'Asus ROG Zephyrus with AMD Ryzen 9, 16GB RAM, 1TB SSD', 'asus_rog_zephyrus.jpg', 1499.99, 150, 'Black', 30),
                                                                                                                                                                                                      (6, 'LG UltraWide Monitor', 'Monitors', 'LG UltraWide 34-inch Monitor, 2560x1080 resolution', 'lg_ultrawide.jpg', 399.99, 50, 'Black', 20),
                                                                                                                                                                                                      (7, 'Corsair iCUE 4000X', 'Cases', 'Corsair iCUE 4000X RGB Mid-Tower ATX Case', 'corsair_icue_4000x.jpg', 129.99, 10, 'White', 100),
                                                                                                                                                                                                      (8, 'Intel Core i9-11900K', 'CPUs', 'Intel Core i9-11900K 8-core 16-thread Processor', 'intel_i9_11900k.jpg', 499.99, 50, 'N/A', 80),
                                                                                                                                                                                                      (9, 'MSI MAG B550 TOMAHAWK', 'Motherboards', 'MSI MAG B550 TOMAHAWK ATX AM4 Motherboard', 'msi_b550_tomahawk.jpg', 179.99, 20, 'Black', 40),
                                                                                                                                                                                                      (10, 'Samsung 970 EVO Plus', 'Computer Drives', 'Samsung 970 EVO Plus 1TB NVMe M.2 SSD', 'samsung_970_evo_plus.jpg', 199.99, 30, 'N/A', 200),
                                                                                                                                                                                                      (11, 'NVIDIA GeForce RTX 3080', 'GPU Cards', 'NVIDIA GeForce RTX 3080 10GB GDDR6X Graphics Card', 'nvidia_rtx_3080.jpg', 699.99, 50, 'N/A', 60),
                                                                                                                                                                                                      (12, 'Corsair Vengeance LPX', 'Ram Memory', 'Corsair Vengeance LPX 16GB (2x8GB) DDR4 3200MHz', 'corsair_vengeance_lpx.jpg', 79.99, 10, 'Black', 150),
                                                                                                                                                                                                      (13, 'Secretlab Titan', 'Gaming Chairs', 'Secretlab Titan 2020 Series Gaming Chair', 'secretlab_titan.jpg', 399.99, 20, 'Black', 70),
                                                                                                                                                                                                      (14, 'HyperX Cloud II', 'Headsets', 'HyperX Cloud II Gaming Headset with 7.1 Surround Sound', 'hyperx_cloud_ii.jpg', 99.99, 15, 'Red', 90),
                                                                                                                                                                                                      (15, 'Apple MacBook Air', 'Laptops', 'Apple MacBook Air with M1 Chip, 8GB RAM, 256GB SSD', 'macbook_air_m1.jpg', 999.99, 100, 'Space Gray', 50),
                                                                                                                                                                                                      (16, 'BenQ EW3270U', 'Monitors', 'BenQ EW3270U 32-inch 4K HDR Monitor', 'benq_ew3270u.jpg', 449.99, 50, 'Gray', 25),
                                                                                                                                                                                                      (17, 'NZXT H510', 'Cases', 'NZXT H510 Compact ATX Mid-Tower PC Gaming Case', 'nzxt_h510.jpg', 69.99, 5, 'Matte Black/Red', 100),
                                                                                                                                                                                                      (18, 'AMD Ryzen 7 5800X', 'CPUs', 'AMD Ryzen 7 5800X 8-core 16-thread Processor', 'amd_ryzen_7_5800x.jpg', 449.99, 30, 'N/A', 60),
                                                                                                                                                                                                      (19, 'ASUS ROG Strix B450-F', 'Motherboards', 'ASUS ROG Strix B450-F Gaming Motherboard', 'asus_rog_strix_b450f.jpg', 119.99, 15, 'Black', 45),
                                                                                                                                                                                                      (20, 'Western Digital WD Black', 'Computer Drives', 'Western Digital WD Black 2TB Performance Hard Drive', 'wd_black_2tb.jpg', 109.99, 20, 'Black', 150),
                                                                                                                                                                                                      (21, 'AMD Radeon RX 6800', 'GPU Cards', 'AMD Radeon RX 6800 16GB GDDR6 Graphics Card', 'amd_radeon_rx_6800.jpg', 579.99, 40, 'N/A', 55),
                                                                                                                                                                                                      (22, 'G.Skill Trident Z RGB', 'Ram Memory', 'G.Skill Trident Z RGB 16GB (2 x 8GB) DDR4 3200MHz', 'gskill_trident_z_rgb.jpg', 89.99, 12, 'RGB', 130),
                                                                                                                                                                                                      (23, 'DXRacer Formula Series', 'Gaming Chairs', 'DXRacer Formula Series OH/FD01/NR Gaming Chair', 'dxracer_formula_series.jpg', 299.99, 25, 'Black/Red', 60),
                                                                                                                                                                                                      (24, 'SteelSeries Arctis 7', 'Headsets', 'SteelSeries Arctis 7 Wireless Gaming Headset', 'steelseries_arctis_7.jpg', 149.99, 30, 'Black', 80),
                                                                                                                                                                                                      (25, 'Acer Aspire 5', 'Laptops', 'Affordable laptop with reliable performance', 'https://example.com/images/acer_aspire_5.jpg', 549.99, NULL, 'Silver', 100),
                                                                                                                                                                                                      (26, 'Lenovo ThinkPad X1 Carbon', 'Laptops', 'Business laptop with robust build quality and performance', 'https://example.com/images/lenovo_thinkpad_x1.jpg', 1399.99, NULL, 'Black', 50),
                                                                                                                                                                                                      (27, 'Asus ZenBook 14', 'Laptops', 'Ultra-portable laptop with long battery life', 'https://example.com/images/asus_zenbook_14.jpg', 899.99, NULL, 'Blue', 70),
                                                                                                                                                                                                      (28, 'Dell UltraSharp U2720Q', 'Monitors', '4K monitor with precise color accuracy', 'https://example.com/images/dell_ultrasharp_u2720q.jpg', 899.99, 20, 'Black', 30),
                                                                                                                                                                                                      (29, 'BenQ PD3220U', 'Monitors', 'Professional 4K monitor with HDR support', 'https://example.com/images/benq_pd3220u.jpg', 1199.99, 15, 'Gray', 25),
                                                                                                                                                                                                      (30, 'Fractal Design Meshify C', 'Cases', 'High-airflow mid-tower case with sleek design', 'https://example.com/images/fractal_design_meshify_c.jpg', 99.99, NULL, 'Black', 80),
                                                                                                                                                                                                      (31, 'Cooler Master MasterBox Q300L', 'Cases', 'Compact and customizable mATX case', 'https://example.com/images/cooler_master_q300l.jpg', 59.99, 10, 'Black', 100),
                                                                                                                                                                                                      (32, 'Intel Core i7-11700K', 'Computer CPU', 'Powerful 8-core CPU for gaming and multitasking', 'https://example.com/images/intel_i7_11700k.jpg', 399.99, NULL, NULL, 70),
                                                                                                                                                                                                      (33, 'AMD Ryzen 7 5800X', 'Computer CPU', '8-core processor with superior performance', 'https://example.com/images/amd_ryzen_7_5800x.jpg', 399.99, 5, NULL, 60),
                                                                                                                                                                                                      (34, 'Gigabyte Aorus Master X570', 'Motherboards', 'High-end motherboard with extensive features', 'https://example.com/images/gigabyte_aorus_master_x570.jpg', 349.99, NULL, NULL, 40),
                                                                                                                                                                                                      (35, 'ASRock B550 Pro4', 'Motherboards', 'Cost-effective motherboard with solid performance', 'https://example.com/images/asrock_b550_pro4.jpg', 129.99, NULL, NULL, 90),
                                                                                                                                                                                                      (36, 'Crucial MX500 1TB', 'Computer Drives', 'Reliable SATA SSD with fast performance', 'https://example.com/images/crucial_mx500_1tb.jpg', 104.99, 15, NULL, 130),
                                                                                                                                                                                                      (37, 'Seagate Barracuda 2TB', 'Computer Drives', 'High-capacity HDD for mass storage', 'https://example.com/images/seagate_barracuda_2tb.jpg', 59.99, NULL, NULL, 200),
                                                                                                                                                                                                      (38, 'NVIDIA GeForce RTX 3070', 'GPU Cards', 'High-performance graphics card for gaming and VR', 'https://example.com/images/nvidia_rtx_3070.jpg', 499.99, 10, NULL, 50),
                                                                                                                                                                                                      (39, 'AMD Radeon RX 6700 XT', 'GPU Cards', 'Great mid-range graphics card with RDNA 2 architecture', 'https://example.com/images/amd_rx_6700_xt.jpg', 479.99, 15, NULL, 60),
                                                                                                                                                                                                      (40, 'Kingston HyperX Fury 16GB', 'Ram Memory', 'Affordable DDR4 memory with solid performance', 'https://example.com/images/kingston_hyperx_fury_16gb.jpg', 69.99, NULL, 'Black', 200),
                                                                                                                                                                                                      (41, 'TeamGroup T-Force Delta RGB 32GB', 'Ram Memory', 'RGB DDR4 memory with high-speed performance', 'https://example.com/images/teamgroup_t_force_delta_rgb_32gb.jpg', 149.99, 10, 'RGB', 140),
                                                                                                                                                                                                      (42, 'DXRacer Formula Series', 'Gaming Chairs', 'Comfortable gaming chair with ergonomic design', 'https://example.com/images/dxracer_formula_series.jpg', 329.99, NULL, 'Red/Black', 40),
                                                                                                                                                                                                      (43, 'Noblechairs Hero', 'Gaming Chairs', 'Premium gaming chair with superior comfort', 'https://example.com/images/noblechairs_hero.jpg', 499.99, 5, 'Black', 30),
                                                                                                                                                                                                      (44, 'Razer BlackShark V2', 'Headsets', 'Gaming headset with superior audio quality', 'https://example.com/images/razer_blackshark_v2.jpg', 99.99, 10, 'Black', 80),
                                                                                                                                                                                                      (45, 'Logitech G Pro X', 'Headsets', 'Professional-grade gaming headset with Blue VO!CE technology', 'https://example.com/images/logitech_g_pro_x.jpg', 129.99, NULL, 'Black', 70),
                                                                                                                                                                                                      (46, 'Xbox One S', 'Xbox', 'The Xbox One S is a home video game console developed by Microsoft.', 'images/xbox_one_s.jpg', 299.99, 0, 'White', 50),
                                                                                                                                                                                                      (47, 'Xbox One X', 'Xbox', 'The Xbox One X is a powerful video game console with 4K resolution.', 'images/xbox_one_x.jpg', 499.99, 0, 'Black', 30),
                                                                                                                                                                                                      (48, 'Xbox One', 'Xbox', 'The original Xbox One console, featuring a wide range of games.', 'images/xbox_one.jpg', 199.99, 1, 'Black', 20),
                                                                                                                                                                                                      (49, 'Xbox 360', 'Xbox', 'The Xbox 360 is a seventh-generation home video game console.', 'images/xbox_360.jpg', 149.99, 1, 'White', 40),
                                                                                                                                                                                                      (50, 'Xbox Accessories Console', 'Xbox', 'Accessories for Xbox consoles including controllers and headsets.', 'images/xbox_accessories.jpg', 29.99, 0, 'Black', 100),
                                                                                                                                                                                                      (51, 'Nintendo Switch', 'Nintendo', 'The Nintendo Switch is a hybrid video game console developed by Nintendo.', 'images/nintendo_switch.jpg', 299.99, 0, 'Neon Red/Blue', 50),
                                                                                                                                                                                                      (52, 'Nintendo Switch OLED', 'Nintendo', 'The OLED model of the Nintendo Switch features a vibrant 7-inch screen.', 'images/nintendo_switch_oled.jpg', 349.99, 1, 'White', 30),
                                                                                                                                                                                                      (53, 'Nintendo Switch Lite', 'Nintendo', 'A handheld-only version of the Nintendo Switch console.', 'images/nintendo_switch_lite.jpg', 199.99, 0, 'Yellow', 40),
                                                                                                                                                                                                      (54, 'Nintendo Accessories Console', 'Nintendo', 'Accessories for Nintendo Switch including controllers and cases.', 'images/nintendo_accessories.jpg', 19.99, 0, 'Black', 100),
                                                                                                                                                                                                      (55, 'Playstation 5 Pro', 'Playstation', 'The Pro version of the Playstation 5 with enhanced graphics.', 'images/ps5_pro.jpg', 499.99, 0, 'White', 30),
                                                                                                                                                                                                      (56, 'Playstation 5 Lite', 'Playstation', 'A lighter and more compact version of the Playstation 5.', 'images/ps5_lite.jpg', 399.99, 1, 'Black', 20),
                                                                                                                                                                                                      (57, 'Playstation Portable', 'Playstation', 'The Playstation Portable is a handheld game console.', 'images/psp.jpg', 149.99, 1, 'Black', 50),
                                                                                                                                                                                                      (58, 'Playstation 4 series', 'Playstation', 'The Playstation 4 series includes several models of the console.', 'images/ps4_series.jpg', 299.99, 0, 'Black', 40),
                                                                                                                                                                                                      (59, 'Playstation Accessories Console', 'Playstation', 'Accessories for Playstation consoles including controllers and VR.', 'images/ps_accessories.jpg', 29.99, 0, 'White', 100),
                                                                                                                                                                                                      (60, 'Old Consoles', 'Others', 'Various old and retro game consoles.', 'images/old_consoles.jpg', 99.99, 0, 'Gray', 10),
                                                                                                                                                                                                      (61, 'Other Accessories Console', 'Others', 'Various accessories for different game consoles.', 'images/other_accessories.jpg', 19.99, 0, 'Black', 100),
                                                                                                                                                                                                      (62, 'Portable Consoles', 'Others', 'Various portable gaming consoles.', 'images/portable_consoles.jpg', 199.99, 1, 'Blue', 30),
                                                                                                                                                                                                      (63, 'Consoles Parts', 'Others', 'Parts and components for game consoles.', 'images/console_parts.jpg', 49.99, 0, 'Black', 50),
                                                                                                                                                                                                      (64, 'Xbox One S 1TB', 'Xbox', 'Xbox One S with 1TB storage.', 'images/xbox_one_s_1tb.jpg', 349.99, 0, 'White', 45),
                                                                                                                                                                                                      (65, 'Xbox One X Limited Edition', 'Xbox', 'Limited Edition Xbox One X with custom design.', 'images/xbox_one_x_limited.jpg', 549.99, 0, 'Black', 25),
                                                                                                                                                                                                      (66, 'Xbox Elite Controller', 'Xbox', 'Elite wireless controller for Xbox One and Series X.', 'images/xbox_elite_controller.jpg', 179.99, 1, 'Black', 80),
                                                                                                                                                                                                      (67, 'Xbox 360 Slim', 'Xbox', 'Slim version of the Xbox 360 console.', 'images/xbox_360_slim.jpg', 169.99, 1, 'Black', 35),
                                                                                                                                                                                                      (68, 'Xbox Series S', 'Xbox', 'Next-gen performance in the smallest Xbox ever.', 'images/xbox_series_s.jpg', 299.99, 0, 'White', 60),
                                                                                                                                                                                                      (69, 'Nintendo Switch Mario Edition', 'Nintendo', 'Special Mario edition of the Nintendo Switch.', 'images/nintendo_switch_mario.jpg', 319.99, 0, 'Red/Blue', 55),
                                                                                                                                                                                                      (70, 'Nintendo Switch OLED Zelda Edition', 'Nintendo', 'OLED model of the Nintendo Switch with Zelda design.', 'images/nintendo_switch_oled_zelda.jpg', 359.99, 1, 'Black', 28),
                                                                                                                                                                                                      (71, 'Nintendo Switch Lite Coral', 'Nintendo', 'Coral color version of the Nintendo Switch Lite.', 'images/nintendo_switch_lite_coral.jpg', 199.99, 0, 'Coral', 42),
                                                                                                                                                                                                      (72, 'Nintendo Pro Controller', 'Nintendo', 'Pro controller for Nintendo Switch.', 'images/nintendo_pro_controller.jpg', 69.99, 1, 'Black', 90),
                                                                                                                                                                                                      (73, 'Nintendo Joy-Con Pair', 'Nintendo', 'Pair of Joy-Con controllers for Nintendo Switch.', 'images/nintendo_joy_con.jpg', 79.99, 0, 'Neon Red/Blue', 75),
                                                                                                                                                                                                      (74, 'Playstation 5 Digital Edition', 'Playstation', 'Digital edition of the Playstation 5 without disc drive.', 'images/ps5_digital.jpg', 399.99, 0, 'White', 35),
                                                                                                                                                                                                      (75, 'Playstation 5 DualSense Controller', 'Playstation', 'DualSense wireless controller for PS5.', 'images/ps5_dualsense.jpg', 69.99, 0, 'White', 95),
                                                                                                                                                                                                      (76, 'Playstation VR', 'Playstation', 'Virtual reality system for Playstation.', 'images/ps_vr.jpg', 299.99, 1, 'Black', 25),
                                                                                                                                                                                                      (77, 'Playstation 4 Pro 1TB', 'Playstation', 'PS4 Pro with 1TB storage for 4K gaming.', 'images/ps4_pro_1tb.jpg', 349.99, 0, 'Black', 40),
                                                                                                                                                                                                      (78, 'Playstation Move Motion Controllers', 'Playstation', 'Motion controllers for PS VR.', 'images/ps_move.jpg', 99.99, 0, 'Black', 50),
                                                                                                                                                                                                      (79, 'Sega Genesis Classic', 'Others', 'Classic Sega Genesis console with pre-installed games.', 'images/sega_genesis_classic.jpg', 79.99, 0, 'Black', 20),
                                                                                                                                                                                                      (80, 'Retro NES Console', 'Others', 'Retro NES console with HDMI output.', 'images/retro_nes.jpg', 59.99, 0, 'Gray', 30),
                                                                                                                                                                                                      (81, 'Portable Game Console', 'Others', 'Handheld game console with pre-loaded games.', 'images/portable_console.jpg', 89.99, 1, 'Blue', 50),
                                                                                                                                                                                                      (82, 'Console Repair Kit', 'Others', 'Repair kit for various game consoles.', 'images/repair_kit.jpg', 29.99, 0, 'Black', 70),
                                                                                                                                                                                                      (83, 'Wireless Gaming Headset', 'Others', 'Wireless headset compatible with all consoles.', 'images/wireless_headset.jpg', 99.99, 1, 'Black', 60),
                                                                                                                                                                                                      (84, 'Xbox One S 500GB', 'Xbox', 'Xbox One S with 500GB storage.', 'images/xbox_one_s_500gb.jpg', 299.99, 0, 'White', 50),
                                                                                                                                                                                                      (85, 'Xbox One X Cyberpunk Edition', 'Xbox', 'Cyberpunk-themed Xbox One X.', 'images/xbox_one_x_cyberpunk.jpg', 599.99, 1, 'Black/Yellow', 20),
                                                                                                                                                                                                      (86, 'Xbox Series X Halo Edition', 'Xbox', 'Halo-themed Xbox Series X console.', 'images/xbox_series_x_halo.jpg', 599.99, 0, 'Black/Green', 30),
                                                                                                                                                                                                      (87, 'Xbox 360 Arcade', 'Xbox', 'Xbox 360 Arcade model.', 'images/xbox_360_arcade.jpg', 149.99, 1, 'White', 25),
                                                                                                                                                                                                      (88, 'Xbox Wireless Headset', 'Xbox', 'Wireless gaming headset for Xbox consoles.', 'images/xbox_wireless_headset.jpg', 99.99, 0, 'Black', 80),
                                                                                                                                                                                                      (89, 'Nintendo Switch Lite Blue', 'Nintendo', 'Blue color version of the Nintendo Switch Lite.', 'images/nintendo_switch_lite_blue.jpg', 199.99, 0, 'Blue', 60),
                                                                                                                                                                                                      (90, 'Nintendo Switch Animal Crossing Edition', 'Nintendo', 'Animal Crossing-themed Nintendo Switch.', 'images/nintendo_switch_animal_crossing.jpg', 319.99, 1, 'Green', 35),
                                                                                                                                                                                                      (91, 'Nintendo GameCube', 'Nintendo', 'Classic Nintendo GameCube console.', 'images/nintendo_gamecube.jpg', 99.99, 0, 'Purple', 45),
                                                                                                                                                                                                      (92, 'Nintendo Wii U Deluxe', 'Nintendo', 'Deluxe edition of the Nintendo Wii U.', 'images/nintendo_wii_u_deluxe.jpg', 299.99, 0, 'Black', 25),
                                                                                                                                                                                                      (93, 'Nintendo Switch Carrying Case', 'Nintendo', 'Carrying case for Nintendo Switch.', 'images/nintendo_switch_case.jpg', 19.99, 1, 'Black', 100),
                                                                                                                                                                                                      (94, 'Playstation 5 Disc Edition', 'Playstation', 'Disc edition of the Playstation 5.', 'images/ps5_disc.jpg', 499.99, 0, 'White', 30),
                                                                                                                                                                                                      (95, 'Playstation 4 Slim 500GB', 'Playstation', 'Slim version of the PS4 with 500GB storage.', 'images/ps4_slim_500gb.jpg', 299.99, 0, 'Black', 40),
                                                                                                                                                                                                      (96, 'Playstation VR Aim Controller', 'Playstation', 'Aim controller for PS VR.', 'images/ps_vr_aim.jpg', 59.99, 1, 'Black', 50),
                                                                                                                                                                                                      (97, 'Playstation Vita', 'Playstation', 'Portable Playstation Vita console.', 'images/ps_vita.jpg', 199.99, 0, 'Black', 30),
                                                                                                                                                                                                      (98, 'Playstation Gold Wireless Headset', 'Playstation', 'Gold wireless headset for Playstation.', 'images/ps_gold_headset.jpg', 99.99, 0, 'Black', 60),
                                                                                                                                                                                                      (99, 'Atari Flashback 8', 'Others', 'Classic Atari Flashback 8 console with built-in games.', 'images/atari_flashback_8.jpg', 59.99, 0, 'Black', 40),
                                                                                                                                                                                                      (100, 'SEGA Genesis Mini', 'Others', 'Mini version of the SEGA Genesis with pre-installed games.', 'images/sega_genesis_mini.jpg', 79.99, 0, 'Black', 50),
                                                                                                                                                                                                      (101, 'Neo Geo Mini', 'Others', 'Mini version of the Neo Geo console.', 'images/neo_geo_mini.jpg', 109.99, 1, 'White', 20),
                                                                                                                                                                                                      (102, 'Hyperkin RetroN 5', 'Others', 'Retro gaming console compatible with multiple platforms.', 'images/retron_5.jpg', 159.99, 0, 'Gray', 30),
                                                                                                                                                                                                      (103, 'Universal Game Console Stand', 'Others', 'Stand compatible with various game consoles.', 'images/console_stand.jpg', 29.99, 1, 'Black', 70),
                                                                                                                                                                                                      (104, 'Xbox One Controller', 'Xbox Accessories', 'Wireless controller for Xbox One.', 'images/xbox_one_controller.jpg', 59.99, 0, 'Black', 150),
                                                                                                                                                                                                      (105, 'Xbox Rechargeable Battery Pack', 'Xbox Accessories', 'Rechargeable battery pack for Xbox controllers.', 'images/xbox_battery_pack.jpg', 24.99, 1, 'Black', 100),
                                                                                                                                                                                                      (106, 'Xbox 360 Wireless Adapter', 'Xbox Accessories', 'Wireless adapter for Xbox 360.', 'images/xbox_360_wireless_adapter.jpg', 29.99, 0, 'Black', 50),
                                                                                                                                                                                                      (107, 'Nintendo Switch Pro Controller Splatoon Edition', 'Nintendo Accessories', 'Splatoon-themed Pro Controller for Nintendo Switch.', 'images/switch_pro_controller_splatoon.jpg', 74.99, 0, 'Pink/Green', 70),
                                                                                                                                                                                                      (108, 'Nintendo Switch Joy-Con Charging Grip', 'Nintendo Accessories', 'Charging grip for Nintendo Switch Joy-Con controllers.', 'images/switch_joy_con_grip.jpg', 29.99, 1, 'Gray', 90),
                                                                                                                                                                                                      (109, 'Nintendo Amiibo', 'Nintendo Accessories', 'Collectible Amiibo figure.', 'images/nintendo_amiibo.jpg', 12.99, 0, 'Multicolor', 200),
                                                                                                                                                                                                      (110, 'Playstation Camera', 'Playstation Accessories', 'Camera for Playstation 4 and 5.', 'images/ps_camera.jpg', 49.99, 0, 'Black', 80),
                                                                                                                                                                                                      (111, 'Playstation 4 Controller Charging Station', 'Playstation Accessories', 'Charging station for PS4 controllers.', 'images/ps4_charging_station.jpg', 24.99, 1, 'Black', 100),
                                                                                                                                                                                                      (112, 'Playstation VR Worlds', 'Playstation Accessories', 'PS VR Worlds game for Playstation VR.', 'images/ps_vr_worlds.jpg', 29.99, 0, 'Black', 60),
                                                                                                                                                                                                      (113, 'Game Console HDMI Converter', 'Other Accessories', 'HDMI converter for retro game consoles.', 'images/console_hdmi_converter.jpg', 19.99, 1, 'Black', 120),
                                                                                                                                                                                                      (114, 'Portable Console Travel Case', 'Portable Consoles', 'Travel case for portable game consoles.', 'images/portable_console_case.jpg', 29.99, 0, 'Black', 90),
                                                                                                                                                                                                      (115, 'Universal Console Dust Cover', 'Consoles Parts', 'Dust cover for various game consoles.', 'images/console_dust_cover.jpg', 14.99, 0, 'Gray', 80),
                                                                                                                                                                                                      (116, 'Playstation Gift Card $10', 'Playstation cards', 'Playstation gift card worth $10.', '../IMG/cards1.jpg', 10.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (117, 'Playstation Gift Card $25', 'Playstation cards', 'Playstation gift card worth $25.', '../IMG/cards1.jpg', 25.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (118, 'Playstation Gift Card $50', 'Playstation cards', 'Playstation gift card worth $50.', '../IMG/cards1.jpg', 50.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (119, 'Xbox Gift Card $10', 'Xbox cards', 'Xbox gift card worth $10.', '../IMG/cards2.jpg', 10.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (120, 'Xbox Gift Card $25', 'Xbox cards', 'Xbox gift card worth $25.', '../IMG/cards2.jpg', 25.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (121, 'Xbox Gift Card $50', 'Xbox cards', 'Xbox gift card worth $50.', '../IMG/cards2.jpg', 50.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (122, 'Nintendo Gift Card $10', 'Nintendo cards', 'Nintendo gift card worth $10.', '../IMG/cards3.jpg', 10.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (123, 'Nintendo Gift Card $25', 'Nintendo cards', 'Nintendo gift card worth $25.', '../IMG/cards3.jpg', 25.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (124, 'Nintendo Gift Card $50', 'Nintendo cards', 'Nintendo gift card worth $50.', '../IMG/cards3.jpg', 50.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (125, 'Google Play Gift Card $10', 'Google store cards', 'Google Play gift card worth $10.', '../IMG/cards4.jpg', 10.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (126, 'Google Play Gift Card $25', 'Google store cards', 'Google Play gift card worth $25.', '../IMG/cards4.jpg', 25.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (127, 'Google Play Gift Card $50', 'Google store cards', 'Google Play gift card worth $50.', '../IMG/cards4.jpg', 50.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (128, 'iTunes Gift Card $10', 'Itunes cards', 'iTunes gift card worth $10.', '../IMG/cards5.jpg', 10.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (129, 'iTunes Gift Card $25', 'Itunes cards', 'iTunes gift card worth $25.', '../IMG/cards5.jpg', 25.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (130, 'iTunes Gift Card $50', 'Itunes cards', 'iTunes gift card worth $50.', '../IMG/cards5.jpg', 50.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (131, 'Steam Gift Card $10', 'Steam cards', 'Steam gift card worth $10.', '../IMG/cards6.jpg', 10.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (132, 'Steam Gift Card $25', 'Steam cards', 'Steam gift card worth $25.', '../IMG/cards6.jpg', 25.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (133, 'Steam Gift Card $50', 'Steam cards', 'Steam gift card worth $50.', '../IMG/cards6.jpg', 50.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (134, 'Amazon Gift Card $10', 'Amazon cards', 'Amazon gift card worth $10.', '../IMG/cards7.jpg', 10.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (135, 'Amazon Gift Card $25', 'Amazon cards', 'Amazon gift card worth $25.', '../IMG/cards7.jpg', 25.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (136, 'Amazon Gift Card $50', 'Amazon cards', 'Amazon gift card worth $50.', '../IMG/cards7.jpg', 50.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (137, 'Other Gift Card $10', 'other cards', 'Other gift card worth $10.', '../IMG/cards8.jpg', 10.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (138, 'Other Gift Card $25', 'other cards', 'Other gift card worth $25.', '../IMG/cards8.jpg', 25.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (139, 'Other Gift Card $50', 'other cards', 'Other gift card worth $50.', '../IMG/cards8.jpg', 50.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (140, 'Playstation Gift Card $15', 'Playstation cards', 'Playstation gift card worth $15.', '../IMG/cards1.jpg', 15.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (141, 'Playstation Gift Card $100', 'Playstation cards', 'Playstation gift card worth $100.', '../IMG/cards1.jpg', 100.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (142, 'Xbox Gift Card $15', 'Xbox cards', 'Xbox gift card worth $15.', '../IMG/cards2.jpg', 15.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (143, 'Xbox Gift Card $100', 'Xbox cards', 'Xbox gift card worth $100.', '../IMG/cards2.jpg', 100.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (144, 'Nintendo Gift Card $15', 'Nintendo cards', 'Nintendo gift card worth $15.', '../IMG/cards3.jpg', 15.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (145, 'Nintendo Gift Card $100', 'Nintendo cards', 'Nintendo gift card worth $100.', '../IMG/cards3.jpg', 100.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (146, 'Google Play Gift Card $15', 'Google store cards', 'Google Play gift card worth $15.', '../IMG/cards4.jpg', 15.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (147, 'Google Play Gift Card $100', 'Google store cards', 'Google Play gift card worth $100.', '../IMG/cards4.jpg', 100.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (148, 'iTunes Gift Card $15', 'Itunes cards', 'iTunes gift card worth $15.', '../IMG/cards5.jpg', 15.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (149, 'iTunes Gift Card $100', 'Itunes cards', 'iTunes gift card worth $100.', '../IMG/cards5.jpg', 100.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (150, 'Steam Gift Card $15', 'Steam cards', 'Steam gift card worth $15.', '../IMG/cards6.jpg', 15.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (151, 'Steam Gift Card $100', 'Steam cards', 'Steam gift card worth $100.', '../IMG/cards6.jpg', 100.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (152, 'Amazon Gift Card $15', 'Amazon cards', 'Amazon gift card worth $15.', '../IMG/cards7.jpg', 15.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (153, 'Amazon Gift Card $100', 'Amazon cards', 'Amazon gift card worth $100.', '../IMG/cards7.jpg', 100.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (154, 'Other Gift Card $15', 'other cards', 'Other gift card worth $15.', '../IMG/cards8.jpg', 15.00, NULL, 'N/A', 100),
                                                                                                                                                                                                      (155, 'Other Gift Card $100', 'other cards', 'Other gift card worth $100.', '../IMG/cards8.jpg', 100.00, NULL, 'N/A', 100);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
                         `user_id` int(11) NOT NULL,
                         `user_name` varchar(108) NOT NULL,
                         `user_email` varchar(100) NOT NULL,
                         `user_password` varchar(100) NOT NULL,
                         `first_name` varchar(100) NOT NULL,
                         `last_name` varchar(100) NOT NULL,
                         `phone_number` varchar(15) NOT NULL,
                         `birth_date` date NOT NULL,
                         `gender` enum('male','female') NOT NULL,
                         `city` varchar(100) NOT NULL,
                         `region` varchar(100) NOT NULL,
                         `street` varchar(100) NOT NULL,
                         `role` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `first_name`, `last_name`, `phone_number`, `birth_date`, `gender`, `city`, `region`, `street`, `role`) VALUES
                                                                                                                                                                                       (1, 'John Doe', 'johndoe@example.com', 'password123', '', '', '', '0000-00-00', 'male', '', '', '', 0),
                                                                                                                                                                                       (2, 'Jane Smith', 'janesmith@example.com', 'password456', '', '', '', '0000-00-00', 'male', '', '', '', 0),
                                                                                                                                                                                       (3, 'Alice Johnson', 'alicej@example.com', 'password789', '', '', '', '0000-00-00', 'male', '', '', '', 0),
                                                                                                                                                                                       (4, 'momrn', 'momanani2017@gmail.com', '$2y$10$coUGp4ow3lDqgNV40kMujeXH4mXoZd2464PPiEZWaczbakRbRkuLG', 'momen', 'Momen', '0592483450', '2003-06-15', 'male', 'Brownsville', 'WI', 'N11896 Wisconsin 175', 0),
                                                                                                                                                                                       (5, 'momrnr', 'mom2@gmail.com', '$2y$10$na47Ne5SOH9G//JFl2dqEOnmMVEwWy6EBcA8DTI2hVtXqtILFyexS', 'momen', 'Momen', '0592483450', '2024-06-11', 'male', 'Brownsville', 'WI', 'N11896 Wisconsin 175', 0),
                                                                                                                                                                                       (6, 'momrnjk', 'mom72@gmail.com', '$2y$10$MHayPxcJLQoL5gPccONKrOgPasMD6iBdrCwL4OXbIAWsMGCmf/A06', 'momen', 'Momen', '0592483450', '2004-01-15', 'male', 'Brownsville', 'WI', 'N11896 Wisconsin 175', 0),
                                                                                                                                                                                       (7, 'momanani2017', 'momanani2017@outlook.sa', '$2y$10$uxE9uLo6LuQLNBTpLu8P1OwLhnDCoDlSqUDnMEdABq3nBCHBGT0.y', 'ahmad', 'hamood', '0592483450', '2024-06-10', 'male', 'Tulkarm', 'hjh', 'faroon street', 0),
                                                                                                                                                                                       (11, 'mohammad', 'kfklsjkl@gmail.com', '$2y$10$X8GY64Hn8joTMAj3NwBLMe2Bc7oW/gaUdJVhrGE.B4SS92C3YAgdC', 'mohammad', 'ahmad', '0592483450', '2002-06-16', 'male', 'jnjknjk', 'ffdff', 'kjhjkkj', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist_items`
--

CREATE TABLE `wishlist_items` (
                                  `wishlist_item_id` int(11) NOT NULL,
                                  `user_id` int(11) NOT NULL,
                                  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
    ADD PRIMARY KEY (`cart_item_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
    ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_user_id_orders` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
    ADD PRIMARY KEY (`item_id`),
  ADD KEY `fk_product_id_order_items` (`product_id`),
  ADD KEY `fk_order_id_order_items` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
    ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UX_Constraint` (`user_email`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Indexes for table `wishlist_items`
--
ALTER TABLE `wishlist_items`
    ADD PRIMARY KEY (`wishlist_item_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
    MODIFY `cart_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
    MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
    MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
    MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `wishlist_items`
--
ALTER TABLE `wishlist_items`
    MODIFY `wishlist_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
    ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
    ADD CONSTRAINT `fk_user_id_orders` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
    ADD CONSTRAINT `fk_order_id_order_items` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `fk_product_id_order_items` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `wishlist_items`
--
ALTER TABLE `wishlist_items`
    ADD CONSTRAINT `wishlist_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `wishlist_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
