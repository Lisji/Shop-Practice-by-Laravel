<?php

namespace App\Observers;

use App\Models\product;
use App\Notifications\ProductReplenish;

class ProductObserver
{
    /**
     * Handle the product "created" event.
     *
     * @param  \App\Models\product  $product
     * @return void
     */
    public function created(product $product)
    {
        //
    }

    /**
     * Handle the product "updated" event.
     *
     * @param  \App\Models\product  $product
     * @return void
     */
    public function updated(product $product)
    {
        $changes = $product->getChanges();
        $originals = $product->getOriginal();
        if (isset($changes['quantity']) && $product -> quantity > 0 && $originals['quantity'] == 0) {
            foreach ($product->favorite_users as $user) {
                $user -> notify(new ProductReplenish($product));
            }
        }
    }

    /**
     * Handle the product "deleted" event.
     *
     * @param  \App\Models\product  $product
     * @return void
     */
    public function deleted(product $product)
    {
        //
    }

    /**
     * Handle the product "restored" event.
     *
     * @param  \App\Models\product  $product
     * @return void
     */
    public function restored(product $product)
    {
        //
    }

    /**
     * Handle the product "force deleted" event.
     *
     * @param  \App\Models\product  $product
     * @return void
     */
    public function forceDeleted(product $product)
    {
        //
    }
}
