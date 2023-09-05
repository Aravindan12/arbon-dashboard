<?php

namespace App\Providers;

use Aacotroneo\Saml2\Events\Saml2LoginEvent;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class SAML2ServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Event::listen('Aacotroneo\Saml2\Events\Saml2LoginEvent', function (Saml2LoginEvent $event) {
            $user = $event->getSaml2User();
            $userData = [
                'id' => $user->getUserId(),
                'attributes' => $user->getAttributes(),
                'assertion' => $user->getRawSamlAssertion()
            ];
            if ($userData) {
                //check the user already exists or create as a new user.
                $user = User::firstOrCreate(['email' => $userData['attributes']['emailaddress'][0]],
                [
                    'name' => $userData['attributes']['givenname'][0],
                    // 'last_name' => $userData['attributes']['surname'][0],
                    // 'state' => $userData['attributes']['state'][0],
                    // 'is_approved' => 1,
                    // 'postal' => $userData['attributes']['postal'][0],
                    'password' => Hash::make('Aa@13111998'),
                    'original_password' => 'Aa@13111998'
                ]);
                Log::info('sso login - '.$user->id);
                Auth::login($user);
            }
        });

    }
}
