<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Veelasky\LaravelHashId\Eloquent\HashableId;

class Url extends Model
{
    use HashableId;
    use HasFactory;

    protected $table = 'url';

    protected $primaryKey = 'id';

    // add this property to your model if you want to persist to the database.
    protected $shouldHashPersist = true;

    // by default, the persisted value will be stored in `hashid` column
    // override column name to your desired name.
    protected $hashColumnName = 'slug';

    protected $fillable = [
        'destination',
        'views',
        'description',
        'state',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    public function scopeFilter(Builder $query, Request $request): Builder
    {
        $state = $request->query('state', null);
        if (!is_null($state)) {
            $query = $query->where('state', $state);
        }

        return $query;
    }

    /**
     * Get the url's shorten full address.
     *
     * @return string
     */
    public function getShortUrlAttribute(): string
    {
        return url('/') . "/" . $this->slug;
    }
}
