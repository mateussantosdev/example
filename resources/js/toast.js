export function toast(message, type, duration = 4000) {
    const toastContainer = document.getElementById('toast-container');
    const toast = document.createElement('div');

    let bgColor = 'bg-green-500';
    let icon = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
        <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
        <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
    </svg>`;
    if (type === 'error') {
        bgColor = 'bg-red-500';
        icon = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
        </svg>`;
    }

    toast.className = `flex items-center ${bgColor} text-white text-sm font-bold px-6 py-4 rounded shadow-md mb-4 relative overflow-hidden w-full max-w-sm pointer-events-auto`;
    toast.innerHTML = `
        <div class="mr-3">
            ${icon} 
        </div>
        <div class="flex-1">
            ${message}
        </div>
        <button class="text-white absolute bottom-8 right-1 focus:outline-none toast-close-btn text-xl">&times;</button>
    `;

    toastContainer.appendChild(toast);

    const toastCloseBtn = toast.querySelector('.toast-close-btn');
    toastCloseBtn.addEventListener('click', function () {
        toast.classList.add('opacity-0');
        setTimeout(() => {
            toast.remove();
        }, 500);
    });

    setTimeout(() => {
        toast.classList.add('opacity-0');
        setTimeout(() => {
            toast.remove();
        }, 500);
    }, duration);
}
