<?php
namespace Oaza\Asset;


use Assetic\Asset\AssetCache;
use Assetic\Asset\FileAsset;
use Assetic\Cache\FilesystemCache;
use Assetic\Filter\Yui;

class AssetsLoader extends \Oaza\Object
{
    const DEVELOPMENT='dev';
    const PRODUCTION='prod';

    const COFFEE = 0x001;
    const JAVASCRIPT = 0x010;
    const CSS = 0x100;

    private $mode;
    private $dirs;
    private $cacheDir;
    private $wwwDir;

    public function __construct($cacheDir="/tmp", $wwwDir=""){
        $this->cacheDir = $cacheDir;
        $this->wwwDir = $wwwDir;
    }

    public function addDirectory($type, $directory){
        if($type & self::COFFEE) {
            $this->dirs[self::COFFEE][] = $directory;
        }

        if( $type & self::JAVASCRIPT) {
            $this->dirs[self::JAVASCRIPT][] = $directory;
        }

        if( $type & self::CSS) {
            $this->dirs[self::CSS][] = $directory;
        }

    }

    public function setEnvironment($environment){
        $this->mode = $environment;
    }

    public function build(){
        if($this->mode == self::DEVELOPMENT) return;

        if(isset($this->dirs[self::COFFEE])) {
            \CoffeeScript\Init::load();

            foreach($this->dirs[self::COFFEE] as $file ){
                $coffeeCollection = new \Assetic\Asset\AssetCollection(
                    array(new \Assetic\Asset\GlobAsset($file)),
                    array(new \Oaza\Asset\Filter\PHPCoffeeScriptFilter())
                );

                $coffee = new AssetCache(
                    $coffeeCollection,
                    new FilesystemCache($this->cacheDir)
                );
            }
        }

        if(isset($this->dirs[self::CSS])) {
            foreach($this->dirs[self::CSS] as $file ){
                $coffeeCollection = new \Assetic\Asset\AssetCollection(
                    array(new \Assetic\Asset\GlobAsset($file)),
                    array(new \Assetic\Filter\CssMinFilter())
                );

                $css = new AssetCache(
                    $coffeeCollection,
                    new FilesystemCache($this->cacheDir)
                );
            }
        }

        if(isset($this->dirs[self::JAVASCRIPT])) {
            foreach($this->dirs[self::JAVASCRIPT] as $file ){
                $coffeeCollection = new \Assetic\Asset\AssetCollection(
                    array(new \Assetic\Asset\GlobAsset($file)),
                    array(new \Assetic\Filter\JSMinFilter())
                );

                $js = new AssetCache(
                    $coffeeCollection,
                    new FilesystemCache($this->cacheDir)
                );
            }
        }

        if(isset($js))
            file_put_contents("javascript.build.js", $js->dump());

        if(isset($coffee))
            file_put_contents("coffee.build.js", $coffee->dump());

        if(isset($css))
            file_put_contents("css.build.css", $css->dump());

    }

}
