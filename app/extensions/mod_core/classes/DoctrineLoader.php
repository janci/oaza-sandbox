<?php
namespace OazaCMS\Helpers;

use Nette\Utils\Finder;

class DoctrineLoader
{
    public static function getDirectories() {
        $files = Finder::findFiles('*.dcm.yml')->from(APP_DIR);
        $dirs = array();
        foreach($files as $file) $dirs[dirname($file)] = dirname($file);
        return array_keys($dirs);
    }

}