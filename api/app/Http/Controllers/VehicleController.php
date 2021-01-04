<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateVehicleRequest;
use Illuminate\Http\Response;
use App\Services\VehicleService;
use App\Models\VehicleInventory;

class VehicleController extends Controller
{
    /**
     * Return vehicles collection
     * 
     * @OA\Get(
     *     path="/api/vehicles",
     *     tags={"Vehicles"},
     *     @OA\Response(
     *         response=200,
     *         description="Return vehicles collection"
     *     ),
     * )
     */
    public function index(VehicleService $service, Request $request): Response {
        return response($service->resourceIndex($request->getRequestUri()));
    }
    /**
     * Return specific vehicle data
     * @OA\Get(
     *      path="/api/vehicles/{id}",
     *      tags={"Vehicles"},
     *      description="Returns vehicle data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Vehicle id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful Operation"
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
    public function show(VehicleService $service, Request $request): Response {
        return response($service->showResource($request->getRequestUri()));
    }
    /**
     * Set count property in x
     * @OA\Post(
     *      path="/api/vehicles/{id}/set-counter",
     *      tags={"Vehicles"},
     *      description="Set count property",
     *      @OA\Parameter(
     *          name="id",
     *          description="Vehicle Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          description="Vehicle Inventory Number",
     *          required=true,
     *          @OA\JsonContent(
     *              required={"count"},
     *              @OA\Property(property="count", type="integer", example="100")
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful Operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=422, description="Invalidad Input"),
     * )
     */
    public function setCounter(Int $vehicleId, UpdateVehicleRequest $request, VehicleService $service): Response {
        $vehicle = VehicleInventory::firstOrNew(["vehicle_id" => $vehicleId]);
        $vehicle->count = $request->count;
        $vehicle->saveOrFail();
        return response('', 204);
    }
    /**
     * Increment count property in x
     * @OA\Post(
     *      path="/api/vehicles/{id}/increase-counter",
     *      tags={"Vehicles"},
     *      description="Increment count property for x",
     *      @OA\Parameter(
     *          name="id",
     *          description="Vehicle Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          description="Increment count property for x",
     *          required=true,
     *          @OA\JsonContent(
     *              required={"count"},
     *              @OA\Property(property="count", type="integer", example="100")
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful Operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=422, description="Invalidad Input"),
     * )
     */
    public function increaseCounter(Int $vehicleId, UpdateVehicleRequest $request, VehicleService $service): Response {
        $vehicle = VehicleInventory::firstOrNew(['vehicle_id' => $vehicleId]);
        $vehicle->count += $request->count;
        $vehicle->saveOrFail();
        return response('', 204);
    }
    /**
     * Decremente count property in x
     * @OA\Post(
     *      path="/api/vehicles/{id}/decrease-counter",
     *      tags={"Vehicles"},
     *      description="Decrease count property",
     *      @OA\Parameter(
     *          name="id",
     *          description="Vehicle Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          description="Decrement count property for x",
     *          required=true,
     *          @OA\JsonContent(
     *              required={"count"},
     *              @OA\Property(property="count", type="integer", example="100")
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful Operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=422, description="Invalidad Input"),
     * )
     */
    public function decreaseCounter(Int $vehicleId, UpdateVehicleRequest $request, VehicleService $service): Response {
        $vehicle = VehicleInventory::firstOrNew(['vehicle_id' => $vehicleId]);
        $newCount = $vehicle->count - $request->count;
        $vehicle->count = $newCount >= 0 ? $newCount : 0;
        $vehicle->saveOrFail();
        return response('', 204);
    }
    
}
