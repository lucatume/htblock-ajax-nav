<?php
/**
 * Plugin Name: AJAX Nav Block
 * Plugin URI:  http://theaveragedev.com
 * Description: Adds an AJAX-based navigation block to Headway visual theme editor
 * Version:     0.1.0
 * Author:      theAverageDev (Luca Tumedei)
 * Author URI:  http://theaveragedev.com
 * License:     GPLv2+
 * Text Domain: ajaxnav
 * Domain Path: /languages
 */

/**
 * Copyright (c) 2014 theAverageDev (Luca Tumedei) (email : luca@theaveragedev.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful, * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

// Useful global constants
define('AJAXNAV_BLOCK_VERSION', '0.1.0');
define('AJAXNAV_BLOCK_URL', plugin_dir_url(__FILE__));
define('AJAXNAV_BLOCK_PATH', dirname(__FILE__) . '/');
// Include the class loader if it's not defined already
if (!class_exists('jwage\SplClassLoader')) {
    require_once dirname(__FILE__) . '/includes/jwage/SplClassLoader.php';
}
// Add all the folders in the includes folder to autoloading
foreach (glob(dirname(__FILE__) . '/includes/*', GLOB_ONLYDIR) as $folderPath) {
    $folderName = basename($folderPath);
    $classLoader = new \jwage\SplClassLoader($folderName, dirname(__FILE__) . '/includes');
    $classLoader->register();
}
// boostrap the block
new \ajaxnav\Main();
