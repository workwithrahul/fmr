<?php
function get_user_by_token($token){
    $records =  DB::table('password_resets')->get();
    foreach ($records as $record) {
        if (Hash::check($token, $record->token) ) {
           return $record->email;
        }
    }
}
function get_nextid_by_token($token){
	$email = get_user_by_token($token);
	$records =  DB::table('users')
				->where("email",'=',$email)->get();
	foreach ($records as $record) {
		 return $record->username;
	}
}
?>