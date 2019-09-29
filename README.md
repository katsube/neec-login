# ログイン
日本工学院八王子専門学校 ゲーム科 実習用PHPサンプル。

## What is this
MySQL/PHPを利用した簡易的なログイン機能のサンプルです。

## Quick Start
### 準備
適当なディレクトリに`git clone`するかダウンロードしてください。

```
$ git clone https://github.com/katsube/neec-login.git login
```

### ドキュメントルート下へ移動
Webサーバ上で公開されるディレクトリの下に移動(コピー)します。

```
$ cp -r login /var/www/html/
```

### 実行する
実際にWebブラウザからアクセスしてみてください。

```
http://example.com/login/
```

* `example.com`の部分は設置したサーバや環境の物に置き換えてください。

## DBの準備
DBを利用したサンプルを実行する場合は、事前に`sql/init.sql`を実行してください。

```
$ mysql -u root -p < sql/init.sql
```

## 動作環境

* 一般的なLAMP環境での実行を想定しています。
* PHP7.0以上


## 注意点

1. パスワードをハッシュ化せずにそのままDBなどへ保存することは推奨されません。
