<?php

namespace App\Http\Controllers;

use App\Mail\ResennaMail;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index(Request $request)
    {
        $receptor = 'rafalejandrorh10@hotmail.com';
        Mail::to($receptor)->cc($receptor)->send(new ResennaMail());
    }
}
