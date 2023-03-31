function getData(url, calback) {
  fetch(url)
    .then((response) => response.json())
    .then((result) => calback(result));
}

getData("../api/answers/profile.php", (data) => {
  // Set new default font family and font color to mimic Bootstrap's default styling
  Chart.defaults.global.defaultFontFamily =
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = "#292b2c";

  console.log(data);

  // Bar Chart Example
  var ctx = document.getElementById("answerPieChart");

  let statLabels = [];
  let statData = [];

  data.forEach((dataItem) => {
    statLabels.push(dataItem.month);
    statData.push(dataItem.answers);
  });

  var myPieChart = new Chart(ctx, {
    type: "pie",
    data: {
      labels: statLabels,
      datasets: [
        {
          data: statData,
          backgroundColor: ["#007bff", "#dc3545", "#ffc107", "#28a745"],
        },
      ],
    },
  });
});
