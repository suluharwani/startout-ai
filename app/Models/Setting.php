<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;

/**
 * Site settings (company profile). Stored as key/value rows.
 */
final class Setting extends Model
{
    protected string $table = 'settings';

    protected array $fillable = ['setting_key', 'setting_value'];

    public static function get(string $key, string $default = ''): string
    {
        $stmt = Database::connection()->prepare(
            'SELECT setting_value FROM settings WHERE setting_key = :key LIMIT 1'
        );
        $stmt->execute(['key' => $key]);

        $row = $stmt->fetch();
        return $row === false ? $default : (string) $row['setting_value'];
    }

    public static function allAsMap(): array
    {
        $rows = self::all('setting_key ASC');

        $map = [];
        foreach ($rows as $row) {
            $map[$row['setting_key']] = $row['setting_value'];
        }
        return $map;
    }

    /**
     * Upsert a single setting.
     */
    public static function set(string $key, string $value): void
    {
        $pdo = Database::connection();

        $stmt = $pdo->prepare(
            'INSERT INTO settings (setting_key, setting_value)
             VALUES (:key, :value)
             ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)'
        );
        $stmt->execute(['key' => $key, 'value' => $value]);
    }
}
