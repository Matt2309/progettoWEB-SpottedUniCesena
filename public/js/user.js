document.addEventListener("DOMContentLoaded", () => {
    getUserInfo();
});

async function getUserInfo() {
    try {
        const response = await fetch("api/user/getUserInfo");
        const userinfo = await response.json();
        const area = document.getElementById("user-area");
        if (!response.ok) {
            if (userinfo.errors) {
                area.innerHTML = "";
                area.appendChild(loginButton());
            } else {
                area.innerHTML = "";
                area.appendChild(userInfo(null));
            }
        }

    } catch (e) {
        console.log(e)
        document.getElementById("spottedList").innerHTML =
            "<p class='text-muted'>Errore nel caricamento</p>";
    }
}

function loginButton() {
    const button = document.createElement("a");
    button.className = "btn btn-primary w-100 mt-3";

    button.innerHTML = `
        <i class="bi bi-box-arrow-in-right me-1" aria-hidden="true"></i>
                    Login
    `;

    return button;
}

function userInfo(info) {
    const button = document.createElement("div");
    button.className = "d-flex align-items-center gap-3";

    button.innerHTML = `
        <div class="rounded-circle bg-info text-white fw-bold d-flex justify-content-center align-items-center"
          style="width:50px;height:50px;">
          <p class="h4 m-0">P<p/>
        </div>
        <div>
          <h5 class="mb-0 hind-bold">Pippo Franco</h5>
          <small class="text-muted">@pippo_franco</small>
        </div>
    `;

    return button;
}