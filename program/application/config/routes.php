<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "backend";
$route['404_override'] = '';
// $route['/(:any)'] = "blogs/detail/$1";

$route['area-komersial/sub/proyek/(:any)'] = "komersial/sub_proyek/$1";
$route['area-komersial/sub/(:any)'] = "komersial/sub_page/$1";
$route['hubungi-kami'] = "hubungi_kami";
$route['investor-relation'] = "investor_relation";
$route['area-komersial'] = "komersial/area_komersial";
$route['area-komersial/(:any)'] = "komersial/page/$1";
$route['warta-acara'] = "warta_acara";
$route['warta-acara/detail/(:any)'] = "warta_acara/detail/$1";
$route['prestasi-apresiasi'] = "prestasi_apresiasi";
$route['prestasi-apresiasi/detail/(:any)'] = "prestasi_apresiasi/detail/$1";
$route['tentang-kbp/visi-misi'] = "tentang_kbp/visi_misi";
$route['tentang-kbp/konsep'] = "tentang_kbp/konsep";
$route['tentang-kbp/master-plan'] = "tentang_kbp/master_plan";
$route['tentang-kbp/group-lyman'] = "tentang_kbp/group_lyman";
$route['hunian/master-plan'] = "hunian/master_plan";
$route['fasilitas/master-plan'] = "fasilitas/master_plan";
$route['komersial/master-plan'] = "komersial/master_plan";
$route['search'] = "search";
$route['search/result/(:any)'] = "search/result/$1";
/*$route['page'] = "pages/page";
$route['pages/(:any)'] = "pages/index/$1";
$route['pages'] = "pages/index";
$route['pages/sub/(:any)'] = "pages/sub/$1";
$route['pages/sub'] = "pages/sub";*/
//$route['vision_mision'] = "company/vision_mision";
//$route['why'] = "company/why";

/* IHKTISAR */
$route['ikhtiar/(:any)'] = "pages/investasi/$1";
/* TENTANG KAMI */
$route['tentang-kami/filosofi/(:any)'] = "pages/filosofi/$1";
$route['tentang-kami'] = "pages/pbmt/tentang-kami";
$route['tentang-kami/managemen/(:any)'] = "pages/tentangkami/$1";
/* End of file routes.php */
/* Location: ./application/config/routes.php */
