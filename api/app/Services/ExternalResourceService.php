<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

abstract class ExternalResourceService {
  private static $swapiUrl = 'http://swapi.dev';

  abstract public function extendResource(Array $resource): Array;

  public function changeUrl(?String $url): ?String {
    if (!$url) {
      return $url;
    }
    else {
      return str_replace(self::$swapiUrl, url('/'), $url);
    }
  }

  public function resourceIndex(String $uri): Array {
    $resources = $this->sendRequest($uri);
    $resources["next"] = $this->changeUrl($resources["next"]);
    $resources["previous"] = $this->changeUrl($resources["previous"]);
    foreach($resources["results"] as $index => $resource) {
      $resources["results"][$index] = $this->extendResource($resource);
    }
    return $resources;
  }
  
  public function showResource(String $uri): Array {
    $resource = self::sendRequest($uri);
    return $this->extendResource($resource);
  }

  public function getIdFromUrl(String $url): Int {
    $explodedUrl = explode('/', $url);
    $lastIndex = count($explodedUrl) - 1;
    if ($explodedUrl[$lastIndex] == '') {
      $id = $explodedUrl[$lastIndex - 1];
    }
    else {
      $id = $explodedUrl[$lastIndex];
    }
    return $id;
  }

  static public function sendRequest($uri): Array {
    $response = Http::get(self::$swapiUrl . $uri);
    if ($response->getStatusCode() == 200){
      return $response->json();
    }
    else {
      return abort($response->getStatusCode());
    }
  }
}