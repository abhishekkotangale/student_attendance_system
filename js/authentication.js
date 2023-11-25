function studentLoginForm(event) {
    event.preventDefault();

    var form = document.getElementById('studentLoginForm');
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = xhr.responseText;
            if (response === "success") {
                Toastify({
                    text: 'Login successful.',
                    duration: 3000,
                    close: true,
                    gravity: 'top',
                    position: 'right',
                    backgroundColor: '#4CAF50',
                    stopOnFocus: true
                }).showToast();
                window.location.href = "pages/home.php";
            } else {
                Toastify({
                    text: response,
                    duration: 3000,
                    close: true,
                    gravity: 'top',
                    position: 'right',
                    backgroundColor: '#ff6347',
                    stopOnFocus: true
                }).showToast();
            }
        }
    };
    xhr.open('POST', 'authentication/studentLogin.php', true);
    xhr.send(formData);
}


function login(event) {
    event.preventDefault();

    var form = document.getElementById('loginForm');
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = xhr.responseText;
            if (response === "success") {
                window.location.href = "pages/home.php";
            } else {
                alert(response);
            }
        }
    };
    xhr.open('POST', 'authentication/login.php', true);
    xhr.send(formData);
}