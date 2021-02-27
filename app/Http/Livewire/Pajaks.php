<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pajak;

class Pajaks extends Component
{
    public $pajaks, $nama, $rate, $pajak_id;
    public $isModal = 0;

    public function render()
    {
        $this->pajaks = Pajak::orderBy('created_at', 'DESC')->get();
        return view('livewire.pajak');
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
        $this->pajak_id = '';
        $this->nama = '';
        $this->rate = '';
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required|string',
            'rate' => 'required|numeric'
        ]);

        Pajak::updateOrCreate(['id' => $this->pajak_id], [
            'nama' => $this->nama,
            'rate' => $this->rate
        ]);

        session()->flash('message', $this->pajak_id ? $this->nama . ' Telah Diperbaharui' : $this->nama . ' Telah Ditambahkan');
        $this->closeModal();
        $this->resetFields();
    }

    public function edit($id)
    {
        $pajak = Pajak::find($id);
        $this->pajak_id = $id;
        $this->nama = $pajak->nama;
        $this->rate = $pajak->rate;

        $this->openModal();
    }

    public function delete($id)
    {
        $pajak = Pajak::find($id);
        $pajak->delete();
        session()->flash('message', $pajak->nama . ' Berhasil Dihapus');
    }
}
