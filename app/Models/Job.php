<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;

/**
 * Job openings on the Careers page.
 */
final class Job extends Model
{
    protected string $table = 'jobs';

    protected array $fillable = [
        'title',
        'category',
        'location',
        'type',
        'description',
        'is_active',
        'sort_order',
    ];

    public static function active(): array
    {
        $table = (new self())->table;
        $stmt  = Database::connection()->prepare(
            "SELECT * FROM `{$table}` WHERE is_active = 1 ORDER BY sort_order ASC"
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
