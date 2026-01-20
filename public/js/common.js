window.Common = (function () {
    const ICON_COLORS = [
        "blue", "indigo", "pink", "red", "orange",
    ];

    function getIconColor(index) {
        return ICON_COLORS[index % ICON_COLORS.length];
    }

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

    async function getCategories() {
        const response = await fetch("api/user/getCategories");
        const categories = await response.json();
        return categories.data.length ? categories.data : [];
    }

    function createCategoryCard(name, color) {
        const card = document.createElement("span");
        card.className = `badge bg-${color}-300 text-${color}-800`;
        card.innerHTML = `${name}`;
        return card;
    }

    function createCommentCard(comment) {
        const card = document.createElement("div");
        const timeAgo = formatTime(Date.parse(comment.created_at));
        const initial = comment.user.username.charAt(0).toUpperCase();

        card.className = "d-flex gap-2 mb-3";
        card.innerHTML = `
        <div class="rounded-circle bg-info text-white fw-bold d-flex justify-content-center align-items-center"
          style="width:35px;height:35px;">
          ${initial}
        </div>
        <div>
            <div class="d-flex align-items-center gap-2">
                <strong>@${comment.user.username}</strong>
                <small class="text-muted ms-2">${timeAgo}</small>
            </div>
          <p class="mb-0">${comment.text}</p>
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

        // FIXED: Only append cards here. Do NOT attach event listeners here.
        comments.data.forEach(comment => {
            container.appendChild(createCommentCard(comment));
        });

        return container;
    }

    async function validateAndSubmitComment(e) {
        e.preventDefault();

        const form = e.currentTarget;
        const submitButtons = form.querySelectorAll(".submit-comment-btn");

        // reset errors
        form.querySelectorAll(".error").forEach(el => el.textContent = "");

        const fields = ["spottedId", "text"];
        let formFields = {};
        let hasError = false;

        for (const name of fields) {
            const input = form.querySelector(`[name="${name}"]`);
            const value = input?.value?.trim();

            if (!value && name === "text") { // Only text is user-facing required
                // FIXED: Added '.' to select by class
                form.querySelector(`.text-error`).textContent = "Testo obbligatorio";
                hasError = true;
            } else {
                formFields[name] = value;
            }
        }

        if (hasError) return;

        submitButtons.forEach(btn => {
            btn.disabled = true;
            btn.innerHTML = `<span class="spinner-border spinner-border-sm me-1"></span> Invio...`;
        });

        try {
            const response = await fetch("/api/user/createComment", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(formFields)
            });

            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.message || "Errore server");
            }

            // Reload page on success
            window.location.href = "index.php";
        } catch (err) {
            alert(err.message || "Errore server");
            submitButtons.forEach(btn => {
                btn.disabled = false;
                btn.innerHTML = `<i class="bi bi-send"></i>`;
            });
        }
    }

    async function loadCategories() {
        try {
            const categories = await Common.getCategories();
            const container = document.getElementById("categories");
            container.innerHTML = "";
            for (let i = 0; i < categories.length; i++) {
                const color = getIconColor(i);
                container.appendChild(await Common.createCategoryCard(categories[i].name, color));
            }
        } catch (e) {
            console.log(e)
            document.getElementById("spottedList").innerHTML = "<p class='text-muted'>Errore nel caricamento</p>";
        }
    }

    async function createSpottedCard(post) {
        const card = document.createElement("div");
        card.className = "card rounded-4 shadow-sm mb-4";

        const offcanvasId = `commentsDrawer-${post.id}`;
        // FIXED: Unique form ID
        const formId = `commentForm-${post.id}`;

        const initial = post.user.username.charAt(0).toUpperCase();
        const timeAgo = formatTime(Date.parse(post.createdAt));
        const categoryColor = getIconColor(post.category.id - 1);

        card.innerHTML = `
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
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
                <div class="d-flex gap-3 align-items-center">
                    <div id="categoryPlaceholder"></div>
                    ${post.status != null ?
            `<span class="px-2 rounded fw-semibold ${getStatusClass(post.status)}">${post.status}</span>`
            : ''}
                </div>
            </div>

            <p class="mt-3">${escapeHtml(post.text)}</p>

            <div class="d-flex justify-content-between text-muted">
                <div class="d-flex gap-2">
                    <span role="button" class="like" spottedid=${post.id}>
                        <i class="bi bi-hand-thumbs-up mr-2 text-primary"></i>
                        <span class="like-count text-primary">${post.likes}</span>
                    </span>
                    <span role="button" class="dislike" spottedid=${post.id}>
                        <i class="bi bi-hand-thumbs-down mr-2"></i>
                    </span>
                </div>

                <button class="bg-transparent border-0 text-muted d-flex align-items-center gap-1"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#${offcanvasId}">
                    <i class="bi bi-chat"></i>
                    <span>${post.commentsCount} commenti</span>
                </button>
            </div>
        </div>

        <div class="offcanvas offcanvas-bottom" tabindex="-1" id="${offcanvasId}" data-loaded="false">
            <div class="offcanvas-header justify-content-center">
                <h6 class="text-danger fw-bold m-0">Commenti</h6>
            </div>

            <div class="offcanvas-body text-center">
                <div class="spinner-border text-secondary" role="status"></div>
            </div>

            <form id="${formId}">
                <div class="border-top p-3 bg-white">
                    <div class="input-group">
                        <input type="text" name="text"
                               class="form-control rounded-pill bg-light border-0"
                               placeholder="Aggiungi un commento...">
                        <input type="hidden" name="spottedId" value="${post.id}">
                        
                        <button class="submit-comment-btn btn btn-light rounded-pill ms-2">
                            <i class="bi bi-send"></i>
                        </button>
                    </div>
                    <p class="error text-danger mt-2 mb-0 text-error"></p>
                </div>
            </form>
        </div>
    `;

        const categoryPlaceholder = card.querySelector("#categoryPlaceholder");
        categoryPlaceholder.replaceWith(createCategoryCard(post.category.name, categoryColor));

        const offcanvas = card.querySelector(`#${offcanvasId}`);
        const form = card.querySelector(`#${formId}`);

        // FIXED: Attach listener immediately for this specific form
        form.addEventListener("submit", validateAndSubmitComment);

        offcanvas.addEventListener("show.bs.offcanvas", async () => {
            if (offcanvas.dataset.loaded === "true") return;

            const body = offcanvas.querySelector(".offcanvas-body");
            body.innerHTML = "";

            try {
                const comments = await getCommentsSpotted(post.id);
                body.appendChild(comments);
                offcanvas.dataset.loaded = "true";
            } catch {
                body.innerHTML = "<p class='text-danger text-center'>Errore nel caricamento</p>";
            }
        });

        return card;
    }

    function getStatusClass(status) {
        switch (status) {
            case "REJECTED": return "bg-danger bg-opacity-25 text-danger";
            case "PENDING": return "bg-warning bg-opacity-25 text-warning";
            case "APPROVED": return "bg-success bg-opacity-25 text-success";
            default: return "bg-secondary bg-opacity-25 text-secondary";
        }
    }

    return {
        formatTime,
        escapeHtml,
        createCommentCard,
        getCommentsSpotted,
        createSpottedCard,
        getCategories,
        createCategoryCard,
        loadCategories,
        getIconColor,
        getStatusClass,
        validateAndSubmitComment
    };
})();