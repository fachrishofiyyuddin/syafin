@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-semibold mb-6 text-gray-800">Bot Commands</h2>

        <!-- Button to open modal for adding new command -->
        <button @click="commandModalOpen = true"
            class="bg-primary text-white px-6 py-2 rounded-md hover:bg-primary-light transition">
            Tambah Command Baru
        </button>

        <!-- Table to display bot commands -->
        <div class="overflow-x-auto mt-6 bg-white rounded-lg shadow-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Command</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Label</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Response</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Active</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    @foreach ($botCommands as $command)
                        <tr class="border-t border-gray-200 hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $command->command }}</td>
                            <td class="px-6 py-4">{{ $command->label }}</td>
                            <td class="px-6 py-4 text-ellipsis overflow-hidden" style="max-width: 200px;">
                                {{ $command->response }}
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="{{ $command->is_active ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }} px-3 py-1 rounded-full text-xs">
                                    {{ $command->is_active ? 'Yes' : 'No' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center space-x-4">
                                <!-- Edit Command -->
                                <a href="{{ route('bot.commands.edit', $command->id) }}"
                                    class="text-blue-500 hover:text-blue-700">Edit</a>

                                <!-- Delete Command -->
                                <form action="{{ route('bot.commands.destroy', $command->id) }}" method="POST"
                                    class="inline"
                                    onsubmit="return confirm('Are you sure you want to delete this command?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $botCommands->links() }}
        </div>
    </div>

    <!-- Modal for adding a new command -->
    <div x-show="commandModalOpen" x-transition.opacity
        class="fixed top-0 left-0 w-screen h-screen bg-black/30 backdrop-blur-sm bg-opacity-60 z-[9999] flex items-center justify-center"
        style="display: none;">

        <!-- Modal Box -->
        <div @click.away="commandModalOpen = false"
            class="bg-white rounded-lg shadow-lg w-full max-w-lg p-8 relative max-h-[90vh] overflow-y-auto mx-4 sm:mx-auto">

            <!-- Close Button -->
            <button @click="commandModalOpen = false"
                class="absolute top-3 right-3 text-gray-600 hover:text-gray-900 text-xl font-bold">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M6.293 4.293a1 1 0 011.414 0L10 6.586l2.293-2.293a1 1 0 111.414 1.414L11.414 8l2.293 2.293a1 1 0 01-1.414 1.414L10 9.414l-2.293 2.293a1 1 0 11-1.414-1.414L8.586 8 6.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>

            <!-- Modal Content -->
            <h3 class="text-xl font-semibold mb-6 text-primary text-center">Tambah Command Baru</h3>

            <!-- Form Modal -->
            <form action="{{ route('bot.commands.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <!-- Command -->
                    <div>
                        <label for="command" class="block text-sm font-medium text-gray-700">Command</label>
                        <input type="text" name="command" id="command"
                            class="w-full border rounded px-4 py-2 focus:outline-none focus:ring focus:ring-primary @error('command') border-red-500 @enderror"
                            placeholder="/commandname" required>
                        @error('command')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Label -->
                    <div>
                        <label for="label" class="block text-sm font-medium text-gray-700">Label</label>
                        <input type="text" name="label" id="label"
                            class="w-full border rounded px-4 py-2 focus:outline-none focus:ring focus:ring-primary @error('label') border-red-500 @enderror"
                            placeholder="Label untuk command" required>
                        @error('label')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Response -->
                    <div>
                        <label for="response" class="block text-sm font-medium text-gray-700">Response</label>
                        <textarea name="response" id="response" rows="4"
                            class="w-full border rounded px-4 py-2 focus:outline-none focus:ring focus:ring-primary @error('response') border-red-500 @enderror"
                            placeholder="Masukkan respons yang akan diberikan..." required></textarea>
                        @error('response')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Active Status -->
                    <div class="mb-4 flex items-center">
                        <label for="is_active" class="mr-2 text-sm font-medium text-gray-700">Aktifkan Command</label>
                        <input type="checkbox" name="is_active" id="is_active" checked class="h-5 w-5 text-primary">
                        <span class="text-sm text-gray-600 ml-2">Centang untuk mengaktifkan command ini</span>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-between mt-6">
                    <button type="button" @click="commandModalOpen = false"
                        class="px-4 py-2 rounded border border-gray-300 hover:bg-gray-100 text-gray-600">Batal</button>
                    <button type="submit" class="px-6 py-2 bg-primary text-white rounded hover:bg-primary-light">
                        Simpan Command
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
