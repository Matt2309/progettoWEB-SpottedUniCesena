document.addEventListener('DOMContentLoaded', () => {
    console.log("App started...");
    testConnection();
});

async function testConnection() {
    try {
        const response = await fetch('/api/user', {
            method: 'GET',
        });

        console.log("Raw response object:", response);

        if (!response.ok) {
            throw new Error("HTTP error " + response.status);
        }

        const data = await response.json();
        console.log("Parsed JSON:", data);

        document.getElementById('app-content').innerHTML = `
            <div class="alert alert-success">
                Backend says: ${data.message}
            </div>
        `;

    } catch (error) {
        console.error("Error:", error);
        document.getElementById('app-content').innerHTML = `
            <div class="alert alert-danger">Error: ${error.message}</div>
        `;
    }
}
