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

/**
 * Run in a custom namespace, so the class can be replaced.
 */

namespace Pdir\GeoCodeCacheBundle;

use Contao\System;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

/**
 * Class GeoCodeCache.
 *
 * Extends the GeoCode Class [dlh_geocode] to load latlng from cache if exists
 *
 * @copyright  2017 pdir / digital agentur
 * @author  Mathias Arzberger <develop@pdir.de>
 */
class GeoCodeCache
{
    /**
     * Name of the current table.
     *
     * @var string
     */
    protected static $strTable = 'tl_geocode_cache';

    /**
     * Get geo coordinates from an address from cache or google maps.
     *
     * @param string
     * @param string
     * @param string
     * @param mixed $strAddress
     *
     * @return string
     */
    public static function getCoordinates($strAddress)
    {
        if ($strAddress) {
            // get coordinates from cache table
            $arrCoords = self::getCoordinatesFromCache(implode(',', [$strAddress]));

            if ($arrCoords) {
                return $arrCoords;
            }

            $apiKey = System::getContainer()->getParameter('pdir_gcb_opengage_api_key');

            if (!$apiKey) {
                throw new ResourceNotFoundException(sprintf('The Opengage API key is not set.'));
            }

            $geocoder = new \OpenCage\Geocoder\Geocoder($apiKey);
            $result = $geocoder->geocode($strAddress);

            if ($result && $result['total_results'] > 0) {
                $arrCoords = $result['results'][0]['geometry'];
            }

            // write coordinates to cache table
            if ($arrCoords) {
                self::setCoordinatesToCache(implode(',', [$strAddress]), $arrCoords);
            }
        }

        return $arrCoords;
    }

    /**
     * Check if geo coordinates exists in cache and return lat/lng.
     *
     * @param string
     * @param mixed $strAddress
     *
     * @return array or string
     */
    protected function getCoordinatesFromCache($strAddress)
    {
        $arrCor = [];
        $objCor = \Database::getInstance()->prepare('SELECT * FROM '.static::$strTable.' WHERE addr LIKE ? LIMIT 1')->execute($strAddress);

        if ($objCor->numRows > 0) {
            while ($objCor->next()) {
                $arrCor = [
                    'lat' => $objCor->lat,
                    'lng' => $objCor->lng,
                ];
            }

            return $arrCor;
        }

        return null;
    }

    /**
     * Write address and lat/lng to cache table.
     *
     * @param string
     * @param string
     * @param string
     * @param mixed $strAddress
     * @param mixed $arrCoords
     *
     * @return nothing
     */
    protected function setCoordinatesToCache($strAddress, $arrCoords)
    {
        $set = ['tstamp' => time(), 'addr' => $strAddress, 'lat' => $arrCoords['lat'], 'lng' => $arrCoords['lng']];

        \Database::getInstance()->prepare('INSERT INTO '.static::$strTable.' %s')->set($set)->execute();
    }
}
