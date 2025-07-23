@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-blue-600">Profil Saya</h2>

    @if (session('status') === 'profile-updated')
        <div class="mb-4 text-green-600 font-semibold">
            ✅ Profil berhasil diperbarui.
        </div>
    @endif

    {{-- Form Update --}}
   <form method="POST" action="{{ route('profile.update') }}">
    @csrf
    @method('PATCH') {{-- GANTI DARI POST KE PATCH --}}

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Nama</label>
            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                class="w-full border border-gray-300 rounded px-3 py-2 @error('name') border-red-500 @enderror">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Email (opsional)</label>
            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                class="w-full border border-gray-300 rounded px-3 py-2 @error('email') border-red-500 @enderror">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-semibold mb-1">Password Baru (opsional)</label>
            <input type="password" name="password"
                class="w-full border border-gray-300 rounded px-3 py-2 @error('password') border-red-500 @enderror">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-semibold mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation"
                class="w-full border border-gray-300 rounded px-3 py-2">
        </div>

        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition duration-300">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection
