<?php

namespace Oaza\Asset\Filter;

use Assetic\Asset\AssetInterface;

class PHPCoffeeScriptFilter implements \Assetic\Filter\FilterInterface
{

    /**
     * Filters an asset after it has been loaded.
     *
     * @param AssetInterface $asset An asset
     */
    public function filterLoad(AssetInterface $asset)
    {

    }

    /**
     * Filters an asset just before it's dumped.
     *
     * @param AssetInterface $asset An asset
     */
    public function filterDump(AssetInterface $asset)
    {
        $asset->setContent( \CoffeeScript\Compiler::compile($asset->getContent()) );
    }
}
