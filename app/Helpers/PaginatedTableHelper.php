<?php
namespace App\Helpers;

class PaginatedTableHelper
{
    private $numOfRows;

    public function __construct()
    {
        $numOfRows = 25;
    }

    protected function getField(array $columns, $dbModel, $preConditionField, $preConditionQuery)
    {
        foreach ($columns as $column) {
            if (request()->has($column)) {
                if ($preConditionField !=null) {
                    $dbModel = $dbModel->where($preConditionField, $preConditionQuery)
                        ->where($column, request($column));
                }
            }
        }
        return $dbModel;
    }
    protected function getQueries(array $columns)
    {
        $queries = [];

        foreach ($columns as $column) {
            if (request()->has($column)) {
                $queries[$column] = request($column);
            }
        }
        return $queries;
    }
    protected function getSortCondition(array $queries)
    {
        if (request()->has('sort')) {
            $queries['sort'] = request('sort');
        }
        return $queries;
    }
    protected function setOrderByCondition($dbModel, $fieldName)
    {
        if (request()->has('sort')) {
            $dbModel = $dbModel->orderBy("{$fieldName}", request('sort'));
        }

        return $dbModel;
    }
    protected function paginateModel($dbModel, $orderByColumn)
    {
        $dbModel = $dbModel->paginate($this->numOfRows)->appends(
            [
                "{$orderByColumn}" => request("{$orderByColumn}"),
                "sort" => request("sort"),
            ]
        );
        return $dbModel;
    }


    public function buildPaginatedTable($dbModel, $orderByColumn, $preConditionField=null, $preConditionQuery=null)
    {
        if (null != request("field")) {
            $field = request("field");
            $query = request("query");
            if (null != request("dateQuery")) {
                $query = request("dateQuery");
                if (null != request("dateQueryEnd")) {
                    $endQuery = request("dateQueryEnd");
                    if ($preConditionField !=null) {
                        $dbModel = $dbModel->where($preConditionField, $preConditionQuery)
                            ->whereBetween($field, [$query, $endQuery]);
                    }
                }
            } else {
                $operators = array(
                    "<", ">", "<=", ">=", "=", "==", "<>", "!=", "AND", "and", "BETWEEN", "between", "OR", "or", "In", "in", "NOT", "not", "is null", "IS NULL",
                    "is not null", "IS NOT NULL"
                );

                $operatorNotFound = true;
                foreach ($operators as $key => $value) {
                    if (strpos($query, $value) !== false) {
                        $array = explode($value, $query);
                        if ($preConditionField !=null) {
                            $dbModel = $dbModel->where($preConditionField, $preConditionQuery)
                                ->where($field, $value, $array[1]);
                        }

                        $operatorNotFound = false;
                    }
                }
                if ($operatorNotFound) {
                    if ($preConditionField !=null) {
                        $dbModel =     $dbModel->where($preConditionField, $preConditionQuery)
                        ->where($field, 'LIKE', '%' . $query . '%');
                    }
                }
            }
            $orderByColumn = $field;
            $dbModel = $this->setOrderByCondition($dbModel, $orderByColumn);
            $dbModel = $this->paginateModel($dbModel, $orderByColumn);
        } else {
            if ($preConditionField !=null) {
                $dbModel = $dbModel->where($preConditionField, $preConditionQuery);
            }

         
            $dbModel = $this->setOrderByCondition($dbModel, $orderByColumn);
            $dbModel = $this->paginateModel($dbModel, $orderByColumn);
        }
        return $dbModel;
    }
}
