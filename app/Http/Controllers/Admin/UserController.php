<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $users = User::with('meta')
            ->when($search, function ($query, $search) {
                $query->where('user_login', 'like', "%{$search}%")
                      ->orWhere('user_email', 'like', "%{$search}%")
                      ->orWhere('display_name', 'like', "%{$search}%");
            })
            ->orderBy('user_login', 'asc')
            ->paginate(15);

        return view('admin.user.user', compact('users', 'search'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_login'   => 'required|string|max:60|unique:wordpress.ism13qf_users,user_login',
            'user_email'   => 'required|email|max:100|unique:wordpress.ism13qf_users,user_email',
            'user_pass'    => 'required|string|min:6',
            'display_name' => 'nullable|string|max:250',
            'user_status'  => 'required|integer|in:0,1,2',
        ]);

        User::create([
            'user_login'    => $request->user_login,
            'user_email'    => $request->user_email,
            'user_pass'     => bcrypt($request->user_pass),
            'display_name'  => $request->display_name ?? $request->user_login,
            'user_status'   => $request->user_status,
            'user_nicename' => strtolower(str_replace(' ', '-', $request->user_login)),
        ]);

        Notification::create([
            'type' => 'user_created',
            'title' => 'User Baru Ditambahkan',
            'message' => 'Oleh: ' . (Auth::user()->display_name ?? 'Admin') .
                        "\nUser: " . $request->user_login .
                        "\nTanggal: " . now()->format('d M Y, H:i'),
        ]);

        return redirect()->route('user.user')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::with('meta')->findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'user_login'   => 'required|string|max:60|unique:wordpress.ism13qf_users,user_login,' . $id . ',ID',
            'user_email'   => 'required|email|max:100|unique:wordpress.ism13qf_users,user_email,' . $id . ',ID',
            'user_pass'    => 'nullable|string|min:6',
            'display_name' => 'nullable|string|max:250',
            'user_status'  => 'required|integer|in:0,1,2',
        ]);

        $data = [
            'user_login'    => $request->user_login,
            'user_email'    => $request->user_email,
            'display_name'  => $request->display_name ?? $request->user_login,
            'user_status'   => $request->user_status,
            'user_nicename' => strtolower(str_replace(' ', '-', $request->user_login)),
        ];

        if ($request->filled('user_pass')) {
            $data['user_pass'] = bcrypt($request->user_pass);
    }

    $user->update($data);

    Notification::create([
    'type' => 'user_updated',
    'title' => 'User Diperbarui',
    'message' => 'Oleh: ' . (Auth::user()->display_name ?? 'Admin') .
                 "\nUser: " . $request->user_login .
                 "\nTanggal: " . now()->format('d M Y, H:i'),
    ]);

    return redirect()->route('user.user')->with('success', 'User berhasil diperbarui.');
    }

    public function show($id)
    {
        $user = User::with('meta')->findOrFail($id);
        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $username = $user->user_login;
        $user->delete();

    Notification::create([
    'type' => 'user_deleted',
            'title' => 'User Dihapus',
            'message' => 'Oleh: ' . (Auth::user()->display_name ?? 'Admin') .
                         "\nUser: " . $user->user_login .
                         "\nTanggal: " . now()->format('d M Y, H:i'),
        ]);

        return redirect()->route('user.user')->with('success', 'User berhasil dihapus.');
    }
}
