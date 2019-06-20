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
 * Register the classes
 */
ClassLoader::addClasses(array
(
    // Classes
    'Pdir\GeoCodeCache\GeoCodeCache'    => 'system/modules/geocode_cache/Classes/GeoCodeCache.php',
    'Pdir\GeoCodeCache\Automator'       => 'system/modules/geocode_cache/Classes/Automator.php',
));