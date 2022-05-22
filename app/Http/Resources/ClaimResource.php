<?php

namespace App\Http\Resources;

use App\Library\Services\DateFunctionalityServiceInterface;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MediaImageResource;

use App;
use Illuminate\Support\Facades\File;
use Spatie\Image\Image;

class ClaimResource extends JsonResource
{

    protected static $show_default_image = false;

    public function showDefaultImage($value)
    {
        self::$show_default_image = $value;
        return $this;
    }


    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */

    public function toArray($request)
    {
        $dateFunctionality = App::make(DateFunctionalityServiceInterface::class);

        $ClaimImage = [];
        $ClaimMedia = $this->getFirstMedia(config('app.media_app_name'));

        if (!empty($ClaimMedia) and File::exists($ClaimMedia->getPath())) {
            $ClaimImage['url']       = $ClaimMedia->getUrl();
            $imageInstance             = Image::load($ClaimMedia->getUrl());
            $ClaimImage['width']     = $imageInstance->getWidth();
            $ClaimImage['height']    = $imageInstance->getHeight();
            $ClaimImage['size']      = $ClaimMedia->size;
            $ClaimImage['file_name'] = $ClaimMedia->file_name;
            $ClaimImage['mime_type'] = $ClaimMedia->mime_type;
        } else {
            $ClaimImage['url'] = self::$show_default_image ? '/images/default-article.png' : '';
        }

        return [
            'id'                   => $this->id,
            'title'                => $this->title,
            'client_name'                  => $this->client_name,
            'client_email'                  => $this->client_email,
            'text'                 => $this->text,
            'author_id'            => $this->author_id,
            'author'               => new UserResource($this->whenLoaded('author')),
            'claimImageProps'    => new MediaImageResource($ClaimImage),
            'answered'            => $this->answered,
            'created_at'           => $this->created_at,
            'created_at_formatted' => $dateFunctionality->getFormattedDateTime($this->created_at),
            'updated_at'           => $this->updated_at,
            'updated_at_formatted' => $dateFunctionality->getFormattedDateTime($this->updated_at),
        ];
    }

    public static function customCollection(
        $resource,
        $show_default_image
    ): \Illuminate\Http\Resources\Json\AnonymousResourceCollection {
        self::$show_default_image = $show_default_image;
        return parent::collection($resource);
    }


    public function with($request)
    {
        return [
            'meta' => [
                'version' => getAppVersion()
            ]
        ];
    }

}

