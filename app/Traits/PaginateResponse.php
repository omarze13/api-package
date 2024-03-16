<?php

namespace App\Traits;

use Illuminate\Http\Resources\Json\JsonResource;

trait PaginateResponse
{
    public function paginate($data, $resource, $request = null) : JsonResource|array
    {
        if ($data->total() > $data->perPage()){
                $response = [
                'records' => $resource::collection($data),
                'Pagination links' => [
                    'Total Items' => $data->total(),
                    'current page' => $data->currentPage(),
                    'per page' => $data->perPage(),
                    'total pages' => $data->lastPage(),
                    ]
                ];

                if ($request){
                    if ($request->has('search')){
                        $response['Pagination links'] += ['links' => [
                            'previous page' => $data->previousPageUrl()?  $data->previousPageUrl() . "&search={$request->input('search')}" : null,
                            'pages' => $data->getUrlRange(1, $data->lastPage()),
                            'next page' => $data->nextPageUrl()? $data->nextPageUrl() . "&search={$request->input('search')}": null,
                            ]
                        ];
                        foreach ($response['Pagination links']['links']['pages'] as $key => $page){
                            static $pages = [];
                            $pages += [$key => $page . "&search={$request->input('search')}"];
                        }
                        $response['Pagination links']['links']['pages'] = $pages;
                    }
                }else{
                        $response['Pagination links'] += ['links' => [
                            'previous page' => $data->previousPageUrl(),
                            'pages' => $data->getUrlRange(1, $data->lastPage()),
                            'next page' => $data->nextPageUrl(),

                            ]
                        ];
                    }
        }else{
            $response = $resource::collection($data);
        }
        return $response;
    }
}
