<?php

// reff = https://github.com/devcoder-xyz/php-session-manager
namespace Configuration;

class SessionManager implements SessionInterface
{

    public function __construct(string $cacheExpire = null, string $cacheLimiter = null)
    {
        if (session_status() === PHP_SESSION_NONE) {

            if ($cacheLimiter !== null) {
                session_cache_limiter($cacheLimiter);
            }

            if ($cacheExpire !== null) {
                session_cache_expire($cacheExpire);
            }

            session_start();
        }
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        if (array_key_exists($key, $_SESSION)) {
            return $_SESSION[$key];
        }

        return null;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @return SessionManager
     */
    public function set(string $key, $value): SessionInterface
    {
        $_SESSION[$key] = $value;
        return $this;
    }

    public function remove(string $key): void
    {
        if (array_key_exists($key, $_SESSION)) {
            unset($_SESSION[$key]);
        }
    }

    public function clear(): void
    {

        // IF DON'T USE COOKIE COMMENT THIS
        if (isset($_COOKIE)) {
            foreach($_COOKIE as $name => $value) {
                // if ($name != "preservecookie") // Name of the cookie you want to preserve 
                // {
                    setcookie($name, '', 1); // Better use 1 to avoid time problems, like timezones
                    setcookie($name, '', 1, '/');
                // }
            }
        }

        session_unset();
        session_destroy();
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $_SESSION);
    }

}