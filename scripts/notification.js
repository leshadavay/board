function showNotification(message) {
    var notification=document.createElement("div");
    notification.setAttribute("id","notification-bar");
    notification.innerHTML=message;
    notification.style.animation="pop-down 6s";

    notification.style.animationFillMode = "forwards";

    document.body.appendChild(notification);
}