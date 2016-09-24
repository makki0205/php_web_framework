# 自作フレームワーク
##サーバ起動
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
app/controller.phpないに記述


