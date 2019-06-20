<?php

namespace Pdir\GeoCodeCache\Controller;

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
    public function geocodeAction(Request $request)
    {
        // get coordinates from cache table or api
        $arrCoords = [
            'lat' => 123,
            'lng' => 456
        ];

        return new Response(json_encode($arrCoords), 200);
    }
}
