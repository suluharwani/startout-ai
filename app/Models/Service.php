<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;

/**
 * Company services (e.g. Data Annotation, Trust & Safety, ...).
 */
final class Service extends Model
{
    protected string $table = 'services';

    protected array $fillable = [
        'slug',
        'name',
        'tagline',
        'short_description',
        'description',
        'icon',
        'image',
        'featured',
        'is_active',
        'sort_order',
    ];

    public static function active(string $orderBy = 'sort_order ASC'): array
    {
        $table = (new self())->table;
        $stmt  = Database::connection()->prepare(
            "SELECT * FROM `{$table}` WHERE is_active = 1 ORDER BY {$orderBy}"
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function featured(): array
    {
        $table = (new self())->table;
        $stmt  = Database::connection()->prepare(
            "SELECT * FROM `{$table}` WHERE is_active = 1 AND featured = 1 ORDER BY sort_order ASC"
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function bySlug(string $slug): ?array
    {
        return self::findBy('slug', $slug);
    }

    public static function existsSlug(string $slug, ?int $exceptId = null): bool
    {
        $pdo  = Database::connection();
        $stmt = $pdo->prepare(
            'SELECT COUNT(*) FROM services WHERE slug = :slug AND (:exceptId IS NULL OR id <> :exceptId)'
        );
        $stmt->execute(['slug' => $slug, 'exceptId' => $exceptId]);

        return (int) $stmt->fetchColumn() > 0;
    }
}
