document.addEventListener("DOMContentLoaded", () => {
    Common.loadCategories();
    populateCategorySelect();
});

async function populateCategorySelect() {
    try {
        const categories = await Common.getCategories();
        console.log("cat: ", categories)
        let selectors = document.querySelectorAll('.category-select');
        for (const select of selectors) {
            select.innerHTML = '';
            for(let category of categories)
            {
                console.log("c: ", category)
                let opt = document.createElement("option");
                opt.value = category.id;
                opt.innerHTML = category.name;

                select.appendChild(opt);
            }
        }

    } catch (e) {
        console.log(e)
        document.getElementById("spottedList").innerHTML =
            "<p class='text-muted'>Errore nel caricamento</p>";
    }
}