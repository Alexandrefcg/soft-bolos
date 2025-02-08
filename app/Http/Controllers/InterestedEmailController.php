<?php

namespace App\Http\Controllers;

use App\Models\Cake;
use App\Models\InterestedEmail;
use App\Jobs\SendEmailToInterestedUsers;
use Illuminate\Http\Request;

class InterestedEmailController extends Controller
{
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $interestedEmail = InterestedEmail::create($request->all());
        $cake = Cake::find($request->input('cake_id'));

        if ($cake instanceof Cake && $cake->quantity > 0) {
            SendEmailToInterestedUsers::dispatch($cake);
        }

        return response()->json(['message' => 'E-mail registrado com sucesso!'], 201);
    }
}
