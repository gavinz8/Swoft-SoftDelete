<?php

namespace Swoft\SoftDelete\Aspect;

use Swoft\Aop\Annotation\Mapping\Around;
use Swoft\Aop\Annotation\Mapping\Aspect;
use Swoft\Aop\Annotation\Mapping\PointExecution;
use Swoft\Aop\Point\ProceedingJoinPoint;
use Swoft\Db\Query\Builder;
use Throwable;

/**
 * Class SoftDeleteJoinAspect
 *
 * @Aspect()
 *
 * @PointExecution(include={
 *     "Builder::get",
 *     "Builder::exists",
 *     "Builder::pluck"
 * })
 *
 * @package App\Aspect
 */
class GetAspect extends Base
{
    /**
     * @Around()
     *
     * @param ProceedingJoinPoint $joinPoint
     * @return mixed
     * @throws Throwable
     */
    public function around(ProceedingJoinPoint $joinPoint)
    {
        /**
         * @var Builder $builder
         */
        $builder = $joinPoint->getTarget();

        if ( !in_array($builder->from, $this->ignore)
             && strpos($builder->from, 'information_schema') === false) {
            $from = $this->realTable($builder->from);
            $builder->whereNull("$from.{$this->column}");
        }

        return $joinPoint->proceed();
    }
}