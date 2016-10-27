# 自作フレームワーク
## サーバ起動
`$ php -S localhost:8000 server.php`

## ルーティング
app/Roteru.phpファイルに記述


|関数名|HTTP メソッド|
|---|:---:|
|`$app->get("URL","コントローラ名");`|GET|
|`$app->post("URL","コントローラ名");`|POST|
|`$app->put("URL","コントローラ名");`|PUT|
|`$app->delete("URL","コントローラ名");`|DELETE|
|`$app->patch("URL","コントローラ名");`|PATCH|

### 例
GETメソッドで`/`のリクエストにたいして`index`のコントローラを適応

- `$app->get("/","index");`

POSTメソッドで`/login`のリクエストにたいして`login`のコントローラを適応

- `$app->post("/login","login");`

## コントローラ
app/controller.php内に記述

## データベースの設定
database.ini内に記述
### 例
```
HOST = 127.0.0.1
USER = taiki
PASSWORD = hoge
```

# 自作フレームワークを用いたwebAPI
## API一覧

| No. | API名 | url | API概要 |
|:-----------|:------------|:------------|:------|
| 0  | login | /users | ユーザー認証を行いアクセストークンを返す |
|1|get|/|記事のタイトルと内容、作成日時、更新日時を返す|
|2|store|/store|記事の追加を行う|
|3|update|/update|記事の更新を行う|
|4|delete|/delete|記事の削除を行う|

## API詳細
### No.01 login

| API名 | login |
|:-----------|:------------|
|アクセスURL|/login|
|メソッド|POST|

#### 入力

|JSON Key|型|サイズ|必須|暗号化|値の説明|
|:----|:----|:----|:----:|:----|:----|
|name|string||◯||ユーザのnameを入れる|
|password|string||◯||ユーザのpasswordを入れる|

#### 出力

|JSON key|形|サイズ|値の説明|
|:----|:----|:----|:----|:----|:----|
|token|string||ユーザIDと有効期限をbase64_encodeした値|
|errMssege|string||エラーであれば、エラーメッセージを返す。なければnullを返す|
#### 注釈
トークンはbase64_encodeされた値だがトークンはデータベースに保存して照会するため改ざんはできない。
有効期限は現在一時間だが失効は未実装

### No.02 get

| API名 | get |
|:-----------|:------------|
|アクセスURL|/?id=<記事のID>|
|メソッド|GET|

#### 入力

id=<記事のID>
入力がなければ全件取得

#### 出力

|JSON key|形|サイズ|値の説明|
|:----|:----|:----|:----|:----|:----|
|title|string||記事のタイトル|
|body|string||記事の内容|
|time|string||作成日時|
|id|string||記事のプライマリーなID|

### No.03 store

| API名 | store |
|:-----------|:------------|
|アクセスURL|/store|
|メソッド|POST|

#### 入力

|JSON Key|型|サイズ|必須|暗号化|値の説明|
|:----|:----|:----|:----:|:----|:----|
|token|string||◯||アクセストークンを入れる|
|title|string||◯||ブログのタイトル|
|body|string||◯||ブログの内容|

#### 出力

|JSON key|形|サイズ|値の説明|
|:----|:----|:----|:----|:----|:----|
|errMssege|string||エラーがあればエラーメッセージなければnull|

### No.03 update

| API名 | update |
|:-----------|:------------|
|アクセスURL|/update|
|メソッド|POST|

#### 入力

|JSON Key|型|サイズ|必須|暗号化|値の説明|
|:----|:----|:----|:----:|:----|:----|
|id|string||◯||記事のID|
|token|string||◯||アクセストークンを入れる.|
|title|string||||ブログのタイトル。なくても良い|
|body|string||||ブログの内容。なくても良い|

#### 出力

|JSON key|形|サイズ|値の説明|
|:----|:----|:----|:----|:----|:----|
|errMssege|string||エラーがあればエラーメッセージなければnull|

### No.04 delete

| API名 | delete |
|:-----------|:------------|
|アクセスURL|/delete|
|メソッド|POST|

#### 入力

|JSON Key|型|サイズ|必須|暗号化|値の説明|
|:----|:----|:----|:----:|:----|:----|
|id|string||◯||記事のID|
|token|string||◯||アクセストークンを入れる.|

#### 出力

|JSON key|形|サイズ|値の説明|
|:----|:----|:----|:----|:----|:----|
|errMssege|string||エラーがあればエラーメッセージなければnull|