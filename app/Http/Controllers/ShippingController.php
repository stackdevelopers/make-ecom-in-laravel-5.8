<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShippingCharge;

class ShippingController extends Controller
{
	public function viewShipping(){
		$shipping_charges = ShippingCharge::get();
		/*$shipping_charges = json_decode(json_encode($shipping_charges));
		echo "<pre>"; print_r($shipping_charges); die;*/
		return view('admin.shipping.view_shipping')->with(compact('shipping_charges'));
	}    

	public function editShipping($id, Request $request){
		if($request->isMethod('post')){
			$data = $request->all();
			/*echo "<pre>"; print_r($data); die;*/
			ShippingCharge::where('id',$id)->update(['shipping_charges0_500g'=>$data['shipping_charges0_500g'],'shipping_charges501_1000g'=>$data['shipping_charges501_1000g'],'shipping_charges1001_2000g'=>$data['shipping_charges1001_2000g'],'shipping_charges2001_5000g'=>$data['shipping_charges2001_5000g']]);
			return redirect()->back()->with('flash_message_success','Shipping Charges updated Successfully!');
		}
		$shippingDetails = ShippingCharge::where('id',$id)->first();
		return view('admin.shipping.edit_shipping')->with(compact('shippingDetails'));
	}
}
