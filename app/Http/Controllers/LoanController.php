<?php

namespace App\Http\Controllers;

use App\Model\Loans;
use App\Model\Repayments;
use Illuminate\Http\Request;

class LoanController extends Controller
{

  public function __construct()
  {

  }

  public function createLoan(Request $request,$user_id) {
     $this->validate($request, [
      'duration'                    => 'required|numeric',
      'repayment_frequence_amount'  => 'required|numeric',
      'repayment_frequence'         => 'required|numeric',
      'interest_rate'               => 'required|numeric',
      'fee'                         => 'required|numeric',
    ]);
    $loan = Loans::create([
        'user_id'                     =>  $user_id,
        'duration'                    =>  $request->get('duration'),
        'repayment_frequence_amount'  =>  $request->get('repayment_frequence_amount'),
        'repayment_frequence'         =>  $request->get('repayment_frequence'),
        'interest_rate'               =>  $request->get('interest_rate'),
        'fee'                         =>  $request->get('fee'),
        'repayment_frequence_amount'  =>  $request->get('repayment_frequence_amount'),
        'arrangement'                 =>  $request->get('arrangement')
    ]);
    if ($loan){
      return response()->json([
                              'status' => "200",
                              'message' => 'Created Loan Successful',
                              'data'    => [], 200]);
    }
    return response()->json([
            'error' => 'Created details provided does not exit.'
        ], 400);
  }

  public function createRepayment(Request $request, $user_id, $loan_id)
  {
    $this->validate($request, [
    'amount' => 'required|numeric',
    ]);
    $loan = Loans::where('id', '=', $loan_id)->where('user_id', '=', $user_id)->first();
    $amount = $loan->repayment_frequence_amount;
    $numberYearDuration = $loan->duration/12;
    $interestRate = (($loan->repayment_frequence_amount/100) * $loan->interest_rate) * $numberYearDuration;
    $fee = $loan->fee;
    $amountRepayment = Repayments::where('loan_id', '=', $loan_id)->where('user_id', '=', $user_id)->sum('amount');
    if ($amountRepayment < $amount + $fee + $interestRate) {
      $repayment = Repayments::create([
      'user_id' => $user_id,
      'loan_id' => $loan_id,
      'amount' => $request->get('amount'),
      'description' => $request->get('description'),
      ]);
      if ($repayment) {
        return response()->json([
        'status' => "200",
        'message' => 'Repayment Successful',
        'data' => [], 200]);
      }
    } else {
      return response()->json([
          'error' => 'Cannot make a repayment for a loan that’s already been repaid. '
          ], 400);
    }

    return response()->json([
    'error' => 'Created details provided does not exit.'
    ], 400);
  }


}