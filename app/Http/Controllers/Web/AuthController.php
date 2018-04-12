<?php

namespace GitScrum\Http\Controllers\Web;

use GitScrum\Http\Requests\AuthRequest;
use GitScrum\Models\User;
use GitScrum\Models\MainUser;
use Socialite;
use Auth;
use SocialiteProviders\Manager\Exception\InvalidArgumentException;
use Session;

class AuthController extends Controller
{
    public function __construct()
    {
       
    } 
 
    public function login()
    {
        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('home');
    }

    public function redirectToProvider($provider)
    {  
       
        if($provider=='github'){
            return Socialite::driver('github')
                ->scopes(['repo', 'notifications', 'read:org'])
                ->redirect();
        }
        if($provider=='google'){
             return Socialite::driver('google')->redirect();   
             
        }
       
        if($provider=='trello'){
             
             return Socialite::driver('trello')->redirect();   
        }
        if($provider=='slack'){
            return Socialite::driver('slack')->redirect();      
        }
    }
 
    public function handleProviderCallback($provider)
    {

    
        
        if (\Request::has('denied')) {
            return redirect()->route('auth.login');
        }
        $providerUser = Socialite::driver($provider)->user();
        //dd($providerUser);
        
        $data = app(ucfirst($provider))->tplUser($providerUser);    
        //dd($data);

        if($provider=='google'){
            $user= MainUser::updateOrCreate(['provider_id'=>$data['provider_id']],$data);
        }
        else{

            User::updateOrCreate(['provider_id'=>$data['provider_id']],$data);    
            switch ($provider) {
                case 'github':
                    Auth::user()->github=1;
                    break;
                case 'trello':
                    Auth::user()->trello=1;
                    break;
                case 'slack':
                    Auth::user()->slack=1;
                    break;
            }
            Auth::user()->save();
            return redirect()->route('wizard.step1',$provider);

        }
        
        
        
        if($provider=='google')auth()->login($user);
         

        return redirect()->route('user.dashboard');
    }
}
