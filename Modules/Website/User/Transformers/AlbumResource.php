<?php

namespace Modules\Website\User\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Common\Transformers\MediaResource;

class AlbumResource extends JsonResource
{
    public function toArray($request)
    {
        switch ($request->route()->getActionMethod()) {
            case "index":
                $items = $this->getIndexData();
                break;
            case "show":
                $items = $this->getShowData();
                break;
            default:
                $items = $this->getDropDownData();
                break;
        }
        return $items;
    }

    private function getIndexData(): array
    {
        return  [
            'id'                => $this->id,
            'name'              => $this->name,
            'status'            => $this->status,
            'pictures_count'    => count($this->pictures),
            'created_at'        => $this->created_at->format('Y-m-d h:i A'),
            'image'             => count($this->pictures) ? new MediaResource($this->pictures->random(1)->values()[0]) : null,
        ];
    }

    private function getShowData(): array
    {
        return  [
            'id'        => $this->id,
            'name'      => $this->name,
            'pictures'  => MediaResource::collection($this->pictures),
        ];
    }

    private function getDropDownData(): array
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name
        ];
    }
}
