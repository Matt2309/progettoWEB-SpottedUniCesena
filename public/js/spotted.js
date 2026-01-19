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

    } catch (e) {
        console.log(e)
        document.getElementById("spottedList").innerHTML =
            "<p class='text-muted'>Errore nel caricamento</p>";
    }
}