<?php

namespace App\Models;

use Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use DB;

class Claim extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;

    protected $table = 'claims';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable
        = [
            'title',
            'text',
            'client_name',
            'client_email',
            'author_id',
            'answered',
        ];


    /**
     * returns filtered query by client email if $client_email param is not empty
     * @param String $client_email
     * returns $query object
     */
    public function scopeGetByClientEmail($query, $client_email = null)
    {
        if (!empty($client_email)) {
            $query->where(with(new Claim)->getTable() . '.client_email', $client_email);
        }

        return $query;
    }


    /**
     * returns filtered query by author if $author_id param is not empty
     * @param Int $author_id
     * returns $query object
     */
    public function scopeGetByAuthorId($query, $author_id = null)
    {
        if (empty($author_id)) {
            return $query;
        }

        return $query->where(with(new Claim)->getTable() . '.author_id', $author_id);
    }


    /**
     * returns filtered query by $id if $id param is not empty
     * @param Int|array of Int $id
     * returns $query object
     */
    public function scopeGetById($query, $id)
    {
        if (!empty($id)) {
            if (is_array($id)) {
                $query->whereIn(with(new Claim)->getTable() . '.id', $id);
            } else {
                $query->where(with(new Claim)->getTable() . '.id', $id);
            }
        }

        return $query;
    }


    /**
     * returns filtered query by title if $title param is not empty
     * @param String $title
     * returns $query object
     */
    public function scopeGetByTitle($query, $title = null)
    {
        if (empty($title)) {
            return $query;
        }

        return $query->where(with(new Claim)->getTable() . '.title', 'like', '%' . $title . '%');
    }


    /**
     * returns filtered query with only not answered claims
     * returns $query object
     */
    public function scopeGetOnlyInactiveAnswered($query)
    {
        return $query->where(with(new Claim)->getTable() . '.answered', 0);
    }

    /**
     * An model is owned by a user.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo('App\Models\User');
    }



    /**
     * returns filtered query by $filter_created_at and $sign if $filter_created_at param is not empty
     * @param String $filter_created_at
     * @param String $sign
     * returns $query object
     */
    public function scopeGetByCreatedAt($query, $filter_created_at= null, string $sign= null)
    {
        if (!empty($filter_created_at)) {
            if (!empty($sign)) {
                if (in_array($sign, ['=', '<', '>', '<=', '>=', '!-', '<>'])) {
                    $query->whereRaw( DB::getTablePrefix().with(new Claim)->getTable() . '.created_at ' . $sign . ' ?', [$filter_created_at]);
                }
            } else {
                $query->where(with(new Claim)->getTable().'.created_at', $filter_created_at);
            }
        }
        return $query;
    }


    /**
     * returns Array with validation rules for claim
     * @param Int $claim_id
     * @param Array $skipFieldsArray - fields in this array would be excluded from resulting array
     * returns Array
     */
    public static function getClaimValidationRulesArray($claim_id = null, array $skipFieldsArray = []): array
    {

        $user_id= auth()->user()->id;
        $additional_validation_rule = 'check_claim_once_day_by_user_id:' . $user_id ;
        $validationRulesArray = [
            'title'        => [
                'required',
                'string',
                'max:255',
                $additional_validation_rule
            ],
            'text'         => 'required',
            'client_name'  => 'string|required|max:255',
            'client_email' => 'email|required|max:255',
            'author_id'    => 'required|exists:' . (with(new User)->getTable()) . ',id',
            'answered'     => 'boolean',
        ];

        foreach ($skipFieldsArray as $next_field) {
            if (!empty($validationRulesArray[$next_field])) {
                unset($validationRulesArray[$next_field]);
            }
        }

        return $validationRulesArray;
    }

}
