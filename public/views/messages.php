<?php include __DIR__ . "/../includes/header.php"; ?>
    <!-- MAIN CONTENT -->
    <main class="container mt-4">

        <h1 class="h3 mb-4">Message Management</h1>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Message</th>
                            <th>Sender</th>
                            <th>Receiver</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="messageTable"></tbody>
                </table>
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", () => {

        const table = document.getElementById("messageTable");

        // 🔥 HARD DATA (simula backend)
        const messages = [
            {
                id: 1,
                text: "Medication reminder",
                sender: "System",
                receiver: "Carlos Mendes",
                date: "2024-03-01",
                seen: true
            },
            {
                id: 2,
                text: "Please check device battery",
                sender: "Maria Silva",
                receiver: "Joana Rocha",
                date: "2024-03-02",
                seen: false
            },
            {
                id: 3,
                text: "Appointment scheduled",
                sender: "Admin",
                receiver: "António Costa",
                date: "2024-03-03",
                seen: true
            },
            {
                id: 4,
                text: "Emergency alert triggered",
                sender: "System",
                receiver: "Carlos Mendes",
                date: "2024-03-04",
                seen: false
            }
        ];

        function renderMessages() {
            table.innerHTML = "";

            messages.forEach(msg => {

                const badge = msg.seen
                    ? '<span class="badge bg-success">Seen</span>'
                    : '<span class="badge bg-warning text-dark">Unseen</span>';

                const row = document.createElement("tr");

                row.innerHTML = `
                    <td>${msg.id}</td>
                    <td>${msg.text}</td>
                    <td>${msg.sender}</td>
                    <td>${msg.receiver}</td>
                    <td>${msg.date}</td>
                    <td>${badge}</td>
                `;

                table.appendChild(row);
            });
        }

        renderMessages();

    });
    </script>

</body>
</html>