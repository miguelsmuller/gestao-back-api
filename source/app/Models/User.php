<?php
namespace Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

use App\Traits\UseUuid;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, UseUuid;

    public $validacaoRegras = [
        //
    ];

    protected $fillable = [
        'name', 'email', 'password', 'pessoa_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * ONE TO ONE
     */
    public function pessoa(){
        return $this->belongsTo('Models\Pessoa');
    }
}
