/**
 * Notification Manager Module
 * Handles real-time notifications via Laravel Echo
 */

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

export default class NotificationManager {
    constructor(config) {
        this.echo = new Echo({
            broadcaster: 'pusher',
            key: config.key,
            cluster: config.cluster,
            forceTLS: true
        });
        
        this.userId = config.userId;
        this.init();
    }

    init() {
        if (!this.userId) return;

        console.log(`Listening for notifications on user.${this.userId}`);
        
        this.echo.private(`user.${this.userId}`)
            .listen('OrderUpdated', (e) => {
                this.showNotification(e.message, 'success');
                this.updateUI(e);
            });
    }

    showNotification(message, type = 'info') {
        // Here we can use a library like SweetAlert2 or Toastr
        // For now, let's use a standard alert or custom UI
        alert(message); 
    }

    updateUI(data) {
        // Logic to update order status badges in real-time if on the page
        const statusBadge = document.querySelector(`#order-status-${data.id}`);
        if (statusBadge) {
            statusBadge.innerText = data.status_label;
            // Optionally change badge color classes
        }
    }
}
