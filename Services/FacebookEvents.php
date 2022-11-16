<?php

namespace App\Models;

/* Facebook SDK */
use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\ServerSide\Content;
use FacebookAds\Object\ServerSide\CustomData;
use FacebookAds\Object\ServerSide\DeliveryCategory;
use FacebookAds\Object\ServerSide\Event;
use FacebookAds\Object\ServerSide\EventRequest;
use FacebookAds\Object\ServerSide\Gender;
use FacebookAds\Object\ServerSide\UserData;

/* IP Location */
use Stevebauman\Location\Facades\Location;

/* WeCommerce Models */
use Nowyouwerkn\WeCommerce\Models\StoreConfig;

/* Regular Laravel */
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Exception;
use Request;

class FacebookEvents
{   
    private $access_token;
    private $pixel_id;
    private $events;
    private $api;
    private $location;

    public function __construct()
    {
        // Configuración
        $config = StoreConfig::first();

        $this->access_token = $config->facebook_access_token;
        $this->pixel_id = $config->facebook_pixel;
        
        if (is_null($this->access_token) || is_null($this->pixel_id)) {
            throw Exception(
                'Debes definir el token de acceso y el ID del pixel en tu archivo de ambiente (.env) para ejecutar los eventos.'
            );
        }

        // Inicializar
        Api::init(null, null, $this->access_token);
        $this->api = Api::instance();
        $this->api->setLogger(new CurlLogger());

        $this->events = array();

        // IP
        $this->location = Location::get();
    }

    public function viewContent()
    {
        $user_data_0 = (new UserData())
        ->setClientIpAddress(Request::ip())
        ->setClientUserAgent(Request::header('user-agent'))
        ->setCity(Hash::make($this->location->cityName))
        ->setState(Hash::make($this->location->regionCode))
        ->setZipCode(Hash::make($this->location->zipCode))
        ->setCountryCode($this->location->countryCode);


        $event_0 = (new Event())
        ->setEventName("ViewContent")
        ->setEventTime(Carbon::now()->timestamp)
        ->setUserData($user_data_0)
        ->setActionSource("website")
        ->setEventSourceUrl(Request::url());

        array_push($this->events, $event_0);
        
        $request = (new EventRequest($this->pixel_id))
        ->setEvents($this->events);
        
        try {
            $request->execute();
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage() );
        }
    }

}