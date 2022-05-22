<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClaimResource;
use App\Models\Claim;
use Inertia\Inertia;
use DB;
use Exception;
use Carbon\Carbon;


class ClaimController extends Controller
{
    /**
     * Display a container page of new claims.
     *
     * @return \Illuminate\Http\Response
     */

    public function new_claims()
    {
        return Inertia::render('Manager/Claim/NewClaimsIndex');
    }

    /**
     * Returns custom collection of new claims
     *
     * @return \Illuminate\Http\Response
     */

    public function load_new_claims()
    {
        $claims = Claim
            ::getOnlyInactiveAnswered(false)
            ->with('author')
            ->orderBy('created_at', 'desc')
            ->get();
        return (ClaimResource::customCollection($claims, true));
    }

    /**
     * Set answered flag for claim by claim id
     *
     * @param  int  $claim_id
     * @return \Illuminate\Http\Response
     */
    public function answer(int $claim_id)
    {
        $claim = Claim
            ::getById($claim_id)
            ->first();
        if (empty($claim)) {
            return response()->json([
                'message' => 'Claim # "' . $claim_id . '" not found',
            ], HTTP_RESPONSE_NOT_FOUND);
        }

        try {
            DB::beginTransaction();
            $claim->answered   = true; // answered
            $claim->updated_at = Carbon::now(config('app.timezone'));
            $claim->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
            ], HTTP_RESPONSE_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'claim'   => $claim,
            'message' => 'Claim was successfully answered',
        ], HTTP_RESPONSE_OK);
    }


    /**
     * Delete claim by claim id
     *
     * @param  int  $claim_id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $claim_id)
    {
        $claim = Claim
            ::getById($claim_id)
            ->first();
        if (empty($claim)) {
            return response()->json([
                'message' => 'Claim # "' . $claim_id . '" not found',
            ], HTTP_RESPONSE_NOT_FOUND);
        }

        try {
            DB::beginTransaction();
            $claim->delete();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => $e->getMessage(),
            ], HTTP_RESPONSE_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            'claim'   => $claim,
            'message' => 'Claim was successfully removed',
        ], HTTP_RESPONSE_OK_RESOURCE_DELETED);
    }


}

