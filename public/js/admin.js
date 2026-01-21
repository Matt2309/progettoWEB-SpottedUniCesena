document.addEventListener("DOMContentLoaded", () => {
    loadSpottedAccept();
});

async function loadSpottedAccept() {
    try {
        const response = await fetch("api/user/getAllSpotted");
        const spotted = await response.json();

        const container = document.getElementById("spottedList");
        container.innerHTML = "";

        for (const post of spotted.data) {
            container.appendChild(await createAcceptCard(post));
        }

        for(let doc of document.getElementsByClassName('accept')) {
            doc.addEventListener("click", async function (e) {
                await acceptSpotted(e.currentTarget.getAttribute("spottedid"), e.currentTarget);
            })
        }
        for(let doc of document.getElementsByClassName('reject')) {
            doc.addEventListener("click", async function (e) {
                await rejectSpotted(e.currentTarget.getAttribute("spottedid"), e.currentTarget);
            })
        }
        for(let doc of document.getElementsByClassName('ban')) {
            doc.addEventListener("click", async function (e) {
                await banUser(e.currentTarget.getAttribute("user"), e.currentTarget);
            })
        }

        for(let doc of document.getElementsByClassName('unban')) {
            doc.addEventListener("click", async function (e) {
                await unbanUser(e.currentTarget.getAttribute("user"), e.currentTarget);
            })
        }

    } catch (e) {
        console.log(e)
        document.getElementById("spottedList").innerHTML =
            "<p class='text-muted'>Errore nel caricamento</p>";
    }
}


async function acceptSpotted(spottedId) {
    try {
        const response = await fetch("/api/user/spottedOk", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({spottedId: spottedId})
        });

        const data = await response.json();
        if (!response.ok) {
            console.log(data.errors)
        } else {
            window.location.reload();
        }
    } catch (e) {
        document.getElementById("formError").textContent = "Errore server";
    }
}

async function rejectSpotted(spottedId) {
    try {
        const response = await fetch("/api/user/spottedReject", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({spottedId: spottedId})
        });

        const data = await response.json();
        if (!response.ok) {
            console.log(data.errors)
        } else {
            window.location.reload();
        }
    } catch (e) {
        document.getElementById("formError").textContent = "Errore server";
    }
}
async function banUser(userId) {
    try {
        const response = await fetch("/api/user/userBan", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({userId: userId})
        });

        const data = await response.json();
        if (!response.ok) {
            console.log(data.errors)
        } else {
            window.location.reload();
        }
    } catch (e) {
        document.getElementById("formError").textContent = "Errore server";
    }
}

async function unbanUser(userId) {
    try {
        const response = await fetch("/api/user/userSban", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({userId: userId})
        });

        const data = await response.json();
        if (!response.ok) {
            console.log(data.errors)
        } else {
            window.location.reload();
        }
    } catch (e) {
        document.getElementById("formError").textContent = "Errore server";
    }
}


async function createAcceptCard(post) {
    const card = document.createElement("div");
    card.className = "card rounded-4 shadow-sm mb-4";
    const isBanned = !!parseInt(post.user.isBanned);

    // 2. Set Opacity if banned
    if (isBanned) {
        card.style.opacity = "0.5";
    }

    const initial = post.user.username.charAt(0).toUpperCase();
    const timeAgo = Common.formatTime(Date.parse(post.createdAt));
    const categoryColor = Common.getIconColor(post.category.id - 1);

    // 3. Prepare variables for the template
    const disabledAttr = isBanned ? 'disabled' : '';
    const banText = isBanned ? 'Rimuovi ban' : 'Banna utente';

    const banClass = isBanned ? 'unban text-green-300' : 'ban text-danger';
    const banIcon = isBanned ? 'bi-person-check' : 'bi-slash-circle';

    card.innerHTML = `
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            
            <div class="d-flex align-items-center gap-2">
                <div class="rounded-circle bg-primary text-white fw-bold d-flex justify-content-center align-items-center"
                     style="width:35px;height:35px; min-width:35px;">
                    ${initial}
                </div>
                <div class="lh-1">
                    <strong>@${post.user.username}</strong><br>
                    <small class="text-muted">${timeAgo}</small>
                </div>
            </div>

            <div class="d-flex gap-2 align-items-center justify-content-end text-end">
                <div id="categoryPlaceholder"></div>
                ${post.status != null ?
        `<span class="px-2 rounded fw-semibold ${Common.getStatusClass(post.status)}">
                                ${post.status}
                            </span>`
        : ''
    }
            </div>
        </div>

        <p class="mt-3">${Common.escapeHtml(post.text)}</p>

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
            
            <div class="d-flex w-100 w-md-auto">
                <button class="btn btn-success btn-sm fw-semibold accept flex-fill flex-md-grow-0" spottedid="${post.id}" ${disabledAttr}>
                    <i class="bi bi-check-lg"></i> Accetta
                </button>
                <button class="btn btn-danger btn-sm fw-semibold ms-2 reject flex-fill flex-md-grow-0" spottedid="${post.id}" ${disabledAttr}>
                    <i class="bi bi-x-lg"></i> Rifiuta
                </button>
            </div>

            <button class="${banClass} fw-semibold text-decoration-none bg-transparent border-0 w-100 w-md-auto text-start text-md-end" user="${post.user.id}">
                <i class="bi ${banIcon}"></i> ${banText}
            </button>
        </div>
    </div>
`;

    const categoryPlaceholder = card.querySelector("#categoryPlaceholder");
    categoryPlaceholder.replaceWith(Common.createCategoryCard(post.category.name, categoryColor));

    return card;
}