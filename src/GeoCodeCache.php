<?php
/**
 * Geo Code Cache
 * Cache extension for dlh_geocode by Christian de la Haye
 *
 * Copyright (c) 2017 pdir / digital agentur
 *
 * @package pdir_geocode_cache
 * @author  Mathias Arzberger <develop@pdir.de>
 * @link    https://pdir.de
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace Pdir\GeoCodeCacheBundle;

/**
 * Class GeoCodeCache
 *
 * Extends the GeoCode Class [dlh_geocode] to load latlng from cache if exists
 * @copyright  2017 pdir / digital agentur
 * @author  Mathias Arzberger <develop@pdir.de>
 * @package    geocode_cache
 */
class GeoCodeCache extends \delahaye\GeoCode
{
    /**
     * Name of the current table
     * @var string
     */
    protected static $strTable = 'tl_geocode_cache';

    /**
     * Get geo coordinates from an address from cache or google maps
     * @param string
     * @param string
     * @param string
     * @return string
     */
    public static function getCoordinates($strAddress, $strCountry = 'de', $strLang = 'de')
    {
        if ($strAddress)
        {
            // get coordinates from cache table
            $arrCoords = self::getCoordinatesFromCache( implode(",", array($strAddress, $strCountry, $strLang)) );

            if($arrCoords)
            {
                return $arrCoords['lat'] . ',' . $arrCoords['lng'];
            }

            // load from google / default code by Christian de la Haye
            $arrCoords = self::getInstance()->geoCode($strAddress, null, $strLang, $strCountry);

            if($arrCoords)
            {
                $strValue = $arrCoords['lat'] . ',' . $arrCoords['lng'];
            }
            elseif(function_exists("curl_init"))
            {
                $strValue = self::geoCodeCurl($strAddress, $strCountry);
            }
            // end load from google / default code by Christian de la Haye

            // write coordinates to cache table
            if($strValue != '')
                self::setCoordinatesToCache( implode(",", array($strAddress, $strCountry, $strLang)), $strValue );
        }
        return $strValue==',' ? '' : $strValue;
    }

    /**
     * Check if geo coordinates exists in cache and return lat/lng
     * @param string
     * @return array or string
     */
    protected function getCoordinatesFromCache($strAddress)
    {
        $arrCor = array();
        $objCor = \Database::getInstance()->prepare("SELECT * FROM " . static::$strTable . " WHERE addr LIKE ? LIMIT 1")->execute($strAddress);

        if($objCor->numRows > 0) {
            while ($objCor->next()) {
                $arrCor = array
                (
                    'lat' => $objCor->lat,
                    'lng' => $objCor->lng
                );
            }
            return $arrCor;
        }

        return;
    }

    /**
     * Write address and lat/lng to cache table
     * @param string
     * @param string
     * @param string
     * @return nothing
     */
    protected function setCoordinatesToCache($strAddress, $strLatLng)
    {
        $arrCor = explode(',', $strLatLng);
        $set = array('tstamp' => time(), 'addr' => $strAddress, 'lat' => $arrCor[0], 'lng' => $arrCor[1]);

        \Database::getInstance()->prepare("INSERT INTO " . static::$strTable . " %s")->set($set)->execute();
        return;
    }
}
