<?php

namespace App\VueTables;


class EloquentVueTables implements VueTablesInterface
{
    public function get($model, Array $fields, Array $relations = [])
    {
        $byColumn = request('byColumn');
        $orderBy = request('orderBy');
        $limit = request('limit');
        $page = request('page');
        $ascending = request('ascending');
        $query = json_decode(request('query'), true);
        $data = $model->select($fields)->with($relations);

        if (request('status')) {
            $data->where('status', request('status'));
        }

        if (isset($query) && $query) {
            $data = $byColumn == 1 ? $this->filteredByColumn($data, $query) : $this->filter($data, $query, $fields);
        }

        $count = $data->count();
        $data->limit($limit)->skip($limit * ($page - 1));
        if (isset($orderBy)) {
            $direction = $ascending == 1 ? "ASC" : "DESC";
            $data->orderBy($orderBy, $direction);
        }

        $results = $data->get()->toArray();

        return [
            'data' => $results,
            'count' => $count,
        ];
    }

    protected function filter($data, $query, $fields)
    {
        foreach ($fields as $index => $field) {
            $method = $index ? "orWhere" : "where";
            $data->{$method}($fields, "LIKE", "%{$query}%");
        }

        return $data;
    }

    protected function filteredByColumn($data, $query)
    {
        foreach ($query as $field => $query) {
            if (!$query) {
                continue;
            }
            if (is_string($query) && $field !== "status") {
                $data->where($field, "LIKE", "%{$query}%");
            }
        }

        return $data;
    }
}