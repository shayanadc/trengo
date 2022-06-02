<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Review extends Model
{
    use HasFactory;
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = ['rate', 'article_id', 'ip'];

    /**
     * Scope a query to only include popular users.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeIp($query, $ip): Builder
    {
        return $query->where('ip', $ip);
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeArticle($query, $ip): Builder
    {
        return $query->where('article_id', $ip);
    }

    public static function getRateAverage()
    {
        $result = DB::select("SELECT article_id,
            ROUND(( ( avg_num_votes * avg_stars ) + ( this_num_votes * this_stars ) ) / ( avg_num_votes + this_num_votes ), 2)
            AS rate FROM
             ( SELECT article_id, (SELECT COUNT(article_id) FROM reviews)
            / (SELECT COUNT(DISTINCT article_id) FROM reviews) AS avg_num_votes,
            (SELECT AVG(rate) FROM reviews) AS avg_stars, COUNT(rate) AS this_num_votes, AVG(rate) AS this_stars FROM reviews GROUP BY article_id)
                AS bayes");

        return json_decode(json_encode($result), true);

    }
}
