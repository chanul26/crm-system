@extends('layouts.app')

@section('title', 'Customers')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">All Customers</h2>
    <a href="{{ route('customers.create') }}"
       class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
        + Add Customer
    </a>
</div>

<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="px-6 py-3 text-sm font-semibold text-gray-600">Name</th>
                <th class="px-6 py-3 text-sm font-semibold text-gray-600">Email</th>
                <th class="px-6 py-3 text-sm font-semibold text-gray-600">Phone</th>
                <th class="px-6 py-3 text-sm font-semibold text-gray-600">Company</th>
                <th class="px-6 py-3 text-sm font-semibold text-gray-600">Status</th>
                <th class="px-6 py-3 text-sm font-semibold text-gray-600 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($customers as $customer)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-800">{{ $customer->name }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $customer->email }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $customer->phone ?? '-' }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $customer->company ?? '-' }}</td>
                    <td class="px-6 py-4">
                        <form action="{{ route('customers.toggle-status', $customer) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="px-3 py-1 rounded-full text-xs font-semibold
                                {{ $customer->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($customer->status) }}
                            </button>
                        </form>
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('customers.edit', $customer) }}"
                           class="text-indigo-600 hover:underline text-sm">Edit</a>

                        <form action="{{ route('customers.destroy', $customer) }}" method="POST"
                              class="inline" onsubmit="return confirm('Are you sure you want to delete this customer?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-400">
                        No customers found. Click "Add Customer" to create one.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $customers->links() }}
</div>

@endsection