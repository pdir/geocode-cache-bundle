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

namespace Pdir\GeoCodeCacheBundle\Controller;

/**
 * Class GeoCodeCache.
 *
 * Extends the GeoCode Class [dlh_geocode] to load latlng from cache if exists
 *
 * @copyright  2017 pdir / digital agentur
 * @author  Mathias Arzberger <develop@pdir.de>
 */
class Automator
{
    /**
     * Name of the current table.
     *
     * @var string
     */
    protected static $strTable = 'tl_geocode_cache';

    /**
     * Purge the coordinates cache.
     */
    public function purge()
    {
        \Database::getInstance()->query('TRUNCATE '.static::$strTable);

        //\Contao\System::log('Purged coordinates cache', __METHOD__, TL_INFO);
    }

    /**
     * Remove coordinates older than 60 days.
     */
    public function deleteOldCoordinates()
    {
        \Database::getInstance()->prepare('DELETE FROM '.static::$strTable.' WHERE tstamp<?')
            ->execute(time() - 68400 * 1);

        //\Contao\System::log('Deleted coordinates older than 60 days', __METHOD__, TL_CRON);
    }
}
