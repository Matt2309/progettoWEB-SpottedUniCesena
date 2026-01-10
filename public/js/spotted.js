document.addEventListener("DOMContentLoaded", () => {
    loadSpotted();
});

async function loadSpotted() {
    try {
        const response = await fetch("api/user/getSpottedAccept");
        const spotted = await response.json();

        console.log("res: ", spotted)

        const container = document.getElementById("spottedList");
        container.innerHTML = "";

        spotted.data.forEach(post => {
            container.appendChild(createSpottedCard(post));
        });

    } catch (e) {
        console.log(e)
        document.getElementById("spottedList").innerHTML =
            "<p class='text-muted'>Errore nel caricamento</p>";
    }
}


function createSpottedCard(post) {
    const card = document.createElement("div");
    card.className = "card rounded-4 shadow-sm mb-4";

    const initial = post.user.username.charAt(0).toUpperCase();
    const timeAgo = formatTime(Date.parse(post.createdAt));

    card.innerHTML = `
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle bg-primary text-white fw-bold d-flex justify-content-center align-items-center"
                         style="width:35px;height:35px;">
                        ${initial}
                    </div>
                    <div>
                        <strong>@${post.user.username}</strong><br>
                        <small class="text-muted">${timeAgo}</small>
                    </div>
                </div>

                <span class="badge bg-light text-dark rounded-pill">
                    ${post.category.name}
                </span>
            </div>

            <p class="mt-3">${escapeHtml(post.text)}</p>

            <div class="d-flex justify-content-between text-muted">
                <span>
                    <i class="bi bi-hand-thumbs-up"></i> ${post.likes}
                    <i class="bi bi-hand-thumbs-down ms-2"></i>
                </span>

                <a href="Commenti.php?id=${post.id}" class="text-muted text-decoration-none">
                    <i class="bi bi-chat ms-3"></i> 2 commenti
                </a>
            </div>
        </div>
    `;

    return card;
}

function formatTime(dateString) {
    const diff = (Date.now() - new Date(dateString)) / 1000;

    if (diff < 60) return "ora";
    if (diff < 3600) return `${Math.floor(diff / 60)} min fa`;
    if (diff < 86400) return `${Math.floor(diff / 3600)} ore fa`;
    return `${Math.floor(diff / 86400)} giorni fa`;
}
function escapeHtml(text) {
    const div = document.createElement("div");
    div.textContent = text;
    return div.innerHTML;
}


