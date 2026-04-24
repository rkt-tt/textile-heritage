-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 22, 2026 at 12:54 PM
-- Server version: 8.0.43-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `textile_heritage`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(4, 'admin', '$2y$10$cXlMuwqCKTSxZpEmTr1A5u55dO6SwYe9kiMb9yC19uFy8QTg4RaPa');

-- --------------------------------------------------------

--
-- Table structure for table `coe_menu`
--

CREATE TABLE `coe_menu` (
  `id` int NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_key` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int DEFAULT '0',
  `status` tinyint DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coe_menu`
--

INSERT INTO `coe_menu` (`id`, `title`, `page_key`, `sort_order`, `status`) VALUES
(1, 'About', 'about', 1, 1),
(2, 'Vision', 'vision', 2, 1),
(3, 'Mission', 'mission', 3, 1),
(4, 'Key Objectives', 'objectives', 4, 1),
(5, 'Organisational Diagram', 'org', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `coe_pages`
--

CREATE TABLE `coe_pages` (
  `id` int NOT NULL,
  `page_key` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coe_pages`
--

INSERT INTO `coe_pages` (`id`, `page_key`, `title`, `content`) VALUES
(1, 'about', 'About CoE', '<br><br>About Centre<br><br>\r\nThe Science and Heritage Research Initiative (SHRI) by the Department of Science and Technology (DST), Government of India, aims to integrate scientific research with the preservation and revitalization of India’s rich cultural heritage. Under this initiative, the Centre for Sustainable Textile Heritage and Technology has been established as a multidisciplinary platform to document, conserve, and technologically strengthen traditional textile systems. The centre brings together institutions, researchers, and artisans to develop sustainable solutions, enhance skill development, and create a digital knowledge base, ensuring long-term preservation and economic viability of India’s textile heritage.\r\n'),
(2, 'vision', 'Vision', '<br><br>\r\nTo preserve and transform India’s textile heritage through science, technology, and sustainable innovation.'),
(3, 'mission', 'Mission', '<br><br>\r\nTo document, innovate, and empower—integrating traditional knowledge with modern technology for sustainable growth of textile heritage systems.'),
(4, 'objectives', 'Key Objectives', '<br><br><ul><li>Research and Documentation: Conducting in-depth research on key heritage textile products, studying traditional techniques, materials, and designs.</li><li>Skill Development and Training: Empowering local artisans through training programs in modern design techniques, quality control, and sustainable practices.</li><li>Technological Innovation: Leveraging technology to enhance production processes, improve quality of heritage textile products, and expand market reach.</li></ul>'),
(5, 'org', 'Organisational Diagram', '<br><br><img src=\"assets/images/org.png\" width=\"500\">\r\n<br><br>The Centre for Sustainable Textile Heritage and Technology operates through a structured governance framework designed to ensure coordinated implementation, standardization, and scalability across all projects. The centre follows a hub-and-spoke model, with IIT Delhi functioning as the central coordination hub and collaborating institutions acting as project-specific spokes. This structure enables decentralized execution while maintaining centralized oversight, quality control, and knowledge integration.\r\nCentre Overview\r\nTotal Projects	15\r\nActive Projects (Spokes)	5\r\nHub (Coordinator)	IIT Delhi\r\nCoverage	Pan India\r\n<br><br>\r\n<img src=\"assets/images/heritage_map.png\" width=\"500\">\r\n\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `product_key` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_key`, `product_name`, `status`) VALUES
(1, 'baluchari', 'Baluchari Saree', 1),
(2, 'muslin', 'Muslin', 1),
(3, 'phulkari', 'Phulkari', 1),
(4, 'negamam', 'Negamam Saree', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_menu`
--

CREATE TABLE `product_menu` (
  `id` int NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page_key` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int DEFAULT '0',
  `status` tinyint DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_menu`
--

INSERT INTO `product_menu` (`id`, `title`, `page_key`, `sort_order`, `status`) VALUES
(1, 'Baluchari Saree', 'baluchari', 1, 1),
(2, 'Muslin', 'muslin', 2, 1),
(3, 'Negamam Saree', 'negamam', 3, 1),
(4, 'Phulkari', 'phulkari', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_pages`
--

CREATE TABLE `product_pages` (
  `id` int NOT NULL,
  `page_key` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caption` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_pages`
--

INSERT INTO `product_pages` (`id`, `page_key`, `section`, `content`, `image`, `caption`) VALUES
(6, 'baluchari', 'History and Evolution', '<p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><strong>Origin and Migration: </strong>The Baluchari craft originated in Baluchar (Murshidabad), West Bengal. Its development was significantly influenced by geopolitical shifts; in 1704, Murshid Quli Khan, the first independent Nawab of Bengal, moved the capital of the Bengal Presidency from Dacca to Baluchar. This relocation drew skilled craftsmen from Dacca and Benaras to the new capital. Later, following a massive flood, these artisans shifted to Bishnupur, where the Malla dynasty stepped in to promote and sustain the skill.</p><p><br></p><p><img src=\"assets/images/1776703542_6937.jpg\"></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><strong>Major Transformations</strong>: The Baluchari saree has experienced key technical and aesthetic shifts:</p><p class=\"ql-align-justify\"><br></p><ul><li class=\"ql-align-justify\"><strong>Materials and Techniques: </strong>Production transitioned from natural dyes to synthetic dyes, and weaving evolved from traditional handlooms to powered jacquard looms.</li></ul><p class=\"ql-align-justify\"><br></p><ul><li class=\"ql-align-justify\"><strong>Design Motifs: </strong>While Mughal and British era designs depicted socio-politico-cultural events, modern designs focus on mythological stories told in a narrative style.</li></ul><p class=\"ql-align-justify\"><br></p><ul><li class=\"ql-align-justify\"><strong>The Impact of Industrialization and Policy: </strong>Industrialization and automated machinery caused the craft\'s initial decline during the colonial period. Its survival and transition into the modern era were made possible by post-independence interventions and institutional support from organizations such as the Silk Khadi Seva Mandal.</li></ul><p><br></p><p><img src=\"assets/images/1776588022_4053.png\"></p>', NULL, NULL),
(7, 'baluchari', 'Heritage', '<p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">The Bauchari sarees have been recognized as a heritage textile product for several reasons:</p><p class=\"ql-align-justify\"><br></p><ul><li class=\"ql-align-justify\">           These sarees are distinguished by unique motifs and patterns that make historical depictions of mythological events, geo-political issues and socio-politico-cultural events.</li></ul><p class=\"ql-align-justify\"><br></p><ul><li class=\"ql-align-justify\">            Baluchari sarees are found only in Bishnupur, in the state of West Bengal in India and have been issued the GI tag</li></ul><p class=\"ql-align-justify\"><br></p><ul><li class=\"ql-align-justify\">           Baluchari sarees are part of the local culture of Bengal and have deep traditional significance. These sarees derive their uniqueness due to the depiction of several socio-politico-cultural historical events, Indian rituals, events of mythological stories and Persian art forms.</li></ul><p><br></p>', NULL, NULL),
(8, 'baluchari', 'Product Features', '<p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">The Baluchari saree is characterized by specific physical dimensions, structural components, and technical weaving requirements as outlined below:</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><strong>Physical Dimensions and Weight</strong></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify ql-indent-2\"><strong>         Length: </strong>Typically ranges between 5 m and 6.5 m.</p><p class=\"ql-align-justify ql-indent-2\"><strong>         Width: </strong>Measures between 116 cms and 122 cms.</p><p class=\"ql-align-justify ql-indent-2\"><strong>         Weight: </strong>Generally exceeds 400gm, though the final weight is contingent upon the quantity of mulberry or tassar silk yarn utilized and the extent of the zari work.</p><p class=\"ql-align-justify\"><br></p><ul><li class=\"ql-align-justify\"><strong>Structural Composition and Appearance: </strong>The saree is composed of three distinct parts: the body, the border, and the pallu (anchal).</li></ul><p class=\"ql-align-justify\"><br></p><ul><li class=\"ql-align-justify\"><strong>Visuals: </strong>It features a shiny appearance with borders traditionally rendered in bright and/or dark vibrant colors.</li></ul><p class=\"ql-align-justify\"><br></p><ul><li class=\"ql-align-justify\"><strong>Detailing: </strong>Both the pallu and the border contain rich zari work, which is more concentrated in these sections than in the body of the saree.</li></ul><p class=\"ql-align-justify\"><br></p><ul><li class=\"ql-align-justify\"><strong>Technical Manufacturing: </strong>The weaving process utilizes two high-capacity Jacquards simultaneously, with one specifically dedicated to the ground of the textile.</li></ul><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><img src=\"assets/images/1776707518_9360.jpg\"></p><p><br></p>', NULL, NULL),
(9, 'muslin', 'About', '<p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">Muslin, once celebrated as the “woven wind” or “fabric of the wind” for its extraordinary fineness, lightness, transparency, and breathability, represents one of the greatest textile heritages of the Indian subcontinent, particularly Bengal. Muslin cloth is a plain-weave cotton fabric.</p><p><br></p>', NULL, NULL),
(10, 'muslin', 'History and Evolution', '<p><br></p><p class=\"ql-align-justify\">The history of muslin is defined by its ancient origins in the Bengal subcontinent, its peak as a prestigious Mughal-era textile, and its eventual decline under British colonial rule.&nbsp;The historical development of Muslin in West Bengal&nbsp;has been outlined here:</p><p class=\"ql-align-justify\"><br></p><ul><li class=\"ql-align-justify\">Muslin originated around 1000 BCE in the Bengal subcontinent.</li></ul><p class=\"ql-align-justify\"><br></p><ul><li class=\"ql-align-justify\">Production centered in Sonargaon (Dhaka) and its surroundings, alongside Santipur and Murshidabad in West Bengal.</li></ul><p class=\"ql-align-justify\"><br></p><ul><li class=\"ql-align-justify\">It reached its peak during the 17th–18th century Mughal period.</li></ul><p class=\"ql-align-justify\"><br></p><ul><li class=\"ql-align-justify\">British colonial rule caused its decline through cheap English imports and colonialist oppression.</li></ul><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><img src=\"assets/images/1776706359_4774.jpg\"></p><p><br></p><p class=\"ql-align-justify\"><strong>Major Transformations over time</strong></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\">The evolution of muslin production has shifted from ancient manual yarn preparation by young artisans to modern solar-powered spinning, while maintaining strictly motor-free handloom weaving to preserve its heritage and GI status.</p><p class=\"ql-align-justify\"><br></p><ul><li class=\"ql-align-justify\">In the ancient times, girls in the age group of 15 to 20 prepared muslin yarn by hand without machinery intervention.</li></ul><p class=\"ql-align-justify\"><br></p><ul><li class=\"ql-align-justify\">The total beauty of the craft depended on the skill and softness of the hand.</li></ul><p class=\"ql-align-justify\"><br></p><ul><li class=\"ql-align-justify\">There was familiarity with the <strong>Ambar Charka</strong> for muslin yarn spinning in 1980.</li></ul><p class=\"ql-align-justify\"><br></p><ul><li class=\"ql-align-justify\">Over time, machine settings and parameters have changed for better processing and production.</li></ul><p class=\"ql-align-justify\"><br></p><ul><li class=\"ql-align-justify\">In modern days, solar power and DC motor-driven systems are utilized in the muslin yarn spinning system.</li></ul><p><br></p>', NULL, NULL),
(11, 'muslin', 'Heritage', '<p><br></p><p class=\"ql-align-justify\">Muslin is a globally renowned heritage textile from Bengal, distinguished by its delicate craftsmanship, historical prominence as a major Mughal-era export, and its modern revival recognized through GI status. The key reasons due to which Muslin cloth is regarded as a heritage textile have been listed below:</p><p class=\"ql-align-justify\"><br></p><ul><li class=\"ql-align-justify\">Exceptional Craftsmanship: Muslin represents traditional weaving skills and local craftsmanship, along with purity and simplicity. The fabric is produced through the excellent craftsmanship of Bengal artisans, resulting in a soft, lightweight, fine, and delicate material. It is a symbol of regional cultural identity and the pride of India. </li></ul><p class=\"ql-align-justify\"><br></p><ul><li class=\"ql-align-justify\">Historical Global Prominence: Mughal Bengal emerged as the world\'s foremost muslin exporter, marking its historical significance during the 17th and 18th centuries.Muslim symbolised elegance, refinement, and an elite lifestyle and was integral to the royal courts of the Mughal Empire.</li></ul><p class=\"ql-align-justify\"><br></p><ul><li class=\"ql-align-justify\">Resilience and Revival: After weaving ceased in the late 18th century due to colonial oppression and English imports, successful revival initiatives were launched in India (late 20th century) and Bangladesh (early 21st century).</li></ul><p class=\"ql-align-justify\"><br></p><ul><li>Geographical Indication (GI) Status: Bengal Muslin received official GI recognition for the Indian state of West Bengal in 2024.</li></ul>', NULL, NULL),
(12, 'muslin', 'Product Features', '<p><br></p><p class=\"ql-align-justify\">Muslin by its extraordinary fineness, lightness, transparency, and breathability. Muslin cloth is a plain-weave cotton fabric. A minimum yarn count of 300 was used for muslin, making it soft and transparent. It is a very fine, lightweight, and comfortable fabric that can even pass through a metal ring. Listed below are the key characteristics of the Muslin fabric:</p><p class=\"ql-align-justify\"><br></p><ul><li class=\"ql-align-justify\">Produced from 100 % Cotton fibre having staple length more than 40 mm.</li></ul><p class=\"ql-align-justify\"> </p><ul><li class=\"ql-align-justify\">Muslin is a fine fabric that allows a whole fabric to pass through a ring.</li></ul><p class=\"ql-align-justify\"><br></p><ul><li class=\"ql-align-justify\">Very few fibres (5-10) in yarn cross-section as a Charka-based hand spinning process.</li></ul><p class=\"ql-align-justify\">&nbsp;&nbsp;</p><ul><li class=\"ql-align-justify\">Hand Ginning and Weaving in Handloom.</li></ul><p class=\"ql-align-justify\">&nbsp;</p><ul><li class=\"ql-align-justify\">No signature motifs or patterns are used in Muslin.</li></ul><p class=\"ql-align-justify\"><br></p><ul><li class=\"ql-align-justify\">Mostly produced as plain(1/1) in weave and white in color.</li></ul><p class=\"ql-align-justify\"><br></p><ul><li class=\"ql-align-justify\">Shirt, Saree, Dhuti, Kurta- Kurti are generally produced from muslin fabric as an end product.</li></ul><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><img src=\"assets/images/1776593362_9894.png\"></p><p><br></p>', NULL, NULL),
(13, 'negamam', 'About', '<p><br></p><p class=\"ql-align-justify\">Negamam Cotton Sarees are handloom textiles produced in the Coimbatore region of Tamil Nadu, supported by moisture-laden winds from the Western Ghats. Typically woven from 80s combed cotton, the fabric is dense, durable, and comfortable for various climates. Production concentrates between June and November when favorable humidity aids yarn handling.</p><p><br></p>', NULL, NULL),
(14, 'negamam', 'History and Evolution', '<p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><strong>Origin:</strong> Negamam Cotton Sarees originated from Negamam village, Coimbatore. Developing after 1871, the village became a weaving and trade center linked to the Devanga community. These skilled weavers migrated from the Kongu belt, and the sarees eventually became identified by the village name.</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><strong>Historical Development:</strong> Originally a local hub supplying coarse 20s and 30s cotton sarees, the region shifted to finer 40s, 60s, and 80s counts. Devanga weavers improved fabric quality and strength. From 1942, cooperative societies organized production, provided yarn, and facilitated market access.</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><img src=\"assets/images/1776593591_9765.png\"></p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><strong>Major Transformations:</strong></p><p class=\"ql-align-justify\"><strong>﻿</strong></p><ul><li class=\"ql-align-justify\">Dimensions: Transitioned from traditional 8-meter lengths to the modern 6.2-meter standard.</li><li class=\"ql-align-justify\">Technical Density: Shifted from 86–90 PPI to contemporary 70–76 PPI, while maintaining 80s combed cotton as the benchmark.</li><li class=\"ql-align-justify\">Design: Simple dobby geometric patterns and narrow borders evolved into complex Jacquard layouts with elaborate motifs and high-contrast colors.</li></ul><p><br></p>', NULL, NULL),
(15, 'negamam', 'Heritage', '<p><br></p><p class=\"ql-align-justify\">Negamam Cotton Sarees are recognized as a textile heritage for their 200-year history in the Pollachi region and their deep connection to the multi-century weaving lineage of the Devanga community.</p><p class=\"ql-align-justify\"><br></p><ul><li class=\"ql-align-justify\">Generational Continuity: The craft has been sustained for over 200 years, with knowledge and skills transmitted within households across two to three generations or more.</li><li class=\"ql-align-justify\">Traditional Techniques: Production relies on time-tested, manual processes including warping, sizing, and handloom weaving preserved with minimal technological intervention.</li><li class=\"ql-align-justify\">Environmental and Cultural Ties: The craft is supported by the local Pollachi climate and maintains strong ties to regional cultural practices and everyday life.</li><li class=\"ql-align-justify\">Heritage Characteristics: Defined by durable textures, simple designs, and nature-inspired motifs, these sarees embody both material and intangible heritage.</li><li class=\"ql-align-justify\">Identity: The textiles represent the regional identity and the socio-cultural fabric of the weaving community.</li></ul><p><br></p>', NULL, NULL),
(16, 'negamam', 'Product Features', '<p><br></p><p class=\"ql-align-justify\">A key feature is the richly woven pallu, featuring traditional motifs like peacocks, parrots, paisleys, elephants, and swans in repeated or mirrored patterns. Jacquard techniques achieve these details, sometimes incorporating half-fine zari for subtle richness. The key product features of Negamam sarees have been listed below:</p><p class=\"ql-align-justify\"><br></p><ul><li class=\"ql-align-justify\">Material: 80s combed cotton (warp/weft); Zari or mercerized cotton for extra-weft designs.</li><li class=\"ql-align-justify\">Technique: Exclusively handloom (pit/raised-pit looms) using traditional \"Thandi\" attachments for high density, natural starches for sizing, and vat dyeing.</li><li class=\"ql-align-justify\">Motifs: Traditional icons like the peacock (Annam), Rudraksha, and various Temple (Komai) borders.</li><li class=\"ql-align-justify\">End-use: Historically an 8-meter drape for Kongu women; currently a 6.2-meter standard saree for daily and functional wear.</li></ul><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><img src=\"assets/images/1776594702_4677.png\"></p><p><br></p>', NULL, NULL),
(17, 'phulkari', 'About', '<p><br></p><p>Phulkari, particularly in the form of a dupatta (headscarf) or chadar (ceremonial shawl), is a traditional hand-embroidered art form from Punjab. Commonly worn on special occasions such as weddings, festivals, and religious ceremonies, it is admired for its vibrant floral motifs and intricate stitching techniques. Often described as “flower work,” it reflects patterns of flowers, leaves, and geometric designs that define its unique aesthetic. Passed down through generations, this art form represents both creative expression and shared cultural heritage. It holds deep cultural, social, and economic significance in the region, symbolizing community traditions while showcasing local beliefs and practices. Additionally, it continues to provide a valuable source of livelihood and financial support for many families.</p>', NULL, NULL),
(18, 'phulkari', 'History and Evolution', '<p><br></p><p class=\"ql-align-justify\">Though the exact origin of Phulkari is unknown, it is believed that it shows similarity with various forms of embroidery from Pakistan, Afghanistan, Persia etc. Etymologically, the word&nbsp;<em>Phulkari</em>&nbsp;has been traced to the Persian words&nbsp;<em>Phul&nbsp;</em>(flower) and&nbsp;<em>Kari&nbsp;</em>(work).&nbsp;</p><p><br></p><p><br></p><p><img src=\"assets/images/1776706500_2472.jpg\"></p>', NULL, NULL),
(19, 'phulkari', 'Heritage', '<p><br></p><p><strong>Why Heritage:&nbsp;</strong>Phulkari is classified as a textile heritage due to its deep-rooted cultural and historical significance. It has ancient origins, with the craft traditionally passed down from mother to daughter, preserving skills and knowledge across generations. Information on the heritage information of Phulkari designs have been discussed below:</p><p><br></p><p><strong>Historical continuity and Cultural significance</strong></p><p><br></p><ul><li>The embroidery serves as a vivid expression of community life, and rural lifestyle of Punjab&nbsp;</li><li>Depiction of beliefs, values, and emotions through intricate embroidery</li><li>Living cultural institution of Punjabi womanhood.&nbsp;</li><li>Mothers and grandmothers begin embroidering daughter\'s trousseau from the time of her birth</li><li>Often stitching prayers, blessings, and life narratives are embroidered onto&nbsp;every thread</li></ul><p><br></p><p><strong>Traditional craftsmanship &amp; materials</strong></p><p><br></p><ul><li>Phulkari is a handcrafted textile art and is created by hand using silk floss (pat) on handwoven cotton fabric</li><li>Traditionally characterised by a darning stitch worked from the reverse side of handwoven khaddar fabric</li></ul><p><br></p><p><strong>Geographical Linkage, Recognition or Protection Status</strong></p><p><br></p><p>Phulkari designs were traditionally produced by the Jat Sikh women of Majha, Malwa, and Doaba sub-regions and also by Hindu and Muslim women of the region in undivided-Punjab. Before the Partition of India, important centers of Phulkari embroidery were spread across districts such as Amritsar, Ludhiana, Jalandhar, and Patiala in India, as well as Lahore, Rawalpindi, Multan, and Sialkot in Pakistan. This shows that Phulkari belongs to the wider Punjabi cultural belt rather than being confined to modern political boundaries.&nbsp;In recognition of its association with Punjab, the Phulkari design was granted a GI tag in 2010.</p><p>&nbsp;</p><p><strong>Continuity of practice (living tradition)</strong></p><p><strong>﻿</strong></p><p>This craft has been traditionally passed down from mother to daughter, preserving skills and knowledge across generations. Traditionally women practiced this art as a leisure activity.</p>', NULL, NULL),
(20, 'phulkari', 'Product Features', '<p><br></p><p>Phulkari involves surface embroidery using vibrant floss silk (pat silk) thread worked from the wrong side of coarse hand spun khaddar or khadi cloth, creating on the right side. geometric, floral, and figurative patterns. The various product features of Phulkari designs with a focus on materials used, embroidery technique, characteristic motifs and end-use of this craft have been listed below:</p><p><br></p><p class=\"ql-align-justify\"><strong>Material:</strong>&nbsp;</p><p class=\"ql-align-justify\"><br></p><ul><li class=\"ql-align-justify\">Traditionally made on handwoven cotton fabric known as&nbsp;<em>khaddar</em>, providing a coarse yet durable base&nbsp;</li><li class=\"ql-align-justify\">The embroidery done using brightly colored silk floss thread called&nbsp;<em>pat</em></li><li class=\"ql-align-justify\">Satin-like finish on the front</li></ul><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><strong>Technique:</strong></p><p class=\"ql-align-justify\"><br></p><ul><li class=\"ql-align-justify\">Hand-embroidered using a distinctive darning stitch&nbsp;</li><li class=\"ql-align-justify\">Embroidery on reverse side of the fabric to create a smooth</li><li class=\"ql-align-justify\">Precise and intricate patterns created without pre-drawn designs</li><li class=\"ql-align-justify\">Final product is characterised by geometric precision and textured appearance</li></ul><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><strong>Motifs:&nbsp;</strong>Vibrant and symbolic motifs inspired by nature and daily life including flowers, leaves, crops, animals, and geometric patterns. The term “phulkari” itself means “flower work,” reflecting the dominance of floral designs. These motifs often carry cultural and emotional meanings, representing prosperity, fertility, and spirituality.</p><p class=\"ql-align-justify\"><br></p><p class=\"ql-align-justify\"><img src=\"assets/images/1776595349_1982.png\"></p><p><br></p>', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int NOT NULL,
  `state_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `textiles`
--

CREATE TABLE `textiles` (
  `id` int NOT NULL,
  `state` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `craft_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institute` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `investigators` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `project_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `history` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `historical_development` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `timeline` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `manufacturing_process` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `manufacturing_steps` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `raw_materials` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `energy_usage` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `unique_features` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `gi_tag` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `geography` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `manpower` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `product_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `key_characteristics` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `recognition` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `significance` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `market` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `transformation` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `challenges` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `textile_images`
--

CREATE TABLE `textile_images` (
  `id` int NOT NULL,
  `textile_id` int DEFAULT NULL,
  `image_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coe_menu`
--
ALTER TABLE `coe_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coe_pages`
--
ALTER TABLE `coe_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_key` (`page_key`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_key` (`product_key`);

--
-- Indexes for table `product_menu`
--
ALTER TABLE `product_menu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_key` (`page_key`);

--
-- Indexes for table `product_pages`
--
ALTER TABLE `product_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_key` (`page_key`,`section`),
  ADD UNIQUE KEY `page_key_2` (`page_key`,`section`),
  ADD UNIQUE KEY `page_key_3` (`page_key`,`section`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `state_name` (`state_name`);

--
-- Indexes for table `textiles`
--
ALTER TABLE `textiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `textile_images`
--
ALTER TABLE `textile_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `textile_id` (`textile_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coe_menu`
--
ALTER TABLE `coe_menu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `coe_pages`
--
ALTER TABLE `coe_pages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_menu`
--
ALTER TABLE `product_menu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_pages`
--
ALTER TABLE `product_pages`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `textiles`
--
ALTER TABLE `textiles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `textile_images`
--
ALTER TABLE `textile_images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
