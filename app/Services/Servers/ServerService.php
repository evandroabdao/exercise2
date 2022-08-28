<?php

namespace App\Services\Servers;

use App\Filters\Servers\ServerFilter;
use Illuminate\Support\Str;
use Shuchkin\SimpleXLSX;

class ServerService
{
    const SERVERS_XLS_PATH = '/var/www/storage/xlsx/LeaseWeb_servers_filters_assignment.xlsx';

    private $data = [];

    private $filter = ServerFilter::class;

    public function __construct()
    {
        $this->data = SimpleXLSX::parse(self::SERVERS_XLS_PATH)->rows();
    }
    
    /**
     * return Array
     */
    public function getServerList():array
    {
        $filter = app($this->filter);

        return $filter->apply($this->data);
    }
}
