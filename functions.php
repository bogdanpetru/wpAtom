<?php

$dh = opendir(dirname(__FILE__).'/inc');

while (false !== ($file = readdir($dh))) {
	if ($file != '.' && $file != '..' && preg_match('/.+\.php$/',$file)) {
		require_once dirname(__FILE__).'/inc/'.$file;
	}
}
