@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-semibold mb-6 text-gray-800">Edit Bot Command</h2>

        <!-- Form Edit Command -->
        <form action="{{ route('bot.commands.update', $command->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Command -->
                <div class="bg-white p-5 shadow-lg rounded-lg border border-gray-200">
                    <label for="command" class="block text-sm font-medium text-gray-700">Command</label>
                    <input type="text" name="command" id="command"
                        class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary @error('command') border-red-500 @enderror"
                        value="{{ old('command', $command->command) }}" required>
                    @error('command')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Label -->
                <div class="bg-white p-5 shadow-lg rounded-lg border border-gray-200">
                    <label for="label" class="block text-sm font-medium text-gray-700">Label</label>
                    <input type="text" name="label" id="label"
                        class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary @error('label') border-red-500 @enderror"
                        value="{{ old('label', $command->label) }}" required>
                    @error('label')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Response -->
                <div class="bg-white p-5 shadow-lg rounded-lg border border-gray-200">
                    <label for="response" class="block text-sm font-medium text-gray-700">Response</label>
                    <textarea name="response" id="response" rows="10"
                        class="w-full border rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-primary @error('response') border-red-500 @enderror"
                        required>{{ old('response', $command->response) }}</textarea>
                    @error('response')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status Aktif -->
                <div class="bg-white p-5 shadow-lg rounded-lg border border-gray-200 mb-6">
                    <div class="flex items-center">
                        <label for="is_active" class="mr-3 text-sm font-medium text-gray-700">Aktifkan Command</label>
                        <input type="checkbox" name="is_active" id="is_active"
                            class="h-5 w-5 text-primary focus:ring-primary"
                            {{ old('is_active', $command->is_active) ? 'checked' : '' }}>
                    </div>
                    <p class="text-sm text-gray-600 mt-1">Centang untuk mengaktifkan command ini.</p>
                </div>
            </div>

            <!-- Aksi Form -->
            <div class="flex justify-between mt-6 space-x-4">
                <a href="{{ route('bot.commands.index') }}"
                    class="px-4 py-2 rounded-lg border border-gray-300 bg-gray-50 hover:bg-gray-100 text-gray-600 transition-colors duration-200">Kembali</a>
                <button type="submit"
                    class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-light focus:outline-none transition-colors duration-200">
                    Simpan Command
                </button>
            </div>
        </form>
    </div>
@endsection
