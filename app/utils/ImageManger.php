<?php

namespace App\Utils;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageManger
{

    // public static function uploadImages($request , $post=null , $user=null)
    // {
    //     if($request->hasFile('images')){
    //         foreach($request->images as $image){

    //             $file = self::generateImageName($image);
    //             $path = self::storeImageInLocal($image , 'posts' , $file);

    //             $post->images()->create([
    //                 'path'=>$path,
    //             ]);
    //         }
    //     }

    //     // upload single image
    //     if($request->hasFile('image')){
    //         $image = $request->file('image');

    //         self::deleteImageFromLocal($user->image);

    //         $file = self::generateImageName($image);
    //         $path = self::storeImageInLocal($image , 'users' , $file);

    //         $user->update(['image'=>$path]);
    //     }
    // }

    // public static function deleteImages($post)
    // {
    //     if ($post->images->count() > 0) {
    //         foreach ($post->images as $image) {
    //            self::deleteImageFromLocal($image->path);
    //            $image->delete();
    //         }
    //     }
    // }

    public function uploadSingleImage($path, $image, $disk)
    {
        $file_name = $this->generateImageName($image);
        self::storeImageInLocal($image, $path, $file_name, $disk);
        return $file_name;
    }
    public function generateImageName($image)
    {
        $file_name = Str::uuid() . time() . '.' . $image->getClientOriginalExtension();
        return $file_name;
    }
    public function storeImageInLocal($image, $path, $file_name, $disk)
    {
        $image->storeAs($path, $file_name, ['disk' => $disk]);
    }

    public function deleteImageFromLocal($image_path): void
    {
        if (File::exists(public_path($image_path))) {
            File::delete(public_path($image_path));
        }
    }
}