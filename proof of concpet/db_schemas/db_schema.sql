/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table mobile_connection
# ------------------------------------------------------------

CREATE TABLE `mobile_connection` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `page_view_id` int(11) DEFAULT NULL,
  `type` varchar(64) DEFAULT NULL,
  `bandwidth` varchar(64) DEFAULT NULL,
  `metered` varchar(64) DEFAULT NULL,
  `downlink_max` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table navigation_timings
# ------------------------------------------------------------

CREATE TABLE `navigation_timings` (
  `page_view_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL DEFAULT '',
  `boomerang_version` varchar(4) NOT NULL DEFAULT '',
  `vis_st` varchar(64) NOT NULL DEFAULT '',
  `ua_plt` varchar(64) NOT NULL DEFAULT '',
  `ua_vnd` varchar(64) NOT NULL DEFAULT '',
  `pid` varchar(32) NOT NULL DEFAULT '',
  `nt_red_cnt` tinyint(4) NOT NULL,
  `nt_nav_type` tinyint(4) NOT NULL,
  `nt_nav_st` varchar(13) NOT NULL DEFAULT '',
  `nt_red_st` varchar(13) NOT NULL DEFAULT '',
  `nt_red_end` varchar(13) NOT NULL DEFAULT '',
  `nt_fet_st` varchar(13) NOT NULL DEFAULT '',
  `nt_dns_st` varchar(13) NOT NULL DEFAULT '',
  `nt_dns_end` varchar(13) NOT NULL DEFAULT '',
  `nt_con_st` varchar(13) NOT NULL DEFAULT '',
  `nt_con_end` varchar(13) NOT NULL DEFAULT '',
  `nt_req_st` varchar(13) NOT NULL DEFAULT '',
  `nt_res_st` varchar(13) NOT NULL DEFAULT '',
  `nt_res_end` varchar(13) NOT NULL DEFAULT '',
  `nt_domloading` varchar(13) NOT NULL DEFAULT '',
  `nt_domint` varchar(13) NOT NULL DEFAULT '',
  `nt_domcontloaded_st` varchar(13) NOT NULL DEFAULT '',
  `nt_domcontloaded_end` varchar(13) NOT NULL DEFAULT '',
  `nt_domcomp` varchar(13) NOT NULL DEFAULT '',
  `nt_load_st` varchar(13) NOT NULL DEFAULT '',
  `nt_load_end` varchar(13) NOT NULL DEFAULT '',
  `nt_unload_st` varchar(13) NOT NULL DEFAULT '',
  `nt_unload_end` varchar(13) NOT NULL DEFAULT '',
  `nt_spdy` tinyint(4) NOT NULL,
  `nt_cinf` varchar(64) NOT NULL DEFAULT '',
  `nt_first_paint` varchar(13) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `guid` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`page_view_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table resource_timings
# ------------------------------------------------------------

CREATE TABLE `resource_timings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `page_view_id` int(11) NOT NULL,
  `startTime` varchar(13) NOT NULL DEFAULT '',
  `responseEnd` varchar(13) NOT NULL DEFAULT '',
  `responseStart` varchar(13) NOT NULL DEFAULT '',
  `requestStart` varchar(13) NOT NULL DEFAULT '',
  `connectEnd` varchar(13) NOT NULL DEFAULT '',
  `secureConnectionStart` varchar(13) NOT NULL DEFAULT '',
  `connectStart` varchar(13) NOT NULL DEFAULT '',
  `domainLookupEnd` varchar(13) NOT NULL DEFAULT '',
  `domainLookupStart` varchar(13) NOT NULL DEFAULT '',
  `redirectEnd` varchar(13) NOT NULL DEFAULT '',
  `redirectStart` varchar(13) NOT NULL DEFAULT '',
  `fetchStart` varchar(13) NOT NULL DEFAULT '',
  `duration` varchar(13) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `page_view_id` (`page_view_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
