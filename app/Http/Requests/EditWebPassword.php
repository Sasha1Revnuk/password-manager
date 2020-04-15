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

class EditWebPassword extends FormRequest
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
        if(request('resource')->login === $request->get('login')) {
            $rules = [
                'login' => ['required'],
                'shifr' => ['required'],
            ];
        } else {
            $rules = [
                'login' => ['required', new CheckUniqueLoginForWebResource(request('web'), request('user'))],
                'shifr' => ['required'],
            ];
        }

        $rules['password'] = ['required', 'min:8'];

        if((int)$request->get('shifr') === UserEnumerator::METHOD_SECRET && (int)request('resource')->method != UserEnumerator::METHOD_SECRET) {
            $rules['secret'] = ['required','min:8'];

        }

        if((int)request('resource')->method === UserEnumerator::METHOD_SECRET) {
            $rules['secretCheckedPassword'] = ['required', 'min:8'];
        }
        return $rules;
    }
}
