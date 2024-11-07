<?php

namespace App\Livewire\Web\Pages;

use App\Models\ContactUs;
use Livewire\Component;
use Livewire\Attributes\Title;

class Contact extends Component
{
    #[Title('Posh - Contact Us')]


    public $name,$email,$phone,$subject='';

    public function submitContact(){
        $this->validate([
            'name'=>'required|min:3',
            'email'=>'required|email',
            'phone'=>'nullable|numeric',
            'subject'=>'required|min:20'
        ]);

        $resutl=ContactUs::create([
            'name'=>$this->name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'subject'=>$this->subject
        ]);

        if($resutl){
            $this->reset('name','email','phone','subject');
            session()->flash('success','Thank you for contacting us. We will get back to you soon.');
        }else{
            session()->flash('error','Something went wrong. Please try again.');
        }
    }

    public function placeholder(){
        return view('placeholders.homeplaceholder');
    }
    public function render()
    {
        return view('livewire.web.pages.contact');
    }
}