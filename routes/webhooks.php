<?php

use \ReinVanOyen\CopiaSendcloud\Http\Controllers\WebhookController;

Route::post('copia-sendcloud-webhook/', [WebhookController::class, 'handle']);
