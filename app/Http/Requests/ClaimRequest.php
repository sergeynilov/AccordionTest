<?php

namespace App\Http\Requests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Claim;
class ClaimRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $request= request();

        return Claim::getClaimValidationRulesArray( $request->get('id'), [ 'author_id', 'answered' ] );
    }

    public function messages()
    {
        return [
            'check_claim_once_day_by_user_id'    => 'You already have assigned Claim for today',
        ];
    }

}
