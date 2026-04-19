<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\Sale;
use App\Models\Sponser;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function AllExpensesReport(){
        return view('backend.pages.reports.expenses.all_expenses');
    }

    public function SearchExpensesByDate(Request $request){
        $request->validate([
            'date' => 'required|date',
        ]);

        $allExpenses = Expense::with('employee')
            ->whereDate('date', $request->date)
            ->get();

        $dailyTotal = $allExpenses->sum('amount');

        $expenses = $allExpenses
            ->groupBy(fn($item) => $item->employee_id ?? 0)
            ->map(function($group) {
                $first = $group->first();
                return (object)[
                    'employee_id' => $first->employee_id ?? 0,
                    'last_date' => $group->max('date'),
                    'total_expenses' => $group->count(),
                    'total_amount' => $group->sum('amount'),
                    'employee' => $first->employee ?? null,
                    'all_expenses' => $group,
                ];
            });

        return view('backend.pages.reports.expenses.search_by_date', compact('expenses','dailyTotal'));
    }

    public function AllExpensesInvoice(Request $request, $employee_id = 0){
        $year = $request->year; 
        $month = $request->month;
        $date = $request->date;
        $query = Expense::query();

        if ($year) {
            $query->whereYear('date', $year); 
        }

        if ($month) {
            $query->whereMonth('date', $month);
        }

        if ($date) {
            $query->whereDate('date', $date); 
        }

        if ($employee_id) {
            $query->where('employee_id', $employee_id);
        } else {
            $query->whereNull('employee_id');
        }

        $expenses = $query->with('employee')->get();

        return view('backend.pages.reports.expenses.invoice', compact('expenses'));
    }

    public function AllExpensesByMonth(Request $request){
        $request->validate([
            'month' => 'required|integer|min:1|max:12',
        ]);

        $month = $request->month;

        $allExpenses = Expense::with('employee')
            ->whereMonth('date', $month)
            ->get();

        $monthlyTotal = $allExpenses->sum('amount');

        $expenses = $allExpenses
            ->groupBy(fn($item) => $item->employee_id ?? 0)
            ->map(function($group) {
                $first = $group->first();
                return (object)[
                    'employee_id' => $first->employee_id ?? 0,
                    'last_date' => $group->max('date'),
                    'total_expenses' => $group->count(),
                    'total_amount' => $group->sum('amount'),
                    'employee' => $first->employee ?? null,
                    'all_expenses' => $group,
                ];
            });

        return view('backend.pages.reports.expenses.search_by_month', compact('expenses','monthlyTotal'));
    }

    public function AllExpensesByYear(Request $request){
        $request->validate([
            'year' => 'required|integer|min:2025|max:2030',
        ]);

        $year = $request->year;

        $allExpenses = Expense::with('employee')
            ->whereYear('date', $year)
            ->get();

        $yearlyTotal = $allExpenses->sum('amount');

        $expenses = $allExpenses
            ->groupBy(fn($item) => $item->employee_id ?? 0)
            ->map(function($group) {
                $first = $group->first();
                return (object)[
                    'employee_id' => $first->employee_id ?? 0,
                    'last_date' => $group->max('date'),
                    'total_expenses' => $group->count(),
                    'total_amount' => $group->sum('amount'),
                    'employee' => $first->employee ?? null,
                    'all_expenses' => $group,
                ];
            });

        return view('backend.pages.reports.expenses.search_by_year', compact('expenses','yearlyTotal','year'));
    }

    // -------- All Reports -------
    public function AllReport(){
        return view('backend.pages.reports.all_reports.all_reports');
    }

    public function SearchReportsByDate(Request $request){
        $request->validate([
            'date' => 'required|date',
        ]);

        $date = $request->date;

        $allExpenses = Expense::with('employee')->whereDate('date', $date)->get();
        $dailyExpenses = $allExpenses
            ->groupBy(fn($item) => $item->employee_id ?? 0)
            ->map(function($group){
                $first = $group->first();
                return (object)[
                    'employee_id' => $first->employee_id ?? 0,
                    'last_date' => $group->max('date'),
                    'total_expenses' => $group->count(),
                    'total_amount' => $group->sum('amount'),
                    'employee' => $first->employee ?? null,
                    'all_expenses' => $group,
                ];
            });
        $dailyExpensesTotal = $allExpenses->sum('amount');

        // ----------------- Sales -----------------
        $sales = Sale::with(['employee','product','category'])
            ->whereIn('status',['completed','pending','cancelled']) // اضافه شد
            ->whereDate('date', $date)
            ->get();

        $dailySales = $sales
            ->groupBy(fn($item) => $item->employee_id ?? 0)
            ->map(function($group){
                $first = $group->first();

                // اضافه شد
                $completed = $group->where('status','completed');

                return (object)[
                    'employee' => $first->employee ?? null,

                    // فقط completed
                    'total_quantity' => $completed->sum('quantity'),

                    // فقط completed
                    'total_sales' => $completed->sum(fn($item) => $item->sale_price * $item->quantity),

                    // همه status ها
                    'total_charges' => $group->sum('charges'),

                    // اضافه شد
                    'profit' => $completed->sum(fn($item) =>
                        ($item->sale_price * $item->quantity) -
                        ($item->buy_price * $item->quantity)
                    ),

                    'all_sales' => $group,
                ];
            });

        // ----------------- Sponsors -----------------
        $sponsors = Sponser::with('employee','product')->whereDate('date', $date)->get();
        $sponsorsTotal = $sponsors->sum('amount');
        $sponsors = $sponsors
            ->groupBy(fn($item) => $item->employee_id ?? 0)
            ->map(function($group){
                $first = $group->first();
                return (object)[
                    'employee' => $first->employee ?? null,
                    'product' => $first->product ?? null,
                    'amount' => $group->sum('amount'),
                    'sponsor_quantity' => $group->count(),
                    'date' => $group->max('date'),
                ];
            });

        // ----------------- Calculations -----------------
        $salesProfitTotal = $sales->where('status','completed') // اضافه شد
            ->sum(fn($s) => ($s->sale_price * $s->quantity) - ($s->buy_price * $s->quantity) - ($s->charges ?? 0));

        $finalAmount = $salesProfitTotal - $sponsorsTotal - $dailyExpensesTotal;

        return view('backend.pages.reports.all_reports.search_by_date', compact(
            'dailyExpenses',
            'dailyExpensesTotal',
            'sales',
            'dailySales',
            'salesProfitTotal',
            'finalAmount',
            'date',
            'sponsors',
            'sponsorsTotal'
        ));
    }

    public function AllReportsByMonth(Request $request){
        $request->validate([
            'month' => 'required|integer|min:1|max:12',
        ]);

        $month = $request->month;

        // ----------------- Expenses -----------------
        $allExpenses = Expense::with('employee')->whereMonth('date', $month)->get();
        $dailyExpenses = $allExpenses
            ->groupBy(fn($item) => $item->employee_id ?? 0)
            ->map(function($group){
                $first = $group->first();
                return (object)[
                    'employee_id' => $first->employee_id ?? 0,
                    'last_date' => $group->max('date'),
                    'total_expenses' => $group->count(),
                    'total_amount' => $group->sum('amount'),
                    'employee' => $first->employee ?? null,
                    'all_expenses' => $group,
                ];
            });
        $dailyExpensesTotal = $allExpenses->sum('amount');

        // ----------------- Sales -----------------
        $sales = Sale::with(['employee','product','category'])
            ->whereIn('status',['completed','pending','cancelled'])
            ->whereMonth('date', $month)
            ->get();

        $dailySales = $sales
            ->groupBy(fn($item) => $item->employee_id ?? 0)
            ->map(function($group){
                $first = $group->first();
                $completed = $group->where('status','completed');
                return (object)[
                    'employee' => $first->employee ?? null,
                    'total_quantity' => $completed->sum('quantity'),
                    'total_sales' => $completed->sum(fn($item) => $item->sale_price * $item->quantity),
                    'total_charges' => $group->sum('charges'),
                    'profit' => $completed->sum(fn($item) => ($item->sale_price * $item->quantity) - ($item->buy_price * $item->quantity)),
                    'all_sales' => $group,
                    'employee_id' => $first->employee_id ?? 0,
                ];
            });

        // ----------------- Sponsors -----------------
        $sponsors = Sponser::with('employee','product')->whereMonth('date', $month)->get();
        $sponsorsTotal = $sponsors->sum('amount');
        $sponsors = $sponsors
            ->groupBy(fn($item) => $item->employee_id ?? 0)
            ->map(function($group){
                $first = $group->first();
                return (object)[
                    'employee' => $first->employee ?? null,
                    'product' => $first->product ?? null,
                    'amount' => $group->sum('amount'),
                    'sponsor_quantity' => $group->count(),
                    'date' => $group->max('date'),
                ];
            });

        // ----------------- Calculations -----------------
        // اصلاح: محاسبه سود واقعی بدون دوبار کم کردن charges
        $salesProfitTotal = $dailySales->sum(fn($s) => $s->profit - $s->total_charges);

        $finalAmount = $salesProfitTotal - $sponsorsTotal - $dailyExpensesTotal;

        return view('backend.pages.reports.all_reports.search_by_month', compact(
            'dailyExpenses','dailyExpensesTotal','sales','dailySales','salesProfitTotal','finalAmount','month','sponsors','sponsorsTotal'
        ));
    }

    public function AllReportsByYear(Request $request){
        $request->validate([
            'year' => 'required|integer|min:2025|max:2030',
        ]);

        $year = $request->year;

        // ----------------- Expenses -----------------
        $allExpenses = Expense::with('employee')->whereYear('date', $year)->get();
        $dailyExpenses = $allExpenses
            ->groupBy(fn($item) => $item->employee_id ?? 0)
            ->map(function($group){
                $first = $group->first();
                return (object)[
                    'employee_id' => $first->employee_id ?? 0,
                    'last_date' => $group->max('date'),
                    'total_expenses' => $group->count(),
                    'total_amount' => $group->sum('amount'),
                    'employee' => $first->employee ?? null,
                    'all_expenses' => $group,
                ];
            });
        $dailyExpensesTotal = $allExpenses->sum('amount');

        // ----------------- Sales -----------------
        $sales = Sale::with(['employee','product','category'])
            ->whereIn('status',['completed','pending','cancelled'])
            ->whereYear('date', $year)
            ->get();

        $dailySales = $sales
            ->groupBy(fn($item) => $item->employee_id ?? 0)
            ->map(function($group){
                $first = $group->first();
                $completed = $group->where('status','completed');
                return (object)[
                    'employee' => $first->employee ?? null,
                    'total_quantity' => $completed->sum('quantity'),
                    'total_sales' => $completed->sum(fn($item) => $item->sale_price * $item->quantity),
                    'total_charges' => $group->sum('charges'),
                    'profit' => $completed->sum(fn($item) => ($item->sale_price * $item->quantity) - ($item->buy_price * $item->quantity)),
                    'all_sales' => $group,
                    'employee_id' => $first->employee_id ?? 0,
                ];
            });

        // ----------------- Sponsors -----------------
        $sponsors = Sponser::with('employee','product')->whereYear('date', $year)->get();
        $sponsorsTotal = $sponsors->sum('amount');
        $sponsors = $sponsors
            ->groupBy(fn($item) => $item->employee_id ?? 0)
            ->map(function($group){
                $first = $group->first();
                return (object)[
                    'employee' => $first->employee ?? null,
                    'product' => $first->product ?? null,
                    'amount' => $group->sum('amount'),
                    'sponsor_quantity' => $group->count(),
                    'date' => $group->max('date'),
                ];
            });

        // ----------------- Calculations -----------------
        // NEW: Calculate real profit like the tables do
        $salesProfitTotal = $dailySales->sum(fn($s) => $s->profit - $s->total_charges);

        // Final amount
        $finalAmount = $salesProfitTotal - $sponsorsTotal - $dailyExpensesTotal;

        return view('backend.pages.reports.all_reports.search_by_year', compact(
            'dailyExpenses','dailyExpensesTotal','sales','dailySales','salesProfitTotal','finalAmount','year','sponsors','sponsorsTotal'
        ));
    }

    public function AllSponsorsInvoice(Request $request){
        $employee_id = $request->employee_id;
        $month = $request->month;
        $date = $request->date;

        $sponsors = Sponser::with('employee','product')
            ->where('employee_id',$employee_id)
            ->when($date, fn($q) => $q->whereDate('date', $date)) 
            ->when($month, fn($q) => $q->whereMonth('date',$month))
            ->get();

        return view('backend.pages.reports.sponsers.invoice', compact('sponsors'));
    }

    public function AllSalesInvoice(Request $request){
        $employee_id = $request->employee_id;
        $date = $request->date;
        $month = $request->month;
        $year = $request->year; 

        // همه فروش‌ها: completed, pending, cancelled
        $sales = Sale::with(['employee','product','category'])
            ->where('employee_id', $employee_id)
            ->when($date, fn($query) => $query->whereDate('date', $date))
            ->when($month, fn($query) => $query->whereMonth('date', $month))
            ->when($year, fn($query) => $query->whereYear('date', $year)) 
            ->get();

        // جمع charges از pending و cancelled
        $pendingCharges = $sales->where('status','pending')->sum('charges');
        $cancelledCharges = $sales->where('status','cancelled')->sum('charges');

        // فقط completed برای محاسبه سود و فروش واقعی
        $completedSales = $sales->where('status','completed');
        $total_sales = $completedSales->sum(fn($s) => $s->sale_price * $s->quantity);
        $total_quantity = $completedSales->sum('quantity');
        $total_profit = $completedSales->sum(fn($s) => ($s->sale_price * $s->quantity) - ($s->buy_price * $s->quantity) - ($s->charges ?? 0));

        // سود خالص = سود واقعی completed - charges pending - charges cancelled
        $total_final = $total_profit - $pendingCharges - $cancelledCharges;

        $employee = Employee::find($employee_id);

        return view('backend.pages.reports.sales_invoice.invoice', compact(
            'sales','employee','date','month','total_sales','total_quantity','total_profit','pendingCharges','cancelledCharges','total_final'
        ));
    }
}
