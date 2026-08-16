<?php
declare(strict_types=1);

namespace App\Models;

/**
 * Dynamic pages (currently used for extra static content pages).
 */
final class Page extends Model
{
    protected string $table = 'pages';

    protected array $fillable = [
        'slug',
        'title',
        'subtitle',
        'content',
        'meta_title',
        'meta_description',
        'is_active',
    ];

    public static function bySlug(string $slug): ?array
    {
        $row = self::findBy('slug', $slug);
        if ($row === null || (int) $row['is_active'] !== 1) {
            return null;
        }
        return $row;
    }
}
