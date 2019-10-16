GeoCode Bundle extension for Contao 4
============================================================

[![Latest Stable Version](https://poser.pugx.org/pdir/geocode-cache-bundle/v/stable)](https://packagist.org/packages/pdir/geocode-cache-bundle)
[![Total Downloads](https://poser.pugx.org/pdir/geocode-cache-bundle/downloads)](https://packagist.org/packages/pdir/geocode-cache-bundle)
[![License](https://poser.pugx.org/pdir/geocode-cache-bundle/license)](https://packagist.org/packages/pdir/geocode-cache-bundle)

About
-----

The extension adds a new route */api/geocode/* to Contao and determines the latitude and longitude of an address.
As a service, the OpenCage geocoder is used. 2000 requests per day are free - see https://opencagedata.com/pricing.  
All requests are stored in a database table.

**Deutsch**

Die Erweiterung fügt eine neue Route api/geocode zu Contao hinzu und ermittelt die Latitude und Longitude Angaben einer Adresse. 
Als Dienst wird der OpenCage Geocoder verwendet. 2000 Anfrage pro Tag sind frei - see https://opencagedata.com/pricing.  
Alle Anfragen werden in einer Datenbanktabelle gespeichert.

Example
-------
Calling https://example.org/api/geocode/Ringstraße+9+28309+Bremen returns the following Json:
    
    { "lat": "53.0529439", "lng": "8.887199"}

Set API key
-------------------
app/config/parameters.yml

    parameters:    
        pdir_gcb_opengage_api_key: INSERT_YOUR_OPENCAGE_API_KEY_HERE

System requirements
-------------------

* [Contao 4.0](https://github.com/contao/contao-bundle) or higher

Installation & Configuration
----------------------------
* [Dokumentation](https://docs.pdir.de/#/geocode-cache-bundle/index)


Dependencies
------------

- [opencage/geocode](https://github.com/opencagedata/php-opencage-geocode)

License
-------
GNU Lesser General Public License v3.0
