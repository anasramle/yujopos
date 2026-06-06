<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\EnsureBranchSelected;

// ============================================
// AUTHENTICATION ROUTES (Public)
// ============================================

// Login
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Register
Route::get('/register', function () {
    return view('auth.login', ['show' => 'register']);
})->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Forgot Password
Route::get('/forgot-password', function () {
    return view('auth.login', ['show' => 'forgot']);
})->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink($request->only('email'));

    return $status === Password::RESET_LINK_SENT
        ? back()->with('status', __($status))
        : back()->withErrors(['email' => __($status)]);
})->name('password.email');

// Reset Password
Route::get('/reset-password/{token}', function (Request $request, $token) {
    return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
})->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->password = Hash::make($password);
            $user->save();
        }
    );

    return $status == Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', 'Password reset successful')
        : back()->withErrors(['email' => [__($status)]]);
})->name('password.update');

// Force change password (first login)
Route::post('/force-change-password', [AuthController::class, 'forceChangePassword'])
    ->name('password.force.update');

// ============================================
// PROTECTED ROUTES (Authenticated users)
// ============================================
Route::middleware(['auth', 'force.password.change'])->group(function () {

    // Dashboard
    Route::get('/dashboard/global', function () {
        session()->forget('branch_id');
        return redirect()->route('dashboard');
    })->name('dashboard.global');

    Route::get('/branch/select/{id}', [DashboardController::class, 'selectBranch'])
        ->name('branch.select');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/top-items', [DashboardController::class, 'getTopItems']);
    Route::get('/report', [DashboardController::class, 'report'])->name('report');

    // Sales
    Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');

    // ========================================
    // ROUTES FOR ROLE 1 & 2 (Admin & Manager)
    // ========================================
    Route::middleware(['auth', 'role:1,2'])->group(function () {

        // Users Resource (Auto generates: index, create, store, show, edit, update, destroy)
        Route::resource('users', UserController::class);

        // Inventory (Manual routes)
        Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
        Route::get('/inventory/create', [InventoryController::class, 'create'])->name('inventory.create');
        Route::post('/inventory', [InventoryController::class, 'store'])->name('inventory.store');
        Route::get('/inventory/{id}/edit', [InventoryController::class, 'edit'])->name('inventory.edit');
        Route::put('/inventory/{id}', [InventoryController::class, 'update'])->name('inventory.update');
        Route::delete('/inventory/{id}', [InventoryController::class, 'destroy'])->name('inventory.destroy');
        Route::post('/inventory/{id}/add', [InventoryController::class, 'addStock'])->name('inventory.add');
        Route::post('/inventory/{id}/deduct', [InventoryController::class, 'deductStock'])->name('inventory.deduct');
        Route::get('/inventory/history', [InventoryController::class, 'history'])->name('inventory.history');
    });

    // ========================================
    // ROUTES FOR ROLE 1 ONLY (Super Admin)
    // ========================================
    Route::middleware(['auth', 'role:1'])->group(function () {

        // Onboarding
        Route::get('/onboarding', [OnboardingController::class, 'index'])->name('onboarding');
        Route::get('/onboarding/skip', [OnboardingController::class, 'skip'])->name('onboarding.skip');
        Route::post('/onboarding/branch', [OnboardingController::class, 'saveBranch'])->name('onboarding.branch');
        Route::post('/onboarding/category', [OnboardingController::class, 'saveCategory'])->name('onboarding.category');
        Route::post('/onboarding/product', [OnboardingController::class, 'saveProduct'])->name('onboarding.product');
        Route::post('/onboarding/complete', [OnboardingController::class, 'complete'])->name('onboarding.complete');

        // Profile (Admin only)
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    });

    // ========================================
    // CATEGORY ROUTES
    // ========================================
    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    // ========================================
    // USER MANAGEMENT (Additional)
    // ========================================
    Route::post('/users/switch-to-admin', [UserController::class, 'switchToAdmin'])->name('users.switchToAdmin');
    Route::post('/users/switch-to-cashier', [UserController::class, 'switchToCashier'])->name('users.switchToCashier');
    Route::post('/users/verify-admin', [UserController::class, 'verifyAdmin'])->name('users.verifyAdmin');

    // ========================================
    // PAYMENT ROUTES
    // ========================================
    Route::post('/payment', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');

    // ========================================
    // RECEIPT ROUTES
    // ========================================
    Route::get('/receipts', [ReceiptController::class, 'history'])->name('receipt_history');
    Route::get('/receipt/{id}', [ReceiptController::class, 'show']);
    Route::post('/receipt/send', [ReceiptController::class, 'send']);

    // ========================================
    // BRANCH ROUTES
    // ========================================
    Route::resource('branch', BranchController::class);
    Route::post('/switch-branch', [BranchController::class, 'switch'])->name('switch.branch');

    // ========================================
    // PRODUCT ROUTES (Resource only - no manual duplicates)
    // ========================================
    Route::resource('product', ProductController::class);
});
