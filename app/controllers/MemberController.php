<?php
/*
|--------------------------------------------------------------------------
| Confide Controller Template
|--------------------------------------------------------------------------
|
| This is the default Confide controller template for controlling user
| authentication. Feel free to change to your needs.
|
*/

class MemberController extends BaseController {

    /**
     * Displays the form for account creation
     *
     */
    public function getCreate()
    {
        Asset::container('footer')->add('jquery-terminal','js/jquery.terminal-0.6.2.min.js');
        Asset::container('footer')->add('terminal-register','js/register-terminal.js');
        return View::make('forritun.register');
    }

    /**
     * Stores new account
     *
     */
    public function postIndex()
    {
        $member = new Member;
        $member->email = Input::get( 'email' );
        $member->name = Input::get('name');
        $member->phone = Input::get('phone');
        $member->password = Input::get( 'password' );
        // Save if valid. Password field will be hashed before save
        $member->save();

        if ( $member->id )
        {
            return Response::json(array( 'success' => true));
        }
        else
        {
            // Get validation errors (see Ardent package)
            $error = $member->errors()->all(':message');

            return Response::json(array('success' => false, 'error' => $error));
        }
    }

    /**
     * Displays the login form
     *
     */
    public function getLogin()
    {
        if( Confide::user() )
        {
            // If user is logged, redirect to internal 
            // page, change it to '/admin', '/dashboard' or something
            return Redirect::to('/');
        }
        else
        {
            Asset::container('footer')->add('jquery-terminal','js/jquery.terminal-0.6.2.min.js');
            Asset::container('footer')->add('terminal-login','js/login-terminal.js');
            return View::make('forritun.login');
        }
    }

    /**
     * Attempt to do login
     *
     */
    public function postLogin()
    {
        $input = array(
            'email'    => Input::get( 'email' ), // May be the username too
            'password' => Input::get( 'password' ),
            'remember' => Input::get( 'remember' ),
        );

        // If you wish to only allow login from confirmed users, call logAttempt
        // with the second parameter as true.
        // logAttempt will check if the 'email' perhaps is the username.
        if ( Confide::logAttempt( $input ) ) 
        {
            // If the session 'loginRedirect' is set, then redirect
            // to that route. Otherwise redirect to '/'
            
            $r = Session::get('loginRedirect');
            //If the request was an AJAX request (terminal), then don't redirect
            if (Request::ajax()){
                if(!empty($r)){
                    Session::forget('loginRedirect');
                    return Response::json(array('success' => true, 'redirect' => $r));
                }
                else return Response::json(array('success' => true, 'redirect' => '/'));
            }

            //Otherwise, do what you want
            if (!empty($r))
            {
                
                return Redirect::to($r);
            }
            return Redirect::to('/'); // change it to '/admin', '/dashboard' or something
        }
        else
        {
            // Check if there was too many login attempts
            if( Confide::isThrottled( $input ) )
            {
                $err_msg = 'Of margar tilraunir til innskráningar, reynið aftur síðar';
            }
            else
            {
                $err_msg = 'Rangt póstfang eða lykilorð';
            }
                //If we are talking ajax, then we return JSON
                if (Request::ajax()){
                    return Response::json(array('success' => false, 'error' => $err_msg));
                }
                return Redirect::to('/login')
                    ->withInput(Input::except('password'))
                    ->with( 'error', $err_msg );
        }
    }

    /**
     * Attempt to confirm account with code
     *
     * @param  string  $code
     */
    public function getConfirm( $code )
    {
        if ( Confide::confirm( $code ) )
        {
            $notice_msg = Lang::get('confide::confide.alerts.confirmation');
                        return Redirect::to('user/login')
                            ->with( 'notice', $notice_msg );
        }
        else
        {
            $error_msg = Lang::get('confide::confide.alerts.wrong_confirmation');
                        return Redirect::to('user/login')
                            ->with( 'error', $error_msg );
        }
    }

    /**
     * Displays the forgot password form
     *
     */
    public function getForgot()
    {
        return View::make('members.forgot_password');
    }

    /**
     * Attempt to send change password link to the given email
     *
     */
    public function postForgot()
    {
        if( Confide::forgotPassword( Input::get( 'email' ) ) )
        {
            $notice_msg = Lang::get('confide::confide.alerts.password_forgot');
                        return Redirect::to('user/login')
                            ->with( 'notice', $notice_msg );
        }
        else
        {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_forgot');
                        return Redirect::to('user/forgot')
                            ->withInput()
                ->with( 'error', $error_msg );
        }
    }

    /**
     * Shows the change password form with the given token
     *
     */
    public function getReset( $token )
    {
        return View::make('members.reset_password')
                ->with('token', $token);
    }

    /**
     * Attempt change password of the user
     *
     */
    public function postReset()
    {
        $input = array(
            'token'=>Input::get( 'token' ),
            'password'=>Input::get( 'password' ),
            'password_confirmation'=>Input::get( 'password_confirmation' ),
        );

        // By passing an array with the token, password and confirmation
        if( Confide::resetPassword( $input ) )
        {
            $notice_msg = Lang::get('confide::confide.alerts.password_reset');
                        return Redirect::to('user/login')
                            ->with( 'notice', $notice_msg );
        }
        else
        {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_reset');
                        return Redirect::to('user/reset')
                            ->withInput()
                ->with( 'error', $error_msg );
        }
    }

    /**
     * Log the user out of the application.
     *
     */
    public function getLogout()
    {
        Confide::logout();
        
        return Redirect::to('/');
    }

}