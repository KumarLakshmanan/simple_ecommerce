CREATE TABLE `products` (
	`id` int(11) NOT NULL,
	`product_name` varchar(255) NOT NULL,
	`product_image` varchar(255) NOT NULL,
	`distributor_price` VARCHAR(255) NOT NULL,
    `retailer_price` VARCHAR(255) NOT NULL,
    `mrp_price` VARCHAR(255) NOT NULL,
	`created_at` datetime NOT NULL,
	`updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

ALTER TABLE `products`
	ADD PRIMARY KEY (`id`);

ALTER TABLE `products`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `products`
	ADD `product_description` TEXT NOT NULL AFTER `product_name`;

-- edit updated_at and CURRENT_TIMESTAMP
ALTER TABLE `products`
	CHANGE `updated_at` `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;