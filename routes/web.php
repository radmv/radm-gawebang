<?php

use App\Http\Controllers;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/category/{category:slug}', [FrontController::class, 'category'])->name('front.category');
Route::get('/details/{project:slug}', [FrontController::class, 'details'])->name('front.details');
Route::get('/out-of-connect', [FrontController::class, 'out_of_connect'])->name('front.out_of_connect');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');

    // can:withdraw wallet
    Route::middleware('can:withdraw wallet')->group(function () {
        Route::get('/dashboard/wallet', [Controllers\DashboardController::class, 'wallet'])->name('dashboard.wallet');

        Route::get('/dashboard/wallet/withdraw', [Controllers\DashboardController::class, 'withdraw_wallet'])->name('dashboard.wallet.withdraw');

        Route::post('/dashboard/wallet/withdraw/store', [Controllers\DashboardController::class, 'withdraw_wallet_store'])->name('dashboard.wallet.withdraw.store');
    });

    // can:topup wallet
    Route::middleware('can:topup wallet')->group(function () {
        Route::get('/dashboard/wallet/topup', [Controllers\DashboardController::class, 'topup_wallet'])->name('dashboard.wallet.topup');

        Route::post('/dashboard/wallet/topup/store', [Controllers\DashboardController::class, 'topup_wallet_store'])->name('dashboard.wallet.topup.store');
    });

    // can:apply job
    Route::middleware('can:apply job')->group(function () {
        Route::get('/apply/{project:slug}', [Controllers\FrontController::class, 'apply_job'])
            ->name('front.apply_job');

        Route::post('/apply/{project:slug}/submit', [Controllers\FrontController::class, 'apply_job_store'])
            ->name('front.apply_job.store');

        Route::get('/dashboard/proposals', [Controllers\DashboardController::class, 'proposals'])
            ->name('dashboard.proposals');

        Route::get('/dashboard/proposal_details/{project}/{projectApplicant}', [Controllers\DashboardController::class, 'proposal_details'])
            ->name('dashboard.proposal_details');
    });

    // admin
    Route::prefix('admin')->name('admin.')->group(function () {
        // can:manage wallets
        Route::middleware('can:manage wallets')->group(function () {
            Route::get('/wallet/topups', [Controllers\WalletTransactionController::class, 'wallet_topups'])
                ->name('topups');

            Route::get('/wallet/withdrawals', [Controllers\WalletTransactionController::class, 'wallet_withdrawals'])
                ->name('withdrawals');

            Route::resource('wallet_transactions', Controllers\WalletTransactionController::class);
        });

        // can:manage applicants
        Route::middleware('can:manage applicants')->group(function () {
            Route::resource('project_applicants', Controllers\ProjectApplicantController::class);
        });

        // can:manage projects
        Route::middleware('can:manage projects')->group(function () {
            Route::resource('projects', Controllers\ProjectController::class);

            Route::post('/project/{projectApplicant}/completed', [Controllers\ProjectController::class, 'complete_project_store'])
                ->name('complete_project.store');

            Route::get('/project/{project}/tools', [Controllers\ProjectController::class, 'tools'])
                ->name('projects.tools');

            Route::post('/project/{project}/tools/store', [Controllers\ProjectController::class, 'tools_store'])
                ->name('projects.tools.store');

            Route::resource('project_tools', Controllers\ProjectToolController::class);
        });

        // can:manage categories
        Route::middleware('can:manage categories')->group(function () {
            Route::resource('categories', Controllers\CategoryController::class);
        });

        // can:manage tools
        Route::middleware('can:manage tools')->group(function () {
            Route::resource('tools', Controllers\ToolController::class);
        });
    });
});

require __DIR__ . '/auth.php';
