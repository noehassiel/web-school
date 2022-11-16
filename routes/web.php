<?php


Route::group(['prefix' => 'admin', 'middleware' => ['web', 'can:admin_access']], function(){
    //Dashboard
    Route::get('/', 'DashboardController@index')->name('dashboard');
    // Settings
    Route::get('/change-color', [
        'uses' => 'DashboardController@changeColor',
        'as' => 'change.color',
    ]);

    Route::get('/fix-nav', [
        'uses' => 'DashboardController@fixNav',
        'as' => 'change.nav',
    ]);



    Route::get('/mensajes-actualizaciones', [
        'uses' => 'DashboardController@messages',
        'as' => 'update.messages',
    ]);

    Route::resource('banners', 'BannerController');

    Route::post('/banners/status/{id}', [
        'uses' => 'BannerController@status',
        'as' => 'banners.status',
    ]);

    Route::resource('popups', PopupController::class);

    Route::post('/popups/status/{id}', [
        'uses' => 'PopupController@status',
        'as' => 'popups.status',
    ]);

     Route::resource('band', HeaderbandController::class);
       Route::post('/band/status/{id}', [
        'uses' => 'HeaderbandController@status',
        'as' => 'band.status',
    ]);

    //Configuration
    Route::get('/configuration', 'DashboardController@configuration')->name('configuration'); //

    Route::get('/bienvenido/paso-1',[
        'uses' => 'DashboardController@configStep1',
        'as' => 'config.step1',
    ]);

    Route::get('/bienvenido/paso-2/{id}',[
        'uses' => 'DashboardController@configStep2',
        'as' => 'config.step2',
    ]);

    //Catalog
    Route::resource('products', ProductController::class); //

    Route::get('products/create/digital', [
        'uses' => 'ProductController@createDigital',
        'as' => 'products.create.digital',
    ]);

    Route::get('products/create/subscription', [
        'uses' => 'ProductController@createSubscription',
        'as' => 'products.create.subscription',
    ]);

    Route::get('productsquery', [
        'uses' => 'ProductController@search',
        'as' => 'products.query',
    ]);
    Route::get('productsfilter/{filter}/{order}', [
        'uses' => 'ProductController@filter',
        'as' => 'filter.products',
    ]);
    Route::get('productspromotions', [
        'uses' => 'ProductController@promotions',
        'as' => 'products.promotions',
    ]);
    Route::get('exportar-productos', 'ProductController@export')->name('export.products');
    Route::post('importar-productos', 'ProductController@import')->name('import.products');
    Route::get('exportar-inventario', 'ProductController@export_inventory_changes')->name('inventory.clients');

    Route::post('/get-subcategories', [
        'uses' => 'ProductController@fetchSubcategory',
        'as' => 'dynamic.subcategory',
    ]);

    // Get Functions
    Route::get('/characteristic-inputs', function () {
        return view('wecommerce::back.products.includes._characteristic_inputs');
    })->name('subscription.inputs');

    Route::get('/characteristic-inputs-update', function () {
        return view('wecommerce::back.products.includes._characteristic_inputs_update');
    })->name('subscription.inputs.update');

    Route::post('products/new-characteristic', [
        'uses' => 'ProductController@storeCharacteristic',
        'as' => 'characteristic.store'
    ]);

    Route::put('products/update-characteristic/{id}', [
        'uses' => 'ProductController@updateCharacteristic',
        'as' => 'characteristic.update'
    ]);

    Route::delete('products/delete-characteristic/{id}', [
        'uses' => 'ProductController@destroyCharacteristic',
        'as' => 'characteristic.destroy'
    ]);

    Route::post('products/new-image', [
        'uses' => 'ProductController@storeImage',
        'as' => 'image.store',
    ]);

    Route::post('products/update-image', [
        'uses' => 'ProductController@updateImage',
        'as' => 'image.update',
    ]);

    Route::delete('products/delete-image/{id}', [
        'uses' => 'ProductController@destroyImage',
        'as' => 'image.destroy',
    ]);

    Route::post('/products/create-dynamic', [
        'uses' => 'ProductController@storeDynamic',
        'as' => 'products.store.dynamic',
    ]);

    Route::put('/products/update-stock/{id}', [
        'uses' => 'ProductController@stockUpdate',
        'as' => 'product.stock.update',
    ]);

    //Route::resource('product-relationships', ProductRelationshipController::class);

    Route::post('/obtener-color-de-producto', [
        'uses' => 'ProductRelationshipController@fetchColor',
        'as' => 'fetch.color',
    ]);

    Route::post('/product-relationships/{id}', [
        'uses' => 'ProductRelationshipController@store',
        'as' => 'relationship.store',
    ]);

    Route::delete('/product-relationships/{id}', [
        'uses' => 'ProductRelationshipController@destroy',
        'as' => 'relationship.destroy',
    ]);

    Route::resource('stocks', StockController::class); //
    Route::resource('variants', VariantController::class); //
    Route::resource('categories', CategoryController::class); //
    Route::resource('size_chart', SizeChartController::class);

    Route::post('size/add', [
        'uses' => 'SizeChartController@createsize',
        'as' => 'size.add',
    ]); //
    Route::post('size/update', [
        'uses' => 'SizeChartController@update_value',
        'as' => 'size_value.update',
    ]);

    Route::get('stocksquery', [
        'uses' => 'StockController@search',
        'as' => 'stocks.query',
    ]);

    Route::get('stocks/filter/{filter}/{order}', [
        'uses' => 'StockController@filter',
        'as' => 'filter.stock',
    ]);

    Route::post('/variants/stock/{id}', [
        'uses' => 'StockController@store',
        'as' => 'stock.store',
    ]);

    Route::post('/variants/stock-dynamic', [
        'uses' => 'StockController@storeDynamic',
        'as' => 'stock.store.dynamic',
    ]);

    Route::put('/variants/update-stock/{id}', [
        'uses' => 'StockController@update',
        'as' => 'stock.update',
    ]);

    Route::delete('/variants/delete-stock/{id}', [
        'uses' => 'StockController@destroy',
        'as' => 'stock.destroy',
    ]);

    Route::resource('clients', ClientController::class);
    Route::resource('invoices', UserInvoiceController::class);

    Route::get('filter/invoices/{invoice}/{filter}', [
        'uses' => 'UserInvoiceController@filter',
        'as' => 'filter.invoices',
    ]);

    Route::resource('user-rules', UserRuleController::class);

    Route::get('/user-rules/change-status/{id}',[
        'uses' => 'UserRuleController@changeStatus',
        'as' => 'user-rules.status',
    ]);

    Route::get('exportar-clientes', 'ClientController@export')->name('export.clients');
    Route::post('importar-clientes', 'ClientController@import')->name('import.clients');
    Route::get('filter/clients/{order}/{filter}', [
        'uses' => 'ClientController@filter',
        'as' => 'filter.clients',
    ]);
    Route::get('clientsquery', [
        'uses' => 'ClientController@query',
        'as' => 'clients.search',
    ]);

    Route::resource('newsletter', NewsletterController::class); //

    Route::resource('orders', OrderController::class); //

    Route::get('orders-subscriptions', [
        'uses' => 'OrderController@subscriptions',
        'as' => 'order.subscriptions.index',
    ]);

    Route::get('exportar-ordenes', 'OrderController@export')->name('export.orders');

    Route::get('/orders/{id}/packing-list', [
        'uses' => 'OrderController@packingList',
        'as' => 'order.packing.list',
    ]);

    Route::put('/orders/{id}/cambiar-estado', [
        'uses' => 'OrderController@changeStatus',
        'as' => 'order.status',
    ]);

    Route::get('/cambiar-estado-orden/{id}/{status_string}', [
        'uses' => 'OrderController@changeStatusStatic',
        'as' => 'order.status.static',
    ]);

    Route::resource('orders/notes', OrderNoteController::class); //

    Route::resource('/orders/tracking',  OrderTrackingController::class);

    Route::get('/orders/tracking/complete/{id}', [
        'uses' => 'OrderTrackingController@updateComplete',
        'as' => 'tracking.complete',
    ]);

    Route::get('filter/orders/{order}/{filter}', [
        'uses' => 'OrderController@filter',
        'as' => 'filter.orders',
    ]);
    Route::get('ordersquery', [
        'uses' => 'OrderController@query',
        'as' => 'orders.search',
    ]);

    Route::get('/orders/{id}/cancelar-suscripcion', [
        'uses' => 'OrderController@cancelSubscription',
        'as' => 'order.cancel.subscription',
    ]);

    Route::resource('promos', PromoController::class); //

    Route::post('/get-promo-products', [
        'uses' => 'PromoController@fetchProducts',
        'as' => 'dynamic.promo.filter',
    ]);

    Route::resource('coupons', CouponController::class); //
    Route::resource('reviews', ReviewController::class)->except(['store']); //

    Route::get('/reviews/aprobar/{id}',[
        'uses' => 'ReviewController@approve',
        'as' => 'review.approve',
    ]);

    /*Membresias*/
    Route::resource('membership', MembershipController::class);

    Route::put('/membership-status/{id}', [
        'uses' => 'MembershipController@statusUpdate',
        'as' => 'mem-status.update',
    ]);

    //Administration
    Route::resource('seo', SEOController::class); //
    Route::resource('legals', LegalTextController::class);
    Route::resource('faq', FAQController::class);
    Route::resource('taxes', StoreTaxController::class)->except(['create']); //

    Route::get('/taxes/create/{country_id}',[
        'uses' => 'StoreTaxController@create',
        'as' => 'taxes.create',
    ]);

    Route::resource('users', UserController::class); //
    Route::get('user/config', 'UserController@config')->name('user.config');  //
    Route::get('user/help', 'DashboardController@help')->name('user.help');  //

    Route::resource('template', MailThemeController::class); //
    Route::resource('mail', MailController::class)->except(['show, create, index']);
    Route::resource('notifications', NotificationController::class)->except(['show']); //

    Route::get('/notifications/all',[
        'uses' => 'NotificationController@all',
        'as' => 'notifications.all',
    ]);

    Route::get('/notifications/all/mark-as-read',[
        'uses' => 'NotificationController@markAsRead',
        'as' => 'notifications.mark.read',
    ]);

    Route::resource('payments', PaymentMethodController::class);
    Route::get('/payments/change-status/{id}',[
        'uses' => 'PaymentMethodController@changeStatus',
        'as' => 'payments.status',
    ]);
    Route::resource('shipments', ShipmentMethodController::class);
    Route::resource('shipments-rules', ShipmentMethodRuleController::class);
    Route::resource('shipping-options', ShipmentOptionsController::class);

    Route::get('/shipments-rule/change-status/{id}',[
        'uses' => 'ShipmentMethodRuleController@changeStatus',
        'as' => 'shipments-rules.status',
    ]);

    //Country
    //Route::resource('countries', CountryController::class);
    Route::resource('states', StateController::class);
    Route::resource('cities', CityController::class);
    Route::resource('config', StoreConfigController::class);

    Route::post('config-api-token',[
        'uses' => 'StoreConfigController@apiToken',
        'as' => 'api.token.store',
    ]);

    Route::resource('integrations', IntegrationController::class);
    Route::get('general-preferences',[
        'uses' => 'IntegrationController@index',
        'as' => 'general.config',
    ]);

    Route::resource('themes', StoreThemeController::class);
    Route::get('/themes/{id}/cambiar-estado', [
        'uses' => 'StoreThemeController@changeStatus',
        'as' => 'themes.status',
    ]);

    Route::post('store-logo',[
        'uses' => 'IntegrationController@storeLogo',
        'as' => 'store.logo',
    ]);

    // Sección Soporte
    Route::get('support', 'DashboardController@shipping')->name('support.help');

    /* Rutas de Correo */
    Route::post('/resend-order-mail/{order_id}', [
        'uses' => 'NotificationController@resendOrder',
        'as' => 'resend.order.mail',
    ]);

    Route::post('/resend-invoice-mail/{invoice_id}', [
        'uses' => 'NotificationController@resendInvoice',
        'as' => 'resend.invoice.mail',
    ]);

    // Búsqueda
    Route::get('/busqueda-general', [
        'uses' => 'DashboardController@generalSearch',
        'as' => 'back.search.query',
    ]);

});

Route::get('/', [
    'uses' => 'FrontController@index',
    'as' => 'index',
]);

Route::get('catalog', 'FrontController@catalogAll')->name('catalog.all');
Route::get('catalog_promo', 'FrontController@catalogPromo')->name('catalog.promo');
Route::post('catalog_order', 'FrontController@catalog_order')->name('catalog.orderby');

Route::get('/catalog/{category_slug}', [
    'uses' => 'FrontController@catalog',
    'as' => 'catalog',
]);

/* Newsletter */
Route::post('registro-newsletter', 'FrontController@newsletter')->name('newsletter_front.store');


/* Search Functions */
Route::get('/busqueda-general', [
    'uses' => 'SearchController@query',
    'as' => 'search.query',
]);


//Profile
Route::group(['prefix' => 'profile', 'middleware' => ['web', 'can:customer_access']], function(){
    Route::get('/', 'FrontController@profile')->name('profile');
    Route::get('wishlist', 'FrontController@wishlist')->name('wishlist');
    Route::get('orders', 'FrontController@shopping')->name('shopping');
    Route::get('points', 'FrontController@points')->name('points');

    Route::post('orders/{order_id}/request-invoice/{user_id}', [
        'uses' => 'FrontController@invoiceRequest',
        'as' => 'invoice.request',
    ]);

    Route::get('address', 'FrontController@address')->name('address');
    Route::get('address/{id}/edit', 'FrontController@editAddress')->name('address.edit');
    Route::get('account', 'FrontController@account')->name('account');

    Route::put('/account/{id}', [
        'uses' => 'FrontController@updateAccount',
        'as' => 'profile.update',
    ]);

    Route::put('/address/{id}', [
        'uses' => 'FrontController@updateAddress',
        'as' => 'address.update',
    ]);

    Route::post('/address-store', [
        'uses' => 'FrontController@storeAddress',
        'as' => 'address.store',
    ]);

    Route::delete('/address/{id}', [
        'uses' => 'FrontController@destroyAddress',
        'as' => 'address.destroy',
    ]);

    Route::get('/user/change-image',[
        'uses' => 'FrontController@editImage',
        'as' => 'profile.image',
    ]);

    Route::put('/user/change-image/{id}',[
        'uses' => 'FrontController@updateImage',
        'as' => 'profile.image.update',
    ]);
});

Route::get('legales/{type}', 'FrontController@legalText')->name('legal.text');
Route::get('preguntas_frecuentes', 'FrontController@faqs')->name('faqs.text');