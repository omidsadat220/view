<?php

use App\Http\Controllers\Auth\ExpenseReportController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Reports\ReportsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [BackendController::class, 'Dashboard'])
    ->middleware(['auth','verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Profile
    Route::controller(BackendController::class)->group(function () {
        Route::get('/admin/profile','AdminProfile')->name('admin.profile');
        Route::post('/profile/store','ProfileStore')->name('profile.store');
        Route::post('/admin/password/update','AdminPasswordUpdate')->name('admin.password.update');
    });

    //  Employee
    Route::controller(BackendController::class)->group(function () {
        Route::get('all/employee', 'AllEmployee')->name('all.employee');
        Route::get('add/employee', 'AddEmployee')->name('add.employee');
        Route::post('/store/employee', 'StoreEmployee')->name('store.employee');
        Route::get('/edit/employee/{id}', 'EditEmployee')->name('edit.employee');
        Route::post('/update/employee', 'UpdateEmployee')->name('update.employee');
        Route::get('/delete/employee/{id}', 'DeleteEmployee')->name('delete.employee');
        Route::get('/details/employee/{id}', 'DetailsEmployee')->name('details.employee');
    });

    //  Category
    Route::controller(BackendController::class)->group(function () {
        Route::get('all/category', 'AllCategory')->name('all.category');
        Route::get('add/category', 'AddCategory')->name('add.category');
        Route::post('/store/category', 'StoreCategory')->name('store.category');
        Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
        Route::post('/update/category', 'UpdateCategory')->name('update.category');
        Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
    });

    //  Products
    Route::controller(BackendController::class)->group(function () {
        Route::get('all/products', 'AllProducts')->name('all.products');
        Route::get('add/products', 'AddProducts')->name('add.products');
        Route::post('/store/products', 'StoreProducts')->name('store.products');
        Route::get('/edit/products/{id}', 'EditProducts')->name('edit.products');
        Route::get('/product/view/{id}',  'ViewProduct')->name('view.products');
        Route::get('/product/pdf/{id}',  'generatePDF')->name('product.pdf');
        Route::post('/update/products/{id}','UpdateProducts')->name('update.products');
        Route::get('/delete/products/{id}', 'DeleteProducts')->name('delete.products');


         Route::get('all/out-products', 'AllOutProducts')->name('all.out.products');
    });

    //  Sales
    Route::controller(BackendController::class)->group(function () {
        Route::get('all/sales', 'AllSales')->name('all.sales');
        Route::get('add/sales', 'AddSales')->name('add.sales');
        Route::post('/store/sales', 'StoreSales')->name('store.sales');
        Route::get('/edit/sales/{id}', 'EditSales')->name('edit.sales');
        Route::post('/update/sales/{id}','UpdateSales')->name('update.sales');
        Route::get('/delete/sales/{id}', 'DeleteSales')->name('delete.sales');
        Route::get('/details/sales/{id}', 'DetailsSales')->name('details.sales');

        Route::get('/sales/pending-notifications','PendingNotifications');
        Route::post('/sales/change-status/{id}','ChangeStatus');
    });
    Route::get('/get-products/{category_id}', [BackendController::class, 'GetProducts']);

     //  dept
    Route::controller(BackendController::class)->group(function () {
        Route::get('all/debt', 'AllDebt')->name('all.debt');
        Route::get('add/debt', 'AddDebt')->name('add.debt');
        Route::post('/store/debt', 'StoreDebt')->name('store.debt');
        Route::get('/edit/debt/{id}', 'EditDebt')->name('edit.debt');
        Route::post('/update/debt/{id}','UpdateDebt')->name('update.debt');
        Route::get('/delete/debt/{id}', 'DeleteDebt')->name('delete.debt');
    });
    

    //  expenses
    Route::controller(BackendController::class)->group(function () {
        Route::get('all/expenses', 'AllExpenses')->name('all.expenses');
        Route::get('add/expenses', 'AddExpenses')->name('add.expenses');
        Route::post('/store/expenses', 'StoreExpenses')->name('store.expenses');
        Route::get('/edit/expenses/{id}', 'EditExpenses')->name('edit.expenses');
        Route::post('/update/expenses/{id}','UpdateExpenses')->name('update.expenses');
        Route::get('/delete/expenses/{id}', 'DeleteExpenses')->name('delete.expenses');
    });

    //  Sponsers
    Route::controller(BackendController::class)->group(function () {
        Route::get('all/sponsers', 'AllSponsers')->name('all.sponsers');
        Route::get('add/sponser', 'AddSponser')->name('add.sponser');
        Route::post('/store/sponser', 'StoreSponser')->name('store.sponser');
        Route::get('/edit/sponser/{id}', 'EditSponser')->name('edit.sponser');
        Route::post('/update/sponser/{id}','UpdateSponser')->name('update.sponser');
        Route::get('/delete/sponser/{id}', 'DeleteSponser')->name('delete.sponser');
    });

    // Expense Reports
    Route::controller(ReportsController::class)->group(function() {
        Route::get('all/expenses/reports' , 'AllExpensesReport')->name('all.expenses.report');
        Route::post('search/expenses/bydate', 'SearchExpensesByDate')->name('search.expenses.by.date');
        Route::get('/all/expenses/invoice/{employee_id?}', 'AllExpensesInvoice')->name('all.expenses.invoice');
        Route::post('/search/expenses/bymonth', 'AllExpensesByMonth')->name('search.expenses.by.month');
        Route::post('/search/expenses/year', 'AllExpensesByYear')->name('search.expenses.by.year');
    });

    // Main Reports
    Route::controller(ReportsController::class)->group(function() {
        Route::get('all/reports' , 'AllReport')->name('all.report');
        Route::post('search/reports/bydate', 'SearchReportsByDate')->name('search.reports.by.date');
        Route::get('/all/reports/invoice/{employee_id?}', 'AllReportsInvoice')->name('all.reports.invoice');
        Route::post('/search/reports/bymonth', 'AllReportsByMonth')->name('search.reports.by.month');
        Route::post('/search/reports/year', 'AllReportsByYear')->name('search.reports.by.year');

        Route::get('/daily-report',  'dailyReport')->name('daily.report');

        Route::get('/all/sponsors/invoice', 'AllSponsorsInvoice')->name('all.sponsors.invoice');
        Route::get('/all/sales/invoice', 'AllSalesInvoice')->name('all.sales.invoice');
    });
});
    Route::get('/admin/logout', [BackendController::class, 'AdminLogout'])->name('admin.logout');

require __DIR__.'/auth.php';
