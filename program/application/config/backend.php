<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
**KEY untuk menambahkan keamana password
*/
$config["en_encryption_key"] = "LOADKICKASS****!!";

/*
 * Max login
 */
$config['max_login'] = 3;

/*
 * Jumlah jam untuk buka kunci (bisa login kembali)
 */
$config['en_hours'] = 5;

/*
 * Type untuk user
 */
$config['role_dev'] = 1;//Developer (Bisa menambah admin dll)
$config['role_com'] = 2;//Admin (Hanya bisa merubah kontent)
$config['role_eng'] = 3;//Admin (Hanya bisa merubah kontent)

/*
 * Session name
 */
$config['en_cookie_prefix'] = "backend_";

/*
 * Dir upload
 */
$config['dir_client'] = "clients/";
