<?php
    
    
    namespace Fredattack\SupportTicketsNotifications\Http\FormRequest;
    
    
    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rule;

    class StoreMessageRequest extends FormRequest
    {
        public function authorize ()
        {
            return true;
        }
    
    
        protected function prepareForValidation()
        {
            
            $this->merge([
                             'author_id' => \Auth::id (),
                
                         ]);
        }
        
        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules ()
        {
            return [
                'text' => [Rule::requiredIf(!request()->has('attachments')),'string','nullable'] ,
                'author_id' => ['required'] ,
               
                

            ];
        }
    }
