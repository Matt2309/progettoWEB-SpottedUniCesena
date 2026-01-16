window.Common = (function () {
    function formatTime(dateInput) {
        const diff = (Date.now() - new Date(dateInput)) / 1000;

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

    function createCommentCard(comment) {
        const card = document.createElement("div");
        const timeAgo = formatTime(Date.parse(comment.created_at));

        card.className = "d-flex gap-2 mb-3";

        card.innerHTML = `
        <div class="rounded-circle bg-info text-white fw-bold d-flex justify-content-center align-items-center"
          style="width:35px;height:35px;">
          P
        </div>
        <div>
          <strong>pippo_franco</strong>
          <small class="text-muted ms-2">${timeAgo}</small>
          <p class="mb-0">
            ${comment.text}
          </p>
        </div>
    `;

        return card;
    }

    async function getCommentsSpotted(id) {
        const response = await fetch("api/user/getCommentSpotted?spottedId=" + id);
        const comments = await response.json();

        const container = document.createElement("div");

        if (!comments.data.length) {
            container.innerHTML = "<p class='text-muted text-center'>Nessun commento</p>";
            return container;
        }

        comments.data.forEach(comment => {
            container.appendChild(createCommentCard(comment));
        });

        return container;
    }

    async function createSpottedCard(post) {
        const card = document.createElement("div");
        card.className = "card rounded-4 shadow-sm mb-4";

        const offcanvasId = `commentsDrawer-${post.id}`;
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
                </span>

                <button class="bg-transparent border-0 text-muted d-flex align-items-center gap-1"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#${offcanvasId}">
                    <i class="bi bi-chat"></i>
                    <span>${post.commentsCount} commenti</span>
                </button>
            </div>
        </div>

        <div class="offcanvas offcanvas-bottom"
             tabindex="-1"
             id="${offcanvasId}"
             data-loaded="false">

            <div class="offcanvas-header justify-content-center">
                <h6 class="text-danger fw-bold m-0">Commenti</h6>
            </div>

            <div class="offcanvas-body text-center">
                <div class="spinner-border text-secondary" role="status"></div>
            </div>

            <div class="border-top p-3 bg-white">
                <div class="input-group">
                    <input type="text"
                           class="form-control rounded-pill bg-light border-0"
                           placeholder="Aggiungi un commento...">
                    <button class="btn btn-light rounded-pill ms-2">
                        <i class="bi bi-send"></i>
                    </button>
                </div>
            </div>
        </div>
    `;

        const offcanvas = card.querySelector(`#${offcanvasId}`);

        offcanvas.addEventListener("show.bs.offcanvas", async () => {
            if (offcanvas.dataset.loaded === "true") return;

            const body = offcanvas.querySelector(".offcanvas-body");
            body.innerHTML = "";

            try {
                const comments = await getCommentsSpotted(post.id);
                body.appendChild(comments);
                offcanvas.dataset.loaded = "true";
            } catch {
                body.innerHTML =
                    "<p class='text-danger text-center'>Errore nel caricamento</p>";
            }
        });

        return card;
    }

    return {
        formatTime,
        escapeHtml,
        createCommentCard,
        getCommentsSpotted,
        createSpottedCard
    };
})();
