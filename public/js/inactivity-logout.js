document.addEventListener("DOMContentLoaded", function() {
    let timer;
    const timeoutDuration = 1 * 60 * 1000; // 5 minutes

    function startTimer() {
        timer = setTimeout(autoLogout, timeoutDuration);
        console.log("Timer started");
    }

    function resetTimer() {
        clearTimeout(timer);
        startTimer();
    }

    function autoLogout() {
        fetch('/app/logout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(data => {
            alert(data.message);
            window.location.href = '/app/login';
        })
        .catch(error => {
            console.error('Error during logout:', error);
        });
    }

    startTimer();
    console.log("Timer running");

    // No event listeners for mousemove or page refresh to reset the timer
});
