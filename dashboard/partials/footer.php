
<script>
    let expiresOn = document.getElementById("expiresOn");
    let date = new Date();
    let month = ((date.getMonth() + 1) < 9) ? `0${date.getMonth() + 1}` : `${date.getMonth() + 1}`;
    let minDate = `${date.getFullYear()}-${month}-${date.getDate() + 1}`;
    expiresOn.setAttribute("min", minDate);
</script>

<script src="<?= DASHBOARD_URL ?>/assets/bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?= DASHBOARD_URL ?>/js/scripts.js"></script>
<script src="<?= DASHBOARD_URL ?>/assets/chartjs/Chart.min.js" crossorigin="anonymous"></script>
<script src="<?= DASHBOARD_URL ?>/assets/demo/survey-chart.js"></script>
<script src="<?= DASHBOARD_URL ?>/assets/demo/answer-chart.js"></script>
<script src="<?= DASHBOARD_URL ?>/js/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="<?= DASHBOARD_URL ?>/js/datatables-simple-demo.js"></script>


