-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 10, 2024 at 11:36 PM
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
-- Database: `company`
--
CREATE DATABASE IF NOT EXISTS `company` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `company`;

-- --------------------------------------------------------

--
-- Table structure for table `Computer`
--

CREATE TABLE `Computer` (
                            `id` int(11) NOT NULL,
                            `Username` varchar(50) NOT NULL,
                            `password` varchar(50) NOT NULL,
                            `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Computer`
--

INSERT INTO `Computer` (`id`, `Username`, `password`, `role`) VALUES
    (1, 'dlksdm', '8acb5905a4d849efe9825c688f85ca41cccee201', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Computer`
--
ALTER TABLE `Computer`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Computer`
--
ALTER TABLE `Computer`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Database: `my_proj`
--
CREATE DATABASE IF NOT EXISTS `my_proj` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `my_proj`;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
                          `order_id` int(11) NOT NULL,
                          `order_cost` decimal(6,2) NOT NULL,
                          `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
                          `user_id` int(11) NOT NULL,
                          `user_phone` int(11) NOT NULL,
                          `user_city` varchar(255) NOT NULL,
                          `user_address` varchar(255) NOT NULL,
                          `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `order_date`) VALUES
                                                                                                                                        (4, 1599.98, 'completed', 1, 123456789, 'New York', '123 Main St, New York, NY', '2024-06-10 14:06:45'),
                                                                                                                                        (5, 89.99, 'shipped', 2, 234567890, 'San Francisco', '456 Market St, San Francisco, CA', '2024-06-10 14:06:45'),
                                                                                                                                        (6, 29.99, 'on_hold', 3, 345678901, 'Los Angeles', '789 Sunset Blvd, Los Angeles, CA', '2024-06-10 14:06:45');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
                               `item_id` int(11) NOT NULL,
                               `order_id` int(11) NOT NULL,
                               `product_id` varchar(255) NOT NULL,
                               `product_name` varchar(255) NOT NULL,
                               `product_image` varchar(255) NOT NULL,
                               `user_id` int(11) NOT NULL,
                               `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `product_image`, `user_id`, `order_date`) VALUES
                                                                                                                              (1, 1, '1', 'Gaming Laptop', 'gaming_laptop.jpg', 1, '2024-06-10 14:06:45'),
                                                                                                                              (2, 1, '2', 'Wireless Mouse', 'wireless_mouse.jpg', 1, '2024-06-10 14:06:45'),
                                                                                                                              (3, 2, '3', 'Mechanical Keyboard', 'mechanical_keyboard.jpg', 2, '2024-06-10 14:06:45');

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
                                                                                                                                                                                                      (2, 'Wireless Mouse', 'Accessories', 'Ergonomic wireless mouse with long battery life', 'wireless_mouse.jpg', 29.99, 0, 'Gray', 1),
                                                                                                                                                                                                      (3, 'Mechanical Keyboard', 'Accessories', 'RGB mechanical keyboard with programmable keys', 'mechanical_keyboard.jpg', 89.99, 15, 'Black', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
                         `user_id` int(11) NOT NULL,
                         `user_name` varchar(108) NOT NULL,
                         `user_email` varchar(100) NOT NULL,
                         `user_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
                                                                                (1, 'John Doe', 'johndoe@example.com', 'password123'),
                                                                                (2, 'Jane Smith', 'janesmith@example.com', 'password456'),
                                                                                (3, 'Alice Johnson', 'alicej@example.com', 'password789');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
    ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
    ADD PRIMARY KEY (`item_id`);

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
  ADD UNIQUE KEY `UX_Constraint` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

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
    MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
                                 `id` int(11) NOT NULL,
                                 `dbase` varchar(255) NOT NULL DEFAULT '',
                                 `user` varchar(255) NOT NULL DEFAULT '',
                                 `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
                                 `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
                                        `db_name` varchar(64) NOT NULL,
                                        `col_name` varchar(64) NOT NULL,
                                        `col_type` varchar(64) NOT NULL,
                                        `col_length` text DEFAULT NULL,
                                        `col_collation` varchar(64) NOT NULL,
                                        `col_isNull` tinyint(1) NOT NULL,
                                        `col_extra` varchar(255) DEFAULT '',
                                        `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
                                    `id` int(5) UNSIGNED NOT NULL,
                                    `db_name` varchar(64) NOT NULL DEFAULT '',
                                    `table_name` varchar(64) NOT NULL DEFAULT '',
                                    `column_name` varchar(64) NOT NULL DEFAULT '',
                                    `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
                                    `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
                                    `transformation` varchar(255) NOT NULL DEFAULT '',
                                    `transformation_options` varchar(255) NOT NULL DEFAULT '',
                                    `input_transformation` varchar(255) NOT NULL DEFAULT '',
                                    `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
                                          `username` varchar(64) NOT NULL,
                                          `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
                                         `id` int(5) UNSIGNED NOT NULL,
                                         `username` varchar(64) NOT NULL,
                                         `export_type` varchar(10) NOT NULL,
                                         `template_name` varchar(64) NOT NULL,
                                         `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
                                 `username` varchar(64) NOT NULL,
                                 `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
                                `id` bigint(20) UNSIGNED NOT NULL,
                                `username` varchar(64) NOT NULL DEFAULT '',
                                `db` varchar(64) NOT NULL DEFAULT '',
                                `table` varchar(64) NOT NULL DEFAULT '',
                                `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
                                `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
                                         `username` varchar(64) NOT NULL,
                                         `item_name` varchar(64) NOT NULL,
                                         `item_type` varchar(64) NOT NULL,
                                         `db_name` varchar(64) NOT NULL,
                                         `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
                                  `db_name` varchar(64) NOT NULL DEFAULT '',
                                  `page_nr` int(10) UNSIGNED NOT NULL,
                                  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
                               `username` varchar(64) NOT NULL,
                               `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
    ('root', '[{\"db\":\"my_proj\",\"table\":\"products\"},{\"db\":\"my_proj\",\"table\":\"users\"},{\"db\":\"my_proj\",\"table\":\"order_items\"},{\"db\":\"my_proj\",\"table\":\"orders\"},{\"db\":\"company\",\"table\":\"Computer\"},{\"db\":\"mysql\",\"table\":\"general_log\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
                                 `master_db` varchar(64) NOT NULL DEFAULT '',
                                 `master_table` varchar(64) NOT NULL DEFAULT '',
                                 `master_field` varchar(64) NOT NULL DEFAULT '',
                                 `foreign_db` varchar(64) NOT NULL DEFAULT '',
                                 `foreign_table` varchar(64) NOT NULL DEFAULT '',
                                 `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
                                      `id` int(5) UNSIGNED NOT NULL,
                                      `username` varchar(64) NOT NULL DEFAULT '',
                                      `db_name` varchar(64) NOT NULL DEFAULT '',
                                      `search_name` varchar(64) NOT NULL DEFAULT '',
                                      `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
                                     `db_name` varchar(64) NOT NULL DEFAULT '',
                                     `table_name` varchar(64) NOT NULL DEFAULT '',
                                     `pdf_page_number` int(11) NOT NULL DEFAULT 0,
                                     `x` float UNSIGNED NOT NULL DEFAULT 0,
                                     `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
                                   `db_name` varchar(64) NOT NULL DEFAULT '',
                                   `table_name` varchar(64) NOT NULL DEFAULT '',
                                   `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
                                      `username` varchar(64) NOT NULL,
                                      `db_name` varchar(64) NOT NULL,
                                      `table_name` varchar(64) NOT NULL,
                                      `prefs` text NOT NULL,
                                      `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

--
-- Dumping data for table `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
    ('root', 'my_proj', 'products', '{\"sorted_col\":\"`products`.`product_name` ASC\"}', '2024-06-10 13:31:40');

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
                                 `db_name` varchar(64) NOT NULL,
                                 `table_name` varchar(64) NOT NULL,
                                 `version` int(10) UNSIGNED NOT NULL,
                                 `date_created` datetime NOT NULL,
                                 `date_updated` datetime NOT NULL,
                                 `schema_snapshot` text NOT NULL,
                                 `schema_sql` text DEFAULT NULL,
                                 `data_sql` longtext DEFAULT NULL,
                                 `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
                                 `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
                                   `username` varchar(64) NOT NULL,
                                   `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
                                   `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
    ('root', '2024-06-10 21:35:03', '{\"Console\\/Mode\":\"collapse\",\"ThemeDefault\":\"metro\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
                                   `usergroup` varchar(64) NOT NULL,
                                   `tab` varchar(64) NOT NULL,
                                   `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
                              `username` varchar(64) NOT NULL,
                              `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
    ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
    ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
    ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
    ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
    ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
    ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
    ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
    ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
    ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
    ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
    ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
    ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
    ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
    ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
    ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
    MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
    MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
    MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
    MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
