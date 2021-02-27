<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Data Pajak Item
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
            @endif
            @if (!(empty($items)))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
                <div class="flex">
                    <div>
                        <h2><b>Nama Item : {{ $items->nama }}</b></h2>
                    </div>
                </div>
            </div>
            <button wire:click="create()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">Tambah Pajak</button>
            <a href="{{ route('item') }}" :active="request()->routeIs('item')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Kembali</a>
            @if($isModal)
            @include('livewire.create_item-pajaks')
            @endif

            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Rate</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items->pajak as $row)
                    <tr>
                        <td class="border px-4 py-2">{{ $row->nama }}</td>
                        <td class="border px-4 py-2">
                            {{ number_format($row->rate) }} %
                        </td>
                        <td class="border px-4 py-2">
                            <center>
                                <button wire:click="delete({{ $row->id }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Hapus</button>
                            </center>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="border px-4 py-2 text-center" colspan="3">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            @endif
        </div>
    </div>
</div>