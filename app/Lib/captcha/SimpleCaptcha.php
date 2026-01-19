<?php

namespace App\Lib\captcha;

use Exception;
use Illuminate\Support\Facades\Session;


class SimpleCaptcha
{
    protected $config = [];

    public function __construct($config = [])
    {
        // Check for GD library
        if (!function_exists('gd_info')) {
            throw new Exception('Required GD library is missing');
        }

        $this->initializeConfig($config);
    }

    protected function initializeConfig($config)
    {
        $bg_path = dirname(__FILE__) . '/backgrounds/';
        $font_path = dirname(__FILE__) . '/fonts/';

        // Default values
        $this->config = array_merge([
            'code' => '',
            'min_length' => 5,
            'max_length' => 5,
            'backgrounds' => [
                $bg_path . '45-degree-fabric.png',
                $bg_path . 'cloth-alike.png',
                $bg_path . 'grey-sandbag.png',
                $bg_path . 'kinda-jean.png',
                $bg_path . 'polyester-lite.png',
                $bg_path . 'stitched-wool.png',
                $bg_path . 'white-carbon.png',
                $bg_path . 'white-wave.png'
            ],
            'fonts' => [
                $font_path . 'times_new_yorker.ttf',
                // "{$font_path}captchaCode.ttf"
            ],
            'characters' => 'ABCDEFGHJKLMNPRSTUVWXYZabcdefghjkmnprstuvwxyz23456789',
            'min_font_size' => 28,
            'max_font_size' => 28,
            'color' => '#666',
            'angle_min' => 0,
            'angle_max' => 10,
            'shadow' => true,
            'shadow_color' => '#fff',
            'shadow_offset_x' => -1,
            'shadow_offset_y' => 1
        ], $config);
    }

    public function generateCaptcha()
    {
        // Generate CAPTCHA code if not set by user
        if (empty($this->config['code'])) {
            $this->config['code'] = '';
            $length = mt_rand($this->config['min_length'], $this->config['max_length']);
            while (strlen($this->config['code']) < $length) {
                $this->config['code'] .= substr($this->config['characters'], mt_rand() % (strlen($this->config['characters'])), 1);
            }
        }

        Session::put('_CAPTCHA', serialize($this->config));

        return [
            'code' => $this->config['code'],
            'image' => $this->generateCaptchaImage()
        ];
    }


    protected function generateCaptchaImage()
    {
        $captcha_config = unserialize(Session::get('_CAPTCHA'));
        if (!$captcha_config) exit();

        // Pick random background, get info, and start captcha
        $background = $captcha_config['backgrounds'][mt_rand(0, count($captcha_config['backgrounds']) - 1)];
        list($bg_width, $bg_height, $bg_type, $bg_attr) = getimagesize($background);

        $captcha = imagecreatefrompng($background);

        $color = $this->hex2rgb($captcha_config['color']);
        $color = imagecolorallocate($captcha, $color['r'], $color['g'], $color['b']);

        // Determine text angle
        $angle = mt_rand($captcha_config['angle_min'], $captcha_config['angle_max']) * (mt_rand(0, 1) == 1 ? -1 : 1);

        // Select font randomly
        $font = $captcha_config['fonts'][mt_rand(0, count($captcha_config['fonts']) - 1)];

        // Verify font file exists
        if (!file_exists($font)) throw new Exception('Font file not found: ' . $font);

        // Set the font size.
        $font_size = mt_rand($captcha_config['min_font_size'], $captcha_config['max_font_size']);
        $text_box_size = imagettfbbox($font_size, $angle, $font, $captcha_config['code']);

        // Determine text position
        $box_width = abs($text_box_size[6] - $text_box_size[2]);
        $box_height = abs($text_box_size[5] - $text_box_size[1]);
        $text_pos_x_min = 0;
        $text_pos_x_max = ($bg_width) - ($box_width);
        $text_pos_x = mt_rand($text_pos_x_min, $text_pos_x_max);
        $text_pos_y_min = $box_height;
        $text_pos_y_max = ($bg_height) - ($box_height / 2);
        if ($text_pos_y_min > $text_pos_y_max) {
            $temp_text_pos_y = $text_pos_y_min;
            $text_pos_y_min = $text_pos_y_max;
            $text_pos_y_max = $temp_text_pos_y;
        }
        $text_pos_y = mt_rand($text_pos_y_min, $text_pos_y_max);

        // Draw shadow
        if ($captcha_config['shadow']) {
            $shadow_color = $this->hex2rgb($captcha_config['shadow_color']);
            $shadow_color = imagecolorallocate($captcha, $shadow_color['r'], $shadow_color['g'], $shadow_color['b']);
            imagettftext($captcha, $font_size, $angle, $text_pos_x + $captcha_config['shadow_offset_x'], $text_pos_y + $captcha_config['shadow_offset_y'], $shadow_color, $font, $captcha_config['code']);
        }

        // Draw text
        imagettftext($captcha, $font_size, $angle, $text_pos_x, $text_pos_y, $color, $font, $captcha_config['code']);

        // Output image as base64
        ob_start();
        imagepng($captcha);
        $image_data = ob_get_contents();
        ob_end_clean();
        return 'data:image/png;base64,' . base64_encode($image_data);
    }

    protected function hex2rgb($hex_str, $return_string = false, $separator = ',')
    {
        $hex_str = preg_replace("/[^0-9A-Fa-f]/", '', $hex_str); // Gets a proper hex string
        $rgb_array = [];
        if (strlen($hex_str) == 6) {
            $color_val = hexdec($hex_str);
            $rgb_array['r'] = 0xFF & ($color_val >> 0x10);
            $rgb_array['g'] = 0xFF & ($color_val >> 0x8);
            $rgb_array['b'] = 0xFF & $color_val;
        } elseif (strlen($hex_str) == 3) {
            $rgb_array['r'] = hexdec(str_repeat(substr($hex_str, 0, 1), 2));
            $rgb_array['g'] = hexdec(str_repeat(substr($hex_str, 1, 1), 2));
            $rgb_array['b'] = hexdec(str_repeat(substr($hex_str, 2, 1), 2));
        } else {
            return false;
        }
        return $return_string ? implode($separator, $rgb_array) : $rgb_array;
    }

    public function getCaptchaImage()
    {

        Session::forget('captcha');

        $captcha = $this->generateCaptcha();
        Session::put('captcha', $captcha['code']);
        return $captcha['image'];
    }
}
