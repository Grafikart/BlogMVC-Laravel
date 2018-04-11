<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Markdown
 *
 * @package App\Facades
 */
class Markdown extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \cebe\markdown\GithubMarkdown::class;
    }
}