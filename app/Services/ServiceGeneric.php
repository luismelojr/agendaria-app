<?php

namespace App\Services;

class ServiceGeneric
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function findFilterAll(array $filters = null, array $sorts = null, int $perPage = null)
    {
        $filters = $filters ?? [];
        $sorts = $sorts ?? [];

        return $this->model->filter($filters)->sort($sorts)->paginate($perPage);
    }
}
