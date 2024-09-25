const HOST = window.location.host;

function showSuccessNotification(message, redirectUrl) {
    showNotification(message, 'success', redirectUrl);
}

function showErrorNotification(message, redirectUrl) {
    showNotification(message, 'error', redirectUrl);
}

function showNotification(message, type, redirectUrl) {
    const notificationContainer = document.getElementById('notifications');

    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.innerText = message;

    notificationContainer.appendChild(notification);

    setTimeout(() => {
        notification.remove();
        if (redirectUrl) {
            window.location.href = redirectUrl; 
        }
    }, 3000);
}