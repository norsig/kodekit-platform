SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
SET @OLD_TIME_ZONE=@@TIME_ZONE, TIME_ZONE='+00:00';
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`languages_language_id`, `application`, `name`, `native_name`, `iso_code`, `slug`, `enabled`, `default`, `uuid`)
VALUES
    (1, 'admin', 'English (United Kingdom)', 'English (United Kingdom)', 'en-GB', 'en', 1, 1, UUID()),
    (2, 'site', 'English (United Kingdom)', 'English (United Kingdom)', 'en-GB', 'en', 1, 1, UUID());

--
-- Dumping data for table `languages_tables`
--

INSERT INTO `languages_tables` (`languages_table_id`, `component`, `name`, `unique_column`, `enabled`, `uuid`)
VALUES
    (1, 'articles', 'articles', 'articles_article_id', 0, UUID()),
    (2, 'articles', 'categories', 'categories_category_id', 0, UUID());

--
-- Dumping data for table `pages_menus`
--

INSERT INTO `pages_menus` (`pages_menu_id`, `application`, `title`, `slug`, `description`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `uuid`)
VALUES
	(1, 'site', 'Main Menu', 'mainmenu', 'The main menu for the site', 1, NULL, NULL, NULL, NULL, NULL, UUID()),
	(2, 'admin', 'Menubar', 'menubar', '1', 1, NULL, NULL, NULL, NULL, NULL, UUID());


--
-- Dumping data for table `pages_modules_pages`
--

INSERT INTO `pages_modules_pages` (`pages_module_id`, `pages_page_id`) VALUES (1, 0);

--
-- Dumping data for table `pages_orderings`
--

INSERT INTO `pages_orderings` (`pages_page_id`, `title`, `custom`)
VALUES
	(1, 2, 1),
	(2, 3, 1),
	(3, 6, 2),
	(4, 2, 3),
	(5, 5, 4),
	(6, 8, 5),
	(7, 4, 6),
	(8, 1, 1),
	(9, 7, 7),
	(10, 1, 1),
	(12, 1, 1),
	(14, 3, 3),
	(15, 1, 1),
	(16, 1, 1),
	(19, 2, 1),
	(20, 1, 2),
	(21, 3, 1),
	(22, 1, 2),
	(23, 2, 3),
	(24, 2, 1),
	(25, 1, 2),
	(26, 2, 1),
	(27, 1, 2),
  (28, 3, 2);


INSERT INTO `pages_closures` (`ancestor_id`, `descendant_id`, `level`)
VALUES
	(1, 1, 0),
	(2, 2, 0),
	(3, 3, 0),
	(3, 21, 1),
	(3, 22, 1),
	(3, 23, 1),
	(4, 4, 0),
	(4, 12, 1),
	(4, 13, 1),
	(4, 14, 1),
	(4, 15, 2),
	(4, 16, 2),
	(4, 19, 2),
	(4, 20, 2),
	(4, 28, 2),
	(5, 5, 0),
	(6, 6, 0),
	(6, 24, 1),
	(6, 25, 1),
	(7, 7, 0),
	(7, 8, 1),
	(8, 8, 0),
	(9, 9, 0),
	(9, 10, 1),
	(9, 11, 1),
	(9, 26, 2),
	(9, 27, 2),
	(10, 10, 0),
	(11, 11, 0),
	(11, 26, 1),
	(11, 27, 1),
	(12, 12, 0),
	(12, 15, 1),
	(12, 16, 1),
	(12, 28, 1),
	(13, 13, 0),
	(14, 14, 0),
	(14, 19, 1),
	(14, 20, 1),
	(15, 15, 0),
	(16, 16, 0),
	(19, 19, 0),
	(20, 20, 0),
	(21, 21, 0),
	(22, 22, 0),
	(23, 23, 0),
	(24, 24, 0),
	(25, 25, 0),
	(26, 26, 0),
	(27, 27, 0),
	(28, 28, 0);


--
-- Dumping data for table `pages_modules`
--

INSERT INTO `pages_modules` (`pages_module_id`, `title`, `ordering`, `position`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `published`, `name`, `access`, `params`, `component`, `application`, `uuid`)
VALUES
	(1, 'Main Menu', 2, 'user3', 1, NULL, NULL, NULL, NULL, NULL, 1, 'menu', 0, '["menu":"1","show_title":"0","class":"nav navbar-nav","max_level":"1"]', 'pages', 'site', UUID());

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`pages_page_id`, `pages_menu_id`, `title`, `slug`, `component`, `state`, `published`, `hidden`, `default`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `access`, `access_group`, `params`, `uuid`)
VALUES
	(1, 1, 'Home', 'home', 'articles', 'view=articles', 1, 0, 1, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, UUID()),
	(2, 2, 'Dashboard', 'dashboard', 'dashboard', 'view=dashboard', 1, 0, 1, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, UUID()),
	(3, 2, 'Pages', 'pages', 'pages', 'view=pages', 1, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, UUID()),
	(4, 2, 'Content', 'content', NULL, NULL, 1, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, UUID()),
	(5, 2, 'Files', 'files', 'files', 'view=files', 1, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, UUID()),
	(6, 2, 'Users', 'users', 'view=users', 1, 0, 0, 'users', 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, UUID()),
	(9, 2, 'Tools', 'tools', NULL, NULL, 1, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, UUID()),
	(10, 2, 'Activity Logs', 'activity-logs', 'activities', 'view=activities', 1, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, UUID()),
	(12, 2, 'Articles', 'articles', 'articles', 'view=articles', 1, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, UUID()),
	(14, 2, 'Languages', 'languages', 'languages', 'view=languages', 1, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, UUID()),
	(15, 2, 'Articles', 'articles', 'articles', 'view=articles', 1, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, UUID()),
	(16, 2, 'Categories', 'categories', 'articles', 'view=categories', 1, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, UUID()),
	(21, 2, 'Pages', 'pages', 'pages', 'view=pages', 1, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, UUID()),
	(22, 2, 'Menus', 'menus', 'pages', 'view=menus', 1, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, UUID()),
	(23, 2, 'Modules', 'modules', 'pages', 'view=modules', 1, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, UUID()),
	(24, 2, 'Users', 'users', 'users', 'view=users', 1, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, UUID()),
	(25, 2, 'Groups', 'groups', 'users', 'view=groups', 1, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, UUID()),
	(28, 2, 'Tags', 'tags', 'articles', 'view=tags', 1, 0, 0, 1, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, UUID());


--
-- Dumping data for table `files_containers`
--

INSERT INTO `files_containers` (`files_container_id`, `slug`, `title`, `path`, `parameters`, `uuid`)
VALUES
    (NULL, 'files-files', 'Files', 'files', '{"thumbnails": true,"maximum_size":"10485760","allowed_extensions": ["bmp", "csv", "doc", "gif", "ico", "jpg", "jpeg", "odg", "odp", "ods", "odt", "pdf", "png", "ppt", "swf", "txt", "xcf", "xls"],"allowed_mimetypes": ["image/jpeg", "image/gif", "image/png", "image/bmp", "application/x-shockwave-flash", "application/msword", "application/excel", "application/pdf", "application/powerpoint", "text/plain", "application/x-zip"],"allowed_media_usergroup":3}', UUID()),
	(NULL, 'attachments-attachments', 'Attachments', 'attachments', '{"thumbnails": false,"maximum_size":"10485760,allowed_extensions": ["bmp", "csv", "doc", "gif", "ico", "jpg", "jpeg", "odg", "odp", "ods", "odt", "pdf", "png", "ppt", "sql", "swf", "txt", "xcf", "xls"],"allowed_mimetypes": ["image/jpeg", "image/gif", "image/png", "image/bmp", "application/x-shockwave-flash", "application/msword", "application/excel", "application/pdf", "application/powerpoint", "text/plain", "application/x-zip"]}', UUID());
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_user_id`, `name`, `email`, `enabled`, `send_email`, `users_role_id`, `last_visited_on`, `created_by`, `created_on`, `modified_by`, `modified_on`, `locked_by`, `locked_on`, `activation`, `params`, `uuid`)
VALUES
	(1, 'Administrator', 'admin@localhost.home', 1, 1, 6, '', NULL, NULL, NULL, NULL, NOW(), '', '', '', UUID());

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_roles` (`users_role_id`, `name`, `title`, `description`)
VALUES
    (1, 'registered', 'Registered', ''),
    (2, 'author', 'Author', ''),
    (3, 'editor', 'Editor', ''),
    (4, 'publisher', 'Publisher', ''),
    (5, 'manager', 'Manager', ''),
    (6, 'administrator', 'Administrator', '');

--
-- Dumping data for table `passwords`
--

INSERT INTO `users_passwords` (`email`, `expiration`, `hash`, `token`) VALUES
('admin@localhost.home', NULL, '$2y$10$UT7uLipGnbJbTcjZ6D.OAeVByFn.2ZpPmd.thZ5e5xHLwKXAxdvNG', '');


SET SQL_MODE=@OLD_SQL_MODE;
SET TIME_ZONE=@OLD_TIME_ZONE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;