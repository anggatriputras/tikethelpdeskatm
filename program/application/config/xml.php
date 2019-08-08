<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
**Nama url untuk cms
**Format folder untuk cms : application/modules/backend
*/
$config['cms_url']	= "backend/";

/*
**KEY untuk menambahkan keamana password
*/
$config["encryption_key"] = "LOAD2013!!";
$config["generate_token_key"] = "loadkickass!!";

/*
 * Mengijinkan htaccess berjalan pada applikasi ini
 */
$config['allow_htaccess'] = TRUE;
