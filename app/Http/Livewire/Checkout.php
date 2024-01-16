<?php

namespace App\Http\Livewire;

use App\Models\Coupon;
use App\Models\Learning;
use App\Models\Lpayment;
use App\Models\LTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class Checkout extends Component
{
    public $learns,$lpayment,$check,$tcode,$code,$payment;
    protected $listeners = ['changepayment' => 'changepayment'];

    public function mount($id)
    {
        $decrypt = decrypt($id);
        $this->learns = Learning::findOrFail($decrypt);
    }
    public function render()
    {
        $this->lpayment = Lpayment::all();
        return view('livewire.checkout')->layout('livewire.landingtemplate');
    }

    public function coupon(){
        $this->check = Coupon::where('code',$this->code)->first();
        $this->tcode = $this->code;
    }

    public function checkout(){
        $total = $this->learns->price;
        $coupon = 1;
        if($this->check){
            if($this->check->typecut == 'percentage'){
                $total = $this->learns->price - ($this->check->cutprice/100*$this->learns->price);
            }else{
                $total = $this->learns->price - $this->check->cutprice;
            }
            $coupon = $this->check->id;
        }
        LTransaction::create([
            'uuid' => (string) Str::uuid(),
            'user_id' => Auth::user()->id,
            'learning_id' => $this->learns->id,
            'lpayment_id' => $this->payment,
            'coupon_id' => $coupon,
            'status' => 0,
            'totalamount' => $total
        ]);
        return redirect()->to('learning/' . encrypt($this->learns->id));
    }
    public function changepayment($id){
        $this->payment = $id;
    }
}
