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
$folder = implode('/', $r);
if ($folder) $folder=$folder.'/';

$css = str_replace('../', '/'.$folder, $css);


return Ans::css($css);
