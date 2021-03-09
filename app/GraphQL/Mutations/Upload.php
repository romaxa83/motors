<?php

namespace App\GraphQL\Mutations;

use App\Models\Image;

class Upload
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        /** @var \Illuminate\Http\UploadedFile $file */
        $file = $args['file'];

        \Storage::put(Image::getPathOfImage(), $file);

        $i = new Image();
        $i->name = $file->getFilename();
        $i->hash = $file->hashName();

        $i->save();

        return $i;
    }
}
