<?php

namespace App\Http\Controllers\API\V1\Servers;

use App\Services\Servers\ServerService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class ServerController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var ServerService $service
     */
    private $service;

    /**
     * @param VendorTypeService $service
     */
    public function __construct(ServerService $service)
    {
        $this->service = $service;
    }

    /**
     */
    public function list()
    {
        return json_encode($this->service->getServerList());
    }
}
