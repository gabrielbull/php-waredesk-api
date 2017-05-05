<?php

namespace Waredesk;

use Waredesk\Exceptions\AccountBannedException;
use Waredesk\Exceptions\AccountDeletedException;
use Waredesk\Exceptions\AccountInvalidException;
use Waredesk\Exceptions\AuthenticationErrorException;
use Waredesk\Exceptions\EmailNotConfirmedException;
use Waredesk\Exceptions\InvalidClientException;
use Waredesk\Exceptions\InvalidRequestException;
use Waredesk\Exceptions\UnknownException;

class ErrorHandler
{
    public function __invoke(array $error)
    {
        switch ($error['error']) {
            case 'authentication_error':
                throw new AuthenticationErrorException($error['message']);
            case 'invalid_request':
                throw new InvalidRequestException($error['message']);
            case 'account_banned':
                throw new AccountBannedException($error['message']);
            case 'account_deleted':
                throw new AccountDeletedException($error['message']);
            case 'account_invalid':
                throw new AccountInvalidException($error['message']);
            case 'email_not_confirmed':
                throw new EmailNotConfirmedException($error['message']);
            case 'invalid_client':
                throw new InvalidClientException($error['message']);
        }
        throw new UnknownException();
    }
}
