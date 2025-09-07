<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\LoginHistoryController;
use App\Http\Controllers\ContratoTipoController;
use App\Http\Controllers\SeloController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Rotas públicas
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/auth/reset-password', [AuthController::class, 'resetPassword']);

// Rotas do Google OAuth
Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);
Route::get('/auth/google/status', [GoogleAuthController::class, 'checkGoogleConnection']);

// Rotas públicas de conteúdo
Route::get('/plans', [PlanController::class, 'index']);
Route::get('/plans/{id}', [PlanController::class, 'show']);
Route::get('/faqs', [FaqController::class, 'index']);
Route::get('/testimonials', [TestimonialController::class, 'index']);
Route::post('/contacts', [ContactController::class, 'store']);
Route::get('/site-content', [SiteSettingController::class, 'getSiteContent']);

// Rotas públicas de pagamento
Route::get('/payment/methods', [PaymentController::class, 'getPaymentMethods']);
Route::post('/payment/webhook', [PaymentController::class, 'webhook']);

// Rotas protegidas por autenticação
Route::middleware('auth:sanctum')->group(function () {

    // Autenticação
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/me', [AuthController::class, 'me']);

    // Perfil do usuário
    Route::get('/user/profile', [UserController::class, 'profile']);
    Route::put('/user/profile', [UserController::class, 'updateProfile']);

    // Assinaturas do usuário
    Route::get('/user/subscriptions', [SubscriptionController::class, 'userSubscriptions']);
    Route::put('/user/subscriptions/{id}/cancel', [SubscriptionController::class, 'cancelUserSubscription']);
    Route::post('/user/subscriptions/compare-plan-change', [SubscriptionController::class, 'comparePlanChange']);
    Route::put('/user/subscriptions/change-plan', [SubscriptionController::class, 'changePlan']);

    // Pagamentos
    Route::post('/payment/create-preference', [PaymentController::class, 'createPreference']);
    Route::post('/payment/process', [PaymentController::class, 'processPayment']);

    // Rotas administrativas
    Route::middleware('check.admin')->group(function () {

        // Dashboard
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
        Route::get('/admin/users', [AdminController::class, 'users']);
        Route::get('/admin/subscriptions', [AdminController::class, 'subscriptions']);
        Route::get('/admin/contacts', [AdminController::class, 'contacts']);
        Route::get('/admin/reports', [AdminController::class, 'reports']);

        // Gestão de usuários
        Route::apiResource('users', UserController::class);

        // Gestão de planos
        Route::apiResource('plans', PlanController::class)->except(['index', 'show']);

        // Gestão de assinaturas
        Route::apiResource('subscriptions', SubscriptionController::class);
        Route::put('/subscriptions/{id}/cancel', [SubscriptionController::class, 'cancel']);

        // Gestão de FAQs
        Route::apiResource('faqs', FaqController::class)->except(['index']);

        // Gestão de depoimentos
        Route::apiResource('testimonials', TestimonialController::class)->except(['index']);

        // Gestão de contatos
        Route::apiResource('contacts', ContactController::class)->except(['store']);
        Route::post('/contacts/{id}/respond', [ContactController::class, 'respond']);
        Route::put('/contacts/{id}/status', [ContactController::class, 'updateStatus']);

        // Configurações do site
        Route::apiResource('site-settings', SiteSettingController::class);
        Route::post('/site-settings/bulk-update', [SiteSettingController::class, 'bulkUpdate']);

        // Gestão de Tipos de Contrato
        Route::apiResource('contrato-tipos', ContratoTipoController::class);

        // Gestão de Selos
        Route::apiResource('selos', SeloController::class);
    });

    // Histórico de Login
    Route::post('/login-history/update', [LoginHistoryController::class, 'updateLoginHistory']);
    Route::get('/login-history/all', [LoginHistoryController::class, 'getAllUsersLoginHistory'])->middleware('check.admin');
});

/**
 * Rotas de callback do Mercado Pago
 */
// Rota para sucesso no pagamento
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');

// Rota para falha no pagamento
Route::get('/payment/failure', [PaymentController::class, 'failure'])->name('payment.failure');

// Rota para pagamento pendente
Route::get('/payment/pending', [PaymentController::class, 'pending'])->name('payment.pending');



// Middleware para verificar se é admin
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/check-admin', function (Request $request) {
        return response()->json([
            'is_admin' => $request->user()->isAdmin()
        ]);
    });
});
