<?php
/**
 * (簡易)ユーザー認証API
 *
 * @version 1.0.0
 * @author M.Katsube <katsubemakito@gmail.com>
 */

//-------------------------------
// ユーザーの定義
//-------------------------------
$users = [
	'foo@example.com' => 'apple',
	'bar@example.net' => 'orange'
];

//-------------------------------
// 引数を受け取る
//-------------------------------
$email    = isset($_POST['email'])?  $_POST['email']:null;
$password = isset($_POST['password'])? $_POST['password']:null;

// 入力値をチェック
if( ($email === null) || ($password === null) ){
	putResult(false, 'email and password is required');
	return(false);
}

//-------------------------------
// 認証
//-------------------------------
// 成功
if( array_key_exists($email, $users) && ($users[$email] === $password) ){
	putResult(true);
}
// 失敗
else{
	putResult(false, 'email or password is wrong');
}


/**
 * 結果をJSON形式で表示
 *
 * @param boolean $result
 * @param mixed [$value=null]
 * @return void
 */
function putResult(bool $result, $value=null){
	header('Content-type: application/json');
	echo json_encode([
		'head' => [
			'result' => $result,
			'time'   => time()
		],
		'body' => $value
	]);
}