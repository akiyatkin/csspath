<?php
use infrajs\ans\Ans;
use infrajs\load\Load;
use infrajs\path\Path;
use infrajs\router\Router;

if (!is_file('vendor/autoload.php')) {
	chdir('../../../');
	require_once('vendor/autoload.php');
	Router::init();
}
$ans = array(); 
$src = Ans::GET('src','string');

if (!$src) return Ans::err($ans, 'Требуется параметр src');

$src = Path::theme($src);

if (!$src) return Ans::err($ans, 'Не найден путь');


$css = Load::loadTEXT($src);


$fd = Load::srcinfo($src);
$folder = $fd['folder'];
$r = explode('/', $folder);


array_pop($r);
array_pop($r);
$foldertop = implode('/', $r);
if ($foldertop) $foldertop=$foldertop.'/';

//bootstrap
$css = str_replace('../', '/'.$foldertop, $css);

//У flexslider путь такой - src: url('fonts/flexslider-icon.eot');
$css = str_replace('url(\'fonts/', 'url(\'/'.$folder.'fonts/', $css);


return Ans::css($css);
