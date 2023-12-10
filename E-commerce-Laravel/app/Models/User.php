<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

use Illuminate\Foundation\Auth\User as Authenticatable; // The base class for Eloquent model. Eloquent itself extends Model whcih allows us to apply HasOne
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Laravel\Sanctum\HasApiTokens;



class User extends Authenticatable implements JWTSubject 
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'users_id';

    // It is typically used on the model that doesn't contain the foreign key but is related to the model that does.
    // In a hasOne relationship, the foreign key is on the table of the model that "has one" of another
    // public function role(): HasOne{   //  this is a one tone relationship where the user has one role
    //     return $this->hasOne(Role::class); // assignes the one-to-one relation
    // }


    // Role => is the target model class
    // first 'role_id' is the column un Users which is the foreign key
    // second 'role_id' is the primary key Roles
    // $user->role->description to access description
    // Used on the Model that contains the foreign key
    public function role(): BelongsTo { // this is a belongs to relationship where a user belongs to a role
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }


    // $user = User::find($req->user_id);
    // echo $user->role_id ;  to access the foreign key we create an instance of User
    public function getPersonWithRole($users_id){
        return self::with('role') -> find($users_id);
    }


    // public function shoppingKarts()
    // {
    //     return $this->hasOne(ShoppingKart::class, 'user_id');
    // }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    //  protected $guarded = []; for non-mass assignment
    protected $fillable = [ // this is for mass assignment 
        'username',
        'email',
        'password', 
        'role_id', 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

        // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [
            'email' => $this -> email,
            'users_id' => $this -> users_id,
            // 'password' => $this->password,
            'role_id' => $this -> role_id
        ];
    }
}
