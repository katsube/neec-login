# ログイン
日本工学院八王子専門学校 ゲーム科 実習用PHPサンプル。

## What is this
MySQL/PHPを利用した簡易的なログイン機能のサンプルです。

### 基本構成
4つのサンプルを用意しています。

<dl>
  <dt>login1.html / auth1.php</dt>
  <dd>シンプルなログイン画面。ユーザー情報はPHPの中。</dd>

  <dt>login2.html / auth2.php</dt>
  <dd>ユーザー情報をMySQL上に移動</dd>

  <dt>login3.html / auth3.php</dt>
  <dd>MySQLから取得した情報をMemcachedに保存しスピードを上げた物</dd>

  <dt>login4.html / auth4.php</dt>
  <dd>SQLインジェクションを体験するためのサンプル</dd>
</dl>

また攻撃を行う簡易的なツールも用意しています。

<dl>
  <dt>tool/bf.php</dt>
  <dd>auth1.phpに対し総当たり攻撃を行います</dd>

  <dt>tool/dic.php</dt>
  <dd>auth1.phpに対し辞書攻撃を行います</dd>
</dl>

**※注意**

1. 第三者のサーバやネットワークに高負荷をかける行為は「威力業務妨害罪」などの犯罪行為にあたります。
1. このサンプルは必ず学習用とにとどめてください。

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

## キャッシュ演習
Apache Benchがインストールされている環境で`auth2.php`と`auth3.php`に対して大きな負荷をかけます。

```
# キャッシュなし
$ ab -n 50 -c 3000 'http://localhost/login/auth2.php?id=foo@example.com&password=apple'

# キャッシュあり
$ ab -n 50 -c 3000 'http://localhost/login/auth3.php?id=foo@example.com&password=apple'
```

## アタック演習
### Brute Force Attack
`auth1.php`に対して総当たり攻撃を行います。中々の時間がかかります。

```
$ php tool/bf.php
```

### Dictionary Attack
`auth1.php`に対して辞書攻撃を行います。こちらは一瞬で終了します。

```
$ php tool/dic.php
```


## 動作環境
* 一般的なLAMP環境での実行を想定しています。
* PHP7.0以上


## 注意点
1. パスワードをハッシュ化せずにそのままDBなどへ保存することは推奨されません。
1. 第三者のサーバやネットワークに高負荷をかける行為は「威力業務妨害罪」などの犯罪行為にあたります。このサンプルは必ず学習用とにとどめてください。
