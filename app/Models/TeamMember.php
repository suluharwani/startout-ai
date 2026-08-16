<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;

/**
 * Leadership / team members.
 */
final class TeamMember extends Model
{
    protected string $table = 'team_members';

    protected array $fillable = [
        'name',
        'position',
        'bio',
        'photo',
        'linkedin',
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
