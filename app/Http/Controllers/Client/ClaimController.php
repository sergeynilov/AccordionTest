<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClaimRequest;
use App\Models\ModelHasPermission;
use App\Notifications\ClaimCreatedNotification;

use App\Http\Resources\ClaimResource;
use App\Models\Claim;
use Inertia\Inertia;
use DB;
use Exception;

class ClaimController extends Controller
{
    /**
     * Display page for adding of new claim + selected image
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Client/Claim/New', [
            'claim' => (new  ClaimResource(new Claim))->showDefaultImage(false),
        ]);
    }

    /**
     * Store a newly created claim
     *
     * @param \Illuminate\Http\ClaimRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ClaimRequest $request)
    {
        try {
            $claimImageUploadedFile = '';
            if($request->file('image')) {
                $claimImageUploadedFile = $request->file('image');
            }
            DB::beginTransaction();
            $claim = Claim::create([
                'title'        => $request->title,
                'text'         => $request->text,
                'client_name'  => $request->client_name,
                'client_email' => $request->client_email,
                'author_id'    => auth()->user()->id,
                'answered'     => false,
            ]);

            if($claimImageUploadedFile) {
                $claim
                    ->addMediaFromRequest('image')
                    ->usingFileName($request->image_filename)
                    ->toMediaCollection(config('app.media_app_name'));
            }

            $managers = ModelHasPermission
                ::getByPermissionId(ACCESS_MANAGER)
                ->with('user')
                ->get();
            foreach ($managers as $nextManager) {
                $nextManager->user->notify(new ClaimCreatedNotification(
                    title: $request->title,
                    text: $request->text,
                    client_name: $request->client_name,
                    client_email: $request->client_email,
                    authorUser: auth()->user()
                ));
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return back()->withErrors(['message' => $e->getMessage()]);
        }
        return redirect()->back()->with('success', '');
    }

}
