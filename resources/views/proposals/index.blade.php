@extends('layouts.app')

@section('title', 'Proposals')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">All Proposals</h2>
    <a href="{{ route('proposals.create') }}"
       class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
        + Add Proposal
    </a>
</div>

<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-3 text-sm font-semibold text-gray-600">Title</th>
                <th class="px-6 py-3 text-sm font-semibold text-gray-600">Customer</th>
                <th class="px-6 py-3 text-sm font-semibold text-gray-600">Amount</th>
                <th class="px-6 py-3 text-sm font-semibold text-gray-600">Valid Until</th>
                <th class="px-6 py-3 text-sm font-semibold text-gray-600">Status</th>
                <th class="px-6 py-3 text-sm font-semibold text-gray-600 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($proposals as $proposal)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $proposal->title }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $proposal->customer->name }}</td>
                    <td class="px-6 py-4 text-gray-600">${{ number_format($proposal->amount, 2) }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $proposal->valid_until ? \Carbon\Carbon::parse($proposal->valid_until)->format('M d, Y') : '-' }}</td>
                    <td class="px-6 py-4">
                        <form action="{{ route('proposals.update-status', $proposal) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()"
                                class="text-xs font-semibold rounded-full px-3 py-1 border-0 cursor-pointer
                                @if($proposal->status === 'accepted') bg-green-100 text-green-700
                                @elseif($proposal->status === 'rejected') bg-red-100 text-red-700
                                @elseif($proposal->status === 'sent') bg-blue-100 text-blue-700
                                @else bg-gray-100 text-gray-700
                                @endif">
                                <option value="draft" {{ $proposal->status === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="sent" {{ $proposal->status === 'sent' ? 'selected' : '' }}>Sent</option>
                                <option value="accepted" {{ $proposal->status === 'accepted' ? 'selected' : '' }}>Accepted</option>
                                <option value="rejected" {{ $proposal->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </form>
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('proposals.show', $proposal) }}"
                           class="text-gray-600 hover:underline text-sm">View</a>
                        <a href="{{ route('proposals.edit', $proposal) }}"
                           class="text-indigo-600 hover:underline text-sm">Edit</a>
                        <form action="{{ route('proposals.destroy', $proposal) }}" method="POST"
                              class="inline" onsubmit="return confirm('Are you sure you want to delete this proposal?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-400">
                        No proposals found. Click "Add Proposal" to create one.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $proposals->links() }}
</div>

@endsection