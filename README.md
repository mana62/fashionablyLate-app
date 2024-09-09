# 勤怠管理アプリ  　Atte-app
・従業員の勤怠管理アプリ<br>


# 作成した目的
・人事評価のため<br>

# アプリケーションURL


# 他のリポジトリ


# 機能一覧
・会員登録<br>
・ログイン<br>
・ログアウト<br>
・勤務開始<br>
・勤務終了<br>
・休憩開始(1日で何度も休憩が可能)<br>
・休憩終了<br>
・日付別勤怠情報取得<br>
・ページネーション(5ページずつ取得)<br>


# 使用技術
・nginx: 1.21.1<br>
・php: 7.4.9-fpm<br>
・mysql: 8.0.26<br>
・Laravel: 8<br>


# テーブル設計
![テーブル仕様書](https://github.com/user-attachments/assets/bd2cb4e9-2c88-4ffb-846e-ea4c39207768)


# ER図
![ER図 ](https://github.com/user-attachments/assets/8102b42a-0f58-4ebd-ad86-20276e61e513)


# 環境構築
1. リモートリポジトリを作成
2. ローカルリポジトリの作成
3. リモートリポジトリをローカルリポジトリに追加
4. (docker-compose.yml) の作成
5. Nginx の設定
6. PHP の設定
7. MySQL の設定
8. phpMyAdmin の設定
9. (docker-compose up -d --build)
10. (docker-compose exec php bash)
11. (composer create-project "laravel/laravel=8.*" . --prefer-dist)
12. app.php の timezone を修正
13. .env ファイルの環境変数を変更
14. (php artisan migrate)
15. (php artisan db:seed)


# その他

