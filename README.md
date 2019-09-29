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

## その他の準備
### DB
「DB」を利用したサンプルを実行する場合は、事前に`sql/init.sql`を実行してください。

```
$ mysql -u root -p < sql/init.sql
```

### Memcached
「キャッシュ」を利用したサンプルを実行する場合はMemcachedのインストール、その後Memcachedサーバを起動をする必要があります。

```
$ sudo rpm -ivh rpm/memcached-1.5.0-1.el7.remi.x86_64.rpm
$ sudo systemctl start memcached.service
```

* 本リポジトリ内にあるRPMは実習環境(CentOS7.2)を想定した物です。
* `yum`や`apt`などパッケージマネージャが利用できる場合は、そちらを優先してください。


## アタック演習
### Brute Force Attack
`auth1.php`に対して総当たり攻撃を行います。中々の時間がかかります。

```
$ php tool/bf.php
```

### Dictionary Attack
`auth1.php`に対して辞書攻撃を行います。一瞬で終了します。

```
$ php tool/dic.php
```


## 動作環境
* 一般的なLAMP環境での実行を想定しています。
* PHP7.0以上


## 注意点
1. パスワードをハッシュ化せずにそのままDBなどへ保存することは推奨されません。
