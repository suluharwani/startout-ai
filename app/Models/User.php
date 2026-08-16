<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use DateTimeImmutable;

/**
 * Admin users.
 */
final class User extends Model
{
    protected string $table = 'users';

    protected array $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
        'last_login',
    ];

    public static function attempt(string $email, string $password): ?array
    {
        $user = self::findBy('email', $email);

        if ($user === null || (int) $user['is_active'] !== 1) {
            return null;
        }

        if (!password_verify($password, (string) $user['password'])) {
            return null;
        }

        // Refresh hash if needed (rehash support).
        if (password_needs_rehash((string) $user['password'], PASSWORD_DEFAULT)) {
            self::update((int) $user['id'], ['password' => password_hash($password, PASSWORD_DEFAULT)]);
        }

        self::update((int) $user['id'], [
            'last_login' => (new DateTimeImmutable())->format('Y-m-d H:i:s'),
        ]);

        unset($user['password']);
        return $user;
    }

    public static function changePassword(int $id, string $newPassword): void
    {
        self::update($id, ['password' => password_hash($newPassword, PASSWORD_DEFAULT)]);
    }
}
