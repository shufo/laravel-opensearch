<?php

namespace Shufo\LaravelOpenSearch;

use Illuminate\Support\Facades\Facade as BaseFacade;


/**
 * Class Facade
 *
 * @package Shufo\LaravelOpenSearch
 */
class Facade extends BaseFacade
{

    /**
     * @inheritdoc
     */
    protected static function getFacadeAccessor()
    {
        return 'opensearch';
    }
}
