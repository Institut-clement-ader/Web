<?php
/*
Plugin Name: jQuery in Posts, Pages, Custom Post Types
Description: Want to use specific jQuery or Javascript for each page? Just install it.
Plugin URI: https://codecanyon.net/item/custom-styles-and-scripts/14322786?ref=WebCodingPlace
Author: WebCodingPlace
Author URI: http://webcodingplace.com
Version: 4.0
License: GPL2
Text Domain: wcp-jquery
*/

/*

    Copyright (C) 2015  Rameez  rameez.iqbal@live.com

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
*/
require_once('plugin.class.php');

	if( class_exists('jQuery_in_Posts_Pages')){
		
		$wcp_jquery = new jQuery_in_Posts_Pages;
	}

?>