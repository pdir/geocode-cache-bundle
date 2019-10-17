<?php

/*
 * GeoCode cache bundle for Contao Open Source CMS
 *
 * Copyright (c) 2019 pdir / digital agentur // pdir GmbH
 *
 * @package    geocode-cache-bundle
 * @link       https://pdir.de
 * @license    LGPL-3.0+
 * @author     Mathias Arzberger <develop@pdir.de>
 * @author     Philipp Seibt <develop@pdir.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Pdir\GeoCodeCacheBundle\Tests;

use Pdir\GeoCodeCacheBundle\PdirGeoCodeCacheBundle;
use PHPUnit\Framework\TestCase;

class PdirGeoCodeCacheBundleTest extends TestCase
{
    public function testCanBeInstantiated()
    {
        $bundle = new PdirGeoCodeCacheBundle();

        $this->assertInstanceOf('Pdir\GeoCodeCacheBundle\PdirGeoCodeCacheBundle', $bundle);
    }
}
