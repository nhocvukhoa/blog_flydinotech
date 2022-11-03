<?php

namespace App\Services\User;

use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

abstract class BaseService
{
    public static function imageChangeName($request)
    {
        $destinationPath = '/public/images/avatar';
        $getAvatar = $request->file('avatar');
        $avatarName = $getAvatar->getClientOriginalName();
        $avatarName = date('Y-m-d') . Time() . rand(0,99999) . '.' . $getAvatar->getClientOriginalExtension();
        $request->file('avatar')->storeAs($destinationPath, $avatarName);

        return $avatarName;
    }

    public static function uploadImage($request)
    {
        $originName = $request->file('upload')->getClientOriginalName();
        $fileName = pathinfo($originName, PATHINFO_FILENAME);
        $extension = $request->file('upload')->getClientOriginalExtension();
        $fileName = $fileName . '_' . time() . '.' . $extension;      
        $request->file('upload')->storeAs('public/posts', $fileName);;
        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        $url = asset('storage/posts/'. $fileName);        
        $msg = 'Uploaded image success';
        $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

        return $response;
    }

    public static function getAvatarNameSocial($provider) 
    {
        $providerUser = $provider->user();
        $providerName = class_basename($provider);

        if ($providerName == 'GoogleProvider') {
            $url = $providerUser->getAvatar();
            $fileContents = file_get_contents($url);
            $imageName = 'google' . substr($url, strrpos($url, '/')) . '.jpg';
        }

        if ($providerName == 'FacebookProvider') {
            $url = $providerUser->avatar_original . "&access_token={$providerUser->token}";
            $fileContents = file_get_contents($url);
            $imageName = 'facebook/' . substr($url, strrpos($url, '/')- 100) . '.jpg';
        }

        Storage::disk('local')->put('public/images/avatar/' . $imageName, $fileContents);

        return $imageName;
    }
}
