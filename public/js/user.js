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

    } catch (e) {
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
    const button = document.createElement("div");
    button.className = "d-flex align-items-center gap-3";
    button.innerHTML = `
        <div class="rounded-circle bg-info text-white fw-bold d-flex justify-content-center align-items-center"
          style="width:50px;height:50px;">
          <p class="h4 m-0">${user.user_name.charAt(0).toUpperCase()}<p/>
        </div>
        <div>
          <h5 class="mb-0 hind-bold">${user.user_name} ${user.surname}</h5>
          ${
            parseInt(user.isAdmin)
                ? `<small class="text-muted">Admin</small>`
                : `<small class="text-muted">@${user.username}</small>`
          }
        </div>
    `;

    return button;
}