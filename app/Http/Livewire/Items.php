<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;
use App\Models\Pajak;

class Items extends Component
{
    public $items, $nama, $item_id;
    public $isModal = 0;

    public function render()
    {
        $this->items = Item::orderBy('created_at', 'DESC')->get();
        return view('livewire.item');
    }

    public function create()
    {
        $this->resetFields();
        $this->openModal();
    }

    public function closeModal()
    {
        $this->isModal = false;
    }

    public function openModal()
    {
        $this->isModal = true;
    }

    public function resetFields()
    {
        $this->item_id = '';
        $this->nama = '';
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required|string'
        ]);

        Item::updateOrCreate(['id' => $this->item_id], [
            'nama' => $this->nama
        ]);

        session()->flash('message', $this->item_id ? $this->nama . ' Telah Diperbaharui' : $this->nama . ' Telah Ditambahkan');
        $this->closeModal();
        $this->resetFields();
    }

    public function edit($id)
    {
        $item = Item::find($id);
        $this->item_id = $id;
        $this->nama = $item->nama;

        $this->openModal();
    }

    public function delete($id)
    {
        $item = Item::find($id);
        $item->delete();
        session()->flash('message', $item->nama . ' Berhasil Dihapus');
    }
}
