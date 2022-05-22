<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Auth;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */


    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [

            'flash' => [
                'message' => fn() => $request->session()->get('message')
            ],


            'flash_type' => [
                'message' => fn() => $request->session()->get('flash_type')
            ],

            'auth' => function () {


                $is_logged_user_manager =  Auth::user() ? auth()->user()->can(ACCESS_MANAGER_LABEL) : false;
                $is_logged_user_client  =  Auth::user() ? auth()->user()->can(ACCESS_CLIENT_LABEL) : false;
                $user                   = auth()->user();

                return $user ? [
                    'profile'                => $user,
                    'is_logged_user_manager' => $is_logged_user_manager,
                    'is_logged_user_client'  => $is_logged_user_client,
                ] : null;
            }
        ]);
    }


}
