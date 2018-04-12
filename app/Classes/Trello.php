<?php

namespace GitScrum\Classes;

use Auth;
use Carbon;

class Trello
{ 
    

    public function tplUser($obj)
    { 
        //dd($obj);
        return [
            'provider_id' => $obj->user['id'],
            'provider' => 'trello',
            'username' => isset($obj->login) ? $obj->login : $obj->nickname,
            'name' => isset($obj->user['fullName']) ? $obj->user['fullName'] : null,
            'token' => isset($obj->token) ? $obj->token : null,
            'avatar' => isset($obj->user['avatarHash']) ? str_replace('_AVATAR_',$obj->user['avatarHash'],'http://trello-avatars.s3.amazonaws.com/_AVATAR_/50.png') : null,
            'html_url' => isset($obj->user['url']) ? $obj->user['url'] : $obj->html_url,
            'bio' => isset($obj->user['bio']) ? $obj->user['bio'] : null,
            'since' => isset($obj->user['created_at']) ? Carbon::parse($obj->user['created_at'])->toDateTimeString() : Carbon::now(),
            'location' => isset($obj->user['location']) ? $obj->user['location'] : null,
            'blog' => isset($obj->user['blog']) ? $obj->user['blog'] : null,
            'email' => isset($obj->email) ? $obj->email : null,
            'main_user_id'=>Auth::guard('userAuth')->user()->id,
        ];
    }
}

