<?php
    
    namespace App\Http\Resources;
    
    use Illuminate\Http\Resources\Json\JsonResource;

    class UserResource extends JsonResource
    {
        /**
         * @param \Illuminate\Http\Request $request
         *
         * @return array
         */
        public function toArray ( $request )
        {
            return [
                'id' => $this -> id ,
                'item'=>$this->full_name,
                'role'=>$this->roles
            ];
        }
    }
