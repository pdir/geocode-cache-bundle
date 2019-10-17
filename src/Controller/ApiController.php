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

namespace Pdir\GeoCodeCacheBundle\Controller;

use Contao\System;
use Pdir\GeoCodeCacheBundle\GeoCodeCache;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * ApiController provides all routes.
 *
 * @Route("/api", defaults={"_scope" = "frontend", "_token_check" = false})
 */
class ApiController extends Controller
{
    /**
     * @Route("/geocode/{address}", name="pdir_api_geocode")
     *
     * @param Request $request Current request
     * @param string  $address Address to geocode
     *
     * @return Response
     */
    public function geocodeAction(Request $request, $address)
    {
        $cacheTime = System::getContainer()->getParameter('pdir_gcb_cache_time');

        // get coordinates from cache table or api
        $arrCoords = GeoCodeCache::getCoordinates($address);

        $response = new Response(json_encode($arrCoords), 200);

        $response->setPublic();
        $response->setExpires(new \DateTime('+'.$cacheTime ? $cacheTime : '1 hour'));
        $response->setLastModified(new \DateTime('-'.$cacheTime ? $cacheTime : '1 hour'));

        return $response;
    }
}
