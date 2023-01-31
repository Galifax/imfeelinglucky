<?php
namespace App\Services;
;

use App\Models\ImFeelingLucky;
use App\Models\User;
use App\Repositories\ImFeelingLuckyRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ImFeelingLuckyService
{
    /**
     * @var ImFeelingLuckyRepository
     */
    private ImFeelingLuckyRepository $imFeelingLuckyRepository;

    public function __construct()
    {
        $this->imFeelingLuckyRepository = new ImFeelingLuckyRepository;
    }

    /**
     * @param User $user
     * @return array
     */
    public function play(User $user): array
    {
        return DB::transaction(function() use($user) {
            $generate = $this->generate();
            $generate['total'] = $this->imFeelingLuckyRepository
                ->create($user, $generate['number'], $generate['sum'])
                ->total;

            return $generate;
        });
    }

    /**
     * @return array
     */
    private function generate(): array
    {
        $randomNumber = rand(1, 1000);
        $win = $randomNumber % 2 === 0;
        $sum = $win ? round($this->calculate($randomNumber), 2) : 0;
        return [
            'number'=> $randomNumber,
            'win'   => $win,
            'sum'   => $sum,
        ];
    }

    /**
     * @param $number
     * @return float
     */
    protected function calculate($number): float
    {
        if ($number > 900) return $number * 0.7;
        if ($number > 600) return $number * 0.5;
        if ($number > 300) return $number * 0.3;
        return $number * 0.10;
    }
}
