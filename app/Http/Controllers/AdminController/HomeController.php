<?php

namespace App\Http\Controllers\AdminController;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\PseudoTypes\False_;

class HomeController extends Controller
{
    //Dashboard view
    public function dashboard()
    {


      return view('AdminView.dashboard');

    }
    // App User view
    public function app_users()
    {
      $user_data = DB::table('users')->get();

      return view('AdminView.user.index')->with(array('result' => $user_data));
    }

    public function downloadapp(Request $request)
    {
        $mobile_num=$request->post('msisdn');
        // $product=$request->post('product');
        $validity_from="2021-04-07";
        $validity_to="2022-04-07";
        // $mobile_num=12345678;
        // echo gettype($mobile_num);
        if(strlen($mobile_num)>7)
        {

            return view('AdminView.Downloadapk');
        }else
        {
            return view('AdminView.unauthenticated');
        }


}
public function view_user($id){
    $user_data = DB::table('users')->where('id', $id)->get();
    // return $user_data;
    $userDetails = json_decode($user_data);
    $contest_data = DB::table('user_contests')->where('user_id', $id)->get();
    $contest_details = json_decode($contest_data);
    return view('AdminView.user.view', compact('userDetails', 'contest_details'));
}
public function delete($id){
    if(!is_null($id)){
    DB::table('users')->where('id', $id)->delete();
    }
    return redirect(url('/admin/App_Users'));
}
public function check(){
    $current_date =  Carbon::now('ist')->format('Y-m-d');
    $cric_contest_data = DB::table('cricket_contests')->where(array('start_date' => $current_date, 'game_status' => 1))->get();
    if(!empty($cric_contest_data)){
    foreach($cric_contest_data as $ccd){
        $min_entry = $ccd->min_entry;
        $contest_id = $ccd->id;
        $no_of_players = count(DB::table('user_contests')->where('contest_id', $contest_id)->get());
        if($no_of_players < $min_entry){
            $id = $ccd->id;
            DB::update('update cricket_contests set game_status = ?  where id=?',[0, $id]);
            $contest_data = DB::table('cricket_contests')->where('id',$id)->get();
            foreach($contest_data as $cd){
                // return $cd
                $entry_fee = $cd->entry_fee;
                $user_data = DB::table('user_contests')->where(array('contest_id'=> $id, 'game_type' => 'cricket'))->get();
                if(!empty($user_data)){
                foreach($user_data as $ud){
                    $user_id = $ud->user_id;
                    $user_wallet = DB::table('users')->where('id', $user_id)->get();
                    foreach($user_wallet as $uw){
                        $wallet_amount = $uw->wallet;
                        $new_wallet_amount = $wallet_amount + $entry_fee;
                        DB::table('users')->where('id', $user_id)->update(array('wallet'=> $new_wallet_amount));
                        DB::table('transaction_details')->insert(array(
                            'user_id' => $user_id,
                            'amount' => $entry_fee,
                            'status' => 'refunded'
                        ));
                    }
                }
            }
            }
        }
    }
}
    $foot_contest_data = DB::table('football_contests')->where(array('start_date' => $current_date, 'game_status' => 1))->get();
    if(!empty($foot_contest_data)){
    foreach($foot_contest_data as $fcd){
        $min_entry1 = $fcd->max_entry;
        $contest_id = $fcd->id;
        $no_of_players = count(DB::table('user_contests')->where('contest_id', $contest_id)->get());
        if($no_of_players < $min_entry1){
            $id = $fcd->id;
            DB::update('update football_contests set game_status = ?  where id=?',[0, $id]);
            $contest_data = DB::table('football_contests')->where('id',$id)->get();
            foreach($contest_data as $cd){
                // return $cd
                $entry_fee = $cd->entry_fee;
                $user_data = DB::table('user_contests')->where(array('contest_id'=> $id, 'game_type' => 'football'))->get();
                if(!empty($user_data)){
                foreach($user_data as $ud){
                    $user_id = $ud->user_id;
                    $user_wallet = DB::table('users')->where('id', $user_id)->get();
                    foreach($user_wallet as $uw){
                        $wallet_amount = $uw->wallet;
                        $new_wallet_amount = $wallet_amount + $entry_fee;
                        DB::table('users')->where('id', $user_id)->update(array('wallet'=> $new_wallet_amount));
                        DB::table('transaction_details')->insert(array(
                            'user_id' => $user_id,
                            'amount' => $entry_fee,
                            'status' => 'refunded'
                        ));
                    }
                }
            }
            }
        }
    }
}
}
}
