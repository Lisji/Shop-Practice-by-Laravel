<?php

namespace Tests\Feature;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;

class CartItemControllerTest extends TestCase
{
    use RefreshDatabase;
    //確保獨立性，保持資料庫乾淨

    private $fakeUser;

    public function setup(): void
    {
        parent::setUp();
        $this -> fakeUser = User::create(['name' => 'Jim',
                                        'email' => 'shiliang@gmail.com',
                                        'password' => 13579]);
        Passport::actingAs($this-> fakeUser);
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testStore()
    {
        $cart = $this -> fakeUser -> carts() -> create();
        $product = Product::create([
                                    'title' => 'test',
                                    'content' => 'try',
                                    'price' => 30,
                                    'quantity' => 10
                                    ]);
        //ˇˇˇ結構 ˇˇˇ method, route, data
        $response = $this->call(
            'POST',
            'cart-items',
            ['cart_id' => $cart -> id,'product_id' => $product->id, 'quantity' => 3]
        );
        $response -> assertOk();

    }


    public function testUpdate()
    {
        $cart = $this -> fakeUser -> carts() -> create();
        $product = Product::create([
                                    'title' => 'test',
                                    'content' => 'try',
                                    'price' => 30,
                                    'quantity' => 10
                                    ]);
        $cartItem = $cart -> cartItems()-> create(['product_id' => $product -> id, 'quantity' => 3]);
        //ˇˇˇ結構 ˇˇˇ method, route, data
        $response = $this->call(
            'PUT',
            'cart-items/'.$cartItem->id,
            ['quantity' => 9]
        );
        $this->assertEquals('true', $response-> getContent());

        $cartItem->refresh();

        $this ->assertEquals($cartItem -> quantity, '9');
    }

    public function testDestroy(){
        $cart = $this -> fakeUser -> carts() -> create();
        $product = Product::create([
                                    'title' => 'test',
                                    'content' => 'try',
                                    'price' => 30,
                                    'quantity' => 10
                                    ]);
        $cartItem = $cart -> cartItems()-> create(['product_id' => $product -> id, 'quantity' => 3]);

        $response = $this->call(
            'DELETE',
            'cart-items/'.$cartItem->id,
        );
        $response -> assertOk();

        $cartItem = CartItem::find($cartItem->id);
        $this -> assertNull($cartItem);
    }
}