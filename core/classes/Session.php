<?php

namespace Core;

use App\App;

class Session
{
    private ?array $user = null;

    /**
     * Session constructor.
     */
    public function __construct()
    {
        session_start();
        $this->loginFromCookie();
    }

    /**
     * Function checks whether the session is not empty and calls login() function
     *
     * @return bool
     */
    public function loginFromCookie(): bool
    {
        if ($_SESSION) {
            return $this->login($_SESSION['email'], $_SESSION['password']);
        }

        return false;
    }

    /**
     * Function checks whether the user already exists;
     * Creates $user variable;
     * Sets $_SESSSION email and password;
     *
     * @param string $email
     * @param string $password
     * @return bool
     */
    public
    function login(string $email, string $password): bool
    {
        $registered_user = App::$db->getRowWhere('users', [
            'email' => $email,
            'password' => $password]);

        if ($registered_user) {
            $this->user = $registered_user;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;

            return true;
        }

        $this->user = null;
        return false;
    }

    /**
     * Functions returns an array of user;
     *
     * @return mixed
     */
    public
    function getUser(): ?array
    {
        return $this->user;
    }

    /**
     * Function destroys the session and redirects if provided;
     *
     * @param string|null $redirected
     */
    public
    function logout(?string $redirected = null): void
    {
        $_SESSION = [];
        session_destroy();

        if ($redirected) {
            header("location: $redirected");
        }
    }

}