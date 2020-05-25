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
 *     "Builder::join"
 * })
 *
 * @package App\Aspect
 */
class JoinAspect extends Base
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
        $joinPoint->proceed();
        $args = $joinPoint->getArgs();
        $from = $args[0];
        $as_pos = strpos($from, ' as ');
        if ($as_pos !== false) {
            $from = substr($from, $as_pos + 4);
            $from .= ".{$this->column}";
        } else {
            $from .= ".{$this->column}";
        }

        return $builder->whereNull($from);
    }
}