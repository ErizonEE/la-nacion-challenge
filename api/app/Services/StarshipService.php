<?php

namespace App\Services;
use App\Models\StarshipInventory;
use App\Services\ExternalResourceService;

class StarshipService extends ExternalResourceService {
  public function extendResource(Array $resource): Array {
    $resourceId = $this->getIdFromUrl($resource['url']);
    $resource['count'] = StarshipInventory::find($resourceId)->count ?? 0;
    $resource['url'] = $this->changeUrl($resource['url']);
    return $resource;
  }
}