<?php

namespace ReinVanOyen\CopiaSendcloud\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use ReinVanOyen\CopiaSendcloud\Events\ParcelChanged;

class WebhookController extends Controller
{
    /**
     * @param Request $request
     * @return string
     * @throws \Exception
     */
    public function handle(Request $request)
    {
        $this->verify($request);

        if ($request->has('action')) {
            if ($request->get('action') === 'parcel_status_changed') {
                ParcelChanged::dispatch($request->get('parcel'));
            }
        }

        return 'ok';
    }

    /**
     * @param Request $request
     * @return void
     * @throws \Exception
     */
    private function verify(Request $request)
    {
        $secret = config('copia-sendcloud.sendcloud_secret_key');
        $signature = $request->header('Sendcloud-Signature');
        $data = (string) $request->getContent();

        if (! $signature) {
            throw new \Exception('Webhook request does not specify a signature header.');
        }

        if (hash_hmac('sha256', $data, $secret) !== $signature) {
            throw new \Exception('Hashed webhook payload does not match Sendcloud-supplied header.');
        }
    }
}
