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
 * Allow to delete the cache in maintenance module
 */
$GLOBALS['TL_PURGE']['tables']['tl_geocode_cache'] = array(
    'callback'  => array('Pdir\GeoCodeCache\Controller\Automator', 'purge'),
    'affected'  => array('tl_geocode_cache'),
);

/**
 * Hooks
 */
//if (!class_exists(Pdir\Contao\GeoCodeCache)) {

//}

/**
 * Cron Jobs
 */
$GLOBALS['TL_CRON']['daily'][] = array('Pdir\GeoCodeCache\Controller\Automator', 'deleteOldCoordinates');
