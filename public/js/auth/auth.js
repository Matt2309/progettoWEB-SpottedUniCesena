async function validateAndSubmitLogin(e) {
    e.preventDefault();
    // reset errori
    document.querySelectorAll(".error").forEach(el => el.textContent = "");

    const username = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value.trim();

    let hasError = false;

    // VALIDAZIONE CLIENT
    if (!username) {
        document.getElementById("usernameError").textContent = "Email obbligatoria";
        hasError = true;
    }

    if (!password) {
        document.getElementById("passwordError").textContent = "Password obbligatoria";
        hasError = true;
    }

    if (hasError) return;

    try {
        const response = await fetch("/api/auth/login.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ username, password })
        });

        const data = await response.json();

        if (!response.ok) {
            if (data.errors) {
                Object.keys(data.errors).forEach(key => {
                    const el = document.getElementById(key + "Error");
                    if (el) el.textContent = data.errors[key];
                });
            } else {
                document.getElementById("formError").textContent = data.message;
            }
            return;
        }

        window.location.href = "index.php";
    } catch (err) {
        document.getElementById("formError").textContent = "Errore server";
    }
}