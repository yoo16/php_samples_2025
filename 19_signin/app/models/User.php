<?php
class User extends Model
{
    /**
     * 全ユーザを取得
     *
     * @return array
     */
    public function get()
    {
        $stmt = self::pdo()->query(
            'SELECT id, display_name AS name, email, profile_image AS image FROM users'
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * メールアドレスでユーザを取得
     *
     * @param string $email
     * @return array|null
     */
    public function findByEmail($email)
    {
        $stmt = self::pdo()->prepare(
            'SELECT id, display_name AS name, email, profile_image AS image, password
             FROM users WHERE email = ? LIMIT 1'
        );
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * メールアドレスとパスワードで認証
     *
     * @param string $email
     * @param string $password
     * @return array|null
     */
    public function auth($email, $password)
    {
        $user = $this->findByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            unset($user['password']);
            return $user;
        }
        return null;
    }
}
