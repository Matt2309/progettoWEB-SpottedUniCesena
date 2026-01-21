let spottedList = [];

Common.ready(() => {
    loadSpotted();
    Common.populateCategorySelect();
    Common.loadCategories();


    const desktopCategorySelect = document.getElementById('category');
    const mobileCategorySelect = document.getElementById('category-mobile');

    if (desktopCategorySelect) {
        desktopCategorySelect.addEventListener('change', (e) => {
            const selectedCategoryId = e.currentTarget.value;
            filterSpotted(selectedCategoryId);
            if (mobileCategorySelect) {
                mobileCategorySelect.value = selectedCategoryId;
            }
        });
    }

    if (mobileCategorySelect) {
        mobileCategorySelect.addEventListener('change', (e) => {
            const selectedCategoryId = e.currentTarget.value;
            filterSpotted(selectedCategoryId);
            if (desktopCategorySelect) {
                desktopCategorySelect.value = selectedCategoryId;
            }
        });
    }
});

async function renderList(listToRender) {
    const container = document.getElementById("spottedList");
    container.innerHTML = ""; // Clear current list

    // Render Cards
    if (!listToRender || listToRender.length === 0) {
        container.innerHTML = "<p class='text-muted text-center'>Nessun spotted trovato per questa categoria.</p>";
        return;
    }

    for (const post of listToRender) {
        const postData = { ...post };
        delete postData.status;
        container.appendChild(await Common.createSpottedCard(postData));
    }

    // Attach Listeners (Likes)
    for (let doc of document.getElementsByClassName('like')) {
        doc.addEventListener("click", async function (e) {
            await giveLike(e.currentTarget.getAttribute("spottedid"), e.currentTarget);
        });
    }

    // Attach Listeners (Dislikes)
    for (let doc of document.getElementsByClassName('dislike')) {
        doc.addEventListener("click", async function (e) {
            await giveDislike(e.currentTarget.getAttribute("spottedid"), e.currentTarget);
        });
    }
}

async function loadSpotted() {
    try {
        const response = await fetch("api/user/getSpottedAccept");
        const spotted = await response.json();

        // Store data globally
        spottedList = spotted.data;

        // Render the full list initially
        await renderList(spottedList);

    } catch (e) {
        console.log(e);
        document.getElementById("spottedList").innerHTML =
            "<p class='text-muted'>Errore nel caricamento</p>";
    }
}

async function filterSpotted(categoryId) {
    if (!spottedList) return;

    let newList = [];
    if (!categoryId || categoryId === "") {
        newList = spottedList; // Show all
    } else {
        newList = spottedList.filter((spotted) => {
            return spotted.category.id.toString() === categoryId;
        });
    }

    await renderList(newList);
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
        console.error("Error giving like:", e);
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
        console.getElementById("formError").textContent = "Errore server";
    }
}
