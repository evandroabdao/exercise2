<?php

namespace App\Http\Controllers\Web\Servers;

use App\Services\Servers\ServerService;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class ServerController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var ServerService $service
     */
    private $service;

    /**
     * @var ChainService $chainService
     */
    private $chainService;

    public function __construct(ServerService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     *
     * @return View
     */
    public function index(Request $request): View
    {
        return view("servers.server");
    }
}
