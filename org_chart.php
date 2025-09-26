<?php
include("config/db.php");
$result = $conn->query("SELECT * FROM org_chart");
$people = [];
while ($row = $result->fetch_assoc()) {
    $people[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Organization Chart</title>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body { background-color: #f8f9fa; }
        #chart_div { margin-top: 30px; }
        .org-node {
            padding: 10px;
            background: #ffffff;
            border: 2px solid #0d6efd;
            border-radius: 10px;
            box-shadow: 0 3px 6px rgba(0,0,0,0.1);
            cursor: pointer;
            transition: transform 0.2s, background 0.2s;
        }
        .org-node:hover {
            background: #e7f1ff;
            transform: scale(1.03);
        }
        .modal-body img {
            max-width: 120px;
            border-radius: 50%;
            margin-bottom: 15px;
        }
    </style>
    <script>
        google.charts.load('current', {packages:["orgchart"]});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Name');
            data.addColumn('string', 'Manager');
            data.addColumn('string', 'ToolTip');

            data.addRows([
                <?php foreach ($people as $p): ?>
                [{v:'<?= $p['id'] ?>', f:'<div class="org-node" onclick="showPerson(<?= $p['id'] ?>)"><b><?= addslashes($p['name']) ?></b><br><?= addslashes($p['role']) ?></div>'},
                 '<?= $p['parent_id'] ?>',
                 '<?= addslashes($p['description']) ?>'],
                <?php endforeach; ?>
            ]);

            var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
            chart.draw(data, {allowHtml:true});
        }

        var peopleData = <?php echo json_encode($people); ?>;

        function showPerson(id) {
            var person = peopleData.find(p => p.id == id);
            if (!person) return;

            document.getElementById("personPhoto").src = person.photo ? person.photo : "https://via.placeholder.com/120";
            document.getElementById("personName").innerText = person.name;
            document.getElementById("personRole").innerText = person.role;
            document.getElementById("personPhone").innerText = person.phone || "N/A";
            document.getElementById("personEmail").innerText = person.email || "N/A";
            document.getElementById("personSocial").href = person.social || "#";
            document.getElementById("personSocial").innerText = person.social ? "View Profile" : "N/A";
            document.getElementById("personDesc").innerText = person.description || "No additional information.";

            var modal = new bootstrap.Modal(document.getElementById('personModal'));
            modal.show();
        }
    </script>
</head>
<body>
<div class="container py-5">
    <h1 class="text-center mb-4">Organization Chart</h1>
    <div id="chart_div"></div>
</div>

<!-- Modal -->
<div class="modal fade" id="personModal" tabindex="-1" aria-labelledby="personModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content text-center">
      <div class="modal-header">
        <h5 class="modal-title" id="personName"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <img id="personPhoto" src="https://via.placeholder.com/120" alt="Profile">
        <p><strong>Role:</strong> <span id="personRole"></span></p>
        <p><strong>Phone:</strong> <span id="personPhone"></span></p>
        <p><strong>Email:</strong> <span id="personEmail"></span></p>
        <p><strong>Social:</strong> <a href="#" id="personSocial" target="_blank">N/A</a></p>
        <p id="personDesc"></p>
      </div>
    </div>
  </div>
</div>
</body>
</html>
