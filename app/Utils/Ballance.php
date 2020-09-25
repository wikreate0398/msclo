<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 22.02.2019
 * Time: 11:52
 */

namespace App\Utils;

use App\Models\Transactions;
use App\Models\Tips;
use App\Models\User;
use function foo\func;

class Ballance
{
    protected $user;

    protected $sender_id;

    private $ballance;

    private $type;

    private $price;

    private $orderId;

    private $withdrawId;

    private $currentBallance;

    public function __construct()
    {
    }

    public static function getUserBallance($idUser, $userType, $days = false)
    {
        $senderMoneys = Transactions::where('user_id', $idUser)
                                    ->where('sender_id', '!=', '')
                                    ->forLast($days)
                                    ->where('type', 'replenish')
                                    ->sum('price');

        $tipsMoney = self::sumTipAmount(\App\Models\Tips::confirmed($days)
                                                     ->selectRaw('amount, status, created_at, location_work_type, location_id, location_amount')
                                                     ->where((($userType == 'admin') ? 'location_id' : 'user_id'), $idUser)
                                                     ->get(), $userType, $idUser);
        return $tipsMoney+$senderMoneys;
    }

    public static function getPartnerBallance($idPartner, $userType, $days = false)
    {
        $data = User::where('id', $idPartner)->with('referrals.locationUsers')->first();

        $ids = [];
        foreach ($data->referrals as $referral) {
            foreach ($referral->locationUsers as $user) {
                $ids[$user->id] = $user->id;
            }
            $ids[$referral->id] = $referral->id;
        }

        $tips = Tips::confirmed($days)
                    ->selectRaw('id, total_amount')
                    ->withPartnerPercent()
                    ->hasPartnerPercents()
                    ->whereIn('user_id', $ids)
                    ->get()
                    ->sum(function ($item) {
                        return percent($item->total_amount, @$item['percents'][0]->percent);
                    });

        return $tips;
    }

    private static function sumTipAmount($tips, $userType, $userId)
    {
        return $tips->sum(function ($tip) use ($userType, $userId) {
            if (empty($tip->location_id)) {
                return $tip->amount;
            } else {
                if ($tip->location_work_type == 'percent') {
                    return ($tip->location_id == $userId) ? $tip->location_amount : $tip->amount;
                } else {
                    return ($tip->location_id == $userId) ? $tip->amount : 0;
                }
            }
        });
    }

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    public function setSender($sender_id)
    {
        $this->sender_id = $sender_id;
        return $this;
    }

    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
        return $this;
    }

    public function setWithdrawId($withdrawId)
    {
        $this->withdrawId = $withdrawId;
        return $this;
    }

    public function replenish()
    {
        $this->ballance = $this->user->ballance + $this->price;
        $this->type     = 'replenish';
        $this->makeTransaction();
    }

    public function off()
    {
        if ($this->user->ballance <= $this->price) {
            $this->ballance = 0;
        } else {
            $this->ballance = $this->user->ballance - $this->price;
        }
        $this->type = 'off';
        $this->makeTransaction();
    }

    private function makeTransaction()
    {
        $this->user->ballance = $this->ballance;
        $this->user->save();
        $this->saveTransaction();
    }

    private function saveTransaction()
    {
        Transactions::create([
            'user_id'          => $this->user->id,
            'sender_id'        => $this->sender_id ?: 0,
            'type'             => $this->type,
            'price'            => $this->price,
            'ballance'         => $this->user->ballance,
            'order_id'         => $this->orderId ?: '',
            'withdraw_id'      => $this->withdrawId ?: '',
        ]);
    }
}
