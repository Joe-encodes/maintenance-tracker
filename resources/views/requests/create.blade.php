<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      New Maintenance Request
    </h2>
  </x-slot>

  <div class="max-w-3xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white shadow sm:rounded-lg p-6">
      <form action="{{ route('requests.store') }}" method="POST">
        @csrf

        {{-- Title --}}
        <div class="mb-4">
          <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
          <input type="text" name="title" id="title"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
            value="{{ old('title') }}" required>
          @error('title')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Description --}}
        <div class="mb-4">
          <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
          <textarea name="description" id="description" rows="4"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
            required>{{ old('description') }}</textarea>
          @error('description')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Priority --}}
        <div class="mb-4">
          <label for="priority" class="block text-sm font-medium text-gray-700">Priority</label>
          <select name="priority" id="priority"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            <option value="Low"    {{ old('priority')=='Low'    ? 'selected':'' }}>Low</option>
            <option value="Medium" {{ old('priority')=='Medium' ? 'selected':'' }}>Medium</option>
            <option value="High"   {{ old('priority')=='High'   ? 'selected':'' }}>High</option>
          </select>
          @error('priority')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Submit --}}
        <div class="flex justify-end">
          <button type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Submit Request
          </button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>
