<?php

namespace Muan\Admin\Http\DataTable;

use Illuminate\Http\JsonResponse;

/**
 * Trait ExtendDataTableController
 *
 * @package Muan\Admin\Http\DataTable
 */
trait ExtendDataTableController
{

    /**
     * Get columns
     *
     * @return array
     */
    abstract protected function getColumns() : array;

    /**
     * Get actions
     *
     * @return array
     */
    abstract protected function getActions() : array;

    /**
     * Get model class
     *
     * @return string
     */
    abstract protected function entity() : string;

    /**
     * Resolve entity entity
     *
     * @return mixed
     */
    protected function resolveEntity()
    {
        return app()->make($this->entity());
    }

    /**
     * Get columns key
     *
     * @return array
     */
    protected function getColumnsKey() : array
    {
        $result = [];

        foreach ($this->getColumns() as $key => $value) {
            $result[] = is_numeric($key) ? $value : $key;
        }

        return $result;
    }

    /**
     * Get default per page
     *
     * @return int
     */
    protected function getDefaultPerPage() : int
    {
        return (int) config('admin.default_per_page', 10);
    }

    /**
     * Prepare query
     *
     * @param $query
     * @return mixed
     */
    protected function prepareQuery($query)
    {
        // Rewrite if need
        return $query;
    }

    /**
     * Clear item
     *
     * @param array $item
     * @return mixed
     */
    private function clearItem(array $item) : array
    {
        $keys = (array) $this->getColumnsKey();

        foreach (array_keys($item) as $key) {
            if (! in_array($key, $keys)) {
                unset($item[$key]);
            }
        }

        return $item;
    }

    /**
     * Prepare item before send
     *
     * @param array $item
     * @return mixed
     */
    protected function prepareItem(array $item) : array
    {
        // Rewrite if need
        return $item;
    }

    /**
     * Get real field, use for fix paginate
     *
     * @param string $field
     * @return string
     */
    protected function getRealField(string $field) : string
    {
        // Rewrite if need
        return $field;
    }

    /**
     * Custom filter
     *
     * @param $builder
     * @param string $field
     * @param mixed $value
     * @return bool
     */
    protected function customFilter($builder, $field, $value)
    {
        return false;
    }

    /**
     * Get data from database
     *
     * @return mixed
     * @throws \Exception
     */
    protected function searchPaginateAndOrder()
    {
        $request = request();
        $request->validate([
            'column'    => 'alpha_dash|in:' . implode(',', $this->getColumnsKey()),
            'direction' => 'in:asc,desc',
            'per_page'  => 'integer|min:1',
        ]);

        $builder = $this->prepareQuery($this->resolveEntity());

        if ($request->has('column')) {
            $builder = $builder->orderBy($request->column, $request->get('direction', 'desc'));
        }

        if ($filters = $request->filters) {
            foreach ($filters as $field => $value) {
                if ($this->customFilter($builder, $field, $value)) {
                    continue;
                }
                if (is_string($value)) {
                    $builder->where($this->getRealField($field), 'like', "%{$value}%");
                }
                // TODO: Between filters if is_array($value)
            }
        }

        return $builder->paginate($request->get('per_page', $this->getDefaultPerPage()));
    }

    /**
     * Get data
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function data() : JsonResponse
    {
        // Get data
        $model = $this->searchPaginateAndOrder();
        $model = $model->toArray();

        // Use for change data before send
        foreach ($model['data'] as &$item) {
            $item = $this->prepareItem($item);
            $item = $this->clearItem($item);
        }

        return response()->json([
            'model'   => $model,
            'columns' => $this->getColumns(),
            'actions' => $this->getActions(),
        ]);
    }

}
