<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckUniqueLoginForWebResource implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $web;
    protected $user;
    public function __construct($web, $user)
    {
        $this->web = $web;
        $this->user = $user;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $check = true;
        $ress = $this->web->resources;
        foreach ($ress as $res) {
            if($res->login === $value)
            {
                $check = false;
                break;
            }
        }


        return $check === true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Обліковий запис з таким логіном вже існує';
    }
}
