<x-app-layout>
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div class="flex justify-between items-center mb-6">
          <h1 class="text-2xl font-bold">Maintenance Requests</h1>
          <a href="{{ route('requests.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
              + New Request
          </a>
      </div>

      @if(session('success'))
          <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
              {{ session('success') }}
          </div>
      @endif

      <div class="w-[80vw] max-w-7xl mx-auto my-8 p-6 bg-[#1F2937] rounded-2xl shadow-lg overflow-auto">
        <table class="w-full text-sm text-left text-gray-200">
          <thead class="bg-[#374151] text-xs uppercase tracking-wider text-gray-400">
            <tr>
              <th class="px-6 py-4">Title</th>
              <th class="px-6 py-4">Priority</th>
              <th class="px-6 py-4">Status</th>
              <th class="px-6 py-4">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-700">
            @foreach($requests as $request)
              <tr class="hover:bg-gray-700 transition">
                <td class="px-6 py-4 text-base">{{ $request->title }}</td>
                <td class="px-6 py-4">
                  <span class="px-3 py-1 rounded-full text-xs font-semibold 
                    {{ $request->priority === 'High'   ? 'bg-red-500 text-red-100' :
                       ($request->priority === 'Medium' ? 'bg-yellow-500 text-yellow-100' :
                       'bg-green-500 text-green-100') }}">
                    {{ $request->priority }}
                  </span>
                </td>
                <td class="px-6 py-4">
                  <span class="px-3 py-1 rounded-full text-xs font-semibold 
                    {{ $request->status === 'Completed' ? 'bg-green-600 text-green-100' :
                       ($request->status === 'In Progress' ? 'bg-blue-600 text-blue-100' :
                       'bg-gray-600 text-gray-100') }}">
                    {{ $request->status }}
                  </span>
                </td>
                <td class="px-6 py-4 space-x-2">
                  <a href="{{ route('requests.edit', $request) }}" class="text-indigo-300 hover:text-indigo-100">Edit</a>
                  <form action="{{ route('requests.destroy', $request) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Delete this?')" class="text-red-400 hover:text-red-200">Delete</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      
        <div class="mt-6">
          {{ $requests->links('pagination::tailwind') }}
        </div>
      </div>
      

      <div class="mt-4">
          {{ $requests->links() }}
      </div>
  </div>
</x-app-layout>