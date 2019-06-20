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
namespace Pdir\GeoCodeCacheBundle\Controller;

/**
 * Class GeoCodeCache
 *
 * Extends the GeoCode Class [dlh_geocode] to load latlng from cache if exists
 * @copyright  2017 pdir / digital agentur
 * @author  Mathias Arzberger <develop@pdir.de>
 * @package geocode_cache
 */
class Automator extends \Controller
{
    /**
     * Name of the current table
     * @var string
     */
    protected static $strTable = 'tl_geocode_cache';

    /**
     * Purge the coordinates cache
     */
    public function purge()
    {
        \Database::getInstance()->query("TRUNCATE " . static::$strTable);

        \System::log('Purged coordinates cache', __METHOD__, TL_INFO);
    }

    /**
     * Remove coordinates older than 60 days
     */
    public function deleteOldCoordinates()
    {
        \Database::getInstance()->prepare("DELETE FROM " . static::$strTable . " WHERE tstamp<?")
            ->execute(time() - 68400 * 1);

        \System::log('Deleted coordinates older than 60 days', __METHOD__, TL_CRON);
    }
}
