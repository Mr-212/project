<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CompanyRequest extends Request {

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
	public function rules()
	{
		return [
            'name'                          => 'required',
            'email'                         => 'email|max:100',
            'phone'                         => 'required|digits_between:11,12',
            'address'                       => 'required',
            'city'                          => 'required',
            'state'                         => 'required',
            'postal_code'                   => 'required|digits:5',

                    
 			
		];
	}
        public function attributes() {
            return [
            'name'                           =>'Company Name',
            'email'                          => 'Email',
            'phone'                          => 'Phone#',
            'address'                        => 'Address',
            'city'                           => 'City',
            'state'                          => 'State',
            'postal_code'                    => 'Postal Code',
        ];
        }

}
