<?php

namespace App\Providers\User;

use Illuminate\Auth\GenericUser;
use Illuminate\Contracts\Auth\{Authenticatable,UserProvider};
use Illuminate\Support\ServiceProvider;

class SimpleUserProvider implements UserProvider{
    
    private GenericUser $user;

    public function __construct(){
        $this->user=new GenericUser([
            "id" => "fajar",
            "name" => "Fajar",
            "token" => "secret"
        ]);
    }

    public function retrieveByCredentials(array $credentials){
        if($credentials["token"] == $this->user->__get("token")){
            return $this->user;
        }

        return null;
    }

    public function retrieveById($identifier)
    {
        // TODO: Implement retrieveById() method.
    }

    public function retrieveByToken($identifier, $token)
    {
        // TODO: Implement retrieveByToken() method.
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // TODO: Implement updateRememberToken() method.
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        // TODO: Implement validateCredentials() method.
    }
}
