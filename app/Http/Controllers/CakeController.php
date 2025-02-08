<?php

namespace App\Http\Controllers;

use App\Models\Cake;
use App\Http\Resources\CakeResource;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCakeRequest;

class CakeController extends Controller
{
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return CakeResource::collection(Cake::all());
    }

    public function store(StoreCakeRequest $request): CakeResource
    {
        $cake = Cake::create($request->validated());
        return new CakeResource($cake);
    }

    public function show(Cake $cake): CakeResource
    {
        return new CakeResource($cake);
    }

    public function update(StoreCakeRequest $request, Cake $cake): CakeResource
    {
        $cake->update($request->validated());
        return new CakeResource($cake);
    }

    public function destroy(Cake $cake): \Illuminate\Http\Response
    {
        $cake->delete();
        return response()->noContent();
    }
}
