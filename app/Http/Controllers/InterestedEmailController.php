<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use App\Models\Cake;
use App\Models\InterestedEmail;
use App\Jobs\SendEmailToInterestedUsers;
use Illuminate\Http\Request;
use App\Http\Requests\StoreInterestedEmailRequest;

class InterestedEmailController extends Controller
{
    public function store(StoreInterestedEmailRequest $request)
    {
        $interestedEmail = InterestedEmail::create($request->validated());

        $cake = Cake::find($request->cake_id);
        if ($cake->quantity > 0) {
            SendEmailToInterestedUsers::dispatch($cake);
        }

        return response()->json(['message' => 'E-mail registrado com sucesso!'], 201);
    }
}
