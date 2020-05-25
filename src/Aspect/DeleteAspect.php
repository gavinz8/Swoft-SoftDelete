<?php

namespace Swoft\SoftDelete\Aspect;

use Swoft\Aop\Annotation\Mapping\Around;
use Swoft\Aop\Annotation\Mapping\Aspect;
use Swoft\Aop\Annotation\Mapping\PointExecution;
use Swoft\Aop\Point\ProceedingJoinPoint;
use Swoft\Db\Query\Builder;
use Throwable;

/**
 * Class SoftDeleteAspect
 *
 * @Aspect()
 *
 * @PointExecution(include={
 *     "Builder::delete"
 * })
 *
 * @package App\Aspect
 */
class DeleteAspect extends Base
{
    /**
     * @Around()
     * @param ProceedingJoinPoint $proceedingJoinPoint
     * @return int
     * @throws Throwable
     */
    public function around(ProceedingJoinPoint $proceedingJoinPoint)
    {
        /**
         * @var Builder $target
         */
        $target = $proceedingJoinPoint->getTarget();
        return $target->update([$this->column => date("Y-m-d H:i:s")]);
    }
}