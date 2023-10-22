<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Str; 
use Illuminate\Http\Request;

class AdminController extends Controller
{
    
public function addUser(Request $request) {
    // Validation
    $request->validate([
        'user_name' => 'required|string|max:255',
        'user_password' => 'required|string|min:8',
        'user_email' => 'required|string|email|max:255|unique:users,email',
        'user_role' => 'required|in:0,1'
        ]);

        // Storing the user
        $user = new User();
        $user->name = $request->user_name;
        $user->email = $request->user_email;
        $user->password = bcrypt($request->user_password); // Encrypt password
        $user->role = $request->user_role;
        
        // Setting additional fields
        $user->account_id = $this->generateAccountId();  // Assuming you have this method in your controller
        $user->token = Str::random(60);
        $user->activate = true;

        $user->save();

        return redirect()->back()->with('success', 'User added successfully');
    }

    private function generateAccountId()
    {
        $accountId = Str::random(8);  // Generates an 8-character random string

        // Check if the generated account_id already exists in the database
        while (User::where('account_id', $accountId)->exists()) {
            $accountId = Str::random(8);  // Regenerate a new account_id
        }

        return $accountId;
    }

    public function index()
    {
        $users = User::all();
        return view('admin.dashboard', ['users' => $users]);
    }
}
