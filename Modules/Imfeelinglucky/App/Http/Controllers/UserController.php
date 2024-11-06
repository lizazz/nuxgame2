<?php

namespace Modules\Imfeelinglucky\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Modules\Imfeelinglucky\App\DTO\CreateUserDTO;
use Modules\Imfeelinglucky\App\Http\Requests\RegisterRequest;
use Modules\Imfeelinglucky\App\Services\HashService;
use Modules\Imfeelinglucky\App\Services\UserService;

class UserController extends Controller
{
    public function __construct(public UserService $userService, public HashService $hashService) {}

    public function index()
    {
        return view('imfeelinglucky::index');
    }

    public function create()
    {
        return view('imfeelinglucky::index');
    }

    public function store(RegisterRequest $request): RedirectResponse
    {
        $user = $this->userService->createUser(new CreateUserDTO($request->username, $request->phonenumber));
        $hashedString = $this->hashService->getHash($user);
        $this->userService->setExpiredUserJob($user, $hashedString);

        return Redirect::route('imfeelinglucky.show', $hashedString);
    }
}
