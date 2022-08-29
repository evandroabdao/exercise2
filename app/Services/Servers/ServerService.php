<?php

namespace App\Services\Servers;

use App\Enums\ColumnsEnum;
use App\Filters\Servers\ServerFilter;
use App\Services\Base\BaseService;
use Shuchkin\SimpleXLSX;

class ServerService extends BaseService
{
    const SERVERS_XLS_PATH = '/var/www/storage/xlsx/LeaseWeb_servers_filters_assignment.xlsx';

    /** @var array */
    protected $data = [];

    /** @var ServerFilter */
    protected $filter = ServerFilter::class;

    public function __construct()
    {
        //Import records from excell file
        $this->data = SimpleXLSX::parse(self::SERVERS_XLS_PATH)->rows();
        
        //Remove column title row
        unset($this->data[0]);
    }
    
    /**
     * return Array
     */
    public function getServerList():array
    {
        //Instanciate the filter class
        $filter = app($this->filter);

        //Apply filter to data
        $this->data = $filter->apply($this->data);

        //Get records with DevExpress pluging structure
        $this->getDatatableResponse();
        
        return $this->data;
    }

    /**
     * @return void
     */
    protected function getDatatableResponse():void
    {
        $response['recordsFiltered'] = count($this->data);

        foreach ($this->data as $row) {
            $response['data'][] = [
                'model'=>$row[ColumnsEnum::COLUMN_MODEL],
                'ram'=>$row[ColumnsEnum::COLUMN_RAM],
                'hdd'=>$row[ColumnsEnum::COLUMN_HDD],
                'location'=>$row[ColumnsEnum::COLUMN_LOCATION],
                'price'=>$row[ColumnsEnum::COLUMN_PRICE],
            ];
        }
        

        $this->data = $response;

        //Unset variable not needed anymore
        unset($response);
    }
}
