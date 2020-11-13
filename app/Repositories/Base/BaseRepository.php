<?php

namespace App\Repositories\Base;

use Illuminate\Container\Container as Application;
use Prettus\Repository\Eloquent\BaseRepository as BaseRepo;

abstract class BaseRepository extends BaseRepo
{
    protected $_repository;

    public function __construct(Application $app)
    {
        $this->setValidator(app($this->validator()));
        parent::__construct($app);
    }

    public function getValidator()
    {
        return $this->validator;
    }

    public function setValidator($validator)
    {
        return $this->validator = $validator;
    }

    public function getRepository()
    {
        return $this->_repository;
    }

    public function setRepository($repository)
    {
        return $this->_repository = $repository;
    }

    public function model()
    {
        return "";
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setModel($model)
    {
        return $this->model = $model;
    }

    public function getListForBackEnd()
    {
        $params = request()->all();
        $query = $this->withActive();
        $searchId = array_get($params, 'id');
        $searchUserName = array_get($params, 'username');
        $searchEmail = array_get($params, 'email');
        $searchRoleType = array_get($params, 'role_type');
        $sortType = array_get($params, 'sort_type');
        $sortField = array_get($params, 'sort_field');
        $searchStatus = array_get($params, 'status');

        if (!is_null($searchId)) {
            $query->where('id', $searchId);
        }

        if (!is_null($searchUserName)) {
            $query->where('username', 'like', '%' . $searchUserName . '%');
        }

        if (!is_null($searchEmail)) {
            $query->where('email', $searchEmail);
        }

        if (!is_null($searchRoleType)) {
            $query->where('role_type', $searchRoleType);
        }

        if (!is_null($searchStatus)) {
            $query->where('status', $searchStatus);
        }

        if (!is_null($sortField)) {
            $query->orderBy($sortField, $sortType);
        }

        return $query->paginate(getConstant('BACKEND_PAGINATE', 20));
    }

    public function __call($method, $params)
    {
        return call_user_func_array([$this->getModel(), $method], $params);
    }

    public function findById($id)
    {
        return $this->where('id', $id)->withActive()->first();
    }

    public function getListForFrontend()
    {
        return $this->paginate(getConstant('FRONTEND_PAGINATE', 20));
    }


    // ========== PROTECTED AREA ==========

    /**
     * @param $query
     * @param array $queryString
     * @return mixed
     */
    protected function _buildSearchQuery($query, $queryString = [])
    {
        $mainTable = $this->getModel()->getModel()->getTable();

        $mapOperator = [
            'eq' => '=',
            'contains' => 'like',
        ];

        foreach ($queryString as $key => $value) {
            if (is_null($value) || $key == Url::QUERY) {
                continue;
            }

            $field = $mainTable . '.' .array_get(explode('_', $key), 0);
            $operatorAlias = array_get(explode('_', $key), 1);

            if (is_null($operatorAlias)) {
                continue;
            }

            $operator = $mapOperator[$operatorAlias];

            switch ($operatorAlias) {
                case $operatorAlias == 'eq':
                    $query->where($field, $operator, $value);
                    break;

                case $operatorAlias == 'contains':
                    $query->where($field, $operator, '%' . $value . '%');
                    break;
            }
        }

        return $query;
    }
}
