<?php
declare(strict_types=1);

namespace App\Core;

use PDO;
use PDOException;

/**
 * Database connection using PDO with prepared statements.
 * Creates the database on first run and delegates to the Installer
 * to ensure the schema and seed data exist.
 */
final class Database
{
    private static ?PDO $pdo = null;

    private function __construct()
    {
    }

    public static function connection(): PDO
    {
        if (self::$pdo === null) {
            self::boot();
        }
        return self::$pdo;
    }

    public static function boot(): void
    {
        if (self::$pdo !== null) {
            return;
        }

        self::createDatabaseIfMissing();

        $dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
            DB_HOST,
            DB_PORT,
            DB_NAME
        );

        try {
            self::$pdo = new PDO($dsn, DB_USER, DB_PASS, self::options());
        } catch (PDOException $e) {
            // Surface a friendly message instead of a stack trace.
            if (APP_ENV === 'local') {
                throw new PDOException('Could not connect to the database: ' . $e->getMessage());
            }
            http_response_code(500);
            exit('Database connection failed. Please check your configuration.');
        }

        // Ensure schema + seed data (idempotent).
        Installer::ensure(self::$pdo);
    }

    private static function createDatabaseIfMissing(): void
    {
        $serverDsn = sprintf('mysql:host=%s;port=%s;charset=utf8mb4', DB_HOST, DB_PORT);

        try {
            $server = new PDO($serverDsn, DB_USER, DB_PASS, self::options());
            $dbName = str_replace('`', '', DB_NAME);
            $server->exec(sprintf(
                'CREATE DATABASE IF NOT EXISTS `%s` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci',
                $dbName
            ));
        } catch (PDOException) {
            // DB may already exist / server may be unreachable — the main
            // connection below will surface the real error.
        }
    }

    private static function options(): array
    {
        return [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
    }
}
