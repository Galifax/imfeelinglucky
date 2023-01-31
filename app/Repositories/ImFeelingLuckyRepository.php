<?php
namespace App\Repositories;

use App\Models\ImFeelingLucky;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ImFeelingLuckyRepository
{
    /**
     * @var ImFeelingLucky
     */
    private ImFeelingLucky $model;

    public function __construct()
    {
        $this->model = new ImFeelingLucky;
    }

    /**
     * @param User $user
     * @param int $number
     * @param float $sum
     * @return ImFeelingLucky|Builder
     */
    public function create(User $user, int $number, float $sum): ImFeelingLucky|Builder
    {
        $lastPlay = $this->findLast($user);
        $total = 0;
        if ($sum > 0) {
            $total = !empty($lastPlay) ? $lastPlay->total + $sum : $sum;
        }

        return $this->model
            ->query()
            ->create([
                'user_id'   => $user->id,
                'number'    => $number,
                'sum'       => $sum,
                'total'     => $total
            ]);
    }

    /**
     * @param User $user
     * @return Builder|ImFeelingLucky|null
     */
    private function findLast(User $user): Builder|ImFeelingLucky|null
    {
        return $this->model
            ->query()
            ->where('user_id', $user->id)
            ->latest('created_at')
            ->first();
    }

    /**
     * @param User $user
     * @param int $limit
     * @return Collection
     */
    public function getUserHistory(User $user, int $limit = 3): Collection
    {
        return $this->model
            ->query()
            ->where('user_id', $user->id)
            ->latest('created_at')
            ->limit($limit)
            ->get()
            ->map(function(ImFeelingLucky $model) {
                return [
                    'id'        => $model->id,
                    'number'    => $model->number,
                    'sum'       => $model->sum,
                    'total'     => $model->total,
                    'win'       => $model->number % 2 === 0,
                    'created_at'=> Carbon::parse($model->created_at)
                        ->format('Y-m-d H:i:s')
                ];
            });
    }
}
