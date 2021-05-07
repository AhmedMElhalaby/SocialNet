<?php

namespace App\Models;

use App\Helpers\Functions;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;

/**
 * @property integer id
 * @property mixed name
 * @property mixed email
 * @property mixed password
 * @property mixed date_of_birth
 * @property mixed image
 * @property mixed cover
 * @property mixed nationality
 * @property mixed information
 * @property mixed created_at
 * @property mixed updated_at
 * @method User find(int $id)
 */
class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    protected $fillable = ['name','email','password','date_of_birth','image','cover','nationality','information','created_at','updated_at',];

    protected $hidden = ['password'];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
    public function friends(): HasMany
    {
        return $this->hasMany(Friend::class);
    }
    public function isFriend(): bool
    {
        return (bool)Friend::where('user_id', auth()->user()->id)->where('friend_id', $this->id)->first();
    }
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getDateOfBirth()
    {
        return $this->date_of_birth;
    }

    /**
     * @param mixed $date_of_birth
     */
    public function setDateOfBirth($date_of_birth): void
    {
        $this->date_of_birth = $date_of_birth;
    }

    /**
     * @return mixed
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * @param mixed $nationality
     */
    public function setNationality($nationality): void
    {
        $this->nationality = $nationality;
    }

    /**
     * @return mixed
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * @param mixed $information
     */
    public function setInformation($information): void
    {
        $this->information = $information;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return ($this->image)?asset($this->image):null;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = Functions::StoreImageModel($image,'users/image');
    }
    /**
     * @return string|null
     */
    public function getCover(): ?string
    {
        return ($this->cover)?asset($this->cover):null;
    }

    /**
     * @param mixed $cover
     */
    public function setCover($cover): void
    {
        $this->cover = Functions::StoreImageModel($cover,'users/cover');
    }
}
