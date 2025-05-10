<?php
class User
{
    /**
     * ユーザ情報を取得
     *
     * @return array ユーザデータの連想配列
     */
    public function get()
    {
        // CSVファイルからユーザデータを取得
        $file = '../data/users.csv';
    
        // CSVファイルが存在しない場合は例外をスロー
        if (!file_exists($file)) {
            throw new Exception("CSVファイルが見つかりません: $file");
        }
    
        $users = [];
        // CSVファイルを開く
        if (($handle = fopen($file, 'r')) !== false) {
            // 1行目をヘッダーとして取得
            $headers = fgetcsv($handle); // 1行目：ヘッダー
            // 2行目以降をデータとして取得
            while (($data = fgetcsv($handle)) !== false) {
                // ヘッダーとデータを組み合わせて連想配列を作成
                $users[] = array_combine($headers, $data);
            }
            fclose($handle);
        }
        return $users;
    }
    
    /**
     * ユーザ情報をメールアドレスで取得
     *
     * @param string $email ユーザのメールアドレス
     * @return array|null ユーザデータの連想配列、見つからなければnull
     */
    public function findByEmail($email)
    {
        $users = $this->get();
        $index = array_search($email, array_column($users, 'email'));
        return $users[$index] ?? null;
    }

    /**
     * ユーザ認証
     *
     * @param string $email ユーザのメールアドレス
     * @param string $password 入力されたパスワード
     * @return mixed 認証成功時はユーザデータの連想配列、失敗時はnull
     */
    public function auth($email, $password)
    {
        $user = $this->findByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
    }
}
