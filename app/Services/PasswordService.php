<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

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


    public function encrypt($data, $userKey)
    {
        $key = pack('H*', $userKey);
        $method = 'aes-256-ecb';
        $ivSize = openssl_cipher_iv_length($method);
        $iv = openssl_random_pseudo_bytes($ivSize);
        $encrypted = openssl_encrypt($data, $method, $key, OPENSSL_RAW_DATA, $iv);
        $encrypted = strtoupper(implode(null, unpack('H*', $encrypted)));
        return $encrypted;
    }

    public function decrypt($data, $userKey)
    {
        $key = pack('H*', $userKey);
        $method = 'aes-256-ecb';
        $data = pack('H*', $data);
        $ivSize = openssl_cipher_iv_length($method);
        $iv = $iv = openssl_random_pseudo_bytes($ivSize);
        $decrypted = openssl_decrypt($data, $method, $key, OPENSSL_RAW_DATA, $iv);
        return trim($decrypted);
    }
}