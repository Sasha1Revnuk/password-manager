<?php

namespace App\Services;

class PasswordService
{
    public static function generate($bigLetters = false, $symbols = false, $count = 8)
    {
        if (!$count && $count < 8) {
            $count = 8;
        }
        $small = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];
        shuffle($small);
        $big = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
        shuffle($big);
        $symb = ['#', '$', '%', '&', '(', ')', '*', '+', ',', '-', '.', '/', ':', ';', '<', '=', '>', '@', '[', ']'];
        shuffle($symb);

        $firstPartLength = null;
        $secondPartLength = null;
        $thirdPartLength = null;

        $smallStr = '';
        $bigStr = '';
        $symbolStr = '';


        if ($bigLetters && $symbols) {
            $password = '';
            if ($count % 3 == 0) {
                $firstPartLength = $secondPartLength = $thirdPartLength = $count / 3;
            } else {
                $firstPartLength = $secondPartLength = (int)$count / 3;
                $thirdPartLength = $count - ($firstPartLength + $secondPartLength);
            }

            for ($i = 0; $i < $firstPartLength; $i++) {
                $smallStr .= $small[mt_rand(0, count($small) - 1)];
            }

            for ($i = 0; $i < $secondPartLength; $i++) {
                $bigStr .= $big[mt_rand(0, count($big) - 1)];
            }

            for ($i = 0; $i < $thirdPartLength; $i++) {
                $symbolStr .= $symb[mt_rand(0, count($symb) - 1)];
            }

            $password .= $smallStr;
            $password .= $bigStr;
            $password .= $symbolStr;

            $password = str_shuffle($password);

        } else if ($bigLetters || $symbols) {
            $password = '';
            $firstPartLength = $secondPartLength = $count / 2;
            $secondStr = '';
            for ($i = 0; $i < $firstPartLength; $i++) {
                $smallStr .= $small[mt_rand(0, count($small) - 1)];
            }
            if ($bigLetters) {
                for ($i = 0; $i < $secondPartLength; $i++) {
                    $secondStr .= $big[mt_rand(0, count($big) - 1)];
                }
            } else if ($symbols) {
                for ($i = 0; $i < $secondPartLength; $i++) {
                    $secondStr .= $symb[mt_rand(0, count($symb) - 1)];
                }
            }

            $password .= $smallStr;
            $password .= $secondStr;
            $password = str_shuffle($password);
        } else {
            $password = '';
            $arr = [];

            for ($i = 0; $i < $count; $i++) {
                $password .= $small[mt_rand(0, count($small) - 1)];
            }

            $password = str_shuffle($password);
        }

        return $password;
    }

    public function crypt($password)
    {
        $encrypted = $this->encrypt($password, 'sdfsdfsdfdsf');
        $decrypted = $this->decrypt($encrypted, 'sdfsdfsdfdsf');

        return [$encrypted, $decrypted];
    }


    private function encrypt($decrypted, $key)
    {
        $ekey = hash('SHA256', $key, true);
        srand();
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC), MCRYPT_RAND);
        if (strlen($iv_base64 = rtrim(base64_encode($iv), '=')) != 22) return false;
        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $ekey, $decrypted . md5($decrypted), MCRYPT_MODE_CBC, $iv));
        return $iv_base64 . $encrypted;
    }

    private function decrypt($encrypted, $key)
    {
        $ekey = hash('SHA256', $key, true);
        $iv = base64_decode(substr($encrypted, 0, 22) . '==');
        $encrypted = substr($encrypted, 22);
        $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $ekey, base64_decode($encrypted), MCRYPT_MODE_CBC, $iv), "\0\4");
        $hash = substr($decrypted, -32);
        $decrypted = substr($decrypted, 0, -32);
        if (md5($decrypted) != $hash) return false;
        return $decrypted;
    }
}