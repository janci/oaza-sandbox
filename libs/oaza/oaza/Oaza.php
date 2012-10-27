<?php
/**
 * This file is part of the Oaza Framework
 *
 * Copyright (c) 2012 Jan Svantner (http://www.janci.net)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace Oaza;

use Oaza\Asset\AssetsLoader;

/**
 * Oaza framework service
 */
class Oaza extends Object
{
    /** @var string */
    private $oazaRootdir;

    /** @var string */
    private $oazaPublicDir;

    /** @var \Oaza\Asset\AssetsLoader */
    private $assetLoader;


    public function __construct(){
         $this->oazaRootdir = dirname(dirname(__FILE__));
         $this->oazaPublicDir = $this->oazaRootdir.DIRECTORY_SEPARATOR."public";

         $tmpDir = $this->oazaRootdir.DIRECTORY_SEPARATOR."temp";
         $cacheDir = $tmpDir.DIRECTORY_SEPARATOR."cache";

         if(!file_exists($tmpDir)) mkdir($tmpDir);
         if(!file_exists($cacheDir)) mkdir($cacheDir);

         $this->assetLoader = new AssetsLoader($cacheDir);
    }

    /**
     * Load javascript and cascades styles for Oaza framework
     */
    public function registerExternalSources(){

        $ds = DIRECTORY_SEPARATOR;
        $this->assetLoader->addDirectory(AssetsLoader::COFFEE, $this->oazaPublicDir."{$ds}coffee{$ds}*.coffee");
        $this->assetLoader->build();
    }

}