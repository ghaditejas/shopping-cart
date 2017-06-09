-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 09, 2017 at 12:07 PM
-- Server version: 5.5.50-0ubuntu0.14.04.1
-- PHP Version: 5.6.23-1+deprecated+dontuse+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shopping_cart`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_category`(IN `category_name` VARCHAR(50), IN `cat_status` TINYINT(1), IN `cat_parent_id` INT(11), IN `cat_created_on` DATE, IN `cat_created_by` INT(11))
begin
Insert into category (name,status,parent_id,created_on,created_by) values
(category_name,cat_status,cat_parent_id,cat_created_on,cat_created_by);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_product`(IN `p_name` VARCHAR(250), IN `p_sku` VARCHAR(250), IN `p_short_description` VARCHAR(250), IN `p_long_description` VARCHAR(250), IN `p_price` FLOAT(11,2), IN `p_status` TINYINT(1), IN `p_quantity` INT(11), IN `p_meta_title` VARCHAR(250), IN `p_meta_description` VARCHAR(250), IN `p_meta_keywords` VARCHAR(250), IN `p_is_featured` TINYINT(1), IN `p_created_on` DATE, IN `p_created_by` INT(11), IN `p_special_price` FLOAT(11,2), IN `p_special_price_from` DATE, IN `special_price_to` DATE, OUT `product_id` INT(11))
    COMMENT 'ADD PRODUCT'
Begin
Insert into product (name,sku,short_description,long_description,price,status,quantity,meta_title,meta_description,meta_keywords,is_featured,created_on,created_by,special_price,special_price_from,special_price_to) values (p_name,p_sku,p_short_description,p_long_description,p_price,p_status,p_quantity,p_meta_title,p_meta_description,p_meta_keywords,p_is_featured,p_created_on,p_created_by,p_special_price,p_special_price_from,special_price_to);
SET product_id = LAST_INSERT_ID();
End$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_category`(IN `cat_name` VARCHAR(50), IN `cat_status` TINYINT(1), IN `cat_parent_id` INT(11), IN `cat_modified_by` INT(11), IN `cat_id` INT(11))
begin
Update category set name=cat_name,status=cat_status,parent_id=cat_parent_id,modified_by=cat_modified_by where category_id=cat_id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_product`(IN `p_name` VARCHAR(250), IN `p_sku` VARCHAR(250), IN `p_short_description` VARCHAR(250), IN `p_long_description` VARCHAR(250), IN `p_price` FLOAT(11,2), IN `p_status` TINYINT(1), IN `p_quantity` INT(11), IN `p_meta_title` VARCHAR(250), IN `p_meta_description` VARCHAR(250), IN `p_meta_keywords` VARCHAR(250), IN `p_is_featured` TINYINT(1), IN `p_modified_by` INT(11), IN `p_special_price` FLOAT(11,2), IN `p_special_price_from` DATE, IN `special_price_to` DATE, IN `product_id` INT(11))
    COMMENT 'UPDATE PRODUCT'
Begin
Update product set `name` = p_name,`sku` = p_sku,`short_description` = p_short_description,`long_description`  = p_long_description,`price`  = p_price,`status`  = p_status,`quantity`  = p_quantity,`meta_title`  = p_meta_title,`meta_description`  = p_meta_description,`meta_keywords`  = p_meta_keywords,`is_featured`  = p_is_featured,`modified_by`  = p_modified_by,`special_price`  = p_special_price,`special_price_from`  = p_special_price_from,`special_price_to`  = special_price_to WHERE `id` = product_id;
End$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE IF NOT EXISTS `banners` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_path` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1- active0 - InactiveOnly active banners will get visible on fron end',
  `created_on` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`banner_id`, `banner_path`, `status`, `created_on`, `created_by`, `modified_on`, `modified_by`) VALUES
(1, 'product1495426674.jpg', 1, '2017-05-05', 1, '2017-05-05 08:47:02', 1),
(2, 'product1495426685.jpg', 1, '2017-05-05', 1, '2017-05-05 10:50:45', 1),
(3, 'product1495426699.jpg', 1, '2017-05-05', 1, '2017-05-05 10:51:02', 1),
(4, 'product1495426710.jpg', 1, '2017-05-08', 1, '2017-05-08 06:13:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `parent_id` int(10) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`, `parent_id`, `created_by`, `created_on`, `modified_by`, `modified_on`, `status`) VALUES
(1, 'Mobiles', 0, 1, '2017-05-09', 1, '2017-05-09 08:00:07', 1),
(2, 'Samsung', 1, 1, '2017-05-09', 1, '2017-05-09 08:18:45', 1),
(3, 'Books', 0, 1, '2017-05-09', NULL, '2017-05-09 08:19:11', 1),
(4, 'Fictional', 3, 1, '2017-05-09', NULL, '2017-05-09 08:26:30', 1),
(5, 'Nokia', 1, 1, '2017-05-09', 1, '2017-05-09 10:06:17', 1),
(6, 'Motorola', 1, 1, '2017-05-09', 1, '2017-05-09 10:07:11', 1),
(7, 'Apple', 1, 1, '2017-05-09', 1, '2017-05-09 10:07:59', 1),
(8, 'Micromax', 1, 1, '2017-05-09', 1, '2017-05-09 10:08:36', 1),
(9, 'Oppo', 1, 1, '2017-05-09', 1, '2017-05-09 10:08:48', 1),
(10, 'Panasonic', 1, 1, '2017-05-09', 1, '2017-05-09 10:11:48', 1),
(11, 'Literature', 3, 1, '2017-05-09', NULL, '2017-05-09 10:14:02', 1),
(12, 'Classic', 3, 1, '2017-05-09', 1, '2017-05-09 10:14:31', 1),
(13, 'CLOTHINGS', 0, 1, '2017-05-23', 1, '2017-05-23 06:16:09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE IF NOT EXISTS `cms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `meta_title` text,
  `meta_description` text,
  `meta_keywords` text,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `slug` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `title`, `content`, `meta_title`, `meta_description`, `meta_keywords`, `created_by`, `created_on`, `modified_by`, `modified_on`, `slug`) VALUES
(1, 'Terms and Conditions', '<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Last updated: May 2013</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Terms and Conditions of Use</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The following terms and conditions (the &ldquo;Terms and Conditions&rdquo;) govern your use of this Web Site, and any content made available from or through this Web Site, including any subdomains thereof (the &ldquo;Web Site&rdquo;). The Web Site is made available by Variety Media, LLC (&ldquo;Variety&rdquo;). We may change the Terms and Conditions from time to time, at any time without notice to you, by posting such changes on the Web Site. BY USING THE WEB SITE, YOU ACCEPT AND AGREE TO THESE TERMS AND CONDITIONS AS APPLIED TO YOUR USE OF THE WEB SITE. If you do not agree to these Terms and Conditions, you may not access or otherwise use the Web Site.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Proprietary Rights.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>As between you and Variety owns, solely and exclusively, all rights, title and interest in and to the Web Site, all the content (including, for example, audio, photographs, illustrations, graphics, other visuals, video, copy, text, software, titles, Shockwave files, etc.), code, data and materials thereon, the look and feel, design and organization of the Web Site, and the compilation of the content, code, data and materials on the Web Site, including but not limited to any copyrights, trademark rights, patent rights, database rights, moral rights, sui generis rights and other intellectual property and proprietary rights therein. Your use of the Web Site does not grant to you ownership of any content, code, data or materials you may access on or through the Web Site.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Limited License.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>You may access and view the content on the Web Site on your computer or other device and, unless otherwise indicated in these Terms and Conditions or on the Web Site, make single copies or prints of the content on the Web Site for your personal, internal use only. Use of the Web Site and the services offered on or through the Web Site, are only for your personal, non-commercial use.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>RSS Feeds.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>RSS (really simple syndication) service is a means by which Variety.com offers feeds of story headlines in XML format (&ldquo;RSS Content&rdquo;) to visitors to Variety.com (the &ldquo;Variety Site&rdquo;) who use RSS aggregators. These Terms of Use govern your use of the RSS service. The use of the RSS service also is subject to the terms and conditions of the&nbsp;Variety Service Agreement, which governs the use of Variety&rsquo;s websites, information services and content. These Terms of Use and the Variety Interactive Service Agreement may be changed by Variety at any time without notice.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Use of RSS Feeds:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>RSS is a free service offered by Variety for non-commercial use. Any other uses, including without limitation the incorporation of advertising into or the placement of advertising associated with or targeted towards the RSS Content, are strictly prohibited. You must use the RSS feeds as provided by Variety, and you may not edit or modify the text, content or links supplied by Variety. For web posting, reprint, transcript or licensing requests for Variety material, please send your request to&nbsp;<a href="mailto:licensing@variety.com" target="_blank">licensing@variety.com</a>.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Link to Content Pages:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The RSS service may be used only with those platforms from which a functional link is made available that, when accessed, takes the viewer directly to the display of the full article on the Variety Site. You may not display the RSS Content in a manner that does not permit successful linking to, redirection to or delivery of the applicable Variety Site web page. You may not insert any intermediate page, splash page or other content between the RSS link and the applicable Variety Site web page.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Ownership/Attribution:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Variety retains all ownership and other rights in the RSS Content, and any and all Variety logos and trademarks used in connection with the RSS Service. You must provide attribution to the appropriate Variety website in connection with your use of the RSS feeds. If you provide this attribution using a graphic, you must use the appropriate Variety website&rsquo;s logo that we have incorporated into the RSS feed.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Right to Discontinue Feeds:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Variety reserves the right to discontinue providing any or all of the RSS feeds at any time and to require you to cease displaying, distributing or otherwise using any or all of the RSS feeds for any reason including, without limitation, your violation of any provision of these Terms of Use. Variety assumes no liability for any of your activities in connection with the RSS feeds or for your use of the RSS feeds in connection with your website.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Prohibited Use.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Any commercial or promotional distribution, publishing or exploitation of the Web Site, or any content, code, data or materials on the Web Site, is strictly prohibited unless you have received the express prior written permission from authorized personnel of Varietyor the otherwise applicable rights holder. Other than as expressly allowed herein, you may not download, post, display, publish, copy, reproduce, distribute, transmit, modify, perform, broadcast, transfer, create derivative works from, sell or otherwise exploit any content, code, data or materials on or available through the Web Site. You further agree that you may not alter, edit, delete, remove, otherwise change the meaning or appearance of, or repurpose, any of the content, code, data, or other materials on or available through the Web Site, including, without limitation, the alteration or removal of any trademarks, trade names, logos, service marks, or any other proprietary content or proprietary rights notices. You acknowledge that you do not acquire any ownership rights by downloading any copyrighted material from or through the Web Site. If you make other use of the Web Site, or the content, code, data or materials thereon or available through the Web Site, except as otherwise provided above, you may violate copyright and other laws of the United States, other countries, as well as applicable state laws and may be subject to liability for such unauthorized use.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Trademarks.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The trademarks, logos, service marks and trade names (collectively the &ldquo;Trademarks&rdquo;) displayed on the Web Site or on content available through the Web Site are registered and unregistered Trademarks of Variety. and others and may not be used in connection with products and/or services that are not related to, associated with, or sponsored by their rights holders that are likely to cause customer confusion, or in any manner that disparages or discredits their rights holders. All Trademarks not owned by Variety that appear on the Web Site or on or through the Web Site&rsquo;s services, if any, are the property of their respective owners. Nothing contained on the Web Site should be construed as granting, by implication, or otherwise, any license or right to use any Trademark displayed on the Web Site without the written permission of Variety or the third party that may own the applicabl Trademark. Your misuse of the Trademarks displayed on the Web Site or on or through any of the Web Site&rsquo;s services is strictly prohibited.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>User Information.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>In the course of your use of the Web Site and/or the services made available on or through the Web Site, you may be asked to provide certain personalized information to us (such information referred to hereinafter as &ldquo;User Information&rdquo;). Variety information collection and use policies with respect to the privacy of such User Information are set forth in the Web Site&rsquo;s Privacy Policy which is incorporated herein by reference for all purposes. You acknowledge and agree that you are solely responsible for the accuracy and content of User Information.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Submitted Materials.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Unless specifically requested, we do not solicit nor do we wish to receive any confidential, secret or proprietary information or other material from you through the Web Site, by e-mail or in any other way. Any information, creative works, demos, ideas, suggestions, concepts, methods, systems, designs, plans, techniques or other materials submitted or sent to us (including, for example and without limitation, that which you submit or post to our chat rooms, message boards, and/or our blogs, or send to us via e-mail) (&ldquo;Submitted Materials&rdquo;) will be deemed not to be confidential or secret, and may be used by us in any manner consistent with the Web Site&rsquo;s Privacy Policy. By submitting or sending Submitted Materials to us, you: (i) represent and warrant that the Submitted Materials are original to you, that no other party has any rights thereto, and that any &ldquo;moral rights&rdquo; in Submitted Materials have been waived, and (ii) you grant us and our affiliates a royalty-free, unrestricted, worldwide, perpetual, irrevocable, non-exclusive and fully transferable, assignable and sublicensable right and license to use, copy, reproduce, modify, adapt, publish, translate, create derivative works from, distribute, perform, display and incorporate in other works any Submitted Materials (in whole or part) in any form, media, or technology now known or later developed, including for promotional and/or commercial purposes. We cannot be responsible for maintaining any Submitted Material that you provide to us, and we may delete or destroy any such Submitted Material at any time.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Prohibited User Conduct.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>You warrant and agree that, while using the Web Site and the various services and features offered on or through the Web Site, you shall not: (a) impersonate any person or entity or misrepresent your affiliation with any other person or entity; (b) insert your own or a third party&rsquo;s advertising, branding or other promotional content into any of the Web Site&rsquo;s content, materials or services (for example, without limitation, in an RSS feed or a podcast received from Variety or otherwise through the Web Site), or use, redistribute, republish or exploit such content or service for any further commercial or promotional purposes; or &copy; attempt to gain unauthorized access to other computer systems through the Web Site. You shall not: (i) engage in spidering, &ldquo;screen scraping,&rdquo; &ldquo;database scraping,&rdquo; harvesting of e-mail addresses, wireless addresses or other contact or personal information, or any other automatic means of obtaining lists of users or other information from or through the Web Site or the services offered on or through the Web Site, including without limitation any information residing on any server or database connected to the Web Site or the services offered on or through the Web Site; (ii) obtain or attempt to obtain unauthorized access to computer systems, materials or information through any means; (iii) use the Web Site or the services made available on or through the Web Site in any manner with the intent to interrupt, damage, disable, overburden, or impair the Web Site or such services, including, without limitation, sending mass unsolicited messages or &ldquo;flooding&rdquo; servers with requests; (iv) use the Web Site or the Web Site&rsquo;s services or features in violation of Variety or any third party&rsquo;s intellectual property or other proprietary or legal rights; or (v) use the Web Site or the Web Site&rsquo;s services in violation of any applicable law. You further agree that you shall not attempt (or encourage or support anyone else&rsquo;s attempt) to circumvent, reverse engineer, decrypt, or otherwise alter or interfere with the Web Site or the Web Site&rsquo;s services, or any content thereof, or make any unauthorized use thereof. You agree that you shall not use the Web Site in any manner that could damage, disable, overburden, or impair the Web Site or interfere with any other party&rsquo;s use and enjoyment of the Web Site or any of its services. You shall not obtain or attempt to obtain any materials or information through any means not intentionally made publicly available or provided for through the Web Site.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Public Forums.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Variety may, from time to time, make messaging services, chat services, bulletin boards, message boards, blogs, other forums and other such services available on or through the Web Site. In addition to any other rules or regulations that we may post in connection with a particular service, you agree that you shall not upload, post, transmit, distribute or otherwise publish through the Web Site or any service or feature made available on or through the Web Site, any materials which (i) restrict or inhibit any other user from using and enjoying the Web Site or the Web Site&rsquo;s services, (ii) are fraudulent, unlawful, threatening, abusive, harassing, libelous, defamatory, obscene, vulgar, offensive, pornographic, profane, sexually explicit or indecent, (iii) constitute or encourage conduct that would constitute a criminal offense, give rise to civil liability or otherwise violate any local, state, national or international law, (iv) violate, plagiarize or infringe the rights of third parties including, without limitation, copyright, trademark, trade secret, confidentiality, contract, patent, rights of privacy or publicity or any other proprietary right, (v) contain a virus, spyware, or other harmful component, (vi) contain embedded links, advertising, chain letters or pyramid schemes of any kind, or (vii) constitute or contain false or misleading indications of origin, endorsement or statements of fact. You further agree not to impersonate any other person or entity, whether actual or fictitious, including anyone from Variety. You also may not offer to buy or sell any product or service on or through your comments submitted to our forums. You alone are responsible for the content and consequences of any of your activities.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Right to Monitor and Editorial Control.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Variety reserves the right, but does not have an obligation, to monitor and/or review all materials posted to the Web Site or through the Web Site&rsquo;s services or features by users, and Variety is not responsible for any such materials posted by users. However, Variety reserves the right at all times to disclose any information as necessary to satisfy any law, regulation or government request, or to edit, refuse to post or to remove any information or materials, in whole or in part, that in Variety&rsquo;s sole discretion are objectionable or in violation of this Terms of Use, Variety&rsquo;s policies or applicable law. We may also impose limits on certain features of the forums or restrict your access to part or all of the forums without notice or penalty if we believe you are in breach of the guidelines set forth in this paragraph, our terms and conditions or applicable law, or for any other reason without notice or liability.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Private or Sensitive Information on Public Forums.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>It is important to remember that comments submitted to a forum may be recorded and stored in multiple places, both on our Web Site and elsewhere on the Internet, which are likely to be accessible for a long time and you have no control over who will read them eventually. It is therefore important that you are careful and selective about the personal information that you disclose about yourself and others, and in particular, you should not disclose sensitive, embarrassing, proprietary or confidential information in your comments to our public forums.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Linking to the Web Site.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>You agree that if you include a link from any other web site to the Web Site, such link shall open in a new browser window and shall link to the full version of an HTML formatted page of this Web Site. You are not permitted to link directly to any image hosted on the Web Site or our services, such as using an &ldquo;in-line&rdquo; linking method to cause the image hosted by us to be displayed on another web site. You agree not to download or use images hosted on this Web Site on another web site, for any purpose, including, without limitation, posting such images on another site. You agree not to link from any other web site to this Web Site in any manner such that the Web Site, or any page of the Web Site, is &ldquo;framed,&rdquo; surrounded or obfuscated by any third party content, materials or branding. We reserve all of our rights under the law to insist that any link to the Web Site be discontinued, and to revoke your right to link to the Web Site from any other web site at any time upon written notice to you.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Indemnification.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>You agree to defend, indemnify and hold Variety and Variety&rsquo;s and its affiliates&rsquo; directors, officers, employees and agents harmless from any and all claims, liabilities, costs and expenses, including attorneys&rsquo; fees, arising in any way from your use of the Web Site, your placement or transmission of any message, content, information, software or other materials through the Web Site, or your breach or violation of the law or of these Terms and Conditions. Variety reserves the right, at its own expense, to assume the exclusive defense and control of any matter otherwise subject to indemnification by you, and in such case, you agree to cooperate with Variety&rsquo;s defense of such claim.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Orders for Products and Services.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>We may make certain products available to visitors and registrants of the Web Site. If you order any products, you hereby represent and warrant that you are 18 years old or older. You agree to pay in full the prices for any purchases you make either by credit/debit card concurrent with your online order or by other payment means acceptable to Variety. You agree to pay all applicable taxes. If payment is not received by us from your credit or debit card issuer or its agents, you agree to pay all amounts due upon demand by us. Certain products that you purchase and/or download on or through the Web Site may be subject to additional terms and conditions presented to you at the time of such purchase or download.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Third Party Web Sites.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>You may be able to link from the Web Site to third party web sites and third party web sites may link to the Web Site (&ldquo;Linked Sites&rdquo;). You acknowledge and agree that we have no responsibility for the information, content, products, services, advertising, code or other materials which may or may not be provided by or through Linked Sites, even if they are owned or run by affiliates of ours. Links to Linked Sites do not constitute an endorsement or sponsorship by us of such web sites or the information, content, products, services, advertising, code or other materials presented on or through such web sites. The inclusion of any link to such sites on our Site does not imply Variety&rsquo;s endorsement, sponsorship, or recommendation of that site. Variety disclaims any liability for links (1) from another web site to this Web Site and (2) to another web site from this Web Site. Variety cannot guarantee the standards of any web site to which links are provided on this Web Site nor shall Variety be held responsible for the contents of such sites, or any subsequent links. Variety does not represent or warrant that the contents of any third party web site is accurate, compliant with state or federal law, or compliant with copyright or other intellectual property laws. Also, Variety is not responsible for or any form of transmission received from any linked web site. Any reliance on the contents of a third party web site is done at your own risk and you assume all responsibilities and consequences resulting from such reliance.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Advertisements and Promotions</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Variety may run advertisements and promotions from third parties on the Site. Your business dealings or correspondence with, or participation in promotions of, advertisers other than Variety, and any terms, conditions, warranties or representations associated with such dealings, are solely between you and such third party. Variety is not responsible or liable for any loss or damage of any sort incurred as the result of any such dealings or as the result of the presence of third-party advertisers on the Site.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Copyright Agent.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>We respect the intellectual property rights of others, and require that the people who use the Web Site, or the services or features made available on or through the Web Site, do the same. If you believe that your work has been copied in a way that constitutes copyright infringement, please forward the following information to Variety&rsquo;s Copyright Agent, designated as such pursuant to the Digital Millennium Copyright Act, 17 U.S.C. &sect; 512&copy;(2), named below:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul><br />\r\n	<li>Your address, telephone number, and email address;</li>\r\n	<br />\r\n	<li>A description of the copyrighted work that you claim has been infringed;</li>\r\n	<br />\r\n	<li>A description of where the alleged infringing material is located;</li>\r\n	<br />\r\n	<li>A statement by you that you have a good faith belief that the disputed use is not authorized by the copyright owner, its agent, or the law;</li>\r\n	<br />\r\n	<li>An electronic or physical signature of the person authorized to act on behalf of the owner of the copyright interest; and</li>\r\n	<br />\r\n	<li>A statement by you, made under penalty of perjury, that the above information in your notice is accurate and that you are the copyright owner or are authorized to act on the copyright owner&rsquo;s behalf.</li>\r\n	<br />\r\n	<br />\r\n	&nbsp;\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>DISCLAIMER OF WARRANTIES.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>THE WEB SITE, INCLUDING, WITHOUT LIMITATION, ALL SERVICES, CONTENT, FUNCTIONS AND MATERIALS PROVIDED THROUGH THE WEB SITE, ARE PROVIDED &ldquo;AS IS,&rdquo; &ldquo;AS AVAILABLE,&rdquo; WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESS OR IMPLIED, INCLUDING, WITHOUT LIMITATION, ANY WARRANTY FOR INFORMATION, DATA, DATA PROCESSING SERVICES, UPTIME OR UNINTERRUPTED ACCESS, ANY WARRANTIES CONCERNING THE AVAILABILITY, PLAYABILITY, DISPLAYABILITY, ACCURACY, PRECISION, CORRECTNESS, THOROUGHNESS, COMPLETENESS, USEFULNESS, OR CONTENT OF INFORMATION, AND ANY WARRANTIES OF TITLE, NON-INFRINGEMENT, MERCHANTABILITY OR FITNESS FOR A PARTICULAR PURPOSE, AND WE HEREBY DISCLAIM ANY AND ALL SUCH WARRANTIES, EXPRESS AND IMPLIED. WE DO NOT WARRANT THAT THE WEB SITE OR THE SERVICES, CONTENT, FUNCTIONS OR MATERIALS PROVIDED THROUGH THE WEB SITE WILL BE TIMELY, SECURE, UNINTERRUPTED OR ERROR FREE, OR THAT DEFECTS WILL BE CORRECTED. WE MAKE NO WARRANTY THAT THE WEB SITE OR THE PROVIDED SERVICES WILL MEET USERS&rsquo; REQUIREMENTS. NO ADVICE, RESULTS OR INFORMATION, WHETHER ORAL OR WRITTEN, OBTAINED BY YOU FROM US OR THROUGH THE WEB SITE SHALL CREATE ANY WARRANTY NOT EXPRESSLY MADE HEREIN. Variety ALSO ASSUMES NO RESPONSIBILITY, AND SHALL NOT BE LIABLE FOR, ANY DAMAGES TO, OR VIRUSES THAT MAY INFECT, YOUR EQUIPMENT ON ACCOUNT OF YOUR ACCESS TO, USE OF, OR BROWSING IN THE WEB SITE OR YOUR DOWNLOADING OF ANY MATERIALS, DATA, TEXT, IMAGES, VIDEO CONTENT, OR AUDIO CONTENT FROM THE WEB SITE. IF YOU ARE DISSATISFIED WITH THE WEB SITE, YOUR SOLE REMEDY IS TO DISCONTINUE USING THE WEB SITE. WE TRY TO ENSURE THAT THE INFORMATION POSTED ON THE WEB SITE IS CORRECT AND UP-TO-DATE. WE RESERVE THE RIGHT TO CHANGE OR MAKE CORRECTIONS TO ANY OF THE INFORMATION PROVIDED ON THE WEB SITE AT ANY TIME AND WITHOUT ANY PRIOR WARNING. Variety NEITHER ENDORSES NOR IS RESPONSIBLE FOR THE ACCURACY OR RELIABILITY OF ANY OPINION, ADVICE OR STATEMENT ON THE WEB SITE, NOR FOR ANY OFFENSIVE, DEFAMATORY, OBSCENE, INDECENT, UNLAWFUL OR INFRINGING POSTING MADE THEREON BY ANYONE OTHER THAN AUTHORIZED Variety EMPLOYEE SPOKESPERSONS WHILE ACTING IN THEIR OFFICIAL CAPACITIES (INCLUDING, WITHOUT LIMITATION, OTHER USERS OF THE WEB SITE). IT IS YOUR RESPONSIBILITY TO EVALUATE THE ACCURACY, COMPLETENESS OR USEFULNESS OF ANY INFORMATION, OPINION, ADVICE OR OTHER CONTENT AVAILABLE THROUGH THE WEB SITE. PLEASE SEEK THE ADVICE OF PROFESSIONALS, AS APPROPRIATE, REGARDING THE EVALUATION OF ANY SPECIFIC INFORMATION, OPINION, ADVICE OR OTHER CONTENT, INCLUDING BUT NOT LIMITED TO FINANCIAL, HEALTH, OR LIFESTYLE INFORMATION, OPINION, ADVICE OR OTHER CONTENT. PRIOR TO THE EXECUTION OF A PURCHASE OR SALE OF ANY SECURITY OR INVESTMENT, YOU ARE ADVISED TO CONSULT WITH YOUR BROKER OR OTHER FINANCIAL ADVISOR TO VERIFY PRICING AND OTHER INFORMATION. WE SHALL HAVE NO LIABILITY FOR INVESTMENT DECISIONS BASED UPON, OR THE RESULTS OBTAINED FROM, THE CONTENT PROVIDED HEREIN. NOTHING CONTAINED IN THE WEB SITE SHALL BE CONSTRUED AS INVESTMENT ADVICE. Variety IS NOT A REGISTERED BROKER-DEALER OR INVESTMENT ADVISOR AND DOES NOT GIVE INVESTMENT ADVICE OR RECOMMEND ONE PRODUCT OVER ANOTHER. WITHOUT LIMITATION OF THE ABOVE IN THIS SECTION, Variety AND ITS AFFILIATES, SUPPLIERS AND LICENSORS MAKE NO WARRANTIES OR REPRESENTATIONS REGARDING ANY PRODUCTS OR SERVICES ORDERED OR PROVIDED VIA THE WEB SITE, AND HEREBY DISCLAIM, AND YOU HEREBY WAIVE, ANY AND ALL WARRANTIES AND REPRESENTATIONS MADE IN PRODUCT OR SERVICES LITERATURE, FREQUENTLY ASKED QUESTIONS DOCUMENTS AND OTHERWISE ON THE WEB SITE OR IN CORRESPONDENCE WITH Variety OR ITS AGENTS. ANY PRODUCTS AND SERVICES ORDERED OR PROVIDED VIA THE WEB SITE ARE PROVIDED BY Variety&ldquo;AS IS,&rdquo; EXCEPT TO THE EXTENT, IF AT ALL, OTHERWISE SET FORTH IN A LICENSE OR SALE AGREEMENT SEPARATELY ENTERED INTO IN WRITING BETWEEN YOU AND Variety OR ITS LICENSOR OR SUPPLIER.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>LIMITATION OF LIABILITY.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>IN NO EVENT, INCLUDING BUT NOT LIMITED TO NEGLIGENCE, SHALL Variety, OR ANY OF ITS DIRECTORS, OFFICERS, EMPLOYEES, AGENTS OR CONTENT OR SERVICE PROVIDERS (COLLECTIVELY, THE &ldquo;PROTECTED ENTITIES&rdquo;) BE LIABLE FOR ANY DIRECT, INDIRECT, SPECIAL, INCIDENTAL, CONSEQUENTIAL, EXEMPLARY OR PUNITIVE DAMAGES ARISING FROM, OR DIRECTLY OR INDIRECTLY RELATED TO, THE USE OF, OR THE INABILITY TO USE, THE WEB SITE OR THE CONTENT, MATERIALS AND FUNCTIONS RELATED THERETO, YOUR PROVISION OF INFORMATION VIA THE WEB SITE, LOST BUSINESS OR LOST SALES, EVEN IF SUCH PROTECTED ENTITY HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES. SOME JURISDICTIONS DO NOT ALLOW THE LIMITATION OR EXCLUSION OF LIABILITY FOR INCIDENTAL OR CONSEQUENTIAL DAMAGES SO SOME OF THE ABOVE LIMITATIONS MAY NOT APPLY TO CERTAIN USERS. IN NO EVENT SHALL THE PROTECTED ENTITIES BE LIABLE FOR OR IN CONNECTION WITH ANY CONTENT POSTED, TRANSMITTED, EXCHANGED OR RECEIVED BY OR ON BEHALF OF ANY USER OR OTHER PERSON ON OR THROUGH THE WEB SITE. IN NO EVENT SHALL THE TOTAL AGGREGATE LIABILITY OF THE PROTECTED ENTITIES TO YOU FOR ALL DAMAGES, LOSSES, AND CAUSES OF ACTION (WHETHER IN CONTRACT OR TORT, INCLUDING, BUT NOT LIMITED TO, NEGLIGENCE OR OTHERWISE) ARISING FROM THE TERMS AND CONDITIONS OR YOUR USE OF THE WEB SITE EXCEED, IN THE AGGREGATE, THE AMOUNT, IF ANY, PAID BY YOU TO Variety FOR YOUR USE OF THE WEB SITE OR PURCHASE OF PRODUCTS VIA THE WEB SITE.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Photosensitive Seizures.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>A very small percentage of people may experience a seizure when exposed to certain visual images, such as flashing lights or patterns that may appear in video games or other electronic or online content. Even people who have no history of seizures or epilepsy may have an undiagnosed condition that can cause these &ldquo;photosensitive epileptic seizures&rdquo; while watching video games or other electronic content. These seizures have a variety of symptoms, including lightheadedness, disorientation, confusion, momentary loss of awareness, eye or face twitching, altered vision or jerking or shaking of arms or legs. If you experience any of the foregoing symptoms, or if you or your family has a history of seizures or epilepsy, you should immediately stop using the Web Site and consult a doctor.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Applicable Laws.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>We control and operate the Web Site from our offices in the United States of America. We do not represent that materials on the Web Site are appropriate or available for use in other locations. Persons who choose to access the Web Site from other locations do so on their own initiative, and are responsible for compliance with local laws, if and to the extent local laws are applicable. All parties to these terms and conditions waive their respective rights to a trial by jury.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Termination.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Variety may terminate, change, suspend or discontinue any aspect of the Web Site or the Web Site&rsquo;s services at any time. Variety may restrict, suspend or terminate your access to the Web Site and/or its services if we believe you are in breach of our terms and conditions or applicable law, or for any other reason without notice or liability. Variety maintains a policy that provides for the termination in appropriate circumstances of the Web Site use privileges of users who are repeat infringers of intellectual property rights.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Changes to Terms of Use.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Variety reserves the right, at its sole discretion, to change, modify, add or remove any portion of the Terms and Conditions, in whole or in part, at any time. Changes in the Terms and Conditions will be effective when posted. Your continued use of the Web Site and/or the services made available on or through the Web Site after any changes to the Terms and Conditions are posted will be considered acceptance of those changes.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Miscellaneous.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The Terms and Conditions, and the relationship between you and us, shall be governed by the laws of the State of California, United States of America, without regard to conflict of law provisions. You agree that any cause of action that may arise under the Terms and Conditions shall be commenced and be heard in the appropriate court in the State of California, County of Los Angeles, United States of America. You agree to submit to the personal and exclusive jurisdiction of the courts located within Los Angeles County in the State of California. Our failure to exercise or enforce any right or provision of the Terms and Conditions shall not constitute a waiver of such right or provision. If any provision of the Terms and Conditions is found by a court of competent jurisdiction to be invalid, the parties nevertheless agree that the court should endeavor to give effect to the parties&rsquo; intentions as reflected in the provision, and the other provisions of the Terms and Conditions remain in full force and effect.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Supplemental Terms.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Getty Images Notice: Getty Images still images and visual representations may not be republished, retransmitted, reproduced, downloaded or otherwise used, except for downloading for personal, non-commercial use.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'Terms and Conditions', 'Terms and Conditions', 'Terms and Conditions', 1, '2017-06-06', 1, '2017-06-06 06:37:51', 'terms_and_conditions');
INSERT INTO `cms` (`id`, `title`, `content`, `meta_title`, `meta_description`, `meta_keywords`, `created_by`, `created_on`, `modified_by`, `modified_on`, `slug`) VALUES
(2, 'Privacy Policy', '<p>&nbsp;</p>\r\n\r\n<p><br />\r\n&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;</p>\r\n\r\n<p><strong>PRIVACY POLICY</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>1. Introduction.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>(a) This privacy policy (<strong>&ldquo;Privacy Policy&rdquo;</strong>) explains how Penske Media Corporation and its subsidiaries (collectively, &ldquo;<strong>PMC</strong>&ldquo;, &ldquo;we&rdquo; and &ldquo;us&rdquo;), treat the information that is collected when you visit the websites, mobile-optimized version of our websites, and digital applications to which this policy is linked (collectively, &ldquo;<strong>Websites</strong>&ldquo;). The term &ldquo;Websites&rdquo; includes all subdomains of Websites and any content, code, data, services, features or functionality made available from or through the Websites. It explains the types of information we collect regarding users of the Websites and how we may use that information so you can make an informed decision about whether to view the content and/or use the services on the Websites. This Privacy Policy applies to information we collect via the Websites however accessed and/or used, whether via personal computers, mobile devices or otherwise (&ldquo;<strong>Device</strong>&rdquo;). This Privacy Policy is incorporated into and subject to the Websites&rsquo; Terms of Use. Each time that you access or use the Websites, you agree that you have read, understand and agree to be bound by the Terms of Use and the Privacy Policy and you expressly consent to the collection, use and disclosure of your information, including without limitation, Personally Identifiable Information in accordance with this Privacy Policy. For the purposes of this Privacy Policy, &ldquo;<strong>Personally Identifiable Information</strong>&rdquo; or &ldquo;<strong>PII</strong>&rdquo; is information that we can use to identify or contact you as an individual, and includes your name, email address, address, telephone number and any other information that we associate with any of the foregoing.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>If you do not agree to the Terms of Use and this Privacy Policy, you must discontinue using the Websites and all services and features therein.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>(b) We may offer the print and digital magazines, websites and other editorial properties published by PMC (the &ldquo;<strong>Publications</strong>&rdquo;) through certain third party websites via subscription pages on such third party websites that are linked to this Privacy Policy. For the avoidance of doubt, such subscription pages are considered &ldquo;Websites&rdquo; and this Privacy Policy applies to information collected through the subscription pages, but does not apply to information collected through the third party website.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>(c) Except as specified herein, this Privacy Policy does not apply to information you may provide to us offline; however please do be aware that if you subscribe offline to one of the Publications, from time to time we make your postal addresses available to companies for marketing purposes.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>(d) Certain features of the Websites may be subject to additional or different privacy provisions, which will be posted on the Website in connection with such features. All such additional or different privacy provisions are incorporated by reference into this Privacy Policy.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>2. Information That is Collected.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>(a) Information You Provide To Us.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><em><strong>Personal Information.</strong> </em>When you enter a sweepstakes or contest, complete a survey, participate in a reader panel, register for those portions of our Websites that may require registration, register for one of our summits or other events, make a purchase, participate in our social networking features, request back issues of our Publications, subscribe to our Publications, subscribe to receive newsletters, promotional correspondence, or other electronic services, or send us an email or feedback, you may be asked to provide PII such as your e-mail address, name, phone number, shipping address, and billing information, and we (or third party service providers on our behalf) will collect such information as well as any other content you provide us in engaging in any of the above activities. Information such as your age, date of birth, gender, hobbies or interests may also be requested. If you elect to post material to any blogs, forums, participate in our social networking features or other community boards that may be offered on our Websites, then such materials will be collected and some information, including your posted pseudonym, may be publicly available for others to view.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><em><strong>Billing and Credit Card Information.</strong></em> To enable payment for subscriptions to our Publications, our vendors collect and store billing and credit card information. This information may be shared with us, and will only be shared with third parties who perform tasks required to complete the purchase transaction. Examples of this include fulfilling orders and processing credit cards. We also use third party platforms to process payments for some of our events and summits, and these third party platforms may collect and store billing and credit card information. The processing of your billing and credit card information by these third party platforms are subject to their privacy policies. Some of our Websites may accept billing and credit card information by phone or mail to process payments for advertisements and listings. This information will only be used by us to process the authorized payments.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><em><strong>Social Networking Information</strong></em>. You may be given the option to link your account on a third party social networking service with one or more of the Websites. In that case, the authentication of your login credentials are conducted through that third party service provider. When you link your social networking accounts with Websites or engage with Websites through third party social media platforms, you understand that you may be allowing us ongoing access to certain information stored on those social networking media platforms. In addition, as you interact with the Websites, you may also be providing information about your activities to the third party social networking services. You should make sure that you are comfortable with the information your third party social networking services may make available to us by visiting those services&rsquo; privacy policies and/or modifying your privacy settings directly with those services. As noted below, we reserve the right to use, transfer, assign, sell, share and provide access to all information that we receive through these third party social media services in the same ways described in this Privacy Policy. You agree that we shall not be liable for the use by social networking services of any information.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>(b) Information Collected As You Access and Use the Websites</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>In addition to any PII or other information that you choose to submit to us, to provide you with services and content that are more customized to your interests, PMC and our third-party service providers and advertisers may use a variety of technologies (including cookies, Flash cookies, web beacons and embedded scripts) (&ldquo;<strong>Tracking Technologies</strong>&rdquo;) that automatically or passively collect information when you visit or interact with the Websites (the &ldquo;<strong>Usage Information</strong>&rdquo;). This Usage Information may include, without limitation, the browser that you are using, your IP address (&ldquo;<strong>Identifier</strong>&rdquo;), the URL that referred you to our Websites and all of the areas within our Websites that you visit. We may use Usage Information for a variety of purposes.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Usage Information gathered from your use of the Websites may be combined with information from third party sources to identify your location by state and region. More specific Usage Information may be collected for certain Websites (&ldquo;<strong>Geolocation</strong>&rdquo;), as set forth below.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Some of the more common Tracking Technologies used to collect Usage Information include, without limitation, the following:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><em><strong>Cookies and other technologies.</strong></em> (i) A cookie is a small amount of data (often including a unique identifier), that is sent to your browser from a website&rsquo;s computers and stored on your computer&rsquo;s hard drive. Some of our cookies may be local shared objects, also known as Flash cookies. Cookies are stored on users&rsquo; hard drives. We use both &ldquo;session cookies&rdquo; (which expire once you close your web browser) and &ldquo;persistent cookies&rdquo; (which stay on your computer until you delete them). PMC uses cookies to understand site usage and to improve the content and offerings on our Websites and in other media. We may use cookies to control the display of ads, to track usage patterns on the sites, to deliver editorial content, to record requests for subscriptions and to personalize information. Our cookies may contain Personally Identifiable Information in an encrypted format and such cookies may be shared with others to the same extent indicated herein, including in Section 3 below. PMC (or third party service providers on our behalf) may also use cookies to collect aggregate information about web site users on an anonymous basis (&ldquo;<strong>Anonymous Information</strong>&ldquo;). We may share aggregate demographic and usage information with our prospective and actual business partners, advertisers and other third parties for any business purpose.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>(ii) Some of our third party partners (including advertisers and marketing services companies) may set and access cookies and similar Tracking Technologies on your computer as well, or we may do so on their behalf. We do not have control over how these third parties use such cookies and similar technologies or the information derived therefrom, and this Privacy Policy does not cover any use of information that such third parties may have collected from you or the methods used by the third-parties to collect that information.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>(iii) If you don&rsquo;t want cookies to be utilized when you visit our Websites, most Web browsers include an option that allows you to not accept them. However, if you set your browser to refuse cookies, some portions of our Websites may not function efficiently. Flash cookies may regenerate HTTP cookies that you have affirmatively deleted. Deleting, rejecting, disabling or turning off HTTP cookies as described above will not remove flash cookies. We use flash cookies as an alternative method to HTTP cookies for storing information about your web browsing history across unaffiliated domains, unrelated to the delivery of content through the Flash Player or the performance of the Flash Player in delivering such content. You can manage and delete Flash cookies by visiting: <a href="http://kb2.adobe.com/cps/526/52697ee8.html">http://kb2.adobe.com/cps/526/52697ee8.html</a>.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><em><strong>Web Beacons.</strong></em> Small graphic images or other web programming code called web beacons (also known as &ldquo;<strong>clear GIFs</strong>&rdquo; or &ldquo;<strong>pixel tags</strong>&ldquo;) or similar technologies may be included in our web pages and messages. Web beacons or similar technologies may be used for a number of purposes, including, without limitation, to count visitors to the Websites, to monitor how users navigate the Websites, to count how many e-mails that were sent were actually opened or to count how many particular articles or links were actually viewed. A clear gif may enable us to relate your viewing or receipt of a web page or message to other information about you, including your Personally Identifiable Information.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><em><strong>Embedded Scripts.</strong></em> An embedded script is programming code that is designed to collect information about your interactions with the Websites, such as the links you click on. The code is temporarily downloaded onto your computer or other device, is active only while you are connected to the Website, and is deactivated or deleted thereafter.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><em><strong>HTML.</strong></em> HTML, the language some websites are coded in, may be used to store information on your computer or device about your interaction with and use of the Websites. This information may be retrieved by us to help us manage our Websites, such as by giving us information about how our Websites are being used by our visitors, how they can be improved, and to customize them for our users.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Please note the following processes by which we may also collect certain information about you:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><em><strong>IP Address</strong></em>. Your Internet Protocol (&ldquo;<em><strong>IP</strong></em>&ldquo;) address is usually associated with the place from which you enter the Internet, like your Internet Service Provider, your company or your library. Our server may record your IP and also the referring page that linked you to us (e.g., another Web site or a search engine); the pages you visit on our Websites, the web sites you visit after this web site; the ads you see; the ads you click on; other information about the type of web browser, computer, platform, related software and settings you are using; any search terms you have entered on this web site or a referral site; and other web usage activity and data logged by our web servers. We may use your IP address for a variety of purpose, including to help diagnose problems with our servers, gather broad demographic information, and administer our Websites. We may also link this information with your Personally Identifiable Information when we feel that it is necessary to enforce compliance with our subscription or usage rules and policies or terms of service or to protect our Websites, customers or others.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><em><strong>Geolocation Information.</strong></em> For certain of the mobile Websites, we may, and may enable a third party such as an advertiser to, ask you if you wish us to collect your geolocation in order to provide you with information about goods and services within your geographic location. If you agree to have your geolocation collected, we and the third party, as applicable, will maintain information about your geolocation to facilitate your searching or implement other functionality in the Website, such as to serve targeted advertising. In addition, when you have geolocation software running on your mobile phone, computer or other device, we may collect that information as controlled by your privacy settings on those devices. <strong>By using such service, you hereby consent to our collection, use and disclosure of your geolocation information as described.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>(c) Information We Collect From Third Parties.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>We may acquire information from other trusted sources to update or supplement the information that you provided or we collected automatically, such as information to validate or update your address or other demographic information and lifestyle information. We use this information to help us maintain the accuracy of the information we collect, to target our communications so that we can inform you of products, services and offers that may be of interest, and for internal business analysis or other business purposes. We may also acquire information from other sources about your visits over time and across other third party web sites, in order to serve more targeted advertising to you on the Website(s). Those third parties have privacy policies that differ from this Privacy Policy.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>(d) Information You Provide About A Third Party.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>At some Websites and through certain promotions, you can submit information about other people. For example, you might submit a person&rsquo;s name, mailing and/or email address or phone number, to send a gift or electronic greeting card. This information is used to facilitate the communication or provide the service and may otherwise be used as set forth herein. If that person becomes a subscriber to one of more of our Publications, or becomes an attendee or sponsor or speaker at one of more of our events, his/her information will be treated in the same manner as all others in that category. Please be aware that when you use any send-to-a-friend functionality on our Websites, your email address may be included in the communication sent to your friend.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>3. How We Use and Share the Information Collected.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>In addition to the other disclosures described in this Privacy Policy, PMC may (and you authorize us to) share or disclose information collected from and about you on the Websites, including PII, to other companies or individuals in the following situations:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>(a) Provide, Manage and Improve our Services.</strong> PMC uses information we collect from you in part to provide you with the goods and service you have requested (e.g., you indicated you wanted to receive promotional materials directly from a third party partner, or you furnished us information, including PII, with the intent that it be forwarded to a third party for use in connection with a specified service you are electing to participate in, such as an e-commerce partner), to respond to inquiries, to administer the Websites and for other lawful business purposes. We also use the information in connection with advertising and to serve other content, as described below.<br />\r\n<br />\r\nWe may provide access to information, including PII, to certain vendors that are performing services on our behalf, including fulfilling subscriptions to our Publications, managing our email lists and sending email messages on our behalf, processing payments, providing customer support and performing other administrative services, in order to carry out such services (the &ldquo;<strong>Service Provider Use</strong>&rdquo;).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>We also use the information we collect and obtain about you to measure and improve our Websites, to customize certain features of the Websites, to deliver relevant content and to provide you with an enhanced experience based on the type of device you are using.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>(b) Transactional Communications.</strong> We sometimes use the information collected to communicate with you, such as to notify you when you have won one of our contests or sweepstakes or other promotions (a &ldquo;<strong>Promotion</strong>&rdquo;), when we make changes to subscriber agreements, to fulfill a request for you for an email newsletter, or to contact you about your account. If you wish to unsubscribe from our email newsletters, please follow the unsubscribe/opt-out instructions at the bottom of the newsletter.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>(c) Reader Surveys.</strong> We may collect PII from you in connection with voluntary surveys about your readership of our Publications, your household/personal characteristics and your purchase behavior. The information you provide in any audience marketing surveys will only be shared in the aggregate with advertisers and partners unless we notify you otherwise at the time of collection. Any other survey results may be shared with advertiser and partners, at our discretion, unless we notify you otherwise at the time of collection.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>(d) Editorial Use</strong>. In addition, we may use information you provide us through emails, blogs, forums, in response to polls, or through any other user generated submission for editorial purposes, and may use your name and any stories you provide us in articles published in our Publications. If you provide us with personal anecdotes, they may be attributed to you. PMC can edit, rewrite, use, and reuse the content, including your name, likeness, photograph, and biographical information you provide, with or without attribution, including publication in the Publications, and in trade media, and advertising. You hereby consent to this.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>(e) Marketing</strong>. We may combine and use any and all information we collect on you either online or otherwise, including from third parties, for marketing purposes, including sending you promotional emails regarding special offers about our products and services or on behalf of third party marketing partners who we think can offer services and products of interest to you. Unless we expressly notify you otherwise at the time of collection, we also may disclose information, including PII, that we receive from you and from third party sources to third parties whose practices are not covered by this privacy statement (e.g. other marketers, magazine publishers, retailers, participatory databases and non-profit organizations) that want to market products or services to you. If you have received a promotional email and do not want further emails about similar promotions or offers from us or, as applicable, the third party marketing partner, simply follow the unsubscribe instructions that are located at the bottom of those emails.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>(f) Promotions</strong>. By agreeing to participate in a Promotion, you are agreeing to the official rules that govern that Promotion.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>(g) Anonymous Information</strong>. We may create aggregated, anonymized information about you and other users of the Websites from PII by excluding information (such as your name) that make the data personally identifiable to you (as such &ldquo;Anonymous Information&rdquo;). We use this Anonymous Information for any legal purpose and disclose Anonymous Information to third parties in our sole discretion.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>(h) Third Party Contests</strong>. In some cases you may have entered a contest or sweepstakes sponsored by a third party, in which case the information you provide via the contest or sweepstakes may be shared by us with that third party for their use in their discretion, including direct marketing. Some of our contests and sweepstakes will ask you at the time of entry whether you would like to have your personal information shared with the sponsor, in which case we will honor your selection. Other contests will not give you that option and in that event, if you do not want your information to be shared, you should not enter the contest. The privacy policies of such third party companies apply to their use and disclosure of your information that we collect and disclose to such third party companies.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>(i) Affiliates</strong>. We may transfer your information, including PII, to other PMC offices and affiliates for internal management and administrative purposes on our behalf.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>(j) Administrative and Legal Reasons</strong>. Notwithstanding anything herein to the contrary, we may at all times and in any manner access, use, preserve, transfer and disclose your information (including PII), including disclosure to third parties: (i) to satisfy any applicable law, regulation, subpoenas, governmental requests or legal process, or in connection with a legal investigation, if in our good faith opinion such is required or permitted by law; (ii) to protect and/or defend the Websites&rsquo; Terms of Use or other policies applicable to the Websites, their content, services or functionality, including investigation of potential violations thereof; (iii) to protect the safety, rights, property or security of the Websites or any third party (for example, if we are trying to collect money you owe us); and/or (iv) to detect, prevent or otherwise address fraud, security or technical issues. Further, we may use Identifiers and other information to identify users, and may do so in cooperation with third parties such as copyright owners, internet service providers, wireless service providers and/or law enforcement agencies, including disclosing such information to third parties, all in our discretion (the &ldquo;<strong>Legal Use</strong>&rdquo;). Such disclosures may be carried out without notice to you.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>(k) Sales or Transfer of Business or Assets</strong>. In connection with a sale, merger, transfer, exchange, or other disposition (whether of assets, stock, or otherwise, including via bankruptcy) of all or a portion of the business conducted by the Website to which this policy applies, in which case the company will possess the information collected by us and will assume the rights and obligations regarding your information, including PII, as described in this Privacy Policy (the &ldquo;Acquisition Use&rdquo;).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>(l) Social Networks.</strong> As noted, above, if you use your login credentials from a social networking site (e.g., Facebook or Twitter) on a Website, we may receive information from such social networking site in accordance with the terms and conditions (e.g., Terms of Use and privacy policy) of the social networking site. If you elect to share your information with these social networking sites, we will share information with them in accordance with your election. The terms and conditions of these social networking sites will apply to the information we disclose to them.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>(m) Co-Branded Areas.</strong> Some of our Websites may from time to time partner with a retailer or other third party to offer online shopping opportunities, games, services, subscriptions, registration opportunities for our events and summits and other applications on a co-branded or cross-promotional basis (&ldquo;<strong>Co-Branded Areas</strong>&rdquo;). Those transactions on the Co-Branded Areas may take place on a Website, or the site of the third party. In either case, information, including PII, you provide in connection with the transaction may be collected directly by, or shared by PMC with, the third party, as well as with any participating sponsors or advertisers of such Co-Branded Areas. Some of our Websites may offer you the ability to access a third-party site with whom we have a relationship to access both sites through a co-branded registration or password; in that event, your applicable registration information may be collected directly by, or shared by PMC with, the third-party partner. We will notify you at the applicable point of sign up if any such co-branded registration or password practices will be in effect. These third parties will use your information in accordance with their own privacy policy.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>(n) Delivery of Advertising and Other Content.</strong> In addition to ads and content that we serve you directly, PMC may use third party advertising companies and marketing services to serve ads and other content when you visit the Websites and elsewhere on the internet and in other media. We also use analytics services supported by third party companies to perform analytics and track trends. We work with other third parties to provide certain functionalities on the Websites and to improve the effectiveness of the Websites and its content. Those third party companies may use Tracking Technologies to collect and store Usage Information about you and may combine this information with information they collect from other sources. If you access the Websites through a mobile device or app, we may also share your information with mobile carriers, operating systems and platforms.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>To provide ads on the Websites, we use a variety of third party advertising service providers, including networks, data exchanges, ad servers, analytics providers and others. These third parties may use technology to send, directly to your Device, the advertisements and links that appear on the Websites. They automatically receive your Identifier when this happens. The third party service providers, as well as the advertisers themselves, may collect and use information about your visits over time and across the Websites and other third party web sites, as well as information received from other sources, in order to serve more targeted advertising to you on the Websites. Third parties may also use information gathered from your usage of the Websites to serve targeted advertisements to you on third party websites and applications. Google is one of the companies that we use to serve advertising and perform analytics on some of the Websites. We and third party vendors, including Google, use first-party cookies (such as the Google Analytics cookie) and third-party cookies (such as the DoubleClick cookie) together to help implement the above uses of your information. We also use Google Analytics along with audience data (such as age, gender and interests of users) to help understand users&rsquo; visits to the Websites and to optimize the content that we serve to users.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>To learn about Google Analytics&rsquo; currently available opt-outs for the Web, click<a href="https://support.google.com/analytics/answer/181881?hl=en"> https://support.google.com/analytics/answer/181881?hl=en</a>. To learn more about how Google uses cookies in advertising, you can visit <a href="https://www.google.com/policies/technologies/ads/">https://www.google.com/policies/technologies/ads/</a> . You can opt out of receiving interest-based Google Ads, or customize the Ads Google shows you, by clicking <a href="https://support.google.com/ads/answer/2662922?hl=en">https://support.google.com/ads/answer/2662922?hl=en</a>.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>We do not control Tracking Technologies used by third parties, and their use may be governed by the privacy policies of the third parties employing the Tracking Technologies. You should consult the respective privacy policies of these third parties to see your options for opting out of their use of such devices.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Some of the advertising service providers may be members of the Network Advertising Initiative, which offers a single location to opt out of ad targeting from member companies. If you opt-out of receiving targeted ads in this manner, you will continue to receive advertising messages after you opt-out, but they will not be customized to you based on your use of the Websites and/or third party websites. If you would like more information about advertisers&rsquo; use of tracking technologies and about your option not to accept these cookies, you can go to <a href="http://www.networkadvertising.org">http://www.networkadvertising.org</a>. If you would like to learn more about how interest-based information is collected, whether the companies we use are part of an industry network regarding behavioral advertising and to know your choices about not having information used in this manner, you can go to <a href="http://www.aboutads.info">http://www.aboutads.info</a>. The collection of information via certain ads served to users in Canada may be managed by visiting <a href="http://www.youradchoices.ca">youradchoices.ca</a>. Please note that the-opt out is cookie-based and will only affect the specific computer and browser on which the opt-out is applied.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>(o) Tracking Requests.</strong> Some web browsers provide &ldquo;do not track&rdquo; machine readable signals for websites which are automatically applied by default and therefore do not necessarily reflect our visitor&rsquo;s choice as to whether they wish to receive advertisements tailored to their interests. PMC does not act on &ldquo;do not track&rdquo; requests from your browser because, this way, we are able to personalize your experiences on our Websites. For more information, go to <a href="http://www.networkadvertising.org">http://www.networkadvertising.org</a> or <a href="http://www.aboutads.info">http://www.aboutads.info</a>.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>(p) Information You Disclose Publicly.</strong> You may submit photographs, user profiles, written material, music, video, photos, comments and other content, which may include PII (collectively, &ldquo;<strong>UGC</strong>&rdquo;) on the Websites. The UGC may be reproduced, published, distributed or used by us or by third parties in any media or format whether now known or hereafter developed. We do not control who will have access to the UGC you choose to make public and take no responsibility for ensuring such UGC remains private or is secure. The UGC is not subject to this Privacy Policy. We are also not responsible for the accuracy, use or misuse of any UGC that you disclose or receive through the Websites. Please see our Terms of Use for further information about the terms that govern the UGC you post.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>(q) Links to Third Party Sites.</strong> When you are on the Websites, you may be directed to other websites that are operated and controlled by third parties that we do not control. We are not responsible for the privacy practices employed by any of these third parties.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>4. California Users: Your California Privacy Rights.</strong> Under California Civil Code sections 1798.83-1798.84, California residents are entitled to ask us for a notice describing what categories of personal customer information PMC shares with third parties or corporate affiliates for those third parties or corporate affiliates&rsquo; direct marketing purposes. That notice will identify the categories of information shared and will include a list of the third parties and affiliates with which it was shared, along with their names and addresses. If you are a California resident and would like a copy of this notice, please submit a written request to the following address: PMC, 11175 Santa Monica Blvd., Los Angeles, CA 90025. In your request, please specify that you want a &ldquo;PMC California Privacy Rights Notice.&rdquo; Please allow at least 30 days for a response.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>5. Subscriber Preferences.</strong><br />\r\n<br />\r\nSubscribers to our Publications may change their subscription-related mail and email preferences at any time as follows:</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>FN:</strong><br />\r\n<br />\r\nLog into Customer Care at <a href="http://footwearnews.com/customerservice">footwearnews.com/customerservice</a> and update your mailing preferences on the &ldquo;Change My Mailing Preferences&rdquo; page, or call us at 1-866-963-7335 or 1-515-237-3650.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Robb Report:</strong><br />\r\n<br />\r\nLog into Subscriber Services at <a href="https://ssl.palmcoastd.com/19301/apps/LOGINSSO">https://ssl.palmcoastd.com/19301/apps/LOGINSSO</a>,<br />\r\n<br />\r\nclick on &ldquo;Manage your Privacy Settings&rdquo; and update your mailing preferences, or call us at 1-800-967-7472.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Variety:</strong><br />\r\n<br />\r\nSend an email to <a href="mailto:variety@pubservice.com">variety@pubservice.com</a> asking to have your name removed from the direct mail promotion list, or call us at 1-86-22-552-3632 or 1-818-487-4550.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Variety Insight and Vscore:</strong><br />\r\n<br />\r\nLog into <a href="http://Varietyinsight.com">Varietyinsight.com</a> and go to My Account to update your communication preferences, or call us at 1-323-617-9555.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>WWD:</strong><br />\r\n<br />\r\nLog into Customer Care at <a href="http://wwd.com/customerservice">wwd.com/customerservice</a> and update your mailing preferences on the &ldquo;Change My Mailing Preferences&rdquo; page, or call us at 1-866-401-7801 or 1-515-237-3650.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>NOTE: changing your subscription-related preferences does not change your non-subscription-related email preferences, including for email alerts and newsletters, special offers from our brands, and promotional emails from third parties, which are set via the preference center on each individual Website.</strong><br />\r\n<br />\r\nDespite your indicated preferences, we may send you service related communications, including notices about your subscription, and we may continue disclosing your information to third parties under the Service Provider Use, the Legal Use and the Acquisition Use described above.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>6. Wireless Email Address and Short Message Services</strong>. If the email address you provide to us is a wireless email address, you agree to receive messages at such address from PMC or from third parties. Similarly, we may make available services through which you can receive messages on your phone or wireless device SMS Service. If you subscribe to one of our SMS Services, you thereby agree to receive services and messages at the address you provide for such purposes. Such messages may come from PMC, or from third parties. You may opt-out of these messages from us by following the instructions provided in the message. To use the wireless email address or SMS Service, you must reside in the United States. We may also obtain the date, time and content of your messages. We will use the information we obtain in connection with these services in accordance with this Privacy Policy. Your wireless carrier and other service providers may also collect data about your wireless device usage, and their practices are governed by their own policies.<strong> By providing us your wireless email address or by signing up for any SMS Service, you consent to receiving messages as described above. You understand that your wireless carrier&rsquo;s standard rates apply to these messages. You represent that you are the owner or authorized user of the wireless device on which messages will be received, and that you are authorized to approve the applicable charges.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>7. Security.</strong> We have undertaken reasonable efforts to implement administrative, technical and security safeguard to help prevent unauthorized access, use, or disclosure of the information we collect. However, no systems can be completely secure. Therefore, while PMC uses reasonable efforts to protect your PII, PMC cannot guarantee its absolute security, and your use of the Websites indicates your agreement to assume this risk.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>8. Special Note For Parents.</strong> The Websites are for a general audience and are not designed or intended for use by children, especially those under age thirteen (13). We cannot be responsible for any unsolicited messages received by children who disclose information about themselves in our public discussion areas. We encourage all parents to talk to their children and tell them not to do so.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>9. Consent to Transfer Information to the United States.</strong> The Websites are operated in the United States of America (USA) and are intended for users located in the USA. If you are located outside of the USA, please note that the information you provide to us will be transferred to and processed in the USA, where laws regarding processing of Personally Identifiable Information may be less stringent than the laws in your country. By using any of our Websites, you consent to this transfer, processing and storage.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>10. Changes to This Privacy Policy.</strong> We reserve the right to change this Privacy Policy at any time without prior notice. Any changes will be effective immediately upon the posting of the revised Privacy Policy.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>11. Disputes; No Rights of Third Parties.</strong> If you choose to access the Websites, subscribe to our Publications or use any of our Services, any dispute over privacy is subject to our Terms of Use, including limitations on damages, resolution of disputes by binding arbitration, and application of the laws of the United States, and the State of New York. This Privacy Policy does not create rights enforceable by third parties.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>12. Contact Us: Privacy Policy Coordinator.</strong><br />\r\n<br />\r\nIf you have any questions or concerns about any aspect of this Privacy Policy, please contact our privacy policy coordinator at the address set forth below.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Privacy Coordinator<br />\r\n<br />\r\nPenske Media Corporation<br />\r\n<br />\r\n475 Fifth Avenue<br />\r\n<br />\r\nNew York, NY 10017</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Or</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>PrivacyDirector@pmc.com</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Last revised on July 25, 2016</p>\r\n\r\n<p><br />\r\n&nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'privacy policy', 'privacy policy', 'privacy policy', 1, '2017-06-06', 1, '2017-06-06 07:01:35', 'privacy_policy'),
(3, 'About Us', '<h3>PMC is a Leading Digital Media and Publishing Company</h3>\r\n<p>Penske Media Corporation (PMC) is a leading digital media and information services company whose award-winning content attracts a monthly audience of more than 180 million and empowers more than 1 million global CEOs and business thought-leaders in markets that impact the world. Our dynamic events, data services, and rich content entertain and educate today&rsquo;s fashion, retail, beauty, entertainment and lifestyle sectors. Headquartered in New York and Los Angeles with additional offices in 11 countries worldwide, Penske Media is the way global influencers are informed, connected, and inspired. To learn more about PMC and its iconic brands, visit <a href="http://www.pmc.com">www.pmc.com</a>.</p>\r\n<div class="row">\r\n<div class="col-sm-3 col-sm-offset-1">\r\n\r\n\r\n<h3>DIVERSITY</h3>\r\n\r\n\r\n\r\n<p>From our hiring and promotions, to the design of products and services, to the way we act towards each other and interact with our consumers and advertisers, we strive to value and respect diversity and inclusion – these values are core to the company. “It’s all about You” is the fundamental principle and differentiator for the PMC suite of products and services. The critical need for diversity in a winning team, at a personal and professional level, is embodied not just in the company’s products but in the DNA of the culture as well. We reinforce these values in our day-to-day decision-making and actions and through company training.</p>\r\n\r\n\r\n</div>\r\n<div class="col-sm-3 col-sm-offset-1">\r\n<h3>GLOBAL BUSINESS</h3>\r\n\r\n\r\n\r\n<p>PMC is a global digital media company with a thriving business with consumers in more than 160 countries. Approximately 65% of the company’s traffic derives from domestic operations (U.S.) and 35% from international markets. Outside the U.S., the majority of our traffic is generated from the UK, Canada, Australia, Germany, India, Mexico, China, Italy, and France. As the consumption of digital content within verticals continues its growth, specifically world, national, and local news, finance, money, sports, and entertainment become increasingly global in nature, the benefit of a worldwide network and multi-national platform such as PMC only increases in importance and relevance. To manage its global operations, PMC currently has dedicated offices in Los Angeles, New York, London, Paris, Moscow, Mumbai, and Hong Kong.</p>\r\n\r\n\r\n</div>\r\n<div class="col-sm-3 col-sm-offset-1">\r\n<h3>CULTURE/VALUES</h3>\r\n\r\n\r\n\r\n<p>PMC’s values are foundational to the way business is conducted. Each employee is provided the freedom and tools to be creative, responsible and hardworking, while being encouraged to give back as a citizen of the world. The Executive Management team recognizes that nearly all of PMC’s success is directly attributable to its people. So creating an inspiring and supportive work environment to enable everyone to harness their unique talents is fundamental to the company’s sensibility as a values-based employer.</p>\r\n</div></div>', 'About Us', 'About Us', 'About Us', 1, '2017-06-06', 1, '2017-06-06 07:04:08', 'about_us'),
(4, 'Copyright', '<p>&nbsp;</p>\r\n\r\n<blockquote>\r\n<p>Copyright &copy; 2010 by Bill Shakespeare</p>\r\n&nbsp;\r\n\r\n<p>All rights reserved. No part of this publication may be reproduced, distributed, or transmitted in any form or by any means, including photocopying, recording, or other electronic or mechanical methods, without the prior written permission of the publisher, except in the case of brief quotations embodied in critical reviews and certain other noncommercial uses permitted by copyright law. For permission requests, write to the publisher, addressed &ldquo;Attention: Permissions Coordinator,&rdquo; at the address below.</p>\r\n&nbsp;\r\n\r\n<p>Imaginary Press<br />\r\n<br />\r\n1233 Pennsylvania Avenue<br />\r\n<br />\r\nSan Francisco, CA 94909<br />\r\n<br />\r\nwww.imaginarypress.com</p>\r\n&nbsp;\r\n\r\n<p>Ordering Information:<br />\r\n<br />\r\nQuantity sales. Special discounts are available on quantity purchases by corporations, associations, and others. For details, contact the publisher at the address above.<br />\r\n<br />\r\nOrders by U.S. trade bookstores and wholesalers. Please contact Big Distribution: Tel: (800) 800-8000; Fax: (800) 800-8001 or visit www.bigbooks.com.</p>\r\n&nbsp;\r\n\r\n<p>Printed in the United States of America</p>\r\n&nbsp;\r\n\r\n<p>Publisher&rsquo;s Cataloging-in-Publication data<br />\r\n<br />\r\nShakespeare, William.<br />\r\n<br />\r\nA title of a book : a subtitle of the same book / Bill Shakespeare &nbsp;; with Ben Johnson.<br />\r\n<br />\r\np. cm.<br />\r\n<br />\r\nISBN 978-0-9000000-0-0<br />\r\n<br />\r\n1. The main category of the book &mdash;History &mdash;Other category. 2. Another subject category &mdash;From one perspective. 3. More categories &mdash;And their modifiers. I. Johnson, Ben. II. Title.<br />\r\n<br />\r\nHF0000.A0 A00 2010<br />\r\n<br />\r\n299.000 00&ndash;dc22 &nbsp; 2010999999</p>\r\n&nbsp;\r\n\r\n<p>First Edition</p>\r\n</blockquote>\r\n\r\n<p>&nbsp;</p>\r\n', 'Copyright', 'Copyright', 'Copyright', 1, '2017-06-06', 1, '2017-06-06 07:09:30', 'copyright');

-- --------------------------------------------------------

--
-- Table structure for table `configuration_type`
--

CREATE TABLE IF NOT EXISTS `configuration_type` (
  `config_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `config_type` varchar(45) NOT NULL,
  PRIMARY KEY (`config_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `configuration_type`
--

INSERT INTO `configuration_type` (`config_type_id`, `config_type`) VALUES
(1, 'smtp_host'),
(2, 'admin_email'),
(3, 'currency');

-- --------------------------------------------------------

--
-- Table structure for table `configuration_value`
--

CREATE TABLE IF NOT EXISTS `configuration_value` (
  `config_value_id` int(11) NOT NULL AUTO_INCREMENT,
  `config_type_id` int(11) NOT NULL,
  `config_value` varchar(45) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`config_value_id`),
  KEY `config_type_id` (`config_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `configuration_value`
--

INSERT INTO `configuration_value` (`config_value_id`, `config_type_id`, `config_value`, `created_by`, `created_on`, `modified_on`, `modified_by`, `status`) VALUES
(1, 1, 'host_name', 1, '2017-05-25', '2017-05-03 06:33:46', NULL, 1),
(2, 2, 'admin@gmail.com', 1, '2017-05-03', '2017-05-03 06:33:46', NULL, 1),
(3, 3, '&#8377', 1, '2017-06-02', '2017-06-02 04:57:01', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE IF NOT EXISTS `contact_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `subject` varchar(45) NOT NULL,
  `message` text NOT NULL,
  `note_admin` text,
  `created_by` int(11) DEFAULT NULL,
  `created_on` date NOT NULL,
  `modify_by` int(11) DEFAULT NULL,
  `modify_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `subject`, `message`, `note_admin`, `created_by`, `created_on`, `modify_by`, `modify_date`) VALUES
(1, 'Tejas', 'tejaisbest@gmail.com', 'Order ', 'I haven''t recieved the order yet . Have placed the order a month ago.', 'Sorry for inconvenience, it will be delivered within 2 days', 0, '2017-06-05', 1, NULL),
(2, 'Tejas', 'tejaisbest@gmail.com', 'Order ', 'I haven''t recieved the order yet . Have placed the order a month ago.', '', 0, '2017-06-05', NULL, NULL),
(3, 'Suraj', 'suraj@gmail.com', 'Order ', 'having error in placing order', '', 0, '2017-06-05', NULL, NULL),
(4, 'Tejas', 'tejaisbest@gmail.com', 'Order ', 'Not able to place order', '', 0, '2017-06-05', NULL, NULL),
(5, 'Tejas', 'tejaisbest@gmail.com', 'Order ', 'Not able to place order', '', 0, '2017-06-05', NULL, NULL),
(6, 'Tejas', 'tejaisbest@gmail.com', 'asdasd', 'asdasdsadsadasd', '', 0, '2017-06-05', NULL, NULL),
(7, 'Tejas', 'tejaisbest@gmail.com', 'earadadasd', 'asdsadsadasdasd', '', 0, '2017-06-05', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE IF NOT EXISTS `coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) DEFAULT NULL,
  `percent_off` float(12,2) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `no_of_uses` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `code`, `percent_off`, `created_by`, `created_on`, `modified_by`, `modified_on`, `no_of_uses`) VALUES
(1, 'GRAB500', 40.00, 1, '2017-05-15', 1, '2017-05-15 14:37:37', 96),
(2, 'GRAB50', 25.00, 1, '2017-06-08', NULL, '2017-06-08 11:10:59', 49);

-- --------------------------------------------------------

--
-- Table structure for table `coupons_used`
--

CREATE TABLE IF NOT EXISTS `coupons_used` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `coupon_id_idx` (`coupon_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `coupons_used`
--

INSERT INTO `coupons_used` (`id`, `user_id`, `order_id`, `created_on`, `coupon_id`) VALUES
(1, 1, 16, '2017-06-08', 1),
(2, 1, 17, '2017-06-08', 1),
(3, 1, 18, '2017-06-08', 1),
(4, 1, 19, '2017-06-08', 1),
(5, 1, 20, '2017-06-08', 1),
(6, 1, 21, '2017-06-08', 2);

-- --------------------------------------------------------

--
-- Table structure for table `forgot_password`
--

CREATE TABLE IF NOT EXISTS `forgot_password` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tokken` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `forgot_password`
--

INSERT INTO `forgot_password` (`id`, `user_id`, `email`, `tokken`, `created_on`, `is_verified`) VALUES
(1, 1, 'admin@gmail.com', '37b1365d7cfe2e8022d405dc93a662cf', '2017-05-26 13:09:44', 0),
(2, 1, 'admin@gmail.com', '0d615153aee5674a9d3f390983c43c29', '2017-05-26 13:10:47', 0),
(3, 1, 'admin@gmail.com', '0ea275b49c476e7f82d7bcb440e6d9ce', '2017-05-29 19:36:53', 1),
(4, 1, 'admin@gmail.com', 'db69058f56820fcf032b0f7c17d2cf32', '2017-05-30 11:34:17', 0),
(5, 1, 'admin@gmail.com', '9b6f6a42dc69103cc9c03a91eb092152', '2017-05-30 11:41:39', 0),
(6, 1, 'admin@gmail.com', 'ef2858c749d06c62f98e6381a0cbfb12', '2017-05-30 11:50:54', 0),
(7, 1, 'admin@gmail.com', 'd5904d6ee4a895ef79796bf958513b72', '2017-05-30 11:52:05', 0),
(8, 1, 'admin@gmail.com', 'dce915a5a4b83ee7a2689c6996c6de32', '2017-05-30 12:58:01', 0),
(9, 1, 'admin@gmail.com', '937f9f86f9d89179404a47a89d9a1f17', '2017-06-02 10:48:47', 0),
(10, 10, 'tejas@gmail.com', '59f6957cc75bbac6161305ae462361d5', '2017-06-02 11:11:25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `amount` float(12,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id_idx` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `amount`) VALUES
(20, 9, 3, 1, 15999.99),
(21, 9, 4, 1, 15.22),
(22, 10, 3, 1, 15999.99),
(23, 10, 4, 1, 15.22),
(24, 11, 4, 6, 91.32),
(25, 11, 3, 2, 31999.98),
(26, 11, 8, 2, 15999.98),
(27, 12, 3, 1, 15999.99),
(28, 12, 4, 1, 15.22),
(29, 13, 3, 1, 15999.99),
(30, 13, 4, 1, 15.22),
(31, 14, 7, 1, 15.22),
(32, 15, 3, 2, 31999.98),
(33, 15, 4, 2, 30.44),
(34, 15, 7, 2, 30.44),
(35, 16, 3, 3, 47999.97),
(36, 16, 4, 2, 30.44),
(37, 16, 7, 2, 30.44),
(38, 17, 3, 3, 47999.97),
(39, 17, 4, 2, 30.44),
(40, 17, 7, 2, 30.44),
(41, 18, 3, 3, 47999.97),
(42, 18, 4, 2, 30.44),
(43, 18, 7, 2, 30.44),
(44, 19, 3, 3, 47999.97),
(45, 19, 4, 2, 30.44),
(46, 19, 7, 2, 30.44),
(47, 20, 3, 3, 47999.97),
(48, 20, 4, 2, 30.44),
(49, 20, 7, 2, 30.44),
(50, 21, 3, 2, 31999.98),
(51, 21, 4, 2, 30.44),
(52, 21, 7, 2, 30.44),
(53, 22, 3, 2, 31999.98),
(54, 22, 4, 2, 30.44),
(55, 22, 7, 1, 15.22),
(56, 23, 3, 2, 31999.98),
(57, 23, 4, 2, 30.44),
(58, 23, 7, 1, 15.22);

-- --------------------------------------------------------

--
-- Table structure for table `payment_gateway`
--

CREATE TABLE IF NOT EXISTS `payment_gateway` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `payment_gateway`
--

INSERT INTO `payment_gateway` (`id`, `name`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'Cash on delivery', 1, '2017-06-07', NULL, '2017-06-07 10:21:17'),
(2, 'paypal', 1, '2017-06-07', NULL, '2017-06-07 10:21:17');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `modules` varchar(45) NOT NULL,
  PRIMARY KEY (`permission_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`permission_id`, `modules`) VALUES
(1, 'admin_user'),
(2, 'configuration'),
(3, 'banner'),
(4, 'category'),
(5, 'product'),
(6, 'attribute'),
(7, 'coupon');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `sku` varchar(45) DEFAULT NULL,
  `short_description` varchar(100) DEFAULT NULL,
  `long_description` text,
  `price` float(14,2) DEFAULT NULL,
  `special_price` float(14,2) DEFAULT NULL,
  `special_price_from` date DEFAULT NULL,
  `special_price_to` date DEFAULT NULL,
  `status` enum('1','0') DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `meta_title` varchar(45) DEFAULT NULL,
  `meta_description` text,
  `meta_keywords` text,
  `created_by` int(10) NOT NULL,
  `created_on` date NOT NULL,
  `modified_by` int(10) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'By Default it will be 0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `sku`, `short_description`, `long_description`, `price`, `special_price`, `special_price_from`, `special_price_to`, `status`, `quantity`, `meta_title`, `meta_description`, `meta_keywords`, `created_by`, `created_on`, `modified_by`, `modified_on`, `is_featured`) VALUES
(3, 'Product1', 'ABCD123', 'MOBILE', '', 15999.99, 14999.99, '2017-05-16', '2017-05-27', '1', 15, 'Oppo Mobile', 'New Oppo Mobile', 'Product Mobile', 1, '2017-05-11', 1, '2017-05-11 07:53:58', 1),
(4, 'asd', 'asdsad', 'MOBILE', '', 15.22, 16.23, '0000-00-00', '0000-00-00', '1', 10, 'Oppo Mobile', 'New Oppo Mobile', 'asdasd', 1, '2017-05-11', NULL, '2017-05-11 09:31:53', 1),
(5, 'asd', 'asdsad', 'MOBILE', '', 15.22, 16.23, '0000-00-00', '0000-00-00', '1', 10, 'Oppo Mobile', 'New Oppo Mobile', 'asdasd', 1, '2017-05-11', NULL, '2017-05-11 09:39:42', 0),
(6, 'asd', 'asdsad', 'MOBILE', '', 15.22, 16.23, '0000-00-00', '0000-00-00', '1', 10, 'Oppo Mobile', 'New Oppo Mobile', 'asdasd', 1, '2017-05-11', NULL, '2017-05-11 09:40:12', 0),
(7, 'asd', 'asdsad', 'MOBILE', '', 15.22, 16.23, '0000-00-00', '0000-00-00', '1', 10, 'Oppo Mobile', 'New Oppo Mobile', 'asdasd', 1, '2017-05-11', NULL, '2017-05-11 09:40:27', 1),
(8, 'Moto e', 'ABCD123', 'Handset', '', 7999.99, 6999.99, '2017-05-16', '2017-05-16', '1', 15, 'MOTO E3', 'POWER CHARGING', 'MOTO MOBLE', 1, '2017-05-12', 1, '2017-05-12 08:07:07', 1),
(9, 'asda', 'agsfdgha', 'asfda', 'FASGHDF', 123.12, 123.12, '2017-05-02', '2017-06-21', '0', 1734, 'SHDFSDAGH', '', '', 1, '2017-05-24', NULL, '2017-05-24 08:06:29', 0),
(10, 'asdg', '1231', '1231231', '', 16253.12, 123.99, '2017-05-23', '2017-05-31', '1', 123, '123123', '', '', 1, '2017-05-24', NULL, '2017-05-24 08:07:07', 0),
(11, 'Product 3', 'ADSVA', 'ASDASDSAD', '', 1200.00, 1250.00, '2017-05-10', '2017-06-07', '1', 12, 'ASDASD', '', 'AHSDAHGSSD', 1, '2017-05-24', 1, '2017-05-24 08:08:41', 0),
(12, 'asd', 'asdad', 'asd', '', 50.55, 48.55, '2017-05-31', '2017-06-07', '1', 5, 'asdsad', '', '', 1, '2017-05-24', NULL, '2017-05-24 11:54:21', 1),
(13, 'asd', 'asdad', 'asd', '', 50.55, 48.55, '2017-05-31', '2017-06-07', '1', 5, 'asdsad', '', '', 1, '2017-05-24', NULL, '2017-05-24 13:06:24', 0),
(14, 'asdasd', 'asd', 'asdsa', '', 15.00, 15.00, '2017-05-11', '2017-06-29', '1', 15, 'asdsa', '', '', 1, '2017-05-25', NULL, '2017-05-25 06:31:22', 1),
(15, 'asdsa', '3asd', 'asd', '', 15.00, 151.00, '2017-05-11', '2017-06-08', '1', 15, 'asd', '', '', 1, '2017-05-25', NULL, '2017-05-25 06:32:59', 0),
(16, 'asd', 'asa', 'asd', '', 15.00, 156.00, '2017-06-08', '2017-06-22', '1', 15, 'ada', '', '', 1, '2017-05-25', NULL, '2017-05-25 06:37:54', 1),
(17, 'asdas', 'dsf', 'asd', '', 15.00, 155.00, '2017-06-15', '2017-06-22', '1', 15, 'asdsad', '', '', 1, '2017-05-25', NULL, '2017-05-25 06:38:48', 0),
(18, 'asd', '12312312', '123213123', '', 12311.12, 12.34, '2017-05-15', '2017-05-30', '1', 12123, '123123123', '', '', 1, '2017-05-25', NULL, '2017-05-25 06:44:39', 0),
(19, 'asd', '12312312', '123213123', '', 12311.12, 12.34, '2017-05-15', '2017-05-30', '1', 12123, '123123123', '', '', 1, '2017-05-25', NULL, '2017-05-25 06:55:18', 0),
(46, 'Tejas', 'asdas', 'asdsad', 'asdas', 150.00, 125.00, '2017-05-22', '2017-05-29', '1', 15, 'asdasd', 'asdasd', '', 1, '2017-05-29', 1, '2017-05-29 08:12:31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE IF NOT EXISTS `product_attributes` (
  `product_attribute_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`product_attribute_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`product_attribute_id`, `name`, `created_by`, `created_on`, `modified_by`, `modified_on`, `status`) VALUES
(1, 'Colour', 1, '2017-05-10', 1, '2017-05-10 07:11:31', 1),
(2, 'Brand', 1, '2017-05-10', NULL, '2017-05-10 07:13:50', 1),
(3, 'Size', 1, '2017-05-10', NULL, '2017-05-10 07:22:54', 1),
(4, 'RAM', 1, '2017-05-10', NULL, '2017-05-10 07:24:55', 1),
(5, 'ISBN', 1, '2017-05-10', NULL, '2017-05-10 07:25:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes_assoc`
--

CREATE TABLE IF NOT EXISTS `product_attributes_assoc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `product_attribute_id` int(11) DEFAULT NULL,
  `product_attribute_value_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id_idx` (`product_id`),
  KEY `product_attribute_id_idx` (`product_attribute_id`),
  KEY `product_attribute_value_id_idx` (`product_attribute_value_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `product_attributes_assoc`
--

INSERT INTO `product_attributes_assoc` (`id`, `product_id`, `product_attribute_id`, `product_attribute_value_id`) VALUES
(1, 7, 1, 9),
(2, 7, 2, 9),
(35, 8, 3, 43),
(36, 8, 1, 44),
(38, 3, 2, 46),
(39, 3, 3, 47),
(47, 11, 4, 58),
(48, 11, 3, 59);

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute_values`
--

CREATE TABLE IF NOT EXISTS `product_attribute_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_attribute_id` int(11) DEFAULT NULL,
  `attribute_value` varchar(45) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `modifed_by` int(11) NOT NULL,
  `modified_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_attribute_id_idx` (`product_attribute_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `product_attribute_values`
--

INSERT INTO `product_attribute_values` (`id`, `product_attribute_id`, `attribute_value`, `created_by`, `created_on`, `modifed_by`, `modified_on`) VALUES
(1, 1, 'Black', 1, '2017-05-11', 0, '2017-05-11 09:31:30'),
(2, 2, 'Oppo', 1, '2017-05-11', 0, '2017-05-11 09:31:30'),
(3, 1, 'Black', 1, '2017-05-11', 0, '2017-05-11 09:31:53'),
(4, 2, 'Oppo', 1, '2017-05-11', 0, '2017-05-11 09:31:53'),
(5, 1, 'Black', 1, '2017-05-11', 0, '2017-05-11 09:39:42'),
(6, 2, 'Oppo', 1, '2017-05-11', 0, '2017-05-11 09:39:42'),
(7, 1, 'Black', 1, '2017-05-11', 0, '2017-05-11 09:40:12'),
(8, 2, 'Oppo', 1, '2017-05-11', 0, '2017-05-11 09:40:12'),
(9, 1, 'Black', 1, '2017-05-11', 0, '2017-05-11 09:40:27'),
(10, 2, 'Oppo', 1, '2017-05-11', 0, '2017-05-11 09:40:27'),
(20, 1, 'Black', 1, '2017-05-15', 0, '2017-05-15 07:18:12'),
(21, 2, 'MOTOROLA', 1, '2017-05-15', 0, '2017-05-15 07:18:12'),
(23, 1, 'Black', 1, '2017-05-15', 0, '2017-05-15 07:21:15'),
(24, 2, 'MOTOROLA', 1, '2017-05-15', 0, '2017-05-15 07:21:15'),
(26, 1, 'Black', 1, '2017-05-15', 0, '2017-05-15 07:21:37'),
(43, 3, '5*5inch', 1, '2017-05-15', 0, '2017-05-15 08:56:43'),
(44, 1, 'Black', 1, '2017-05-15', 0, '2017-05-15 08:56:43'),
(46, 2, 'OPPO', 1, '2017-05-15', 0, '2017-05-15 09:31:21'),
(47, 3, '6*6inch', 1, '2017-05-15', 0, '2017-05-15 09:31:21'),
(58, 4, '2GB', 1, '2017-05-25', 0, '2017-05-25 07:32:29'),
(59, 3, '5*5inch', 1, '2017-05-25', 0, '2017-05-25 07:32:29');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE IF NOT EXISTS `product_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id_idx` (`product_id`),
  KEY `category_id_idx` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `product_id`, `category_id`) VALUES
(2, 3, 9),
(3, 4, 10),
(4, 5, 10),
(5, 6, 10),
(6, 7, 10),
(7, 8, 6),
(8, 9, 4),
(9, 10, 4),
(10, 11, 6),
(11, 12, 8),
(12, 13, 8),
(13, 14, 4),
(14, 15, 6),
(15, 16, 4),
(16, 17, 2),
(17, 18, 4),
(18, 19, 4),
(19, 46, 12);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE IF NOT EXISTS `product_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_name` varchar(100) DEFAULT NULL,
  `status` enum('1','0') DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `product_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id_idx` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `image_name`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`, `product_id`) VALUES
(1, 'product1494489238.jpg', '1', 1, '2017-05-11', 1, '2017-05-11 07:53:58', 3),
(2, 'product1494495113.jpg', '1', 1, '2017-05-11', NULL, '2017-05-11 09:31:53', 4),
(3, 'product1494495582.jpg', '1', 1, '2017-05-11', NULL, '2017-05-11 09:39:42', 5),
(4, 'product1494495612.jpg', '1', 1, '2017-05-11', NULL, '2017-05-11 09:40:12', 6),
(5, 'product1494495627.jpg', '1', 1, '2017-05-11', NULL, '2017-05-11 09:40:27', 7),
(6, 'product1494576427.png', '1', 1, '2017-05-12', 1, '2017-05-12 08:07:07', 8),
(7, 'product1495613189.jpg', '0', 1, '2017-05-24', NULL, '2017-05-24 08:06:29', 9),
(8, 'product1495613227.jpg', '1', 1, '2017-05-24', NULL, '2017-05-24 08:07:07', 10),
(9, 'product1495697549.jpg', '1', 1, '2017-05-24', 1, '2017-05-24 08:08:41', 11),
(10, 'product1495626861.jpg', '1', 1, '2017-05-24', NULL, '2017-05-24 11:54:21', 12),
(11, 'product1495631184.jpg', '1', 1, '2017-05-24', NULL, '2017-05-24 13:06:24', 13),
(12, 'product1495693882.jpg', '1', 1, '2017-05-25', NULL, '2017-05-25 06:31:22', 14),
(13, 'product1495693978.jpg', '1', 1, '2017-05-25', NULL, '2017-05-25 06:32:59', 15),
(14, 'product1495694274.jpg', '1', 1, '2017-05-25', NULL, '2017-05-25 06:37:54', 16),
(15, 'product1495694328.jpg', '1', 1, '2017-05-25', NULL, '2017-05-25 06:38:49', 17),
(16, 'product1495694679.jpg', '1', 1, '2017-05-25', NULL, '2017-05-25 06:44:39', 18),
(17, 'product1495695318.jpg', '1', 1, '2017-05-25', NULL, '2017-05-25 06:55:18', 19),
(18, 'product1496045551.jpg', '1', 1, '2017-05-29', 1, '2017-05-29 08:12:31', 46);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'superadmin'),
(2, 'admin'),
(3, 'inventory manager'),
(4, 'order manager'),
(5, 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE IF NOT EXISTS `role_permission` (
  `role_permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY (`role_permission_id`),
  KEY `role_id` (`role_id`,`permission_id`),
  KEY `permission_id` (`permission_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `role_permission`
--

INSERT INTO `role_permission` (`role_permission_id`, `role_id`, `permission_id`) VALUES
(1, 1, 1),
(4, 1, 2),
(6, 1, 3),
(7, 1, 4),
(8, 1, 5),
(9, 1, 6),
(10, 1, 7),
(2, 2, 2),
(3, 2, 3),
(11, 2, 4),
(12, 2, 5),
(13, 2, 6),
(14, 2, 7),
(15, 3, 5),
(17, 3, 6),
(16, 4, 5),
(18, 4, 6);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `created_date` date DEFAULT NULL,
  `fb_token` varchar(100) DEFAULT NULL,
  `twitter_token` varchar(100) DEFAULT NULL,
  `google_token` varchar(100) DEFAULT NULL,
  `registration_method` enum('N','F','T','G') DEFAULT NULL COMMENT 'N- Normal\nF- facebook\nT- Twitter\nG- Google',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `firstname`, `lastname`, `email`, `password`, `status`, `created_date`, `fb_token`, `twitter_token`, `google_token`, `registration_method`) VALUES
(1, 'Admin', 'admin', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', '1', NULL, NULL, NULL, NULL, NULL),
(2, 'Suraj', 'Gavahane', 'suraj@gmail.com', '8127a1ad276367223d9d0a2d264e4b2e', '1', NULL, NULL, NULL, NULL, NULL),
(6, 'rahul', 'patil', 'rahul@gmail.com', '2acb7811397a5c3bea8cba57b0388b79', '1', NULL, NULL, NULL, NULL, NULL),
(10, 'Tejas', 'Ghadi', 'tejas@gmail.com', '78270210116d6e905227e8d6c26b1ba7', '1', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE IF NOT EXISTS `user_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `address_1` varchar(100) DEFAULT NULL,
  `address_2` varchar(100) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `zipcode` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`id`, `user_id`, `address_1`, `address_2`, `city`, `state`, `country`, `zipcode`) VALUES
(2, 1, ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081'),
(3, 1, 'asdasd', NULL, 'asdassadsa', 'asdasdas', 'asdasdsa', '123458'),
(4, 2, 'Near EON IT Park Kharadi, Dhole Patil College Road', 'Wagholi', 'Pune', 'Maharashtra', 'India', '412207');

-- --------------------------------------------------------

--
-- Table structure for table `user_order`
--

CREATE TABLE IF NOT EXISTS `user_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `shipping_method` int(11) DEFAULT NULL,
  `AWB_NO` varchar(100) DEFAULT NULL,
  `payment_gateway_id` int(11) DEFAULT NULL,
  `transaction_id` varchar(100) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending' COMMENT 'pending,processing,dispatch,delivered',
  `grand_total` float(12,2) DEFAULT NULL,
  `shipping_charges` float(12,2) DEFAULT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `billing_address_1` varchar(100) DEFAULT NULL,
  `billing_address_2` varchar(100) DEFAULT NULL,
  `billing_city` varchar(45) DEFAULT NULL,
  `billing_state` varchar(45) DEFAULT NULL,
  `billing_country` varchar(45) DEFAULT NULL,
  `billing_zipcode` varchar(45) DEFAULT NULL,
  `shipping_address_1` varchar(100) DEFAULT NULL,
  `shipping_address_2` varchar(100) DEFAULT NULL,
  `shipping_city` varchar(45) DEFAULT NULL,
  `shipping_state` varchar(45) DEFAULT NULL,
  `shipping_country` varchar(45) DEFAULT NULL,
  `shipping_zipcode` varchar(45) DEFAULT NULL,
  `shipping_mobile` varchar(11) NOT NULL,
  `billing_mobile` varchar(11) NOT NULL,
  `discount` float(11,2) NOT NULL,
  `billing_email` varchar(100) NOT NULL,
  `shipping_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`),
  KEY `payment_gateway_id_idx` (`payment_gateway_id`),
  KEY `coupon_id_idx` (`coupon_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `user_order`
--

INSERT INTO `user_order` (`id`, `user_id`, `shipping_method`, `AWB_NO`, `payment_gateway_id`, `transaction_id`, `created_on`, `status`, `grand_total`, `shipping_charges`, `coupon_id`, `billing_address_1`, `billing_address_2`, `billing_city`, `billing_state`, `billing_country`, `billing_zipcode`, `shipping_address_1`, `shipping_address_2`, `shipping_city`, `shipping_state`, `shipping_country`, `shipping_zipcode`, `shipping_mobile`, `billing_mobile`, `discount`, `billing_email`, `shipping_email`) VALUES
(9, 1, NULL, NULL, 2, NULL, '2017-06-07', 'pending', 16015.21, 0.00, NULL, ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081', ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081', '2147483647', '2147483647', 0.00, '', ''),
(10, 1, NULL, NULL, 2, NULL, '2017-06-07', 'pending', 16015.21, 0.00, NULL, ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081', ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081', '2147483647', '2147483647', 0.00, '', ''),
(11, 1, NULL, NULL, 1, NULL, '2017-06-07', 'pending', 48091.28, 0.00, NULL, ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081', ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081', '2147483647', '2147483647', 0.00, '', ''),
(12, 1, NULL, NULL, 1, NULL, '2017-06-07', 'pending', 16015.21, 0.00, NULL, ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081', ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081', '2147483647', '2147483647', 0.00, '', ''),
(13, 1, NULL, NULL, 1, NULL, '2017-06-07', 'pending', 16015.21, 0.00, NULL, ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081', ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081', '2147483647', '2147483647', 0.00, '', ''),
(14, 1, NULL, NULL, 2, NULL, '2017-06-07', 'pending', 515.22, 500.00, NULL, ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081', ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081', '9768832467', '9869464016', 0.00, '', ''),
(15, 1, NULL, NULL, 1, NULL, '2017-06-08', 'pending', 32060.86, 0.00, NULL, ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081', ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081', '9768832467', '9869464016', 0.00, '', ''),
(16, 1, NULL, NULL, 1, NULL, '2017-06-08', 'pending', 48060.85, 0.00, 1, ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081', ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081', '0986946401', '9869464016', 19224.34, '', ''),
(17, 1, NULL, NULL, 1, NULL, '2017-06-08', 'pending', 48060.85, 0.00, 1, ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081', ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081', '0986946401', '9869464016', 19224.34, '', ''),
(18, 1, NULL, NULL, 1, NULL, '2017-06-08', 'pending', 48060.85, 0.00, 1, ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081', ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081', '0986946401', '9869464016', 19224.34, '', ''),
(19, 1, NULL, NULL, 1, NULL, '2017-06-08', 'pending', 48060.85, 0.00, 1, ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081', ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081', '0986946401', '9869464016', 19224.34, '', ''),
(20, 1, NULL, NULL, 1, NULL, '2017-06-08', 'pending', 48060.85, 0.00, 1, ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081', ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081', '0986946401', '9869464016', 19224.34, '', ''),
(21, 1, NULL, NULL, 2, NULL, '2017-06-08', 'pending', 32060.86, 0.00, 2, ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081', ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081', '0976883246', '9869464016', 8015.22, '', ''),
(22, 1, NULL, NULL, 1, NULL, '2017-06-08', 'pending', 32045.64, 0.00, NULL, ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081', ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081', '0986946401', '9869464016', 0.00, 'admin@gmail.com', 'admin@gmail.com'),
(23, 1, NULL, NULL, 1, NULL, '2017-06-08', 'dispatch', 32045.64, 0.00, NULL, ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081', ' Near Asmita Society, Near Sadguru Garden, Mith Bunder Road', 'Valmiki Nagar', 'Thane', 'Maharashtra', 'India', '400081', '0986946401', '9869464016', 0.00, 'admin@gmail.com', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `user_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_role_id`),
  KEY `user_id` (`user_id`,`role_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_role_id`, `user_id`, `role_id`) VALUES
(25, 1, 1),
(26, 1, 2),
(27, 1, 3),
(28, 1, 4),
(4, 2, 2),
(5, 2, 3),
(6, 2, 4),
(7, 2, 5),
(22, 6, 3),
(23, 6, 4),
(24, 10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user_wish_list`
--

CREATE TABLE IF NOT EXISTS `user_wish_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `configuration_value`
--
ALTER TABLE `configuration_value`
  ADD CONSTRAINT `config type to config value` FOREIGN KEY (`config_type_id`) REFERENCES `configuration_type` (`config_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_attributes_assoc`
--
ALTER TABLE `product_attributes_assoc`
  ADD CONSTRAINT `product id` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Product_attribute values` FOREIGN KEY (`product_attribute_value_id`) REFERENCES `product_attribute_values` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Product_attribute_id` FOREIGN KEY (`product_attribute_id`) REFERENCES `product_attributes` (`product_attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_attribute_values`
--
ALTER TABLE `product_attribute_values`
  ADD CONSTRAINT `poduct_attribute` FOREIGN KEY (`product_attribute_id`) REFERENCES `product_attributes` (`product_attribute_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `Category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD CONSTRAINT `assign permission` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`permission_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role to permission` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `assign role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `User to role` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
