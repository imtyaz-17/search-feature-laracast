<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    ];

    public function company():BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function scopeSearch($query, string $terms= null)
    {
        collect(str_getcsv($terms,' ','"'))->filter()->each(function ($term) use ($query) {
            $term =preg_replace('/[^A-Za-z0-9]/','',$term).'%';
//           $query->where(function ($query) use ($term) {
//               $query->where('full_name', 'like', $term)
//                   ->orWhere('email', 'like', $term)
//                   ->orWhereIn('company_id', Company::query()
//                   ->where('name', 'like', $term)
//                   ->pluck('id'));
//           });
            $query->whereIn('id', function($query) use ($term) {
                $query->select('id')
                    ->from(function ($query) use ($term) {
                        $query->select('id')
                            ->from('users')
                            ->where('full_name', $term)
                            ->orWhere('email', $term)
                            ->union(
                                $query->newQuery()
                                ->select('users.id')
                                ->from('users')
                                ->join('companies', 'companies.id', '=', 'users.company_id')
                                ->where('companies.name', $term)
                            );
                    }, 'matches');
            });
        });
    }
}
