<?php

namespace ReinVanOyen\CopiaSendcloud\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class WebhookController extends Controller
{
    /**
     * @param Request $request
     * @return string
     */
    public function handle(Request $request)
    {
        // @TODO
        return 'ok';
    }
}
