<?php

namespace Modules\Imfeelinglucky\App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Modules\Imfeelinglucky\App\Http\Requests\ShowPageARequest;
use Modules\Imfeelinglucky\App\Services\HashService;
use Modules\Imfeelinglucky\App\Services\UserService;

class HashController
{
    public function __construct(public HashService $hashService, public UserService $userService) {}
    public function show(ShowPageARequest $request): View
    {
        return view('imfeelinglucky::pageA.show', [
            'hash' => $request->hash,
            'results' => null,
            'histories' => null
        ]);
    }

    public function generate(ShowPageARequest $request): RedirectResponse
    {
        $userId = $this->hashService->getUserId($request->get('hash'));
        $user = $this->userService->getUser($userId);
        $this->hashService->cancelDeleteUser($user);
        $hashedString = $this->hashService->getNewHash($user, $request->get('hash'));
        $this->userService->setExpiredUserJob($user, $hashedString);

        return Redirect::route('imfeelinglucky.show', $hashedString);
    }

    public function deactivate(ShowPageARequest $request): RedirectResponse
    {
        $userId = $this->hashService->getUserId($request->get('hash'));
        $user = $this->userService->getUser($userId);
        $this->hashService->cancelDeleteUser($user);
        $this->hashService->clearCache($user, $request->get('hash'));
        $this->userService->deleteUser($user);

        return Redirect::route('user.create');
    }
}
