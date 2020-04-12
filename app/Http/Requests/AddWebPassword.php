<?php

namespace App\Http\Requests;

use App\Enumerators\UserEnumerator;
use App\Rules\CheckAbonementPromotionSingle;
use App\Rules\CheckCoachForSection;
use App\Rules\CheckCoachSingle;

use App\Rules\CheckPromotionForSection;
use App\Rules\CheckSectionSingle;
use App\Rules\CheckTariffPlanForSection;
use App\Rules\CheckTariffPlanSingle;
use App\Rules\CheckUniqueLoginForWebResource;
use App\Rules\CheckVisitorSingle;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AddWebPassword extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $rules = [
            'login' => ['required', new CheckUniqueLoginForWebResource(request('web'), request('user'))],
            'password' => ['required','min:8'],
            'shifr' => ['required'],
        ];

        if((int)$request->get('shifr') === UserEnumerator::METHOD_SECRET) {
            $rules['secret'] = ['required','min:8'];
        }

        return $rules;
    }
}
