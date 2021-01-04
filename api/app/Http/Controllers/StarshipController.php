<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateStarshipRequest;
use Illuminate\Http\Response;
use App\Services\StarshipService;
use App\Models\StarshipInventory;

class StarshipController extends Controller
{
    /**
     * Return starships collection
     * 
     * @OA\Get(
     *     path="/api/starships",
     *     tags={"Starships"},
     *     @OA\Response(
     *         response=200,
     *         description="Return starships collection"
     *     ),
     * )
     */
    public function index(StarshipService $service, Request $request): Response {
        return response($service->resourceIndex($request->getRequestUri()));
    }
    /**
     *  Return specefic starship data
     * @OA\Get(
     *      path="/api/starships/{id}",
     *      operationId="getStarshipById",
     *      tags={"Starships"},
     *      description="Returns starship data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Starship id",
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
    public function show(StarshipService $service, Request $request): Response {
        return response($service->showResource($request->getRequestUri()));
    }
    /**
     * Set count property in x
     * @OA\Post(
     *      path="/api/starships/{id}/set-counter",
     *      operationId="setCounter",
     *      tags={"Starships"},
     *      description="Set count property",
     *      @OA\Parameter(
     *          name="id",
     *          description="Starship Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          description="Starship Inventory Number",
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
     *      @OA\Response(response=422, description="Invalidad Input", @OA\JsonContent()),
     * )
     */
    public function setCounter(Int $starshipId, UpdateStarshipRequest $request, StarshipService $service): Response {
        $starship = StarshipInventory::firstOrNew(["starship_id" => $starshipId]);
        $starship->count = $request->count;
        $starship->saveOrFail();
        return response('', 204);
    }
    /**
     * Increment count property in x
     * @OA\Post(
     *      path="/api/starships/{id}/increase-counter",
     *      operationId="increaseCounter",
     *      tags={"Starships"},
     *      description="increment count property for x",
     *      @OA\Parameter(
     *          name="id",
     *          description="Starship Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          description="Number for increase inventory number",
     *          required=true,
     *          @OA\JsonContent(
     *              required={"count"},
     *              @OA\Property(property="count", type="integer", example="10")
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
    public function increaseCounter(Int $starshipId, UpdateStarshipRequest $request, StarshipService $service): Response {
        $starship = StarshipInventory::firstOrNew(['starship_id' => $starshipId]);
        $starship->count += $request->count;
        $starship->saveOrFail();
        return response('', 204);
    }
    /**
     * Decremente counte property in x
     * @OA\Post(
     *      path="/api/starships/{id}/decrease-counter",
     *      operationId="decreaseCounter",
     *      tags={"Starships"},
     *      description="decrement count property for x",
     *      @OA\Parameter(
     *          name="id",
     *          description="Starship Id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          description="Number for decrease inventory number",
     *          required=true,
     *          @OA\JsonContent(
     *              required={"count"},
     *              @OA\Property(property="count", type="integer", example="10")
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
    public function decreaseCounter(Int $starshipId, UpdateStarshipRequest $request, StarshipService $service): Response {
        $starship = StarshipInventory::firstOrNew(['starship_id' => $starshipId]);
        $newCount = $starship->count - $request->count;
        $starship->count = $newCount >= 0 ? $newCount : 0;
        $starship->saveOrFail();
        return response('', 204);
    }
}
