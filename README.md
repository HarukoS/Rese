# "Rese"
    飲食店予約サービス「Rese」

## 作成した目的
    外部の飲食店予約サービスは手数料を取られるため自社で予約サービスを持ちたい。

## アプリケーションURL
    - 開発環境：http://localhost/
    - phpMyAdmin:http://localhost:8080/
    - 本番環境：

## 機能一覧
    - ユーザー登録（メール認証付き）、ログイン、ログアウト機能
    - 飲食店検索、お気に入り登録、解除機能
    - 飲食店予約、変更、キャンセル機能
    - 飲食店レビュー機能
    - （店舗代表者）飲食店新規登録、編集機能
    - （店舗代表者）飲食店予約情報取得
    - （管理者）店舗代表者登録、削除機能
    - （管理者）全店舗代表者、ユーザーへのメール送信機能
    - 予約情報のリマインドメール送付機能
    - 予約情報のQRコードメール送付機能、店舗側照合
    - 事前決済機能（Stripe）

## 使用技術（実行環境）
    - PHP 8.1
    - Laravel 10
    - MySQL 8.1

## テーブル設計


## ER図
<img width="1041" height="670" alt="er" src="https://github.com/user-attachments/assets/c6de19be-dc65-4ae1-8ff5-09b084f5c84e" />

## 環境構築

### Dockerビルド
    1. [git clone リンク](git@github.com:HarukoS/Rese.git)
    2. docker-compose up -d --build

*MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせてdocker-compose.ymlファイルを編集してください。

### Laravel環境構築
    1. docker-compose exec php bash
    2. composer install
    3. .env.exampleファイルから.envを作成し、環境変数を変更
        .envにSTRIPE_KEYを追加
        STRIPE_KEY=pk_test_xxxxxxxxxxxxxxx
        STRIPE_SECRET=sk_test_xxxxxxxxxxxxxxx
    4. php artisan key:generate
    5. php artisan migrate
    6. php artisan db:seed
    7. php artisan schedule:run

### ダミーデータ説明
## ユーザー一覧
## 店舗一覧
店舗画像はお手数ですが添付のZipファイルを解凍していただき、Storageディレクトリ（src>storage>app>public>shop_images）に保存をお願いいたします。
## Stripe決済
Stripe決済画面ではテスト用カード番号「4242 4242 4242 4242」をお使いください。

### 店舗代表者新規登録方法

### 店舗新規登録方法

