<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Update Request Status
    </h2>
  </x-slot>

  <div class="max-w-3xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white shadow sm:rounded-lg p-6">
      <form action="{{ route('requests.update', $request) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Title & Description (read-only) --}}
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700">Title</label>
          <input type="text" value="{{ $request->title }}"
            class="mt-1 block w-full border-gray-300 rounded-md bg-gray-100" disabled>
        </div>
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700">Description</label>
          <textarea rows="3"
            class="mt-1 block w-full border-gray-300 rounded-md bg-gray-100" disabled>{{ $request->description }}</textarea>
        </div>

        {{-- Status --}}
        <div class="mb-4">
          <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
          <select name="status" id="status"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            <option value="Pending"     {{ $request->status=='Pending'     ? 'selected':'' }}>Pending</option>
            <option value="In Progress" {{ $request->status=='In Progress' ? 'selected':'' }}>In Progress</option>
            <option value="Completed"   {{ $request->status=='Completed'   ? 'selected':'' }}>Completed</option>
          </select>
          @error('status')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        {{-- Buttons --}}
        <div class="flex justify-between">
          <a href="{{ route('requests.index') }}"
            class="text-gray-600 hover:text-gray-800">Cancel</a>
          <button type="submit"
            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Update Status
          </button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>
