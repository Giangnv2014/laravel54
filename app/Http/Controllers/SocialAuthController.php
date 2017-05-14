<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Services\SocialAccountService;
use Illuminate\Support\Facades\Log;

use Socialite;

class SocialAuthController extends Controller
{
    public function redirect($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function callback($social)
    {
        // Log::debug(Socialite::driver($social));
        if (isset($_GET['error_reason']) && $_GET['error_reason'] == 'user_denied') {
            $test = Socialite::driver($social);
            dd($test);
            Log::debug('giang');
            Log::debug($test);
            dd('ok');
        }
        $user = SocialAccountService::createOrGetUser(Socialite::driver($social)->user(), $social);

        auth()->login($user);

        return redirect()->to('/home');
    }
}


