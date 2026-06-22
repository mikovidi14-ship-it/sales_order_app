<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login']='auth';
$route['login/proses']='auth/login';
$route['logout']='auth/logout';

// Sales Order routes
$route['dashboard'] = 'dashboard';
$route['produk'] = 'produk';
$route['produk/tambah'] = 'produk/tambah';
$route['produk/simpan'] = 'produk/simpan';
$route['produk/edit/(:num)'] = 'produk/edit/$1';
$route['produk/update/(:num)'] = 'produk/update/$1';
$route['produk/hapus/(:num)'] = 'produk/hapus/$1';

$route['pelanggan'] = 'pelanggan';
$route['pelanggan/tambah'] = 'pelanggan/tambah';
$route['pelanggan/simpan'] = 'pelanggan/simpan';
$route['pelanggan/edit/(:num)'] = 'pelanggan/edit/$1';
$route['pelanggan/update/(:num)'] = 'pelanggan/update/$1';
$route['pelanggan/hapus/(:num)'] = 'pelanggan/hapus/$1';

$route['sales_order'] = 'sales_order';
$route['sales_order/tambah'] = 'sales_order/tambah';
$route['sales_order/simpan'] = 'sales_order/simpan';
$route['sales_order/detail/(:num)'] = 'sales_order/detail/$1';
$route['sales_order/edit/(:num)'] = 'sales_order/edit/$1';
$route['sales_order/update/(:num)'] = 'sales_order/update/$1';
$route['sales_order/update_status/(:num)'] = 'sales_order/update_status/$1';
$route['sales_order/hapus/(:num)'] = 'sales_order/hapus/$1';
$route['sales_order/get_harga/(:num)'] = 'sales_order/get_harga/$1';

$route['laporan'] = 'laporan/penjualan';
$route['laporan/penjualan'] = 'laporan/penjualan';
$route['laporan/cetak_pdf'] = 'laporan/cetak_pdf';
