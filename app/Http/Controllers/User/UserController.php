<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home page
    public function home(){
        $pizza = Product::orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }

    //change password page
    public function changePasswordPage(){
        return view('user.password.change');
    }

    //change password
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);
            $currentUserId = Auth::user()->id;
            $user = User::select('password')->where('id',$currentUserId)->first();

            $dbHashValue = $user->password; //hash value

            if(Hash::check($request->oldPassword, $dbHashValue)){
                $data = [
                    'password'=>Hash::make($request->newPassword)
                ];
                User::where('id',Auth::user()->id)->update($data);

                // Auth::logout();
                // return redirect()->route('auth#loginPage');

                return back()->with(['changeSuccess'=>'Password Changed Successfully...']);
            }
            return back()->with(['notMatch' => 'The Old Password not match. Try Again!']);
    }

    //user account change page
    public function accountChangePage(){
        return view('user.profile.account');
    }

    //user account change
    public function accountChange($id,Request $request){
        $this->accountValidationCheck($request);
            $data = $this->getUserData($request);

            //for image
            if($request->hasFile('image')){
                $dbImage = User::where('id',$id)->first();
                $dbImage = $dbImage->image;

                if($dbImage != null){
                    Storage::delete('public/'.$dbImage);
                }

                $fileName = uniqid(). $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('public',$fileName);
                $data['image'] = $fileName;
            }

            User::where('id',$id)->update($data);
            return back()->with(['updateSuccess' => 'User Account Updated!']);
    }

    //filter pizza
    public function filter($categoryId){
        $pizza = Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();

        return view('user.main.home',compact('pizza','category','cart','history'));
    }


    //direct pizza details
    public function pizzaDetails($pizzaId){
        $pizza = Product::where('id',$pizzaId)->first();
        $pizzaList = Product::get();
        return view('user.main.details',compact('pizza','pizzaList'));
    }

    //Cart List
    public function cartList(){
        $cartList = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as product_image')
                    ->leftJoin('products','products.id','carts.product_id')
                    ->where('carts.user_id',Auth::user()->id)
                    ->get();
        // dd($cartList->toArray());
        $totalPrice = 0;
        foreach($cartList as $c){
            $totalPrice += $c->pizza_price * $c->qty;
        }


        return view('user.main.cart',compact('cartList','totalPrice'));
    }


    //direct history page
    public function history(){
        $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate('6');
        return view('user.main.history',compact('order'));
    }


    //user contact page
    public function contactPage(){

        return view('user.contact.contactPage');
    }

    //user contact message
    public function contactMessage(Request $request){
        $message = $this->getContactData($request);
        Contact::create($message);
        return redirect()->route('user#home');

    }

    //request user data
    private function getUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'updated_at' => Carbon::now()
        ];
    }

    //request contact data
    private function getContactData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];
    }


    //account validation check
    private function accountValidationCheck($request){
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'image' => 'mimes:png,jpg,webp,jpeg|file',
            'address' => 'required',

        ])->validate();
    }

    //password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:6|max:10',
            'newPassword'=>'required|min:6|max:10',
            'comfirmPassword'=>'required|min:6|max:10|same:newPassword'
        ])->validate();
    }
}
