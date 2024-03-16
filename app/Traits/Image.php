<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait Image
{
    public function storeImage(Request $request): string
    {
        if ($request->hasFile('image')) {
            $image = $request->image;
            $imageOldName = $image->getClientOriginalName();
            $extension = explode('.', $imageOldName);
            $imageNewName = Str::random(10) . '_' . time() . '.' . end($extension);
            $image->storeAs('items', $imageNewName, 'public');
            return $imageNewName;
        } else {
            return 'you Have No image';
        }
    }
}
