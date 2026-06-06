// ================================
// POS CART SYSTEM (CLEAN VERSION)
// ================================

// Injected from Blade
const userId = window.USER_ID;
const branchId = window.BRANCH_ID;

// Unique cart per user + branch
const cartKey = `cart_${userId}_${branchId}`;

// ================================
// GET CART
// ================================
function getCart() {
    return JSON.parse(localStorage.getItem(cartKey)) || [];
}

// ================================
// SAVE CART
// ================================
function saveCart(cart) {
    localStorage.setItem(cartKey, JSON.stringify(cart));
}

// ================================
// ADD TO CART
// ================================
function addToCart(product) {
    let cart = getCart();

    let existing = cart.find(item => item.id === product.id);

    if (existing) {
        existing.qty += 1;
    } else {
        cart.push({
            id: product.id,
            name: product.name,
            price: product.price,
            qty: 1
        });
    }

    saveCart(cart);
    renderCart();
}

// ================================
// REMOVE ITEM
// ================================
function removeFromCart(productId) {
    let cart = getCart();

    cart = cart.filter(item => item.id !== productId);

    saveCart(cart);
    renderCart();
}

// ================================
// UPDATE QTY
// ================================
function updateQty(productId, qty) {
    let cart = getCart();

    let item = cart.find(i => i.id === productId);

    if (item) {
        item.qty = qty;

        if (item.qty <= 0) {
            cart = cart.filter(i => i.id !== productId);
        }
    }

    saveCart(cart);
    renderCart();
}

// ================================
// CLEAR CART (IMPORTANT)
// ================================
function clearCart() {
    localStorage.removeItem(cartKey);
    renderCart();
}

// ================================
// CALCULATE TOTAL
// ================================
function getTotal() {
    let cart = getCart();

    return cart.reduce((sum, item) => {
        return sum + (item.price * item.qty);
    }, 0);
}

// ================================
// RENDER CART (UI HOOK)
// ================================
function renderCart() {
    let cart = getCart();

    let container = document.getElementById("cartItems");
    let totalEl = document.getElementById("cartTotal");

    if (!container) return;

    container.innerHTML = "";

    cart.forEach(item => {
        container.innerHTML += `
            <div class="cart-item">
                <span>${item.name}</span>
                <span>${item.qty}</span>
                <span>RM ${(item.price * item.qty).toFixed(2)}</span>

                <button onclick="removeFromCart(${item.id})">X</button>
            </div>
        `;
    });

    if (totalEl) {
        totalEl.innerText = "RM " + getTotal().toFixed(2);
    }
}

// ================================
// INIT CART ON PAGE LOAD
// ================================
document.addEventListener("DOMContentLoaded", function () {
    renderCart();
});

// 👇 ADD THIS BELOW
window.addEventListener("beforeunload", function () {
    // optional: save last state / analytics
});
