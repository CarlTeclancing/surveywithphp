function getData(url, calback) {
  fetch(url)
    .then((response) => response.json())
    .then((result) => calback(result));
}

getData("../api/surveys/profile.php", (data) => {
  // Set new default font family and font color to mimic Bootstrap's default styling
  Chart.defaults.global.defaultFontFamily =
    '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = "#292b2c";


  // Bar Chart Example
  var ctx = document.getElementById("surveyBarChart");

  let statLabels = [];
  let statData = [];

  data.forEach((dataItem) => {
    statLabels.push(dataItem.month);
    statData.push(dataItem.surveys);
  });

  var myLineChart = new Chart(ctx, {
    type: "bar",
    data: {
      labels: statLabels,
      datasets: [
        {
          label: "Surveys",
          backgroundColor: "rgb(228, 163, 11)",
          borderColor: "rgba(2,117,216,1)",
          data: statData,
        },
      ],
    },
    options: {
      scales: {
        xAxes: [
          {
            time: {
              unit: "months",
            },
            gridLines: {
              display: true,
            },
            ticks: {
              maxTicksLimit: 6,
            },
          },
        ],
        yAxes: [
          {
            ticks: {
              min: 0,
              max: 10,
              maxTicksLimit: 20,
            },
            gridLines: {
              display: true,
            },
          },
        ],
      },
      legend: {
        display: false,
      },
    },
  });
});
