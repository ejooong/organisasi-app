<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserManagementController extends Controller
{
    /**
     * Daftar semua user admin
     */
    public function index()
    {
        $users = User::with('roles')->whereHas('roles', function ($q) {
            $q->whereIn('name', ['admin', 'super_admin']);
        })->latest()->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Form tambah admin
     */
    public function create()
    {
        $roles = Role::whereIn('name', ['admin', 'super_admin'])->get();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Simpan admin baru
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:admin,super_admin',
        ]);

        $user = User::create([
            'name'              => $validated['name'],
            'email'             => $validated['email'],
            'password'          => Hash::make($validated['password']),
            'email_verified_at' => now(),
        ]);

        $user->assignRole($validated['role']);

        return response()->json([
            'success' => true,
            'message' => 'Admin berhasil ditambahkan.',
        ]);
    }

    /**
     * Form edit admin
     */
    public function edit(User $user)
    {
        $roles = Role::whereIn('name', ['admin', 'super_admin'])->get();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update data admin
     */
    public function update(Request $request, User $user): JsonResponse
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role'     => 'required|in:admin,super_admin',
        ]);

        $user->update([
            'name'  => $validated['name'],
            'email' => $validated['email'],
        ]);

        if (!empty($validated['password'])) {
            $user->update(['password' => Hash::make($validated['password'])]);
        }

        $user->syncRoles([$validated['role']]);

        return response()->json([
            'success' => true,
            'message' => 'Data admin berhasil diperbarui.',
        ]);
    }

    /**
     * Hapus admin
     */
    public function destroy(User $user): JsonResponse
    {
        // Jangan hapus diri sendiri
        if ($user->id === auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat menghapus akun Anda sendiri.',
            ], 422);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'Admin berhasil dihapus.',
        ]);
    }
}
