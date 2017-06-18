# 自作フレームワーク
## サーバ起動
`sh up.sh`


## データベースの設定
config.ini内に記述

### 例

```
DATABASE_HOST = 127.0.0.1
DATABASE_NAME = webAPI
DATABASE_USER = root
DATABASE_PASSWORD =
```

## DB マイグレーション(未実装)
```
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
```
## test
`php tests/curl_test.php`