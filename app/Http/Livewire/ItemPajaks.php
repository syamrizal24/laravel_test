<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;
use App\Models\Pajak;
use App\Models\Item_pajak;
use Illuminate\Http\Request;

class ItemPajaks extends Component
{
    public $pajaks, $items, $nama, $item_id, $pajak_id, $item_pajak_id;
    public $isModal = 0;

    public function render(Request $request)
    {
        if (!empty($request->id)) {
            $this->item_id = $request->id;
        }
        $this->items = Item::find($this->item_id);
        $this->pajaks = Pajak::orderBy('created_at', 'DESC')->get();
        return view('livewire.item-pajaks');
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
        $this->nama = $this->items->nama;
        $this->pajak_id = '';
    }

    public function store()
    {
        $this->validate([
            'pajak_id' => 'required|string'
        ]);

        Item_pajak::updateOrCreate(['id' => $this->item_pajak_id], [
            'item_id' => $this->item_id,
            'pajak_id' => $this->pajak_id
        ]);

        session()->flash('message', $this->item_pajak_id ? 'Data Telah Diperbaharui' : 'Data Telah Ditambahkan');
        $this->closeModal();
        $this->resetFields();
    }

    public function edit($id)
    {
        $item = Item::find($id);
        $this->item_pajak_id = $id;
        $this->openModal();
    }

    public function delete($id)
    {
        $item = Item_pajak::where([
            'item_id' => $this->item_id,
            'pajak_id' => $id
        ]);
        $item->delete();
        session()->flash('message', 'Data Berhasil Dihapus');
    }
}
