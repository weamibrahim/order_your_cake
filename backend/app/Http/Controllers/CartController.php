<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function addItem(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'userId' => 'required|exists:users,id',
            'productId' => 'required|exists:products,id',
            'quantity' => 'required|numeric|min:1',
        ]);
    
        // Check if the same product already exists in the cart for the user
        $existingCartItem = Cart::where('user_id', $validatedData['userId'])
            ->where('product_id', $validatedData['productId'])
            ->first();
    
        if ($existingCartItem) {
            // If the same product exists, increment the quantity
            $existingCartItem->quantity += $validatedData['quantity'];
            $existingCartItem->save();
        } else {
            // If the same product doesn't exist, create a new cart item
            $cartItem = new Cart([
                'user_id' => $validatedData['userId'],
                'product_id' => $validatedData['productId'],
                'quantity' => $validatedData['quantity'],
            ]);
    
            // Save the cart item to the database
            $cartItem->save();
        }
    
        // You can return a success response or any data you need
        return response()->json(['message' => 'Item added to cart successfully']);
    }
    

    public function getCartItems($userId)
{
    // Retrieve all cart items for the specified user
    $cartItems = Cart::where('user_id', $userId)->with('product')->get();
    
    return response()->json(['items' => $cartItems]);
}

public function removeCartItem($userId, $productId)
{
    // Find the cart item to remove
    $cartItem = Cart::where('user_id', $userId)->where('product_id', $productId)->first();

    if ($cartItem) {
        // Delete the cart item
        $cartItem->delete();

        return response()->json(['message' => 'Cart item removed successfully']);
    }

    return response()->json(['message' => 'Cart item not found'], 404);
}

public function incrementCartItem($userId, $productId)
{
    // Find the cart item to increment
    $cartItem = Cart::where('user_id', $userId)->where('product_id', $productId)->first();

    if ($cartItem) {
        // Increment the quantity
        $cartItem->increment('quantity');

        return response()->json(['message' => 'Cart item quantity incremented successfully']);
    }

    return response()->json(['message' => 'Cart item not found'], 404);
}


public function decrementCartItem($userId, $productId)
{
    // Find the cart item to decrement
    $cartItem = Cart::where('user_id', $userId)->where('product_id', $productId)->first();

    if ($cartItem) {
        // Decrement the quantity, but not below 1
        if ($cartItem->quantity > 1) {
            $cartItem->decrement('quantity');
        }

        return response()->json(['message' => 'Cart item quantity decremented successfully']);
    }

    return response()->json(['message' => 'Cart item not found'], 404);
}
}

