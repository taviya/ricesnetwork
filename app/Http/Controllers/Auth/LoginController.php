<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use kornrunner\Keccak;
use Illuminate\Support\Facades\Auth;
use Elliptic\EC;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/';




    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showAdminLoginForm()
    {
        $url = 'login';
        return view('auth.admin_login', compact('url'));
    }

    public function adminLogin(Request $request)
    {
        $this->validateLogin($request);
        if (
            Auth::attempt([
                'email' => $request->email,
                'password' => $request->password,
            ])
        ) {
            return redirect()->route('admin')->with('success', 'Login successfully.');
        } else {
            return back()->withInput($request->input())->withErrors(['error_message' => 'Invalid credential.']);
        }
    }


    public function authenticate(Request $request)
    {
        $ethAddress = Str::lower($request->ethAddress);
        $message = $request->message;
        $signature = $request->signature;

        $valid = $this->verifySignature($message, $signature, $ethAddress);
        if (!$valid) {
            return response()->json(['message' => 'Invalid signature'], 401);
        }

        $user = User::where('eth_address', $ethAddress)->first();

        if (!$user) {
            return response()->json(['message' => 'User with address not exist , please signup first'], 400);
        }

        Auth::login($user);
        return response()->json(['message' => 'Login successful'], 200);
    }


    protected function verifySignature($message, $signature, $address): bool
    {
        $messageLength = strlen($message);
        $hash = Keccak::hash("\x19Ethereum Signed Message:\n{$messageLength}{$message}", 256);
        $sign = [
            "r" => substr($signature, 2, 64),
            "s" => substr($signature, 66, 64)
        ];

        $recId = ord(hex2bin(substr($signature, 130, 2))) - 27;

        if ($recId != ($recId & 1)) {
            return false;
        }

        $publicKey = (new EC('secp256k1'))->recoverPubKey($hash, $sign, $recId);

        return $this->pubKeyToAddress($publicKey) === Str::lower($address);
    }

    protected function pubKeyToAddress($publicKey): string
    {
        return "0x" . substr(Keccak::hash(substr(hex2bin($publicKey->encode("hex")), 1), 256), 24);
    }


    public function registerAddress(Request $request)
    {
        try {
            $ethAddress = Str::lower($request->ethAddress);
            $message = $request->message;
            $signature = $request->signature;

            $checkAddressNotExist = User::where('eth_address', $ethAddress)->get();
            if ($checkAddressNotExist && count($checkAddressNotExist) > 0) {
                return response()->json(['error' => 'Address already exist, please try again with different wallet address'], 200);
            }

            $valid = $this->verifySignature($message, $signature, $ethAddress);
            if (!$valid) {
                return response()->json(['error' => 'Invalid signature'], 200);
            }

            $user = Auth::user();
            $user->update(['eth_address' => $ethAddress]);

            return response()->json(['error' => 'OK'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 200);
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin');
    }
}
