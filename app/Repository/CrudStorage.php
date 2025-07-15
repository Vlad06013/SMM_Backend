<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use RuntimeException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Класс CRUD операций репозиториев
 *
 * @property string $model
 */
abstract class CrudStorage
{
    public static ?string $model = null;

    /**
     * Создание
     *
     * @param Model $model
     * @return Model
     * @throws RuntimeException
     */
    public static function store(Model $model): Model
    {
        try {
            return app(static::$model)->create($model->toArray());
        } catch (\Throwable $th) {
            throw new RuntimeException('Ошибка создания.',Response::HTTP_FORBIDDEN);
        }
    }

    /**
     * Получение списка
     *
     * @return Collection<Model>
     * @throws RuntimeException
     */
    public function index(): Collection
    {
        try {
            return app(static::$model)->all();
        } catch (\Throwable $th) {
            throw new RuntimeException('Ошибка списка.', Response::HTTP_FORBIDDEN);
        }
    }

    /**
     * Получение по ИД
     *
     * @param int $id
     * @return Model|null
     * @throws RuntimeException
     */
    public function show(int $id): ?Model
    {
        try {
            return app(static::$model)->findOrFail($id);
        } catch (\Throwable $th) {
            throw new RuntimeException('Не найдено.', Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Обновление
     *
     * @param Model $model
     * @return bool
     * @throws RuntimeException
     */
    public function update(Model $model): bool
    {
        try {
            return app(static::$model)->where('id', $model->getKey())->update($model->toArray());
        } catch (\Throwable $th) {
            throw new RuntimeException('Ошибка обновления.', Response::HTTP_FORBIDDEN);
        }
    }

    /**
     * Удаление
     *
     * @param int $id
     * @return Model|null
     * @throws RuntimeException
     */
    public function destroy(int $id): ?Model
    {
        try {
            $model = $this->show($id);
            $model->delete();
        } catch (\Throwable $th) {
            throw new RuntimeException('Ошибка удаления. '.$th->getMessage(), $th->getCode());
        }

        return $model;
    }
}
