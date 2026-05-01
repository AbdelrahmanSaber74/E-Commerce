export class CartManager {
    static init() {
        console.log('Cart Manager Initialized');
        // Add event listeners for cart actions here
    }

    static updateBadge(count) {
        const badge = document.querySelector('.cart-badge');
        if (badge) badge.innerText = count;
    }
}
