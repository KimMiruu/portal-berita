@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-8 rounded-2xl shadow-lg mt-10">
    <h2 class="text-3xl font-bold mb-6 text-blue-700 flex items-center gap-2">
        <i class="fa-solid fa-user-circle text-blue-500 text-3xl"></i> Profil Saya
    </h2>

    @if (session('status') === 'profile-updated')
        <div class="mb-4 text-green-600 font-semibold flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i> Profil berhasil diperbarui.
        </div>
    @endif

    {{-- Form Update --}}
    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('PATCH')

        <div>
            <label class="block text-gray-700 font-semibold mb-1" for="name">Nama</label>
            <div class="relative">
                <input type="text" name="name" id="name"
                    value="{{ old('name', auth()->user()->name) }}"
                    class="w-full border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:outline-none rounded-lg px-10 py-2 transition duration-200 @error('name') border-red-500 @enderror">
                <i class="fa-solid fa-user absolute top-2.5 left-3 text-gray-400"></i>
            </div>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1" for="email">Email</label>
            <div class="relative">
                <input type="email" name="email" id="email"
                    value="{{ old('email', auth()->user()->email) }}"
                    class="w-full border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:outline-none rounded-lg px-10 py-2 transition duration-200 @error('email') border-red-500 @enderror">
                <i class="fa-solid fa-envelope absolute top-2.5 left-3 text-gray-400"></i>
            </div>
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1" for="password">Password Baru</label>
            <div class="relative">
                <input type="password" name="password" id="password"
                    class="w-full border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:outline-none rounded-lg px-10 py-2 transition duration-200 @error('password') border-red-500 @enderror">
                <i class="fa-solid fa-lock absolute top-2.5 left-3 text-gray-400"></i>
            </div>
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1" for="password_confirmation">Konfirmasi Password</label>
            <div class="relative">
                <input type="password" name="password_confirmation" id="password_confirmation"
                    class="w-full border border-gray-300 focus:ring-2 focus:ring-blue-400 focus:outline-none rounded-lg px-10 py-2 transition duration-200">
                <i class="fa-solid fa-check-double absolute top-2.5 left-3 text-gray-400"></i>
            </div>
        </div>

        <div class="text-right">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow transition duration-300">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
