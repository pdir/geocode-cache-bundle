<?php

namespace Pdir\GeoCodeCacheBundle\Tests;

use Pdir\GeoCodeCacheBundle\GeoCodeCacheBundle;
use PHPUnit\Framework\TestCase;

class PdirGeoCodeCacheBundleTest extends TestCase
{
    public function testCanBeInstantiated()
    {
        $bundle = new GeoCodeCacheBundle();

        $this->assertInstanceOf('Pdir\GeoCodeCacheBundle\GeoCodeCacheBundle', $bundle);
    }
}
