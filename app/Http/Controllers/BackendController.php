<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Employee;
use App\Models\CategoryProduct;
use App\Models\Debt;
use App\Models\Expense;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Sponser;
use App\Models\User;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Barryvdh\DomPDF\Facade\Pdf; // Add at the top of your controller

class BackendController extends Controller
{
    public function AdminLogout(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect('login');
    }

    public function AdminProfile(){
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('backend.pages.profile.profile', compact('profileData'));
    }

    public function ProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        $oldPhotoPath = $data->photo;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/profile'),$filename);
            $data->photo = $filename;

            if ($oldPhotoPath && $oldPhotoPath !== $filename) {
                $this->deleteOldImage($oldPhotoPath);
            }
        }

        $data->save();
        return redirect()->back();
    }

    private function deleteOldImage(string $oldPhotoPath) : void {
        $fullPath = public_path('upload/profile/'.$oldPhotoPath);
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }

    public function AdminPasswordUpdate(Request $request){
        $user = Auth::user();
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if (!Hash::check($request->old_password, $user->password)) {
            $notification = array(
                'message' => 'رمز قبلی درست نیست',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        User::whereId($user->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        Auth::logout();
        $notification = array(
            'message' => 'پاسوورد موفقانه بروزرسانی شد',
            'alert-type' => 'success'
        );
        return redirect()->route('login')->with($notification);
    }

    // Dashboard
    public function Dashboard(){

        $todaySales = Sale::where('status','completed')
            ->whereDate('date', today())
            ->sum('total');

        // سود فروش خام
        $salesProfit = Sale::where('status','completed')
            ->whereDate('date', today())
            ->sum('profit');

        // مصارف بدون برداشت
        $todayExpenses = Expense::whereDate('date', today())
            ->where('type','!=','withdraw')
            ->sum('amount');

        // تعداد مصارف امروز
        $todayExpensesCount = Expense::whereDate('date', today())
            ->count();

        // تعداد فروش‌های امروز
        $todaySalesCount = Sale::where('status','completed')
            ->whereDate('date', today())
            ->count();

        // برداشت جدا
        $todayWithdraw = Expense::whereDate('date', today())
            ->where('type','withdraw')
            ->sum('amount');

        // ✅ سود خالص واقعی امروز
        $todayProfit = $salesProfit - $todayExpenses - $todayWithdraw;

        $totalStock = Product::where('tax','45')->sum('price');
        $totalPaied = Product::where('tax','45')->sum('paied');
        
        $totalExpenses = DB::select('
             SELECT SUM(categories.price) as total 
            FROM category_product 
            INNER JOIN categories ON category_product.category_id = categories.id
            INNER JOIN products ON category_product.product_id = products.id
            WHERE products.tax = 45
        ')[0]->total ?? 0;
        
        $totalEmployees = Employee::count();


        // where out is 

        $totalOutStock = Product::where('tax','30')->sum('price');
        $totalOutPaied = Product::where('tax','30')->sum('paied');
        $totalDebt = Debt::where('price', '>', 0)->get();


         $totalOutExpenses = DB::select('
            SELECT SUM(categories.price) as total 
            FROM category_product 
            INNER JOIN categories ON category_product.category_id = categories.id
            INNER JOIN products ON category_product.product_id = products.id
            WHERE products.tax = 30
        ')[0]->total ?? 0;



        return view('backend.index', compact(
            'todaySales',
            'todaySalesCount',
            'todayProfit',
            'todayExpenses',
            'todayWithdraw',
            'todayExpensesCount', // 👈 اینو اضافه کن
            'totalStock',
            'totalPaied',
            'totalExpenses',
            'totalEmployees',
            'totalOutStock',
            'totalOutPaied',
            'totalOutExpenses',
            'totalDebt'
        ));
    }

    // Employee
    public function AllEmployee(){
        $employee = Employee::latest()->get();
        return view('backend.pages.employee.index', compact('employee'));
    }

    public function AddEmployee() {
         return view('backend.pages.employee.add');
    }

    public function StoreEmployee(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'salary' => 'required|string|max:255',
            'position' => 'nullable',
            'phone' => 'nullable|string|max:20',
         
        ], [
            'name.required' => 'لطفا نام کارمند را وارد کنید',
            'lname.required' => 'لطفا تخلص کارمند را وارد کنید',
            'salary.required' => 'لطفا ولایت را وارد کنید',
            'position.required' => 'Enter a valid address',
            'phone.required' => 'Enter a valid email phone',

        ]);


       

        Employee::create([
            'name' => $request->name,
            'lname' => $request->lname,
            'salary' => $request->salary,
            'position' => $request->position,
            'phone' => $request->phone,
        ]);

        $notification = array(
            'message' => 'کاربر اضافه شد',
            'alert-type' => 'success'
        );
            return redirect()->route('all.employee')->with($notification);
    }

    public function EditEmployee(int $id){
        $employee = Employee::find($id);
        return view('backend.pages.employee.edit', compact('employee'));
    }

    public function UpdateEmployee(Request $request){
        $emp_id = $request->id;
        $request->validate([
            'name' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'province' => 'nullable|string|max:255',
            'email' => "nullable|email|unique:employees,email,{$emp_id}",
            'phone' => 'nullable|string|max:20',
            'national_id' => "nullable|string|unique:employees,national_id,{$emp_id}",
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'name.required' => 'لطفا نام کارمند را وارد کنید',
            'lname.required' => 'لطفا تخلص کارمند را وارد کنید',
            'province.required' => 'لطفا ولایت را وارد کنید',
            'email.required' => 'لطفا ایمیل کارمند را وارد کنید',
            'email.email' => 'Enter a valid email address',
            'email.unique' => 'This email is already taken',
            'national_id' => 'لطفا شماره تذکره را وارد کنید', 
            'national_id.unique' => 'این شماره تذکره قبلا ثبت شده', 
        ]);

        $employee = Employee::find($emp_id);

        if ($request->hasFile('photo')) {

            if ($employee->photo && file_exists(public_path($employee->photo))) {
                unlink(public_path($employee->photo));
            }

            $file = $request->file('photo');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/employee'), $filename);
            $photoPath = 'upload/employee/'.$filename;

            $employee->update([
                'photo' => $photoPath,
            ]);
        }

        Employee::find($emp_id)->update([
            'name' => $request->name,
            'lname' => $request->lname,
            'province' => $request->province,
            'email' => $request->email,
            'phone' => $request->phone,
            'national_id' => $request->national_id,
        ]);

        $notification = array(
            'message' => 'کارمند ویرایش شد',
            'alert-type' => 'success'
        );
           
            return redirect()->route('all.employee')->with($notification);
    }

    public function DetailsEmployee(int $id){
        $emp = Employee::with(['sales','expenses','sponsers'])->findOrFail($id);

        $currentMonth = Carbon::now()->month;

        $employeeCharges = $emp->expenses()->where('type','employee')->sum('amount');

        return view('backend.pages.employee.details', compact(
            'emp',
            'employeeCharges',
        ));
    }

    public function DeleteEmployee(int $id) {
        $employee = Employee::find($id);
        
        if ($employee->photo && file_exists(public_path($employee->photo))) {
            unlink(public_path($employee->photo));
        }

        $employee->delete();

        $notification = array(
            'message' => 'کارمند حذف شد',
            'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
    }

    // --------------  Category -----------------
    public function AllCategory(){
        $category = Category::latest()->get();
        return view('backend.pages.category.index', compact('category'));
    }

    public function AddCategory(){
        return view('backend.pages.category.add');
    }

    public function StoreCategory(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'لطفا نام دسته بندی را وارد کنید',
        ]);

        Category::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);

            $notification = array(
            'message' => 'خدمات و کرایه اضافه شد',
            'alert-type' => 'success'
        );
            return redirect()->route('all.category')->with($notification);
    }

    public function EditCategory(int $id){
        $category = Category::find($id);
        return view('backend.pages.category.edit', compact('category'));
    }

    public function UpdateCategory(Request $request){
        $cat_id = $request->id;
        // $category = Category::find($cat_id);

        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'لطفا نام دسته بندی را وارد کنید',
        ]);

            Category::find($cat_id)->update([
                'name' => $request->name,
                'price' => $request->price,
            ]);

            $notification = array(
            'message' => 'خدمات و کرایه ویرایش شد',
            'alert-type' => 'success'
        );
           
        return redirect()->route('all.category')->with($notification);
    }

    public function DeleteCategory(int $id){
        Category::find($id)->delete();

        $notification = array(
            'message' => 'خدمات و کرایه حذف شد',
            'alert-type' => 'error'
        );
            return redirect()->back()->with($notification);
    }

    // --------------Out  Products -----------------

    public function AllOutProducts(){
    $product = Product::where('tax', '35')
    ->with('categories')
    ->orderBy('id', 'desc')
    ->get();
    return view('backend.pages.products.index', compact('product'));
    }
    // --------------  Products -----------------



    public function AllProducts(){
    // $product = Product::where('tax', '45')
    //     ->with('categories')
    //     ->orderBy('id', 'desc')
    //     ->get();

     $product = Product::with('categories')->orderBy('id', 'desc')->get();
        return view('backend.pages.products.index', compact('product'));
    }

        public function AddProducts(){
        $categories = Category::all();
        return view('backend.pages.products.add', compact('categories'));
        }

            public function StoreProducts(Request $request) {
            // Validate the request
            $request->validate([
                'bellnumber' => 'required',
                'name' => 'required',
                'lastname' => 'required',
                'hall' => 'required',
                'room' => 'required',
                'date' => 'required',
                'price' => 'required',
                'paied' => 'required',
                'remaining' => 'required',
                'category_ids' => 'required|array|min:1', // At least one category selected
                'category_ids.*' => 'exists:categories,id'
            ]);

            if ($request->file('image')) {
    $image = $request->file('image');
    $manager = new ImageManager(new Driver());
    $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    
    $img = $manager->read($image);
    $img->resize(100, 90)->save(public_path('upload/product/'.$name_gen));
    
    $save_url = 'upload/product/'.$name_gen;

    $product = Product::create([
        'bellnumber' => $request->bellnumber,
        'name' => $request->name,
        'lastname' => $request->lastname,
        'hall' => $request->hall,
        'room' => $request->room,
        'date' => $request->date,
        'price' => $request->price,
        'paied' => $request->paied,
        'remaining' => $request->remaining,
        'tax' => $request->tax,
        'image' => $save_url, // ✅ FIXED
    ]);

    if ($request->has('category_ids')) {
        $product->categories()->attach($request->category_ids);
    }

    return redirect()->route('all.products')->with([
        'message' => 'قرارداد اضافه شد',
        'alert-type' => 'success'
    ]);
}
            }

        public function ViewProduct(int $id){
            $product = Product::with('categories')->findOrFail($id);
            return view('backend.pages.products.view', compact('product'));
        }

        // Generate PDF for the product
        public function generatePDF(int $id){
            $product = Product::with('categories')->findOrFail($id);
            
            $pdf = Pdf::loadView('backend.pages.products.pdf', compact('product'));
            
            // For landscape orientation
            // $pdf = Pdf::loadView('backend.pages.products.pdf', compact('product'))->setPaper('a4', 'landscape');
            
            return $pdf->download('product_' . $product->id . '.pdf');
            // Or stream in browser: return $pdf->stream('product_' . $product->id . '.pdf');
        }
 // Show edit form
   
   // Show edit form
    public function EditProducts(int $id){
        $product = Product::with('categories')->findOrFail($id);
        $categories = Category::all();
        
        // Get selected category IDs for this product
        $selectedCategories = $product->categories->pluck('id')->toArray();
        
        return view('backend.pages.products.edit', compact('product', 'categories', 'selectedCategories'));
    }
    
    // Update product
   public function UpdateProducts(Request $request, int $id)
{
    // Validate
    $request->validate([
        'bellnumber' => 'required',
        'name' => 'required',
        'lastname' => 'required',
        'hall' => 'required',
        'room' => 'required',
        'date' => 'required',
        'price' => 'required|numeric',
        'paied' => 'required|numeric',
        'remaining' => 'required|numeric',
        'category_ids' => 'required|array|min:1',
        'category_ids.*' => 'exists:categories,id',
    ]);

    // Find product
    $product = Product::findOrFail($id);

    // ✅ اگر عکس جدید آمده
    if ($request->file('image')) {

        // 🔥 حذف عکس قبلی (اگر وجود داشت)
        if (!empty($product->image) && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        // 📸 آپلود عکس جدید
        $image = $request->file('image');
        $manager = new ImageManager(new Driver());

        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

        $img = $manager->read($image);
        $img->resize(100, 90)->save(public_path('upload/product/'.$name_gen));

        $save_url = 'upload/product/'.$name_gen;

        // ✅ update با image
        $product->update([
            'bellnumber' => $request->bellnumber,
            'name' => $request->name,
            'lastname' => $request->lastname,
            'hall' => $request->hall,
            'room' => $request->room,
            'date' => $request->date,
            'price' => $request->price,
            'paied' => $request->paied,
            'remaining' => $request->remaining,
            'tax' => $request->tax,
            'image' => $save_url, // 🔥 مهم
        ]);

    } else {
        // ✅ اگر عکس تغییر نکرد
        $product->update([
            'bellnumber' => $request->bellnumber,
            'name' => $request->name,
            'lastname' => $request->lastname,
            'hall' => $request->hall,
            'room' => $request->room,
            'date' => $request->date,
            'price' => $request->price,
            'paied' => $request->paied,
            'remaining' => $request->remaining,
            'tax' => $request->tax,
        ]);
    }

    // Sync categories
    $product->categories()->sync($request->category_ids);

    return redirect()->route('all.products')->with([
        'message' => 'قرارداد با موفقیت به روز رسانی شد',
        'alert-type' => 'success'
    ]);
}

    // Delete product
    public function DeleteProducts(int $id)
{
    $product = Product::findOrFail($id);

    // 🔥 حذف عکس از سرور
    if (!empty($product->image) && file_exists(public_path($product->image))) {
        unlink(public_path($product->image));
    }

    // حذف دسته‌بندی‌ها (pivot)
    $product->categories()->detach();

    // حذف خود product
    $product->delete();

    return redirect()->route('all.products')->with([
        'message' => 'قرارداد با موفقیت حذف شد',
        'alert-type' => 'success'
    ]);
}

    // --------------  Sales -----------------

    public function AllSales(){
        $sale = Sale::orderBy('id','desc')->get();
        return view('backend.pages.sales.index', compact('sale'));
    }

    public function AddSales(){
        $employee = Employee::all();
        $category = Category::all();
        $product = Product::all();
        return view('backend.pages.sales.add', compact('employee','category', 'product'));
    }
    
    public function GetProducts(int $category_id){
        $products = Product::where('category_id', $category_id)->get();
        return response()->json($products);
    }

    public function StoreSales(Request $request){
    // تبدیل اعداد فارسی به انگلیسی قبل از validate
    $request->merge([
        'quantity' => str_replace(['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'], ['0','1','2','3','4','5','6','7','8','9'], $request->quantity),
        'sale_price' => str_replace(['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'], ['0','1','2','3','4','5','6','7','8','9'], $request->sale_price),
        'charges' => isset($request->charges) ? str_replace(['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'], ['0','1','2','3','4','5','6','7','8','9'], $request->charges) : 0,
    ]);

    $request->validate([
        'category_id' => 'required',
        'product_id' => 'required',
        'employee_id' => 'required',
        'quantity' => 'required|integer|min:1',
        'sale_price' => 'required|numeric',
        'province' => 'required',
        'status' => 'required|in:pending,completed,cancelled',
    ]);

    // تبدیل به عدد برای محاسبه‌ها
    $quantity = (int) $request->quantity;
    $sale_price = (float) $request->sale_price;
    $charges = (float) $request->charges; // <<< تغییر: همیشه از request بگیریم حتی pending

    $product = Product::findOrFail($request->product_id);

    if($request->status == 'completed'){

        if($product->quantity < $quantity){
            return back()->withErrors('موجودی کافی نیست');
        }

        $buy_price = $product->price;
        $total = ($sale_price * $quantity) - $charges;
        $profit = ($sale_price - $buy_price) * $quantity - $charges;

        $product->quantity -= $quantity;
        $product->save();

    }else{

        $buy_price = $product->price;
        // <<< تغییر: charges رو صفر نکنیم، فقط total و profit صفر بشن
        $total = 0;
        $profit = 0;
    }

    Sale::create([
        'category_id' => $request->category_id,
        'product_id' => $request->product_id,
        'employee_id' => $request->employee_id,
        'quantity' => $quantity,
        'buy_price' => $buy_price,
        'sale_price' => $sale_price,
        'charges' => $charges, // <<< تغییر اعمال شد
        'province' => $request->province,
        'status' => $request->status,
        'date' => $request->date,
        'bill' => $request->bill,
        'profit' => $profit,
        'total' => $total,
    ]);

    $notification = array(
        'message' => 'فروش موفقانه اضافه شد',
        'alert-type' => 'success'
    );

    return redirect()->route('all.sales')->with($notification);
}

    public function EditSales(int $id){
        $sale = Sale::findOrFail($id);
        $category = Category::all();
        $product = Product::all();
        $employee = Employee::all();
        return view('backend.pages.sales.edit', compact('sale','category','product','employee'));
    }

    public function UpdateSales(Request $request,int  $id){
    $request->validate([
        'category_id' => 'required',
        'product_id' => 'required',
        'employee_id' => 'required',
        'quantity' => 'required|integer|min:1',
        'sale_price' => 'required|numeric',
        'province' => 'required',
        'status' => 'required|in:pending,completed,cancelled',
    ]);

    $sale = Sale::findOrFail($id);
    $product = Product::findOrFail($request->product_id);

    $oldStatus = $sale->status;
    $newStatus = $request->status;

    $oldQty = $sale->quantity;
    $newQty = $request->quantity;
    $difference = $newQty - $oldQty;

    $charges = (float) ($request->charges ?? 0); // <<< تغییر: charges رو همیشه از request بگیریم

    if($newStatus == 'completed'){

        if($oldStatus != 'completed'){
            if($product->quantity < $newQty){
                return back()->withErrors('موجودی کافی نیست');
            }
            $product->quantity -= $newQty;
        }

        if($oldStatus == 'completed'){
            if($product->quantity < $difference){
                return back()->withErrors('موجودی کافی نیست');
            }
            $product->quantity -= $difference;
        }

        $total = ($request->sale_price * $request->quantity) - $charges;
        $profit = ($request->sale_price - $product->price) * $request->quantity - $charges;

    }else{

        if($oldStatus == 'completed'){
            $product->quantity += $oldQty;
        }

        // <<< تغییر: فقط total و profit صفر بشه، charges از request گرفته میشه
        $total = 0;
        $profit = 0;
    }

    $product->save();

    $sale->update([
        'category_id' => $request->category_id,
        'product_id' => $request->product_id,
        'employee_id' => $request->employee_id,
        'quantity' => $request->quantity,
        'buy_price' => $product->price,
        'sale_price' => $request->sale_price,
        'charges' => $charges, 
        'province' => $request->province,
        'status' => $request->status,
        'date' => $request->date,
        'bill' => $request->bill,
        'profit' => $profit,
        'total' => $total,
    ]);

    $notification = array(
        'message' => 'فروش موفقانه ویرایش شد',
        'alert-type' => 'success'
    );

    return redirect()->route('all.sales')->with($notification);
}

    public function DeleteSales(int $id){
        $sale = Sale::findOrFail($id);
        $product = Product::findOrFail($sale->product_id);

        if($sale->status == 'completed'){
            $product->quantity += $sale->quantity;
            $product->save();
        }

        $sale->delete();

        $notification = array(
            'message' => 'فروش حذف شد',
            'alert-type' => 'error'
        );

        return redirect()->route('all.sales')->with($notification);
    }

    public function PendingNotifications(){
        $sales = Sale::with('employee','product')
                    ->where('status','pending')
                    ->orderBy('date','desc')
                    ->get();
        return response()->json($sales);
    }

    public function ChangeStatus(Request $request,int $id){
    $sale = Sale::findOrFail($id);
    $product = Product::findOrFail($sale->product_id);

    $sale->status = $request->status;
    $sale->charges = $sale->charges ?? 0; // charges هیچ وقت null نباشه

    if($sale->status == 'completed'){
        $quantity = $sale->quantity;
        $buy_price = $product->price;
        $sale_price = $sale->sale_price;

        $sale->total = ($sale_price * $quantity) - $sale->charges;
        $sale->profit = ($sale_price - $buy_price) * $quantity - $sale->charges;

        if($product->quantity >= $quantity){
            $product->quantity -= $quantity;
            $product->save();
        }
    } else {
        if($sale->status != 'pending'){
            $product->quantity += $sale->quantity;
            $product->save();
        }
        $sale->total = 0;
        $sale->profit = 0;
    }

    // اضافه کن: تاریخ و province هم اگر لازم هست
    $sale->date = $sale->date ?? now();
    $sale->province = $sale->province ?? 'نامعلوم';

    $sale->save();

    return response()->json(['success'=>true]);
}

    public function DetailsSales(int $id){
        $sale = Sale::with(['product', 'employee', 'category'])->findOrFail($id);
        return view('backend.pages.sales.sales_details', compact('sale'));
    }



      public function AddDebt(){
        $expenses = Debt::latest()->get();
        return view('backend.pages.debt.add', compact('expenses'));
    }


     // --------------  Debt -----------------

    public function AllDebt(){
        $expenses = Debt::latest()->get();
        return view('backend.pages.debt.index', compact('expenses'));
    }


     public function StoreDebt(Request $request){

        Debt::create([
            'name' => $request->name,
            'about' => $request->about,
            'price' => $request->price,
            'date' => $request->date,
        ]);

        return redirect()->route('all.debt')->with('success', 'قرض با موفقیت ثبت شد');
    }

     public function EditDebt(int $id){
        $expense = Debt::find($id);
        return view('backend.pages.debt.edit', compact('expense',));
    }



    public function UpdateDebt(Request $request,int  $id){
       

        $expense = Debt::findOrFail($id);


        $expense->update([
            'name' => $request->name,
            'about' => $request->about,
            'price' => $request->price,
            'date' => $request->date,
        ]);

        return redirect()->route('all.debt')->with('success', 'قرض با موفقیت بروزرسانی شد');
    }




     public function DeleteDebt(int $id){
        $debt = Debt::findOrFail($id);
        $debt->delete();

        return redirect()->back()->with('success', 'قرض با موفقیت حذف شد.');
    }
    


    // --------------  Expenses -----------------
    public function AllExpenses(){
        $expenses = Expense::latest()->get();
        return view('backend.pages.expenses.index', compact('expenses'));
    }

    public function AddExpenses(){
        $employee = Employee::all();
        return view('backend.pages.expenses.add', compact('employee'));
    }

    public function StoreExpenses(Request $request){
        $request->validate([
            'type' => 'required|in:employee,shop,withdraw',
            'employee_id' => 'required_if:type,employee|required_if:type,withdraw|exists:employees,id',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        $employee_id = ($request->type === 'employee' || $request->type === 'withdraw') ? $request->employee_id : null;

        if($request->type == 'withdraw' && !$request->employee_id){
            return back()->withErrors(['employee_id' => 'برای برداشت باید کارمند انتخاب شود']);
        }

        Expense::create([
            'type' => $request->type,
            'employee_id' => $employee_id,
            'amount' => $request->amount,
            'date' => $request->date,
            'note' => $request->note,
        ]);

        return redirect()->route('all.expenses')->with('success', 'مصرف با موفقیت ثبت شد');
    }

    public function EditExpenses(int $id){
        $expense = Expense::find($id);
        $employee = Employee::all();
        return view('backend.pages.expenses.edit', compact('expense', 'employee'));
    }

    public function UpdateExpenses(Request $request, $id){
        $request->validate([
            'type' => 'required|in:employee,shop,withdraw',
            'employee_id' => 'required_if:type,employee|required_if:type,withdraw|exists:employees,id',
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'note' => 'nullable|string',
        ]);

        $expense = Expense::findOrFail($id);

        $employee_id = ($request->type === 'employee' || $request->type === 'withdraw') 
                ? $request->employee_id 
                : null;

        $expense->update([
            'type' => $request->type,
            'employee_id' => $employee_id,
            'title' => $request->title,
            'amount' => $request->amount,
            'date' => $request->date,
            'note' => $request->note,
        ]);

        return redirect()->route('all.expenses')->with('success', 'مصرف با موفقیت بروزرسانی شد');
    }

    public function DeleteExpenses(int $id){
        $expense = Expense::findOrFail($id);
        $expense->delete();

        return redirect()->back()->with('success', 'مصرف با موفقیت حذف شد.');
    }

     // --------------  Expenses -----------------
    public function AllSponsers(){
        $sponser = Sponser::latest()->get();
        return view('backend.pages.sponsers.index', compact('sponser'));
    }

    public function AddSponser(){
        $employees = Employee::all();
        $products = Product::all();
        return view('backend.pages.sponsers.add',compact('employees','products'));
    }

    public function StoreSponser(Request $request){
        $request->merge([
            'amount' => str_replace(
                ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'],
                ['0','1','2','3','4','5','6','7','8','9'],
                $request->amount
            ),
        ]);

        $request->validate([
            'employee_id' => 'nullable|exists:employees,id',
            'product_id' => 'nullable|exists:products,id',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        Sponser::create([
            'employee_id' => $request->employee_id,
            'product_id' => $request->product_id,
            'amount' => $request->amount,
            'date' => $request->date,
        ]);

        $notification = array(
            'message' => 'اسپانسر موفقانه اضافه شد',
            'alert-type' => 'success'
        );
        return redirect()->route('all.sponsers')->with($notification);
    }

    public function EditSponser($id){
        $sponser = Sponser::findOrFail($id);
        $employees = Employee::all();
        $products = Product::all();

        return view('backend.pages.sponsers.edit', compact('sponser','employees','products'));
    }
    
    public function UpdateSponser(Request $request,$id){
        $numbers = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
        $english = ['0','1','2','3','4','5','6','7','8','9'];

        $request->merge([
            'amount' => str_replace($numbers, $english, $request->amount),
        ]);

        $request->validate([
            'employee_id' => 'nullable|exists:employees,id',
            'product_id' => 'nullable|exists:products,id',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $sponser = Sponser::findOrFail($id);

        $sponser->update([
            'employee_id' => $request->employee_id,
            'product_id' => $request->product_id,
            'amount' => $request->amount,
            'date' => $request->date,
        ]);
        $notification = array(
            'message' => 'اسپانسر موفقانه بروزرسانی شد',
            'alert-type' => 'success'
        );
        return redirect()->route('all.sponsers')->with($notification);
    }

    public function DeleteSponser($id){
        $sponser = Sponser::findOrFail($id);
        $sponser->delete();

        return redirect()->back()->with('success', 'اسپانسر با موفقیت حذف شد.');
    }

}
