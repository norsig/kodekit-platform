<?php
/**
 * Nooku Platform - http://www.nooku.org/platform
 *
 * @copyright      Copyright (C) 2007 - 2014 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license        GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link           https://github.com/nooku/nooku-platform for the canonical source repository
 */

namespace Nooku\Component\Users;

use Nooku\Library;

/**
 * Form Dispatcher Authenticator
 *
 * @author  Johan Janssens <http://github.com/johanjanssens>
 * @package Nooku\Library\Dispatcher
 */
class DispatcherAuthenticatorForm extends DispatcherAuthenticatorCookie
{
    /**
     * Authenticate using email and password credentials
     *
     * @param Library\DispatcherContextInterface $context A dispatcher context object
     * @return  boolean Returns TRUE if the authentication explicitly succeeded.
     */
    public function authenticateRequest(Library\DispatcherContextInterface $context)
    {
        if($context->request->isPost() )
        {
            $controller = $context->subject->getController()->getIdentifier()->name;

            if ($context->request->data->has('email') && $controller == 'session')
            {
                $password = $context->request->data->get('password', 'string');
                $email    = $context->request->data->get('email'   , 'email');

                if($email)
                {
                    $user = $this->getObject('com:users.model.users')->email($email)->fetch();

                    if ($user->id)
                    {
                        //Check user password
                        if (!$user->getPassword()->verifyPassword($password)) {
                            throw new Library\ControllerExceptionRequestNotAuthenticated('Wrong password');
                        }

                        //Check user enabled
                        if (!$user->enabled) {
                            throw new Library\ControllerExceptionRequestNotAuthenticated('Account disabled');
                        }

                        //Login the user
                        $this->loginUser($user->id);

                        //Perform Cookie authentication
                        parent::authenticateRequest($context);

                        return true;
                    }
                    else throw new Library\ControllerExceptionRequestNotAuthenticated('Wrong email');
                }
                else throw new Library\ControllerExceptionRequestNotAuthenticated('Invalid email');
            }
        }
    }

    /**
     * Render the login form
     *
     * @param 	Library\DispatcherContextInterface $context The active command context
     * @return 	void
     */
    public function challengeResponse(Library\DispatcherContextInterface $context)
    {
        $response = $context->getResponse();
        $request  = $context->getRequest();

        if($response->getStatusCode() == Library\HttpResponse::UNAUTHORIZED)
        {
            if($request->getFormat() == 'html' && !$response->isDownloadable())
            {
                if($request->isSafe())
                {
                    $config = array(
                        'response'  => $response,
                    );

                    $this->getObject('com:users.controller.session', $config)
                        ->view('session')
                        ->render();
                }
                else $response->setRedirect($request->getReferrer(), $response->getStatusMessage(), 'error');
            }

            parent::challengeResponse($context);
        }
    }
}