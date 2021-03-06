<?php

namespace App\Http\Controllers\Api;

    use App\Order;
    use App\OrderProduct;
    use App\UserCoupon;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Log;
class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        //
        $orders = Order::all();

        return response()->json($orders);
    }

    public function allproducts($id)
    {
        $products = OrderProduct::join('products','product_id','products.id')
            ->where('order_id',$id)
            ->select('products.*','quantity','discount')
            ->get();

        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate(
            $request,
            [
                'user_id' => 'required',
                'amount' => 'required|numeric',
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'company_name' => 'string',
                'address' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required|size:10',
                'discount' => 'required'
            ]
        );

       $order= Order::create([
            'user_id' => $request->user_id,
            'coupon_id' => $request->coupon_id,
            'amount' => $request->amount,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'company_name' => $request->company_name,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => 'pay',
            'discount' => $request->discount
        ]);

       if ($request->coupon_id != null)
       {
           $usercoupon = UserCoupon::where('user_id',$request->user_id)
               ->where('coupon_id',$request->coupon_id)
               ->where('is_used',false)
               ->first();
           $usercoupon->is_used = true;
           $usercoupon->save();
       }

        return response()->json([
            'success'=> true,
            'order_id' => $order->id
        ]);
    }

    public function storeproduct(Request $request)
    {
        OrderProduct::create([
            'order_id' => $request->order_id,
            'product_id'=> $request->product_id,
            'quantity' => $request->quantity
        ]);

        return response()->json([
            'success'=> true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $order = Order::find($id);
        if($order === null)
        {
            abort(404);
        }

        return response()->json($order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
