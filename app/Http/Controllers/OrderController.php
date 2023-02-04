<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use App\Mail\OrderConfirm;
use App\Order;
use App\OrderDetails;
use App\Product;
use App\Shipping;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function cartitems()
    {
        $cart['count'] = Cart::getContent()->count();
        $products = new Collection();
        $cart_items = Cart::getContent();
        $cart['subTotal'] = Cart::getSubTotal();
        foreach ($cart_items as $item) {
            $product = Product::find($item->id);
            $product->quantity = $item->quantity;
            $product->color = $item->attributes->color;
            $product->description = $item->attributes->description;
            $product->height = $item->attributes->height;
            $product->width = $item->attributes->width;
            $product->subTotal = $item->getPriceSum();
            $products->push($product);
        }
        return view('order.cart', compact('products', 'cart'));
    }


    public function addCart(Request $request, Product $product)
    {

        $this->validate($request, [
            'quantity' => 'required|numeric|min:0|gt:0',
        ]);

        Cart::add(array(
            'id' => $product->id,
            'name' => $product->title,
            'price' => $product->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'width' => ($request->width != null) ? $request->width : null,
                'height' => ($request->height != null) ? $request->height : null,
                'color' => ($request->color != null) ? $request->color : null,
                'description' => ($request->description != null) ? $request->description : null,
            )
        ));

        toastr()->success('added to basket');
        return redirect()->route('cart');
    }

    public function destroyCart(Request $request, Product $product)
    {
        Cart::remove($product->id);
        toastr()->success('deleted');
        return redirect()->back();
    }

    public function updatecart(Request $request, Product $product)
    {
        $this->validate($request, [
            'quantity' => 'required|numeric|min:0|gt:0',
        ]);
        Cart::update($product->id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->quantity,
            ),
        ));
        toastr()->success('Updated');
        return redirect()->back();
    }

    public function checkout()
    {
        $cart['count'] = Cart::getContent()->count();
        $products = new Collection();
        $cart_items = Cart::getContent();
        $cart['subTotal'] = Cart::getSubTotal();
        foreach ($cart_items as $item) {
            $product = Product::find($item->id);
            $product->quantity = $item->quantity;
            $product->subTotal = $item->getPriceSum();
            $products->push($product);
        }
        return view('order.checkout', compact('products', 'cart'));
    }



    public function order(Request $request)
    {
        $cart['count'] = Cart::getContent()->count();
        $products = new Collection();
        $cart_items = Cart::getContent();
        $cart['subTotal'] = Cart::getSubTotal();
        foreach ($cart_items as $item) {
            $product = Product::find($item->id);
            $product->quantity = $item->quantity;
            $product->color = $item->attributes->color;
            $product->description = $item->attributes->description;
            $product->height = $item->attributes->height;
            $product->width = $item->attributes->width;
            $product->subTotal = $item->getPriceSum();
            $products->push($product);
        }
        $order = Order::create([
            'invoice' => 'order' . time(),
            'user_id' => auth()->user()->id,
            'total'   =>  $cart['subTotal'],
            'payment_status' => "cash on delivery",
            'note' => $request->note,
            'order_status' => 'pending'
        ]);
      
        foreach ($products as $product) {
            OrderDetails::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' =>  $product->quantity,
                'color' => $product->color,
                'width' => $product->width,
                'height' => $product->height,
                'subtotal' => $product->subTotal,
                'description' => $product->description,
            ]);
        }
        Shipping::create([
            'order_id' => $order->id,
            'name' => $request->name,
            'email' => $request->email,
            'city' => $request->city,
            'phone' => $request->phone,
            'full_address' => $request->full_address,
            'zipcode' => $request->zipcode,
            'link' => $request->link,
        ]);
        Cart::clear();
        $data = $order;
        Mail::mailer('smtp')->to('sales@4space.com.sa')->send(new Contact($data));
        
        toastr()->success('order placeed');
        return redirect()->route('order.after.place', $order->id);
    }

    public function afterorder(Order $order)
    {
        return view('product.afterorder', compact('order'));
    }

    public function orderDetails(Order $order)
    {
        return view('product.orderDetails', compact('order'));
    }

    public function deleteOrder(Order $order)
    {
        $order->delete();
        toastr()->success('Order Deleted');
        return redirect()->back();
    }
    public function change_status(Order $order,Request $request)
    {
        $order->order_status = $request->order_status;
        $order->save();
        $data=$order;
        // Mail::mailer('smtp')->to($order->user->email)->send(new OrderConfirm($data));
        toastr()->success('Changed Successfully');
        return redirect()->back();
    }

    public function customer_change_status(Order $order,Request $request)
    {
        $order->order_status = $request->customer_order_status;
        $order->save();
        toastr()->success('Order Canceled');
        return redirect()->back();
    }

}
