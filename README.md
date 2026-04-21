#  :shopping_cart: free-market-test
coachtech模擬案件　フリマアプリ
## :clipboard:laravel環境構築
**🐳Dockerビルド**
1. gitのクローン
```bash
git@github.com:RINGO-days/free-market-test.git
```
2. Dockerデスクトップアプリを立ち上げる

3. Dockerの立ち上げ
```bash
docker-compose up -d --build
```
<details>
<summary style="cursor: pointer;">⚠️ Mac(Apple Silicon)をお使いの方</summary>

>Apple Silicon搭載のMacでは、sail up -d実行時に以下のエラーが発生することがあります
>### 🚫症状
>`The requested image's platform (linux/amd64) does not match the detected host platform`
>などの警告が出て、作業が終了する場合がある。
>### 💡対策
>docker-compose.ymlを開き、プラットフォームを明示する。
>```text
>mysql:
>        image: mysql:8.0.26
>        platform: linux/amd64　←この行を追加
>        environment:
>        〜
>```

</details>

## 🛠環境構築
**Dockerを立ち上げた後は、以下の手順を順番に実行してください**
1. phpコンテナへログイン
```bash
docker-compose exec php bash
```
2. ライブラリのインストール
```bash
composer install
```
3. 環境設定ファイルの作成
```bash
cp .env.example .env
```
4. .envファイルの設定
```text
DB_CONNECTION=mysql
DB_HOST=mysql　　※
DB_PORT=3306
DB_DATABASE=laravel_db　　※
DB_USERNAME=laravel_user　　※
DB_PASSWORD=laravel_pass　　※
```
5. アプリケーションキーの作成
```bash
php artisan key:generate
```
6. データベースおよび初期データの投入
```bash
php artisan migrate --seed
```