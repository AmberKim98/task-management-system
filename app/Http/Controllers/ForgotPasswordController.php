<?php 
namespace App\Http\Controllers; 

use App\Http\Requests\ForgotPasswordFormRequest;
use App\Http\Requests\ResetPasswordFormRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
      /**
       * Show forgot password form.
       *
       * @return response()
       */
      public function showForgotPasswordForm()
      {
         return view('login.forgotpassword');
      }

      /**
       * Submit forgot password form to validate.
       *
       * @param ForgotPasswordFormRequest $request
       * @return response()
       */
      public function submitForgotPasswordForm(ForgotPasswordFormRequest $request)
      {
        $status=Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT ? back()->withSuccess('success',['status' => __($status)]) : back()->withErrors(['email' => __($status)]);
      }

      /**
       * Show reset password form
       *
       * @return response()
       */
      public function showResetPasswordForm(Request $request) 
      { 
        return view('login.resetpassword', ['token' => $request->token]);
      }

      /**
       * Submit reset password form to validate.
       *
       * @param ResetPasswordFormRequest $request
       * @return response()
       */
      public function submitResetPasswordForm(ResetPasswordFormRequest $request)
      {
          $status = Password::reset(
          $request->only('email', 'password','password_confirmation','token'),
          function($user, $password){
            $user->forceFill([
              'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
          }
        );
        return $status === Password::PASSWORD_RESET ? redirect()->route('login')->withSuccess('success','status', __($status)) : back()->withErrors(['email' => [__($status)]]);
      }
}
