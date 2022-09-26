<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    function loginView()
    {
        return view("auth.login");
    }

    function registerView()
    {
        return view("auth.register");
    }

    function doLogin(Request $request)
    {
//dd($request);
        $validator = Validator::make($request->all(), [
            'email' => 'required',   // required and email format validation
            'password' => 'required', // required and number field validation

        ]); // create the validations
        if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
        {

            return back()->withInput()->withErrors($validator);
            // validation failed redirect back to form

        } else {
            //validations are passed try login using laravel auth attemp
            if (\Auth::attempt($request->only(["email", "password"]))) {
                return redirect("dashboard")->with('success', 'Login Successful');
            } else {
                return back()->withErrors( "Netačni podaci"); // auth fail redirect with error
            }
        }
    }

    function doRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',   // required and email format validation
            'password' => 'required|min:4', // required and number field validation
            'confirm_password' => 'required|same:password',

        ]); // create the validations
        if ($validator->fails())   //check all validations are fine, if not then redirect and show error messages
        {

            return back()->withInput()->withErrors($validator);
            // validation failed redirect back to form

        } else {
            //validations are passed, save new user in database
            $User = new User;
            $User->name = $request->name;
            $User->email = $request->email;
            $User->password = bcrypt($request->password);
            $User->save();

            return redirect("login")->with('success', 'Uspješna registracija, prijavite se sa novim podacima');
        }
    }
   // show dashboard
    function dashboard()
    {
        return redirect("/products");
    }

    // logout method to clear the sesson of logged in user
    function logout()
    {
        \Auth::logout();
        return redirect("/products")->with('success', 'Odjava uspješna');
    }
}