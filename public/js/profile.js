document.addEventListener("DOMContentLoaded", () => {
    loadUserSpotted();
});

document.getElementById('spotted').addEventListener("click", function (e) {
    setActiveTab(e.currentTarget);
    loadUserSpotted();
})
document.getElementById('comments').addEventListener("click", function (e) {
    setActiveTab(e.currentTarget);
    loadUserComments();
})
document.getElementById('likes').addEventListener("click", function (e) {
    setActiveTab(e.currentTarget);
    loadUserLikes();
})

function setActiveTab(clicked) {
    const tabs = document.querySelectorAll('.nav-tabs .nav-link');
    tabs.forEach(tab => {
        tab.classList.remove('active', 'text-primary', 'fw-semibold');
        if (!tab.classList.contains('text-muted')) tab.classList.add('text-muted');
    });

    clicked.classList.remove('text-muted');
    clicked.classList.add('active', 'text-primary', 'fw-semibold');
}

async function loadUserSpotted() {
    try {
        const response = await fetch("api/user/getUserSpotted");
        const spotted = await response.json();


        let containers = document.querySelectorAll('.userList');
        for (const container of containers) {
            container.innerHTML = '';
            for (const post of spotted.data) {
                container.appendChild(await Common.createSpottedCard(post));
            }
        }

    } catch (e) {
        console.log(e)
        document.getElementById("userList").innerHTML =
            "<p class='text-muted'>Errore nel caricamento</p>";
    }
}

async function loadUserComments() {
    try {
        const response = await fetch("api/user/getCommentUser");
        const comments = await response.json();

        let containers = document.querySelectorAll('.userList');
        for (const container of containers) {
            container.innerHTML = '';
            for (const comment of comments.data) {
                container.appendChild(
                    commentWrapper(await Common.createCommentCard(comment))
                );
            }
        }

    } catch (e) {
        console.log(e)
        document.getElementById("userList").innerHTML =
            "<p class='text-muted'>Errore nel caricamento</p>";
    }
}

function commentWrapper(child) {
    const card = document.createElement("div");
    card.className = "card rounded-4 shadow-sm";

    const cardbody = document.createElement("div");
    cardbody.className = "card-body";

    const row = document.createElement("div");
    row.className = "d-flex justify-content-between";

    const inner = document.createElement("div");
    inner.className = "d-flex align-items-center gap-2";

    inner.appendChild(child);
    row.appendChild(inner);
    cardbody.appendChild(row);
    card.appendChild(cardbody);

    return card;
}

async function loadUserLikes() {
    try {
        const response = await fetch("api/user/getLikedSpotted");
        const likes = await response.json();
        let containers = document.querySelectorAll('.userList');
        for (const container of containers) {
            container.innerHTML = '';
            for (const like of likes.data) {
                container.appendChild(await Common.createSpottedCard(like));
            }
        }

    } catch (e) {
        console.log(e)
        document.getElementById("userList").innerHTML =
            "<p class='text-muted'>Errore nel caricamento</p>";
    }
}