<?php

namespace App\Requests;

use Lib\Csrf;
use Lib\Request;

class UserUpdateRequest
{
    public static function validateOrRedirect(): array
    {
        if (!Request::isPost()) {
            header('Location: ' . BASE_URL . 'user/edit.php');
            exit;
        }

        if (!Csrf::verify()) {
            self::redirectWithState([], '不正なリクエストです。');
        }

        $posts = sanitize($_POST);
        unset($posts['csrf_token']);

        $validated = [
            'display_name' => trim((string) ($posts['display_name'] ?? '')),
            'profile' => trim((string) ($posts['profile'] ?? '')),
        ];

        if ($validated['display_name'] === '') {
            self::redirectWithState($validated, 'ディスプレイ名は必須です。');
        }

        if (mb_strlen($validated['display_name']) > 255) {
            self::redirectWithState($validated, 'ディスプレイ名は255文字以内で入力してください。');
        }

        return $validated;
    }

    private static function redirectWithState(array $form, string $error): void
    {
        $_SESSION[APP_KEY]['user_edit'] = [
            'form' => $form,
            'error' => $error,
        ];

        header('Location: ' . BASE_URL . 'user/edit.php');
        exit;
    }
}
