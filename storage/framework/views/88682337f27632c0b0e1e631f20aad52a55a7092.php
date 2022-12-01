<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(\Osiset\ShopifyApp\getShopifyConfig('app_name')); ?></title>
        <?php echo $__env->yieldContent('styles'); ?>
    </head>

    <body>
        <div class="app-wrapper">
            <div class="app-content">
                <main role="main">
                    <?php echo $__env->yieldContent('content'); ?>
                </main>
            </div>
        </div>

        <?php if(\Osiset\ShopifyApp\getShopifyConfig('appbridge_enabled')): ?>
            <script src="https://unpkg.com/@shopify/app-bridge<?php echo e(\Osiset\ShopifyApp\getShopifyConfig('appbridge_version') ? '@'.config('shopify-app.appbridge_version') : ''); ?>"></script>
            <script>
                var AppBridge = window['app-bridge'];
                var createApp = AppBridge.default;
                var app = createApp({
                    apiKey: '<?php echo e(\Osiset\ShopifyApp\getShopifyConfig('api_key', Auth::user()->name )); ?>',
                    shopOrigin: '<?php echo e(Auth::user()->name); ?>',
                    forceRedirect: true,
                });
            </script>

            <?php echo $__env->make('shopify-app::partials.flash_messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <?php echo $__env->yieldContent('scripts'); ?>
    </body>
</html>
<?php /**PATH /home/chhabicl/shopify.vijayamule.in/vendor/osiset/laravel-shopify/src/ShopifyApp/resources/views/layouts/default.blade.php ENDPATH**/ ?>