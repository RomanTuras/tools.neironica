<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'role'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function vocabularyThemes() {
        return $this->belongsToMany(VocabularyTheme::class);
    }

    public function vocabularyTranslate() {
        return $this->belongsToMany(VocabularyTranslate::class);
    }

    /**
     * Getting user by ID
     * @param $id
     *
     * @return Model|Builder|object|null
     */
    public static function getUser($id) {
        return DB::table('users')->where('id', '=', $id)->first();
    }

    /**
     * Getting all users
     * @return Collection
     */
    public static function getAllUsers() {
        return DB::table('users')->orderBy('name')->get();
    }

    /**
     * Change user role
     * @param $userId
     * @param $role
     */
    public function updateUserRole($userId, $role) {
        DB::table('users')->where('id', '=', $userId)->update(['role' => $role]);
    }

    /**
     * Delete user and all his data
     * @param $userId
     */
    public function deleteUser($userId) {
        $vt = new VocabularyTheme();
        $vt->deleteUsersThemes($userId);
        $vTrans = new VocabularyTranslate();
        $vTrans->deleteUsersTranslation($userId);
        DB::table('users')->where('id', '=', $userId)->delete();
    }

    /**
     * Getting role of auth user
     * @return mixed|null
     */
    public static function getRole() {
        $user_id = Auth::id();
        if ($user_id != null) {
            return DB::table('users')
                ->where('id', '=', $user_id)
                ->pluck('role')
                ->first();
        }
        return null;
    }
}
