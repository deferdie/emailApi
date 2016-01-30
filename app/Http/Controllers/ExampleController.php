<?php

namespace App\Http\Controllers;
use App\Tracking;
class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(){
      $email = $_GET['email'];
      $campaing = $_GET['emailCamp'];
      $destination = $_GET['dest'];
      $ip = $_SERVER['REMOTE_ADDR'];
      //$ip = "86.161.40.39";
      //$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
      $details = json_decode(file_get_contents("http://api.ipinfodb.com/v3/ip-city/?key=53fb9f85f47ee2301ed4659792ec690c0813cd187751f6d5639a9b11058bbddd&ip=$ip&format=json"));

      $storeTracking = new Tracking();
      $storeTracking->IP = $ip;
      $storeTracking->email = $email;
      $storeTracking->dest = $destination;
      $storeTracking->geoLocation = $details->cityName;
      $storeTracking->region = $details->countryName;
      $storeTracking->postal = $details->zipCode;
      $storeTracking->camp = $campaing;
      $storeTracking->save();

      header("Location: http://$destination/");

    }

    //
}
