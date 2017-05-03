-- CREATE DATABASE IF NOT EXISTS thhe16;
USE thhe16;

-- Ensure UTF8 as character encoding within connection.
SET NAMES utf8;

-- ------------------------------------------------------------------------
--
-- Setup tables
--
DROP TABLE IF EXISTS `Inventory`;
DROP TABLE IF EXISTS `InvenShelf`;
DROP TABLE IF EXISTS `CartRow`;
DROP TABLE IF EXISTS `OrderRow`;
DROP TABLE IF EXISTS `InvoiceRow`;
DROP TABLE IF EXISTS `ReOrderLog`;
DROP TABLE IF EXISTS `Product`;
DROP TABLE IF EXISTS `ProdCategory`;
DROP TABLE IF EXISTS `Image`;
DROP TABLE IF EXISTS `Cart`;
DROP TABLE IF EXISTS `Invoice`;
DROP TABLE IF EXISTS `Order`;
DROP TABLE IF EXISTS `Customer`;

-- ------------------------------------------------------------------------
--
-- Product and product category
--
CREATE TABLE `ProdCategory` (
    `id` INT AUTO_INCREMENT,
    `category` CHAR(20),

    PRIMARY KEY (`id`)
);

CREATE TABLE `Image` (
    `id` INT AUTO_INCREMENT,
    `name` VARCHAR(120),

    PRIMARY KEY (`id`)
);

CREATE TABLE `Product` (
    `id` INT AUTO_INCREMENT,
    `name` VARCHAR(120),
    `description` TEXT,
    `price` DECIMAL(7, 2) DEFAULT 0,
    `image_id` INT,
    `cat_id` INT,

    PRIMARY KEY (`id`),
    FOREIGN KEY (`image_id`) REFERENCES `Image` (`id`),
    FOREIGN KEY (`cat_id`) REFERENCES `ProdCategory` (`id`)
);


-- ------------------------------------------------------------------------
--
-- Inventory and shelfs
--
CREATE TABLE `InvenShelf` (
    `shelf` CHAR(6),
    `description` VARCHAR(40),

    PRIMARY KEY (`shelf`)
);

CREATE TABLE `Inventory` (
    `id` INT AUTO_INCREMENT,
    `prod_id` INT,
    `shelf_id` CHAR(6),
    `items` INT,

    PRIMARY KEY (`id`),
    FOREIGN KEY (`prod_id`) REFERENCES `Product` (`id`),
    FOREIGN KEY (`shelf_id`) REFERENCES `InvenShelf` (`shelf`)
);

-- ------------------------------------------------------------------------
--
-- Customer
--
CREATE TABLE `Customer` (
	`id` INT AUTO_INCREMENT,
    `firstName` VARCHAR(20),
    `lastName` VARCHAR(20),
  
	PRIMARY KEY (`id`)
);



-- ------------------------------------------------------------------------
--
-- Order
--
CREATE TABLE `Order` (
	`id` INT AUTO_INCREMENT,
    `customer_id` INT,
	`created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	`updated` DATETIME DEFAULT NULL,
	`deleted` DATETIME DEFAULT NULL,
	`delivery` DATETIME DEFAULT NULL,
    
	PRIMARY KEY (`id`),
	FOREIGN KEY (`customer_id`) REFERENCES `Customer` (`id`)
);

CREATE TABLE `OrderRow` (
	`id` INT AUTO_INCREMENT,
    `order_id` INT,
    `product_id` INT,
	`items` INT,

	PRIMARY KEY (`id`),
	FOREIGN KEY (`order_id`) REFERENCES `Order` (`id`),
	FOREIGN KEY (`product_id`) REFERENCES `Product` (`id`)
);

-- ------------------------------------------------------------------------
--
-- Shopping cart
--
CREATE TABLE `Cart` (
    `id` INT AUTO_INCREMENT,
    `customer_id` INT,

    PRIMARY KEY (`id`),
    FOREIGN KEY (`customer_id`) REFERENCES `Customer` (`id`)
);

CREATE TABLE `CartRow` (
    `id` INT AUTO_INCREMENT,
    `cart_id` INT,
    `prod_id` INT,
    `items` INT,

    PRIMARY KEY (`id`),
    FOREIGN KEY (`cart_id`) REFERENCES `Cart` (`id`),
    FOREIGN KEY (`prod_id`) REFERENCES `Product` (`id`)
);

-- ------------------------------------------------------------------------
--
-- Products that needs to be re-ordered
--
CREATE TABLE `ReOrderLog` (
    `id` INT AUTO_INCREMENT,
    `prod_id` INT,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `deleted` DATETIME DEFAULT NULL,

    PRIMARY KEY (`id`),
    FOREIGN KEY (`prod_id`) REFERENCES `Product` (`id`)
);

-- ------------------------------------------------------------------------
--
-- Invoice
--
CREATE TABLE `Invoice` (
	`id` INT AUTO_INCREMENT,
    `order_id` INT,
    `customer_id` INT,
	`created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
	PRIMARY KEY (`id`),
	FOREIGN KEY (`order_id`) REFERENCES `Order` (`id`),
	FOREIGN KEY (`customer_id`) REFERENCES `Customer` (`id`)
);

CREATE TABLE `InvoiceRow` (
	`id` INT AUTO_INCREMENT,
    `invoice_id` INT,
    `product_id` INT,
	`items` INT,

	PRIMARY KEY (`id`),
	FOREIGN KEY (`invoice_id`) REFERENCES `Invoice` (`id`),
	FOREIGN KEY (`product_id`) REFERENCES `Product` (`id`)
);

-- ------------------------------------------------------------------------
--
-- Starting product catalogue
--
INSERT INTO `ProdCategory` (`category`) VALUES
("Electric Guitar"), ("Acoustic Guitar"), ("Digital Piano"), ("Keyboard"), ("Electric Bass"),
("Drums")
;

INSERT INTO `Image` (`name`) VALUES
("electric-guitar.jpg"), ("classical-guitar.jpg"), ("digital-piano.png"),
("keyboard.jpeg"), ("bass.jpg"), ("drums.png")
;

INSERT INTO `Product` (`name`, `price`, `description`, `image_id`, `cat_id`) VALUES
("Fender Standard Stratocaster RW Brown Sunburst", 6049.00,
    "Elgitarr med kropp av al, lönnhals med greppbräda av rosewood, tremolo, 3 st Standard Single-Coil pickups och hardware i krom.",
    1, 1),
("Yamaha C45A Senior Guitar", 1299.00,
    "Klassisk gitarr med granlock, sidor och botten av meranti och natohals med greppbräda av rosewood. Ett bra val som första gitarr!",
    2, 2),
("Roland FP-90", 17749.00,
    "Stagepiano med 88 PHA-50 tangenter med SuperNATURAL piano ljudprocessor, inbyggda högtalare och bluetooth.",
    3, 3),
("Yamaha PSR-E353", 1799.00,
    "Anslagskänslig keyboard med 61 tangenter, 573 förprogrammerade ljud, 158 auto-komp och 150 förinställda arpeggio-varianter. Gratis appar till iPhone/iPad.",
    4, 4),
("Yamaha BB714BSLR", 8369.00,
    "Billy Sheehan signatur med kropp av al, lönnhals med rosewood greppbräda, kromad hårdvara, och P och SubBass pickups med aktiv elektronik.",
    5, 5),
("Pearl Export New Standard EXX725S Smokey Chrom", 8839.00,
    "Komplett trumset som består av 22x18 bastrumma, 10x7 och 12x8 tom, 16x16 Floor Tom och 14x5,5 virveltrumma. Inkl. cymbaler och stativ.",
    6, 6)
;


SELECT
    P.id,
    P.name,
    P.price,
    I.name AS image,
    GROUP_CONCAT(category) AS category
FROM Product AS P
    INNER JOIN ProdCategory AS PC
        ON P.cat_id = PC.id
    INNER JOIN Image AS I
        ON P.image_id = I.id
GROUP BY P.id
ORDER BY category
;

-- ------------------------------------------------------------------------
--
-- Put the stuff into shelfs
--
INSERT INTO `InvenShelf` (`shelf`, `description`) VALUES
("AAA101", "House A, aisle A, part A, shelf 101"),
("AAA102", "House A, aisle A, part A, shelf 102")
;

INSERT INTO `Inventory` (`prod_id`, `shelf_id`, `items`) VALUES
(1, "AAA101", 10), (2, "AAA101", 10), (3, "AAA102", 10),
(4, "AAA101", 10), (5, "AAA101", 10), (6, "AAA102", 10)
;

SELECT * FROM InvenShelf;


--
-- Create users
--
INSERT INTO `Customer` (`firstName`, `lastName`) VALUES
("Anders", "Johansson"), ("Peter", "Bengtsson"), ("Anna", "Eriksson");

SELECT * FROM Customer;

--
-- Create carts
--
INSERT INTO `Cart` (`customer_id`) VALUES
(1), (2), (3);

-- -------------------------------------------------------------------------
--
-- View connecting products with their place in the inventory
--
DROP VIEW IF EXISTS VInventory;
CREATE VIEW VInventory AS
SELECT
    C.category,
    P.id,
    P.name AS product,
    S.shelf AS shelf,
    S.description AS location,
    I.items AS amount,
    P.description AS description,
    Image.name AS image
FROM Inventory AS I
    LEFT OUTER JOIN InvenShelf AS S
        ON I.shelf_id = S.shelf
    LEFT OUTER JOIN Product AS P
        ON I.prod_id = P.id
    LEFT OUTER JOIN Image
        ON Image.id = P.image_id
    LEFT OUTER JOIN ProdCategory AS C
        ON C.id = P.cat_id
GROUP BY P.id
ORDER BY C.category
;

SELECT * FROM VInventory;
SELECT product, amount, shelf, location FROM VInventory;

--
-- View connecting product with category and image
--

DROP VIEW IF EXISTS VProduct;
CREATE VIEW VProduct AS
SELECT
    C.category,
    P.id AS prodId,
    P.name AS prodName,
    P.description,
    P.price,
    I.id AS imageId,
    I.name AS imageName,
    Inven.items AS amount,
    S.shelf
FROM Product AS P
    LEFT OUTER JOIN Image AS I
        ON I.id = P.image_id
    LEFT OUTER JOIN ProdCategory AS C
        ON C.id = P.cat_id
    LEFT OUTER JOIN Inventory AS Inven
        ON P.id = Inven.prod_id
    LEFT OUTER JOIN InvenShelf AS S
        ON Inven.shelf_id = S.shelf
GROUP BY prodId
ORDER BY C.category
;

SELECT * FROM VProduct;

--
-- View shopping cart
--
DROP VIEW IF EXISTS VCart;
CREATE VIEW VCart AS
SELECT
    CR.id AS cartRow,
    C.id AS cart,
    Cus.id AS customerId,
    CONCAT(Cus.firstName, " ", Cus.lastName) AS name,
    P.name AS product,
    CR.items AS amount,
    (P.price * CR.items) AS price
FROM Cart AS C
    INNER JOIN Customer AS Cus
        ON C.customer_id = Cus.id
    INNER JOIN CartRow AS CR
        ON C.id = CR.cart_id
    INNER JOIN Product AS P
        ON P.id = CR.prod_id
ORDER BY C.id
;

--
-- Order details
--
DROP VIEW IF EXISTS VOrderDetails;
CREATE VIEW VOrderDetails AS
SELECT
    O.id AS OrderNumber,
    R.id AS OrderRow,
    P.name AS Product,
    R.items AS Items
FROM `Order` AS O
	INNER JOIN OrderRow AS R
		ON O.id = R.order_id
	INNER JOIN Product AS P
		ON R.product_id = P.id
WHERE O.deleted IS NULL
ORDER BY OrderRow
;

--
-- Order Plocklist
--
DROP VIEW IF EXISTS VPlockList;
CREATE VIEW VPlockList AS 
SELECT
    O.id AS OrderNumber,
    R.id AS OrderRow,
    P.description AS Description,
    R.items AS Items,
    S.shelf AS Shelf,
    S.description AS ShelfLocation,
    I.items AS ItemsAvailable
FROM `Order` AS O
	INNER JOIN OrderRow AS R
		ON O.id = R.order_id
	INNER JOIN Product AS P
		ON R.product_id = P.id
	INNER JOIN Inventory AS I
		ON P.id = I.prod_id
	INNER JOIN InvenShelf AS S
		ON I.shelf_id = S.shelf
WHERE O.deleted IS NULL
ORDER BY OrderRow
;

--
-- Re-order report
--

DROP VIEW IF EXISTS VReOrder;
CREATE VIEW VReOrder AS 
SELECT
    ROL.id AS logId,
    ROL.created AS created,
    P.id AS productId,
    P.name AS productName,
    I.items AS itemsLeft,
    S.shelf AS Shelf,
    S.description AS ShelfLocation
FROM `ReOrderLog` AS ROL
	INNER JOIN Product AS P
		ON ROL.prod_id = P.id
    INNER JOIN Inventory AS I
        ON I.prod_id = P.id
    INNER JOIN InvenShelf AS S
        ON S.shelf = I.shelf_id
WHERE I.items < 5
ORDER BY ROL.created
;


--
-- Procedure updateProduct()
--

DROP PROCEDURE IF EXISTS updateProduct;

DELIMITER //

CREATE PROCEDURE updateProduct(
    prodId INT,
    newName VARCHAR(120),
    newCategory CHAR(20),
    newShelf CHAR(6),
    newDescription TEXT,
    newImage VARCHAR(120),
    newPrice DECIMAL(7, 2),
    newAmount INT
)
BEGIN
    START TRANSACTION;

    UPDATE Product
    SET
        name = newName,
        description = newDescription,
        price = newPrice,
        image_id = (SELECT id FROM Image WHERE name = newImage),
        cat_id = (SELECT id FROM ProdCategory WHERE category = newCategory)
    WHERE
        id = prodId;

    UPDATE Inventory
    SET
        items = newAmount,
        shelf_id = newShelf
    WHERE prod_id = prodId;

    COMMIT;

    SELECT * FROM Product;
END
//

DELIMITER ;

--
-- Procedure createProduct()
--

DROP PROCEDURE IF EXISTS createProduct;

DELIMITER //

CREATE PROCEDURE createProduct(
    prodName VARCHAR(120),
    amount INT,
    newShelf CHAR(6)
)
BEGIN
    START TRANSACTION;

    INSERT INTO Product (name) VALUES (prodName);

    INSERT INTO Inventory (prod_id, items, shelf_id)
    VALUES
        ((SELECT MAX(id) FROM Product), amount, newShelf)
    ;

    SELECT MAX(id) AS id FROM Product;

    COMMIT;

END
//

DELIMITER ;

-- ---------------------------------------------------------------
--
-- Add and delete from shopping cart
--
DROP PROCEDURE IF EXISTS addToCart;

DELIMITER //

CREATE PROCEDURE addToCart(
    customerId INT,
    productId INT,
    amount INT
)
BEGIN
    DECLARE amountLeft INT;

    START TRANSACTION;

    SET amountLeft = (
        SELECT items FROM Inventory WHERE prod_id = productId
    );

    IF amountLeft - amount < 0 THEN
        ROLLBACK;
        SELECT "There aren't enough products left in storage to put in the cart.";
    ELSE
        INSERT INTO CartRow (cart_id, prod_id, items) VALUES
        ((SELECT id FROM Cart WHERE customer_id = customerId), productId, amount);

        COMMIT;
    END IF;

END
//

DELIMITER ;

DROP PROCEDURE IF EXISTS removeFromCart;

DELIMITER //

CREATE PROCEDURE removeFromCart(
    cartRow INT,
    amount INT
)
BEGIN
    DECLARE amountLeft INT;

    START TRANSACTION;

    SET amountLeft = (
        SELECT items FROM CartRow WHERE id = cartRow
    );

    IF amountLeft - amount < 0 THEN
        ROLLBACK;
        SELECT "There are not that many products in the cart";
    ELSEIF amountLeft - amount = 0 THEN
        DELETE FROM CartRow WHERE id = cartRow;

        COMMIT;
    ELSE
        UPDATE CartRow
        SET
            items = items - amount
        WHERE
            id = cartRow
        ;

        COMMIT;
    END IF;
END
//

DELIMITER ;

-- ---------------------------------------------------------------
--
-- Function for checking items in the shopping cart
--
DELIMITER //

DROP FUNCTION IF EXISTS productsInCart //
CREATE FUNCTION productsInCart(
    cartId INT
)
RETURNS BOOLEAN
BEGIN
    DECLARE nrOfProducts INT;
    SET nrOfProducts = (
        SELECT COUNT(id) FROM CartRow WHERE cart_id = cartId
    );

    IF nrOfProducts > 0 THEN
        RETURN true;
    END IF;
    RETURN false;
END
//

DELIMITER ;

-- ---------------------------------------------------------------
--
-- Move products in shopping cart to an order and remove from Inventory
--
DROP PROCEDURE IF EXISTS createOrder;

DELIMITER //

CREATE PROCEDURE createOrder(
    cartId INT
)
BEGIN
    START TRANSACTION;

    IF productsInCart(cartId) THEN
        INSERT INTO `Order` (`customer_id`) VALUES
        ((SELECT customer_id FROM Cart WHERE id = cartId));

        SELECT MAX(id) INTO @orderId FROM `Order`;

        WHILE productsInCart(cartId) DO
            SELECT prod_id, items INTO @productId, @nrOfItems
            FROM CartRow WHERE cart_id = cartId LIMIT 1;

            SELECT items INTO @prodsInInventory FROM Inventory
            WHERE prod_id = @productId;

            IF @prodsInInventory >= @nrOfItems THEN
                INSERT INTO `OrderRow` (`order_id`, `product_id`, `items`)
                VALUES (@orderId, @productId, @nrOfItems);

                DELETE FROM `CartRow` WHERE cart_id = cartId LIMIT 1;

                UPDATE `Inventory` SET items = items - @nrOfItems WHERE
                prod_id = @productId;
            ELSE
                ROLLBACK;
                SELECT "Not enough products in Inventory for moving to order";
            END IF;
        END WHILE;
        COMMIT;
    ELSE
        ROLLBACK;
        SELECT "There are no items in cart.";
    END IF;
    

END
//

DELIMITER ;

-- ---------------------------------------------------------------
--
-- Move products in shopping cart to an order and update Inventory
--
DROP PROCEDURE IF EXISTS removeOrder;

DELIMITER //

CREATE PROCEDURE removeOrder(
    orderId INT
)
BEGIN
    DECLARE nrOfProducts INT;
    DECLARE currOffset INT;
    START TRANSACTION;

    SET nrOfProducts = (SELECT COUNT(id) FROM OrderRow WHERE order_id = orderId);
    SET currOffset = 0;
    WHILE currOffset < nrOfProducts DO
        SELECT product_id, items INTO @productId, @nrOfItems
        FROM OrderRow WHERE order_id = orderId LIMIT 1 OFFSET currOffset;

        UPDATE `Inventory` SET items = items + @nrOfItems
        WHERE prod_id = @productId;

        SET currOffset = currOffset + 1;
    END WHILE;

    UPDATE `Order` SET deleted = NOW() WHERE id = orderId;

    COMMIT;

END
//

DELIMITER ;

-- ---------------------------------------------------------------
--
-- Check if a product needs to be ordered
--
DROP TRIGGER IF EXISTS `LogReOrder`;

DELIMITER //

CREATE TRIGGER `LogReOrder`
AFTER UPDATE
ON `Inventory` FOR EACH ROW
    IF NEW.items < 5 AND OLD.items > 5 THEN
        INSERT INTO `ReOrderLog` (prod_id)
        VALUES (NEW.prod_id);
    ELSEIF NEW.items > 5 AND OLD.items < 5 THEN
        DELETE FROM `ReOrderLog` WHERE prod_id = NEW.prod_id;
    END IF;
//

DELIMITER ;
