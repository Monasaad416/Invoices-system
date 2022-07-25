<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceArchiveController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoiceDetailsController;
use App\Http\Controllers\InvoiceAttachmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\InvoiceReport;
use App\Http\Controllers\CustomerInvoiceReport;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard',[HomeController::class,'index'])->middleware(['auth'])->name('dashboard');
require __DIR__.'/auth.php';


// Route::get('/dashboard', function () {
//     return view('dashboard.index');
// })->middleware(['auth'])->name('dashboard');
// require __DIR__.'/auth.php';


Route::resource('sections',SectionController::class);
Route::resource('products',ProductController::class);
Route::resource('invoices',InvoicesController::class);

Route::resource('invoice_attachments',InvoiceAttachmentController::class);
Route::get('/download_attchment/{invoice_number}/{file}',[InvoiceAttachmentController::class,'download_attchment'])->name('download');
Route::get('/edit_invoice_status/{invoice_id}',[InvoicesController::class,'edit_status'])->name('edit_status');
Route::patch('/update_invoice_status/{invoice_id}',[InvoicesController::class,'update_status'])->name('update_status');
// Route::get('/view_attchment/{invoice_number}/{file}',[InvoiceAttachmentController::class,'view_attchment'])->name('view');

Route::get('/paid_invoices',[InvoicesController::class,'paid_invoices']);
Route::get('/unpaid_invoices',[InvoicesController::class,'unpaid_invoices']);
Route::get('/partially_paid_invoices',[InvoicesController::class,'partially_paid_invoices']);

Route::resource('invoices_archive',InvoiceArchiveController::class);
Route::post('/restore_archived_invoice/{invoice_id}',[InvoiceArchiveController::class,'restore_archived_invoice']);
Route::get('/print_invoice/{invoice_id}',[InvoicesController::class,'print_invoice'])->name('print_invoice');

Route::get('export_invoices/export/', [InvoicesController::class,'export'])->name('export_excel');

Route::get('getProdsBySection/{id}',[InvoicesController::class,'getProdsBySection']);
Route::get('/invoices_report',[InvoiceReport::class,'index']);
Route::post('/invoices/search',[InvoiceReport::class,'search_invoices'])->name('search_invoices');

Route::get('/customers_report',[CustomerInvoiceReport::class,'index']);
Route::post('/customers/search',[CustomerInvoiceReport::class,'search_cutomer_invoices'])->name('search_customer_invoices');

Route::get('/mark_all_as_read',[InvoicesController::class,'mark_all_read'])->name('mark_all_as_read');








Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

});



Route::get('/{page}', [AdminController::class,'index']);


