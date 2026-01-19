<?php

namespace App\Lib;

class ReCaptcha
{

    protected $captchaHeight = 60;
    protected $captchaWidth = 300;
    protected $totalCharacters = 6;
    protected $possibleLetters = "123456789MNBVCXZASDFGHJKLPOIUYTREWQ";
    protected $captchaFont = "";
    protected $randomDots = 10;
    protected $randomLines = 25;
    protected $textColor = "005ba8";
    protected $noiseColor = "24a0ff";
    protected $initialSpace = 30;
    protected $baseSpace = 250;

    protected $ruta = "";
    protected $captcha = "";

    protected $captchaFontSize = 0;


    /**
     * ReCaptcha constructor.
     * @param array $config
     */

    public function __construct(array $config = [])
    {
        $this->captchaHeight = $config['captchaHeight'] ?? $this->captchaHeight;
        $this->captchaWidth = $config['captchaWidth'] ?? $this->captchaWidth;
        $this->totalCharacters = $config['totalCharacters'] ?? $this->totalCharacters;
        $this->possibleLetters = $config['possibleLetters'] ?? $this->possibleLetters;
        $this->captchaFont = $config['captchaFont'] ?? public_path(). "/assets/fonts/MonospaceBold.ttf";
        $this->randomDots = $config['randomDots'] ?? $this->randomDots;
        $this->randomLines = $config['randomLines'] ?? $this->randomLines;
        $this->textColor = $config['textColor'] ?? $this->textColor;
        $this->noiseColor = $config['noiseColor'] ?? $this->noiseColor;
        $this->ruta = $config['ruta'] ?? storage_path('app/public/captcha/')  ;
    }

    /**
     * @param array $config
     * @return void
     */

    public function setConfig(array $config)
    {
        $this->captchaHeight = $config['captchaHeight'] ?? $this->captchaHeight;
        $this->captchaWidth = $config['captchaWidth'] ?? $this->captchaWidth;
        $this->totalCharacters = $config['totalCharacters'] ?? $this->totalCharacters;
        $this->possibleLetters = $config['possibleLetters'] ?? $this->possibleLetters;
        $this->captchaFont = $config['captchaFont'] ?? $this->captchaFont;
        $this->randomDots = $config['randomDots'] ?? $this->randomDots;
        $this->randomLines = $config['randomLines'] ?? $this->randomLines;
        $this->textColor = $config['textColor'] ?? $this->textColor;
        $this->noiseColor = $config['noiseColor'] ?? $this->noiseColor;
        $this->ruta = $config['ruta'] ?? $this->ruta;
    }



    public function createCaptcha()
    {

        verifyPath($this->ruta);

        $character = 0;
        while ($character < $this->totalCharacters) {
            $this->captcha .= substr($this->possibleLetters, mt_rand(0, strlen($this->possibleLetters) - 1), 1);
            $character++;
        }

        $this->captchaFontSize = $this->captchaHeight * 0.65;
        $captchaImage = imagecreate($this->captchaWidth, $this->captchaHeight);
        $backgroundColor = imagecolorallocate($captchaImage, 255, 255, 255);
        $arrayTextColor = $this->hextorgb($this->textColor);
        $textColor = imagecolorallocate($captchaImage, $arrayTextColor['red'], $arrayTextColor['green'], $arrayTextColor['blue']);
        $arrayNoiseColor = $this->hextorgb($this->noiseColor);
        $imageNoiseColor = imagecolorallocate($captchaImage, $arrayNoiseColor['red'], $arrayNoiseColor['green'], $arrayNoiseColor['blue']);
        for ($captchaDotsCount = 0; $captchaDotsCount < $this->randomDots; $captchaDotsCount++) {
            imagefilledellipse($captchaImage, mt_rand(0, $this->captchaWidth), mt_rand(0, $this->captchaHeight), 2, 3, $imageNoiseColor);
        }
        for ($captchaLinesCount = 0; $captchaLinesCount < $this->randomLines; $captchaLinesCount++) {
            imageline($captchaImage, mt_rand(0, $this->captchaWidth), mt_rand(0, $this->captchaHeight), mt_rand(0, $this->captchaWidth), mt_rand(0, $this->captchaHeight), $imageNoiseColor);
        }
        $imageTime = md5(time());
        $imageName = "cap_" . $imageTime . ".png";
        $text_box = imagettfbbox($this->captchaFontSize, 0, $this->captchaFont, $this->captcha);
        $x = ($this->captchaWidth - $text_box[4]) / 2;
        $y = ($this->captchaHeight - $text_box[5]) / 2;


        //** */

        $string_length = strlen($this->captcha);

        $captcha_string = str_split($this->captcha);


        for($i = 0; $i < $string_length; $i++) {
            $letter_space = $this->baseSpace/$string_length;

            imagettftext($captchaImage, $this->captchaFontSize, rand(-20, 20), $this->initialSpace + $i*$letter_space, $y, $textColor, $this->captchaFont, $captcha_string[$i]);
          }

        //** */
        // imagettftext($captchaImage, $this->captchaFontSize,0, $x, $y, $textColor, $this->captchaFont, $this->captcha);
        imagepng($captchaImage, $this->ruta . $imageName);
        imagedestroy($captchaImage);

        // session()->set('captcha', $this->captcha);
        session()->put('captcha', $this->captcha);

        $captchaDates = [
            'captchaName' => $imageName,
            'textCaptcha' => $this->captcha,
            'captchaTime' => $imageTime
        ];

        return $captchaDates;
    }

    public function verifyCaptcha($codigo, $captchaTime)
    {

        if ($captchaTime == null || $codigo == null) {
            return false;
        }

        $textoCaptcha = session('captcha');
        $imagen = $this->ruta . "cap_" . $captchaTime . ".png";

        if (($textoCaptcha === $codigo && file_exists($imagen))) {
            if (file_exists($imagen)) {
                unlink($imagen);
            }

            return true;
        } else {
            if (file_exists($imagen)) {

                unlink($imagen);
            }
            return false;
        }
    }






    private function hextorgb($hexstring)
    {
        $integar = hexdec($hexstring);
        return array(
            "red" => 0xFF & ($integar >> 0x10),
            "green" => 0xFF & ($integar >> 0x8),
            "blue" => 0xFF & $integar
        );
    }

    public function getUrlCaptcha()
    {
        return $this->ruta;
    }
}
