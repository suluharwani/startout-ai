<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

/**
 * Base model — provides safe CRUD built on PDO prepared statements.
 * Table / column names are hard-coded per model (never user input),
 * values are always bound as parameters (SQL-injection safe).
 */
abstract class Model
{
    protected string $table = '';

    protected string $primaryKey = 'id';

    /** @var array<int, string> Whitelisted columns for create/update. */
    protected array $fillable = [];

    public function __construct()
    {
        if ($this->table === '') {
            throw new \RuntimeException('Model must define a $table property.');
        }
    }

    /* ── Queries ──────────────────────────────────────────────── */

    public static function all(string $orderBy = 'id ASC'): array
    {
        $table = (new static())->table;
        $stmt  = Database::connection()->prepare("SELECT * FROM `{$table}` ORDER BY {$orderBy}");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $table = (new static())->table;
        $pk    = (new static())->primaryKey;

        $stmt = Database::connection()->prepare("SELECT * FROM `{$table}` WHERE `{$pk}` = :id LIMIT 1");
        $stmt->execute(['id' => $id]);

        $row = $stmt->fetch();
        return $row === false ? null : $row;
    }

    public static function findBy(string $column, mixed $value): ?array
    {
        $table = (new static())->table;

        $stmt = Database::connection()->prepare("SELECT * FROM `{$table}` WHERE `{$column}` = :value LIMIT 1");
        $stmt->execute(['value' => $value]);

        $row = $stmt->fetch();
        return $row === false ? null : $row;
    }

    public static function where(string $column, mixed $value, string $orderBy = 'id ASC'): array
    {
        $table = (new static())->table;

        $stmt = Database::connection()->prepare("SELECT * FROM `{$table}` WHERE `{$column}` = :value ORDER BY {$orderBy}");
        $stmt->execute(['value' => $value]);
        return $stmt->fetchAll();
    }

    public static function count(): int
    {
        $table = (new static())->table;
        return (int) Database::connection()->query("SELECT COUNT(*) FROM `{$table}`")->fetchColumn();
    }

    /* ── Mutations ────────────────────────────────────────────── */

    public static function create(array $data): int
    {
        $model    = new static();
        $table    = $model->table;
        $fillable = $model->fillable;

        $clean  = self::filter($data, $fillable);
        $fields = implode(', ', array_map(static fn (string $c) => "`{$c}`", array_keys($clean)));
        $marks  = implode(', ', array_map(static fn (string $c) => ":{$c}", array_keys($clean)));

        $stmt = Database::connection()->prepare("INSERT INTO `{$table}` ({$fields}) VALUES ({$marks})");
        $stmt->execute($clean);

        return (int) Database::connection()->lastInsertId();
    }

    public static function update(int $id, array $data): bool
    {
        $model    = new static();
        $table    = $model->table;
        $pk       = $model->primaryKey;
        $fillable = $model->fillable;

        $clean  = self::filter($data, $fillable);
        $set    = implode(', ', array_map(static fn (string $c) => "`{$c}` = :{$c}", array_keys($clean)));

        $stmt = Database::connection()->prepare("UPDATE `{$table}` SET {$set} WHERE `{$pk}` = :pk");
        $stmt->execute(array_merge($clean, ['pk' => $id]));

        return true;
    }

    public static function delete(int $id): bool
    {
        $model = new static();
        $table = $model->table;
        $pk    = $model->primaryKey;

        $stmt = Database::connection()->prepare("DELETE FROM `{$table}` WHERE `{$pk}` = :id");
        $stmt->execute(['id' => $id]);

        return true;
    }

    /* ── Helpers ──────────────────────────────────────────────── */

    private static function filter(array $data, array $fillable): array
    {
        $clean = [];
        foreach ($fillable as $column) {
            if (array_key_exists($column, $data)) {
                $clean[$column] = $data[$column];
            }
        }
        return $clean;
    }
}
