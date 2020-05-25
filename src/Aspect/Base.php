<?php


namespace Swoft\SoftDelete\Aspect;


class Base
{
    protected $column;

    protected $ignore;

    public function __construct()
    {
        $this->column = \config('soft_delete.column', 'deleted_at');
        $this->ignore = array_merge(\config('soft_delete.ignore', []), ['migration']);
    }

    final protected function realTable($from)
    {
        $as_pos = strpos($from, ' as ');
        if ($as_pos !== false) {
            $from = substr($from, $as_pos + 4);
        }

        return $from;
    }
}