<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\ImFeelingLuckyRepository;
use App\Repositories\UserRepository;
use App\Services\ImFeelingLuckyService;
use Illuminate\Support\Collection;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{

    /**
     * @param UserRequest $request
     * @param UserRepository $userRepository
     * @return RedirectResponse
     */
    public function register(UserRequest $request, UserRepository $userRepository): RedirectResponse
    {
        $user = $userRepository->register($request->only('username', 'phonenumber'));
        return redirect()->to($user->createLink());

    }

    /**
     * @param User $user
     * @return Response
     */
    public function show(User $user): Response
    {
        return Inertia::render('User/Show', compact('user'));
    }


    /**
     * @param User $user
     * @return RedirectResponse
     */
    public function generateNewToken(User $user): RedirectResponse
    {
        $user->setNewToken();
        return redirect()->to($user->createLink());
    }

    /**
     * @param User $user
     * @return RedirectResponse
     */
    public function deactivateToken(User $user): RedirectResponse
    {
        $user->deactivate();
        return redirect()->to($user->createLink());
    }

    /**
     * @param User $user
     * @param ImFeelingLuckyService $imFeelingLuckyService
     * @return array
     */
    public function imFeelingLucky(User $user, ImFeelingLuckyService $imFeelingLuckyService): array
    {
        return $imFeelingLuckyService->play($user);
    }

    /**
     * @param User $user
     * @param ImFeelingLuckyRepository $imFeelingLuckyRepository
     * @return Collection
     */
    public function imFeelingLuckyHistory(User $user, ImFeelingLuckyRepository $imFeelingLuckyRepository): Collection
    {
        return $imFeelingLuckyRepository->getUserHistory($user);
    }
}
