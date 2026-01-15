document.addEventListener("DOMContentLoaded", () => {
    loadUserSpotted();
});

async function loadUserSpotted() {
    try {
        const response = await fetch("api/user/getUserSpotted");
        const spotted = await response.json();


        const containers = document.getElementsByClassName("userList");
        for (const container of containers) {
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
