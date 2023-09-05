<?php

namespace App\Http\Controllers;

use Aacotroneo\Saml2\Saml2Auth;
use Aacotroneo\Saml2\Http\Controllers\Saml2Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SAML2LoginController extends Saml2Controller
{
        /**
     * aurelogin
     */
    public function azureLogin()
    {
        // dd('sss');
        $saml2Auth = new Saml2Auth(Saml2Auth::loadOneLoginAuthFromIpdConfig(env('SAML_HOST')));
        $saml2Auth->login('/');
    }
}
