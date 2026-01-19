document.addEventListener("DOMContentLoaded", () => {
    loadSpotted();
    Common.loadCategories();
});

async function loadSpotted() {
    try {
        const response = await fetch("api/user/getSpottedAccept");
        const spotted = await response.json();

        const container = document.getElementById("spottedList");
        container.innerHTML = "";

        for (const post of spotted.data) {
            container.appendChild(await Common.createSpottedCard(post));
        }

        for(let doc of document.getElementsByClassName('like')) {
            doc.addEventListener("click", async function (e) {
                await giveLike(e.currentTarget.getAttribute("spottedid"), e.currentTarget);
            })
        }
        for(let doc of document.getElementsByClassName('dislike')) {
            doc.addEventListener("click", async function (e) {
                await giveDislike(e.currentTarget.getAttribute("spottedid"), e.currentTarget);
            })
        }

    } catch (e) {
        console.log(e)
        document.getElementById("spottedList").innerHTML =
            "<p class='text-muted'>Errore nel caricamento</p>";
    }
}

async function giveLike(spottedId, target) {
    try {
        const response = await fetch("/api/user/likeSpotted", {
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
            target.firstElementChild.classList.remove("bi-hand-thumbs-up");
            target.firstElementChild.classList.add("bi-hand-thumbs-up-fill");
            const countEl = target.querySelector(".like-count");
            const current = Number(countEl.textContent);
            countEl.textContent = current + 1;
        }
        return;
    } catch (e) {
        document.getElementById("formError").textContent = "Errore server";
    }
}

async function giveDislike(spottedId, target) {
    try {
        const response = await fetch("/api/user/dislikeSpotted", {
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
            target.firstElementChild.classList.remove("bi-hand-thumbs-down");
            target.firstElementChild.classList.add("bi-hand-thumbs-down-fill");
        }
        return;
    } catch (e) {
        document.getElementById("formError").textContent = "Errore server";
    }
}