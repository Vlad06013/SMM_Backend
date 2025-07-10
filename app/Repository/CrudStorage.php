<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

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
     */
    public static function store(Model $model): Model
    {
        return app(static::$model)->create($model->toArray());
    }

    /**
     * Получение списка
     *
     * @return Collection<Model>
     */
    public function index(): Collection
    {
        return app(static::$model)->all();
    }

    /**
     * Получение по ИД
     *
     * @param int $id
     * @return Model|null
     */
    public function show(int $id): ?Model
    {
        return app(static::$model)->findOrFail($id);
    }

    /**
     * Обновление
     *
     * @param Model $model
     * @return bool
     */
    public function update(Model $model): bool
    {
        return app(static::$model)->where('id', $model->getKey())->update($model->toArray());
    }

    /**
     * Удаление
     *
     * @param int $id
     * @return Model|null
     */
    public function destroy(int $id): ?Model
    {
        if ($model = app(static::$model)->findOrFail($id))
            $model->delete($id);
        return $model;
    }
}
