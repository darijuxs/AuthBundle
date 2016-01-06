<?php

namespace AuthBundle\Entity\User;

use AuthBundle\Entity\Access\Access;
use AuthBundle\Entity\Role\Role;
use AuthBundle\Entity\Token\Token;

/**
 * Class UserFilter
 * @package AuthBundle\Entity\User
 */
class UserFilter
{
    /**
     * @return array
     */
    public static function loginFilter()
    {
        return [
            User::ID,
            User::USERNAME,
            User::EMAIL,
            User::CREATED_AT,
            User::UPDATED_AT,
            User::TOKENS => [
                Token::TOKEN
            ],
            User::ROLE => [
                Role::NAME,
                Role::ACCESSES => [
                    Access::ROUTE
                ]
            ]
        ];
    }

    /**
     * @return array
     */
    public static function loginOneTokenFilter()
    {
        return [
            User::ID,
            User::USERNAME,
            User::EMAIL,
            User::CREATED_AT,
            User::UPDATED_AT,
            User::LAST_TOKEN => [
                Token::TOKEN
            ],
            User::ROLE => [
                Role::NAME,
                Role::ACCESSES => [
                    Access::ROUTE
                ]
            ]
        ];
    }
}
