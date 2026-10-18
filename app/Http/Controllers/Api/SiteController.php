<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Data\Sites\CreateSiteData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CreateSiteRequest;
use App\Http\Resources\Api\SiteResource;
use App\Models\Site;
use App\Services\SiteService;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        //
    }

    public function store(
        CreateSiteRequest $request,
        SiteService $service,
    ): SiteResource {
        $site = $service->create(
            data: CreateSiteData::fromRequest($request),
        );

        return new SiteResource($site);
    }

    public function show(Site $site): SiteResource
    {
        return new SiteResource($site);
    }

    public function update(Request $request, Site $site)
    {
        //
    }

    public function destroy(Site $site)
    {
        //
    }
}
