<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class TaskRequest extends Request {

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
        if(\Auth::user()->type=='Admin') {
            return [
                'name' => 'required|string|min:3',
                'description' => 'required|min:5',
                'project_id' => 'required|not_in:0',
                'sprint_id' => 'required|not_in:0',
                'user_id' => 'required|not_in:0',

            ];
        }else{
            return [
                'name' => 'required|string|min:3',
                'description' => 'required|min:5',
                ];
        }
	}
        public function attributes() {
            return [
            'name'                           => 'Name',
            'description'                    => 'Description',
            'project_id'                     => 'Project',
            'sprint_id'                      => 'Sprint',
            'user_id'                        => 'User',

        ];
        }

}
