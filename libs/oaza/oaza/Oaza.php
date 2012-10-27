<?php
namespace Oaza;

use Oaza\Asset\AssetsLoader;
class Oaza extends Object
{
    private $oazaRootdir;
    private $oazaPublicDir;
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

    public function registerExternalSources(){

        $ds = DIRECTORY_SEPARATOR;
        $this->assetLoader->addDirectory(AssetsLoader::COFFEE, $this->oazaPublicDir."{$ds}coffee{$ds}*.coffee");
        $this->assetLoader->build();
    }

}