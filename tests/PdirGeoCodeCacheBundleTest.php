<?php

namespace Pdir\GeoCodeCache\Tests;

use Pdir\GeoCodeCache\GeoCodeCacheBundle;
use PHPUnit\Framework\TestCase;

class PdirGeoCodeCacheBundleTest extends TestCase
{
    public function testCanBeInstantiated()
    {
        $bundle = new GeoCodeCacheBundle();

        $this->assertInstanceOf('Pdir\GeoCodeCache\GeoCodeCacheBundle', $bundle);
    }
}
