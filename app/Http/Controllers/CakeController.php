<?php

namespace App\Http\Controllers;

use App\Models\Cake;
use App\Http\Resources\CakeResource;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCakeRequest;

class CakeController extends Controller
{
    public function index()
    {
        return CakeResource::collection(Cake::all());
    }

    public function store(StoreCakeRequest $request)
    {
        $cake = Cake::create($request->validated());
        return new CakeResource($cake);
    }

    public function show(Cake $cake)
    {
        return new CakeResource($cake);
    }

    public function update(StoreCakeRequest $request, Cake $cake)
    {
        $cake->update($request->validated());
        return new CakeResource($cake);
    }

    public function destroy(Cake $cake)
    {
        $cake->delete();
        return response()->noContent();
    }
}