<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Exception;
use Auth;
use DB;
use Illuminate\Auth\Events\Registered;

use Laravel\Fortify\Contracts\RegisterResponse;

class AuthController extends Controller
{

    /**
     * Adding new user with client access
     *
     * @param \Illuminate\Http\Request $request - fields of a new user
     * @param App\Actions\Fortify\CreateNewUser $creator
     *
     * @return Laravel\Fortify\Contracts\RegisterResponse
     */

    public function store(Request $request, CreateNewUser $creator): RegisterResponse
    {
        try {
            DB::beginTransaction();
            event(new Registered($newUser = $creator->create(
                $request->all(), true, [ACCESS_CLIENT_LABEL]))
            );

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

           return back()->withErrors(['message' => $e->getMessage()]);
        }

        return app(RegisterResponse::class);
    }


}
