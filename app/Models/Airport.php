<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    use HasFactory;

    protected $fillable = [
        'iata_code',
        'name',
        'city',
        'country_code',
        'country_name',
        'latitude',
        'longitude',
        'timezone',
        'is_active',
        'last_updated',
        'raw_data',
    ];

    protected $casts = [
        'latitude'     => 'float',
        'longitude'    => 'float',
        'is_active'    => 'boolean',
        'last_updated' => 'datetime',
        'raw_data'     => 'array',
    ];

    public static function searchByKeyword($keyword)
    {
        return self::where('city', 'LIKE', "%{$keyword}%")
            ->orWhere('name', 'LIKE', "%{$keyword}%")
            ->orWhere('iata_code', 'LIKE', "%{$keyword}%")
            ->orWhere('country_name', 'LIKE', "%{$keyword}%")
            ->where('is_active', true)
            ->get();
    }

    public static function getByIataCode($iataCode)
    {
        return self::where('iata_code', $iataCode)->first();
    }

}