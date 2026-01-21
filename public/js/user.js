document.addEventListener("DOMContentLoaded", () => {
    getUserInfo();
});

async function getUserInfo() {
    try {
        const response = await fetch("api/user/getUserInfo");
        const userinfo = await response.json();
        let containers = document.querySelectorAll('.user-area');
        for (const container of containers) {
            if (response.ok) {
                container.innerHTML = "";
                container.appendChild(userInfo(userinfo.data));
            } else {
                container.innerHTML = "";
                container.appendChild(loginButton());
            }
        }
        if (!parseInt(userinfo.data.isAdmin) || !userinfo.data) {
            for (doc of document.getElementsByClassName('admin-area')) {
                doc.classList.add("d-none")
            }
        } else {
            for (doc of document.getElementsByClassName('admin-area')) {
                doc.classList.remove("d-none")
            }
        }

    } catch (e) {
        for (doc of document.getElementsByClassName('admin-area')) {
            doc.classList.add("d-none")
        }
        console.log(e)
    }
}

function loginButton() {
    const button = document.createElement("a");
    button.className = "btn btn-primary w-100 mt-3";
    button.href="Login.html"
    button.innerHTML = `
        <i class="bi bi-box-arrow-in-right me-1" aria-hidden="true"></i>
                    Login
    `;

    return button;
}

function userInfo(user) {
    const container = document.createElement("div");
    container.className = "d-flex flex-column gap-3";

    container.innerHTML = `
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-info text-white fw-bold d-flex justify-content-center align-items-center"
              style="width:50px;height:50px;">
              <p class="h4 m-0">${user.user_name.charAt(0).toUpperCase()}</p>
            </div>
            <div>
              <h5 class="mb-0 hind-bold">${user.user_name} ${user.surname}</h5>
              ${
        parseInt(user.isAdmin)
            ? `<small class="text-muted">Admin</small>`
            : `<small class="text-muted">@${user.username}</small>`
    }
            </div>
        </div>

        <a href="../api/auth/logout.php" class="btn btn-outline-danger w-100 btn-sm">
            <i class="bi bi-box-arrow-right me-1" aria-hidden="true"></i>
            Logout
        </a>
    `;

    return container;
}