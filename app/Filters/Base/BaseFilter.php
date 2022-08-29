<?php

namespace App\Filters\Base;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class BaseFilter
{
    /**
     * The request instance.
     *
     * @var Request
     */
    protected $request;

    /**
     * The data to filter.
     *
     * @var Array
     */
    protected $data;

    /**
     * Initialize a new filter.
     *
     * @param Request $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Apply the filters on the data.
     *
     * @param Array $data
     *
     * @return Array
     */
    public function apply(array $data): array
    {
        $this->data = $data;

        //$this->getDevExpressFilters();
        $columnFilters = $this->request->all();

        foreach ($columnFilters as $name => $value) {
            $name = Str::camel($name);
            if (method_exists($this, $name) && $value) {
                call_user_func_array(
                    [$this, $name],
                    [$value]
                );
            }
        }

        return $this->data;
    }
}
