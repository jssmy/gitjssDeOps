<?php

namespace GitScrum\Models;

//use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use GitScrum\Models\User;
class MainUser extends Authenticatable
{
    //
	protected $guard='userAuth';
	protected $table='main_users';
	protected $guarded=['id'];



	 protected $hidden = [
        'password', 'remember_token',
    ]; 

    public function githubUser(){
    	return User::where('provider','github')
                    ->where('main_user_id',$this->id)->first();
    }

    public function trelloUser(){
        return User::where('provider','trello')
                    ->where('main_user_id',$this->id)->first();
    }

   


}

