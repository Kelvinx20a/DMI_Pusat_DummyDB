<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $connection = 'wordpress';
    protected $table = 'ism13qf_users'; 
    protected $primaryKey = 'ID'; 
    public $timestamps = false; 

    protected $fillable = [
        'user_login',
        'user_nicename',
        'user_email',
        'user_pass',
        'display_name',
        'user_status',
        'user_url',
        'user_activation_key',
    ];

    protected $hidden = [
        'user_pass',
        'remember_token',
    ];

    public function getAuthIdentifierName()
    {
        return 'ID';
    }

    public function getAuthPassword()
    {
        return $this->user_pass;
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }

    public function meta()
    {
        return $this->hasMany(UserMeta::class, 'user_id', 'ID');
    }

    public function getRoleLabelAttribute(): string
    {
        $capabilitiesMeta = $this->meta->firstWhere('meta_key', 'lsM13Qf_capabilities');

        if (!$capabilitiesMeta) {
            return 'Subscriber';
        }

        $capabilities = @unserialize($capabilitiesMeta->meta_value);

        if (!is_array($capabilities)) {
            return 'Subscriber';
        }

        if (isset($capabilities['administrator'])) return 'Administrator';
        if (isset($capabilities['editor'])) return 'Editor';
        if (isset($capabilities['author'])) return 'Author';
        if (isset($capabilities['contributor'])) return 'Contributor';
        if (isset($capabilities['subscriber'])) return 'Subscriber';

        return ucfirst(array_key_first($capabilities));
    }

    public function getPostsCountAttribute(): int
    {
        return \DB::connection('wordpress')
            ->table('ism13qf_posts')
            ->where('post_author', $this->ID)
            ->where('post_status', 'publish')
            ->where('post_type', 'post')
            ->count();
    }
}
