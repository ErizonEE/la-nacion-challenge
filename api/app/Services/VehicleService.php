<?php

namespace App\Services;
use App\Models\VehicleInventory;
use App\Services\ExternalResourceService;

class VehicleService extends ExternalResourceService {
  public function extendResource(Array $resource): Array {
    $resourceId = $this->getIdFromUrl($resource['url']);
    $resource['count'] = VehicleInventory::find($resourceId)->count ?? 0;
    $resource['url'] = $this->changeUrl($resource['url']);
    return $resource;
  }
}