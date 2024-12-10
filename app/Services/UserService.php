<?php
namespace App\Services;

use App\Contracts\UserContract;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserService extends BaseService implements UserContract {
    protected $searchable = [
        'name',
        'email',
    ];
    
    public function getBlankModel(): Model
    {
        return new User();
    }
}
