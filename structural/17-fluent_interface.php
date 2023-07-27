<?php

class QueryBuilder
{
    private array $select = [];
    private array $from = [];
    private array $where = [];

    public function select(array $select): QueryBuilder
    {
        $this->select = $select;
        return $this;
    }

    public function from(array $from): QueryBuilder
    {
        $this->from = $from;
        return $this;
    }

    public function where(array $where): QueryBuilder
    {
        $this->where = $where;
        return $this;
    }

    public function get(): string
    {
        return sprintf(
            "SELECT %s FROM %s WHERE %s;",
            join(', ', $this->select),
            join(', ', $this->from),
            join(' AND ', $this->where),
        );
    }
}

$queryBuilder = new QueryBuilder();
$query = $queryBuilder->select(['id', 'title'])->from(['posts'])->where(['view_count > 20'])->get();
var_dump($query);
