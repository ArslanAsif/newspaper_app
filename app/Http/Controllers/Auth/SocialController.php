<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    /**
     * Redirect the user to the social network authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($social_network)
    {
        return Socialite::driver($social_network)->redirect();
    }

    /**
     * Obtain the user information from social network.
     *
     * @return Response
     */
    public function handleProviderCallback($social_network)
    {
        $this->authenticate($social_network);
        return Redirect::to('/');
    }

    /**
     * Login user if exists; create if doesn't; redirect it registered with email
     *
     * @param $sn
     * @return
     */
    public function authenticate($sn)
    {
        try {
            $user = Socialite::driver($sn)->user();
        } catch (Exception $e) {
            return Redirect::to('auth/'.$sn);
        }

        //check if user already exists in DB
        $my_user = User::where('email', $user->email);
        if($my_user->count())
        {
            //if user has password, it means user is registered with email. Prompt user to login through email
            if($my_user->first()->password != null)
            {
                return Redirect::to('/login')->with('error', 'Already registered through email, please sign in through email');
            }
        }
        //Sign up if user dosen't exist or sign in if user already registered through social network
        $authUser = $this->findOrCreateUser($user, $sn);
        Auth::login($authUser, true);
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $snUser $sn
     * @return User
     */
    private function findOrCreateUser($snUser, $sn)
    {
        if ($authUser = User::where(['social_network' => $sn, 'social_id' => $snUser->getid()])->first()) {
            return $authUser;
        }
        else
        {
            $user = new User();
            $user->name = $snUser->name;
            $user->email = $snUser->email;
            $user->social_network = $sn;
            $user->social_id = $snUser->id;
            $user->avatar = $snUser->avatar;

            return $user;
        }
    }
}
