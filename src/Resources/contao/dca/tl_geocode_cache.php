<?php

$GLOBALS['TL_DCA']['tl_geocode_cache'] = array
(
    'config' => array(
        'dataContainer'         => 'Table',
        'enableVersioning'      => false,
        'sql'                   => array
        (
            'keys' => array
            (
                'id'            => 'primary',
            )
        ),
    ),
    'list' => array
    (
        'sorting' => array
        (
            'mode'        => 2,
            'fields'      => array('sorting'),
            'flag'        => 11,
            'disableGrouping' => true,
            'panelLayout' => 'sort'
        ),
        'label'             => array
        (
            'fields'            => array('region'),
            'format'            => '%s',
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'         => &$GLOBALS['TL_LANG']['tl_geocode_cache']['edit'],
                'href'          => 'act=edit',
                'icon'          => 'edit.gif'
            ),
            'delete' => array
            (
                'label'         => &$GLOBALS['TL_LANG']['tl_geocode_cache']['delete'],
                'href'          => 'act=delete',
                'icon'          => 'delete.gif',
                'attributes'    => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
            ),
            'show' => array
            (
                'label'         => &$GLOBALS['TL_LANG']['tl_geocode_cache']['show'],
                'href'          => 'act=show',
                'icon'          => 'show.gif'
            )
        ),
    ),
    'palettes'=> array
    (
        'default'               => 'addr,lat,lng',
    ),
    'subpalettes'=> array
    (
    ),
    'fields' => array
    (
        'id' => array
        (
            'sql'               => "int(10) unsigned NOT NULL auto_increment"
        ),
        'tstamp' => array
        (
            'sql'                 => "int(10) unsigned NOT NULL default '0'"
        ),
        'addr' => array
        (
            'label'             => &$GLOBALS['TL_LANG']['tl_geocode_cache']['addr'],
            'inputType'         => 'text',
            'sorting'             => true,
            'flag'                => 1,
            'eval'              => array(
                'mandatory'         => true,
                'maxlength'         => 128,
                'tl_class'          => 'w50'
            ),
            'sql'               => "varchar(128) NOT NULL default ''"
        ),
        'lat' => array
        (
            'exclude'           => true,
            'label'             => &$GLOBALS['TL_LANG']['tl_geocode_cache']['lat'],
            'inputType'         => 'text',
            'eval'              => array(
                'doNotCopy'         => true,
                'tl_class'          => 'w50',
            ),
            'sql'               => "double NOT NULL"
        ),
        'lng' => array
        (
            'exclude'           => true,
            'label'             => &$GLOBALS['TL_LANG']['tl_geocode_cache']['lng'],
            'inputType'         => 'text',
            'eval'              => array(
                'doNotCopy'         => true,
                'tl_class'          => 'w50',
            ),
            'sql'               => "double NOT NULL"
        ),
    )
);
