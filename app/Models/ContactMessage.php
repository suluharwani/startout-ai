<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;

/**
 * Contact form submissions.
 */
final class ContactMessage extends Model
{
    protected string $table = 'contact_messages';

    protected array $fillable = [
        'first_name',
        'last_name',
        'email',
        'company',
        'phone',
        'service',
        'message',
        'is_read',
    ];

    public static function unreadCount(): int
    {
        $table = (new self())->table;
        return (int) Database::connection()
            ->query("SELECT COUNT(*) FROM `{$table}` WHERE is_read = 0")
            ->fetchColumn();
    }

    public static function markRead(int $id): void
    {
        self::update($id, ['is_read' => 1]);
    }
}
