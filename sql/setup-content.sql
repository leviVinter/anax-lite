-- CREATE DATABASE IF NOT EXISTS thhe16;
USE thhe16;

-- Ensure UTF8 as character encoding within connection.
SET NAMES utf8;

-- Create
DROP TABLE IF EXISTS `content`;
CREATE TABLE `content`
(
    `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `path` CHAR(120) UNIQUE,
    `slug` CHAR(120) UNIQUE,
    `title` VARCHAR(120),
    `data` TEXT,
    `type` CHAR(20),
    `filter` VARCHAR(80) DEFAULT NULL,

    -- MySQL version 5.6 and higher
    -- `published` DATETIME DEFAULT CURRENT_TIMESTAMP,
    -- `created` DATETIME DEFAULT CURRENT_TIMESTAMP,
    -- `updated` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,

    -- MySQL version 5.5 and lower
    `published` DATETIME DEFAULT NULL,
    `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated` DATETIME DEFAULT NULL, -- ON UPDATE CURRENT_TIMESTAMP,
    `deleted` DATETIME DEFAULT NULL
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO `content` (`path`, `slug`, `type`, `title`, `data`, `filter`, `published`) VALUES
    ("hem", null, "page", "Hem", "Detta är min hemsida. Den är skriven i [url=http://en.wikipedia.org/wiki/BBCode]bbcode[/url] vilket innebär att man kan formattera texten till [b]bold[/b] och [i]kursiv stil[/i] samt hantera länkar.\n\nDessutom finns ett filter 'nl2br' som lägger in <br>-element istället för \\n, det är smidigt, man kan skriva texten precis som man tänker sig att den skall visas, med radbrytningar.", "bbcode,nl2br", NOW()),
    ("om", null, "page", "Om", "Detta är en sida om mig och min webbplats. Den är skriven i [Markdown](http://en.wikipedia.org/wiki/Markdown). Markdown innebär att du får bra kontroll över innehållet i din sida, du kan formattera och sätta rubriker, men du behöver inte bry dig om HTML.\n\nRubrik nivå 2\n-------------\n\nDu skriver enkla styrtecken för att formattera texten som **fetstil** och *kursiv*. Det finns ett speciellt sätt att länka, skapa tabeller och så vidare.\n\n###Rubrik nivå 3\n\nNär man skriver i markdown så blir det läsbart även som textfil och det är lite av tanken med markdown.", "markdown", NOW()),
    ("blogpost-1", "valkommen-till-min-blogg", "post", "Välkommen till min blogg!", "Detta är en bloggpost.\n\nNär det finns länkar till andra webbplatser så kommer de länkarna att bli klickbara.\n\nhttp://dbwebb.se är ett exempel på en länk som blir klickbar.", "link,nl2br", NOW()),
    ("blogpost-2", "nu-har-sommaren-kommit", "post", "Nu har sommaren kommit", "Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost.", "nl2br", NOW()),
    ("blogpost-3", "nu-har-hosten-kommit", "post", "Nu har hösten kommit", "Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost", "nl2br", NOW()),
	(null, null, "block", "Sidebar", "* [PHP-manualen](http://php.net/manual/en/)
* [Markdown-syntax](https://daringfireball.net/projects/markdown/syntax)
* [Bootstrap](http://getbootstrap.com/)
* [MySQL-manualen](https://dev.mysql.com/doc/refman/5.7/en/)
* [Composer](https://getcomposer.org/)", "markdown", null);

SELECT `id`, `path`, `slug`, `type`, `title`, `created` FROM `content`;
