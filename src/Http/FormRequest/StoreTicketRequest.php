<?php

    namespace Fredattack\SupportTicketsNotifications\Http\FormRequest;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rule;

    class StoreTicketRequest extends FormRequest
    {
        public function authorize()
        {
            return true;
        }

        protected function prepareForValidation()
        {
            if ($this -> input('type') === 'fixe') {
                $this -> merge([ 'priority' => 5 , ]);
            }
            $this -> merge([ 'author_id' => \Auth::id() ,

                             ]);
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules()
        {
            return [
                'title' => [ 'required' ] ,
                'description' => [ 'required' ] ,
                'type' => [
                    'required' ,
                    Rule::in([ 'fixe' , 'help' , 'feature' ]),
                ] ,
                'priority' => [
                    'nullable' ,
                    'integer' ,
                    'digits_between:1,5',
                ],
                'author_id' => ['required'] ,

            ];
        }
    }
