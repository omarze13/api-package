<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use App\Traits\Image;
use App\Traits\PaginateResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use ApiResponse, Image, PaginateResponse;
}
