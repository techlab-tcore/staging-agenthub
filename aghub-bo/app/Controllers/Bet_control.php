<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Bet_control extends BaseController
{
    public function actualBetLog()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $raw = json_decode(file_get_contents('php://input'),1);

        if( !empty($raw['start']) && !empty($raw['end']) ):
            $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($raw['start']))));
            $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime($raw['end']))));
        else:
            $from = date('c', strtotime(date('Y-m-d 00:00:00')));
            $to = date('c', strtotime(date('Y-m-d 23:59:59')));
        endif;

        $payload = $this->bet_model->selectAllActualBetLog([
            'pageindex' => $raw['pageindex'],
            'rowperpage' => $raw['rowperpage'],
            'userid' => base64_decode($raw['parent']),
            'fromdate' => $from,
            'todate'=>$to,
            'desc' => true
        ]);
        // echo json_encode($payload);

        if( $payload['code'] == 1 && $payload['data'] != [] ):
            $data = [];
            foreach( $payload['data'] as $ph ):
                $date = Time::parse(date('Y-m-d H:i:s', strtotime($ph['settleDate'])));
                $created = $date->toDateTimeString();

                $game = !empty($ph['gameName']) ? $ph['gameName'] : $ph['gameCode'];

                // if( $raw['provider']!='ALL' && $raw['provider']==$ph['gameProviderCode'] ):
                //     $row = [];
                //     $row[] = $created;
                //     $row[] = $ph['loginId'];
                //     // $row[] = $ph['gameProviderCode'];
                //     $row[] = '<small class="badge bg-primary fw-normal me-1">'.$ph['gameProviderName'].'</small>'.$game;
                //     $row[] = $ph['roundId'];
                //     $row[] = $ph['bet'];
                //     $row[] = $ph['turnover'];
                //     $row[] = $ph['win'];
                //     $row[] = $ph['winlose'];
                //     $row[] = $ph['jpWin'];
                //     $row[] = $ph['jpShare'];
                //     $data[] = $row;
                // elseif( $raw['provider']=='ALL' ):
                    $row = [];
                    $row[] = $created;
                    $row[] = $ph['loginId'];
                    // $row[] = $ph['gameProviderCode'];
                    $row[] = '<small class="badge bg-primary fw-normal me-1">'.$ph['gameProviderName'].'</small>'.$game;
                    $row[] = $ph['roundId'];
                    $row[] = $ph['bet'];
                    $row[] = $ph['turnover'];
                    $row[] = $ph['win'];
                    $row[] = $ph['winlose'];
                    $row[] = $ph['jpWin'];
                    $row[] = $ph['jpShare'];
                    $data[] = $row;
                // endif;
            endforeach;
            echo json_encode(['data'=>$data, 'code'=>1, 'pageIndex'=>$payload['pageIndex'], 'rowPerPage'=>$payload['rowPerPage'], 'totalPage'=>$payload['totalPage'], 'totalRecord'=>$payload['totalRecord']]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function referenceBetLog()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $raw = json_decode(file_get_contents('php://input'),1);

        if( !empty($raw['start']) && !empty($raw['end']) ):
            $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($raw['start']))));
            $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime($raw['end']))));
        else:
            $from = date('c', strtotime(date('Y-m-d 00:00:00')));
            $to = date('c', strtotime(date('Y-m-d 23:59:59')));
        endif;

        $payload = $this->bet_model->selectAllRefBetLog([
            'pageindex' => $raw['pageindex'],
            'rowperpage' => $raw['rowperpage'],
            'userid' => base64_decode($raw['parent']),
            'fromdate' => $from,
            'todate'=>$to,
            'desc' => true
        ]);
        // echo json_encode($payload);

        if( $payload['code'] == 1 && $payload['data'] != [] ):
            $data = [];
            foreach( $payload['data'] as $ph ):
                $date = Time::parse(date('Y-m-d H:i:s', strtotime($ph['settleDate'])));
                $created = $date->toDateTimeString();

                $game = !empty($ph['gameName']) ? $ph['gameName'] : $ph['gameCode'];

                // if( $raw['provider']!='ALL' && $raw['provider']==$ph['gameProviderCode'] ):
                //     $row = [];
                //     $row[] = $created;
                //     $row[] = $ph['loginId'];
                //     // $row[] = $ph['gameProviderCode'];
                //     $row[] = '<small class="badge bg-primary fw-normal me-1">'.$ph['gameProviderName'].'</small>'.$game;
                //     $row[] = $ph['roundId'];
                //     $row[] = $ph['bet'];
                //     $row[] = $ph['turnover'];
                //     $row[] = $ph['win'];
                //     $row[] = $ph['winlose'];
                //     $row[] = $ph['jpWin'];
                //     $row[] = $ph['jpShare'];
                //     $data[] = $row;
                // elseif( $raw['provider']=='ALL' ):
                    $row = [];
                    $row[] = $created;
                    $row[] = $ph['loginId'];
                    // $row[] = $ph['gameProviderCode'];
                    $row[] = '<small class="badge bg-primary fw-normal me-1">'.$ph['gameProviderName'].'</small>'.$game;
                    $row[] = $ph['roundId'];
                    $row[] = $ph['bet'];
                    $row[] = $ph['turnover'];
                    $row[] = $ph['win'];
                    $row[] = $ph['winlose'];
                    $row[] = $ph['jpWin'];
                    $row[] = $ph['jpShare'];
                    $data[] = $row;
                // endif;
            endforeach;
            echo json_encode(['data'=>$data, 'code'=>1, 'pageIndex'=>$payload['pageIndex'], 'rowPerPage'=>$payload['rowPerPage'], 'totalPage'=>$payload['totalPage'], 'totalRecord'=>$payload['totalRecord']]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function gameBalanceLog()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $raw = json_decode(file_get_contents('php://input'),1);

        if( !empty($raw['start']) && !empty($raw['end']) ):
            $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($raw['start']))));
            $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime($raw['end']))));
        else:
            $from = date('c', strtotime(date('Y-m-d 00:00:00')));
            $to = date('c', strtotime(date('Y-m-d 23:59:59')));
        endif;

        $payload = $this->bet_model->selectAllScoreLog([
            'pageindex' => $raw['pageindex'],
            'rowperpage' => $raw['rowperpage'],
            'userid' => base64_decode($raw['parent']),
            'fromdate' => $from,
            'todate'=>$to,
            'desc' => true
        ]);
        // echo json_encode($payload);

        if( $payload['code'] == 1 && $payload['data'] != [] ):
            $data = [];
            foreach( $payload['data'] as $ph ):
                switch($ph['status']):
                    case 1: $status = lang('Label.success'); break;
                    case 2: $status = lang('Label.reject'); break;
                    case 3: $status = lang('Label.pending'); break;
                    case 4: $status = lang('Label.check'); break;
                    default: $status = '---';
                endswitch;

                switch($ph['type']):
                    case 1: $type = lang('Label.deposit'); break;
                    case 2: $type = lang('Label.withdrawal'); break;
                    case 3: $type = lang('Label.promotion'); break;
                    case 4: $type = lang('Label.rebate'); break;
                    case 5: $type = lang('Label.commission'); break;
                    case 6: $type = lang('Label.credittransfer'); break;
                    case 7: $type = lang('Label.wreturn'); break;
                    case 8: $type = lang('Label.jackpot'); break;
                    default: $type = '---';
                endswitch;

                $date = Time::parse(date('Y-m-d H:i:s', strtotime($ph['createDate'])));
                $created = $date->toDateTimeString();

                // if( $raw['provider']!='ALL' && $raw['provider']==$ph['gameProviderCode'] ):
                //     $row = [];
                //     $row[] = $created;
                //     $row[] = $status;
                //     $row[] = $ph['loginId'];
                //     // $row[] = $ph['gameProviderCode'];
                //     $row[] = $ph['gameProviderName'];
                //     $row[] = $type;
                //     $row[] = $ph['amount'];
                //     $row[] = !empty($ph['remark']) ? $ph['remark'] : '---';
                //     $data[] = $row;
                // elseif( $raw['provider']=='ALL' ):
                    $row = [];
                    $row[] = $created;
                    $row[] = $status;
                    $row[] = $ph['loginId'];
                    // $row[] = $ph['gameProviderCode'];
                    $row[] = $ph['gameProviderName'];
                    $row[] = $type;
                    $row[] = $ph['amount'];
                    $row[] = !empty($ph['remark']) ? $ph['remark'] : '---';
                    $data[] = $row;
                // endif;
            endforeach;
            echo json_encode(['data'=>$data, 'code'=>1, 'pageIndex'=>$payload['pageIndex'], 'rowPerPage'=>$payload['rowPerPage'], 'totalPage'=>$payload['totalPage'], 'totalRecord'=>$payload['totalRecord']]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    /*
    Report
    */

    public function finalReport()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $raw = json_decode(file_get_contents('php://input'),1);

        if( !empty($raw['start']) && !empty($raw['end']) ):
            $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($raw['start']))));
            $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime($raw['end']))));
        else:
            $from = date('c', strtotime(date('Y-m-d 00:00:00')));
            $to = date('c', strtotime(date('Y-m-d 23:59:59')));
        endif;

        $payload = $this->bet_model->selectWinlose2([
            'userid' => base64_decode($raw['parent']),
            'fromdate' => $from,
            'todate' => $to,
            'pageindex' => $raw['pageindex'],
            'rowperpage' => $raw['rowperpage']
        ]);
        // echo json_encode($payload);

        if( $payload['code'] == 1 && $payload['data'] != [] ):
            $data = [];
            foreach( $payload['data'] as $user ):
                $progressiveWin = 0;
                $progressiveShare = 0;

                // if( $user['role']==3 ):
                    switch( $user['role'] ):
                        case 3:
                            $us = '<a class="text-decoration-none" href="javascript:void(0);" onclick="reload(\''.base64_encode($user['userId']).'+'.$user['loginId'].'\');">'.$user['loginId'].'</a>';
                        break;
                        default: $us = $user['loginId'];
                    endswitch;
                    
                    if( $user['role']==3 ):
                        $pgCharges = $user['downlineTotalGatewayDepositCharges'] + $user['downlineTotalGatewayWithdrawalCharges'];

                        $totalDeposit = $user['uplineTotalBankDeposit'];
                        $totalWithdrawal = $user['uplineTotalBankWithdrawal'];

                        $totalBet = $user['downlineTotalBet'];
                        $totalWinlose = $user['downlineTotalWinlose'];

                        $totalGPFee = floor($user['downlineTotalPTRent'] * 10000)/10000;
                        $totalAffiliate = floor($user['downlineTotalAffiliate'] * 10000)/10000;
                        $totalPgCharges = floor($pgCharges * 10000)/10000;
                        $totalJackpot = floor($user['downlineTotalJackpot'] * 10000)/10000;
                        $totalBonus = floor($user['downlineTotalPromotion'] * 10000)/10000;
                        $totalFortune = floor($user['downlineTotalSpin'] * 10000)/10000;
                        $totalLostRebate = floor($user['downlineTotalWinloseRebate'] * 10000)/10000;
                        $totalRefComm = floor($user['downlineTotalReferralComm'] * 10000)/10000;
                        $totalDepositComm = floor($user['downlineTotalTopUpComm'] * 10000)/10000;
                        $totalAffShareReward = floor($user['downlineTotalRefRegComm'] * 10000)/10000;
                        $totalDailyReward = floor($user['downlineTotalFreeCoin'] * 10000)/10000;
                        $totalAffLostRebate = floor($user['downlineTotalLoseRebate'] * 10000)/10000;

                        $totalDownlinePtComm = floor($user['downlineTotalPTCommission'] * 10000)/10000;
                        $totalSelfPtComm = floor($user['selfTotalPTCommission'] * 10000)/10000;
                        $totalUplinePtComm = floor($user['uplineTotalPTCommission'] * 10000)/10000;
                        $agentComm = floor($user['selfTotalCommission'] * 10000)/10000;
                        $userProfit = floor($user['selfProfit'] * 10000)/10000;

                        $totalPtComm = $totalDownlinePtComm;

                        // Games - Progressive
                        foreach( $user['data'] as $breakdown ):
                            $progressiveWin += $breakdown['playerJPWin'];
                            $progressiveShare += $breakdown['playerJPShare'];
                        endforeach;

                        $totalDownlineSum = $totalWinlose - $totalGPFee - ($totalAffiliate + $totalPgCharges + $totalJackpot + $totalBonus + $totalFortune + $totalLostRebate + $totalRefComm + $totalDepositComm + $totalAffShareReward + $totalDailyReward + $totalAffLostRebate) + $totalPtComm;

                        $selfComm = $totalSelfPtComm + $agentComm;

                        // Same value as $user['selfProfit']
                        $totalSelfSum = $user['selfTotalWinlose'] - $user['selfTotalPTRent'] - ($user['selfTotalAffiliate'] + $user['selfTotalGatewayDepositCharges'] + $user['selfTotalGatewayWithdrawalCharges'] + $user['selfTotalJackpot'] + $user['selfTotalPromotion'] + $user['selfTotalSpin'] + $user['selfTotalWinloseRebate'] + $user['selfTotalReferralComm'] + $user['selfTotalTopUpComm'] + $user['selfTotalRefRegComm'] + $user['selfTotalFreeCoin'] + $user['selfTotalLoseRebate']) + ($user['selfTotalPTCommission'] + $agentComm);

                        $totalUplineSum = $totalDownlineSum + $totalSelfSum;

                    elseif( $user['role']==4 ):
                        $pgCharges = $user['selfTotalGatewayDepositCharges'] + $user['selfTotalGatewayWithdrawalCharges'];

                        $totalDeposit = $user['uplineTotalBankDeposit'];
                        $totalWithdrawal = $user['uplineTotalBankWithdrawal'];

                        $totalBet = $user['selfTotalBet'];
                        $totalWinlose = $user['selfTotalWinlose'];

                        $totalGPFee = floor($user['selfTotalPTRent'] * 10000)/10000;
                        $totalAffiliate = floor($user['selfTotalAffiliate'] * 10000)/10000;
                        $totalPgCharges = floor($pgCharges * 10000)/10000;
                        $totalJackpot = floor($user['selfTotalJackpot'] * 10000)/10000;
                        $totalBonus = floor($user['selfTotalPromotion'] * 10000)/10000;
                        $totalFortune = floor($user['selfTotalSpin'] * 10000)/10000;
                        $totalLostRebate = floor($user['selfTotalWinloseRebate'] * 10000)/10000;
                        $totalRefComm = floor($user['selfTotalReferralComm'] * 10000)/10000;
                        $totalDepositComm = floor($user['selfTotalTopUpComm'] * 10000)/10000;
                        $totalAffShareReward = floor($user['selfTotalRefRegComm'] * 10000)/10000;
                        $totalDailyReward = floor($user['selfTotalFreeCoin'] * 10000)/10000;
                        $totalAffLostRebate = floor($user['selfTotalLoseRebate'] * 10000)/10000;

                        $totalDownlinePtComm = floor($user['downlineTotalPTCommission'] * 10000)/10000;
                        $totalSelfPtComm = floor($user['selfTotalPTCommission'] * 10000)/10000;
                        $totalUplinePtComm = floor($user['uplineTotalPTCommission'] * 10000)/10000;
                        $agentComm = floor($user['selfTotalCommission'] * 10000)/10000;
                        $userProfit = floor($user['selfProfit'] * 10000)/10000;

                        $totalPtComm = $totalDownlinePtComm;

                        // Games - Progressive
                        foreach( $user['data'] as $breakdown ):
                            $progressiveWin += $breakdown['playerJPWin'];
                            $progressiveShare += $breakdown['playerJPShare'];
                        endforeach;

                        // $totalDownlineSum = $totalWinlose - $totalGPFee - ($totalAffiliate + $totalPgCharges + $totalJackpot + $totalBonus + $totalFortune + $totalLostRebate + $totalRefComm + $totalDepositComm) + $totalPtComm;

                        $totalDownlineSum = $user['downlineTotalWinlose'] - $user['downlineTotalPTRent'];

                        $selfComm = $totalPtComm + $agentComm;

                        // Same value as $user['selfProfit']
                        $totalSelfSum = $user['selfTotalWinlose'] - $user['selfTotalPTRent'] - ($user['selfTotalAffiliate'] + $user['selfTotalGatewayDepositCharges'] + $user['selfTotalGatewayWithdrawalCharges'] + $user['selfTotalJackpot'] + $user['selfTotalPromotion'] + $user['selfTotalSpin'] + $user['selfTotalWinloseRebate'] + $user['selfTotalReferralComm'] + $user['selfTotalTopUpComm'] + $user['selfTotalRefRegComm'] + $user['selfTotalFreeCoin'] + $user['selfTotalLoseRebate']) + ($user['selfTotalPTCommission'] + $agentComm);

                        $totalUplineSum = $totalSelfSum;
                    endif;

                    $row = [];
                    $row[] = $us;
                    $row[] = $user['name'];
                    $row[] = $totalBet;
                    $row[] = $totalWinlose;
                    $row[] = $progressiveWin;
                    $row[] = $progressiveShare;
                    $row[] = $totalGPFee;
                    $row[] = $totalAffiliate;
                    $row[] = $pgCharges;
                    $row[] = $totalJackpot;
                    $row[] = $totalBonus;
                    $row[] = $totalFortune;
                    $row[] = $totalDepositComm;
                    $row[] = $totalRefComm;
                    $row[] = $totalLostRebate;
                    $row[] = $totalAffShareReward;
                    $row[] = $totalDailyReward;
                    $row[] = $totalAffLostRebate;
                    $row[] = $totalPtComm;
                    $row[] = $totalDownlineSum;
                    $row[] = $selfComm;
                    $row[] = $totalSelfSum;
                    $row[] = $totalUplineSum;
                    $data[] = $row;
                // endif;
            endforeach;

            // Total
            $totalData = [];
            $totalProgressiveWin = 0;
            $totalProgressiveShare = 0;
            if( $payload['total']!=[] || !empty($payload['total']) ):
                foreach( $payload['total']['data'] as $totalProgressive ):
                    $totalProgressiveWin += $totalProgressive['playerJPWin'];
                    $totalProgressiveShare += $totalProgressive['playerJPShare'];
                endforeach;

                $totalBet = $payload['total']['downlineTotalBet'] + $payload['total']['selfTotalBet'] + $payload['total']['uplineTotalBet'];
                $totalEffective = $payload['total']['downlineTotalTurnover'] + $payload['total']['selfTotalTurnover'] + $payload['total']['uplineTotalTurnover'];
                $totalWin = $payload['total']['downlineTotalWin'] + $payload['total']['selfTotalWin'] + $payload['total']['uplineTotalWin'];
                $totalWinlose = $payload['total']['downlineTotalWinlose'] + $payload['total']['selfTotalWinlose'] + $payload['total']['uplineTotalWinlose'];
                
                $totalData['totalBet'] = bcdiv($totalBet,1,2);
                $totalData['totalEffective'] = bcdiv($totalEffective,1,2);
                $totalData['totalWin'] = bcdiv($totalWin,1,2);
                $totalData['totalWinlose'] = bcdiv($totalWinlose,1,2);
                $totalData['totalProgressiveWin'] = bcdiv($totalProgressiveWin,1,2);
                $totalData['totalProgressiveShare'] = bcdiv($totalProgressiveShare,1,2);
            else:
                $totalData['totalBet'] = 0;
                $totalData['totalEffective'] = 0;
                $totalData['totalWin'] = 0;
                $totalData['totalWinlose'] = 0;
                $totalData['totalProgressiveWin'] = bcdiv($totalProgressiveWin,1,2);
                $totalData['totalProgressiveShare'] = bcdiv($totalProgressiveShare,1,2);
            endif;

            echo json_encode([
                'data' => $data,
                'code' => 1,
                'pageIndex' => $payload['pageIndex'],
                'rowPerPage' => $payload['rowPerPage'],
                'totalPage' => $payload['totalPage'],
                'totalRecord' => $payload['totalRecord'],
                'total' => $totalData
            ]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function winloseReport()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $raw = json_decode(file_get_contents('php://input'),1);

        if( !empty($raw['start']) && !empty($raw['end']) ):
            $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($raw['start']))));
            $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime($raw['end']))));
        else:
            $from = date('c', strtotime(date('Y-m-d 00:00:00')));
            $to = date('c', strtotime(date('Y-m-d 23:59:59')));
        endif;

        $payload = $this->bet_model->selectWinlose2([
            'userid' => base64_decode($raw['parent']),
            'fromdate' => $from,
            'todate' => $to,
            'pageindex' => $raw['pageindex'],
            'rowperpage' => $raw['rowperpage']
        ]);
        // echo json_encode($payload);

        if( $payload['code'] == 1 && $payload['data'] != [] ):
            $data = [];
            foreach( $payload['data'] as $w ):
                switch( $w['role'] ):
                    case 3:
                        $role = '<a class="text-decoration-none" href="javascript:void(0);" onclick="reload(\''.base64_encode($w['userId']).'+'.$w['loginId'].'\');">'.lang('Label.ag').'</a>';
                    break;

                    case 4: $role = lang('Label.member'); break;
                endswitch;

                $playerBet = 0;
                $playerEffective = 0;
                $playerWin = 0;
                $playerWinlose = 0;
                $downlineBet = 0;
                $downlineWin = 0;
                $downlineWinlose = 0;
                $uplineBet = 0;
                $uplineWin = 0;
                $uplineWinlose = 0;
                $selfBet = 0;
                $selfWin = 0;
                $selfWinlose = 0;
                $playerJPWin = 0;
                $playerJPShare = 0;
                foreach( $w['data'] as $g ):
                    if( $raw['provider']!=='ALL' && $g['gameProviderCode']===$raw['provider'] ):
                        $playerBet += $g['playerBet'];
                        $playerEffective += $g['playerTurnover'];
                        $playerWin += $g['playerWin'];
                        $playerWinlose += $g['playerWinlose'];
                        $downlineBet += $g['downLineBet'];
                        $downlineWin += $g['downLineWin'];
                        $downlineWinlose += $g['downLineWinlose'];
                        $uplineBet += $g['uplineBet'];
                        $uplineWin += $g['uplineWin'];
                        $uplineWinlose += $g['uplineWinlose'];
                        $selfBet += $g['selfBet'];
                        $selfWin += $g['selfWin'];
                        $selfWinlose += $g['selfWinlose'];
                        $playerJPWin += $g['playerJPWin'];
                        $playerJPShare += $g['playerJPShare'];
                    elseif( $raw['provider']==='ALL' ):
                        $playerBet += $g['playerBet'];
                        $playerEffective += $g['playerTurnover'];
                        $playerWin += $g['playerWin'];
                        $playerWinlose += $g['playerWinlose'];
                        $downlineBet += $g['downLineBet'];
                        $downlineWin += $g['downLineWin'];
                        $downlineWinlose += $g['downLineWinlose'];
                        $uplineBet += $g['uplineBet'];
                        $uplineWin += $g['uplineWin'];
                        $uplineWinlose += $g['uplineWinlose'];
                        $selfBet += $g['selfBet'];
                        $selfWin += $g['selfWin'];
                        $selfWinlose += $g['selfWinlose'];
                        $playerJPWin += $g['playerJPWin'];
                        $playerJPShare += $g['playerJPShare'];
                    endif;
                endforeach;

                $pwin = substr($playerWin, 0, 1)=='-' ? substr($playerWin, 1) : '-'.$playerWin;
                $pwinlose = substr($playerWinlose, 0, 1)=='-' ? substr($playerWinlose, 1) : '-'.$playerWinlose;

                $finalUplineBet = $uplineBet;
                $finalUplineWin = $uplineWin;
                $finalUplineWinlose = $uplineWinlose;

                $profit = $downlineWinlose + $selfWinlose;

                $row = [];
                $row[] = $role;
                $row[] = $w['loginId'];
                $row[] = $w['name'];
                $row[] = $playerBet;
                $row[] = $playerEffective;
                $row[] = $pwin;
                $row[] = $playerJPWin;
                $row[] = $playerJPShare;
                $row[] = $pwinlose;
                $row[] = $downlineBet;
                $row[] = $downlineWin;
                $row[] = $downlineWinlose;
                $row[] = $selfBet;
                $row[] = $selfWin;
                $row[] = $selfWinlose;
                $row[] = $finalUplineBet;
                $row[] = $finalUplineWin;
                $row[] = $finalUplineWinlose;
                $row[] = $profit;
                foreach( $w['data'] as $breakdown ):
                    $breakdownWin = substr($breakdown['playerWin'], 0, 1)=='-' ? substr($breakdown['playerWin'], 1) : '-'.$breakdown['playerWin'];
                    $breakdownWinlose = substr($breakdown['playerWinlose'], 0, 1)=='-' ? substr($breakdown['playerWinlose'], 1) : '-'.$breakdown['playerWinlose'];

                    if( $raw['provider']!=='ALL' && $breakdown['gameProviderCode']===$raw['provider'] ):
                        // $row[] = $breakdown['gameProviderCode'];
                        $row[] = $breakdown['gameProviderName'];
                        $row[] = $breakdown['playerBet'];
                        $row[] = $breakdown['playerTurnover'];
                        $row[] = $breakdownWin;
                        $row[] = $breakdown['playerJPWin'];
                        $row[] = $breakdown['playerJPShare'];
                        $row[] = $breakdownWinlose;
                    elseif( $raw['provider']==='ALL' ):
                        // $row[] = $breakdown['gameProviderCode'];
                        $row[] = $breakdown['gameProviderName'];
                        $row[] = $breakdown['playerBet'];
                        $row[] = $breakdown['playerTurnover'];
                        $row[] = $breakdownWin;
                        $row[] = $breakdown['playerJPWin'];
                        $row[] = $breakdown['playerJPShare'];
                        $row[] = $breakdownWinlose;
                    endif;
                endforeach;
                $data[] = $row;
            endforeach;

            // Total
            $totalData = [];
            if( $raw['provider']!=='ALL' ):
                foreach( $payload['total']['data'] as $p ):
                    if( $p['gameProviderCode']===$raw['provider'] ):
                        $totalData['totalBet'] = $p['playerBet'];
                        $totalData['totalEffective'] = $p['playerTurnover'];
                        $totalData['totalWin'] = $p['playerWin'];
                        $totalData['totalWinlose'] = $p['playerWinlose'];
                    endif;
                endforeach;
            else:
                $totalData['totalBet'] = $payload['total']['downlineTotalBet'] + $payload['total']['selfTotalBet'] + $payload['total']['uplineTotalBet'];
                $totalData['totalEffective'] = $payload['total']['downlineTotalTurnover'] + $payload['total']['selfTotalTurnover'] + $payload['total']['uplineTotalTurnover'];
                $totalData['totalWin'] = $payload['total']['downlineTotalWin'] + $payload['total']['selfTotalWin'] + $payload['total']['uplineTotalWin'];
                $totalData['totalWinlose'] = $payload['total']['downlineTotalWinlose'] + $payload['total']['selfTotalWinlose'] + $payload['total']['uplineTotalWinlose'];
            endif;

            echo json_encode([
                'data' => $data,
                'code' => 1,
                'pageIndex' => $payload['pageIndex'],
                'rowPerPage' => $payload['rowPerPage'],
                'totalPage' => $payload['totalPage'],
                'totalRecord' => $payload['totalRecord'],
                'total' => $totalData
            ]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function gamesReport()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $raw = json_decode(file_get_contents('php://input'),1);

        if( !empty($this->request->getPost('start')) && !empty($this->request->getPost('end')) ):
            $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($this->request->getPost('start')))));
            $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime($this->request->getPost('end')))));
        else:
            $from = date('c', strtotime(date('Y-m-d 00:00:00')));
            $to = date('c', strtotime(date('Y-m-d 23:59:59')));
        endif;

        $res = $this->bet_model->selectWinlose([
            'userid' => base64_decode($this->request->getPost('parent')),
            'fromdate' => $from,
            'todate' => $to
        ]);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $data = [];
            foreach( $res['data'] as $user ):
                switch( $user['role'] ):
                    case 3:
                        $role = '<a class="text-decoration-none" href="javascript:void(0);" onclick="reload(\''.base64_encode($user['userId']).'+'.$user['loginId'].'\');">'.lang('Label.agent').'</a>';
                    break;

                    case 4: $role = $user['loginId']; break;
                endswitch;

                if( $user['data'] != [] ):
                    $playerbet = 0;
                    $playerwinlose = 0;
                    foreach( $user['data'] as $gp ):
                        if( $this->request->getPost('provider')!=='ALL' && $gp['gameProviderCode']===$this->request->getPost('provider') ):
                            $playerbet += $gp['playerBet'];
                            $playerwinlose += $gp['playerWinlose'];
                        elseif( $this->request->getPost('provider')==='ALL' ):
                            $playerbet += $gp['playerBet'];
                            $playerwinlose += $gp['playerWinlose'];
                        endif;
                    endforeach;

                    $row = [];
                    $row[] = $role;
                    $row[] = $user['loginId'];
                    $row[] = $user['name'];
                    $row[] = $playerbet;
                    $row[] = $playerwinlose;
                    $data[] = $row;
                endif;
            endforeach;
            echo json_encode(['data' => $data]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function selfGamesReport()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $raw = json_decode(file_get_contents('php://input'),1);

        if( !empty($raw['start']) && !empty($raw['end']) ):
            $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($raw['start']))));
            $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime($raw['end']))));
        else:
            $from = date('c', strtotime(date('Y-m-d 00:00:00')));
            $to = date('c', strtotime(date('Y-m-d 23:59:59')));
        endif;

        $payload = $this->bet_model->selectWinlose2([
            'userid' => base64_decode($raw['parent']),
            'fromdate' => $from,
            'todate' => $to,
            'pageindex' => $raw['pageindex'],
            'rowperpage' => $raw['rowperpage']
        ]);
        // echo json_encode($payload);

        if( $payload['code'] == 1 && $payload['total'] != [] ):
            $data = [];

            // Total
            $totalProgressiveWin = 0;
            $totalProgressiveShare = 0;
            foreach( $payload['total']['data'] as $break ):
                $totalProgressiveWin += $break['playerJPWin'];
                $totalProgressiveShare += $break['playerJPShare'];
            endforeach;

            $row = [];
            $row[] = $_ENV['company'];
            $row[] = $payload['total']['downlineTotalBet'] + $payload['total']['selfTotalBet'] + $payload['total']['uplineTotalBet'];
            $row[] = $payload['total']['downlineTotalTurnover'] + $payload['total']['selfTotalTurnover'] + $payload['total']['uplineTotalTurnover'];
            $row[] = $payload['total']['downlineTotalWinlose'] + $payload['total']['selfTotalWinlose'] + $payload['total']['uplineTotalWinlose'];
            $row[] = $totalProgressiveWin;
            $row[] = $totalProgressiveShare;

            foreach( $payload['total']['data'] as $w ):
                $row[] ='<small class="badge bg-primary fw-normal me-1">'. $w['gameProviderCode'].'</small>'.$w['gameProviderName'];
                $row[] = $w['playerBet'];
                $row[] = $w['playerTurnover'];
                $row[] = $w['playerWin'];
                $row[] = $w['playerWinlose'];
                $row[] = $w['playerJPWin'];
                $row[] = $w['playerJPShare'];
            endforeach;
            $data[] = $row;

            echo json_encode([
                'data' => $data,
                'code' => 1,
                'pageIndex' => $payload['pageIndex'],
                'rowPerPage' => $payload['rowPerPage'],
                'totalPage' => $payload['totalPage'],
                'totalRecord' => $payload['totalRecord']
            ]);
        else:
            echo json_encode(['no data']);
        endif;
    }

    public function refWinloseReport()
    {
        if( !session()->get('logged_in') ): return false; endif;

        $raw = json_decode(file_get_contents('php://input'),1);

        if( !empty($this->request->getPost('start')) && !empty($this->request->getPost('end')) ):
            $from = date('c', strtotime(date('Y-m-d 00:00:00', strtotime($this->request->getPost('start')))));
            $to = date('c', strtotime(date('Y-m-d 23:59:59', strtotime($this->request->getPost('end')))));
        else:
            $from = date('c', strtotime(date('Y-m-d 00:00:00')));
            $to = date('c', strtotime(date('Y-m-d 23:59:59')));
        endif;

        $res = $this->bet_model->selectRefWinlose([
            'userid' => base64_decode($this->request->getPost('parent')),
            'fromdate' => $from,
            'todate'=>$to
        ]);
        // echo json_encode($res);

        if( $res['code'] == 1 && $res['data'] != [] ):
            $data = [];
            foreach( $res['data'] as $w ):
                switch( $w['role'] ):
                    case 3:
                        $role = '<a class="text-decoration-none" href="javascript:void(0);" onclick="reload(\''.base64_encode($w['userId']).'+'.$w['loginId'].'\');">'.lang('Label.agent').'</a>';
                    break;

                    case 4: $role = lang('Label.member'); break;
                endswitch;

                $playerBet = 0;
                $playerEffective = 0;
                $playerWin = 0;
                $playerWinlose = 0;
                $downlineBet = 0;
                $downlineWin = 0;
                $downlineWinlose = 0;
                $uplineBet = 0;
                $uplineWin = 0;
                $uplineWinlose = 0;
                $selfBet = 0;
                $selfWin = 0;
                $selfWinlose = 0;
                $playerJPWin = 0;
                $playerJPShare = 0;
                foreach( $w['data'] as $g ):
                    if( $this->request->getPost('provider')!=='ALL' && $g['gameProviderCode']===$this->request->getPost('provider') ):
                        $playerBet += $g['playerBet'];
                        $playerEffective += $g['playerTurnover'];
                        $playerWin += $g['playerWin'];
                        $playerWinlose += $g['playerWinlose'];
                        $downlineBet += $g['downLineBet'];
                        $downlineWin += $g['downLineWin'];
                        $downlineWinlose += $g['downLineWinlose'];
                        $uplineBet += $g['uplineBet'];
                        $uplineWin += $g['uplineWin'];
                        $uplineWinlose += $g['uplineWinlose'];
                        $selfBet += $g['selfBet'];
                        $selfWin += $g['selfWin'];
                        $selfWinlose += $g['selfWinlose'];
                        $playerJPWin += $g['playerJPWin'];
                        $playerJPShare += $g['playerJPShare'];
                    elseif( $this->request->getPost('provider')==='ALL' ):
                        $playerBet += $g['playerBet'];
                        $playerEffective += $g['playerTurnover'];
                        $playerWin += $g['playerWin'];
                        $playerWinlose += $g['playerWinlose'];
                        $downlineBet += $g['downLineBet'];
                        $downlineWin += $g['downLineWin'];
                        $downlineWinlose += $g['downLineWinlose'];
                        $uplineBet += $g['uplineBet'];
                        $uplineWin += $g['uplineWin'];
                        $uplineWinlose += $g['uplineWinlose'];
                        $selfBet += $g['selfBet'];
                        $selfWin += $g['selfWin'];
                        $selfWinlose += $g['selfWinlose'];
                        $playerJPWin += $g['playerJPWin'];
                        $playerJPShare += $g['playerJPShare'];
                    endif;
                endforeach;

                $pwin = substr($playerWin, 0, 1)=='-' ? substr($playerWin, 1) : '-'.$playerWin;
                $pwinlose = substr($playerWinlose, 0, 1)=='-' ? substr($playerWinlose, 1) : '-'.$playerWinlose;

                $finalUplineBet = $uplineBet;
                $finalUplineWin = $uplineWin;
                $finalUplineWinlose = $uplineWinlose;

                $profit = $downlineWinlose + $selfWinlose;

                $row = [];
                $row[] = $role;
                $row[] = $w['loginId'];
                $row[] = $w['name'];
                $row[] = $playerBet;
                $row[] = $playerEffective;
                $row[] = $pwin;
                $row[] = $playerJPWin;
                $row[] = $playerJPShare;
                $row[] = $pwinlose;
                $row[] = $downlineBet;
                $row[] = $downlineWin;
                $row[] = $downlineWinlose;
                $row[] = $selfBet;
                $row[] = $selfWin;
                $row[] = $selfWinlose;
                $row[] = $finalUplineBet;
                $row[] = $finalUplineWin;
                $row[] = $finalUplineWinlose;
                $row[] = $profit;
                foreach( $w['data'] as $breakdown ):
                    $breakdownWin = substr($breakdown['playerWin'], 0, 1)=='-' ? substr($breakdown['playerWin'], 1) : '-'.$breakdown['playerWin'];
                    $breakdownWinlose = substr($breakdown['playerWinlose'], 0, 1)=='-' ? substr($breakdown['playerWinlose'], 1) : '-'.$breakdown['playerWinlose'];

                    if( $this->request->getPost('provider')!=='ALL' && $breakdown['gameProviderCode']===$this->request->getPost('provider') ):
                        // $row[] = $breakdown['gameProviderCode'];
                        $row[] = $breakdown['gameProviderName'];
                        $row[] = $breakdown['playerBet'];
                        $row[] = $breakdown['playerTurnover'];
                        $row[] = $breakdownWin;
                        $row[] = $breakdown['playerJPWin'];
                        $row[] = $breakdown['playerJPShare'];
                        $row[] = $breakdownWinlose;
                    elseif( $this->request->getPost('provider')==='ALL' ):
                        // $row[] = $breakdown['gameProviderCode'];
                        $row[] = $breakdown['gameProviderName'];
                        $row[] = $breakdown['playerBet'];
                        $row[] = $breakdown['playerTurnover'];
                        $row[] = $breakdownWin;
                        $row[] = $breakdown['playerJPWin'];
                        $row[] = $breakdown['playerJPShare'];
                        $row[] = $breakdownWinlose;
                    endif;
                endforeach;
                $data[] = $row;
            endforeach;
            echo json_encode(['data'=>$data]);
        else:
            echo json_encode(['no data']);
        endif;
    }
}