<?php

namespace Modules\Imfeelinglucky\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Modules\Imfeelinglucky\App\Http\Requests\ShowPageARequest;
use Modules\Imfeelinglucky\App\Services\HashService;
use Modules\Imfeelinglucky\App\Services\ImfeelingluckyService;

class ImfeelingluckyController extends Controller
{
    public function __construct(public ImfeelingluckyService $imfeelingluckyService, public HashService $hashService){}

    public function try(ShowPageARequest $request): View
    {
        $results = $this->imfeelingluckyService->getResults();
        $userId = $this->hashService->getUserId($request->get('hash'));
        $this->imfeelingluckyService->saveResults($userId, $results);

        return view(
            'imfeelinglucky::pageA.show', [
                'hash' => $request->get('hash'),
                'results' => $results,
                'histories' => null
            ]
        );
    }

    public function history(ShowPageARequest $request): View
    {
        $userId = $this->hashService->getUserId($request->get('hash'));

        return view('imfeelinglucky::pageA.show', [
            'hash' => $request->hash,
            'results' => null,
            'histories' => $this->imfeelingluckyService->getHistory($userId)
        ]);
    }
}
