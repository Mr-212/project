<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProjectRequest extends Request {

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
            'name'                          => 'required|string|min:3',
            'description'                   => 'required|min:5',
            'members'                       => 'required',

                    
 			
		];
	}
        public function attributes() {
            return [
            'name'                           => 'Name',
            'description'                    => 'Description',
            'members'                        => 'Members',

        ];
        }

}
