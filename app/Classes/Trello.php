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


    public function readBoards($page=1,&$boards=null){
        //dd();
        $url= 'https://api.trello.com/1/members/'
              .Auth::user()->trelloUser()->trelloUserId()
              .'/boards?key='.env('TRELLO_CLIENT_ID')
              .'&token='.Auth::user()->trelloUser()->token;
        //$provider='trello';
        $response = collect(Helper::request($url,$provider='trello'))->map(function($bor){
            return $this->tplBoard($bor);

        });


        if (is_null($boards)) {
            $boards = collect();
        }

        $boards->push($response);

        if ($response->count() == 30) {
            $this->readRepositories(++$page, $boards);
        }

        return $boards->flatten(1)->sortBy('title');
    }

    public function tplBoard($obj){
        //dd($obj);
        if(!is_null($obj)){
            return (object)[
                'id'=>$obj->id,
                'name' => $obj->name,
                'desc'  => $obj->desc,
                'closed'  =>$obj->closed,
                'idOrganization'=> $obj->idOrganization,
                'subscribed'=>$obj->subscribed,
                'shortUrl'=>$obj->shortUrl,
                'invited'=>$obj->invited,
                'members'=>count($obj->memberships),
                'dateLastActivity'=>$obj->dateLastActivity,
                'descData'=>$obj->descData
            ];
        }


        return (object)[];
    }






}
//'https://api.trello.com/1/members/59f96cb4f6f73854683eb5f4/boards?key=13f1e71e1973172e8a0563b36092cbc3&token=beaf7ab5c18c82932cdec74199346572d6b57176e1e41ab32c45104d46f6e544'
