<?php
/**
 * ユーザー認証API - DB版
 *
 * @version 1.0.0
 * @author M.Katsube <katsubemakito@gmail.com>
 */

//-------------------------------
// DBの接続情報
//-------------------------------
define('DB_DSN',  'mysql:dbname=neecLogin;host=localhost');	// 接続先
define('DB_USER', 'root');			// ユーザーID
define('DB_PW',   'H@chiouji1');	// パスワード

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
if( authDB($email, $password) ){
	putResult(true);
}
// 失敗
else{
	putResult(false, 'email or password is wrong');
}


/**
 * ユーザー認証
 *
 * @param string $id
 * @param string $pw
 * @return boolean
 */
function authDB(string $id, string $pw){
	// SQLの準備
	$sql = sprintf('SELECT count(*) as cnt FROM User WHERE id="%s" and pw="%s"', $id, $pw);	//★セキュリティホール
	// $sql = 'SELECT count(*) as cnt FROM User WHERE id=:id and pw=:pw';

	// SQLを実行
	$dbh = new PDO(DB_DSN, DB_USER, DB_PW);   // 接続
	$sth = $dbh->prepare();       	// SQL準備
	// $sth->bindValue(':id', $id, PDO::PARAM_STR);
	// $sth->bindValue(':pw', $pw, PDO::PARAM_STR);
	$sth->execute();                // 実行

	// 実行結果を取得
	$result = $sth->fetch(PDO::FETCH_ASSOC);
	return( ($result !== false) && ($result['cnt'] > 0) );
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