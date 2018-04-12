<?php

namespace GitScrum\Classes;

use Auth;

use GitScrum\Models\User;


class Google 
{

    public function tplUser($obj)
    {
            
        return [
            'provider_id' => $obj->id,
            'provider' => 'google',
            'username' => isset($obj->nickname) ? $obj->nickname : null,
            'name' => isset($obj->name) ? $obj->name : nul,
            'token' => isset($obj->token) ? $obj->token : null,
            'avatar' => isset($obj->avatar) ? $obj->avatar : null,
            'email' => isset($obj->email) ? $obj->email : null,
        ];
    }
}
