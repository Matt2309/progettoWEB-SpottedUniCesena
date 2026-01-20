document.addEventListener("DOMContentLoaded", () => {
    Common.loadCategories();
    populateCategorySelect();
    document
        .getElementById("spottedForm")
        .addEventListener("submit", validateAndSubmitSpotted);
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

async function validateAndSubmitSpotted(e) {
    e.preventDefault();

    const form = e.currentTarget;
    const submitButtons = form.querySelectorAll(".submit-btn");

    // reset errori
    form.querySelectorAll(".error").forEach(el => el.textContent = "");

    const fields = ["category_id", "text"];
    let formFields = {};
    let hasError = false;

    for (const name of fields) {
        const input = form.querySelector(`[name="${name}"]`);
        const value = input?.value?.trim();

        if (!value) {
            form.querySelector(`.${name === "category_id" ? "category" : "text"}-error`)
                .textContent = name === "category_id"
                ? "Categoria obbligatoria"
                : "Testo obbligatorio";
            hasError = true;
        } else {
            formFields[name] = value;
        }
    }

    if (hasError) return;

    submitButtons.forEach(btn => {
        btn.disabled = true;
        btn.innerHTML = `
            <span class="spinner-border spinner-border-sm me-1"></span>
            Invio...
        `;
    });

    try {
        const response = await fetch("/api/user/createSpotted", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(formFields)
        });

        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.message || "Errore server");
        }

        // success
        window.location.href = "index.php";
    } catch (err) {
        alert(err.message || "Errore server");

        submitButtons.forEach(btn => {
            btn.disabled = false;
            btn.textContent = "Posta";
        });
    }
}

