<?php

namespace Pdir\GeoCodeCacheBundle\Controller;

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
     * @return Response
     *
     * @Route("/geocode/{address}", name="pdir_api_geocode")
     *
     * @param Request $request Current request
     */
    public function geocodeAction(Request $request, $address)
    {
        // get coordinates from cache table or api
        $arrCoords = GeoCodeCache::getCoordinates($address);

        return new Response(json_encode($arrCoords), 200);
    }
}
