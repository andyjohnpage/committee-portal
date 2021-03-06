<?php

namespace App;

use App\Packages\ControlDB\ControlDBInterface;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'admin' => 'boolean'
    ];
    // Logging into a group

    /**
     * Get the control database ID
     *
     * @return int
     */
    public function getControlID()
    {
        return $this->control_id;
    }

    /**
     * Call the trait function to get the positions for yourself
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function getPositionsForUser()
    {
        return $this->getPositionsFromControl($this->getControlID());
    }

    public function isAdmin()
    {
        return $this->admin;
    }


}
