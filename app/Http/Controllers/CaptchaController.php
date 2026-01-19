<?php

namespace App\Http\Controllers;


use App\Lib\captcha\SimpleCaptcha;

class CaptchaController extends Controller
{
    public function index()
    {
        $captcha = new SimpleCaptcha();


        $img = $captcha->getCaptchaImage();

        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);


        return response($data)->header('Content-Type', 'image/png');
    }
}
