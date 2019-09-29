/**
 * DBとテーブルの準備
 */

/*----------------------------*/
/* DB作成                     */
/*----------------------------*/
CREATE DATABASE neecLogin;
USE neecLogin;

/*----------------------------*/
/* テーブルを作成             */
/*----------------------------*/
CREATE TABLE User(
  `id` varchar(255),    /* ID */
  `pw` varchar(255)     /* パスワード */
)
ENGINE=InnoDB   /* MySQLのエンジンを指定 */
CHARSET=utf8;   /* 文字コード */

/*----------------------------*/
/* 初期データを挿入           */
/*----------------------------*/
INSERT INTO User (id,pw) VALUES
	('foo@example.com', 'apple'),
	('bar@example.net', 'orange');
